<?php
function add_theme_styles()
{
	include(locate_template('theme-styles.php'));
}
add_action('wp_head', 'add_theme_styles');

include(locate_template('shortcodes.php'));
include(locate_template('includes/editor-sections.php'));


/**
 * Carbon Fields - powers the editable fields of each section.
 * Installed with composer, so the library lives in the theme itself.
 */
function boot_carbon_fields()
{
	if (!file_exists(get_template_directory() . '/vendor/autoload.php')) {
		return;
	}
	require_once get_template_directory() . '/vendor/autoload.php';
	\Carbon_Fields\Carbon_Fields::boot();
}
add_action('after_setup_theme', 'boot_carbon_fields');

/**
 * The language of everything the theme adds to the admin panel: field labels, tabs, help text, block titles,
 * menu locations, the Customizer. It follows Settings > General > Site Language, Ukrainian when that is uk and
 * English for every other language. It is not the language of the pages: that is get_translation_data().
 */
function admin_language()
{
	return 0 === strpos(get_locale(), 'uk') ? 'ukrainian' : 'english';
}

/**
 * Admin panel text in the site language. The English text is written in the code and is the key, the Ukrainian
 * is in includes/admin-translations.php, so a definition still reads in English. A text with no translation
 * stays English. Use sprintf() around it for a text that carries a link or a number: put %s in the text.
 */
function admin_text($english)
{
	static $ukrainian = null;
	if ('ukrainian' !== admin_language()) {
		return $english;
	}
	if (null === $ukrainian) {
		$ukrainian = include(get_template_directory() . '/includes/admin-translations.php');
	}
	return isset($ukrainian[$english]) ? $ukrainian[$english] : $english;
}

/**
 * Carbon Fields ships Ukrainian for its own interface but not for the default name of a repeater row, which
 * it puts in the "Add ..." button of every complex field that has no setup_labels(). Without this the button
 * reads "Додати Entry".
 */
function theme_carbon_fields_labels($translation, $text)
{
	return in_array($text, array('Entry', 'Entries'), true) ? admin_text($text) : $translation;
}
add_filter('gettext_carbon-fields', 'theme_carbon_fields_labels', 10, 2);

function register_theme_fields()
{
	include(locate_template('includes/theme-options.php'));
	include(locate_template('includes/section-blocks.php'));
}
add_action('carbon_fields_register_fields', 'register_theme_fields');

/**
 * Placeholder images ship inside the theme, not in the media library, so Carbon Fields finds no
 * attachment for their URL and shows an image field with no preview even though it holds a value.
 * Flag theme images as found so the field shows their thumbnail and file name.
 */
function theme_image_field_preview($metadata)
{
	$theme_images = get_template_directory_uri() . '/images/';
	if (!empty($metadata['thumb_url']) && strpos($metadata['thumb_url'], $theme_images) === 0) {
		$metadata['id'] = -1;
		$metadata['file_name'] = wp_basename($metadata['thumb_url']);
		$metadata['file_type'] = 'image';
	}
	return $metadata;
}
add_filter('carbon_fields_attachment_not_found_metadata', 'theme_image_field_preview');

/**
 * Reads a section field. Keeps the templates flat.
 *
 * Every field belongs to a section block (includes/section-blocks.php), which carries its placeholder
 * content as field defaults, so a template calls section_field('crb_x_y') with no default and an
 * emptied field simply hides its element. Inside a block the value is the block's own. A shortcode
 * typed by hand renders the block's placeholder content. $default is only returned for a field no
 * block owns, which is the case when Carbon Fields is missing.
 */
function section_field($name, $default = '')
{
	$block_values = section_block_fields();
	if ($block_values === null) {
		$block_values = section_block_defaults_for($name);
	}
	if ($block_values === null) {
		return $default;
	}
	$value = array_key_exists($name, $block_values) ? $block_values[$name] : $default;
	return is_string($value) ? trim($value) : $value;
}

/**
 * SECTIONS BUILT AS BLOCKS
 *
 * A section with fields is a Carbon Fields block (includes/section-blocks.php): the client edits
 * its fields inside the block, and the block renders by running the section's shortcode. These
 * helpers hand the block's values to the template. A section with no block there has no fields yet.
 *
 * section_block_fields() holds the values of the block being rendered right now, or null outside one.
 * Pass values to set them (the previous ones come back, so renders can nest), null to clear.
 */
