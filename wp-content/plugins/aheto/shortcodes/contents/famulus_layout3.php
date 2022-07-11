<?php
/**
 * The Contents Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract($atts);
$faqs = $this->parse_group($faqs);

if ( empty($faqs) ) {
	return '';
}
$this->generate_css();
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', 'aheto-contents--faq-famulus-creative');
$this->add_render_attribute('wrapper', 'class', 'js-accordion-parent');

if ( isset($multi_active) && !empty($multi_active) ) {
	$this->add_render_attribute('wrapper', 'data-multiple', '1');
}


/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/contents/';
$custom_css    = Helper::get_settings('general.custom_css_including');
$custom_css    = (isset($custom_css) && !empty($custom_css)) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
	wp_enqueue_style('famulus-contents-layout3', $shortcode_dir . 'assets/css/famulus_layout3.css', null, null);
}

?>
<div <?php $this->render_attribute_string('wrapper'); ?>>
	<?php if (!empty($famulus_title)):
	$famulus_title = str_replace(']]', '</span>', $famulus_title);
	$famulus_title = str_replace('[[', '<span>', $famulus_title);
	?>
	<<?php echo esc_attr($famulus_title_tag); ?> class="aheto-contents__main-title">
	<?php echo wp_kses($famulus_title, 'post'); ?>
</<?php echo esc_attr($famulus_title_tag); ?>>
<?php endif; ?>
<?php
foreach ( $faqs as $key => $item ) :

	$class_active = $key === 0 && $first_is_opened ? 'is-open' : '';
	$active_display = $key === 0 && $first_is_opened ? 'block' : 'none';

	if ( empty($item['title']) && empty($item['description']) ) {
		continue;
	}
	?>
	<div class="aheto-contents__item <?php echo esc_attr($class_active); ?>">

		<?php if ( !empty($item['title']) ) : ?>
			<h5 class="aheto-contents__title js-accordion"><?php echo wp_kses($item['title'], 'post'); ?></h5>
		<?php endif; ?>

		<?php if ( !empty($item['description']) ) : ?>
			<div class="aheto-contents__panel js-accordion-text"
				 style="display: <?php echo esc_attr($active_display); ?>">
				<p class="aheto-contents__desc">
					<?php echo wp_kses($item['description'], 'post'); ?>
				</p>
			</div>
		<?php endif; ?>

	</div>

<?php endforeach; ?>

</div>
