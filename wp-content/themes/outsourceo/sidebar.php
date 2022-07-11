<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Outsourceo
 */

if ( ! is_active_sidebar( 'outsourceo-sidebar' ) ) {
	return;
}
?>

<div class="col-12 col-lg-4">
    <div class="outsourceo-blog--sidebar">
		<?php dynamic_sidebar( 'outsourceo-sidebar' ); ?>
    </div>
</div>

