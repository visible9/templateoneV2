<?php
/**
 * The template for displaying search results pages
 *
 */


function add_blog_styles(){
	include(locate_template('blog-styles.php'));
}
add_action('wp_head', 'add_blog_styles');

get_header();

	
$term = get_search_query();


?>

<section class="page-banner">
	<div class="content-width">
		<h1>You searched for: <?= $term; ?></h1>
	</div>
</section>

<section class="section-padding">
	<div class="content-width">
		<h2>The following is a list of results for your search term:</h2>
		
<?php
if ( have_posts() ) { ?>

	<div class="posts-container has-blogs">

	<?php
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		?>
		<div class="indiv-post">
			<a href="<?= get_the_permalink(); ?>" class="img-container">
				<?php if(has_post_thumbnail()){ ?>
					<img src=" <?=get_the_post_thumbnail_url(); ?>">
				<?php }else{ ?>
					<span class="empty-thumb-container"></span>
				<?php } ?>
			</a>
			<div class="post-info">
				<p class="date">
					<span class="day"><?= get_the_date('d'); ?></span>
					<span class="y-m-container">
						<span class="year"><?= get_the_date('Y'); ?></span>
						<span class="month"><?= get_the_date('F'); ?></span>
					</span>
				</p>
				<h2 class="title"><?= get_the_title(); ?></h2>
				<p><?= get_the_excerpt(); ?></p>
				<a class="button" href="<?= get_the_permalink(); ?>">Read More</a>
			</div>

		<?php
		?>
		</div>

	<?php } ?>

	</div> <!-- end posts-container -->
	<div class="nav-links">
	<?php
	// Add Previous/next page navigation.
	echo paginate_links(array(
		'prev_text' => '<span>&lt;</span>',
		'next_text' => '<span>&gt;</span>',
	));
	?>
	</div>

<?php } else {
	?>
	<div class="posts-container no-blogs">
		<!-- If no content, include the "No posts found" template. -->
		There are no posts with that category name. <a style="width:100%;" href="/">Return to our homepage.</a>
	</div>

<?php } ?>
</div>
</section>

<?php 
get_footer();
?>
