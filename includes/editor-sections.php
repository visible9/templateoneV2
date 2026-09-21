<?php

/**
 * Puts the theme's sections in the block editor's inserter, as their own
 * "Page Sections" category, so the client can browse and insert them instead
 * of typing shortcode tags by hand. yk4_editor_sections() lists every shortcode once.
 *
 * A section that has a Carbon Fields block (includes/section-blocks.php) is "native": its fields are
 * edited inside the block itself. Carbon Fields registers that block, so this file only decorates it:
 * the wireframe icon, the single-instance rule and the canvas styles. Adding a Block::make() there is
 * all it takes, nothing here needs to change.
 *
 * A section with no block there has no fields yet. It becomes a tiny custom block (yk4/home-about, ...)
 * whose save() writes out nothing but the plain shortcode text - [home_about] - and whose editor view
 * tells the builder to add the required fields to the theme.
 */

/**
 * Small wireframe icons, one shape per layout pattern and reused wherever two
 * sections read the same way (Home About and the About page's own About both
 * use "split"). Same drawing convention as social_networks() in
 * functions.php: 24x24 viewBox, currentColor, no fill unless noted.
 */
function yk4_section_icon_shapes()
{
	return array(
		'hero' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="3.5" width="19" height="17" rx="2"/><line x1="7" y1="9" x2="17" y2="9"/><line x1="6" y1="13" x2="18" y2="13"/><rect x="9" y="16" width="6" height="2.6" rx="1" fill="currentColor" stroke="none"/></svg>',
		'hero-cards' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="3.5" width="19" height="17" rx="2.5"/><line x1="5.5" y1="7.5" x2="12" y2="7.5"/><line x1="5.5" y1="10.5" x2="9.5" y2="10.5"/><rect x="5.5" y="15" width="4.6" height="2.2" rx="1.1" fill="currentColor" stroke="none"/><rect x="13.2" y="10" width="3.3" height="3.3" rx="1"/><rect x="17.1" y="10" width="3.3" height="3.3" rx="1"/><rect x="13.2" y="14.3" width="7.2" height="3.3" rx="1" fill="currentColor" fill-opacity=".25"/></svg>',
		'split' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="4" width="8.5" height="16" rx="1.5" fill="currentColor" fill-opacity=".2"/><line x1="13.5" y1="8" x2="21.5" y2="8"/><line x1="13.5" y1="12" x2="20" y2="12"/><line x1="13.5" y1="16" x2="21.5" y2="16"/></svg>',
		'split-form' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><line x1="2.5" y1="7" x2="9.5" y2="7"/><line x1="2.5" y1="11" x2="10.5" y2="11"/><line x1="2.5" y1="15" x2="8" y2="15"/><rect x="13" y="4" width="8.5" height="3" rx="1"/><rect x="13" y="9" width="8.5" height="3" rx="1"/><rect x="13" y="14" width="8.5" height="3" rx="1" fill="currentColor" fill-opacity=".2"/></svg>',
		'tags' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="4" width="4.5" height="2.4" rx="1"/><line x1="9" y1="5.2" x2="19" y2="5.2"/><rect x="2.5" y="11" width="4.5" height="2.4" rx="1"/><line x1="9" y1="12.2" x2="21.5" y2="12.2"/><rect x="2.5" y="18" width="4.5" height="2.4" rx="1"/><line x1="9" y1="19.2" x2="17" y2="19.2"/></svg>',
		'heading-grid' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><line x1="2.5" y1="4.5" x2="12" y2="4.5"/><line x1="2.5" y1="7.5" x2="8" y2="7.5"/><line x1="16.5" y1="6" x2="21.5" y2="6"/><rect x="2.5" y="11" width="5.5" height="4" rx="1"/><rect x="9.25" y="11" width="5.5" height="4" rx="1" fill="currentColor" fill-opacity=".2"/><rect x="16" y="11" width="5.5" height="4" rx="1"/><rect x="2.5" y="16.5" width="5.5" height="4" rx="1"/><rect x="9.25" y="16.5" width="5.5" height="4" rx="1"/><rect x="16" y="16.5" width="5.5" height="4" rx="1"/></svg>',
		'grid' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="5" width="5.5" height="14" rx="1"/><rect x="9.5" y="5" width="5.5" height="14" rx="1"/><rect x="16.5" y="5" width="5.5" height="14" rx="1"/></svg>',
		'columns' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="8" width="5.5" height="11" rx="1"/><rect x="9.5" y="3.5" width="5.5" height="15.5" rx="1" fill="currentColor" fill-opacity=".2"/><rect x="16.5" y="8" width="5.5" height="11" rx="1"/></svg>',
		'gallery' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="3.5" width="8.5" height="8" rx="1"/><rect x="13" y="3.5" width="8.5" height="8" rx="1"/><rect x="2.5" y="13.5" width="8.5" height="7" rx="1"/><rect x="13" y="13.5" width="8.5" height="7" rx="1"/></svg>',
		'cards' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.2" y="5" width="5.8" height="14" rx="1"/><rect x="3.1" y="6" width="4" height="3.4" fill="currentColor" fill-opacity=".2" stroke="none"/><rect x="9.1" y="5" width="5.8" height="14" rx="1"/><rect x="10" y="6" width="4" height="3.4" fill="currentColor" fill-opacity=".2" stroke="none"/><rect x="16" y="5" width="5.8" height="14" rx="1"/><rect x="16.9" y="6" width="4" height="3.4" fill="currentColor" fill-opacity=".2" stroke="none"/></svg>',
		'stats' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><line x1="2.5" y1="20" x2="21.5" y2="20"/><rect x="4" y="12" width="3.4" height="6" fill="currentColor" stroke="none"/><rect x="10.3" y="7" width="3.4" height="11" fill="currentColor" stroke="none"/><rect x="16.6" y="10" width="3.4" height="8" fill="currentColor" stroke="none"/></svg>',
		'avatars' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="6" cy="8" r="3"/><line x1="3" y1="17" x2="9" y2="17"/><circle cx="16" cy="8" r="3" fill="currentColor" fill-opacity=".2"/><line x1="13" y1="17" x2="19" y2="17"/></svg>',
		'strip' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><line x1="2.5" y1="12" x2="21.5" y2="12"/><circle cx="5" cy="12" r="2.2" fill="currentColor" stroke="none"/><circle cx="12" cy="12" r="2.2" fill="currentColor" stroke="none"/><circle cx="19" cy="12" r="2.2" fill="currentColor" stroke="none"/></svg>',
		'quote' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"><path d="M5 8c-1.7 0-3 1.3-3 3s1.3 3 3 3c0 1.8-1.2 3-3 3"/><path d="M15 8c-1.7 0-3 1.3-3 3s1.3 3 3 3c0 1.8-1.2 3-3 3"/></svg>',
		'cta' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="4" width="19" height="16" rx="2" fill="currentColor" fill-opacity=".12"/><line x1="7.5" y1="10" x2="16.5" y2="10"/><rect x="9" y="13.5" width="6" height="2.6" rx="1" fill="currentColor" stroke="none"/></svg>',
		'accordion' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="3.5" width="19" height="4.6" rx="1" fill="currentColor" fill-opacity=".2"/><rect x="2.5" y="9.7" width="19" height="4.6" rx="1"/><rect x="2.5" y="15.9" width="19" height="4.6" rx="1"/><line x1="18.3" y1="12" x2="20.3" y2="12"/></svg>',
	);
}

