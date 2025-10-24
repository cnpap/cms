<?php
/**
 * WordPress 基础配置文件
 *
 * 你可以直接复制本文件为 wp-config.php，并填充数据库等信息。
 * 下面配置适用于本地开发环境，请根据你的实际数据库信息调整。
 */

// 数据库设置
define('DB_NAME', 'database'); // 数据库名（请按需修改）
define('DB_USER', 'root'); // 数据库用户名（请按需修改）
define('DB_PASSWORD', '123456'); // 数据库密码（请按需修改）
define('DB_HOST', 'localhost'); // 数据库主机（通常为 localhost）

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/**
 * 身份认证唯一密钥与盐值
 * 建议使用真正随机且唯一的值。
 */
define('AUTH_KEY', 'lH6pQvGkY2d3A0xwN9uE7mT4RzV1cB5ZfP8sLqWjCk');
define('SECURE_AUTH_KEY', 'Q0uR9tW2yX5bV8nC4mJ7kP1sD6fE3aL0hZ8xT2vN5r');
define('LOGGED_IN_KEY', 'T7yU2iP9oL4qE1aS6dF3mN8cB5vW0xR2zJ6kH3pL0d');
define('NONCE_KEY', 'M1nB7vC3xZ9kL4hT2rP6eD8fS0aQ5wY2uJ7iK3mV9t');
define('AUTH_SALT', 'C9xL2mV7tN3rP6eD1fS8aQ5wY0uJ4iK7mV2tN9rP6e');
define('SECURE_AUTH_SALT', 'Z4kH1pL7dF3mN8cB5vW2xR9tY6uI3oP0lK7jH2gF9s');
define('LOGGED_IN_SALT', 'P8oI3uY6tR9xW2vB5cN8mF3dL7pK1hJ4gS9fE2aQ5w');
define('NONCE_SALT', 'R2zJ6kH3pL0dT7yU2iP9oL4qE1aS6dF3mN8cB5vW0x');

/**
 * 数据表前缀
 */
$table_prefix = 'wp_';

/**
 * 调试模式（开发环境建议 true，线上建议 false）
 */
define('WP_DEBUG', false);

/* 在此行与“停止编辑”之间可添加自定义常量 */
define('FS_METHOD', 'direct');
define('WPLANG', 'zh_CN');

/* 停止编辑！开始愉快发布吧。 */

/** WordPress 目录的绝对路径 */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** 设置 WordPress 变量并包含文件 */
require_once ABSPATH . 'wp-settings.php';
