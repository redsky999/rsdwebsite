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

$banners = $this->parse_group($pointe_grid_banners);

if ( empty($banners) ) {
	return '';
}

if ( !$pointe_swiper_custom_options ) {
	$speed  = 1000;
	$effect = 'fade';
	$loop   = false;
}

$this->generate_css();
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', 'aheto-banner-slider');
$this->add_render_attribute('wrapper', 'class', 'aheto-banner-slider--pointe-grid');

/**
 * Set carousel params
 */
$carousel_default_params = [
	'speed' => 1000,
]; // will use when not chosen option 'Change slider params'

$carousel_params = Helper::get_carousel_params($atts, 'pointe_swiper_', $carousel_default_params);

/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/banner-slider/';
$custom_css    = Helper::get_settings('general.custom_css_including');
$custom_css    = (isset($custom_css) && !empty($custom_css)) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
	wp_enqueue_style('pointe-banner-slider-layout3', $shortcode_dir  . 'assets/css/pointe_layout3.css', null, null);
}
if (!Helper::is_Elementor_Live()) {
	wp_enqueue_script('pointe-banner-slider-layout3-js', $shortcode_dir . 'assets/js/pointe_layout3.min.js', array('jquery'), null);
}
?>
<div <?php $this->render_attribute_string('wrapper'); ?>>
	<div class="swiper">
		<div class="swiper-container" <?php echo esc_attr($carousel_params); ?>>
			<div class="swiper-wrapper">
				<?php foreach ( $banners as $banner ) :
					$banner = wp_parse_args($banner, [
						'pointe_image'         => '',
						'pointe_add_image'         => '',
						'pointe_title'         => ''
					]);

					extract($banner);

					if ( !$pointe_image ) {
						continue;
					}

					$swiper_lazy_class = $pointe_swiper_lazy ? ' swiper-lazy' : '';
					$background_image = Helper::get_background_attachment($pointe_image, 'full', $atts, '', $pointe_swiper_lazy); ?>

					<div class="swiper-slide">


						<div class="aheto-banner-slider-wrap cs-full-min-height-js <?php echo esc_attr($align . $swiper_lazy_class); ?>" <?php echo esc_attr($background_image); ?>>

							<div class="aheto-banner-slider__content">
								<?php
								if ( ! empty($pointe_title) ) { ?>
									<h2 class="aheto-banner__title"><?php echo wp_kses($pointe_title, 'post'); ?></h2>
								<?php }

								if ( ! empty($pointe_title_2) ) { ?>
									<h2 class="aheto-banner__title"><?php echo wp_kses($pointe_title_2, 'post'); ?></h2>
								<?php }

								if ( ! empty($pointe_title_3) ) { ?>
									<h2 class="aheto-banner__title"><?php echo wp_kses($pointe_title_3, 'post'); ?></h2>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php $this->swiper_pagination('pointe_swiper_'); ?>
		</div>
	</div>
</div>
