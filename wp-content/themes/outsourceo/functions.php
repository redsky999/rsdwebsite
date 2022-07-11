<?php
/**
 * Outsourceo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Outsourceo
 */

defined( 'OUTSOURCEO_T_URI' ) or define( 'OUTSOURCEO_T_URI', get_template_directory_uri() );
defined( 'OUTSOURCEO_T_PATH' ) or define( 'OUTSOURCEO_T_PATH', get_template_directory() );


require_once OUTSOURCEO_T_PATH . '/include/custom-header.php';
require_once OUTSOURCEO_T_PATH . '/include/actions-config.php';
require_once OUTSOURCEO_T_PATH . '/include/class-tgm-plugin-activation.php';
require_once OUTSOURCEO_T_PATH . '/include/helper-function.php';
require_once OUTSOURCEO_T_PATH . '/include/aheto-shortcodes.php';
require_once OUTSOURCEO_T_PATH . '/include/customizer.php';



require OUTSOURCEO_T_PATH .'/plugin-update-checker/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://main.aheto.co/wp-update/?action=get_metadata&slug=outsourceo', //Metadata URL.
	__FILE__, //Full path to the main plugin file.
	'outsourceo' //Plugin slug. Usually it's the same as the name of the directory.
);


if ( ! function_exists( 'outsourceo_setup' ) ) :

	function outsourceo_setup() {

		register_nav_menus( array( 'primary-menu' => esc_html__( 'Primary menu', 'outsourceo' ) ) );
		load_theme_textdomain( 'outsourceo', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

        add_theme_support( 'woocommerce' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'outsourceo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;

add_action( 'after_setup_theme', 'outsourceo_setup' );

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);


add_filter( 'aheto_template_kit_category', function() {
	return 'outsourceo';
} );


add_filter('aheto_shortcodes_data', function ( $data ){

	unset($data['blockquote'],
		$data['features-slider'],
		$data['features-tabs'],
		$data['instagram'],
		$data['media'],
		$data['team'],
		$data['time-schedule']);

	return $data;

}, 10, 1);

if ( ! function_exists( 'outsourceo_deactivate_layouts' ) ) :

	function outsourceo_deactivate_layouts() {

		$current_options = Array(
			'aheto_banner-slider' => Array(
				'layout1',
			),
			'aheto_call-to-action' => Array(
				'layout1',
				'layout2',
			),
			'aheto_coming-soon' => Array(
				'layout1',
			),
			'aheto_contact-forms' => Array(
				'layout1',
				'layout2',
				'layout3',
				'layout5',
			),
			'aheto_contact-info' => Array(
				'layout2',
			),
			'aheto_contacts' => Array(
				'layout1',
				'layout2',
				'layout3',
			),
			'aheto_contents' => Array(
				'layout1',
				'layout2',
			),
			'aheto_custom-post-type' => Array(
				'layout4',
			),
			'aheto_features-single' => Array(
				'layout1',
				'layout2',
				'layout3',
				'layout4',
				'layout5',
				'layout6',
				'layout7',
			),
			'aheto_features-timeline' => Array(
				'layout1',
			),
			'aheto_heading' => Array(
				'layout2',
			),
			'aheto_list' => Array(
				'layout2',
			),
			'aheto_navbar' => Array(
				'layout1',
				'layout2',
			),
			'aheto_navigation' => Array(
				'layout1',
				'layout2',
				'layout3',
				'layout4',
				'layout5',
				'layout6',
				'layout7',
				'layout8',
			),
			'aheto_recent-posts' => Array(
				'layout1',
			),
			'aheto_pricing-tables' => Array(
				'layout1',
				'layout2',
				'layout3',
				'layout4',
			),
			'aheto_progress-bar' => Array(
				'layout1',
				'layout2',
				'layout3',
				'layout4',
			),
			'aheto_social-networks' => Array(
				'layout1',
			),
			'aheto_team-member' => Array(
				'layout1',
				'layout2',
			),
			'aheto_testimonials' => Array(
				'layout1',
			),
			'aheto_title-bar' => Array(
				'layout1',
				'layout2',
			),
		);

		return $current_options;
	}

endif;

add_filter( 'aheto_active_leyouts', 'outsourceo_deactivate_layouts', 10 );


function outsourceo_export_data() {
	$response = wp_remote_get( 'https://main.aheto.co/wp-json/aheto/v1/getThemeTemplate/1393', [] );
	$response = json_decode( $response['body'], true );
	return $response;
}

add_filter( 'export_data', 'outsourceo_export_data', 10 );

if ( ! function_exists( 'outsourceo_woocommerce_template_loop_product_title' ) ) {

    /**
     * Show the product title in the product loop. By default this is an H2.
     */
    function outsourceo_woocommerce_template_loop_product_title() {
        echo '<h4 class="woocommerce-loop-product--title">' . get_the_title() . '</h4>';
    }
}

add_action( 'woocommerce_shop_loop_item_title', 'outsourceo_woocommerce_template_loop_product_title', 20 );



if ( function_exists( 'aheto' ) ) {
    function outsourceo_theme_options( $theme_tabs ) {

        $theme_tabs = [
            'outsourceo_shop' => [
                'icon'  => 'dashicons dashicons-admin-generic pink-color',
                'title' => esc_html__( 'Shop Options', 'aheto' ),
                'desc'  => esc_html__( 'This tab contains the theme shop options.', 'aheto' ),
                'file'  => OUTSOURCEO_T_PATH . '/include/shop-options.php',
            ],
            'outsourceo_blog' => [
                'icon'  => 'dashicons dashicons-admin-generic yellow-color',
                'title' => esc_html__( 'Blog Options', 'aheto' ),
                'desc'  => esc_html__( 'This tab contains the theme blog options.', 'aheto' ),
                'file'  => OUTSOURCEO_T_PATH . '/include/blog-options.php',
            ],
        ];

        return $theme_tabs;
    }
}

add_filter( 'aheto_theme_options', 'outsourceo_theme_options', 10, 2 );
