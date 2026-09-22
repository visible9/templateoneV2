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

/*04 Program. Two halves: a heading, a photo, a facts panel and a button on the left, the numbered steps of the program on the right. The numbers come from the order of the steps, and each step's check lines are one textarea with a line per item.*/
Block::make('home_program', admin_text('Program'))
	->set_description(admin_text('A heading, a photo, a facts panel and a button beside a list of numbered program steps.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('program,steps,timeline')))
	->set_mode('both')
	->add_tab(admin_text('Heading'), array(
		Field::make('text', 'crb_program_eyebrow', admin_text('Label'))
			->set_default_value('The program')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_program_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum dolor sit amet.'),
		Field::make('textarea', 'crb_program_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.'),
		Field::make('text', 'crb_program_button_text', admin_text('Button Text'))
			->set_default_value('Book a free assessment')
			->set_help_text(admin_text('The button closes the left half. It shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_program_button_url', admin_text('Button Link'))
			->set_default_value('#contact'),
	))
	->add_tab(admin_text('Photo'), array(
		Field::make('image', 'crb_program_image', admin_text('Image'))
			->set_value_type('url')
			->set_default_value($placeholder_bg)
			->set_help_text(admin_text('Leave empty to hide the photo, together with its label and arrow.')),
		Field::make('text', 'crb_program_image_label', admin_text('Label'))
			->set_default_value('Lorem ipsum dolor sit')
			->set_help_text(admin_text('The frosted label in the corner of the photo. Leave empty to hide it.')),
		Field::make('checkbox', 'crb_program_image_arrow', admin_text('Show arrow'))
			->set_option_value('yes')
			->set_default_value(true)
			->set_help_text(admin_text('The round arrow in the opposite corner. It is only a decoration, and it is not shown on a phone.')),
	))
	->add_tab(admin_text('Facts'), array(
		Field::make('text', 'crb_program_facts_title', admin_text('Title'))
			->set_default_value('Lorem ipsum')
			->set_help_text(admin_text('The dark panel under the photo. Leave the title and the rows empty to hide the panel.')),
		Field::make('complex', 'crb_program_facts', admin_text('Rows'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Rows'), 'singular_name' => admin_text('Row')))
			->add_fields(array(
				Field::make('text', 'label', admin_text('Label'))
					->set_width(50),
				/*Named detail, not value: Carbon Fields reserves value (and _type) in a complex field*/
				Field::make('text', 'detail', admin_text('Value'))
					->set_width(50),
			))
			->set_header_template('<%- label %>: <%- detail %>')
			->set_default_value(array(
				array('_id' => 'fact-1', 'label' => 'Lorem', 'detail' => 'Lorem ipsum dolor'),
				array('_id' => 'fact-2', 'label' => 'Lorem', 'detail' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'fact-3', 'label' => 'Lorem ipsum', 'detail' => 'Lorem ipsum'),
				array('_id' => 'fact-4', 'label' => 'Lorem', 'detail' => 'Lorem ipsum'),
				array('_id' => 'fact-5', 'label' => 'Lorem', 'detail' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'fact-6', 'label' => 'Lorem', 'detail' => 'Lorem ipsum dolor sit amet'),
			))
			->set_help_text(admin_text('A row needs both its label and its value, or it is not shown.')),
	))
	->add_tab(admin_text('Steps'), array(
		Field::make('checkbox', 'crb_program_numbers', admin_text('Show step numbers'))
			->set_option_value('yes')
			->set_default_value(true),
		Field::make('complex', 'crb_program_steps', admin_text('Steps'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Steps'), 'singular_name' => admin_text('Step')))
			->add_fields(array(
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A step without a title is not shown.')),
				Field::make('text', 'period', admin_text('Period'))
					->set_help_text(admin_text('The small pill beside the title, such as Weeks 1–2. Leave empty to hide it.')),
				Field::make('textarea', 'text', admin_text('Description'))
					->set_rows(3),
				Field::make('textarea', 'points', admin_text('Check Lines'))
					->set_rows(3)
					->set_help_text(admin_text('One line per check mark. Leave empty to hide the list.')),
			))
			->set_header_template('<%- title %>')
			->set_default_value(array(
				array('_id' => 'step-1', 'title' => 'Lorem ipsum dolor sit', 'period' => 'Weeks 1–2', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad.', 'points' => "Lorem ipsum dolor sit amet\nLorem ipsum dolor sit amet"),
				array('_id' => 'step-2', 'title' => 'Lorem ipsum', 'period' => 'Weeks 3–4', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.', 'points' => "Lorem ipsum dolor sit amet, consectetur\nLorem ipsum dolor sit amet"),
				array('_id' => 'step-3', 'title' => 'Lorem ipsum dolor sit', 'period' => 'Weeks 5–6', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.', 'points' => "Lorem ipsum dolor sit amet, consectetur\nLorem ipsum dolor sit amet"),
				array('_id' => 'step-4', 'title' => 'Lorem ipsum dolor', 'period' => 'Weeks 7–8', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.', 'points' => "Lorem ipsum dolor sit amet\nLorem ipsum dolor sit amet"),
			))
			->set_help_text(admin_text('The cards on the right, numbered in the order they are listed here.')),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_program', $fields);
	});

/*05 Social proof. A heading with a rating, a row of count-up numbers, a video that plays in a popup beside a quote and a chat, reviews, a slider of case studies whose cards chart a before and an after, and a strip of logos.*/
Block::make('home_proof', admin_text('Social proof'))
	->set_description(admin_text('A heading with a rating, count-up numbers, a video that plays in a popup, a quote, a chat, reviews, a slider of case studies and a strip of logos.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('proof,results,reviews')))
	->set_mode('both')
	->add_tab(admin_text('Heading'), array(
		Field::make('text', 'crb_proof_eyebrow', admin_text('Label'))
			->set_default_value('Results')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_proof_title', admin_text('Heading'))
			->set_rows(2)
			->set_default_value("Lorem ipsum.\nDolor sit amet.")
			->set_help_text(admin_text('A new line becomes a line break.')),
		Field::make('checkbox', 'crb_proof_stars', admin_text('Show five stars'))
			->set_option_value('yes')
			->set_default_value(true),
		Field::make('text', 'crb_proof_rating_text', admin_text('Rating Text'))
			->set_default_value('Lorem ipsum dolor sit')
			->set_help_text(admin_text('The line beside the stars. Leave it empty and the stars off to hide the whole rating.')),
		Field::make('textarea', 'crb_proof_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.')
			->set_help_text(admin_text('Shown beside the heading. It is not shown on a phone. Leave empty to hide it.')),
	))
	->add_tab(admin_text('Numbers'), array(
		Field::make('complex', 'crb_proof_stats', admin_text('Numbers'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Numbers'), 'singular_name' => admin_text('Number')))
			->add_fields(array(
				Field::make('text', 'number', admin_text('Number'))
					->set_width(50),
				Field::make('text', 'label', admin_text('Label'))
					->set_width(50),
			))
			->set_header_template('<%- number %> <%- label %>')
			->set_default_value(array(
				array('_id' => 'stat-1', 'number' => '320+', 'label' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'stat-2', 'number' => '−6.2', 'label' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'stat-3', 'number' => '92%', 'label' => 'Lorem ipsum dolor sit amet'),
				array('_id' => 'stat-4', 'number' => '40+', 'label' => 'Lorem ipsum dolor sit amet'),
			))
			->set_help_text(admin_text('The big figures under the heading. A number counts up when the row scrolls into view, and the text around it, such as a sign or a unit, stays as written. A row needs its number, or it is not shown.')),
	))
	->add_tab(admin_text('Video'), array(
		Field::make('image', 'crb_proof_video_image', admin_text('Image'))
			->set_value_type('url')
			->set_default_value($placeholder_bg)
			->set_help_text(admin_text('The large card with a play button, on a dark shade. Leave the image, the texts and the video all empty to hide the card.')),
		Field::make('text', 'crb_proof_video_label', admin_text('Label'))
			->set_default_value('Video · 1:42')
			->set_help_text(admin_text('The frosted label in the corner of the card. Leave empty to hide it.')),
		Field::make('text', 'crb_proof_video_title', admin_text('Title'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur'),
		Field::make('text', 'crb_proof_video_caption', admin_text('Caption'))
			->set_default_value('Lorem Ipsum · Dolor sit amet')
			->set_help_text(admin_text('The line under the title.')),
		/*The placeholder is a Creative Commons film (Big Buck Bunny, Blender Foundation), so the popup can be tried the moment the block is inserted*/
		Field::make('text', 'crb_proof_video_url', admin_text('YouTube Link'))
			->set_default_value('https://www.youtube.com/watch?v=aqz-KE-bpKQ')
			->set_help_text(admin_text('Paste a YouTube link, or choose a video file below. The play button opens the video in a popup.')),
		Field::make('file', 'crb_proof_video_file', admin_text('Video File'))
			->set_type(array('video'))
			->set_value_type('url')
			->set_help_text(admin_text('A video from the media library. When both this and the YouTube link are filled in, the file plays. With neither, there is no play button.')),
	))
	->add_tab(admin_text('Quote'), array(
		Field::make('textarea', 'crb_proof_quote_text', admin_text('Quote Text'))
			->set_rows(4)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.')
			->set_help_text(admin_text('The dark quote card. Leave empty to hide the card.')),
		Field::make('text', 'crb_proof_quote_initials', admin_text('Initials'))
			->set_default_value('PN')
			->set_help_text(admin_text('One or two letters.')),
		Field::make('text', 'crb_proof_quote_name', admin_text('Name'))
			->set_default_value('Lorem Ipsum'),
		Field::make('text', 'crb_proof_quote_role', admin_text('Role'))
			->set_default_value('Dolor sit amet'),
	))
	->add_tab(admin_text('Chat'), array(
		Field::make('text', 'crb_proof_chat_initials', admin_text('Initials'))
			->set_default_value('DK')
			->set_help_text(admin_text('One or two letters.')),
		Field::make('text', 'crb_proof_chat_name', admin_text('Name'))
			->set_default_value('Lorem Ipsum'),
		Field::make('text', 'crb_proof_chat_status', admin_text('Status'))
			->set_default_value('online')
			->set_help_text(admin_text('The small line under the name.')),
		Field::make('complex', 'crb_proof_chat_messages', admin_text('Messages'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Messages'), 'singular_name' => admin_text('Message')))
			->add_fields(array(
				Field::make('select', 'side', admin_text('Side'))
					->add_options(array('received' => admin_text('Received'), 'sent' => admin_text('Sent')))
					->set_default_value('received')
					->set_width(50),
				Field::make('text', 'time', admin_text('Time'))
					->set_width(50),
				Field::make('text', 'text', admin_text('Message')),
			))
			->set_header_template('<%- text %>')
			->set_default_value(array(
				array('_id' => 'message-1', 'side' => 'sent', 'time' => '18:42', 'text' => 'Lorem ipsum dolor sit amet, consectetur!'),
				array('_id' => 'message-2', 'side' => 'received', 'time' => '18:44', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.'),
				array('_id' => 'message-3', 'side' => 'sent', 'time' => '18:45', 'text' => 'Lorem ipsum dolor sit amet, consectetur.'),
			))
			->set_help_text(admin_text('The chat card. Sent messages sit on the right in green, received ones on the left in white, and their times are not shown on a phone. A message needs its text, or it is not shown. Leave the list empty to hide the card.')),
		Field::make('text', 'crb_proof_chat_caption', admin_text('Caption'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur')
			->set_help_text(admin_text('The line under the chat.')),
	))
	->add_tab(admin_text('Reviews'), array(
		Field::make('complex', 'crb_proof_reviews', admin_text('Reviews'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Reviews'), 'singular_name' => admin_text('Review')))
			->add_fields(array(
				Field::make('select', 'stars', admin_text('Stars'))
					->add_options(array('5' => admin_text('5 stars'), '4' => admin_text('4 stars'), '3' => admin_text('3 stars'), '2' => admin_text('2 stars'), '1' => admin_text('1 star'), '' => admin_text('No stars')))
					->set_default_value('5')
					->set_width(50),
				Field::make('text', 'tag', admin_text('Tag'))
					->set_width(50)
					->set_help_text(admin_text('The small pill at the foot of the card. Leave empty to hide it.')),
				Field::make('textarea', 'text', admin_text('Review Text'))
					->set_rows(3)
					->set_help_text(admin_text('A review without a text is not shown.')),
				Field::make('text', 'initials', admin_text('Initials'))
					->set_width(33),
				Field::make('text', 'name', admin_text('Name'))
					->set_width(33),
				Field::make('text', 'role', admin_text('Role'))
					->set_width(33),
			))
			->set_header_template('<%- name %>')
			->set_default_value(array(
				array('_id' => 'review-1', 'stars' => '5', 'tag' => 'Lorem ipsum', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'initials' => 'SK', 'name' => 'Lorem Ipsum', 'role' => 'Dolor sit amet'),
				array('_id' => 'review-2', 'stars' => '5', 'tag' => 'Lorem ipsum', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.', 'initials' => 'TR', 'name' => 'Lorem Ipsum', 'role' => 'Dolor sit amet'),
				array('_id' => 'review-3', 'stars' => '5', 'tag' => 'Lorem ipsum', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.', 'initials' => 'EV', 'name' => 'Lorem Ipsum', 'role' => 'Dolor sit amet'),
			))
			->set_help_text(admin_text('The white cards under the video, the quote and the chat, three to a row. Leave the list empty to hide them.')),
	))
	->add_tab(admin_text('Case Studies'), array(
		Field::make('text', 'crb_proof_stories_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum')
			->set_help_text(admin_text('The heading above the slider.')),
		Field::make('text', 'crb_proof_stories_button_text', admin_text('Button Text'))
			->set_default_value('All stories')
			->set_help_text(admin_text('The outlined button beside the arrows, not shown on a phone. It shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_proof_stories_button_url', admin_text('Button Link'))
			->set_default_value('#'),
		Field::make('text', 'crb_proof_stories_before_label', admin_text('Before Label'))
			->set_default_value('Before')
			->set_width(50),
		Field::make('text', 'crb_proof_stories_after_label', admin_text('After Label'))
			->set_default_value('After')
			->set_width(50),
		Field::make('text', 'crb_proof_stories_link_text', admin_text('Link Text'))
			->set_default_value('Read the story')
			->set_help_text(admin_text('The link at the foot of every card. It shows only when this text and the link of the card are both filled in.')),
		Field::make('complex', 'crb_proof_stories', admin_text('Case Studies'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Case Studies'), 'singular_name' => admin_text('Case Study')))
			->add_fields(array(
				Field::make('text', 'before', admin_text('Before'))
					->set_width(50),
				Field::make('text', 'after', admin_text('After'))
					->set_width(50)
					->set_help_text(admin_text('Both figures count up when the card scrolls into view. The curve is decorative: it falls, and climbs instead when After is higher than Before. Leave both empty to hide the dark top of the card.')),
				Field::make('textarea', 'tags', admin_text('Tags'))
					->set_rows(2)
					->set_help_text(admin_text('One tag per line. Leave empty to hide them.')),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A card without a title is not shown.')),
				Field::make('textarea', 'text', admin_text('Description'))
					->set_rows(3),
				Field::make('text', 'url', admin_text('Link')),
			))
			->set_header_template('<%- title %>')
			->set_default_value(array(
				array('_id' => 'story-1', 'before' => '24.1', 'after' => '16.3', 'tags' => "Lorem\nIpsum dolor", 'title' => 'Lorem ipsum dolor sit amet, consectetur', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim.', 'url' => '#'),
				array('_id' => 'story-2', 'before' => '21.0', 'after' => '14.2', 'tags' => "Lorem\nIpsum dolor", 'title' => 'Lorem ipsum dolor sit amet', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'url' => '#'),
				array('_id' => 'story-3', 'before' => '34.0', 'after' => '26.5', 'tags' => "Lorem\nIpsum dolor", 'title' => 'Lorem ipsum dolor sit amet, consectetur', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'url' => '#'),
				array('_id' => 'story-4', 'before' => '28.4', 'after' => '21.7', 'tags' => "Lorem\nIpsum dolor", 'title' => 'Lorem ipsum dolor sit amet, consectetur', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut.', 'url' => '#'),
				array('_id' => 'story-5', 'before' => '17.2', 'after' => '11.9', 'tags' => "Lorem\nIpsum dolor", 'title' => 'Lorem ipsum dolor sit amet, consectetur', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'url' => '#'),
			))
			->set_help_text(admin_text('The cards of the slider. The dark top of a card cycles through four shades, and the row scrolls sideways when the cards do not fit.')),
	))
	->add_tab(admin_text('Logos'), array(
		Field::make('text', 'crb_proof_logos_label', admin_text('Label'))
			->set_default_value('Lorem ipsum dolor sit amet')
			->set_help_text(admin_text('The line before the logos. Leave empty to hide it.')),
		Field::make('complex', 'crb_proof_logos', admin_text('Logos'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Logos'), 'singular_name' => admin_text('Logo')))
			->add_fields(array(
				Field::make('image', 'logo', admin_text('Logo'))
					->set_value_type('url')
					->set_help_text(admin_text('Shown in grey. Leave empty to set the name as a text logo instead.')),
				Field::make('text', 'name', admin_text('Name'))
					->set_help_text(admin_text('The name is the alternative text of the logo. A logo without a name is not shown.')),
			))
			->set_header_template('<%- name %>')
			->set_default_value(array(
				array('_id' => 'logo-1', 'name' => 'Lorem'),
				array('_id' => 'logo-2', 'name' => 'Ipsum'),
				array('_id' => 'logo-3', 'name' => 'Dolor'),
				array('_id' => 'logo-4', 'name' => 'Sit amet'),
				array('_id' => 'logo-5', 'name' => 'Elit'),
				array('_id' => 'logo-6', 'name' => 'Tempor'),
			))
			->set_help_text(admin_text('The strip under the case studies, one column to a logo. Leave the list empty to hide it.')),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_proof', $fields);
	});

/*06 Pricing. A centred heading above a row of plans, one of them highlighted as a white card standing above the rest, and a footnote under the row. The plans are a repeater, so the row is as many cards as the client lists.*/
Block::make('home_pricing', admin_text('Pricing'))
	->set_description(admin_text('A heading above a row of pricing plans, one of them highlighted, with a footnote under the row.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('pricing,plans,packages')))
	->set_mode('both')
	->add_tab(admin_text('Heading'), array(
		Field::make('text', 'crb_pricing_eyebrow', admin_text('Label'))
			->set_default_value('Pricing')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_pricing_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur.'),
		Field::make('textarea', 'crb_pricing_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.'),
	))
	->add_tab(admin_text('Plans'), array(
		Field::make('select', 'crb_pricing_badge_icon', admin_text('Badge Icon'))
			->add_options(theme_icon_options())
			->set_default_value('bolt')
			->set_help_text(admin_text('The icon in the badge of a plan. Choose No icon to show the badge text alone.')),
		Field::make('complex', 'crb_pricing_plans', admin_text('Plans'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Plans'), 'singular_name' => admin_text('Plan')))
			->add_fields(array(
				Field::make('text', 'name', admin_text('Name'))
					->set_width(50)
					->set_help_text(admin_text('A plan without a name is not shown.')),
				Field::make('text', 'badge', admin_text('Badge'))
					->set_width(50)
					->set_help_text(admin_text('The small tag on the top edge of the card, such as Most popular. Leave empty to hide it.')),
				Field::make('checkbox', 'featured', admin_text('Highlight this plan'))
					->set_option_value('yes')
					->set_default_value(false)
					->set_help_text(admin_text('A highlighted plan is a white card standing above the others, with the primary button and its first line in bold.')),
				Field::make('textarea', 'text', admin_text('Description'))
					->set_rows(2),
				Field::make('text', 'price', admin_text('Price'))
					->set_width(33)
					->set_help_text(admin_text('Typed as it should read, with its currency, such as $420, €99 or Free.')),
				Field::make('text', 'period', admin_text('Period'))
					->set_width(33)
					->set_help_text(admin_text('The text beside the price, such as per month.')),
				Field::make('text', 'note', admin_text('Note'))
					->set_width(33)
					->set_help_text(admin_text('The small line under the price, such as Billed annually.')),
				Field::make('text', 'button_text', admin_text('Button Text'))
					->set_width(50)
					->set_help_text(admin_text('The button shows only when both its text and its link are filled in.')),
				Field::make('text', 'button_url', admin_text('Button Link'))
					->set_width(50),
				Field::make('textarea', 'features', admin_text('Features'))
					->set_rows(5)
					->set_help_text(admin_text('One line per check mark. Leave empty to hide the list.')),
			))
			->set_header_template('<%- name %> <%- price %>')
			->set_default_value(array(
				array('_id' => 'plan-1', 'name' => 'Lorem', 'badge' => '', 'featured' => false, 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing.', 'price' => '$420', 'period' => 'Lorem ipsum dolor sit', 'note' => 'Lorem ipsum dolor sit', 'button_text' => 'Choose Starter', 'button_url' => '#contact', 'features' => "Lorem ipsum dolor sit amet\nLorem ipsum dolor sit\nLorem ipsum dolor\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit amet, consectetur"),
				array('_id' => 'plan-2', 'name' => 'Lorem', 'badge' => 'Most popular', 'featured' => true, 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'price' => '$780', 'period' => 'Lorem ipsum dolor sit', 'note' => 'Lorem ipsum dolor sit', 'button_text' => 'Choose Pro', 'button_url' => '#contact', 'features' => "Lorem ipsum dolor sit\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit amet\nLorem ipsum dolor\nLorem ipsum dolor sit"),
				array('_id' => 'plan-3', 'name' => 'Lorem', 'badge' => '', 'featured' => false, 'text' => 'Lorem ipsum dolor sit amet, consectetur.', 'price' => '$1,110', 'period' => 'Lorem', 'note' => 'Lorem ipsum dolor sit amet, consectetur', 'button_text' => 'Choose Elite', 'button_url' => '#contact', 'features' => "Lorem ipsum dolor\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit\nLorem ipsum dolor sit amet"),
			))
			->set_help_text(admin_text('The cards of the row, side by side. One plan is a single narrow card, two are a pair, three or four fill the row and more wrap onto the next line. On a phone they stack in the order listed here.')),
	))
	->add_tab(admin_text('Footnote'), array(
		Field::make('select', 'crb_pricing_footnote_icon', admin_text('Icon'))
			->add_options(theme_icon_options())
			->set_default_value('shield'),
		Field::make('text', 'crb_pricing_footnote_title', admin_text('Bold Text'))
			->set_default_value('Lorem ipsum dolor sit amet.')
			->set_help_text(admin_text('The bold start of the line under the plans.')),
		Field::make('text', 'crb_pricing_footnote_text', admin_text('Text'))
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.')
			->set_help_text(admin_text('Leave the bold text and this text empty to hide the line.')),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_pricing', $fields);
	});

/*07 FAQ. A heading with a contact card on the left and a list of questions on the right, each row a native details element that opens to its answer. The questions are a repeater, so the list is as long as the client makes it.*/
Block::make('home_faq', admin_text('FAQ'))
	->set_description(admin_text('A list of questions that open to their answers, beside a heading and a card to get in touch.'))
	->set_category('yk4-sections', admin_text('Page Sections'))
	->set_icon('layout')
	->set_keywords(explode(',', admin_text('faq,questions,answers')))
	->set_mode('both')
	->add_tab(admin_text('Heading'), array(
		Field::make('text', 'crb_faq_eyebrow', admin_text('Label'))
			->set_default_value('FAQ')
			->set_help_text(admin_text('The small pill above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_faq_title', admin_text('Heading'))
			->set_default_value('Lorem ipsum dolor sit amet?'),
		Field::make('textarea', 'crb_faq_text', admin_text('Description'))
			->set_rows(3)
			->set_default_value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.'),
	))
	->add_tab(admin_text('Questions'), array(
		Field::make('checkbox', 'crb_faq_open_first', admin_text('Open the first question'))
			->set_option_value('yes')
			->set_default_value(true)
			->set_help_text(admin_text('The first answer is showing when the page loads. Opening another one closes it.')),
		Field::make('complex', 'crb_faq_items', admin_text('Questions'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Questions'), 'singular_name' => admin_text('Question')))
			->add_fields(array(
				Field::make('text', 'question', admin_text('Question'))
					->set_help_text(admin_text('A question needs both its question and its answer, or it is not shown.')),
				Field::make('textarea', 'answer', admin_text('Answer'))
					->set_rows(4)
					->set_help_text(admin_text('A blank line starts a new paragraph.')),
			))
			->set_header_template('<%- question %>')
			->set_default_value(array(
				array('_id' => 'question-1', 'question' => 'Lorem ipsum dolor sit amet, consectetur?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.'),
				array('_id' => 'question-2', 'question' => 'Lorem ipsum dolor sit amet?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
				array('_id' => 'question-3', 'question' => 'Lorem ipsum dolor sit amet?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.'),
				array('_id' => 'question-4', 'question' => 'Lorem ipsum dolor sit?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut.'),
				array('_id' => 'question-5', 'question' => 'Lorem ipsum dolor sit amet, consectetur?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad.'),
				array('_id' => 'question-6', 'question' => 'Lorem ipsum dolor sit amet?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'),
			))
			->set_help_text(admin_text('The rows of the list, in this order. Leave the list empty to hide it: the heading and the card then stay on their own.')),
	))
	->add_tab(admin_text('Contact Card'), array(
		Field::make('text', 'crb_faq_contact_initials', admin_text('Initials'))
			->set_default_value('DK')
			->set_help_text(admin_text('The round badge at the start of the card, one or two letters. Leave empty to hide it. Leave every field of this tab empty to hide the card.')),
		Field::make('text', 'crb_faq_contact_title', admin_text('Title'))
			->set_default_value('Lorem ipsum?'),
		Field::make('text', 'crb_faq_contact_text', admin_text('Text'))
			->set_default_value('Lorem ipsum dolor sit amet.'),
		Field::make('text', 'crb_faq_contact_button_text', admin_text('Primary Button Text'))
			->set_default_value('Request a Call')
			->set_help_text(admin_text('The button shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_faq_contact_button_url', admin_text('Primary Button Link'))
			->set_default_value('#contact'),
		Field::make('text', 'crb_faq_contact_button_2_text', admin_text('Secondary Button Text'))
			->set_default_value('Telegram')
			->set_help_text(admin_text('The button shows only when both its text and its link are filled in.')),
		Field::make('text', 'crb_faq_contact_button_2_url', admin_text('Secondary Button Link'))
			->set_default_value('#contact'),
		Field::make('select', 'crb_faq_contact_button_2_icon', admin_text('Secondary Button Icon'))
			->add_options(theme_icon_options())
			->set_default_value('send')
			->set_help_text(admin_text('The icon before the text of the secondary button. Choose No icon to show the text alone.')),
	))
	->set_render_callback(function ($fields) {
		echo render_section_block('home_faq', $fields);
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
