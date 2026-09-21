<?php

/**
 * Carbon Fields definitions for the theme sections.
 * One container, one tab per section, so the page edit screen keeps a single metabox.
 * Every label, tab, help text and note goes through admin_text() (functions.php), so it reads in English or
 * Ukrainian by the site language. The Ukrainian is in includes/admin-translations.php, keyed by the English text.
 *
 * A tab is only registered when the page being edited holds the shortcode that
 * renders the section, so the client is shown the fields for what is on that
 * page and nothing else. page_uses_section() takes the shortcodes that render
 * the section - a section reused on another page is listed alongside the
 * original - and the crb_<section> prefix its fields share.
 *
 * Sections are collected into $sections rather than added straight to the
 * container, then sorted by section_position() before add_tab() runs - so the
 * tabs read top to bottom in the same order the shortcodes appear in the page
 * content, not the fixed order they are defined in below.
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;


$sections = array();

/*Home Banner - now a Carbon Fields block, see includes/section-blocks.php*/

/*Home About*/
$sections[] = array(
	'shortcodes' => 'home_about',
	'prefix' => 'crb_about',
	'title' => admin_text('Home About'),
	'fields' => array(
		Field::make('html', 'crb_about_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element.</em></p>')),
		Field::make('text', 'crb_about_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_about_title', admin_text('Heading')),
		Field::make('textarea', 'crb_about_text', admin_text('Intro'))
			->set_rows(3)
			->set_help_text(admin_text('The larger paragraph right under the heading.')),
		Field::make('rich_text', 'crb_about_body', admin_text('Body Text')),
		Field::make('image', 'crb_about_image', admin_text('Image'))
			->set_value_type('url')
			->set_help_text(admin_text('Optional. Leave empty to drop the image and centre the text.')),
		Field::make('select', 'crb_about_layout', admin_text('Image Position'))
			->add_options(array(
				'left' => admin_text('Left'),
				'right' => admin_text('Right'),
			))
			->set_default_value('left')
			->set_help_text(admin_text('Which side the image sits on. The text takes the other side.')),
		Field::make('text', 'crb_about_stat_1_value', admin_text('Stat 1 Value'))
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_stat_1_label', admin_text('Stat 1 Label')),
		Field::make('text', 'crb_about_stat_2_value', admin_text('Stat 2 Value'))
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_stat_2_label', admin_text('Stat 2 Label')),
		Field::make('text', 'crb_about_stat_3_value', admin_text('Stat 3 Value'))
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_stat_3_label', admin_text('Stat 3 Label')),
		Field::make('text', 'crb_about_button_text', admin_text('Button Text'))
			->set_help_text(admin_text('Leave empty to hide the button.')),
		Field::make('text', 'crb_about_button_link', admin_text('Button Link')),
	),
);

/*About Revision*/
$sections[] = array(
	'shortcodes' => 'about_rev',
	'prefix' => 'crb_about_rev',
	'title' => admin_text('About Revision'),
	'fields' => array(
		Field::make('html', 'crb_about_rev_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element.</em></p>')),
		Field::make('text', 'crb_about_rev_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('text', 'crb_about_rev_title', admin_text('Heading')),
		Field::make('textarea', 'crb_about_rev_text', admin_text('Intro'))
			->set_rows(3)
			->set_help_text(admin_text('The larger paragraph right under the heading.')),
		Field::make('rich_text', 'crb_about_rev_body', admin_text('Body Text')),
		Field::make('image', 'crb_about_rev_image', admin_text('Image'))
			->set_value_type('url')
			->set_help_text(admin_text('Optional. Leave empty to drop the image and centre the text.')),
		Field::make('select', 'crb_about_rev_layout', admin_text('Image Position'))
			->add_options(array(
				'right' => admin_text('Right'),
			))
			->set_default_value('right')
			->set_help_text(admin_text('Which side the image sits on. The text takes the other side.')),
		Field::make('text', 'crb_about_rev_stat_1_value', admin_text('Stat 1 Value'))
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_rev_stat_1_label', admin_text('Stat 1 Label')),
		Field::make('text', 'crb_about_rev_stat_2_value', admin_text('Stat 2 Value'))
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_rev_stat_2_label', admin_text('Stat 2 Label')),
		Field::make('text', 'crb_about_rev_stat_3_value', admin_text('Stat 3 Value'))
			->set_help_text(admin_text('Leave empty to hide this stat.')),
		Field::make('text', 'crb_about_rev_stat_3_label', admin_text('Stat 3 Label')),
		Field::make('text', 'crb_about_rev_button_text', admin_text('Button Text'))
			->set_help_text(admin_text('Leave empty to hide the button.')),
		Field::make('text', 'crb_about_rev_button_link', admin_text('Button Link')),
	),
);

