<?php
/**
 * Single post
 */


get_header();

while ( have_posts() ) :
	the_post();

	$post_id = get_the_ID();


	get_template_part( 'template-parts/blog', 'single' );
	wp_enqueue_style('outsourceo-blog-single', OUTSOURCEO_T_URI . '/assets/css/blog/blog-single.css');

endwhile;

get_footer();