function section_block_fields($set = false)
{
	static $current = null;
	if ($set !== false) {
		$previous = $current;
		$current = $set;
		return $previous;
	}
	return $current;
}

/**
 * Carbon Fields names the block after the shortcode: home_banner -> carbon-fields/home-banner.
 */
function section_block_name($shortcode)
{
	return 'carbon-fields/' . str_replace('_', '-', $shortcode);
}

/**
 * The placeholder content of a section block. Carbon Fields registers every field default as the
 * block attribute default, so the registry is the one place the demo copy is written down.
 */
function section_block_defaults($shortcode)
{
	$type = WP_Block_Type_Registry::get_instance()->get_registered(section_block_name($shortcode));
	return ($type && isset($type->attributes['data']['default'])) ? $type->attributes['data']['default'] : array();
}

/**
 * The block defaults that hold a given field, or null when no block owns it. This is what lets
 * [home_banner] typed by hand render the placeholder content instead of nothing.
 */
function section_block_defaults_for($name)
{
	static $owners = null;
	if ($owners === null) {
		$owners = array();
		foreach (WP_Block_Type_Registry::get_instance()->get_all_registered() as $type) {
			if (strpos($type->name, 'carbon-fields/') !== 0 || !isset($type->attributes['data']['default'])) {
				continue;
			}
			foreach ($type->attributes['data']['default'] as $key => $value) {
				$owners[$key] = $type->attributes['data']['default'];
			}
		}
	}
	return isset($owners[$name]) ? $owners[$name] : null;
}

/**
 * Renders a section block by running its shortcode with the block's field values in scope. Values the
 * block does not carry yet (a field added after the page was saved) fall back to the placeholder, the
 * same thing the editor shows for them.
 */
function render_section_block($shortcode, $fields = array())
{
	$previous = section_block_fields(array_merge(section_block_defaults($shortcode), (array) $fields));
	$html = do_shortcode('[' . $shortcode . ']');
	section_block_fields($previous);
	return $html;
}

/**
 * Does the page open with the hero section? The site header floats over the hero image, so the header
 * is see-through only there. Everywhere else it is solid and the page content starts below it, which is
 * what the has-hero body class switches (see the Header rules in theme-styles.php).
 */
function page_has_hero()
{
	static $has = null;
	if ($has === null) {
		$post = is_singular() ? get_post() : null;
		$has = $post && (has_block('carbon-fields/home-banner', $post) || has_shortcode($post->post_content, 'home_banner'));
	}
	return $has;
}

function theme_body_classes($classes)
{
	if (page_has_hero()) {
		$classes[] = 'has-hero';
	}
	return $classes;
}
add_filter('body_class', 'theme_body_classes');

/**
 * THEME OPTIONS
 *
 * The site wide settings under Theme Options in the admin: contact details, the header and the footer
 * (includes/theme-options.php). A value is read only through theme_option(), and a template prints an
 * element only after checking that its option is filled in, so an empty option leaves no trace in the
 * markup, not even its wrapper. There is no demo mode here: an option nobody filled in is simply absent.
 * The logo is the one exception, it carries the design's placeholder until the options are first saved.
 *
 * Returns the trimmed text, the rows of a repeater as an array, or an empty string when the option is
 * empty or Carbon Fields is missing.
 */
function theme_option($name)
{
	static $cache = array();
	if (!function_exists('carbon_get_theme_option')) {
		return '';
	}
	if (!array_key_exists($name, $cache)) {
		$value = carbon_get_theme_option($name);
		$cache[$name] = is_string($value) ? trim($value) : ($value ? $value : '');
	}
	return $cache[$name];
}

/**
 * Is a field value worth printing? PHP treats "0" as empty, which would hide a card that really shows 0,
 * so numbers go through this instead of a plain if(). Strings count once trimmed.
 */
function is_filled($value)
{
	if (is_string($value)) {
		$value = trim($value);
	}
	return !($value === '' || $value === null || $value === false || $value === array());
}

/**
 * A whole number from 0 to 100 out of whatever the client typed, for progress rings and bars.
 */
function clamp_percent($value)
{
	return max(0, min(100, (int) preg_replace('/\D/', '', (string) $value)));
}

