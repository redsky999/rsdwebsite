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
$this->add_render_attribute( 'wrapper', 'id', $this->atts['element_id'] );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/video-btn/';
wp_enqueue_style( 'outsourceo-videobtn-creative', $sc_dir . 'assets/css/cs_layout1.css', null, null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>
	<div class="aheto-video-container aheto-video-container--creative <?php echo esc_attr($this->atts['align']); ?>">

		<?php if ( !empty($cs_video_image) ) :

			$background_image = Helper::get_background_attachment($cs_video_image, $cs_image_size, $atts, 'cs_'); ?>

			<div class="aheto-video-container__image" <?php echo esc_attr( $background_image ); ?>>
				<?php echo Helper::get_video_button($atts); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
