jQuery(document).ready(function($) {
    // Tab switching mechanism
    $('.khd-tab-btn').on('click', function(e) {
        e.preventDefault();
        var targetTab = $(this).data('tab');

        $('.khd-tab-btn').removeClass('active');
        $(this).addClass('active');

        $('.khd-tab-content').removeClass('active');
        $('#tab-' + targetTab).addClass('active');
    });

    // Make sections sortable (drag & drop layout builder)
    $('.khd-sortable-list').sortable({
        handle: '.khd-sortable-handle',
        update: function(event, ui) {
            triggerLivePreviewUpdate();
        }
    });

    // Active switch change triggers
    $(document).on('change', '.khd-section-toggle', function() {
        triggerLivePreviewUpdate();
    });

    // Standard settings live key-up event to reflect CSS changes instantly in live preview iframe
    $('input, select, textarea').on('input change', function() {
        triggerLivePreviewUpdate();
    });

    // Handle Live preview connection with the template Iframe
    function triggerLivePreviewUpdate() {
        var settings = gatherAllSettings();

        // Post current temporary CSS configs to the preview Iframe for dynamic render
        var previewFrame = document.getElementById('khd-live-preview-iframe');
        if (previewFrame && previewFrame.contentWindow) {
            previewFrame.contentWindow.postMessage({
                action: 'khd_preview_update',
                settings: settings
            }, '*');
        }
    }

    // Collect all inputs from settings page to construct standard JSON configuration array
    function gatherAllSettings() {
        var sections = [];
        $('.khd-sortable-item').each(function() {
            sections.push({
                id: $(this).data('id'),
                name: $(this).find('.khd-section-title-label').text(),
                active: $(this).find('.khd-section-toggle').is(':checked')
            });
        });

        var settings = {
            sections: sections,
            global: {
                primary_color: $('#khd-primary-color').val(),
                secondary_color: $('#khd-secondary-color').val(),
                bg_color: $('#khd-bg-color').val(),
                text_color: $('#khd-text-color').val(),
                accent_color: $('#khd-accent-color').val(),
                font_family: $('#khd-font-family').val(),
                border_radius: $('#khd-border-radius').val(),
                container_width: $('#khd-container-width').val()
            },
            typography: {
                h1: {
                    desktop: { size: $('#khd-h1-size-desktop').val(), weight: $('#khd-h1-weight-desktop').val(), line_height: $('#khd-h1-lh-desktop').val(), letter_spacing: $('#khd-h1-ls-desktop').val() },
                    tablet: { size: $('#khd-h1-size-tablet').val(), weight: $('#khd-h1-weight-tablet').val(), line_height: $('#khd-h1-lh-tablet').val(), letter_spacing: '0px' },
                    mobile: { size: $('#khd-h1-size-mobile').val(), weight: $('#khd-h1-weight-mobile').val(), line_height: $('#khd-h1-lh-mobile').val(), letter_spacing: '0px' }
                },
                h2: {
                    desktop: { size: $('#khd-h2-size-desktop').val(), weight: $('#khd-h2-weight-desktop').val(), line_height: $('#khd-h2-lh-desktop').val(), letter_spacing: '0px' },
                    tablet: { size: $('#khd-h2-size-tablet').val(), weight: $('#khd-h2-weight-tablet').val(), line_height: $('#khd-h2-lh-tablet').val(), letter_spacing: '0px' },
                    mobile: { size: $('#khd-h2-size-mobile').val(), weight: $('#khd-h2-weight-mobile').val(), line_height: $('#khd-h2-lh-mobile').val(), letter_spacing: '0px' }
                },
                body: {
                    desktop: { size: $('#khd-body-size-desktop').val(), weight: $('#khd-body-weight-desktop').val(), line_height: $('#khd-body-lh-desktop').val(), letter_spacing: '0px' },
                    tablet: { size: $('#khd-body-size-tablet').val(), weight: $('#khd-body-weight-tablet').val(), line_height: $('#khd-body-lh-tablet').val(), letter_spacing: '0px' },
                    mobile: { size: $('#khd-body-size-mobile').val(), weight: $('#khd-body-weight-mobile').val(), line_height: $('#khd-body-lh-mobile').val(), letter_spacing: '0px' }
                }
            },
            spacing: {
                hero: {
                    desktop: { padding_top: $('#khd-hero-pt-desktop').val(), padding_bottom: $('#khd-hero-pb-desktop').val(), margin_bottom: $('#khd-hero-mb-desktop').val() },
                    tablet: { padding_top: $('#khd-hero-pt-tablet').val(), padding_bottom: $('#khd-hero-pb-tablet').val(), margin_bottom: $('#khd-hero-mb-tablet').val() },
                    mobile: { padding_top: $('#khd-hero-pt-mobile').val(), padding_bottom: $('#khd-hero-pb-mobile').val(), margin_bottom: $('#khd-hero-mb-mobile').val() }
                },
                search: {
                    desktop: { padding: $('#khd-search-p-desktop').val(), margin_bottom: $('#khd-search-mb-desktop').val() },
                    tablet: { padding: $('#khd-search-p-tablet').val(), margin_bottom: $('#khd-search-mb-tablet').val() },
                    mobile: { padding: $('#khd-search-p-mobile').val(), margin_bottom: $('#khd-search-mb-mobile').val() }
                }
            },
            woocommerce: {
                card_bg: $('#khd-woo-card-bg').val(),
                card_border_radius: $('#khd-woo-card-radius').val(),
                button_bg: $('#khd-woo-btn-bg').val(),
                button_text_color: $('#khd-woo-btn-text').val(),
                show_rating: $('#khd-woo-rating').is(':checked'),
                show_price: $('#khd-woo-price').is(':checked')
            },
            custom_css: $('#khd-custom-css').val(),
            custom_html_1_code: $('#khd-html-1').val(),
            custom_html_2_code: $('#khd-html-2').val(),
            custom_selectors: []
        };

        // Custom selectors
        $('.khd-custom-sel-row').each(function() {
            var sel = $(this).find('.khd-sel-input').val();
            if (sel) {
                settings.custom_selectors.push({
                    selector: sel,
                    color: $(this).find('.khd-sel-color').val(),
                    bg_color: $(this).find('.khd-sel-bg').val(),
                    font_size: $(this).find('.khd-sel-size').val(),
                    padding: $(this).find('.khd-sel-padding').val(),
                    margin: $(this).find('.khd-sel-margin').val(),
                    border_radius: $(this).find('.khd-sel-radius').val()
                });
            }
        });

        return settings;
    }

    // Add Custom CSS Selectors styling row helper
    $('#khd-add-selector-btn').on('click', function(e) {
        e.preventDefault();
        var rowHtml = `
        <div class="khd-custom-sel-row" style="background:#f1f5f9; padding: 15px; border-radius: 8px; margin-bottom: 12px; border: 1px solid #cbd5e1;">
            <div style="display:flex; gap:10px; margin-bottom: 8px;">
                <input type="text" class="khd-sel-input" placeholder="سلکتور CSS مانند .btn-custom یا #my-box" style="flex:2;">
                <button class="button khd-remove-sel-btn" style="background:#ef4444; color:#fff; border:none;">حذف</button>
            </div>
            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:10px;">
                <div>
                    <label style="font-size:11px; display:block; margin-bottom:2px;">رنگ متن</label>
                    <input type="color" class="khd-sel-color" style="width:100%; height:30px;">
                </div>
                <div>
                    <label style="font-size:11px; display:block; margin-bottom:2px;">رنگ پس‌زمینه</label>
                    <input type="color" class="khd-sel-bg" style="width:100%; height:30px;">
                </div>
                <div>
                    <label style="font-size:11px; display:block; margin-bottom:2px;">سایز فونت</label>
                    <input type="text" class="khd-sel-size" placeholder="16px">
                </div>
                <div>
                    <label style="font-size:11px; display:block; margin-bottom:2px;">فاصله داخلی (Padding)</label>
                    <input type="text" class="khd-sel-padding" placeholder="10px">
                </div>
                <div>
                    <label style="font-size:11px; display:block; margin-bottom:2px;">فاصله خارجی (Margin)</label>
                    <input type="text" class="khd-sel-margin" placeholder="0 0 10px 0">
                </div>
                <div>
                    <label style="font-size:11px; display:block; margin-bottom:2px;">گردی گوشه‌ها</label>
                    <input type="text" class="khd-sel-radius" placeholder="12px">
                </div>
            </div>
        </div>
        `;
        $('#khd-custom-selectors-container').append(rowHtml);
    });

    $(document).on('click', '.khd-remove-sel-btn', function(e) {
        e.preventDefault();
        $(this).closest('.khd-custom-sel-row').remove();
        triggerLivePreviewUpdate();
    });

    // Save Settings Event
    $('#khd-save-settings-btn').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var originalText = $btn.text();

        $btn.text('در حال ذخیره...').prop('disabled', true);

        var settings = gatherAllSettings();

        $.ajax({
            url: khdAdmin.ajax_url,
            type: 'POST',
            data: {
                action: 'khd_save_settings',
                nonce: khdAdmin.nonce,
                settings: JSON.stringify(settings)
            },
            success: function(response) {
                $btn.text(originalText).prop('disabled', false);
                if (response.success) {
                    alert(response.data.message);
                    // Reload Iframe on save
                    document.getElementById('khd-live-preview-iframe').contentWindow.location.reload();
                } else {
                    alert('خطا: ' + response.data.message);
                }
            },
            error: function() {
                $btn.text(originalText).prop('disabled', false);
                alert('خطایی در ارتباط با سرور رخ داده است.');
            }
        });
    });

    // Preset import / export helper triggers
    $('#khd-export-btn').on('click', function(e) {
        e.preventDefault();
        var settings = gatherAllSettings();
        var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(settings, null, 2));
        var dlAnchorElem = document.createElement('a');
        dlAnchorElem.setAttribute("href",     dataStr);
        dlAnchorElem.setAttribute("download", "harmony-designer-preset.json");
        dlAnchorElem.click();
    });

    $('#khd-import-btn').on('click', function(e) {
        e.preventDefault();
        var jsonText = prompt('محتوای فایل JSON کپی شده را اینجا قرار دهید:');
        if (jsonText) {
            try {
                var settings = JSON.parse(jsonText);
                applyPresetsToInputs(settings);
                alert('تنظیمات قالب با موفقیت ایمپورت شد! برای اعمال کامل دکمه ذخیره تنظیمات را بزنید.');
                triggerLivePreviewUpdate();
            } catch(err) {
                alert('خطا در خواندن فایل JSON. ساختار نامعتبر است.');
            }
        }
    });

    function applyPresetsToInputs(settings) {
        if (!settings) return;

        // Global styling inputs
        if (settings.global) {
            $('#khd-primary-color').val(settings.global.primary_color);
            $('#khd-secondary-color').val(settings.global.secondary_color);
            $('#khd-bg-color').val(settings.global.bg_color);
            $('#khd-text-color').val(settings.global.text_color);
            $('#khd-accent-color').val(settings.global.accent_color);
            $('#khd-font-family').val(settings.global.font_family);
            $('#khd-border-radius').val(settings.global.border_radius);
            $('#khd-container-width').val(settings.global.container_width);
        }

        // Custom CSS
        if (settings.custom_css) {
            $('#khd-custom-css').val(settings.custom_css);
        }

        // Custom HTML blocks
        if (settings.custom_html_1_code) {
            $('#khd-html-1').val(settings.custom_html_1_code);
        }
        if (settings.custom_html_2_code) {
            $('#khd-html-2').val(settings.custom_html_2_code);
        }
    }
});