/**
 * The rows of a repeater that have every one of the given subfields filled in. A row missing one of
 * them is dropped, so a label without a link or a link without a label never reaches the page.
 * Wrap the printing in if(filled_rows(...)) too, so an all-empty repeater prints no wrapper either.
 */
function filled_rows($rows, $required)
{
	$filled = array();
	foreach ((array) $rows as $row) {
		foreach ((array) $required as $subfield) {
			if (!isset($row[$subfield]) || !is_filled($row[$subfield])) {
				continue 2;
			}
		}
		$filled[] = $row;
	}
	return $filled;
}

function theme_option_rows($name, $required)
{
	return filled_rows(theme_option($name), $required);
}

/**
 * The tel: link for the phone number in Theme Options > Contact Information, or an empty string when the
 * number is empty or holds no digits. The number is shown as written, the link keeps only + and the digits.
 */
function theme_phone_href()
{
	$digits = preg_replace('/[^\d+]/', '', theme_option('crb_options_phone'));
	return strlen(preg_replace('/\D/', '', $digits)) >= 3 ? 'tel:' . $digits : '';
}

/**
 * The menu assigned to a location (Appearance > Menus > Menu Settings > Menu location), or an empty
 * string when none is assigned or the assigned menu has no items, so an empty menu prints no wrapper.
 * The header and footer menus are flat, so only the top level is printed.
 */
function theme_menu($location, $class)
{
	if (!has_nav_menu($location)) {
		return '';
	}
	$html = wp_nav_menu(array(
		'theme_location' => $location,
		'container' => false,
		'menu_class' => $class,
		'depth' => 1,
		'fallback_cb' => false,
		'echo' => false,
	));
	return ($html && strpos($html, '<li') !== false) ? $html : '';
}

/**
 * Inline SVG icons, one map for the whole theme, drawn on a 24x24 grid with currentColor. Print one
 * with theme_icon('arrow-r') and size it with the section's own CSS. Add an icon here and nothing
 * else changes. social_networks() below is the same idea for the brand marks.
 */
function theme_icons()
{
	return array(
		'arrow-ur' => '<path d="M7 17L17 7M8 7h9v9"/>',
		'arrow-r' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'check' => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
		'plus' => '<path d="M12 5v14M5 12h14"/>',
		'minus' => '<path d="M5 12h14"/>',
		'menu' => '<path d="M4 8h16M4 16h16"/>',
		'close' => '<path d="M6 6l12 12M18 6L6 18"/>',
		'phone' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
		'send' => '<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>',
		'play' => '<path d="M8 5v14l11-7z" fill="currentColor" stroke="none"/>',
		'star' => '<path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1z" fill="currentColor" stroke="none"/>',
		'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
		'clock' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
		'video' => '<rect x="2" y="6" width="14" height="12" rx="2"/><path d="M22 8l-6 4 6 4z"/>',
		'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/>',
		'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
		'pin' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
		'mail' => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/>',
		'target' => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
		'trend' => '<path d="M23 18l-9.5-9.5-5 5L1 6M17 18h6v-6"/>',
		'chat' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
		'insta' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6"/>',
		'yt' => '<rect x="2" y="5" width="20" height="14" rx="4"/><path d="M10 9l5 3-5 3z"/>',
		'download' => '<path d="M12 3v12M7 10l5 5 5-5M4 20h16"/>',
		'flag' => '<path d="M4 22V4M4 4h13l-2 4 2 4H4"/>',
		'bolt' => '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>',
	);
}

function theme_icon($name)
{
	$icons = theme_icons();
	if (!isset($icons[$name])) {
		return '';
	}
	return '<svg class="ico" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $icons[$name] . '</svg>';
}

/**
 * The colours the client is allowed to change, mapped to the :root variables in
 * includes/css/design-system.css. Deliberately partial: --color-bg, --color-inverse and
 * --color-on-cta stay in code, because a dark page background (or a dark button) needs
 * the whole palette rethought rather than one value swapped.
 */
