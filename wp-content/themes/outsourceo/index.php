<?php
/**
 * Index Page
 *
 * @package outsourceo
 * @since 1.0
 *
 */

$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$term  = get_query_var( 's' );

$args = array(
	'post_type' => 'post',
	'paged'     => $paged,
);

if ( is_search() ) {
	$args['s'] = $term;
}

$posts = new WP_Query( $args );

$count = isset( $posts->found_posts ) && ! empty( $posts->found_posts ) ? $posts->found_posts : '0';
$count_text = $count == '1' ? esc_html__( 'result found', 'outsourceo' ) : esc_html__( 'results found', 'outsourceo' );


$outsourceo_img = '';
$outsourceo_background_image = '';

if (function_exists('aheto')) {
    $outsourceo_shop_image = Aheto\Helper::get_settings('theme-options.outsourceo_blog_image');
    $outsourceo_background_image = isset($outsourceo_shop_image) && !empty($outsourceo_shop_image) ? "style=background-image:url(" . $outsourceo_shop_image . ")" : '';
    $outsourceo_img = isset($outsourceo_shop_image) && !empty($outsourceo_shop_image) ? 'with-image' : '';
}

get_header(); ?>
    <div class="outsourceo-blog--banner <?php echo esc_attr($outsourceo_img); ?> " <?php echo esc_attr($outsourceo_background_image); ?>>
		<?php if ( is_search() ) { ?>
            <div class="outsourceo-blog--banner__title-wrap">
                <h1 class="outsourceo-blog--banner__title"><?php esc_html_e( 'Showing results for ', 'outsourceo' ); ?>
                    <span>"<?php echo esc_html( $term ); ?>"</span></h1>
                <div class="outsourceo-blog--banner__count-results"><?php echo esc_html( $count . ' ' . $count_text ); ?></div>
            </div>
		<?php } else { ?>
            <div class="outsourceo-blog--banner__title-wrap">
                <h1 class="outsourceo-blog--banner__title"><?php esc_html_e( 'Latest News & Industry Updates', 'outsourceo' ); ?></h1>
            </div>
		<?php } ?>
    </div>

<?php

if ( $posts->have_posts() ) :
	get_template_part( 'template-parts/blog', 'list' );
	wp_enqueue_style( 'outsourceo-blog-list', OUTSOURCEO_T_URI . '/assets/css/blog/blog-list.css' );

else :

	wp_enqueue_style( 'outsourceo-blog-list', OUTSOURCEO_T_URI . '/assets/css/blog/blog-list.css' ); ?>

    <div class="outsourceo-blog--search-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="outsourceo-blog--search-page__title"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'outsourceo' ); ?></h3>
                    <div class="outsourceo-blog--search-page__search-form">
						<?php get_search_form( true ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;

get_footer();
