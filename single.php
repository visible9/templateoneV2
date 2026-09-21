<?php
/**
 * The template for displaying all single posts
 */

function add_single_blog_styles(){
	include(locate_template('single-blog-styles.php'));
}
add_action('wp_head', 'add_single_blog_styles');

get_header();
?>

		<?php

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			?>
			<section class="section-padding single-post">
				<div class="content-width">
					<h1><?= get_the_title(); ?></h1>
					<div class="author-date"><strong><?= get_the_author(); ?></strong> | <?= get_the_date(); ?></div>

					<?php if(has_post_thumbnail()){ ?>
						<div class="img-container">
							<img src=" <?=get_the_post_thumbnail_url(); ?>">
						</div>
					<?php } ?>
					<div class="blog-content">
			<?php  the_content();


			// Previous/next post navigation.
			
		endwhile; // End of the loop.
		?>

		</div>
	</div>
</section>

<?php get_footer(); ?>