function theme_palette()
{
	return array(
		'color_1' => array('variable' => '--color-1', 'default' => '#0e1607', 'label' => 'Text and dark sections', 'description' => 'Body text, headings and the dark panels.'),
		'color_2' => array('variable' => '--color-2', 'default' => '#e5f76a', 'label' => 'Accent', 'description' => 'Highlights and active states on dark backgrounds. Dark ink text sits on this colour, so keep it light enough to read against.'),
		'color_cta' => array('variable' => '--color-cta', 'default' => '#f6c516', 'label' => 'Primary button', 'description' => 'The main call to action. Dark ink text sits on it, and it works best as the one loud colour on the page.'),
		'color_green' => array('variable' => '--color-green', 'default' => '#2c7a2f', 'label' => 'Brand green', 'description' => 'Icons and links on light backgrounds.'),
		'color_3' => array('variable' => '--color-3', 'default' => '#56604f', 'label' => 'Muted text', 'description' => 'Intro paragraphs, captions and labels.'),
		'color_surface' => array('variable' => '--color-surface', 'default' => '#e8eee0', 'label' => 'Light section background', 'description' => 'The tinted bands between white sections.'),
		'color_border' => array('variable' => '--color-border', 'default' => '#dde3d5', 'label' => 'Hairlines', 'description' => 'Field outlines and the thin dividers.'),
	);
}

/**
 * Colour pickers under Appearance > Customize > Colours.
 */
function register_theme_colors($wp_customize)
{
	$wp_customize->add_section('theme_colors', array(
		'title' => admin_text('Colours'),
		'priority' => 25,
		'description' => admin_text('The palette the whole site is built from. Every section reuses these, so a change here reaches the entire page.'),
	));

	foreach (theme_palette() as $name => $color) {
		$wp_customize->add_setting($name, array(
			'default' => $color['default'],
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $name, array(
			'label' => admin_text($color['label']),
			'description' => admin_text($color['description']),
			'section' => 'theme_colors',
		)));
	}
}
add_action('customize_register', 'register_theme_colors');

/**
 * A second :root block holding only the colours the client actually changed.
 * Printed at the end of theme-styles.php, so it wins on source order without
 * touching the palette the theme ships with.
 */
function palette_overrides()
{
	$rules = '';
	foreach (theme_palette() as $name => $color) {
		$value = get_theme_mod($name);
		if (!$value || $value === $color['default']) {
			continue;
		}
		$rules .= $color['variable'] . ': ' . $value . '; ';
	}
	return $rules ? ':root{' . trim($rules) . '}' : '';
}

/**
 * Renders a form the client pasted into a section as a shortcode.
 * The theme ships no form of its own - any form plugin will do - so this only
 * expands whatever tag is in the field. If the plugin is gone do_shortcode()
 * hands the tag straight back, and printing a raw [tag] on the page would be
 * worse than printing nothing.
 */
function section_form($name)
{
	return render_form_shortcode(section_field($name));
}

/**
 * The same for a form pasted into Theme Options, for example the footer newsletter form.
 */
function theme_form($name)
{
	return render_form_shortcode(theme_option($name));
}

function render_form_shortcode($shortcode)
{
	if (!$shortcode) {
		return '';
	}
	$rendered = do_shortcode($shortcode);
	return $rendered === $shortcode ? '' : $rendered;
}

/**
 * English and Ukrainian live on two separate pages, linked manually in the
 * admin's Custom Fields box: has_translation on the English page holds the
 * Ukrainian page ID, is_translation on the Ukrainian page holds the English
 * page ID. Each page keeps its own Carbon Fields content in its own
 * language - this only establishes the relationship between the two pages
 * and is used to pick the right hardcoded UI text (CTA, footer, 404/search
 * strings) and to build the language switcher links.
 */
function get_translation_data()
{
	$current_id = get_the_ID();
	$is_translation = $current_id ? get_post_meta($current_id, 'is_translation', true) : '';

	if ($is_translation) {
		return array(
			'language' => 'ukrainian',
			'english_page' => $is_translation,
			'translated_page' => $current_id,
		);
	}

	return array(
		'language' => 'english',
		'english_page' => $current_id,
		'translated_page' => $current_id ? get_post_meta($current_id, 'has_translation', true) : '',
	);
}

/**
 * The social networks a section can offer. One place for the label, the icon and
 * the admin option list, so a new network is added here and nowhere else.
 * Icons are inline SVG using currentColor, sized by the section's own CSS.
 */
