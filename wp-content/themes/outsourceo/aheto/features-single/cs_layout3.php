<?php
/**
 * The Features Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

extract($atts);

$this->generate_css();

$cs_light_style = isset($cs_light_style) && !empty($cs_light_style) ? 'light-style' : '';
$cs_use_dot = isset($cs_use_dot) && !empty($cs_use_dot) ? 'outsourceo-dot' : '';

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', 'widget widget_aheto');
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());

// Block Wrapper.
$this->add_render_attribute('block_wrapper', 'class', 'aheto-content--outsourceo-with-image');
$this->add_render_attribute('block_wrapper', 'class', $cs_light_style);


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/features-single/';
wp_enqueue_style('outsourceo-features-single-with-image', $sc_dir . 'assets/css/cs_layout3.css', null, null);

?>
<div <?php $this->render_attribute_string('wrapper'); ?>>

	<div <?php $this->render_attribute_string('block_wrapper'); ?>>
		<div class="aheto-content-block__wrap">
			<div class="aheto-content-block__shape"></div>
			<?php if ( !empty($s_image) ) : ?>
				<div class="aheto-content-block__image">
					<?php echo \Aheto\Helper::get_attachment( $s_image, [], $cs_image_size, $atts, 'cs_' ); ?>
				</div>
			<?php endif; ?>

			<div class="aheto-content-block__inner">

				<div class="aheto-content-block__content">

					<?php if ( !empty($s_heading) ) : ?>
						<h5 class="aheto-content-block__title"><?php echo outsourceo_dot_string( $s_heading, $cs_use_dot, 'primary' ); ?></h5>
					<?php endif; ?>

					<div class="aheto-content-block__info">
						<?php if ( !empty($s_description) ) : ?>
							<p class="aheto-content-block__info-text ">
								<?php echo wp_kses($s_description, 'post'); ?>
							</p>
						<?php endif; ?>
					</div>

				</div>

				<div class="aheto-content-block__link">
					<?php if ( !empty($cs_link_text) && !empty($cs_link_url) ) : ?>
						<a href="<?php echo esc_url($cs_link_url); ?>">
							<span></span>
							<?php echo esc_html($cs_link_text); ?>
						</a>
					<?php endif; ?>
				</div>

			</div>

		</div>

	</div>

</div>
