<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * The site header is here, on every page: the logo, the menu in the middle and only a phone icon on the
 * right. It floats over the hero image and turns solid once the page scrolls (the Header rules in
 * theme-styles.php, the behaviour in includes/theme-changes.php). Every part is printed only when it is
 * filled in: the menu comes from Appearance > Menus (Menu location: Header), the phone number, the
 * logo and the optional button from Theme Options.
 */

$language = get_translation_data()['language'];
$header_menu = theme_menu('header', 'header-menu');
$header_button = theme_option('crb_options_header_button_text') && theme_option('crb_options_header_button_url');
$header_brand = theme_option('crb_options_logo') || theme_option('crb_options_logo_text');

?>
<!doctype html>
<html lang="<?= 'ukrainian' === $language ? 'uk' : 'en'; ?>">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="main">

		<?php /*The decorative grid and glow belong to the previous look. They stay off the pages that open with the hero.*/ ?>
		<?php if (!page_has_hero()) { ?>
			<div class="bg-grid" aria-hidden="true"></div>
			<div class="bg-glow" aria-hidden="true"></div>
		<?php } ?>

		<div class="page-wrap">

			<?php if ($header_brand || $header_menu || theme_phone_href() || $header_button) { ?>
			<header class="site-header<?= $header_menu ? ' has-menu' : ''; ?>">

				<?php if ($header_brand) { ?>
					<a class="brand glass" href="<?= get_home_url(); ?>/" aria-label="<?= theme_option('crb_options_logo_text') ? theme_option('crb_options_logo_text') : get_bloginfo('name'); ?> home">
						<?php if (theme_option('crb_options_logo')) { ?>
							<img class="brand-mark" src="<?= theme_option('crb_options_logo'); ?>" alt="" width="40" height="40" loading="eager">
						<?php } ?>
						<?php if (theme_option('crb_options_logo_text')) { ?>
							<span class="brand-name"><?= theme_option('crb_options_logo_text'); ?></span>
						<?php } ?>
					</a>
				<?php } ?>

				<?php if ($header_menu) { ?>
					<nav class="header-nav glass" id="header-nav" aria-label="Main">
						<?= $header_menu; ?>
						<?php if ($header_button) { ?>
							<div class="nav-extra">
								<a class="button" href="<?= theme_option('crb_options_header_button_url'); ?>"><?= theme_option('crb_options_header_button_text'); ?></a>
							</div>
						<?php } ?>
					</nav>
				<?php } ?>

				<?php if (theme_phone_href() || $header_button || $header_menu) { ?>
					<div class="header-end">
						<?php if (theme_phone_href() || $header_button) { ?>
							<div class="header-actions">
								<?php if (theme_phone_href()) { ?>
									<a class="icon-btn call" href="<?= theme_phone_href(); ?>" aria-label="Call <?= theme_option('crb_options_phone'); ?>"><?= theme_icon('phone'); ?></a>
								<?php } ?>
								<?php if ($header_button) { ?>
									<a class="button small" href="<?= theme_option('crb_options_header_button_url'); ?>"><?= theme_option('crb_options_header_button_text'); ?></a>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if ($header_menu) { ?>
							<button class="icon-btn glass burger" type="button" aria-label="Menu" aria-expanded="false" aria-controls="header-nav"><?= theme_icon('menu'); ?></button>
						<?php } ?>
					</div>
				<?php } ?>

			</header>
			<?php } ?>

			<div id="main-content">