function social_networks()
{
	return array(
		'instagram' => array(
			'label' => 'Instagram',
			'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1.2" fill="currentColor" stroke="none"/></svg>',
		),
		'linkedin' => array(
			'label' => 'LinkedIn',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3zM9 9h3.8v1.7h.05c.53-.95 1.83-1.95 3.77-1.95 4.03 0 4.78 2.5 4.78 5.76V21h-4v-5.6c0-1.34-.03-3.07-1.9-3.07-1.9 0-2.2 1.46-2.2 2.97V21H9z"/></svg>',
		),
		'facebook' => array(
			'label' => 'Facebook',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.25-1.5 1.55-1.5h1.65V3.6c-.29-.04-1.27-.12-2.41-.12-2.39 0-4.02 1.46-4.02 4.13V9.9H7.5V13h2.77v8z"/></svg>',
		),
		'x' => array(
			'label' => 'X',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.53 3H20.5l-6.49 7.42L21.5 21h-5.9l-4.62-6.04L5.7 21H2.72l6.94-7.93L2.5 3h6.05l4.18 5.52zm-1.04 16.2h1.65L7.6 4.72H5.83z"/></svg>',
		),
		'youtube' => array(
			'label' => 'YouTube',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 12s0-3.4-.43-5.03a2.6 2.6 0 0 0-1.83-1.84C19.1 4.7 12 4.7 12 4.7s-7.1 0-8.74.43c-.9.24-1.6.95-1.83 1.84C1 8.6 1 12 1 12s0 3.4.43 5.03c.24.9.94 1.6 1.83 1.84 1.64.43 8.74.43 8.74.43s7.1 0 8.74-.43a2.6 2.6 0 0 0 1.83-1.84C23 15.4 23 12 23 12zM9.75 15.02V8.98L15.5 12z"/></svg>',
		),
		'telegram' => array(
			'label' => 'Telegram',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.9 4.3 18.8 19c-.23 1.03-.85 1.28-1.72.8l-4.76-3.5-2.3 2.21c-.25.26-.47.47-.96.47l.34-4.85 8.84-7.99c.38-.34-.09-.53-.6-.19L6.7 12.3 1.99 10.8c-1.02-.32-1.04-1.02.21-1.51L20.6 2.77c.85-.31 1.6.2 1.3 1.53z"/></svg>',
		),
		'tiktok' => array(
			'label' => 'TikTok',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M16.5 3c.4 2.3 1.9 3.8 4.5 4v3c-1.6 0-3.1-.5-4.4-1.4v6.7a5.7 5.7 0 1 1-5.7-5.7c.3 0 .6 0 .9.1v3.1a2.6 2.6 0 1 0 1.8 2.5V3z"/></svg>',
		),
		'whatsapp' => array(
			'label' => 'WhatsApp',
			'icon' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.5 15.2L2 22l4.9-1.5A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.9.9.9-2.8-.2-.3A8 8 0 1 1 12 20zm4.4-5.9c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.6.8-.8 1-.1.2-.3.2-.5.1-.2-.1-1-.4-1.9-1.2-.7-.6-1.2-1.4-1.3-1.6-.1-.2 0-.4.1-.5.1-.1.2-.3.4-.4.1-.1.2-.2.2-.4.1-.1 0-.3 0-.4 0-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2.9 2.4c.1.2 1.6 2.5 4 3.5.6.2 1 .4 1.3.5.6.2 1.1.2 1.5.1.5-.1 1.4-.6 1.6-1.1.2-.5.2-1 .1-1.1-.1-.1-.2-.2-.4-.3z"/></svg>',
		),
	);
}

function social_icon($network)
{
	$networks = social_networks();
	return isset($networks[$network]) ? $networks[$network]['icon'] : '';
}

function social_label($network)
{
	$networks = social_networks();
	return isset($networks[$network]) ? $networks[$network]['label'] : $network;
}

/**
 * Option list for the network select in includes/theme-options.php.
 */
function social_network_options()
{
	$options = array();
	foreach (social_networks() as $key => $network) {
		$options[$key] = $network['label'];
	}
	return $options;
}

/**
 * Disable the emoji's
 */
function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

		$urls = array_diff($urls, array($emoji_svg_url));
	}

	return $urls;
}

function smartwp_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);