/*Home Mission*/
$sections[] = array(
	'shortcodes' => 'home_mission',
	'prefix' => 'crb_mission',
	'title' => admin_text('Home Mission'),
	'fields' => array(
		Field::make('html', 'crb_mission_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. Add as many items as you need.</em></p>')),
		Field::make('text', 'crb_mission_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_mission_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_mission_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('complex', 'crb_mission_items', admin_text('Items'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- title %>')
			->add_fields(array(
				Field::make('text', 'tag', admin_text('Tag'))
					->set_help_text(admin_text('Small label above the title. Leave empty to hide it.')),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('An item without a title is skipped. Items are numbered automatically.')),
				Field::make('textarea', 'text', admin_text('Text'))
					->set_rows(3),
			)),
	),
);

/*Home Services*/
$sections[] = array(
	'shortcodes' => 'home_services',
	'prefix' => 'crb_services',
	'title' => admin_text('Home Services'),
	'fields' => array(
		Field::make('html', 'crb_services_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. Add as many items as you need.</em></p>')),
		Field::make('text', 'crb_services_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_services_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('complex', 'crb_services_items', admin_text('Items'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- title %>')
			->add_fields(array(
				Field::make('text', 'tag', admin_text('Tag'))
					->set_help_text(admin_text('Small label above the title. Leave empty to hide it.')),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('An item without a title is skipped.')),
				Field::make('textarea', 'text', admin_text('Text'))
					->set_rows(3),
			)),
	),
);