/**
 * Every section shortcode, keyed by tag: the title, description and icon shape shown in the inserter.
 */
function yk4_editor_sections()
{
	return array(
		'home_banner' => array('title' => 'Hero', 'description' => 'A full screen hero with a background image: headline, buttons, social proof and three highlight cards.', 'shape' => 'hero-cards'),
		'home_audience' => array('title' => 'Who it\'s for', 'description' => 'A heading with an intro and tags above a grid of numbered cards.', 'shape' => 'heading-grid'),
		'home_about' => array('title' => 'About', 'description' => 'Intro text next to an image, with optional stats.', 'shape' => 'split'),
		'home_mission' => array('title' => 'Mission', 'description' => 'A heading and intro above a set of tagged items.', 'shape' => 'tags'),
		'home_services' => array('title' => 'Services', 'description' => 'A grid of service cards.', 'shape' => 'grid'),
		'home_pricing' => array('title' => 'Pricing', 'description' => 'A row of pricing packages.', 'shape' => 'columns'),
		'home_portfolio' => array('title' => 'Portfolio', 'description' => 'A gallery grid of project tiles with a lightbox.', 'shape' => 'gallery'),
		'home_news' => array('title' => 'News', 'description' => 'The latest blog posts as cards.', 'shape' => 'cards'),
		'home_results' => array('title' => 'Results', 'description' => 'A row of count-up metrics.', 'shape' => 'stats'),
		'home_team' => array('title' => 'Team', 'description' => 'A grid of team member cards with social links.', 'shape' => 'avatars'),
		'home_social' => array('title' => 'Social', 'description' => 'A strip linking out to social profiles.', 'shape' => 'strip'),
		'home_testimonials' => array('title' => 'Testimonials', 'description' => 'A slider of client quotes.', 'shape' => 'quote'),
		'home_cta' => array('title' => 'Call To Action', 'description' => 'A centred banner with a heading and a button.', 'shape' => 'cta'),
		'home_faq' => array('title' => 'FAQ', 'description' => 'An accordion of questions and answers.', 'shape' => 'accordion'),
		'home_contact' => array('title' => 'Contact', 'description' => 'Contact details next to a pasted-in form.', 'shape' => 'split-form'),
		'about_rev' => array('title' => 'About (About Page)', 'description' => 'The About page\'s own version of the About section.', 'shape' => 'split'),
	);
}