add_action('after_setup_theme', 'add_theming_support');
function add_theming_support()
{
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
     * Let WordPress manage the document title.
     * This theme does not use a hard-coded <title> tag in the document head,
     * WordPress will provide it for us.
     */
	add_theme_support('title-tag');

	/**
	 * Add post-formats support.
	 */
	add_theme_support(
		'post-formats',
		array(
			'link',
			'aside',
			'gallery',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		)
	);
	/*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1568, 9999);

	// Logo is set in Appearance > Customize > Site Identity; falls back to the site name.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*Each location becomes a "Menu location" checkbox under Menu Settings when a menu is created or edited in Appearance > Menus*/
	register_nav_menus(
		array(
			'header' => admin_text('Header'),
			'footer' => admin_text('Footer'),
		)
	);
	/*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	// Add support for Block Styles.
	add_theme_support('wp-block-styles');
	// Add support for responsive embedded content.
	add_theme_support('responsive-embeds');

	// Add support for custom line height controls.
	add_theme_support('custom-line-height');

	// Add support for experimental link color control.
	add_theme_support('experimental-link-color');

	// Add support for experimental cover block spacing.
	add_theme_support('custom-spacing');

	// Add support for custom units.
	// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
	add_theme_support('custom-units');

	// Remove feed icon link from legacy RSS widget.
	add_filter('rss_widget_feed_link', '__return_false');
}

function my_excerpt_length($length)
{
	return 25;
}
add_filter('excerpt_length', 'my_excerpt_length');

function new_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function tgm_io_shortcode_empty_paragraph_fix($content)
{
	$array = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']'
	);
	return strtr($content, $array);
}
add_filter('the_content', 'tgm_io_shortcode_empty_paragraph_fix');

function add_theme_changes()
{
	include(locate_template('includes/theme-changes.php'));
}
add_action('wp_footer', 'add_theme_changes');

// change src to data-url if any in the content, so the lazy loader in includes/theme-changes.php picks it up.
// Blocks render before this filter runs (shortcodes after), so a block's images arrive here too.
// An image marked loading="eager" is above the fold and keeps its src, so it is never held back.
add_filter('the_content', 'filter_url');
function filter_url($content)
{
	return preg_replace_callback('/<[a-z][^>]*\bsrc="[^>]*>/i', function ($tag) {
		return strpos($tag[0], 'loading="eager"') === false ? str_replace('src="', 'data-url="', $tag[0]) : $tag[0];
	}, $content);
}

// disable srcset on frontend
function disable_wp_responsive_images()
{
	return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');

//disable lazyloading of images
add_filter('wp_lazy_loading_enabled', '__return_false');

// Removes the decoding attribute from images added inside post content.
add_filter('wp_img_tag_add_decoding_attr', '__return_false');

// Remove the decoding attribute from featured images and the Post Image block.
add_filter('wp_get_attachment_image_attributes', function ($attributes) {
	unset($attributes['decoding']);
	return $attributes;
});

function add_theme_fonts()
{
	$fonts_css_version = filemtime(get_template_directory() . '/fonts/site-fonts.css');
?>
	<link rel="preload" as="style" href="<?= get_template_directory_uri(); ?>/fonts/site-fonts.css?ver=<?= $fonts_css_version; ?>">
	<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/fonts/site-fonts.css?ver=<?= $fonts_css_version; ?>">
	<link rel="preload" as="font" type="font/woff2" href="<?= get_template_directory_uri(); ?>/fonts/bricolage-grotesque/latin.woff2" crossorigin>
	<link rel="preload" as="font" type="font/woff2" href="<?= get_template_directory_uri(); ?>/fonts/urbanist/latin.woff2" crossorigin>
<?php }
add_action('wp_head', 'add_theme_fonts');

/**
 * Replace Formidable Forms' default invalid submission message with the
 * Ukrainian version used by the contact form. Limited to form ID 3 so other
 * Formidable forms keep their default validation message.
 */
function irchansky_change_invalid_error_message($invalid_msg, $args)
{
	if (empty($args['form']->id)) {
		return $invalid_msg;
	}

	if (3 !== (int) $args['form']->id) {
		return $invalid_msg;
	}

	return 'Будь ласка, перевірте обов\'язкові поля.';
}
add_filter('frm_invalid_error_message', 'irchansky_change_invalid_error_message', 10, 2);
