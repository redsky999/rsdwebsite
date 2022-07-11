<?php
/**
 * The Banner Slider Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract($atts);

$banners = $this->parse_group($outsourceo_modern_banners);

if ( empty($banners) ) {
	return '';
}

$this->generate_css();
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', 'aheto-banner-slider');
$this->add_render_attribute('wrapper', 'class', 'aheto-banner-slider--outsourceo-modern');


/**
 * Set carousel params
 */
$carousel_params = Helper::get_carousel_params($atts, 'cs_swiper_');


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/banner-slider/';
wp_enqueue_style('outsourceo-banner-slider-modern', $sc_dir . 'assets/css/cs_layout1.css', null, null);

?>
<div <?php $this->render_attribute_string('wrapper'); ?>>
	<div class="swiper">
		<div class="swiper-container" <?php echo esc_attr($carousel_params); ?>>
			<div class="swiper-wrapper">
				<?php foreach ( $banners as $banner ) :
					$banner = wp_parse_args($banner, [
						'cs_image'         => '',
						'cs_overlay_color' => '',
						'cs_overlay'       => '',
						'cs_title'         => '',
						'cs_use_dot'       => '',
						'cs_desc'          => '',
						'cs_align'         => '',
						'cs_btn_direction' => ''
					]);
					extract($banner);

					$cs_use_dot = isset($cs_use_dot) && !empty($cs_use_dot) ? 'outsourceo-dot' : '';
					$cs_overlay = isset($cs_overlay) && !empty($cs_overlay) ? 'overlay-on' : '';

					if ( !$cs_image ) {
						continue;
					}


					$swiper_lazy_class = $lazy ? ' swiper-lazy' : '';
					$background_image = Helper::get_background_attachment($cs_image, $cs_image_size, $atts, 'cs_', $lazy); ?>

					<div class="swiper-slide">
						<div class="aheto-banner-slider-wrap s-back-switch <?php echo esc_attr($cs_align . ' ' . $cs_overlay . $swiper_lazy_class); ?>" <?php echo esc_attr($background_image); ?>>

							<?php if ( $cs_overlay ) : ?>
								<span class="aheto-banner-slider__overlay"
									  style="background-color: <?php echo esc_attr($cs_overlay_color); ?>;"></span>
							<?php endif; ?>

							<div class="aheto-banner-slider__content">
								<?php if ( !empty($cs_add_image) ) { ?>
									<?php echo Helper::get_attachment( $cs_add_image, ['class' => 'aheto-banner-slider__add-image'], $cs_add_image_size, $atts, 'cs_add_' ); ?>
								<?php }

								if ( !empty($cs_title) ) { ?>
									<h1 class="aheto-banner__title"><?php echo outsourceo_dot_string( $cs_title, $cs_use_dot, 'primary' ); ?></h1>
								<?php }

								if ( !empty($cs_desc) ) { ?>
									<h5 class="aheto-banner-slider__desc"><?php echo wp_kses($cs_desc, 'post'); ?></h5>
								<?php }

								if ( $cs_main_add_button ) { ?>
									<div class="aheto-banner-slider__links">
										<?php echo Helper::get_button($this, $banner, 'cs_main_'); ?>
									</div>
								<?php } ?>

							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php $this->swiper_pagination('cs_swiper_'); ?>
		</div>
		<h6><?php $this->swiper_arrow('cs_swiper_'); ?></h6>
	</div>

</div>
