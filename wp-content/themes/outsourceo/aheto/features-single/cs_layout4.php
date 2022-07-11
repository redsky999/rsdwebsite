<?php
/**
 * The Features Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract( $atts );

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

// Button.
$button = $this->get_button_attributes( 'link' );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/features-single/';
wp_enqueue_style( 'outsourceo-features-single-with-background', $sc_dir . 'assets/css/cs_layout4.css', null, null );
wp_enqueue_script( 'outsourceo-features-single-with-background-js', $sc_dir . 'assets/js/cs_layout4.js', array( 'jquery' ), null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

	<?php

	$background_image = ! empty( $s_image ) ? Helper::get_background_attachment( $s_image, $cs_image_size, $atts, 'cs_' ) : ''; ?>

    <div class="aheto-content-block t-center aheto-content-block--light aheto-content-block--outsourceo-bgImg aheto-content--outsourceo-with-background s-back-switch" <?php echo esc_attr( $background_image ); ?>>

        <div class="aheto-content-block__descr">

			<?php
			if ( ! empty( $s_heading ) ) : ?>
                <h4 class="aheto-content-block__title t-light"><?php echo wp_kses( $this->highlight_text( $s_heading ), 'post' ); ?></h4>
			<?php endif; ?>

            <div class="aheto-content-block__info">

				<?php if ( ! empty( $s_description ) ) : ?>
                    <p class="aheto-content-block__info-text">
						<?php echo wp_kses( $s_description, 'post' ); ?>
                    </p>
				<?php endif; ?>

            </div>

			<?php if ( ! empty( $cs_link_url ) && ! empty( $cs_link_text ) ) : ?>
                <div class="aheto-btn-container t-center">
                    <a href="<?php echo esc_url( $cs_link_url ) ?>"
                       class="aheto-link aheto-btn--primary aheto-btn--no-underline">
                        <i class="ion-android-arrow-dropright aheto-btn__icon--left"></i>
						<?php echo esc_html( $cs_link_text ); ?>
                    </a>
                </div>
			<?php endif; ?>

        </div>

    </div>

</div>

