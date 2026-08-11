/**
 * Kish Harmony Designer - Live Preview JS Tool
 * Real-time preview handler and inspect/element-picker engine
 */

(function() {
    var isPickerActive = false;
    var hoveredElement = null;
    var highlightOverlay = null;
    var tooltip = null;
    var quickEditPopup = null;

    // 1. Create highlight overlay and tooltip DOM elements on load
    function initVisualElements() {
        if (!highlightOverlay) {
            highlightOverlay = document.createElement('div');
            highlightOverlay.style.position = 'fixed';
            highlightOverlay.style.border = '2px dashed #ef4444';
            highlightOverlay.style.background = 'rgba(239, 68, 68, 0.15)';
            highlightOverlay.style.pointerEvents = 'none';
            highlightOverlay.style.zIndex = '999999';
            highlightOverlay.style.display = 'none';
            highlightOverlay.style.transition = 'all 0.1s ease';
            document.body.appendChild(highlightOverlay);
        }

        if (!tooltip) {
            tooltip = document.createElement('div');
            tooltip.style.position = 'fixed';
            tooltip.style.background = '#0f172a';
            tooltip.style.color = '#ffffff';
            tooltip.style.padding = '4px 10px';
            tooltip.style.borderRadius = '4px';
            tooltip.style.fontSize = '11px';
            tooltip.style.fontFamily = 'monospace';
            tooltip.style.zIndex = '1000000';
            tooltip.style.pointerEvents = 'none';
            tooltip.style.display = 'none';
            document.body.appendChild(tooltip);
        }
    }

    // 2. Generate a highly stable, non-fragile CSS Selector
    function getStableSelector(el) {
        if (el.id) {
            return '#' + el.id;
        }
        if (el.tagName === 'BODY') {
            return 'body';
        }

        var path = [];
        var current = el;
        while (current && current.nodeType === Node.ELEMENT_NODE) {
            var selector = current.tagName.toLowerCase();
            if (current.id) {
                selector += '#' + current.id;
                path.unshift(selector);
                break;
            } else {
                var className = current.className;
                if (className && typeof className === 'string') {
                    var classes = className.split(/\s+/).filter(function(c) {
                        // Filter out dynamic bracket styles and common utility classes
                        return c &&
                               !c.includes('[') &&
                               !c.includes(':') &&
                               !c.includes('/') &&
                               !c.startsWith('h-') &&
                               !c.startsWith('w-') &&
                               !c.startsWith('bg-') &&
                               !c.startsWith('text-') &&
                               !c.startsWith('p-') &&
                               !c.startsWith('m-') &&
                               !c.startsWith('rounded-') &&
                               !c.startsWith('border-') &&
                               !c.startsWith('hover:') &&
                               !c.startsWith('focus:') &&
                               !c.startsWith('active:') &&
                               !c.startsWith('grid-') &&
                               !c.startsWith('flex-') &&
                               !c.startsWith('justify-') &&
                               !c.startsWith('items-') &&
                               !c.startsWith('shadow-') &&
                               !c.startsWith('duration-') &&
                               !c.startsWith('transition');
                    });
                    if (classes.length > 0) {
                        selector += '.' + classes[0]; // Use first class for maximum stability
                    }
                }
            }
            path.unshift(selector);
            current = current.parentNode;

            // Limit depth to avoid too long selector paths
            if (path.length >= 3) {
                break;
            }
        }
        return path.join(' > ');
    }

    // 3. Highlight elements on Hover
    function handleMouseMove(e) {
        if (!isPickerActive || quickEditPopup) return;

        var el = e.target;
        if (!el || el === document.body || el === document.documentElement || el === highlightOverlay || el === tooltip) {
            return;
        }

        hoveredElement = el;
        var rect = el.getBoundingClientRect();

        // Position overlay
        highlightOverlay.style.top = rect.top + 'px';
        highlightOverlay.style.left = rect.left + 'px';
        highlightOverlay.style.width = rect.width + 'px';
        highlightOverlay.style.height = rect.height + 'px';
        highlightOverlay.style.display = 'block';

        // Position tooltip
        var selector = getStableSelector(el);
        tooltip.innerHTML = selector;
        tooltip.style.top = (rect.top - 25 > 0 ? rect.top - 25 : rect.top + rect.height + 5) + 'px';
        tooltip.style.left = rect.left + 'px';
        tooltip.style.display = 'block';
    }

    // 4. Capture Click & Open Quick-Edit Inline Popup
    function handleElementClick(e) {
        if (!isPickerActive) return;

        e.preventDefault();
        e.stopPropagation();

        if (quickEditPopup) {
            quickEditPopup.remove();
        }

        var el = e.target;
        var selector = getStableSelector(el);

        // Turn off hover highlight
        highlightOverlay.style.display = 'none';
        tooltip.style.display = 'none';

        // Get current active styles of element to prepopulate inputs
        var computed = window.getComputedStyle(el);
        var rgbToHex = function(rgb) {
            if (!rgb || rgb.indexOf('rgb') === -1) return '#ffffff';
            var parts = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            if (!parts) return '#ffffff';
            delete(parts[0]);
            for (var i = 1; i <= 3; ++i) {
                parts[i] = parseInt(parts[i], 10).toString(16);
                if (parts[i].length == 1) parts[i] = '0' + parts[i];
            }
            return '#' + parts.join('');
        };

        var curColor = rgbToHex(computed.color);
        var curBg = rgbToHex(computed.backgroundColor);
        var curFontSize = computed.fontSize;
        var curPadding = computed.padding;
        var curMargin = computed.margin;
        var curRadius = computed.borderRadius;

        // Build elegant inline Quick-Edit Popup DOM element
        quickEditPopup = document.createElement('div');
        quickEditPopup.className = 'khd-quick-edit-popup';
        quickEditPopup.style.position = 'fixed';
        quickEditPopup.style.top = '10%';
        quickEditPopup.style.right = '5%';
        quickEditPopup.style.width = '320px';
        quickEditPopup.style.background = '#ffffff';
        quickEditPopup.style.border = '2px solid #0b63d8';
        quickEditPopup.style.borderRadius = '12px';
        quickEditPopup.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
        quickEditPopup.style.padding = '15px';
        quickEditPopup.style.zIndex = '2000000';
        quickEditPopup.style.direction = 'rtl';
        quickEditPopup.style.fontFamily = 'Tahoma, sans-serif';
        quickEditPopup.style.fontSize = '12px';

        quickEditPopup.innerHTML = `
            <div style="font-weight:bold; border-bottom:1px solid #cbd5e1; padding-bottom:8px; margin-bottom:10px; display:flex; justify-content:space-between; align-items:center;">
                <span style="color:#0b63d8;">✏️ ویرایش سریع پیکسلی المان</span>
                <span id="khd-close-quick-edit" style="cursor:pointer; color:#ef4444; font-weight:bold; font-size:14px;">✕</span>
            </div>
            <div style="margin-bottom:8px;">
                <strong style="display:block; font-size:10px; color:#64748b; margin-bottom:2px;">سلکتور انتخابی:</strong>
                <code style="background:#f1f5f9; padding:2px 6px; border-radius:4px; display:block; word-break:break-all; font-size:11px;">${selector}</code>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:8px; margin-bottom:10px;">
                <div>
                    <label style="display:block; margin-bottom:2px;">رنگ متن</label>
                    <input type="color" id="khd-quick-color" value="${curColor}" style="width:100%; height:28px; cursor:pointer;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:2px;">رنگ پس‌زمینه</label>
                    <input type="color" id="khd-quick-bg" value="${curBg}" style="width:100%; height:28px; cursor:pointer;">
                </div>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:8px; margin-bottom:10px;">
                <div>
                    <label style="display:block; margin-bottom:2px;">سایز فونت</label>
                    <input type="text" id="khd-quick-size" value="${curFontSize}" style="width:100%; padding:4px; border:1px solid #cbd5e1; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:2px;">گردی گوشه</label>
                    <input type="text" id="khd-quick-radius" value="${curRadius}" style="width:100%; padding:4px; border:1px solid #cbd5e1; border-radius:4px;">
                </div>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:8px; margin-bottom:15px;">
                <div>
                    <label style="display:block; margin-bottom:2px;">فاصله داخلی (Padding)</label>
                    <input type="text" id="khd-quick-padding" value="${curPadding}" style="width:100%; padding:4px; border:1px solid #cbd5e1; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:2px;">فاصله خارجی (Margin)</label>
                    <input type="text" id="khd-quick-margin" value="${curMargin}" style="width:100%; padding:4px; border:1px solid #cbd5e1; border-radius:4px;">
                </div>
            </div>
            <button id="khd-confirm-quick-edit" style="width:100%; background:#0b63d8; color:#fff; border:none; padding:8px; border-radius:6px; font-weight:bold; cursor:pointer; text-align:center;">تایید و افزودن به کنترل‌پنل</button>
        `;

        document.body.appendChild(quickEditPopup);

        // Add real-time live preview updates inside popup inputs
        function applyStylesInstantly() {
            var color = document.getElementById('khd-quick-color').value;
            var bg = document.getElementById('khd-quick-bg').value;
            var size = document.getElementById('khd-quick-size').value;
            var radius = document.getElementById('khd-quick-radius').value;
            var padding = document.getElementById('khd-quick-padding').value;
            var margin = document.getElementById('khd-quick-margin').value;

            el.style.setProperty('color', color, 'important');
            el.style.setProperty('background-color', bg, 'important');
            if (size) el.style.setProperty('font-size', size, 'important');
            if (radius) el.style.setProperty('border-radius', radius, 'important');
            if (padding) el.style.setProperty('padding', padding, 'important');
            if (margin) el.style.setProperty('margin', margin, 'important');
        }

        var quickInputs = ['khd-quick-color', 'khd-quick-bg', 'khd-quick-size', 'khd-quick-radius', 'khd-quick-padding', 'khd-quick-margin'];
        quickInputs.forEach(function(id) {
            var input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', applyStylesInstantly);
                input.addEventListener('change', applyStylesInstantly);
            }
        });

        // Close Quick Edit popup
        document.getElementById('khd-close-quick-edit').addEventListener('click', function() {
            quickEditPopup.remove();
            quickEditPopup = null;
        });

        // Confirm Quick Edit and post data back to parent
        document.getElementById('khd-confirm-quick-edit').addEventListener('click', function(e) {
            e.preventDefault();

            var finalColor = document.getElementById('khd-quick-color').value;
            var finalBg = document.getElementById('khd-quick-bg').value;
            var finalSize = document.getElementById('khd-quick-size').value;
            var finalRadius = document.getElementById('khd-quick-radius').value;
            var finalPadding = document.getElementById('khd-quick-padding').value;
            var finalMargin = document.getElementById('khd-quick-margin').value;

            // Post back to parent sidebar Custom Elements editor
            window.parent.postMessage({
                action: 'khd_element_selected',
                selector: selector,
                styles: {
                    color: finalColor,
                    bg_color: finalBg,
                    font_size: finalSize,
                    border_radius: finalRadius,
                    padding: finalPadding,
                    margin: finalMargin
                }
            }, '*');

            quickEditPopup.remove();
            quickEditPopup = null;
        });
    }

    // 5. Initialize listeners
    document.addEventListener('DOMContentLoaded', function() {
        initVisualElements();

        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('click', handleElementClick, true);
    });

    // 6. Parent window message listener for real-time live preview update
    window.addEventListener('message', function(event) {
        if (!event.data) return;

        // Toggle Element Picker Mode
        if (event.data.action === 'khd_toggle_picker') {
            isPickerActive = !!event.data.active;
            initVisualElements();
            if (!isPickerActive) {
                if (highlightOverlay) highlightOverlay.style.display = 'none';
                if (tooltip) tooltip.style.display = 'none';
                if (quickEditPopup) {
                    quickEditPopup.remove();
                    quickEditPopup = null;
                }
            }
            return;
        }

        // Live preview settings update (Global, Typography, spacing, sorting, etc.)
        if (event.data.action === 'khd_preview_update') {
            var settings = event.data.settings;
            if (!settings) return;

            // Apply global CSS Variables properties
            if (settings.global) {
                document.documentElement.style.setProperty('--brand-blue', settings.global.primary_color, 'important');
                document.documentElement.style.setProperty('--tw-color-brand-blue', settings.global.primary_color, 'important');
                document.documentElement.style.setProperty('--brand-cyan', settings.global.secondary_color, 'important');
                document.documentElement.style.setProperty('--brand-orange', settings.global.accent_color, 'important');
                document.documentElement.style.setProperty('--brand-dark', settings.global.text_color, 'important');
                document.documentElement.style.setProperty('--harmony-primary-color', settings.global.primary_color);
                document.documentElement.style.setProperty('--harmony-secondary-color', settings.global.secondary_color);
                document.documentElement.style.setProperty('--harmony-bg-color', settings.global.bg_color);
                document.documentElement.style.setProperty('--harmony-text-color', settings.global.text_color);
                document.documentElement.style.setProperty('--harmony-accent-color', settings.global.accent_color);
                document.documentElement.style.setProperty('--harmony-font-family', "'" + settings.global.font_family + "', sans-serif");
                document.documentElement.style.setProperty('--harmony-border-radius', settings.global.border_radius);
                document.documentElement.style.setProperty('--harmony-container-width', settings.global.container_width);
                document.documentElement.style.setProperty('--harmony-direction', settings.global.direction || 'rtl');
            }

            // Hide/Show and Reorder layouts inside iframe in real-time
            if (settings.sections && Array.isArray(settings.sections)) {
                var mainContainer = document.querySelector('main');
                var heroSec = document.querySelector('.hero');

                settings.sections.forEach(function(sec) {
                    var el = null;
                    if (sec.id === 'hero') {
                        el = heroSec;
                    } else if (sec.id === 'categories') {
                        el = document.querySelector('.kh_categories_block');
                    } else if (sec.id === 'search') {
                        el = document.querySelector('.search-filter-section');
                    } else if (sec.id === 'sea_category') {
                        el = document.querySelector('.sea-category-bar');
                    } else if (sec.id === 'special_offers') {
                        el = document.querySelector('#special-offers');
                    } else if (sec.id === 'weather') {
                        el = document.querySelector('.weather-widget');
                    } else if (sec.id.indexOf('custom_block_') === 0) {
                        el = document.querySelector('.khd-custom-block-dynamic.' + sec.id);
                    } else if (sec.id === 'custom_html_1') {
                        el = document.querySelector('.khd-custom-block-1');
                    } else if (sec.id === 'custom_html_2') {
                        el = document.querySelector('.khd-custom-block-2');
                    }

                    if (el) {
                        if (sec.active) {
                            el.style.setProperty('display', '', 'important');
                            if (mainContainer && el !== heroSec && sec.id !== 'categories') {
                                mainContainer.appendChild(el);
                            }
                        } else {
                            el.style.setProperty('display', 'none', 'important');
                        }
                    }
                });
            }

            // Update dynamic style tags for typography & CSS Selectors immediately
            var liveStyleTag = document.getElementById('khd-live-iframe-style');
            if (!liveStyleTag) {
                liveStyleTag = document.createElement('style');
                liveStyleTag.id = 'khd-live-iframe-style';
                document.head.appendChild(liveStyleTag);
            }

            var css = "";

            // H1 typography
            if (settings.typography && settings.typography.h1) {
                css += "\nh1, .text-5xl, .text-4xl {\n";
                css += "  font-size: " + settings.typography.h1.desktop.size + " !important;\n";
                css += "  font-weight: " + settings.typography.h1.desktop.weight + " !important;\n";
                css += "  line-height: " + settings.typography.h1.desktop.line_height + " !important;\n";
                css += "}\n";
            }

            // Custom selectors
            if (settings.custom_selectors && Array.isArray(settings.custom_selectors)) {
                settings.custom_selectors.forEach(function(sel) {
                    if (sel.selector) {
                        css += "\n" + sel.selector + " {\n";
                        if (sel.color) css += "  color: " + sel.color + " !important;\n";
                        if (sel.bg_color) css += "  background-color: " + sel.bg_color + " !important;\n";
                        if (sel.font_size) css += "  font-size: " + sel.font_size + " !important;\n";
                        if (sel.padding) css += "  padding: " + sel.padding + " !important;\n";
                        if (sel.margin) css += "  margin: " + sel.margin + " !important;\n";
                        if (sel.border_radius) css += "  border-radius: " + sel.border_radius + " !important;\n";
                        css += "}\n";
                    }
                });
            }

            // Free custom CSS
            if (settings.custom_css) {
                css += "\n" + settings.custom_css;
            }

            liveStyleTag.innerHTML = css;
        }
    });
})();