/*Home Pricing*/
$sections[] = array(
	'shortcodes' => 'home_pricing',
	'prefix' => 'crb_pricing',
	'title' => admin_text('Home Pricing'),
	'fields' => array(
		Field::make('html', 'crb_pricing_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. Add as many packages as you need. A package left without a price is shown with a dashed border, for one still to be scoped.</em></p>')),
		Field::make('text', 'crb_pricing_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_pricing_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_pricing_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('complex', 'crb_pricing_items', admin_text('Packages'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- title %>')
			->add_fields(array(
				Field::make('text', 'tier', admin_text('Tier Label'))
					->set_help_text(admin_text('Shown next to the level dots, e.g. "Lot 1 · Quick (Full DIY)". Leave empty to hide the whole tier row.')),
				Field::make('select', 'level', admin_text('Level'))
					->set_options(array(
						'1' => admin_text('1 of 3'),
						'2' => admin_text('2 of 3'),
						'3' => admin_text('3 of 3'),
					))
					->set_default_value('1')
					->set_help_text(admin_text('How many of the three dots are filled in, from lightest (1) to most involved (3).')),
				Field::make('text', 'price', admin_text('Price'))
					->set_help_text(admin_text('Leave empty for a package still to be scoped — the card is shown with a dashed border and no price.')),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A package without a title is skipped.')),
				Field::make('textarea', 'audience', admin_text('Who It\'s For'))
					->set_rows(2)
					->set_help_text(admin_text('Shown after a bold "For:" label. Leave empty to hide it.')),
				Field::make('textarea', 'problem', admin_text('The Problem'))
					->set_rows(2)
					->set_help_text(admin_text('Leave empty to hide this block.')),
				Field::make('textarea', 'fix', admin_text('The Fix'))
					->set_rows(2)
					->set_help_text(admin_text('Leave empty to hide this block.')),
				Field::make('checkbox', 'show_how_it_works', admin_text('Show "How It Works"'))
					->set_default_value(false)
					->set_help_text(admin_text('Off by default. Turn on to add a numbered "How It Works" list to this card.')),
				Field::make('complex', 'how_it_works_items', admin_text('How It Works Steps'))
					->set_layout('tabbed-vertical')
					->set_header_template('<%- text %>')
					->add_fields(array(
						Field::make('text', 'text', admin_text('Step')),
					))
					->set_conditional_logic(array(
						array('field' => 'show_how_it_works', 'value' => true),
					)),
				Field::make('checkbox', 'show_can_do', admin_text('Show "What The Site Can Do"'))
					->set_default_value(false)
					->set_help_text(admin_text('Off by default. Turn on to add a checklist titled "What The Site Can Do" to this card.')),
				Field::make('complex', 'can_do_items', admin_text('What The Site Can Do Items'))
					->set_layout('tabbed-vertical')
					->set_header_template('<%- text %>')
					->add_fields(array(
						Field::make('text', 'text', admin_text('Item')),
					))
					->set_conditional_logic(array(
						array('field' => 'show_can_do', 'value' => true),
					)),
				Field::make('checkbox', 'show_whats_inside', admin_text('Show "What\'s Inside"'))
					->set_default_value(false)
					->set_help_text(admin_text('Off by default. Turn on to add a checklist titled "What\'s Inside" to this card.')),
				Field::make('complex', 'whats_inside_items', admin_text('What\'s Inside Items'))
					->set_layout('tabbed-vertical')
					->set_header_template('<%- text %>')
					->add_fields(array(
						Field::make('text', 'text', admin_text('Item')),
					))
					->set_conditional_logic(array(
						array('field' => 'show_whats_inside', 'value' => true),
					)),
				Field::make('text', 'limit', admin_text('Limited Availability Note'))
					->set_help_text(admin_text('Small badge in the footer, e.g. "Only 10 kits at this price". Leave empty to hide it.')),
				Field::make('text', 'button_text', admin_text('Button Text'))
					->set_help_text(admin_text('Leave empty to hide the button.')),
				Field::make('text', 'button_link', admin_text('Button Link')),
			)),
	),
);

/*Home Portfolio*/
$sections[] = array(
	'shortcodes' => 'home_portfolio',
	'prefix' => 'crb_portfolio',
	'title' => admin_text('Home Portfolio'),
	'fields' => array(
		Field::make('html', 'crb_portfolio_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. Clicking a tile on the front end opens the image in a lightbox. Add as many projects as you need.</em></p>')),
		Field::make('text', 'crb_portfolio_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_portfolio_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_portfolio_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('complex', 'crb_portfolio_items', admin_text('Projects'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- title %>')
			->add_fields(array(
				Field::make('image', 'image', admin_text('Image'))
					->set_value_type('url')
					->set_help_text(admin_text('Shown on the tile and opened full size in the lightbox.')),
				Field::make('text', 'title', admin_text('Title'))
					->set_help_text(admin_text('A project without a title is skipped.')),
				Field::make('text', 'category', admin_text('Category')),
			)),
		Field::make('text', 'crb_portfolio_button_text', admin_text('Button Text'))
			->set_help_text(admin_text('Leave empty to hide the button.')),
		Field::make('text', 'crb_portfolio_button_link', admin_text('Button Link')),
	),
);

