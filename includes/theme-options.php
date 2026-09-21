<?php

/**
 * Theme Options - the site wide settings, on one admin page with a tab per topic.
 *
 * The page sits in the admin menu as Theme Options. Its values are read with theme_option() in
 * functions.php, and a template prints an element only when its option is filled in, so leaving a field
 * empty removes the element and its wrapper from the page. The only defaults are the logo image and text,
 * which carry the design's placeholder until the options are first saved.
 *
 * Menus are not here: they are managed in Appearance > Menus, and the Header and Footer checkboxes under
 * Menu Settings > Menu location decide where a menu shows (the locations are registered in functions.php).
 *
 * Field names are crb_options_<name>. Every label, tab and help text goes through admin_text(), so the page
 * reads in English or Ukrainian by the site language (includes/admin-translations.php). The container id is
 * given explicitly because Carbon Fields would otherwise build it from the translated title.
 * Included from register_theme_fields() in functions.php, so Carbon Fields is already booted.
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/*The id is given on purpose: with a title alone Carbon Fields builds the id, and so the page slug, from the title text, which changes with the language.*/
Container::make('theme_options', 'theme_options', admin_text('Theme Options'))
	->set_page_menu_title(admin_text('Theme Options'))
	->set_page_menu_position(61)
	->set_icon('dashicons-admin-generic')
	->set_layout('tabbed-horizontal')
	->add_tab(admin_text('Contact Information'), array(
		Field::make('html', 'crb_options_contact_note')
			->set_html(admin_text('<p><em>Used by the header and the footer. Anything left empty is not shown on the site.</em></p>')),
		Field::make('text', 'crb_options_phone', admin_text('Phone'))
			->set_help_text(admin_text('Shown as written. The call link is built from its digits. The phone icon in the header only appears when this is filled in.')),
		Field::make('text', 'crb_options_email', admin_text('Email')),
		Field::make('textarea', 'crb_options_address', admin_text('Address'))
			->set_rows(3),
		Field::make('text', 'crb_options_hours', admin_text('Working Hours'))
			->set_help_text(admin_text('For example Mon-Sat, 8:00-20:00.')),
		Field::make('complex', 'crb_options_socials', admin_text('Social Links'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Links'), 'singular_name' => admin_text('Link')))
			->add_fields(array(
				Field::make('select', 'network', admin_text('Network'))
					->set_options(social_network_options()),
				Field::make('text', 'url', admin_text('Profile URL')),
			))
			->set_header_template('<%- network %>'),
	))
	->add_tab(admin_text('Header'), array(
		Field::make('html', 'crb_options_header_note')
			->set_html(sprintf(admin_text('<p><em>The navigation is not edited here. Create it under <a href="%s">Appearance &rsaquo; Menus</a> and tick Header under Menu location. The phone icon on the right of the header comes from Contact Information.</em></p>'), admin_url('nav-menus.php'))),
		Field::make('image', 'crb_options_logo', admin_text('Logo'))
			->set_value_type('url')
			->set_default_value(get_template_directory_uri() . '/images/placeholder-logo.jpg')
			->set_help_text(admin_text('A square image, shown in a rounded frame in the header and the footer. Clear it to show the logo text alone.')),
		Field::make('text', 'crb_options_logo_text', admin_text('Logo Text'))
			->set_default_value('logo')
			->set_help_text(admin_text('Shown next to the logo. Clear it to show the logo image alone.')),
		Field::make('separator', 'crb_options_header_button_sep', admin_text('Header button')),
		Field::make('text', 'crb_options_header_button_text', admin_text('Button Text'))
			->set_help_text(admin_text('An extra button beside the phone icon, for example Request a Call. It only shows when both the text and the link are filled in, and it is empty by default so the header stays as clean as the design.')),
		Field::make('text', 'crb_options_header_button_url', admin_text('Button Link'))
			->set_help_text(admin_text('An anchor such as #contact scrolls to that section of the page.')),
	))
	->add_tab(admin_text('Footer'), array(
		Field::make('html', 'crb_options_footer_note')
			->set_html(sprintf(admin_text('<p><em>The footer menu is created under <a href="%s">Appearance &rsaquo; Menus</a> by ticking Footer under Menu location. The logo comes from the Header tab, and the contact details and social links from Contact Information. Anything left empty is not shown.</em></p>'), admin_url('nav-menus.php'))),
		Field::make('textarea', 'crb_options_footer_text', admin_text('Description'))
			->set_rows(3)
			->set_help_text(admin_text('A short text under the logo.')),
		Field::make('complex', 'crb_options_footer_links', admin_text('Legal Links'))
			->set_collapsed(true)
			->setup_labels(array('plural_name' => admin_text('Links'), 'singular_name' => admin_text('Link')))
			->add_fields(array(
				Field::make('text', 'label', admin_text('Label')),
				Field::make('text', 'url', admin_text('Link')),
			))
			->set_header_template('<%- label %>')
			->set_help_text(admin_text('Privacy Policy, User Agreement and the like. A link needs both a label and an address to show.')),
		Field::make('separator', 'crb_options_footer_legal_sep', admin_text('Legal information')),
		Field::make('text', 'crb_options_footer_entity', admin_text('Legal Entity'))
			->set_help_text(admin_text('The company name, or the full name of the individual entrepreneur.')),
		Field::make('text', 'crb_options_footer_tax_id', admin_text('Tax ID')),
		Field::make('text', 'crb_options_footer_reg_no', admin_text('Registration Number')),
		Field::make('text', 'crb_options_footer_reg_address', admin_text('Registered Address')),
		Field::make('separator', 'crb_options_footer_bottom_sep', admin_text('Bottom line')),
		Field::make('text', 'crb_options_footer_copyright', admin_text('Copyright Text'))
			->set_help_text(admin_text('For example (c) {year} Company name. All rights reserved. {year} becomes the current year.')),
		Field::make('text', 'crb_options_footer_form', admin_text('Newsletter Form Shortcode'))
			->set_help_text(admin_text('Paste the shortcode of your form, for example [wpforms id="121"]. Leave empty and no form is shown.')),
	));
