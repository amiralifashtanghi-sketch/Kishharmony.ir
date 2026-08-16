<?php
/**
 * Kish Harmony Front Page Template
 */

get_header();

$builder = Kish_Layout_Builder::get_instance();
$sections = $builder->get_sections();

// Filter out footer from main loop since get_footer() renders it
unset($sections['footer']);

// Sort sections by 'order'
uasort($sections, function($a, $b) {
    return ($a['order'] ?? 10) <=> ($b['order'] ?? 10);
});

foreach ($sections as $section_id => $config) {
    if (!empty($config['enabled'])) {
        $builder->render_section($section_id);
    }
}

get_footer();
