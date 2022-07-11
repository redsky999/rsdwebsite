<?php
/**
 * About default templates.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract($atts);

if ( empty($token) || empty ($username) ) {
	return;
}

$this->generate_css();


$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', 'aheto-instagram--mooseoom-list');
$this->add_render_attribute('instagram', 'class', 'mooseoom-instagram');
$this->add_render_attribute('instagram', 'data-token', $token);
$this->add_render_attribute('instagram', 'data-size', $size);
$this->add_render_attribute('instagram', 'data-max', $limit);
$this->add_render_attribute('instagram', 'data-id', $atts['_id']);


/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/instagram/';
$custom_css    = Helper::get_settings('general.custom_css_including');
$custom_css    = (isset($custom_css) && !empty($custom_css)) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
	wp_enqueue_style( 'mooseoom-instagram-layout1', $shortcode_dir . 'assets/css/mooseoom_layout1.css', null, null );
}

global $wp;

if ( !Helper::is_Elementor_Live()) {
	wp_enqueue_script( 'mooseoom-instagram-layout1-js', $shortcode_dir . 'assets/js/mooseoom_layout1.min.js', array( 'jquery' ), null );
}
?>


<div <?php $this->render_attribute_string('wrapper'); ?>>

	<ul <?php $this->render_attribute_string('instagram'); ?>></ul>

</div>
