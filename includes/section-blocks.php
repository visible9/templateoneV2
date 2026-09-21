<?php

/**
 * Sections built as Carbon Fields blocks.
 *
 * Each block is one section of the page. The client inserts it from the "Page Sections" category of
 * the block inserter and edits its fields inside the block itself, with a Preview toggle in the
 * block toolbar. The block renders by running the section's shortcode (render_section_block() in
 * functions.php), so the markup still lives in template-parts/sections/ and the shortcode keeps working.
 *
 * Every field carries the placeholder content of the design as its default value, so a block is
 * filled the moment it is inserted, and the templates call section_field('crb_x_y') with no default.
 * Emptying a field hides its element. This is the only place the placeholder copy is written down.
 * Text is Lorem ipsum, images ship in images/. Buttons and navigation keep their real labels.
 *
 * The inserter icon, the description and the single-instance rule are added by includes/editor-sections.php,
 * which lists every section once. Add a new section block here and add its row there.
 *
 * Included from register_theme_fields() in functions.php, so Carbon Fields is already booted.
 */

use Carbon_Fields\Block;
use Carbon_Fields\Field;

$placeholder_bg = get_template_directory_uri() . '/images/placeholder-bg.jpg';

/*01 Hero. The site header above it is global: header.php, with the menu from Appearance > Menus and the phone from Theme Options.*/
Block::make('home_banner', admin_text('Hero'))
	->set_description(admin_text('A full screen hero with a background image: headline, buttons, social proof and three highlight cards.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('hero,banner,header')))
	->set_mode('both')
	->add_tab(admin_text('Hero'), array(
		Field::make('image', 'crb_banner_image', admin_text('Background Image'))
			->set_value_type('url')
			->set_default_value($placeholder_bg)
			->set_help_text(admin_text('Fills the screen behind a dark overlay. Leave empty for a plain dark background.')),
		Field::make('text', 'crb_banner_eyebrow', admin_text('Label'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_banner_title', admin_text('Heading'))
			->set_rows(2)
			->set_default_value("Lorem ipsum\nDolor sit.")
			->set_help_text(admin_text('A new line becomes a line break.')),
		Field::make('textarea', 'crb_banner_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.'),
		Field::make('text', 'crb_banner_button_text', admin_text('Primary Button Text'))
			->set_default_value('Book a free assessment')
			->set_help_text(admin_text('The button shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_banner_button_url', admin_text('Primary Button Link'))
			->set_default_value('#contact'),
		Field::make('text', 'crb_banner_button_2_text', admin_text('Secondary Button Text'))
			->set_default_value('See the program')
			->set_help_text(admin_text('The button shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_banner_button_2_url', admin_text('Secondary Button Link'))
			->set_default_value('#program'),
		Field::make('separator', 'crb_banner_proof_sep', admin_text('Social proof')),
		Field::make('complex', 'crb_banner_proof_people', admin_text('Avatars'))
			->set_collapsed(true)
			->set_max(4)
			->setup_labels(array('plural_name' => admin_text('Avatars'), 'singular_name' => admin_text('Avatar')))
			->add_fields(array(
				Field::make('text', 'initials', admin_text('Initials'))
					->set_help_text(admin_text('One or two letters.')),
			))
			->set_header_template('<%- initials %>')
			->set_default_value(array(
				array('_id' => 'proof-1', 'initials' => 'AC'),
				array('_id' => 'proof-2', 'initials' => 'MJ'),
				array('_id' => 'proof-3', 'initials' => 'SK'),
				array('_id' => 'proof-4', 'initials' => 'TR'),
			)),
		Field::make('checkbox', 'crb_banner_proof_stars', admin_text('Show five stars'))
			->set_option_value('yes')
			->set_default_value(true),
		Field::make('text', 'crb_banner_proof_text', admin_text('Social Proof Text'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur')
			->set_help_text(admin_text('Leave empty to hide the whole social proof row.')),
	))
	->add_tab(admin_text('Highlights'), array(
		Field::make('separator', 'crb_banner_card1_sep', admin_text('Card 1 - a result')),
		Field::make('text', 'crb_banner_card1_label', admin_text('Label'))
			->set_default_value('Lorem ipsum'),
		Field::make('text', 'crb_banner_card1_delta', admin_text('Change'))
			->set_default_value('−6.2 ↓')
			->set_help_text(admin_text('The small figure in the corner. Its number counts up when the card comes into view.')),
		Field::make('text', 'crb_banner_card1_initials', admin_text('Initials'))
			->set_default_value('AC'),
		Field::make('text', 'crb_banner_card1_name', admin_text('Name'))
			->set_default_value('Lorem Ipsum'),
		Field::make('text', 'crb_banner_card1_role', admin_text('Description'))
			->set_default_value('Lorem ipsum dolor sit amet'),
		Field::make('text', 'crb_banner_card1_was', admin_text('Before'))
			->set_default_value('was 18.6'),
		Field::make('text', 'crb_banner_card1_value', admin_text('Value'))
			->set_default_value('12.4')
			->set_help_text(admin_text('The big figure. Its number counts up when the card comes into view. Leave empty to hide the card.')),
		Field::make('text', 'crb_banner_card1_unit', admin_text('Unit'))
			->set_default_value('ipsum'),

		Field::make('separator', 'crb_banner_card2_sep', admin_text('Card 2 - a progress ring')),
		Field::make('text', 'crb_banner_card2_label', admin_text('Label'))
			->set_default_value('Lorem ipsum'),
		Field::make('textarea', 'crb_banner_card2_title', admin_text('Title'))
			->set_rows(2)
			->set_default_value("Lorem\nIpsum dolor")
			->set_help_text(admin_text('A new line becomes a line break.')),
		Field::make('text', 'crb_banner_card2_percent', admin_text('Percent'))
			->set_default_value('92')
			->set_help_text(admin_text('A number from 0 to 100. It fills the ring. Leave empty to hide the card.')),

		Field::make('separator', 'crb_banner_card3_sep', admin_text('Card 3 - a feature')),
		Field::make('image', 'crb_banner_card3_image', admin_text('Image'))
			->set_value_type('url')
			->set_default_value($placeholder_bg),
		Field::make('text', 'crb_banner_card3_label', admin_text('Label'))
			->set_default_value('Lorem'),
		Field::make('text', 'crb_banner_card3_title', admin_text('Title'))
			->set_default_value('Lorem ipsum dolor sit')
			->set_help_text(admin_text('Leave empty to hide the card.')),
		Field::make('text', 'crb_banner_card3_text', admin_text('Description'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.'),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_banner', $fields);
	});

/*02 Who it's for. A heading with an intro and tags, above a grid of numbered cards. The numbers come from the order of the cards.*/
Block::make('home_audience', admin_text('Who it\'s for'))
	->set_description(admin_text('A heading with an intro and tags above a grid of numbered cards.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('audience,who,cards')))
	->set_mode('both')
	->add_tab(admin_text('Heading'), array(
		Field::make('text', 'crb_audience_eyebrow', admin_text('Label'))
			->set_default_value('Who it\'s for')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_audience_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur.'),
		Field::make('textarea', 'crb_audience_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.'),
		Field::make('complex', 'crb_audience_tags', admin_text('Tags'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Tags'), 'singular_name' => admin_text('Tag')))
			->add_fields(array(
				Field::make('text', 'label', admin_text('Label')),
			))
			->set_header_template('<%- label %>')
			->set_default_value(array(
				array('_id' => 'tag-1', 'label' => 'Lorem ipsum dolor'),
				array('_id' => 'tag-2', 'label' => 'Lorem ipsum'),
				array('_id' => 'tag-3', 'label' => 'Lorem ipsum dolor'),
				array('_id' => 'tag-4', 'label' => 'Lorem ipsum dolor'),
			))
			->set_help_text(admin_text('Small outlined labels next to the description. Leave the list empty to hide them.')),
	))
	->add_tab(admin_text('Cards'), array(
		Field::make('checkbox', 'crb_audience_numbers', admin_text('Show card numbers'))
			->set_option_value('yes')
			->set_default_value(true),
		Field::make('complex', 'crb_audience_cards', admin_text('Cards'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Cards'), 'singular_name' => admin_text('Card')))
			->add_fields(array(
				Field::make('select', 'icon', admin_text('Icon'))
					->add_options(theme_icon_options())
					->set_default_value('target'),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A card without a title is not shown.')),
				Field::make('textarea', 'text', admin_text('Description'))
					->set_rows(3),
				Field::make('text', 'check', admin_text('Check Line'))
					->set_help_text(admin_text('The line with a check mark at the bottom of the card. Leave empty to hide it.')),
			))
			->set_header_template('<%- title %>')
			->set_default_value(array(
				array('_id' => 'card-1', 'icon' => 'trend', 'title' => 'Lorem ipsum dolor sit', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.', 'check' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'card-2', 'icon' => 'target', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.', 'check' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'card-3', 'icon' => 'video', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.', 'check' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'card-4', 'icon' => 'chat', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.', 'check' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'card-5', 'icon' => 'calendar', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.', 'check' => 'Lorem ipsum dolor sit amet, consectetur'),
				array('_id' => 'card-6', 'icon' => 'clock', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.', 'check' => 'Lorem ipsum dolor sit amet'),
			)),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_audience', $fields);
	});

/*03 Benefits. A dark section: a heading with an intro above a bento grid. Two featured cards (a chart, a checklist) frame a set of tiles, and the tiles are a repeater so the count is the client's.*/
Block::make('home_benefits', admin_text('Benefits'))
	->set_description(admin_text('A heading above a bento grid of benefit cards, with a chart card and a checklist card.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('benefits,bento,cards')))
	->set_mode('both')
	->add_tab(admin_text('Heading'), array(
		Field::make('text', 'crb_benefits_eyebrow', admin_text('Label'))
			->set_default_value('Benefits')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_benefits_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum dolor sit amet.'),
		Field::make('textarea', 'crb_benefits_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
	))
	->add_tab(admin_text('Chart Card'), array(
		Field::make('select', 'crb_benefits_chart_icon', admin_text('Icon'))
			->add_options(theme_icon_options())
			->set_default_value('trend')
			->set_help_text(admin_text('The Trend icon points up when the End Value is higher than the Start Value, and down otherwise. Any other icon stays as chosen.')),
		Field::make('text', 'crb_benefits_chart_title', admin_text('Title'))
			->set_default_value('Lorem ipsum dolor sit amet')
			->set_help_text(admin_text('The green card with a chart. Leave the title empty to hide the card.')),
		Field::make('textarea', 'crb_benefits_chart_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
		Field::make('text', 'crb_benefits_chart_start_label', admin_text('Start Label'))
			->set_default_value('Week 1')
			->set_width(50),
		Field::make('text', 'crb_benefits_chart_start_value', admin_text('Start Value'))
			->set_default_value('18.6')
			->set_width(50)
			->set_help_text(admin_text('The number counts up when the card scrolls into view. Text around it, such as a unit, stays as written.')),
		Field::make('text', 'crb_benefits_chart_end_label', admin_text('End Label'))
			->set_default_value('Week 8')
			->set_width(50),
		Field::make('text', 'crb_benefits_chart_end_value', admin_text('End Value'))
			->set_default_value('12.4')
			->set_width(50)
			->set_help_text(admin_text('The curve is decorative: it falls, and climbs instead when this is higher than the Start Value. Leave both values empty to hide the chart. On a phone the two values share one line and the labels are not shown.')),
	))
	->add_tab(admin_text('Cards'), array(
		Field::make('complex', 'crb_benefits_tiles', admin_text('Cards'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Cards'), 'singular_name' => admin_text('Card')))
			->add_fields(array(
				Field::make('select', 'icon', admin_text('Icon'))
					->add_options(theme_icon_options())
					->set_default_value('calendar'),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A card without a title is not shown.')),
				Field::make('textarea', 'text', admin_text('Description'))
					->set_rows(3),
			))
			->set_header_template('<%- title %>')
			->set_default_value(array(
				array('_id' => 'tile-1', 'icon' => 'calendar', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
				array('_id' => 'tile-2', 'icon' => 'clock', 'title' => 'Lorem ipsum dolor sit amet, consectetur', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.'),
				array('_id' => 'tile-3', 'icon' => 'video', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.'),
				array('_id' => 'tile-4', 'icon' => 'users', 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
			))
			->set_help_text(admin_text('The dark cards between the two featured ones. A row that comes up short stretches to fill the width, so any number works.')),
	))
	->add_tab(admin_text('Checklist Card'), array(
		Field::make('select', 'crb_benefits_check_icon', admin_text('Icon'))
			->add_options(theme_icon_options())
			->set_default_value('shield'),
		Field::make('text', 'crb_benefits_check_title', admin_text('Title'))
			->set_default_value('Lorem ipsum dolor sit amet')
			->set_help_text(admin_text('The lime card with a checklist. Leave the title empty to hide the card.')),
		Field::make('textarea', 'crb_benefits_check_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
		Field::make('complex', 'crb_benefits_check_rows', admin_text('Lines'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Lines'), 'singular_name' => admin_text('Line')))
			->add_fields(array(
				Field::make('select', 'icon', admin_text('Icon'))
					->add_options(theme_icon_options())
					->set_default_value('check'),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A line without a title is not shown.')),
				Field::make('text', 'text', admin_text('Description')),
			))
			->set_header_template('<%- title %>')
			->set_default_value(array(
				array('_id' => 'line-1', 'icon' => 'check', 'title' => 'Lorem ipsum dolor', 'text' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'line-2', 'icon' => 'calendar', 'title' => 'Lorem ipsum dolor sit', 'text' => 'Lorem ipsum dolor sit amet'),
			))
			->set_help_text(admin_text('The white chips beside the text. The first one is highlighted, and on a phone only the first is shown. Leave the list empty to hide them.')),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_benefits', $fields);
	});

/*About (About Page). The About page's own take on the About section: the image sits on the right by default.*/
Block::make('about_rev', admin_text('About (About Page)'))
	->set_description(admin_text('The About page\'s own version of the About section.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('about,intro,story')))
	->set_mode('both')
	->add_tab(admin_text('Content'), array(
		Field::make('text', 'crb_about_rev_eyebrow', admin_text('Eyebrow'))
			->set_default_value('Lorem ipsum')
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_about_rev_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum dolor sit amet consectetur'),
		Field::make('textarea', 'crb_about_rev_text', admin_text('Intro'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.')
			->set_help_text(admin_text('The larger paragraph right under the heading.')),
		Field::make('textarea', 'crb_about_rev_body', admin_text('Body Text'))
			->set_rows(6)
			->set_default_value("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat, duis aute irure dolor in reprehenderit.\n\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.")
			->set_help_text(admin_text('A blank line starts a new paragraph.')),
		Field::make('image', 'crb_about_rev_image', admin_text('Image'))
			->set_value_type('url')
			->set_default_value(get_template_directory_uri() . '/images/about.webp')
			->set_help_text(admin_text('Optional. Leave empty to drop the image and centre the text.')),
		Field::make('select', 'crb_about_rev_layout', admin_text('Image Position'))
			->add_options(array(
				'left' => admin_text('Left'),
				'right' => admin_text('Right'),
			))
			->set_default_value('right')
			->set_help_text(admin_text('Which side the image sits on. The text takes the other side.')),
		Field::make('text', 'crb_about_rev_button_text', admin_text('Button Text'))
			->set_default_value('Talk to us')
			->set_help_text(admin_text('The button shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_about_rev_button_link', admin_text('Button Link'))
			->set_default_value('#contact'),
	))
	->add_tab(admin_text('Stats'), array(
		Field::make('text', 'crb_about_rev_stat_1_value', admin_text('Stat 1 Value'))
			->set_default_value('12+')
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_rev_stat_1_label', admin_text('Stat 1 Label'))
			->set_default_value('Lorem ipsum'),
		Field::make('text', 'crb_about_rev_stat_2_value', admin_text('Stat 2 Value'))
			->set_default_value('180')
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_rev_stat_2_label', admin_text('Stat 2 Label'))
			->set_default_value('Dolor sit amet'),
		Field::make('text', 'crb_about_rev_stat_3_value', admin_text('Stat 3 Value'))
			->set_default_value('98%')
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_rev_stat_3_label', admin_text('Stat 3 Label'))
			->set_default_value('Consectetur elit'),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('about_rev', $fields);
	});
