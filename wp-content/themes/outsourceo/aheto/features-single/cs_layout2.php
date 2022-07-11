<?php
/**
 * The Features Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

extract( $atts );

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', 'widget widget_aheto' );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

// Block Wrapper.
$this->add_render_attribute( 'block_wrapper', 'class', 'aheto-features--outsourceo-creative' );

$cs_overlay  = isset( $cs_overlay ) && ! empty( $cs_overlay ) ? 'overlay-show' : '';
$cs_link_url = isset( $cs_link_url ) && ! empty( $cs_link_url ) ? $cs_link_url : '#';


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/features-single/';
wp_enqueue_style( 'outsourceo-features-single-creative', $sc_dir . 'assets/css/cs_layout2.css', null, null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

    <div <?php $this->render_attribute_string( 'block_wrapper' ); ?>>

        <a href="<?php echo esc_url( $cs_link_url ); ?>">

			<?php $background_image = \Aheto\Helper::get_background_attachment( $s_image, $cs_image_size, $atts, 'cs_' ); ?>

            <div class="aheto-features-block__wrap s-back-switch <?php echo esc_attr( $cs_overlay ); ?>" <?php echo esc_attr( $background_image ); ?>>
				<?php if ( $cs_overlay ) : ?>
                    <span class="aheto-features-block__overlay"
                          style="background-color: <?php echo esc_attr( $cs_overlay_color ); ?>;"></span>
				<?php endif; ?>

				<?php if ( ! empty( $s_heading ) || ! empty( $s_description ) || ! empty( $cs_logo_image ) ) : ?>
                    <div class="aheto-features-block__info">
						<?php if ( ! empty( $cs_logo_image ) ) : ?>
                            <div class="aheto-features-block__image-logo">
								<?php echo \Aheto\Helper::get_attachment( $cs_logo_image, [], $cs_logo_image_size, $atts, 'cs_logo_' ); ?>
                            </div>
						<?php endif; ?>

						<?php if ( ! empty( $s_description ) ) : ?>
                            <h6 class="aheto-features-block__text">
									<?php echo wp_kses( $s_description, 'post' ); ?>
                            </h6>
						<?php endif;

						if ( ! empty( $s_heading ) ) : ?>
                            <h6 class="aheto-features-block__title"><?php echo esc_html( $s_heading ); ?></h6>
						<?php endif; ?>
                    </div>
				<?php endif; ?>

            </div>
        </a>

    </div>

</div>
