<?php
/**
 * The Heading Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */
extract( $atts );

$this->generate_css();


// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-heading' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-heading--outsourceo__simple' );
$this->add_render_attribute( 'wrapper', 'class', $alignment );
$this->add_render_attribute( 'wrapper', 'class', 'align-tablet-' . $cs_align_tablet);
$this->add_render_attribute( 'wrapper', 'class', 'align-mob-' . $cs_align_mobile );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

$cs_use_dot = isset( $cs_use_dot ) && ! empty( $cs_use_dot ) ? 'outsourceo-dot' : '';

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/heading/';
wp_enqueue_style( 'outsourceo-heading-simple', $sc_dir . 'assets/css/cs_layout1.css', null, null );

?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

	<?php
	// Heading.
	$heading = $this->get_heading();

	if ( ! empty( $cs_subtitle ) ) {
		echo '<' . $cs_subtitle_tag . ' class="aheto-heading__subtitle">' . esc_html( $cs_subtitle ) . '</' . $cs_subtitle_tag . '>';
	}

	if ( ! empty( $heading ) ) {

		$heading = $this->highlight_text( $heading );

		echo '<' . $text_tag . ' class="aheto-heading__title">' . outsourceo_dot_string( $heading, $cs_use_dot, 'primary' ) . '</' . $text_tag . '>';
	}

	?>

</div>
