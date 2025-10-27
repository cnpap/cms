#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
WordPress POT to MO file converter
将 WordPress POT 文件转换为 MO 文件的工具
"""

import os
import sys
import struct
import array
from pathlib import Path

def parse_po_file(po_file_path):
    """解析 PO/POT 文件并返回翻译字典"""
    translations = {}
    
    with open(po_file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # 分割成消息块
    messages = content.split('\n\n')
    
    for message in messages:
        if not message.strip():
            continue
            
        lines = message.strip().split('\n')
        msgid = ""
        msgstr = ""
        
        i = 0
        while i < len(lines):
            line = lines[i].strip()
            
            # 跳过注释行
            if line.startswith('#'):
                i += 1
                continue
                
            # 处理 msgid
            if line.startswith('msgid '):
                msgid = line[6:].strip('"')
                i += 1
                # 处理多行 msgid
                while i < len(lines) and lines[i].strip().startswith('"'):
                    msgid += lines[i].strip().strip('"')
                    i += 1
                continue
                
            # 处理 msgstr
            if line.startswith('msgstr '):
                msgstr = line[7:].strip('"')
                i += 1
                # 处理多行 msgstr
                while i < len(lines) and lines[i].strip().startswith('"'):
                    msgstr += lines[i].strip().strip('"')
                    i += 1
                continue
                
            i += 1
        
        # 只添加有翻译的条目
        if msgid and msgstr:
            # 处理转义字符
            msgid = msgid.replace('\\n', '\n').replace('\\"', '"').replace('\\\\', '\\')
            msgstr = msgstr.replace('\\n', '\n').replace('\\"', '"').replace('\\\\', '\\')
            translations[msgid] = msgstr
    
    return translations

def create_mo_file(translations, mo_file_path):
    """创建 MO 文件"""
    
    # 准备字符串数据
    keys = sorted(translations.keys())
    values = [translations[k] for k in keys]
    
    # 计算偏移量
    koffsets = []
    voffsets = []
    kencoded = []
    vencoded = []
    
    for k, v in zip(keys, values):
        kencoded.append(k.encode('utf-8'))
        vencoded.append(v.encode('utf-8'))
    
    keystart = 7 * 4 + 16 * len(keys)
    valuestart = keystart
    for k in kencoded:
        valuestart += len(k)
    
    koffsets = []
    voffsets = []
    
    offset = keystart
    for k in kencoded:
        koffsets.append((len(k), offset))
        offset += len(k)
    
    offset = valuestart
    for v in vencoded:
        voffsets.append((len(v), offset))
        offset += len(v)
    
    # 写入 MO 文件
    with open(mo_file_path, 'wb') as f:
        # MO 文件头
        f.write(struct.pack('<I', 0x950412de))  # 魔数
        f.write(struct.pack('<I', 0))           # 版本
        f.write(struct.pack('<I', len(keys)))   # 字符串数量
        f.write(struct.pack('<I', 7 * 4))       # 键表偏移
        f.write(struct.pack('<I', 7 * 4 + 8 * len(keys)))  # 值表偏移
        f.write(struct.pack('<I', 0))           # 哈希表大小
        f.write(struct.pack('<I', 0))           # 哈希表偏移
        
        # 键表
        for length, offset in koffsets:
            f.write(struct.pack('<I', length))
            f.write(struct.pack('<I', offset))
        
        # 值表
        for length, offset in voffsets:
            f.write(struct.pack('<I', length))
            f.write(struct.pack('<I', offset))
        
        # 键字符串
        for k in kencoded:
            f.write(k)
        
        # 值字符串
        for v in vencoded:
            f.write(v)

def main():
    """主函数"""
    script_dir = Path(__file__).parent
    pot_file = script_dir / "zh_CN.pot"
    mo_file = script_dir / "zh_CN.mo"
    
    if not pot_file.exists():
        print(f"错误：找不到 POT 文件：{pot_file}")
        return 1
    
    print(f"正在解析 POT 文件：{pot_file}")
    translations = parse_po_file(pot_file)
    
    print(f"找到 {len(translations)} 个翻译条目")
    
    if len(translations) == 0:
        print("警告：没有找到任何翻译条目")
        return 1
    
    print(f"正在生成 MO 文件：{mo_file}")
    create_mo_file(translations, mo_file)
    
    print("MO 文件生成完成！")
    print(f"输出文件：{mo_file}")
    
    # 显示文件大小
    file_size = mo_file.stat().st_size
    print(f"文件大小：{file_size} 字节")
    
    return 0

if __name__ == "__main__":
    sys.exit(main())