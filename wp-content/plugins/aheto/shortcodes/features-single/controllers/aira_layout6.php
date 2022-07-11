<?php

use Aheto\Helper;
use Aheto\Sanitize;

add_action( 'aheto_before_aheto_features-single_register', 'aira_features_single_layout6' );



/**
 * Features Single Shortcode
 */

function aira_features_single_layout6( $shortcode ) {

    $theme_dir = '//assets.aheto.co/features-single/previews/';

    $shortcode->add_layout( 'aira_layout6', [
        'title' => esc_html__( 'Aira Group', 'aira' ),
        'image' => $theme_dir . 'aira_layout6.jpg',
    ] );

    $shortcode->add_dependecy( 'aira_use_title_typo', 'template', 'aira_layout6' );
    $shortcode->add_dependecy( 'aira_title_typo', 'aira_use_title_typo', 'true' );

    $shortcode->add_dependecy( 'aira_use_description_typo', 'template', 'aira_layout6');
    $shortcode->add_dependecy( 'aira_description_typo', 'aira_use_description_typo', 'true' );

    $shortcode->add_dependecy( 'aira_logo_image', 'template', 'aira_layout6' );
    $shortcode->add_dependecy( 'aira_overlay', 'template', 'aira_layout6' );
    $shortcode->add_dependecy( 'aira_link_url', 'template', 'aira_layout6');

    aheto_demos_add_dependency( ['s_heading','s_image','s_description'], ['aira_layout6'], $shortcode );

    $shortcode->add_params( [
        'aira_link_url'      => [
            'type'    => 'text',
            'heading' => esc_html__( 'Link URL', 'aira' ),
            'default' => '#'
        ],
        'aira_use_title_typo'   => [
            'type'    => 'switch',
            'heading' => esc_html__( 'Use custom font for heading?', 'aira' ),
            'grid'    => 12,
            'default' => '',
        ],
        'aira_title_typo' => [
            'type' => 'typography',
            'group' => 'Heading Typography',
            'settings' => [
                'text_align' => true,
            ],
            'selector' => '{{WRAPPER}} .aheto-features-block__title',
        ],
        'aira_use_description_typo'   => [
            'type'    => 'switch',
            'heading' => esc_html__( 'Use custom font for description?', 'aira' ),
            'grid'    => 12,
            'default' => '',
        ],
        'aira_description_typo' => [
            'type'     => 'typography',
            'group'    => 'Description Typography',
            'settings' => [
                'text_align' => true,
            ],
            'selector' => '{{WRAPPER}} .aheto-features-block__description',
        ],
        'aira_logo_image'    => [
            'type'    => 'attach_image',
            'heading' => esc_html__( 'Image Logo', 'aira' ),
        ],
        'aira_overlay'       => [
            'type'    => 'switch',
            'heading' => esc_html__( 'Enable overlay for background image?', 'aira' ),
            'grid'    => 12,
        ],
    ] );


    \Aheto\Params::add_image_sizer_params( $shortcode, [
        'group'      => esc_html__( 'Images size for logo ', 'aira' ),
        'prefix'     => 'aira_logo_',
        'dependency' => [ 'template', [ 'aira_layout6' ] ]
    ] );

    \Aheto\Params::add_image_sizer_params($shortcode, [
        'prefix'     => 'aira_',
        'dependency' => ['template', ['aira_layout6']]
    ]);

}

function aira_features_single_layout6_dynamic_css( $css, $shortcode ) {

    if ( ! empty( $shortcode->atts['aira_use_title_typo'] ) && ! empty( $shortcode->atts['aira_title_typo'] ) ) {
        \aheto_add_props( $css['global']['%1$s .aheto-features-block__title'], $shortcode->parse_typography( $shortcode->atts['aira_title_typo'] ) );
    }
    if ( ! empty( $shortcode->atts['aira_use_description_typo'] ) && ! empty( $shortcode->atts['aira_description_typo'] ) ) {
        \aheto_add_props( $css['global']['%1$s .aheto-features-block__description'], $shortcode->parse_typography( $shortcode->atts['aira_description_typo'] ) );
    }

    return $css;
}

add_filter( 'aheto_features_single_dynamic_css', 'aira_features_single_layout6_dynamic_css', 10, 2 );