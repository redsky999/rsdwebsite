<?php
/**
 * The List Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

extract( $atts );

$lists = $this->parse_group( $lists );
if ( empty( $lists ) ) {
	return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-list' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-list--outsourceo-number' );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/list/';
wp_enqueue_style( 'outsourceo-list-number', $sc_dir . 'assets/css/cs_layout1.css', null, null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

    <ul>
		<?php

		$counter = 1;

		foreach ( $lists as $item ) {

			if ( ! empty( $item['list'] ) ) {
				echo '<li><b>' . esc_html( $counter ) . '</b><p>' . wp_kses( $item['list'], 'post' ) . '</p></li>';
			}

			$counter ++;
		}
		?>
    </ul>

</div>
