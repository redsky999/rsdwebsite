<?php
/*
 * Single post
 */


$protected = '';

if ( post_password_required() ) {
	$protected = 'protected-page';
}

$get_id    = get_the_ID();
$author_id = get_the_author_meta( 'ID' );

$content_size_class = is_active_sidebar( 'outsourceo-sidebar' ) ? 'col-12 col-lg-8' : 'col-12'; ?>

<div class="outsourceo-blog--single-wrapper <?php echo esc_attr( $protected ); ?>">
    <div class="outsourceo-blog--single__top-content">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="outsourceo-blog--single__columns">
                        <div class="outsourceo-blog--single__top-content-left">

                            <div class="outsourceo-blog--single__categories">
								<?php the_category( ' ' ); ?>
                            </div>

							<?php the_title( '<h1 class="outsourceo-blog--single__title">', '</h1>' ); ?>

                            <div class="outsourceo-blog--single__date"><?php the_time( get_option( 'date_format' ) ); ?></div>

                        </div>

                        <div class="outsourceo-blog--single__top-content-right">

                            <div class="outsourceo-blog--single__author">

								<?php echo get_avatar( $author_id, 50 );
								echo esc_html( get_the_author() ); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container outsourceo-blog--single__post-content">
        <div class="row">
            <div class="col-12 <?php echo esc_attr( $content_size_class ); ?>">
				<?php if ( has_post_thumbnail() ) { ?>
                    <div class="outsourceo-blog--single__banner">
						<?php $image_url = get_the_post_thumbnail_url( $get_id, 'full' );
						$image_id        = get_post_thumbnail_id( $get_id );
						$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>

                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">

                    </div>
				<?php } ?>

                <div class="outsourceo-blog--single__content-wrapper">

					<?php the_content();
					wp_link_pages( 'link_before=<span class="outsourceo-blog--single__pages">&link_after=</span>&before=<div class="outsourceo-blog--single__post-nav"> <span>' . esc_html__( "Page:", 'outsourceo' ) . ' </span> &after=</div>' ); ?>

					<?php the_tags(
						'<div class="outsourceo-blog--single__tags">
                        <i class="ion-ios-pricetags-outline"></i>',
						' / ',
						'</div>' ); ?>

                </div>

				<?php if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) { ?>
                    <div class="outsourceo-blog--single__comments">
						<?php comments_template( '', true ); ?>
                    </div>
				<?php } ?>

                <div class="outsourceo-blog--single__pagination">
                    <div class="outsourceo-blog--single__pagination-prev">
						<?php $prev_post     = get_previous_post();
                            if ( ! empty( $prev_post ) ) :
                                $prev_thumbnail = get_the_post_thumbnail_url( $prev_post->ID, 'thumbnail' );
                                $prev_post_title = ! empty( get_the_title( $prev_post ) ) ? get_the_title( $prev_post ) : esc_html__( 'No title', 'outsourceo' );
                                $prev_link       = get_permalink( $prev_post ); ?>


                                <?php if ( ! empty( $prev_thumbnail ) ) { ?>
                                <a href="<?php echo esc_url( $prev_link ); ?>" class="img-wrap">
                                    <img src="<?php echo esc_url( $prev_thumbnail ); ?>"
                                         alt="<?php echo esc_attr( $prev_post_title ); ?>">
                                </a>
                            <?php } ?>
                            <span>
                                <a href="<?php echo esc_url( $prev_link ); ?>" class="content">
                                        <?php echo wp_kses($prev_post_title, 'post'); ?>
                                </a>
								<?php esc_html_e( 'Prev post', 'outsourceo' ); ?>
                            </span>

						<?php endif; ?>
                    </div>

					<?php $next_post = get_next_post(); ?>
                    <div class="outsourceo-blog--single__pagination-next">
						<?php if ( ! empty( $next_post ) ) :
							$next_thumbnail = get_the_post_thumbnail_url( $next_post->ID, 'thumbnail' );
							$next_post_title = ! empty( get_the_title( $next_post ) ) ? get_the_title( $next_post ) : esc_html__( 'No title', 'outsourceo' );
							$next_link = get_permalink( $next_post ); ?>


                            <span>
                                <a href="<?php echo esc_url( $next_link ); ?>" class="content">
                                    <?php echo wp_kses($next_post_title, 'post'); ?>
                                </a>
								<?php esc_html_e( 'Next post', 'outsourceo' ); ?>
                            </span>
							<?php if ( ! empty( $next_thumbnail ) ) { ?>
                            <a href="<?php echo esc_url( $next_link ); ?>" class="img-wrap">
                                <img src="<?php echo esc_url( $next_thumbnail ); ?>"
                                     alt="<?php echo esc_attr( $next_post_title ); ?>">
                            </a>
						<?php } ?>

						<?php endif; ?>
                    </div>
                </div>

            </div>
			<?php if ( is_active_sidebar( 'outsourceo-sidebar' ) ) {

				wp_enqueue_style( 'outsourceo-sidebar', OUTSOURCEO_T_URI . '/assets/css/blog/sidebar.css' );

				get_sidebar( 'outsourceo-sidebar' );

			} ?>
        </div>
    </div>
</div>