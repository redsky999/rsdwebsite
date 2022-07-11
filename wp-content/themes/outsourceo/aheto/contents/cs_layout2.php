<?php
/**
 * The Contents Shortcode.
 */

extract( $atts );

$slides = $this->parse_group( $cs_creative_items );

if ( empty( $slides ) ) {
	return '';
}

if ( ! $cs_swiper_custom_options ) {
	$speed  = 1000;
	$effect = 'fade';
	$loop   = false;
}

$cs_creative_version = isset( $cs_creative_version ) && $cs_creative_version ? 'creative-version' : '';


$this->generate_css();
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-contents' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-contents--outsourceo-creative-slider' );
$this->add_render_attribute( 'wrapper', 'class', $cs_creative_version );


/**
 * Set carousel params
 */
$carousel_default_params = [
	'speed' => 1000,
]; // will use when not chosen option 'Change slider params'

$carousel_params = \Aheto\Helper::get_carousel_params( $atts, 'cs_swiper_', $carousel_default_params );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/contents/';
wp_enqueue_style( 'outsourceo-contents-creative-slider', $sc_dir . 'assets/css/cs_layout2.css', null, null ); ?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>
    <div class="aheto-contents--shape"></div>
    <div class="swiper">
        <div class="swiper-container aheto-contents-swiper-left" <?php echo esc_attr( $carousel_params ); ?>>
            <div class="swiper-wrapper">
				<?php foreach ( $slides as $slide_left ) :
					$slide_left = wp_parse_args( $slide_left, [
						'cs_item_image' => '',
					] );
					extract( $slide_left );

					if ( ! $cs_item_image ) {
						continue;
					}

					$swiper_lazy_class = $cs_swiper_lazy ? ' swiper-lazy' : '';
					$background_image  = Aheto\Helper::get_background_attachment( $cs_item_image, $cs_image_size, $atts, 'cs_', $cs_swiper_lazy ); ?>


                    <div class="swiper-slide">
                        <div class="aheto-contents-slider-wrap<?php echo esc_attr( $swiper_lazy_class ); ?>" <?php echo esc_attr( $background_image ); ?>></div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
        <div class="swiper-container aheto-contents-swiper-right" <?php echo esc_attr( $carousel_params ); ?>
             data-thumbs="1">
            <div class="swiper-wrapper">
				<?php foreach ( $slides as $slide_right ) :
					$slide_right = wp_parse_args( $slide_right, [
						'cs_item_title'         => '',
						'cs_item_desc'          => '',
						'cs_item_btn_direction' => ''
					] );
					extract( $slide_right );
					?>
                    <div class="swiper-slide">
                        <div class="aheto-contents-slider-wrap">

                            <div class="aheto-contents-slider__content">
								<?php if ( ! empty( $cs_item_title ) ) { ?>
                                    <h2 class="aheto-contents__title"><?php echo outsourceo_dot_string( $cs_item_title, $cs_item_use_dot, $cs_item_dot_color ); ?></h2>
								<?php }

								if ( ! empty( $cs_item_desc ) ) { ?>
                                    <p class="aheto-contents__desc"><?php echo wp_kses( $cs_item_desc, 'post' ); ?></p>
								<?php }

								if ( $cs_main_add_button || $cs_add_add_button ) { ?>
                                    <div class="aheto-contents__links">
										<?php
										echo \Aheto\Helper::get_button( $this, $slide_right, 'cs_main_' );
										if ( $cs_item_btn_direction ) { ?>
                                            <br>
										<?php }
										echo \Aheto\Helper::get_button( $this, $slide_right, 'cs_add_' ); ?>
                                    </div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
		<?php

		if ( ! empty( $cs_creative_version ) ) { ?>
            <h6 class="arrow-wrap"><?php $this->swiper_arrow( 'cs_swiper_' ); ?></h6>
		<?php } else {
			$this->swiper_arrow( 'cs_swiper_' );
		} ?>
    </div>

</div>
