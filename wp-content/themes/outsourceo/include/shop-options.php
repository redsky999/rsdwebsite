<?php
/**
 * General settings.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto
 * @author     UPQODE <info@upqode.com>
 */

$cmb->add_field([
	'id'      => 'outsourceo_shop_image',
	'type'    => 'file',
	'name'    => __( '<i class="fas fa-image green-color"></i> <span>Banner image</span>', 'outsourceo' ),
	'desc'    => esc_html__( 'This options only for shop pages', 'outsourceo' ),
]);