/*Home News*/
$sections[] = array(
	'shortcodes' => 'home_news',
	'prefix' => 'crb_news',
	'title' => admin_text('Home News'),
	'fields' => array(
		Field::make('html', 'crb_news_note')
			->set_html(admin_text('<p><em>The cards come from the three latest blog posts, with their featured image, date, title and excerpt. While the blog has no posts yet the section shows three demo cards instead. Only the heading and the button are edited here.</em></p>')),
		Field::make('text', 'crb_news_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_news_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_news_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('text', 'crb_news_button_text', admin_text('Button Text'))
			->set_help_text(admin_text('Leave empty to hide the button.')),
		Field::make('text', 'crb_news_button_link', admin_text('Button Link'))
			->set_help_text(admin_text('Defaults to the Posts page set in Settings > Reading. Without one the button stays hidden.')),
	),
);

/*Home Results*/
$sections[] = array(
	'shortcodes' => 'home_results',
	'prefix' => 'crb_results',
	'title' => admin_text('Home Results'),
	'fields' => array(
		Field::make('html', 'crb_results_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. On the front end each metric counts up from zero when it scrolls into view, so text around the number is kept: 250+, 1.4s and 98% all work.</em></p>')),
		Field::make('complex', 'crb_results_items', admin_text('Metrics'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- number %>')
			->add_fields(array(
				Field::make('text', 'number', admin_text('Value'))
					->set_help_text(admin_text('A metric without a value is skipped. Text around the number is kept, so 250+ or 1.4s work.')),
				Field::make('text', 'label', admin_text('Label')),
			)),
		Field::make('textarea', 'crb_results_caption', admin_text('Caption'))
			->set_rows(2)
			->set_help_text(admin_text('Small note under the metrics. Leave empty to hide it.')),
	),
);

/*Home Team*/
$sections[] = array(
	'shortcodes' => 'home_team',
	'prefix' => 'crb_team',
	'title' => admin_text('Home Team'),
	'fields' => array(
		Field::make('html', 'crb_team_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. Add as many team members as you need.</em></p>')),
		Field::make('text', 'crb_team_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_team_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_team_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('complex', 'crb_team_members', admin_text('Team Members'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- name %>')
			->add_fields(array(
				Field::make('image', 'photo', admin_text('Photo'))
					->set_value_type('url')
					->set_help_text(admin_text('A portrait crop works best. Leave empty for a plain placeholder.')),
				Field::make('text', 'name', admin_text('Name'))
					->set_help_text(admin_text('A member without a name is skipped.')),
				Field::make('text', 'role', admin_text('Role')),
				Field::make('complex', 'socials', admin_text('Social Links'))
					->set_layout('tabbed-horizontal')
					->set_header_template('<%- network %>')
					->add_fields(array(
						Field::make('select', 'network', admin_text('Network'))
							->set_options(social_network_options()),
						Field::make('text', 'url', admin_text('Profile URL')),
					)),
			)),
	),
);

/*Home Social*/
$sections[] = array(
	'shortcodes' => 'home_social',
	'prefix' => 'crb_social',
	'title' => admin_text('Home Social'),
	'fields' => array(
		Field::make('html', 'crb_social_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. A link with no URL is skipped, and the whole strip disappears if nothing is left.</em></p>')),
		Field::make('text', 'crb_social_title', admin_text('Heading'))
			->set_help_text(admin_text('Leave empty to hide it.')),
		Field::make('text', 'crb_social_handle', admin_text('Handle'))
			->set_help_text(admin_text('A short handle under the heading, for example @studio. Leave empty to hide it.')),
		Field::make('complex', 'crb_social_links', admin_text('Social Links'))
			->set_layout('tabbed-horizontal')
			->set_header_template('<%- network %>')
			->add_fields(array(
				Field::make('select', 'network', admin_text('Network'))
					->set_options(social_network_options()),
				Field::make('text', 'url', admin_text('Profile URL')),
			)),
	),
);

/*Home Testimonials*/
$sections[] = array(
	'shortcodes' => 'home_testimonials',
	'prefix' => 'crb_testimonials',
	'title' => admin_text('Home Testimonials'),
	'fields' => array(
		Field::make('html', 'crb_testimonials_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. The quotes run as a slider; with only one quote the arrows and dots are dropped.</em></p>')),
		Field::make('text', 'crb_testimonials_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_testimonials_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('complex', 'crb_testimonials_items', admin_text('Testimonials'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- name %>')
			->add_fields(array(
				Field::make('textarea', 'text', admin_text('Quote'))
					->set_rows(4)
					->set_help_text(admin_text('A testimonial with no quote is skipped.')),
				Field::make('text', 'name', admin_text('Name')),
				Field::make('text', 'role', admin_text('Role and Company')),
			)),
	),
);

