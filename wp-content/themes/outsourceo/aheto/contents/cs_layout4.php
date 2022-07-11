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

extract( $atts );

$this->generate_css();


// Wrapper.
$this->generate_css();
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-content--outsourceo-simple' );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/contents/';
wp_enqueue_style('outsourceo-content-simple', $sc_dir . 'assets/css/cs_layout4.css', null, null);

?>

<div <?php $this->render_attribute_string('wrapper'); ?>>
	<?php
	if ( !empty($cs_simple_text) ) {
		echo wp_kses($cs_simple_text, 'post');
	}
	?>
</div>