<?php
/**
 * Contact Forms default templates.
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
$this->add_render_attribute( 'wrapper', 'class', 'widget widget_aheto__cf--outsourceo__subscribe-single' );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/contact-forms/';
wp_enqueue_style('outsourceo-subscribe-single', $sc_dir . 'assets/css/cs_layout2.css', null, null);
wp_enqueue_script( 'outsourceo-subscribe-single-js', $sc_dir . 'assets/js/cs_layout2.js', array( 'jquery' ), null ); ?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>


	<div class="widget_aheto__form">

		<?php if ( !empty( $contact_form ) ) : ?>
            <div class="<?php echo Helper::get_button($this, $atts, 'form_', true); ?>">
				<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $contact_form ) . '"]' ); ?>
            </div>
		<?php endif; ?>

	</div>

</div>
