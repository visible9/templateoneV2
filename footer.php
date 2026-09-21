<?php

/**
 * The template for displaying the footer
 *
 * Everything here comes from Theme Options (Contact Information, Header for the logo, Footer) and from the
 * menu assigned to the Footer location in Appearance > Menus. Each part is printed only when it is filled
 * in, wrapper and heading included, and when nothing at all is filled in the footer itself is left out.
 * The headings are interface text, not fields, and exist in English and Ukrainian.
 */

$language = get_translation_data()['language'];
$footer_menu = theme_menu('footer', 'footer-menu');
$footer_links = theme_option_rows('crb_options_footer_links', array('label', 'url'));
$footer_socials = array_filter(theme_option_rows('crb_options_socials', array('network', 'url')), function ($row) {
	return (bool) social_icon($row['network']);
});
$footer_form = theme_form('crb_options_footer_form');
$footer_copyright = str_replace('{year}', date('Y'), theme_option('crb_options_footer_copyright'));
$footer_brand = theme_option('crb_options_logo') || theme_option('crb_options_logo_text') || theme_option('crb_options_footer_text');
$footer_contacts = theme_phone_href() || theme_option('crb_options_email') || theme_option('crb_options_address') || theme_option('crb_options_hours');
$footer_legal = theme_option('crb_options_footer_entity') || theme_option('crb_options_footer_tax_id') || theme_option('crb_options_footer_reg_no') || theme_option('crb_options_footer_reg_address');
$footer_columns = $footer_menu || $footer_links || $footer_contacts || $footer_form;

?>

</div><!-- end #main-content -->

<?php if ($footer_brand || $footer_columns || $footer_legal || $footer_copyright || $footer_socials) { ?>
	<footer class="site-footer">
		<div class="content-width">

			<?php if ($footer_brand || $footer_columns) { ?>
				<div class="footer-top">

					<?php if ($footer_brand) { ?>
						<div class="footer-brand">
							<?php if (theme_option('crb_options_logo') || theme_option('crb_options_logo_text')) { ?>
								<a class="logo-container" href="<?= get_home_url(); ?>/">
									<?php if (theme_option('crb_options_logo')) { ?>
										<img src="<?= theme_option('crb_options_logo'); ?>" alt="" width="40" height="40" loading="lazy">
									<?php } ?>
									<?php if (theme_option('crb_options_logo_text')) { ?>
										<span class="logo-text"><?= theme_option('crb_options_logo_text'); ?></span>
									<?php } ?>
								</a>
							<?php } ?>
							<?php if (theme_option('crb_options_footer_text')) { ?>
								<p><?= nl2br(theme_option('crb_options_footer_text')); ?></p>
							<?php } ?>
						</div>
					<?php } ?>

					<?php if ($footer_columns) { ?>
						<div class="footer-cols">

							<?php if ($footer_menu) { ?>
								<div class="footer-col">
									<span class="footer-col-title"><?= 'english' === $language ? 'Menu' : 'Меню'; ?></span>
									<?= $footer_menu; ?>
								</div>
							<?php } ?>

							<?php if ($footer_links) { ?>
								<div class="footer-col">
									<span class="footer-col-title"><?= 'english' === $language ? 'Legal' : 'Правова інформація'; ?></span>
									<ul class="footer-menu">
										<?php foreach ($footer_links as $link) { ?>
											<li><a href="<?= $link['url']; ?>"><?= $link['label']; ?></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>

							<?php if ($footer_contacts) { ?>
								<div class="footer-col footer-contacts-col">
									<span class="footer-col-title"><?= 'english' === $language ? 'Contacts' : 'Контакти'; ?></span>
									<div class="footer-contacts">
										<?php if (theme_phone_href()) { ?>
											<a href="<?= theme_phone_href(); ?>"><?= theme_option('crb_options_phone'); ?></a>
										<?php } ?>
										<?php if (theme_option('crb_options_email')) { ?>
											<a href="mailto:<?= theme_option('crb_options_email'); ?>"><?= theme_option('crb_options_email'); ?></a>
										<?php } ?>
										<?php if (theme_option('crb_options_address')) { ?>
											<span><?= nl2br(theme_option('crb_options_address')); ?></span>
										<?php } ?>
										<?php if (theme_option('crb_options_hours')) { ?>
											<span><?= theme_option('crb_options_hours'); ?></span>
										<?php } ?>
									</div>
								</div>
							<?php } ?>

							<?php if ($footer_form) { ?>
								<div class="footer-col footer-form-col">
									<span class="footer-col-title"><?= 'english' === $language ? 'Subscribe to our newsletter' : 'Підпишіться на розсилку'; ?></span>
									<div class="footer-form"><?= $footer_form; ?></div>
								</div>
							<?php } ?>

						</div>
					<?php } ?>

				</div>
			<?php } ?>

			<?php if ($footer_legal) { ?>
				<div class="footer-legal-info">
					<?php if (theme_option('crb_options_footer_entity')) { ?>
						<div class="legal-item"><span class="legal-label"><?= 'english' === $language ? 'Legal entity' : 'Юридична особа'; ?></span><span><?= theme_option('crb_options_footer_entity'); ?></span></div>
					<?php } ?>
					<?php if (theme_option('crb_options_footer_tax_id')) { ?>
						<div class="legal-item"><span class="legal-label"><?= 'english' === $language ? 'Tax ID' : 'ІПН'; ?></span><span><?= theme_option('crb_options_footer_tax_id'); ?></span></div>
					<?php } ?>
					<?php if (theme_option('crb_options_footer_reg_no')) { ?>
						<div class="legal-item"><span class="legal-label"><?= 'english' === $language ? 'Registration no.' : 'Реєстраційний номер'; ?></span><span><?= theme_option('crb_options_footer_reg_no'); ?></span></div>
					<?php } ?>
					<?php if (theme_option('crb_options_footer_reg_address')) { ?>
						<div class="legal-item"><span class="legal-label"><?= 'english' === $language ? 'Registered address' : 'Юридична адреса'; ?></span><span><?= theme_option('crb_options_footer_reg_address'); ?></span></div>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if ($footer_copyright || $footer_socials) { ?>
				<div class="footer-bottom">
					<?php if ($footer_copyright) { ?>
						<p class="footer-copyright"><?= $footer_copyright; ?></p>
					<?php } ?>
					<?php if ($footer_socials) { ?>
						<div class="footer-social social-icons">
							<?php foreach ($footer_socials as $social) { ?>
								<a class="social-link" href="<?= $social['url']; ?>" target="_blank" rel="noopener" aria-label="<?= social_label($social['network']); ?>"><?= social_icon($social['network']); ?></a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

		</div>
	</footer>
<?php } ?>

</div><!-- end .page-wrap -->

</div><!-- end #main -->

<?php wp_footer(); ?>
</body>

</html>