/**
 * Does the section have its fields, that is a Carbon Fields block registered for it in
 * includes/section-blocks.php? Carbon Fields registers its blocks on init, so this only answers
 * from init priority 10 on: everything that asks runs after that.
 */
function yk4_section_is_native($tag)
{
	return WP_Block_Type_Registry::get_instance()->is_registered(section_block_name($tag));
}

function yk4_editor_section_block_name($tag)
{
	if (yk4_section_is_native($tag)) {
		return section_block_name($tag);
	}
	return 'yk4/' . str_replace('_', '-', $tag);
}

/**
 * yk4_editor_sections() is only real once Carbon Fields is actually booted -
 * without it section_field() always falls back to demo content anyway, so
 * offering these blocks would just insert shortcodes with nothing behind
 * them. Mirrors the function_exists() guard section_field() uses.
 */
function yk4_editor_sections_available()
{
	return function_exists('carbon_get_post_meta') ? yk4_editor_sections() : array();
}

function yk4_register_section_block_category($categories)
{
	if (!yk4_editor_sections_available()) {
		return $categories;
	}
	return array_merge(array(array('slug' => 'yk4-sections', 'title' => admin_text('Page Sections'), 'icon' => null)), $categories);
}
add_filter('block_categories_all', 'yk4_register_section_block_category');

/**
 * Registers one tiny block per section that has no fields yet. Each has supports.multiple => false,
 * which is what disables a section in the inserter once it is already on the
 * page - the same native behaviour a single-instance block like Post Title
 * gets in the site editor. Runs after Carbon Fields has registered the blocks that do have fields.
 */
function yk4_register_section_blocks()
{
	$sections = yk4_editor_sections_available();
	if (!$sections) {
		return;
	}
	foreach ($sections as $tag => $section) {
		if (yk4_section_is_native($tag)) {
			continue;
		}
		register_block_type(yk4_editor_section_block_name($tag), array(
			'title' => admin_text($section['title']),
			'category' => 'yk4-sections',
			'description' => admin_text($section['description']),
			'supports' => array(
				'multiple' => false,
				'html' => false,
				'customClassName' => false,
				'className' => false,
				'reusable' => false,
			),
		));
	}
}
add_action('init', 'yk4_register_section_blocks', 20);

/**
 * A section block registered by Carbon Fields gets the same single-instance rule the tiny blocks above
 * declare. This runs while the block is being registered, so it goes by the block name. The editor script
 * repeats the rule on the client, where Carbon Fields sets its own supports.
 */
