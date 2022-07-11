<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package outsourceo
 * @since 1.0
 */


if (! function_exists('outsourceo_child_theme_scripts')) {
    function outsourceo_child_theme_scripts(){

         // register style
        wp_enqueue_style('outsourceo-child-css', get_stylesheet_directory_uri() . '/style.css');

    	
    }
}
add_action( 'wp_enqueue_scripts', 'outsourceo_child_theme_scripts');

/* ---------------------------------------------------------------------------
 * Set hreflang="x-default" with WPML
 * --------------------------------------------------------------------------- */
add_filter('wpml_alternate_hreflang', 'wps_head_hreflang_xdefault', 10, 2);
function wps_head_hreflang_xdefault($url, $lang_code) {
      
    if($lang_code == apply_filters('wpml_default_language', NULL )) {
          
        echo '<link rel="alternate" href="' . $url . '" hreflang="x-default" />'.PHP_EOL;
    }
      
    return $url;
}
