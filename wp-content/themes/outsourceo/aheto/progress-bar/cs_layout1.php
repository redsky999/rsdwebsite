<?php
/**
 * The Progress Bar Shortcode.
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
$this->add_render_attribute( 'wrapper', 'class', $cs_align );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-counter' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-counter--outsourceo-simple-number' );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

$cs_use_dot = isset( $cs_use_dot ) && ! empty( $cs_use_dot ) ? 'outsourceo-dot' : '';

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/progress-bar/';
wp_enqueue_style( 'outsourceo-progressbar-simple', $sc_dir . 'assets/css/cs_layout1.css', null, null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

    <div class="aheto-counter__number-wrap">
		<?php

		if ( isset( $cs_current ) && ! empty( $cs_current ) ) { ?>
            <h2 class="aheto-counter__current"><?php echo esc_html( $cs_current ); ?></h2>
		<?php }

		// Percentage.
		if ( ! empty( $percentage ) ) {
			echo '<h2 class="aheto-counter__number js-counter ' . esc_attr( $cs_use_dot ) . '">' . absint( $percentage ) . '</h2>';
		}

		if ( isset( $cs_current ) && ! empty( $cs_symbol ) ) { ?>
            <h2 class="aheto-counter__symbol"><?php echo esc_html( $cs_symbol ); ?></h2>
		<?php } ?>
    </div>

	<?php
	// Description.
	if ( ! empty( $description ) ) {
		echo '<h6 class="aheto-counter__desc">' . wp_kses( $description, 'post' ) . '</h6>';
	}
	?>

</div>
