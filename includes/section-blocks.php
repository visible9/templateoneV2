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
