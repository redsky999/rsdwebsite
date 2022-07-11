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
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/progress-bar/';
wp_enqueue_style( 'outsourceo-progressbar-modern', $sc_dir . 'assets/css/cs_layout2.css', null, null );

?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

    <div class="aheto-progress aheto-progress--outsourceo-bar">

		<?php if ( ! empty( $heading ) ) {
			echo '<h6 class="aheto-progress__title">' . wp_kses($heading, 'post') . '</h6>';
		}

		if ( ! empty( $percentage ) ) { ?>
            <div class="aheto-progress__bar prog-bar">
                <h6 class="aheto-progress__bar-holder prog-bar-hldr">
                    <i class="aheto-progress__bar-icon icon"></i>
                    <span class="aheto-progress__bar-perc prog-bar-perc t-medium"><?php echo absint( $percentage ); ?></span><span>%</span>
                </h6>
                <div class="aheto-progress__bar-val prog-bar-val"></div>
            </div>
		<?php } ?>

    </div>

</div>




