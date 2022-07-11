<?php
/**
 * The Testimonials Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract( $atts );

$cs_testimonials_creative_item = $this->parse_group( $cs_testimonials_creative_item );
if ( empty( $cs_testimonials_creative_item ) ) {
	return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-tm-wrapper' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-tm-wrapper--oursourceo-creative' );

$cs_dark_version = isset( $cs_dark_version ) && $cs_dark_version ? 'dark-version' : '';
$this->add_render_attribute( 'wrapper', 'class', $cs_dark_version );

// Swiper.
if ( ! $custom_options ) {
	$speed  = 500;
	$space  = 30;
	$slides = 3;
	$large  = 3;
	$medium = 2;
	$small  = 1;
}

/**
 * Set carousel params
 */
$carousel_default_params = [
	'speed'    => 1000,
	'autoplay' => false,
	'spaces'   => 30,
	'slides'   => 3,
	'arrows'   => true
]; // will use when not chosen option 'Change slider params'

$carousel_params = Helper::get_carousel_params( $atts, 'cs_swiper_', $carousel_default_params );

$atts['cs_image_height'] = 63;
$atts['cs_image_width']  = 63;
$atts['cs_image_crop']   = true;

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/testimonials/';
wp_enqueue_style( 'outsourceo-testimonials-creative', $sc_dir . 'assets/css/cs_layout2.css', null, null );
wp_enqueue_script( 'outsourceo-testimonials-creative-js', $sc_dir . 'assets/js/cs_layout2.min.js', array( 'jquery' ), null );


?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

	<?php if ( ! empty( $cs_bg_text ) ) { ?>
        <div class="aheto-tm__bg-text"><?php echo esc_html( $cs_bg_text ); ?></div>
	<?php } ?>

    <div class="swiper">

        <div class="swiper-container" <?php echo esc_attr( $carousel_params ); ?>>

            <div class="swiper-wrapper">

				<?php foreach ( $cs_testimonials_creative_item as $item ) : ?>

                    <div class="swiper-slide">

                        <div class="aheto-tm__slide-wrap">

                            <div class="aheto-tm__content">
								<?php
								// Testimonial.
								if ( isset( $item['cs_testimonial'] ) && ! empty( $item['cs_testimonial'] ) ) {
									echo '<h4 class="aheto-tm__text">' . wp_kses( $item['cs_testimonial'], 'post') . '</h4>';
								} ?>
                            </div>

                            <div class="aheto-tm__author">

								<?php if ( ! empty( $item['cs_image'] ) ) :

									$background_image = Helper::get_background_attachment( $item['cs_image'], 'custom', $atts, 'cs_' ); ?>

                                    <div class="aheto-tm__avatar" <?php echo esc_attr( $background_image ); ?>></div>

								<?php endif; ?>

                                <div class="aheto-tm__info">
									<?php
									// Name.
									if ( isset( $item['cs_name'] ) && ! empty( $item['cs_name'] ) ) {
										echo '<h5 class="aheto-tm__name">' . wp_kses( $item['cs_name'], 'post' ) . '</h5>';
									}

									// Company.
									if ( isset( $item['cs_company'] ) && ! empty( $item['cs_company'] ) ) {
										echo '<p class="aheto-tm__position">' . wp_kses( $item['cs_company'], 'post' ) . '</p>';
									}
									?>
                                </div>

                            </div>

                        </div>

                    </div>

				<?php endforeach; ?>

            </div>

	        <?php $this->swiper_pagination( 'cs_swiper_' ); ?>

        </div>

    </div>

</div>
