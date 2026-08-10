/**
 * Listen for admin-script live settings update and apply to the preview Iframe without reloading
 */
window.addEventListener('message', function(event) {
    if (event.data && event.data.action === 'khd_preview_update') {
        var settings = event.data.settings;
        if (!settings) return;

        // 1. Apply root dynamic properties
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
        }

        // 2. Hide/Show and Reorder layouts inside iframe in real-time
        if (settings.sections && Array.isArray(settings.sections)) {
            var mainContainer = document.querySelector('main');
            var heroSec = document.querySelector('.hero');

            // Loop and arrange blocks
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
                } else if (sec.id === 'custom_html_1') {
                    el = document.querySelector('.khd-custom-block-1');
                } else if (sec.id === 'custom_html_2') {
                    el = document.querySelector('.khd-custom-block-2');
                }

                if (el) {
                    if (sec.active) {
                        el.style.setProperty('display', '', 'important');
                        // Optional sorting logic can append to main container safely
                        if (mainContainer && el !== heroSec && sec.id !== 'categories') {
                            mainContainer.appendChild(el);
                        }
                    } else {
                        el.style.setProperty('display', 'none', 'important');
                    }
                }
            });
        }

        // 3. Update dynamic style tags for typography & CSS Selectors immediately
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
