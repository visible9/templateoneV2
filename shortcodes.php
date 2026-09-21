<?php
/******HOME SHORTCODES*******/
function home_banner($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-banner.php'));
	return ob_get_clean();
}
add_shortcode('home_banner', 'home_banner');


function home_services($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-services.php'));
	return ob_get_clean();
}
add_shortcode('home_services', 'home_services');


function home_about($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-about.php'));
	return ob_get_clean();
}
add_shortcode('home_about', 'home_about');


function home_team($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-team.php'));
	return ob_get_clean();
}
add_shortcode('home_team', 'home_team');


function home_cta($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-cta.php'));
	return ob_get_clean();
}
add_shortcode('home_cta', 'home_cta');


function home_results($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-results.php'));
	return ob_get_clean();
}
add_shortcode('home_results', 'home_results');


function home_testimonials($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-testimonials.php'));
	return ob_get_clean();
}
add_shortcode('home_testimonials', 'home_testimonials');


function home_social($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-social.php'));
	return ob_get_clean();
}
add_shortcode('home_social', 'home_social');


function home_news($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-news.php'));
	return ob_get_clean();
}
add_shortcode('home_news', 'home_news');


function home_contact($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-contact.php'));
	return ob_get_clean();
}
add_shortcode('home_contact', 'home_contact');


function home_mission($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-mission.php'));
	return ob_get_clean();
}
add_shortcode('home_mission', 'home_mission');


function home_pricing($atts, $content=null){
	ob_start();
	include(locate_template('template-parts/sections/home/home-pricing.php'));
	return ob_get_clean();
}
add_shortcode('home_pricing', 'home_pricing');


function home_portfolio($atts, $content=null){
	ob_start();	
	include(locate_template('template-parts/sections/home/home-portfolio.php'));
	return ob_get_clean();
}
add_shortcode('home_portfolio', 'home_portfolio');




function home_faq($atts, $content=null){
	ob_start();
	include(locate_template('template-parts/sections/home/home-faq.php'));
	return ob_get_clean();
}
add_shortcode('home_faq', 'home_faq');


/******ABOUT PAGE SHORTCODES*******/
function about_rev($atts, $content=null){
	ob_start();
	include(locate_template('template-parts/pages/about/section-about-rev.php'));
	return ob_get_clean();
}
add_shortcode('about_rev', 'about_rev');


/******CUSTOM SHORTCODES*******/