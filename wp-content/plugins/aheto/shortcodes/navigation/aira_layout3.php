<?php
/**
 * Header Rela Menu.
 */

use Aheto\Helper;

extract( $atts );

if ( empty( $menus ) ) {
	return;
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

// Nav.
$this->add_render_attribute( 'nav', 'class', 'widget-nav-menu widget-nav-menu--aira-services' );
$this->add_render_attribute( 'title', 'class', 'widget-nav-menu__title' );


/**
 * Set dependent style
 */
$sc_dir = aheto()->plugin_url() . 'shortcodes/navigation/';
$custom_css    = Helper::get_settings( 'general.custom_css_including' );
$custom_css    = ( isset( $custom_css ) && ! empty( $custom_css ) ) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
    wp_enqueue_style('aira-navigation-services', $sc_dir . 'assets/css/aira_layout3.css', null, null);
}
?>

<div <?php $this->render_attribute_string('wrapper'); ?>>

    <div <?php $this->render_attribute_string('nav'); ?>>

        <?php wp_nav_menu([
            'container' => 'div',
            'items_wrap' => '<ul id="%1$s" class="%2$s widget-nav-menu__menu">%3$s</ul>',
            'container_class' => 'menu-main-container',
            'menu_class' => 'menu',
            'menu' => $menus,
        ]); ?>

    </div>

</div>
