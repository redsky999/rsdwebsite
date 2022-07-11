<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$outsourceo_img = '';
$outsourceo_background_image = '';

if (function_exists('aheto')) {
    $outsourceo_shop_image = Aheto\Helper::get_settings('theme-options.outsourceo_shop_image');
    $outsourceo_background_image = isset($outsourceo_shop_image) && !empty($outsourceo_shop_image) ? "style=background-image:url(" . $outsourceo_shop_image . ")" : '';
    $outsourceo_img = isset($outsourceo_shop_image) && !empty($outsourceo_shop_image) ? 'with-image' : '';
}

if (is_shop()) { ?>
    <div class="outsourceo-shop-banner <?php echo esc_attr($outsourceo_img); ?> " <?php echo esc_attr($outsourceo_background_image); ?>>
        <h1 class="title"><?php woocommerce_page_title(); ?></h1>
    </div>
<?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-12">

<?php

