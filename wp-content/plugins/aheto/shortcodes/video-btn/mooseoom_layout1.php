<?php

/**
 * The Button Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract($atts);
$this->generate_css();

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $this->atts['element_id']);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', 'aheto_video-btn---mooseoom');

/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/video-btn/';
$custom_css    = Helper::get_settings( 'general.custom_css_including' );
$custom_css    = ( isset( $custom_css ) && ! empty( $custom_css ) ) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
	wp_enqueue_style('mooseoom-video-btn-layout1', $shortcode_dir . 'assets/css/mooseoom_layout1.css', null, null);
}
?>

<div <?php $this->render_attribute_string('wrapper'); ?>>
	<div class="aheto-video-container <?php echo esc_attr($this->atts['align']); ?>">
		<?php echo Helper::get_video_button($atts); ?>

		<div class="aheto_video-btn__image">
			<?php echo Aheto\Helper::get_attachment($mooseoom_video_btn_image); ?>
		</div>
	</div>

</div>
