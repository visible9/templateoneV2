<?php

/**
 * The template for displaying 404 pages (not found)
 */

/** @noinspection PhpUndefinedFunctionInspection */
get_header();
?>

<section class="page-banner">
	<div class="content-width">
		<h1>That's a 404</h1>
	</div>
</section>

<section class="section-padding">
	<div class="content-width" style="text-align: center;">
		The URL you entered doesn't exist on our site. Perhaps try navigating from <a href="/">our homepage</a>?
	</div><!-- .page-content -->
</section><!-- .error-404 -->

<?php
get_footer();
