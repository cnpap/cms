!(function (e) {
	var t = {};
	function n(i) {
		if (t[i]) return t[i].exports;
		var a = (t[i] = { i: i, l: !1, exports: {} });
		return (e[i].call(a.exports, a, a.exports, n), (a.l = !0), a.exports);
	}
	((n.m = e),
		(n.c = t),
		(n.d = function (e, t, i) {
			n.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: i });
		}),
		(n.r = function (e) {
			('undefined' != typeof Symbol &&
				Symbol.toStringTag &&
				Object.defineProperty(e, Symbol.toStringTag, { value: 'Module' }),
				Object.defineProperty(e, '__esModule', { value: !0 }));
		}),
		(n.t = function (e, t) {
			if ((1 & t && (e = n(e)), 8 & t)) return e;
			if (4 & t && 'object' == typeof e && e && e.__esModule) return e;
			var i = Object.create(null);
			if (
				(n.r(i),
				Object.defineProperty(i, 'default', { enumerable: !0, value: e }),
				2 & t && 'string' != typeof e)
			)
				for (var a in e)
					n.d(
						i,
						a,
						function (t) {
							return e[t];
						}.bind(null, a)
					);
			return i;
		}),
		(n.n = function (e) {
			var t =
				e && e.__esModule
					? function () {
							return e.default;
						}
					: function () {
							return e;
						};
			return (n.d(t, 'a', t), t);
		}),
		(n.o = function (e, t) {
			return Object.prototype.hasOwnProperty.call(e, t);
		}),
		(n.p = ''),
		n((n.s = 73)));
})({
	73: function (e, t) {
		var n, i;
		((n = window.jQuery),
			(i = {
				currentBuilderType: null,
				activeSection: null,
				currentSelectedElement: null,
				elementSettingsControls: {},
				init: function () {
					(this.bindEvents(),
						this.initSortable(),
						this.loadBuilderData(),
						this.initializeDisabledElements(),
						this.toggleBuilder(),
						this.renderElementListInPanel(),
						this.initializeElementSettings());
				},
				initializeElementSettings: function () {
					(window.athfbCustomizer.settingsMapping &&
						Object.keys(window.athfbCustomizer.settingsMapping).forEach((e) => {
							this.elementSettingsControls[e] =
								window.athfbCustomizer.settingsMapping[e];
						}),
						this.hideAllElementSettings());
				},
				hideAllElementSettings: function () {
					Object.keys(this.elementSettingsControls).forEach((e) => {
						this.elementSettingsControls[e].forEach((e) => {
							const t = window.wp.customize.control(e);
							t && t.container.hide();
						});
					});
				},
				showElementSettings: function (e) {
					(this.hideAllElementSettings(),
						this.elementSettingsControls[e] &&
							this.elementSettingsControls[e].forEach((e) => {
								const t = window.wp.customize.control(e);
								if (t) {
									t.container.show();
									const e =
											'footer' === this.currentBuilderType
												? 'footer_builder'
												: 'header_builder',
										n = window.wp.customize.section(e);
									n &&
										n.container
											.find('#athfb-no-element-selected')
											.last()
											.after(t.container);
								}
							}),
						this.updateElementSettingsContainer(e));
				},
				updateElementSettingsContainer: function (e) {
					const t = this.currentBuilderType || 'header',
						i = n(
							`#customize-control-athfb_element_settings_container_${t} #athfb-element-settings-container`
						);
					if (!i.length) return;
					const a = i.find('#athfb-no-element-selected'),
						o = i.find('#athfb-current-element-title');
					if (e && window.athfbCustomizer.allAvailableBlocks[e]) {
						const t = window.athfbCustomizer.allAvailableBlocks[e];
						(a.hide(), o.text(t.label + ' Settings'));
						const s = i.find('#athfb-current-element-settings');
						(s.empty(),
							this.elementSettingsControls[e] &&
								this.elementSettingsControls[e].forEach((e) => {
									const t = window.wp.customize.control(e);
									if (t) {
										const i = n(
											'<p><a href="#" class="athfb-setting-link" data-setting="' +
												e +
												'">' +
												t.params.label +
												'</a></p>'
										);
										s.append(i);
									}
								}));
					} else a.show();
				},
				renderElementListInPanel: function () {
					const e = `#customize-control-athfb_element_settings_container_${this.currentBuilderType || 'header'} #athfb-element-settings-container`,
						t = n(e);
					if (!t.length)
						return void console.warn('Element settings container not found:', e);
					if (!this.activeSection || !this.activeSection.length) return;
					const i = this.activeSection.find('.athfb-builder-control');
					if (!i.length) return;
					const a = [];
					(i.find('.athfb-builder-element').each(function () {
						const e = n(this),
							t = e.data('element-type'),
							i = window.athfbCustomizer.allAvailableBlocks[t],
							o = (i && i.label) || t;
						a.push({ label: o, elementType: t, element: e });
					}),
						t.find('#athfb-active-elements-list').remove());
				},
				toggleBuilder: () => {
					n('.hide-builder').on('click', function (e) {
						e.preventDefault();
						const t = n(this).closest('.athfb-builder-control'),
							i = n(this).find('i'),
							a = n(this).find('.label');
						var o = t.attr('data-builder-type'),
							s = 'header' === o ? 'footer' : 'header';
						t.hasClass('collapsed')
							? (n('body').removeClass('afth-builder_collapsed_' + o),
								n('body').removeClass('afth-admin_' + s),
								t.removeClass('collapsed').css('height', 'auto'),
								i
									.removeClass('dashicons-arrow-down-alt2')
									.addClass('dashicons-arrow-up-alt2'),
								a.text('Hide Builder'),
								n('body').addClass('afth-admin_' + o))
							: (t.addClass('collapsed').css('height', '38px'),
								n('body').addClass('afth-builder_collapsed_' + o),
								i
									.removeClass('dashicons-arrow-up-alt2')
									.addClass('dashicons-arrow-down-alt2'),
								a.text('Show Builder'),
								n('body').removeClass('afth-admin_' + o));
					});
				},
				initializeDisabledElements: function () {
					const e = this;
					n('.athfb-builder-control').each(function () {
						e.disableUsedElements(n(this));
					});
				},
				disableUsedElements: function (e) {
					const t = this.getBuilderData(e),
						i = e.attr('data-current-device') || 'desktop',
						a = new Set(),
						o = e.data('builder-type'),
						s = t[o + '_' + i + '_items'] || {};
					s &&
						Object.values(s).forEach((e) => {
							Object.values(e).forEach((e) => {
								Array.isArray(e) &&
									e.forEach((e) => {
										a.add(e);
									});
							});
						});
					const l = (
						n('.hf-builder-active').length
							? n('.hf-builder-active')
							: e.closest('.customize-control')
					).find('#athfb-add-element-modal');
					if (0 === l.length) return;
					const r = this.getBlocksForType(o),
						d = new Set(r);
					l.find('.athfb-element-item').each(function () {
						const e = n(this),
							t = e.data('element-type');
						if (
							('footer' === o && t.startsWith('header_')) ||
							('header' === o && t.startsWith('footer_'))
						)
							return void e
								.addClass('disabled')
								.attr('disabled', !0)
								.css({ display: 'none', opacity: 0.5, pointerEvents: 'none' });
						const i = window.athfbCustomizer.allAvailableBlocks[t];
						if (d.has(t)) {
							e.show();
							let n = !1,
								o = '';
							if (i && i.settings)
								for (const e in i.settings)
									if (i.settings[e] && !0 === i.settings[e].is_lock) {
										((n = !0), (o = i.settings[e].lock_msg));
										break;
									}
							n
								? (e
										.addClass('disabled pro-disabled')
										.attr('disabled', !0)
										.css({ opacity: 0.5, pointerEvents: 'none' }),
									0 === e.find('.lock-icon').length &&
										e.append(
											`\n                  <span class="lock-icon dashicons dashicons-lock" title="Pro feature">\n                      <span>${o}</span>\n                  </span>\n              `
										))
								: a.has(t)
									? e
											.addClass('disabled')
											.attr('disabled', !0)
											.css({ opacity: 0.5, pointerEvents: 'none' })
									: e
											.removeClass('disabled')
											.removeAttr('disabled')
											.css({ opacity: 1, pointerEvents: 'auto' });
						} else e.hide();
					});
				},
				removeElement: function (e) {
					const t = e.closest('.athfb-builder-element'),
						n = e.closest('.athfb-builder-control'),
						i = t.data('element-type');
					(this.currentSelectedElement === i &&
						(this.hideAllElementSettings(),
						(this.currentSelectedElement = null),
						this.updateElementSettingsContainer(null)),
						t.remove(),
						this.updateBuilderData(),
						this.disableUsedElements(n),
						this.renderElementListInPanel());
				},
				switchDevice: function (e) {
					const t = e.data('device'),
						n = e.closest('.athfb-builder-control');
					(n.find('.athfb-device-btn').removeClass('active'),
						e.addClass('active'),
						n.attr('data-current-device', t),
						this.loadDeviceData(t, n),
						this.disableUsedElements(n));
				},
				addElementToBuilder: function (e, t, n, i, a) {
					const o = window.athfbCustomizer.allAvailableBlocks[e];
					if (!o) return (console.error('Block config not found for:', e), !1);
					const s = this.generateElementId(e),
						l = i.find(`.athfb-drop-zone[data-row="${t}"][data-column="${n}"]`);
					if (0 === l.length) return (console.error('Drop zone not found:', t, n), !1);
					console.log(o);
					const r = this.createBuilderElement(e, s, o, a);
					return (
						l.append(r),
						this.updateBuilderData(),
						this.disableUsedElements(i),
						this.renderElementListInPanel(),
						!0
					);
				},
				bindEvents: function () {
					var e = this;
					(n(document).on('keydown', function (e) {
						if ('Tab' === e.key) {
							const t = n('.hf-builder-active');
							if (0 === t.length) return;
							const i = t
								.find(
									'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex="0"]'
								)
								.filter(':visible');
							if (0 === i.length) return;
							const a = i.first()[0],
								o = i.last()[0],
								s = document.activeElement;
							e.shiftKey
								? s === a && (e.preventDefault(), o.focus())
								: s === o && (e.preventDefault(), a.focus());
						}
					}),
						n(document).on('click', '.athfb-device-btn', function (t) {
							(t.preventDefault(), e.switchDevice(n(this)));
						}),
						n(document).on('click', '.athfb-element-remove', function (t) {
							(t.preventDefault(), t.stopPropagation(), e.removeElement(n(this)));
						}),
						n(document).on('click', '.athfb-add-element-btn', function (t) {
							t.preventDefault();
							const i = n(this),
								a = i.closest('.hf-builder-active');
							if (0 === a.length)
								return void console.warn(
									'No active section found for add element button'
								);
							n('.athfb-modal').hide();
							const o = a.find('.athfb-builder-control'),
								s = a.find('#athfb-add-element-modal');
							((e.activeSection = a),
								(e.currentBuilderType = o.data('builder-type') || 'header'),
								s.data('targetRow', i.data('row')),
								s.data('targetColumn', i.data('column')),
								e.disableUsedElements(o),
								s.fadeIn(function () {
									const e = s.find('.athfb-element-item[tabindex="0"]').first();
									e.length && e.focus();
								}));
						}),
						n(document).on(
							'click',
							'#athfb-add-element-modal .athfb-element-item',
							function (t) {
								t.preventDefault();
								const i = n(this);
								if (i.hasClass('disabled')) return;
								const a = i.data('element-type'),
									o = i.data('element-elfocus'),
									s = i.closest('#athfb-add-element-modal'),
									l = s.data('targetRow'),
									r = s.data('targetColumn'),
									d = (e.activeSection || i.closest('.hf-builder-active')).find(
										'.athfb-builder-control'
									);
								e.addElementToBuilder(a, l, r, d, o) && s.fadeOut();
							}
						),
						n(document).on('click', '.athfb-element-settings', function (t) {
							(t.preventDefault(), t.stopPropagation());
							const a = n(this).closest('.athfb-builder-element'),
								o = a.data('element-type'),
								s =
									a.closest('.athfb-builder-control').data('builder-type') ||
									'header';
							((i.currentBuilderType = s),
								(i.currentSelectedElement = o),
								i.showElementSettings(o),
								(e.currentSelectedElement = o),
								e.showElementSettings(o));
							const l = window.athfbCustomizer.allAvailableBlocks[o];
							if (l && l.elfocus) {
								const e = wp.customize.control(l.elfocus);
								e &&
									(e.focus(),
									e.container[0].scrollIntoView({
										behavior: 'smooth',
										block: 'center'
									}));
							}
						}),
						n(document).on('click', '.athfb-element-configure', function (t) {
							t.preventDefault();
							const i = n(this).data('element-type');
							((e.currentSelectedElement = i), e.showElementSettings(i));
						}),
						n(document).on('click', '.athfb-setting-link', function (e) {
							e.preventDefault();
							const t = n(this).data('setting'),
								i = window.wp.customize.control(t);
							i &&
								(i.focus(),
								i.container[0].scrollIntoView({
									behavior: 'smooth',
									block: 'center'
								}));
						}),
						n(document).on(
							'click',
							'.athfb-modal-close, .athfb-cancel-settings',
							(t) => {
								(t.preventDefault(), e.closeModal());
							}
						),
						n(document).on('change', '.athfb-builder-data', () => {
							e.updatePreview();
						}),
						n(document).on('input change', '.athfb-dynamic-input', function () {
							const e = n(this),
								t = e.data('setting-key'),
								i = e.data('element-id'),
								a =
									'footer' === e.data('builder-type')
										? 'footer_builder_data'
										: 'header_builder_data',
								o = wp.customize(a);
							let s = {};
							try {
								s = JSON.parse(o.get());
							} catch (e) {
								console.warn(`Invalid JSON in ${a}:`, e);
							}
							(s.element_settings || (s.element_settings = {}),
								s.element_settings[i] || (s.element_settings[i] = {}),
								(s.element_settings[i][t] = e.val()),
								o.set(JSON.stringify(s)));
						}),
						n(document).on('click', '.athfb-modal', function (t) {
							t.target === this && e.closeModal();
						}),
						window.wp &&
							window.wp.customize &&
							Object.keys(e.elementSettingsControls).forEach((t) => {
								e.elementSettingsControls[t].forEach((e) => {
									window.wp.customize(e) &&
										window.wp.customize(e).bind((e) => {
											window.wp.customize.state('saved').set(!1);
										});
								});
							}));
				},
				createBuilderElement: (e, t, i, a) =>
					n(
						`<div \n    class="athfb-builder-element" \n    data-element-type="${e}" \n    data-element-id="${t}"\n    data-f="${a}"\n    role="listitem"\n    tabindex="0"\n    aria-label="${i.label}"\n    aria-grabbed="false">\n    <div class="athfb-element-content">\n      <span class="athfb-element-label">${i.label}</span>\n    </div>\n    <div class="athfb-element-actions">\n      <button \n        type="button" \n        class="athfb-element-settings" \n        aria-label="${window.athfbCustomizer.strings.configureElement}"\n      >\n        <span class="dashicons dashicons-admin-generic" aria-hidden="true"></span>\n      </button>\n      <button \n        type="button" \n        class="athfb-element-remove" \n        aria-label="${window.athfbCustomizer.strings.removeElement}"\n      >\n        <span class="dashicons dashicons-no-alt" aria-hidden="true"></span>\n      </button>\n    </div>\n  </div>\n  `
					),
				initSortable: function () {
					n('.athfb-drop-zone').sortable({
						connectWith: '.athfb-drop-zone',
						placeholder: 'athfb-element-placeholder',
						tolerance: 'pointer',
						cursor: 'pointer',
						start: (e, t) => {
							(t.placeholder.height(t.item.height()), t.item.css('z-index', '99999'));
						},
						update: (e, t) => {
							const i = n(e.target).closest('.athfb-builder-control');
							(this.disableUsedElements(i), t.item.css('z-index', ''));
						},
						stop: (e, t) => {
							(this.updateBuilderData(), t.item.css('z-index', ''));
						},
						receive: (e, t) => {
							t.item.hasClass('athfb-element-item') &&
								(this.convertToBuilderElement(t.item),
								t.item.css('z-index', '99999'));
						}
					});
				},
				convertToBuilderElement: function (e) {
					const t = e.data('element-type'),
						n = e.data('element-elfocus'),
						i = this.generateElementId(t),
						a = window.athfbCustomizer.allAvailableBlocks[t];
					console.log(a);
					const o = this.createBuilderElement(t, i, a, n);
					(e.replaceWith(o), this.updateBuilderData());
				},
				generateElementId: (e) =>
					e + '_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9),
				getBlocksForType: (e) =>
					'header' === e && window.athfbCustomizer.allowedHeaderBlocks
						? window.athfbCustomizer.allowedHeaderBlocks
						: 'footer' === e && window.athfbCustomizer.allowedFooterBlocks
							? window.athfbCustomizer.allowedFooterBlocks
							: [],
				updateBuilderData: () => {
					n('.athfb-builder-control').each(function () {
						const e = n(this),
							t = e.attr('data-current-device') || 'desktop',
							i = e.data('builder-type'),
							a = 'footer' === i ? 'footer_builder_data' : 'header_builder_data',
							o =
								'footer' === i
									? 'footer_' + t + '_items'
									: 'header_' + t + '_items',
							s = {};
						((s[o] = { top: {}, main: {}, bottom: {}, flag: !1 }),
							e.find('.athfb-builder-row').each(function () {
								const e = n(this).data('row');
								n(this)
									.find('.athfb-builder-column')
									.each(function () {
										const t = n(this).data('column'),
											i = [];
										(n(this)
											.find('.athfb-builder-element')
											.each(function () {
												const e = n(this).data('element-type');
												i.push(e);
											}),
											(s[o][e][t] = i));
									});
							}),
							window.wp.customize(a) &&
								window.wp.customize(a).set(JSON.stringify(s)));
					});
				},
				getBuilderData: (e) => {
					let t = e.find('.athfb-builder-data').val();
					'string' == typeof t &&
						t.startsWith('customized') &&
						(t = t.substring('customized'.length));
					try {
						const e = JSON.parse(t);
						if ('object' == typeof e) {
							if (e.header_builder_data && 'string' == typeof e.header_builder_data)
								return JSON.parse(e.header_builder_data);
							if (e.footer_builder_data && 'string' == typeof e.footer_builder_data)
								return JSON.parse(e.footer_builder_data);
						}
						return e || {};
					} catch (e) {
						return (console.error('Error parsing builder data string:', t, e), {});
					}
				},
				loadBuilderData: function () {
					const e = this;
					n('.athfb-builder-control').each(function () {
						const t = n(this);
						(t.attr('data-current-device', 'desktop'), e.loadDeviceData('desktop', t));
					});
				},
				closeModal: function () {
					n('.athfb-modal').hide();
				},
				loadDeviceData: function (e, t) {
					const i =
						this.getBuilderData(t)[t.data('builder-type') + '_' + e + '_items'] || {};
					n.each(i, (e, i) => {
						n.each(i, (i, a) => {
							const o = t.find(
								`.athfb-drop-zone[data-row="${e}"][data-column="${i}"]`
							);
							(o.empty(),
								n.each(a, (e, t) => {
									const n = window.athfbCustomizer.allAvailableBlocks[t],
										i = n.elfocus;
									if (
										!(function e(t) {
											return (
												!(!t || 'object' != typeof t) &&
												('is_lock' in t ||
													Object.values(t).some((t) => e(t)))
											);
										})(n.settings) &&
										(console.log(n), n)
									) {
										const e = this.generateElementId(t),
											a = this.createBuilderElement(t, e, n, i);
										o.append(a);
									}
								}));
						});
					});
				},
				updatePreview: () => {
					window.wp &&
						window.wp.customize &&
						window.wp.customize.previewer &&
						window.wp.customize.previewer.refresh();
				}
			}),
			window.wp &&
				window.wp.customize &&
				window.wp.customize.bind('ready', () => {
					(i.init(),
						['header', 'footer'].forEach(function (e) {
							const t = 'athfb_show_checkbox_' + e,
								n = e + '_builder';
							wp.customize(t, function (e) {
								e.bind(function (e) {
									const t = wp.customize.section(n).contentContainer;
									e
										? t.addClass('hf-builder-active')
										: t.removeClass('hf-builder-active');
								});
							});
						}));
				}),
			wp.customize.bind('ready', function () {
				(n(document).on('click', '.athfb-widget-panel-link', function (e) {
					e.preventDefault();
					const t = jQuery(this).data('panel'),
						n = wp.customize.section(t);
					n && n.expand();
				}),
					n(document).on('click', '.athfb-menu-panel-link', function (e) {
						e.preventDefault();
						const t = jQuery(this).data('panel'),
							n = wp.customize.panel(t);
						n && n.expand();
					}));
			}),
			window.wp.customize.bind('ready', () => {
				['header_builder', 'footer_builder'].forEach((e) => {
					!(function t(a = 20) {
						const o = window.wp.customize.section(e);
						if (!o && a > 0) return void setTimeout(() => t(a - 1), 250);
						if (!o) return;
						const s = e.replace('_builder', ''),
							l = 'athfb_show_checkbox_' + s,
							r = o.contentContainer;
						(n('body').removeClass('afth-admin_' + s),
							wp.customize(l) &&
								(wp.customize(l).get()
									? (r.addClass('hf-builder-active'),
										n('body').addClass('afth-admin_' + s))
									: (r.removeClass('hf-builder-active'),
										n('body').removeClass('afth-admin_' + s)),
								wp.customize(l).bind((e) => {
									e
										? (r.addClass('hf-builder-active'),
											n('body').addClass('afth-admin_' + s))
										: (n('body').removeClass('afth-admin_' + s),
											r.removeClass('hf-builder-active'));
								})),
							n('body')
								.removeClass('afth-admin_header')
								.removeClass('afth-admin_footer'),
							o.expanded.bind((e) => {
								e
									? (n('body')
											.removeClass('afth-admin_header')
											.removeClass('afth-admin_footer'),
										n('.hf-builder-active').removeClass('hf-builder-active'),
										wp.customize(l).get() &&
											(r.addClass('hf-builder-active'),
											n('body').addClass('afth-admin_' + s)),
										r.find('.athfb-builder-control').hasClass('collapsed')
											? n('body').addClass('afth-builder_collapsed_' + s)
											: n('body').removeClass('afth-builder_collapsed_' + s),
										r.css('display', 'block'),
										(i.currentBuilderType = s),
										(i.activeSection = r),
										i.renderElementListInPanel(),
										wp.customize.previewer &&
											wp.customize.previewer.send &&
											wp.customize.previewer.send(
												'hfb_active_builder',
												i.currentBuilderType
											))
									: (r.removeClass('hf-builder-active'),
										r.find('.athfb-modal').hide(),
										n('body').removeClass('afth-admin_' + s),
										r.find('.athfb-builder-control').hasClass('collapsed') &&
											n('body').removeClass('afth-builder_collapsed_' + s),
										i.activeSection &&
											i.activeSection[0] === r[0] &&
											((i.activeSection = null),
											(i.currentBuilderType = null),
											i.hideAllElementSettings(),
											(i.currentSelectedElement = null)));
							}));
					})();
				});
			}));
	}
});
