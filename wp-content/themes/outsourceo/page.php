<?php
/**
 * Custom Page Template
 */

get_header();

$protected = '';

if ( post_password_required() ) {
	$protected = 'protected-page';
}

while ( have_posts() ) : the_post();

	wp_enqueue_style( 'outsourceo-blog-single', OUTSOURCEO_T_URI . '/assets/css/blog/blog-single.css' ); ?>

    <div class="outsourceo-blog--single-wrapper <?php echo esc_attr( $protected ); ?>">
    <?php if (function_exists('is_woocommerce') && (is_cart() || is_checkout() || is_account_page())) {

        $outsourceo_img = '';
        $outsourceo_background_image = '';

        if (function_exists('aheto')) {
            $outsourceo_shop_image = Aheto\Helper::get_settings('theme-options.outsourceo_shop_image');
            $outsourceo_background_image = isset($outsourceo_shop_image) && !empty($outsourceo_shop_image) ? "style=background-image:url(" . $outsourceo_shop_image . ")" : '';
            $outsourceo_img = isset($outsourceo_shop_image) && !empty($outsourceo_shop_image) ? 'with-image' : '';
        } ?>

        <div class="outsourceo-shop-banner <?php echo esc_attr($outsourceo_img); ?> " <?php echo esc_attr($outsourceo_background_image); ?>>
            <h1 class="title"><?php the_title(); ?></h1>
        </div>

    <?php } else { ?>
        <div class="outsourceo-blog--single__top-content">

            <div class="container">
                <div class="row">
                    <div class="col-12">

						<?php the_title( '<h1 class="outsourceo-blog--single__title text-center">', '</h1>' ); ?>

                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
        <div class="container outsourceo-blog--single__post-content">
            <div class="row">
                <div class="col-12">

                    <div class="outsourceo-blog--single__content-wrapper page">

						<?php the_content();
						wp_link_pages( 'link_before=<span class="outsourceo-blog--single__pages">&link_after=</span>&before=<div class="outsourceo-blog--single__post-nav"> <span>' . esc_html__( "Page:", 'outsourceo' ) . ' </span> &after=</div>' ); ?>

                    </div>

					<?php if ( comments_open() || '0' != get_comments_number() && wp_count_comments( $get_id ) ) { ?>
                        <div class="outsourceo-blog--single__comments page">
							<?php comments_template( '', true ); ?>
                        </div>
					<?php } ?>

                </div>
            </div>
        </div>
    </div>


<?php
endwhile;

get_footer();