/*Home CTA*/
$sections[] = array(
	'shortcodes' => 'home_cta',
	'prefix' => 'crb_cta',
	'title' => admin_text('Home CTA'),
	'fields' => array(
		Field::make('html', 'crb_cta_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element.</em></p>')),
		Field::make('text', 'crb_cta_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_cta_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_cta_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('text', 'crb_cta_button_text', admin_text('Button Text'))
			->set_help_text(admin_text('Leave empty to hide the button.')),
		Field::make('text', 'crb_cta_button_link', admin_text('Button Link')),
	),
);

/*Home FAQ*/
$sections[] = array(
	'shortcodes' => 'home_faq',
	'prefix' => 'crb_faq',
	'title' => admin_text('Home FAQ'),
	'fields' => array(
		Field::make('html', 'crb_faq_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. The list is an accordion: opening one answer closes the previous one.</em></p>')),
		Field::make('text', 'crb_faq_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_faq_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_faq_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('complex', 'crb_faq_items', admin_text('Questions'))
			->set_layout('tabbed-vertical')
			->set_header_template('<%- question %>')
			->add_fields(array(
				Field::make('text', 'question', admin_text('Question'))
					->set_help_text(admin_text('An entry with no question is skipped.')),
				Field::make('rich_text', 'answer', admin_text('Answer')),
			)),
	),
);

/*Home Contact*/
$sections[] = array(
	'shortcodes' => 'home_contact',
	'prefix' => 'crb_contact',
	'title' => admin_text('Home Contact'),
	'fields' => array(
		Field::make('html', 'crb_contact_note')
			->set_html(admin_text('<p><em>This section shows demo content until you fill in any field below. Once it holds content, an empty field simply hides that element. The form area only appears once a shortcode is pasted in, and without it the section drops to a single column.</em></p>')),
		Field::make('text', 'crb_contact_eyebrow', admin_text('Eyebrow'))
			->set_help_text(admin_text('Small label above the heading. Leave empty to hide it.')),
		Field::make('textarea', 'crb_contact_title', admin_text('Heading'))
			->set_rows(2),
		Field::make('textarea', 'crb_contact_text', admin_text('Intro'))
			->set_rows(3),
		Field::make('textarea', 'crb_contact_address', admin_text('Address'))
			->set_rows(2)
			->set_help_text(admin_text('Leave empty to hide it.')),
		Field::make('text', 'crb_contact_phone', admin_text('Phone'))
			->set_help_text(admin_text('Shown as a tel: link. Leave empty to hide it.')),
		Field::make('text', 'crb_contact_email', admin_text('Email'))
			->set_help_text(admin_text('Shown as a mailto: link. Leave empty to hide it.')),
		Field::make('complex', 'crb_contact_socials', admin_text('Social Links'))
			->set_layout('tabbed-horizontal')
			->set_header_template('<%- network %>')
			->add_fields(array(
				Field::make('select', 'network', admin_text('Network'))
					->set_options(social_network_options()),
				Field::make('text', 'url', admin_text('Profile URL')),
			)),
		Field::make('text', 'crb_contact_form', admin_text('Form Shortcode'))
			->set_help_text(admin_text('Paste the shortcode of your contact form, for example [formidable key=contact-form]. Use the form key rather than its id: ids change when the site moves from staging to live. Leave empty and no form is shown.')),
	),
);

usort($sections, function ($a, $b) {
	$pa = section_position($a['shortcodes']);
	$pb = section_position($b['shortcodes']);
	if ($pa === $pb) {
		return 0;
	}
	if ($pa === null) {
		return 1;
	}
	if ($pb === null) {
		return -1;
	}
	return $pa <=> $pb;
});

/*The container only exists when the page holds at least one of these sections. A page with just block sections, whose fields live inside the blocks, gets no empty Page Sections box.*/
$container = null;
foreach ($sections as $section) {
	if (page_uses_section($section['shortcodes'], $section['prefix'])) {
		if (!$container) {
			$container = Container::make('post_meta', 'page_sections', admin_text('Page Sections'))
				->where('post_type', '=', 'page')
				->set_context('normal')
				->set_priority('high')
				->set_layout('tabbed-vertical');
		}
		$container->add_tab($section['title'], $section['fields']);
	}
}