function yk4_native_section_block_args($args, $name)
{
	foreach (yk4_editor_sections() as $tag => $section) {
		if (section_block_name($tag) === $name) {
			$args['supports'] = array_merge(isset($args['supports']) ? (array) $args['supports'] : array(), array('multiple' => false, 'reusable' => false));
		}
	}
	return $args;
}
add_filter('register_block_type_args', 'yk4_native_section_block_args', 10, 2);

/**
 * A section is a band as wide as the page, so its block wrapper (the .wp-block element of the block list)
 * spans the editor canvas the way the section spans the page. Without a theme.json the editor caps every
 * block at 840px (edit-post/classic.css), which squeezed the desktop layout of a section into a narrow
 * column while the page shows it at full width. Lifting the cap applies to the wrapper in both modes, the
 * fields form and the Preview. The wrapper keeps the editor's own 8px canvas padding, so it ends 8px short
 * of the canvas edge on each side: pulling it out with negative margins pushes the -8px margin Carbon Fields
 * gives its fields form past the edge and the canvas grows a horizontal scrollbar.
 */
function yk4_editor_canvas_css()
{
	$css = '';
	foreach (yk4_editor_sections() as $tag => $section) {
		if (yk4_section_is_native($tag)) {
			$wrapper = '.editor-styles-wrapper .wp-block[data-type="' . section_block_name($tag) . '"]';
			$css .= $wrapper . '{max-width: none;}' . "\n";
		}
	}
	return $css;
}

/**
 * Puts the design tokens and the shared components into the block editor canvas, so the Preview of a
 * section block looks like the page. Only tokens and component classes go in, never the document
 * level rules of theme-styles.php, which would restyle the fields Carbon Fields draws in the same canvas.
 * enqueue_block_assets is the hook the iframed canvas rebuilds its styles from.
 */
function yk4_enqueue_editor_canvas_styles()
{
	if (!is_admin() || !yk4_editor_sections_available()) {
		return;
	}
	$fonts_path = get_template_directory() . '/fonts/site-fonts.css';
	wp_enqueue_style('yk4-editor-fonts', get_template_directory_uri() . '/fonts/site-fonts.css', array(), file_exists($fonts_path) ? filemtime($fonts_path) : false);
	wp_register_style('yk4-editor-design-system', false);
	wp_enqueue_style('yk4-editor-design-system');
	wp_add_inline_style('yk4-editor-design-system', file_get_contents(get_template_directory() . '/includes/css/design-system.css') . palette_overrides() . yk4_editor_canvas_css());
}
add_action('enqueue_block_assets', 'yk4_enqueue_editor_canvas_styles');

/**
 * The Preview / Edit toggle of a section block is saved with the page, in this post meta field. Its value is a
 * JSON object naming the sections switched away from the mode they open in, for example
 * {"carbon-fields/home-banner":"preview"}, or an empty string when there are none. It is a meta field rather
 * than a block attribute on purpose: the editor script edits it the way the editor edits any field, so the page
 * turns dirty and the Save / Update button lights up, while the toggle stays out of the undo history.
 */
function yk4_section_view_modes_meta_key()
{
	return '_yk4_section_view_modes';
}

/**
 * Turns what was stored, or what the editor sent, into a clean map of block name => 'preview' or 'edit'.
 * Only Carbon Fields block names and the two known modes get through. The map is sorted by name, so the same
 * choices always give the same string: the editor compares it with the saved one to decide whether the page
 * has changed.
 */
function yk4_clean_section_view_modes($value)
{
	$modes = is_string($value) ? json_decode($value, true) : $value;
	$clean = array();
	if (!is_array($modes)) {
		return $clean;
	}
	foreach ($modes as $block => $mode) {
		if (is_string($block) && preg_match('#^carbon-fields/[a-z0-9_-]+$#', $block) && ($mode === 'preview' || $mode === 'edit')) {
			$clean[$block] = $mode;
		}
	}
	ksort($clean);
	return $clean;
}

function yk4_sanitize_section_view_modes($value)
{
	$modes = yk4_clean_section_view_modes($value);
	return $modes ? wp_json_encode($modes, JSON_UNESCAPED_SLASHES) : '';
}

