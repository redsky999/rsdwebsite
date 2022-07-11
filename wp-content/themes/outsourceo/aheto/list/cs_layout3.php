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

$lists = $this->parse_group( $cs_table_lists );
if ( empty( $lists ) ) {
	return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-list' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-list--outsourceo-table-links' );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/list/';
wp_enqueue_style( 'outsourceo-table-list', $sc_dir . 'assets/css/cs_layout3.css', null, null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

	<?php if ( ! empty( $cs_first_column ) || ! empty( $cs_second_column ) || ! empty( $cs_third_column ) ) {

		$cs_first_column = !empty($cs_first_column) ? $cs_first_column : '';
		$cs_second_column = !empty($cs_second_column) ? $cs_second_column : '';
		$cs_third_column = !empty($cs_third_column) ? $cs_third_column : '';
	    ?>
        <div class="aheto-list--main-row">
            <div class="aheto-list--column">
				<?php echo wp_kses($cs_first_column, 'post'); ?>
            </div>
            <div class="aheto-list--column">
				<?php echo wp_kses( $cs_second_column, 'post'); ?>
            </div>
            <div class="aheto-list--column">
				<?php echo wp_kses( $cs_third_column, 'post'); ?>
            </div>
        </div>
	<?php } ?>

	<?php foreach ( $lists as $item ) { ?>

        <div class="aheto-list--row">
            <div class="aheto-list--column">
                <h6><?php echo wp_kses( $cs_first_column, 'post'); ?></h6>
				<h5><?php echo wp_kses( $item['cs_first_item'], 'post'); ?></h5>
            </div>
            <div class="aheto-list--column">
                <h6><?php echo wp_kses( $cs_second_column, 'post'); ?></h6>
				<?php echo wp_kses( $item['cs_second_item'], 'post'); ?>
            </div>
            <div class="aheto-list--column">
                <h6><?php echo wp_kses( $cs_third_column, 'post'); ?></h6>
				<?php echo wp_kses( $item['cs_third_item'], 'post'); ?>
            </div>
            <div class="aheto-list--column">
                <?php if ( $item['cs_main_add_button'] ) { ?>
                <div class="aheto-banner-slider__links">
		            <?php echo Aheto\Helper::get_button($this, $item, 'cs_main_'); ?>
                </div>
                <?php } ?>
            </div>
        </div>

	<?php } ?>

</div>