function yk4_can_edit_section_view_modes($allowed, $meta_key, $post_id)
{
	return current_user_can('edit_post', $post_id);
}

/**
 * Registers the field on pages, the post type the sections live on. show_in_rest is what lets the block editor
 * load it with the page and send it back with the page when Save is pressed. The underscore keeps it out of
 * the Custom Fields box, so it needs its own auth callback to be editable through the REST API.
 */
function yk4_register_section_view_modes_meta()
{
	if (!yk4_editor_sections_available()) {
		return;
	}
	register_post_meta('page', yk4_section_view_modes_meta_key(), array(
		'type' => 'string',
		'single' => true,
		'default' => '',
		'show_in_rest' => true,
		'sanitize_callback' => 'yk4_sanitize_section_view_modes',
		'auth_callback' => 'yk4_can_edit_section_view_modes',
	));
}
add_action('init', 'yk4_register_section_view_modes_meta');

/**
 * Editor-only script and styles that give each block above its edit()/save()
 * behaviour - see includes/js/editor-sections.js - and the script that saves a
 * section's Preview / Edit toggle with the page. Limited to page screens,
 * since that is the only post type the sections' fields are registered on.
 */
function yk4_enqueue_section_editor_assets()
{
	$sections = yk4_editor_sections_available();
	if (!$sections) {
		return;
	}
	$screen = get_current_screen();
	if (!$screen || $screen->post_type !== 'page') {
		return;
	}

	$shapes = yk4_section_icon_shapes();
	$data = array();
	foreach ($sections as $tag => $section) {
		$data[] = array(
			'tag' => $tag,
			'name' => yk4_editor_section_block_name($tag),
			'title' => admin_text($section['title']),
			'description' => admin_text($section['description']),
			'icon' => isset($shapes[$section['shape']]) ? $shapes[$section['shape']] : '',
			'native' => yk4_section_is_native($tag),
		);
	}

	$js_path = get_template_directory() . '/includes/js/editor-sections.js';
	$css_path = get_template_directory() . '/includes/css/editor-sections.css';

	wp_enqueue_script(
		'yk4-editor-sections',
		get_template_directory_uri() . '/includes/js/editor-sections.js',
		array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-hooks'),
		file_exists($js_path) ? filemtime($js_path) : false,
		true
	);
	/*
	 * Saves the Preview / Edit toggle of the section blocks with the page, see includes/js/editor-section-view-mode.js.
	 * It needs carbon-fields-blocks, whose store it writes to before the editor mounts a block. The modes saved
	 * with the page are printed here because the editor has not loaded the page yet while the script runs.
	 */
	$view_mode_path = get_template_directory() . '/includes/js/editor-section-view-mode.js';
	wp_enqueue_script(
		'yk4-editor-section-view-mode',
		get_template_directory_uri() . '/includes/js/editor-section-view-mode.js',
		array('carbon-fields-blocks', 'wp-blocks', 'wp-data', 'wp-i18n'),
		file_exists($view_mode_path) ? filemtime($view_mode_path) : false,
		true
	);
	$view_modes = array(
		'metaKey' => yk4_section_view_modes_meta_key(),
		'modes' => (object) yk4_clean_section_view_modes(get_post_meta((int) get_the_ID(), yk4_section_view_modes_meta_key(), true)),
	);
	wp_add_inline_script('yk4-editor-section-view-mode', 'window.yk4SectionViewMode = ' . wp_json_encode($view_modes) . ';', 'before');
	$strings = array(
		'used' => admin_text('Already used on this page — remove the existing one to add it again.'),
		'instructions' => admin_text('Add the required fields to the theme to display and edit them in the WordPress admin and on the website.'),
	);
	wp_add_inline_script('yk4-editor-sections', 'window.yk4EditorSections = ' . wp_json_encode($data) . '; window.yk4EditorStrings = ' . wp_json_encode($strings) . ';', 'before');

	wp_enqueue_style(
		'yk4-editor-sections',
		get_template_directory_uri() . '/includes/css/editor-sections.css',
		array(),
		file_exists($css_path) ? filemtime($css_path) : false
	);
}
add_action('enqueue_block_editor_assets', 'yk4_enqueue_section_editor_assets');
