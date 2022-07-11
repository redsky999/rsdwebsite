<?php


add_action( 'aheto_before_aheto_heading_register', 'outsourceo_heading_shortcode' );
add_action( 'aheto_before_aheto_contact-forms_register', 'outsourceo_contact_forms_shortcode' );
add_action( 'aheto_before_aheto_contacts_register', 'outsourceo_contacts_shortcode' );
add_action( 'aheto_before_aheto_progress-bar_register', 'outsourceo_progress_shortcode' );
add_action( 'aheto_before_aheto_clients_register', 'outsourceo_clients_shortcode' );
add_action( 'aheto_before_aheto_navigation_register', 'outsourceo_navigation_shortcode' );
add_action( 'aheto_before_aheto_features-timeline_register', 'outsourceo_features_timeline_shortcode' );
add_action( 'aheto_before_aheto_navbar_register', 'outsourceo_navbar_shortcode' );
add_action( 'aheto_before_aheto_team-member_register', 'outsourceo_team_member_shortcode' );
add_action( 'aheto_before_aheto_recent-posts_register', 'outsourceo_recent_posts_shortcode' );
add_action( 'aheto_before_aheto_title-bar_register', 'outsourceo_title_bar_shortcode' );
add_action( 'aheto_before_aheto_testimonials_register', 'outsourceo_testimonials_shortcode' );
add_action( 'aheto_before_aheto_list_register', 'outsourceo_list_shortcode' );
add_action( 'aheto_before_aheto_custom-post-types_register', 'outsourceo_custom_post_types_shortcode' );
add_action( 'aheto_before_aheto_video-btn_register', 'outsourceo_video_btn_shortcode' );
add_action( 'aheto_before_aheto_features-single_register', 'outsourceo_features_single_shortcode' );
add_action( 'aheto_before_aheto_banner-slider_register', 'outsourceo_banner_slider_shortcode' );
add_action( 'aheto_before_aheto_contents_register', 'outsourceo_contents_shortcode' );
add_action( 'aheto_before_aheto_social-networks_register', 'outsourceo_networks_shortcode' );
add_action( 'aheto_before_aheto_coming-soon_register', 'outsourceo_coming_soon_shortcode' );


/**
 * Heading Shortcode
 */
function outsourceo_heading_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/heading/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Simple', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_dependecy( 'cs_align_tablet', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_align_mobile', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_subtitle', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_subtitle_tag', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_use_subtitle_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_use_dot', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_subtitle_typo', 'cs_use_subtitle_typo', 'true' );

	outsourceo_add_dependency( 'text_typo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'heading', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'alignment', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'source', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'text_tag', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'use_typo', [ 'cs_layout1' ], $shortcode );


	$shortcode->add_params( [
		'cs_subtitle'          => [
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Subtitle', 'outsourceo' ),
			'description' => esc_html__( 'Add some text for Subtitle', 'outsourceo' ),
			'admin_label' => true,
			'default'     => esc_html__( 'Add some text for Subtitle', 'outsourceo' ),
		],
		'cs_subtitle_tag'      => [
			'type'    => 'select',
			'heading' => esc_html__( 'Element tag for Subtitle', 'outsourceo' ),
			'options' => [
				'h1'  => 'h1',
				'h2'  => 'h2',
				'h3'  => 'h3',
				'h4'  => 'h4',
				'h5'  => 'h5',
				'h6'  => 'h6',
				'p'   => 'p',
				'div' => 'div',
			],
			'default' => 'h5',
			'grid'    => 5,
		],
		'cs_use_subtitle_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Subtitle?', 'outsourceo' ),
			'grid'    => 3,
		],

		'cs_subtitle_typo' => [
			'type'     => 'typography',
			'group'    => 'Subtitle Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-heading__subtitle',
		],
		'cs_use_dot'       => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use dot in the end title?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_align_tablet' => [
			'type'    => 'select',
			'heading' => esc_html__( 'Align for tablet', 'outsourceo' ),
			'options' => [
				'default' => 'Default',
				'left'    => 'Left',
				'center'  => 'Center',
				'right'   => 'Right',
			],
			'default' => 'default',
		],
		'cs_align_mobile' => [
			'type'    => 'select',
			'heading' => esc_html__( 'Align for mobile', 'outsourceo' ),
			'options' => [
				'default' => 'Default',
				'left'    => 'Left',
				'center'  => 'Center',
				'right'   => 'Right',
			],
			'default' => 'default',
		],

	] );

}

function outsourceo_heading_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_subtitle_typo'] ) && ! empty( $shortcode->atts['cs_subtitle_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-heading__subtitle'], $shortcode->parse_typography( $shortcode->atts['cs_subtitle_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_heading_dynamic_css', 'outsourceo_heading_shortcode_dynamic_css', 10, 2 );


/**
 * Contact forms Shortcode
 */

function outsourceo_contact_forms_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/contact-forms/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Subscribe', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Single', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_layout( 'cs_layout3', [
		'title' => esc_html__( 'Outsourceo Classic', 'outsourceo' ),
		'image' => $dir . 'cs_layout3.jpg',
	] );


	outsourceo_add_dependency( 'title', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'use_title_typo', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'title_typo', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'count_input', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'button_align', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'border_radius_button', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'border_radius_input', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'bg_color_fields', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'full_width_button', [ 'cs_layout3' ], $shortcode );


	$shortcode->add_dependecy( 'cs_title_tag', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_full_width_input', 'template', 'cs_layout3' );


	$shortcode->add_params( [

		'cs_title_tag'        => [
			'type'    => 'select',
			'heading' => esc_html__( 'Element tag for Title', 'outsourceo' ),
			'options' => [
				'h1'  => 'h1',
				'h2'  => 'h2',
				'h3'  => 'h3',
				'h4'  => 'h4',
				'h5'  => 'h5',
				'h6'  => 'h6',
				'p'   => 'p',
				'div' => 'div',
			],
			'default' => 'h5',
			'grid'    => 5,
		],
		'cs_full_width_input' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Full width input', 'outsourceo' ),
			'grid'    => 12,
		],

	] );

}

function outsourceo_contact_forms_shortcode_button( $form_button ) {

	$form_button['dependency'][1][] = 'cs_layout1';
	$form_button['dependency'][1][] = 'cs_layout3';

	return $form_button;

}

add_filter( 'aheto_button_contact-forms', 'outsourceo_contact_forms_shortcode_button', 10, 2 );

/**
 * Contacts Shortcode
 */

function outsourceo_contacts_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/contacts/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Simple', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Classic', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_layout( 'cs_layout3', [
		'title' => esc_html__( 'Outsourceo With Text', 'outsourceo' ),
		'image' => $dir . 'cs_layout3.jpg',
	] );


	outsourceo_add_dependency( ['use_heading', 't_heading'], [ 'cs_layout2', 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( ['use_content', 't_content'], [ 'cs_layout2', 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 's_heading', [ 'cs_layout3' ], $shortcode );


	$shortcode->add_dependecy( 'cs_text', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'outsourceo_contacts_group', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_light_version', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_contacts_group', 'template', 'cs_layout3' );


	$shortcode->add_params( [
		'cs_text' => [
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Text', 'outsourceo' ),
			'description' => esc_html__( 'Add some text for contacts', 'outsourceo' ),
			'admin_label' => true,
			'default'     => esc_html__( 'Add some text for contacts', 'outsourceo' ),
		],

		'outsourceo_contacts_group' => [
			'type'    => 'group',
			'heading' => esc_html__( 'Outsourceo Contacts', 'outsourceo' ),
			'params'  => [
				'cs_heading_tag' => [
					'type'    => 'select',
					'heading' => esc_html__( 'Element tag for Heading', 'outsourceo' ),
					'options' => [
						'h1'  => 'h1',
						'h2'  => 'h2',
						'h3'  => 'h3',
						'h4'  => 'h4',
						'h5'  => 'h5',
						'h6'  => 'h6',
						'p'   => 'p',
						'div' => 'div',
					],
					'default' => 'h4',
					'grid'    => 5,
				],
				'cs_heading'     => [
					'type'    => 'text',
					'heading' => esc_html__( 'Heading', 'outsourceo' ),
				],
				'cs_address'     => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Address', 'outsourceo' ),
				],
				'cs_phone'       => [
					'type'    => 'text',
					'heading' => esc_html__( 'Phone', 'outsourceo' ),
				],

				'cs_email' => [
					'type'    => 'text',
					'heading' => esc_html__( 'Email', 'outsourceo' ),
				],
			]
		],

		'cs_light_version' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable light version?', 'outsourceo' ),
			'grid'    => 3,
		],

		'cs_contacts_group' => [
			'type'    => 'group',
			'heading' => esc_html__( 'Outsourceo Contacts', 'outsourceo' ),
			'params'  => [
				'cs_heading' => [
					'type'    => 'text',
					'heading' => esc_html__( 'Heading', 'outsourceo' ),
				],
				'cs_address' => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Address', 'outsourceo' ),
				],
				'cs_phone'   => [
					'type'    => 'text',
					'heading' => esc_html__( 'Phone', 'outsourceo' ),
				],

				'cs_email' => [
					'type'    => 'text',
					'heading' => esc_html__( 'Email', 'outsourceo' ),
				],
			]
		],

	] );

	\Aheto\Params::add_carousel_params( $shortcode, [
		'custom_options' => true,
		'prefix'         => 'cs_contacts_',
		'include'        => [
			'effect',
			'arrows',
			'pagination',
			'loop',
			'autoplay',
			'speed',
			'slides',
			'simulate_touch'
		],
		'dependency'     => [ 'template', [ 'cs_layout2' ] ]
	] );
}


/**
 * Recent Post Shortcode
 */

function outsourceo_recent_posts_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/recent-posts/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Creative', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );


	outsourceo_add_dependency( 'limit', [ 'cs_layout1' ], $shortcode );


	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

}


/**
 * Title Bar Shortcode
 */

function outsourceo_title_bar_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/title-bar/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Title With Search', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Creative', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );


	outsourceo_add_dependency( 'title', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'source', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'title_tag', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'title_typo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'use_title_typo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'sf_button', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'sf_placeholder', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'searchform', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'custom_breadcrumb', [ 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'breadcrumb_type', [ 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'links_color', [ 'cs_layout2' ], $shortcode );

	$shortcode->add_dependecy( 'cs_use_breadcrumb_typo', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_breadcrumb_typo', 'cs_use_breadcrumb_typo', 'true' );



	$shortcode->add_params( [
		'cs_use_breadcrumb_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for breadcrumbs?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_breadcrumb_typo'     => [
			'type'     => 'typography',
			'group'    => 'Breadcrumbs Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aht-breadcrumbs__item, {{WRAPPER}} .aht-breadcrumbs__item a',
		],
	] );

}


function outsourceo_title_bar_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_breadcrumb_typo'] ) && ! empty( $shortcode->atts['cs_breadcrumb_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aht-breadcrumbs__item, %1$s .aht-breadcrumbs__item a'], $shortcode->parse_typography( $shortcode->atts['cs_breadcrumb_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_title_bar_dynamic_css', 'outsourceo_title_bar_shortcode_dynamic_css', 10, 2 );


/**
 * Progress Bar Shortcode
 */

function outsourceo_progress_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/progress-bar/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Simple', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_dependecy( 'cs_current', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_symbol', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_use_dot', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_align', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_use_position_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_position_typo', 'cs_use_position_typo', 'true' );

	outsourceo_add_dependency( 'percentage', [ 'cs_layout1', 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'description', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'heading', [ 'cs_layout2' ], $shortcode );

	$shortcode->add_params( [
		'cs_current'   => [
			'type'    => 'text',
			'heading' => esc_html__( 'Symbol before Percentage', 'outsourceo' ),
		],
		'cs_symbol'    => [
			'type'    => 'text',
			'heading' => esc_html__( 'Symbol after Percentage', 'outsourceo' ),
		],
		'cs_use_dot'           => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use dot in the end number?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_use_position_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for numbers?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_position_typo'     => [
			'type'     => 'typography',
			'group'    => 'Numbers Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-counter__number, {{WRAPPER}} .aheto-counter__current, {{WRAPPER}} .aheto-counter__symbol',
		],
		'cs_align'             => [
			'type'    => 'select',
			'heading' => esc_html__( 'Align', 'outsourceo' ),
			'options' => \Aheto\Helper::choices_alignment(),
		],
	] );
}

function outsourceo_progress_bar_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_position_typo'] ) && ! empty( $shortcode->atts['cs_position_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-counter__number, %1$s .aheto-counter__current,  %1$s .aheto-counter__symbol'], $shortcode->parse_typography( $shortcode->atts['cs_position_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_progress_bar_dynamic_css', 'outsourceo_progress_bar_shortcode_dynamic_css', 10, 2 );

/**
 * Team member shortcode
 */
function outsourceo_team_member_shortcode( $shortcode ) {
	$dir = OUTSOURCEO_T_URI . '/aheto/team-member/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Team Member', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );


	outsourceo_add_dependency( 'image', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'position', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'name', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'designation', [ 'cs_layout1' ], $shortcode );


	$shortcode->add_dependecy( 'cs_use_title_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_title_typo', 'cs_use_title_typo', 'true' );

	$shortcode->add_dependecy( 'cs_use_position_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_position_typo', 'cs_use_position_typo', 'true' );

	$shortcode->add_params( [
		'cs_use_title_typo'    => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for name?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_title_typo'        => [
			'type'     => 'typography',
			'group'    => 'Name Typography',
			'settings' => [
				'tag'        => false,
				'text_align' => true,
			],
			'selector' => '{{WRAPPER}} .aheto-team-member__name',
		],
		'cs_use_position_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for position?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_position_typo'     => [
			'type'     => 'typography',
			'group'    => 'Position Typography',
			'settings' => [
				'tag'        => false,
				'text_align' => true,
			],
			'selector' => '{{WRAPPER}} .aheto-team-member__position',
		],

	] );

	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

}

function outsourceo_team_member_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_title_typo'] ) && ! empty( $shortcode->atts['cs_title_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-team-member__name'], $shortcode->parse_typography( $shortcode->atts['cs_title_typo'] ) );
	}
	if ( ! empty( $shortcode->atts['cs_use_position_typo'] ) && ! empty( $shortcode->atts['cs_position_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-team-member__position'], $shortcode->parse_typography( $shortcode->atts['cs_position_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_team_member_dynamic_css', 'outsourceo_team_member_shortcode_dynamic_css', 10, 2 );


/**
 * Clients Shortcode
 */

function outsourceo_clients_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/clients/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_dependecy( 'cs_max_width', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_aside_text', 'template', 'cs_layout1' );

	outsourceo_add_dependency( 'hover_style', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'clients', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'item_per_row', [ 'cs_layout1' ], $shortcode );

	$shortcode->add_params( [
		'cs_max_width'  => [
			'type'      => 'slider',
			'heading'   => esc_html__( 'Max width for image section', 'outsourceo' ),
			'grid'      => 12,
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 3000,
					'step' => 5,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .aheto-clients__wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		],
		'cs_aside_text' => [
			'type'    => 'text',
			'heading' => esc_html__( 'Aside Text', 'outsourceo' ),
		],
	] );
}


/**
 * Testimonial Shortcode
 */

function outsourceo_testimonials_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/testimonials/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Oursourceo Creative', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_layout( 'cs_layout3', [
		'title' => esc_html__( 'Oursourceo Single', 'outsourceo' ),
		'image' => $dir . 'cs_layout3.jpg',
	] );

	$shortcode->add_layout( 'cs_layout4', [
		'title' => esc_html__( 'Outsourceo Modern without shadows', 'outsourceo' ),
		'image' => $dir . 'cs_layout4.jpg',
	] );


	$shortcode->add_dependecy( 'cs_testimonial_item', 'template', ['cs_layout1', 'cs_layout4'] );

	$shortcode->add_dependecy( 'cs_bg_text', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_dark_version', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_testimonials_creative_item', 'template', 'cs_layout2' );

	$shortcode->add_dependecy( 'cs_single_testimonial', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_single_image', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_single_name', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_single_company', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_use_blockquote_typo', 'template', ['cs_layout1', 'cs_layout4'] );
	$shortcode->add_dependecy( 'cs_blockquote_typo', 'cs_use_blockquote_typo', 'true' );
	$shortcode->add_dependecy( 'cs_use_text_typo', 'template', ['cs_layout1', 'cs_layout4']  );
	$shortcode->add_dependecy( 'cs_text_typo', 'cs_use_text_typo', 'true' );

	$shortcode->add_dependecy( 'cs_use_position_typo', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_position_typo', 'cs_use_position_typo', 'true' );
	$shortcode->add_dependecy( 'outsourceo_use_bg_text_typo', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'outsourceo_bg_text_typo', 'outsourceo_use_bg_text_typo', 'true' );

	$shortcode->add_params( [
		'cs_testimonial_item'           => [
			'type'    => 'group',
			'heading' => esc_html__( 'Testimonials', 'outsourceo' ),
			'params'  => [
				'g_blockquote'  => [
					'type'    => 'text',
					'heading' => esc_html__( 'Blockquote', 'outsourceo' ),
					'default' => esc_html__( 'Blockquote', 'outsourceo' ),
				],
				'g_testimonial' => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Testimonial', 'outsourceo' ),
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'outsourceo' ),
				],
				'g_image'       => [
					'type'    => 'attach_image',
					'heading' => esc_html__( 'Display Image', 'outsourceo' ),
				],
				'g_name'        => [
					'type'    => 'text',
					'heading' => esc_html__( 'Name', 'outsourceo' ),
					'default' => esc_html__( 'Author name', 'outsourceo' ),
				],
				'g_company'     => [
					'type'    => 'text',
					'heading' => esc_html__( 'Position', 'outsourceo' ),
					'default' => esc_html__( 'Author position', 'outsourceo' ),
				],
			],
		],
		'cs_dark_version'               => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable dark version?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_bg_text'                    => [
			'type'    => 'text',
			'heading' => esc_html__( 'Background text', 'outsourceo' ),
			'default' => esc_html__( 'THEY SAY', 'outsourceo' ),
		],
		'cs_testimonials_creative_item' => [
			'type'    => 'group',
			'heading' => esc_html__( 'Modern Testimonials Items', 'outsourceo' ),
			'params'  => [
				'cs_image'       => [
					'type'    => 'attach_image',
					'heading' => esc_html__( 'Display Image', 'outsourceo' ),
				],
				'cs_name'        => [
					'type'    => 'text',
					'heading' => esc_html__( 'Name', 'outsourceo' ),
					'default' => esc_html__( 'Author name', 'outsourceo' ),
				],
				'cs_company'     => [
					'type'    => 'text',
					'heading' => esc_html__( 'Position', 'outsourceo' ),
					'default' => esc_html__( 'Author position', 'outsourceo' ),
				],
				'cs_testimonial' => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Testimonial', 'outsourceo' ),
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'outsourceo' ),
				],
			],
		],
		'cs_single_testimonial'         => [
			'type'    => 'textarea',
			'heading' => esc_html__( 'Testimonial', 'outsourceo' ),
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'outsourceo' ),
		],
		'cs_single_image'               => [
			'type'    => 'attach_image',
			'heading' => esc_html__( 'Display Image', 'outsourceo' ),
		],
		'cs_single_name'                => [
			'type'    => 'text',
			'heading' => esc_html__( 'Name', 'outsourceo' ),
			'default' => esc_html__( 'Author name', 'outsourceo' ),
		],
		'cs_single_company'             => [
			'type'    => 'text',
			'heading' => esc_html__( 'Position', 'outsourceo' ),
			'default' => esc_html__( 'Author position', 'outsourceo' ),
		],
		'cs_use_blockquote_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Blockquote?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_blockquote_typo' => [
			'type'     => 'typography',
			'group'    => 'Blockquote Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-tm__blockquote',
		],
		'cs_use_text_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Text?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_text_typo' => [
			'type'     => 'typography',
			'group'    => 'Text Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-tm__text',
		],
		'outsourceo_use_bg_text_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for background text?', 'moovit' ),
			'grid'    => 3,
		],
		'outsourceo_bg_text_typo' => [
			'type'     => 'typography',
			'group'    => 'Background text Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-tm__bg-text',
		],
		'cs_use_position_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Position?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_position_typo' => [
			'type'     => 'typography',
			'group'    => 'Position Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-tm__position',
		],
	] );

	\Aheto\Params::add_carousel_params( $shortcode, [
		'custom_options' => true,
		'prefix'         => 'cs_swiper_',
		'include'        => [
			'pagination',
			'speed',
			'loop',
			'autoplay',
			'spaces',
			'slides',
			'simulate_touch'
		],
		'dependency'     => [ 'template', [ 'cs_layout1', 'cs_layout2', 'cs_layout4' ] ]
	] );


}


function outsourceo_testimonials_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_blockquote_typo'] ) && ! empty( $shortcode->atts['cs_blockquote_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-tm__blockquote'], $shortcode->parse_typography( $shortcode->atts['cs_blockquote_typo'] ) );
	}

	if ( ! empty( $shortcode->atts['cs_use_text_typo'] ) && ! empty( $shortcode->atts['cs_text_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-tm__text'], $shortcode->parse_typography( $shortcode->atts['cs_text_typo'] ) );
	}

	if ( ! empty( $shortcode->atts['outsourceo_use_bg_text_typo'] ) && ! empty( $shortcode->atts['outsourceo_bg_text_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-tm__bg-text'], $shortcode->parse_typography( $shortcode->atts['outsourceo_bg_text_typo'] ) );
	}
	if ( ! empty( $shortcode->atts['cs_use_position_typo'] ) && ! empty( $shortcode->atts['cs_position_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-tm__position'], $shortcode->parse_typography( $shortcode->atts['cs_position_typo'] ) );
	}


	return $css;
}

add_filter( 'aheto_testimonials_dynamic_css', 'outsourceo_testimonials_shortcode_dynamic_css', 10, 2 );


/**
 * List Shortcode
 */

function outsourceo_list_shortcode( $shortcode ) {
	$dir = OUTSOURCEO_T_URI . '/aheto/list/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Number List', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );
	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Simple List', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_layout( 'cs_layout3', [
		'title' => esc_html__( 'Outsourceo Table List', 'outsourceo' ),
		'image' => $dir . 'cs_layout3.jpg',
	] );


	outsourceo_add_dependency( 'lists', [ 'cs_layout1' ], $shortcode );

	$shortcode->add_dependecy( 'cs_lists', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_links_color', 'template', 'cs_layout2' );

	$shortcode->add_dependecy( 'cs_first_column', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_second_column', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_third_column', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_table_lists', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_background', 'template', 'cs_layout3' );

	$shortcode->add_params( [
		'cs_lists' => [
			'type'    => 'group',
			'heading' => esc_html__( 'Link Lists', 'outsourceo' ),
			'params'  => [
				'cs_link_text' => [
					'type'    => 'text',
					'heading' => esc_html__( 'Text', 'outsourceo' ),
				],
				'cs_link_url'  => [
					'type'        => 'link',
					'heading'     => esc_html__( 'Link', 'outsourceo' ),
					'description' => esc_html__( 'Add url to list.', 'outsourceo' ),
					'default'     => [
						'url' => '#',
					],
				]
			],
		],

		'cs_first_column'  => [
			'type'    => 'text',
			'heading' => esc_html__( 'First Column Title', 'outsourceo' ),
		],
		'cs_second_column' => [
			'type'    => 'text',
			'heading' => esc_html__( 'Second Column Title', 'outsourceo' ),
		],
		'cs_third_column'  => [
			'type'    => 'text',
			'heading' => esc_html__( 'Third Column Title', 'outsourceo' ),
		],
		'cs_table_lists'   => [
			'type'    => 'group',
			'heading' => esc_html__( 'Table Lists', 'outsourceo' ),
			'params'  => [
				'cs_first_item'  => [
					'type'    => 'text',
					'heading' => esc_html__( 'First Item Text', 'outsourceo' ),
				],
				'cs_second_item' => [
					'type'    => 'text',
					'heading' => esc_html__( 'Second Item Text', 'outsourceo' ),
				],
				'cs_third_item'  => [
					'type'    => 'text',
					'heading' => esc_html__( 'Third Item Text', 'outsourceo' ),
				],
			],
		],
		'cs_links_color'   => [
			'type'      => 'colorpicker',
			'heading'   => esc_html__( 'Links color', 'outsourceo' ),
			'grid'      => 6,
			'selectors' => [ '{{WRAPPER}} .aheto-list--outsourceo-links li a' => 'color: {{VALUE}}' ],
		],
		'cs_background'    => [
			'type'      => 'colorpicker',
			'heading'   => esc_html__( 'Background color', 'outsourceo' ),
			'grid'      => 6,
			'selectors' => [ '{{WRAPPER}} .aheto-list--row .aheto-list--column' => 'background: {{VALUE}}' ],
		]
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_main_',
		'add_button' => true,
	], 'cs_table_lists' );

}

function outsourceo_list_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_links_color'] ) ) {
		$color                               = Sanitize::color( $shortcode->atts['color'] );
		$css['global']['%1$s li a']['color'] = $color;
	}

	if ( ! empty( $shortcode->atts['cs_background'] ) ) {
		$color                                                                    = Sanitize::color( $shortcode->atts['cs_background'] );
		$css['global']['%1$s .aheto-list--row .aheto-list--column']['background'] = $color;
	}

	return $css;
}

add_filter( 'aheto_list_dynamic_css', 'outsourceo_list_shortcode_dynamic_css', 10, 2 );


/**
 * Navigation Shortcode
 */

function outsourceo_navigation_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/navigation/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Simple', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Menu', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );


	outsourceo_add_dependency( 'transparent', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'text_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'type_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'scroll_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'add_scroll_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'mob_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'scroll_mob_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'add_mob_scroll_logo', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'max_width', [ 'cs_layout1' ], $shortcode );

	outsourceo_add_dependency( 'title', [ 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'title_space', [ 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'list_space', [ 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'text_typo', [ 'cs_layout2' ], $shortcode );
	outsourceo_add_dependency( 'hovercolor', [ 'cs_layout2' ], $shortcode );

	$shortcode->add_dependecy( 'cs_links_color', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_use_logo_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_logo_typo', 'cs_use_logo_typo', 'true' );
	$shortcode->add_dependecy( 'cs_use_menu_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_menu_typo', 'cs_use_menu_typo', 'true' );
	$shortcode->add_dependecy( 'cs_use_megamenu_title_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_megamenu_title_typo', 'cs_use_megamenu_title_typo', 'true' );

	$shortcode->add_params( [
		'cs_links_color' => [
			'type'      => 'colorpicker',
			'heading'   => esc_html__( 'Links color', 'outsourceo' ),
			'grid'      => 6,
			'selectors' => [ '{{WRAPPER}} .widget-nav-menu--menu .widget-nav-menu__menu li a' => 'color: {{VALUE}}' ],
		],
		'cs_use_logo_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Logo?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_logo_typo' => [
			'type'     => 'typography',
			'group'    => 'Logo Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .main-header__logo span',
		],
		'cs_use_menu_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Menu Items?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_menu_typo' => [
			'type'     => 'typography',
			'group'    => 'Menu Items Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .main-header__menu-box .main-menu>li>a, {{WRAPPER}} .main-header__menu-box>ul>li>a, {{WRAPPER}} .main-header__menu-box-title, {{WRAPPER}} .main-header__menu-box .btn-close, {{WRAPPER}} .main-header__menu-box .menu-item--mega-menu .mega-menu__col',
		],
		'cs_use_megamenu_title_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Mega Menu Title?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_megamenu_title_typo' => [
			'type'     => 'typography',
			'group'    => 'Mega Menu Title Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .main-header__menu-box .main-menu .menu-item--mega-menu .mega-menu__title, {{WRAPPER}} .main-header__menu-box>ul .menu-item--mega-menu .mega-menu__title',
		],
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_main_',
		'group'      => 'Desktop buttons',
		'icons'      => true,
		'add_button' => true,
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'add_label'  => esc_html__( 'Add additional button?', 'outsourceo' ),
		'prefix'     => 'cs_add_',
		'group'      => 'Desktop buttons',
		'icons'      => true,
		'add_button' => true,
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_main_mob_',
		'group'      => 'Mobile Buttons',
		'icons'      => true,
		'add_button' => true,
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'add_label'  => esc_html__( 'Add additional button?', 'outsourceo' ),
		'prefix'     => 'cs_add_mob_',
		'group'      => 'Mobile Buttons',
		'icons'      => true,
		'add_button' => true,
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

}

function outsourceo_navigation_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_logo_typo'] ) && ! empty( $shortcode->atts['cs_logo_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .main-header__logo span'], $shortcode->parse_typography( $shortcode->atts['cs_logo_typo'] ) );
	}

	if ( ! empty( $shortcode->atts['cs_use_menu_typo'] ) && ! empty( $shortcode->atts['cs_menu_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .main-header__menu-box .main-menu>li>a, %1$s .main-header__menu-box>ul>li>a, %1$s .main-header__menu-box-title, %1$s .main-header__menu-box .btn-close, %1$s .main-header__menu-box .menu-item--mega-menu .mega-menu__col'], $shortcode->parse_typography( $shortcode->atts['cs_menu_typo'] ) );
	}

	if ( ! empty( $shortcode->atts['cs_use_megamenu_title_typo'] ) && ! empty( $shortcode->atts['cs_megamenu_title_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .main-header__menu-box .main-menu .menu-item--mega-menu .mega-menu__title, %1$s .main-header__menu-box>ul .menu-item--mega-menu .mega-menu__title'], $shortcode->parse_typography( $shortcode->atts['cs_megamenu_title_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_navigation_dynamic_css', 'outsourceo_navigation_shortcode_dynamic_css', 10, 2 );

/**
 * Outsourceo Socials
 */

function outsourceo_networks_shortcode( $shortcode ) {
	$dir = OUTSOURCEO_T_URI . '/aheto/social-networks/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Socials', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );


	outsourceo_add_dependency( 'networks', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'size', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'socials_align', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'socials_align_mob', [ 'cs_layout1' ], $shortcode );

	$shortcode->add_dependecy( 'cs_dark_style', 'template', 'cs_layout1' );
	$shortcode->add_params( [

		'cs_dark_style'           => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable dark style for outsourceos?', 'outsourceo' ),
			'grid'    => 3,
		],

	] );
}


/**
 * Navbar Shortcode
 */

function outsourceo_navbar_shortcode( $shortcode ) {
	$dir = OUTSOURCEO_T_URI . '/aheto/navbar/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Simple', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Additional (fixed on scroll)', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_dependecy( 'cs_menus', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_transparent', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_fixed_menu', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_use_menu_typo', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_menu_typo', 'cs_use_menu_typo', 'true' );

	$shortcode->add_dependecy( 'cs_navbar_links', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_dark_style', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_align', 'template', 'cs_layout1' );


	$shortcode->add_dependecy( 'cs_label', 'cs_type_link', ['phone', 'email','custom', 'text'] );
	$shortcode->add_dependecy( 'cs_phone', 'cs_type_link', 'phone' );
	$shortcode->add_dependecy( 'cs_email', 'cs_type_link', 'email' );
	$shortcode->add_dependecy( 'cs_add_icon', 'cs_type_link', ['phone','email'] );
	$shortcode->add_dependecy( 'cs_type_icon', 'cs_add_icon', 'true' );
	$shortcode->add_dependecy( 'cs_custom_link', 'cs_type_link', 'custom' );



	$shortcode->add_params( [
		'cs_dark_style'    => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable dark style for link?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_navbar_links'  => [
			'type'    => 'group',
			'heading' => esc_html__( 'Navigation Bar links', 'outsourceo' ),
			'params'  => [
				'cs_type_link'   => [
					'type'    => 'select',
					'heading' => esc_html__( 'Type of link', 'outsourceo' ),
					'options' => [
						'phone'     => esc_html__( 'Phone', 'outsourceo' ),
						'email'     => esc_html__( 'Email', 'outsourceo' ),
						'custom'    => esc_html__( 'Custom link', 'outsourceo' ),
						'text'      => esc_html__( 'Just text', 'outsourceo' ),
						'searchbox' => esc_html__( 'Searchbox', 'outsourceo' ),
						'languague' => esc_html__( 'Languague picker', 'outsourceo' ),
					],
				],
				'cs_add_icon'    => [
					'type'    => 'switch',
					'heading' => esc_html__( 'Add icon before label?', 'outsourceo' ),
					'grid'    => 6,
					'default' => '',
				],
				'cs_type_icon'   => [
					'type'    => 'select',
					'heading' => esc_html__( 'Type of icon', 'outsourceo' ),
					'options' => [
						''         => esc_html__( 'Solid', 'outsourceo' ),
						'-outline' => esc_html__( 'Outline', 'outsourceo' ),
					],
				],
				'cs_label'       => [
					'type'    => 'text',
					'heading' => esc_html__( 'Label', 'outsourceo' ),
				],
				'cs_phone'       => [
					'type'    => 'text',
					'heading' => esc_html__( 'Phone', 'outsourceo' ),
				],
				'cs_email'       => [
					'type'    => 'text',
					'heading' => esc_html__( 'Email', 'outsourceo' ),
				],
				'cs_custom_link' => [
					'type'    => 'text',
					'heading' => esc_html__( 'Link', 'outsourceo' ),
				],
			],
		],
		'cs_align'         => [
			'type'    => 'select',
			'heading' => esc_html__( 'Align', 'outsourceo' ),
			'options' => \Aheto\Helper::choices_alignment(),
		],
		'cs_menus'         => [
			'type'        => 'select',
			'heading'     => esc_html__( 'Additional Menu', 'outsourceo' ),
			'options'     => \Aheto\Helper::choices_nav_menu(),
			'description' => esc_html__( 'Use menu with one level items', 'outsourceo' ),
		],
		'cs_transparent'   => [
			'type'    => 'select',
			'heading' => esc_html__( 'Type of menu', 'outsourceo' ),
			'options' => [
				'transparent_dark'  => esc_html__( 'Dark', 'outsourceo' ),
				'transparent_white' => esc_html__( 'White', 'outsourceo' ),
			],
		],
		'cs_fixed_menu'    => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable fixed additional menu on scroll?', 'outsourceo' ),
			'grid'    => 6,
		],
		'cs_use_menu_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Menu?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_menu_typo' => [
			'type'     => 'typography',
			'group'    => 'Menu Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-navbar--inner ul li a',
		],
	] );
}

function outsourceo_navbar_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_menu_typo'] ) && ! empty( $shortcode->atts['cs_menu_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-navbar--inner ul li a'], $shortcode->parse_typography( $shortcode->atts['cs_menu_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_navbar_dynamic_css', 'outsourceo_navbar_shortcode_dynamic_css', 10, 2 );

/**
 * Contents Shortcode
 */

function outsourceo_contents_shortcode( $shortcode ) {

	$theme_dir = OUTSOURCEO_T_URI . '/aheto/contents/previews/';

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Creative slider', 'outsourceo' ),
		'image' => $theme_dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_layout( 'cs_layout3', [
		'title' => esc_html__( 'Outsourceo Faq', 'outsourceo' ),
		'image' => $theme_dir . 'cs_layout3.jpg',
	] );

	$shortcode->add_layout( 'cs_layout4', [
		'title' => esc_html__( 'Outsourceo Custom Text', 'outsourceo' ),
		'image' => $theme_dir . 'cs_layout4.jpg',
	] );


	$shortcode->add_dependecy( 'cs_creative_items', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_creative_version', 'template', 'cs_layout2' );

	$shortcode->add_dependecy( 'cs_simple_text', 'template', 'cs_layout4' );
	$shortcode->add_dependecy( 'cs_use_typo_simple_text', 'template', 'cs_layout4' );
	$shortcode->add_dependecy( 'cs_text_typo_simple_text', 'cs_use_typo_simple_text', 'true' );

	outsourceo_add_dependency( 'faqs', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'first_is_opened', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'multi_active', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'title_typo', [ 'cs_layout3' ], $shortcode );
	outsourceo_add_dependency( 'text_typo', [ 'cs_layout3' ], $shortcode );

	$shortcode->add_params( [
		'cs_creative_items'   => [
			'type'    => 'group',
			'heading' => esc_html__( 'Slides', 'outsourceo' ),
			'params'  => [
				'cs_item_image'         => [
					'type'    => 'attach_image',
					'heading' => esc_html__( 'Image', 'outsourceo' ),
				],
				'cs_item_title'         => [
					'type'    => 'text',
					'heading' => esc_html__( 'Title', 'outsourceo' ),
				],
				'cs_item_use_dot'       => [
					'type'    => 'switch',
					'heading' => esc_html__( 'Use dot in the end title?', 'outsourceo' ),
					'grid'    => 12,
				],
				'cs_item_dot_color'     => [
					'type'    => 'select',
					'heading' => esc_html__( 'Color for dot', 'outsourceo' ),
					'options' => [
						'primary' => esc_html__( 'Primary', 'outsourceo' ),
						'dark'    => esc_html__( 'Dark', 'outsourceo' ),
						'white'   => esc_html__( 'White', 'outsourceo' ),
					],
					'default' => 'primary',
				],
				'cs_item_desc'          => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Description', 'outsourceo' ),
				],
				'cs_item_btn_direction' => [
					'type'    => 'select',
					'heading' => esc_html__( 'Buttons Direction', 'outsourceo' ),
					'options' => [
						''            => esc_html__( 'Horizontal', 'outsourceo' ),
						'is-vertical' => esc_html__( 'Vertical', 'outsourceo' ),
					],
				],
			]
		],
		'cs_creative_version' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable creative version?', 'outsourceo' ),
			'grid'    => 3,
		],
		'cs_simple_text'    => [
			'type'    => 'wysiwyg',
			'heading' => esc_html__( 'Text Simple', 'outsourceo' ),
			'default' => esc_html__( 'Put your text...', 'outsourceo' ),
		],
		'cs_use_typo_simple_text'    => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Simple Text?', 'outsourceo' ),
			'grid'    => 6,
		],
		'cs_text_typo_simple_text'   => [
			'type'     => 'typography',
			'group'    => 'Simple Text Typography',
			'settings' => [
				'tag'        => false,
				'text_align' => false,
			],
			'selector' => '{{WRAPPER}} .aheto-content--outsourceo-simple *',
		],
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_link_',
		'icons'      => true,
		'add_button' => true,
		'dependency' => [ 'template', 'cs_layout1' ],
	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_main_',
		'icons'      => true,
		'add_button' => true,
	], 'cs_creative_items' );

	\Aheto\Params::add_button_params( $shortcode, [
		'add_label'  => esc_html__( 'Add additional button?', 'outsourceo' ),
		'prefix'     => 'cs_add_',
		'icons'      => true,
		'add_button' => true,
	], 'cs_creative_items' );

	\Aheto\Params::add_carousel_params( $shortcode, [
		'custom_options' => true,
		'prefix'         => 'cs_swiper_',
		'include'        => [ 'effect', 'speed', 'loop', 'autoplay', 'arrows', 'lazy', 'simulate_touch' ],
		'dependency'     => [ 'template', [ 'cs_layout2' ] ]
	] );

	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout2' ] ]
	] );

}

function outsourceo_contents_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_background'] ) ) {
		$color                                                              = Sanitize::color( $shortcode->atts['cs_background'] );
		$css['global']['%1$s .aheto-contents__wrapper']['background-color'] = $color;
	}

	if ( ! empty( $shortcode->atts['cs_text_color'] ) ) {
		$color                                                             = Sanitize::color( $shortcode->atts['cs_text_color'] );
		$css['global']['%1$s .aheto-contents__inner_wrapper > *']['color'] = $color;
	}

	if ( ! empty( $shortcode->atts['cs_use_typo_simple_text'] ) && ! empty( $shortcode->atts['cs_text_typo_simple_text'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-content--outsourceo-simple *'], $shortcode->parse_typography( $shortcode->atts['cs_text_typo_simple_text'] ) );
	}

	return $css;
}

add_filter( 'aheto_contents_dynamic_css', 'outsourceo_contents_shortcode_dynamic_css', 10, 2 );


/**
 * Video Button Shortcode
 */

function outsourceo_video_btn_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/video-btn/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Creative', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_dependecy( 'cs_video_image', 'template', 'cs_layout1' );

	$shortcode->add_params( [
		'cs_video_image' => [
			'type'    => 'attach_image',
			'heading' => esc_html__( 'Video Button Image', 'outsourceo' ),
		],
	] );

	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );


}


/**
 * Coming Soon Shortcode
 */

function outsourceo_coming_soon_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/coming-soon/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Creative', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	outsourceo_add_dependency( 'light', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'time', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'days_desktop', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'days_mobile', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'hours_desktop', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'hours_mobile', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'mins_desktop', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'mins_mobile', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'secs_desktop', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'secs_mobile', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'typo_numbers', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'typo_caption', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'use_typo_caption', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'use_typo_numbers', [ 'cs_layout1' ], $shortcode );

}


/**
 * Custom Post Type Shortcode
 */

function outsourceo_custom_post_types_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/custom-post-types/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Metro', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_dependecy( 'cs_img_off', 'skin', 'cs_skin-1' );
	$shortcode->add_dependecy( 'cs_use_dot', 'skin', 'cs_skin-1' );
	$shortcode->add_dependecy( 'cs_use_author_typo', 'skin', 'cs_skin-1' );
	$shortcode->add_dependecy( 'cs_author_typo', 'cs_use_author_typo', 'true' );

	$shortcode->add_dependecy( 'cs_use_cat_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_cat_typo', 'cs_use_cat_typo', 'true' );
	$shortcode->add_dependecy( 'cs_use_author_date_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_author_date_typo', 'cs_use_author_date_typo', 'true' );

	// CUSTOM SKIN 1

	$aheto_skins      = $shortcode->params['skin']['options'];
	$outsourceo_skins = array(
		'cs_skin-1' => 'Outsourceo skin 1',
		'cs_skin-2' => 'Outsourceo skin 2',
	);

	$shortcode->add_params( [
		'cs_img_off' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Disable post image?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_use_dot'       => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use dot in the end heading?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_use_cat_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Categories?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_cat_typo' => [
			'type'     => 'typography',
			'group'    => 'Categories Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-cpt__cats a',
		],
		'cs_use_author_date_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Author and Date?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_author_date_typo' => [
			'type'     => 'typography',
			'group'    => 'Author and Date Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-cpt__author-name, {{WRAPPER}} .aheto-cpt__date p',
		],
		'cs_use_author_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Author?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_author_typo' => [
			'type'     => 'typography',
			'group'    => 'Author Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-cpt-article__author',
		],

	] );

	$all_skins                            = array_merge( $aheto_skins, $outsourceo_skins );
	$shortcode->params['skin']['options'] = $all_skins;

}


function outsourceo_cpt_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_cat_typo'] ) && ! empty( $shortcode->atts['cs_cat_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-cpt__cats a'], $shortcode->parse_typography( $shortcode->atts['cs_cat_typo'] ) );
	}


	if ( ! empty( $shortcode->atts['cs_use_author_date_typo'] ) && ! empty( $shortcode->atts['cs_author_date_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-cpt__author-name, %1$s .aheto-cpt__date p'], $shortcode->parse_typography( $shortcode->atts['cs_author_date_typo'] ) );
	}

	if ( ! empty( $shortcode->atts['cs_use_author_typo'] ) && ! empty( $shortcode->atts['cs_author_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-cpt-article__author'], $shortcode->parse_typography( $shortcode->atts['cs_author_typo'] ) );
	}

	return $css;
}

add_filter( 'aheto_cpt_dynamic_css', 'outsourceo_cpt_shortcode_dynamic_css', 10, 2 );


function outsourceo_cpt_image_sizer_layouts( $image_sizer_layouts ) {

	$image_sizer_layouts[] = 'cs_layout1';

	return $image_sizer_layouts;
}

add_filter( 'aheto_cpt_image_sizer_layouts', 'outsourceo_cpt_image_sizer_layouts', 10, 2 );

/**
 * Features Single Shortcode
 */

function outsourceo_features_single_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/features-single/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_layout( 'cs_layout2', [
		'title' => esc_html__( 'Outsourceo Creative', 'outsourceo' ),
		'image' => $dir . 'cs_layout2.jpg',
	] );

	$shortcode->add_layout( 'cs_layout3', [
		'title' => esc_html__( 'Outsourceo With Image', 'outsourceo' ),
		'image' => $dir . 'cs_layout3.jpg',
	] );

	$shortcode->add_layout( 'cs_layout4', [
		'title' => esc_html__( 'Outsourceo With Background', 'outsourceo' ),
		'image' => $dir . 'cs_layout4.jpg',
	] );

	// LAYOUT 1
	$shortcode->add_dependecy( 'cs_background_hover_color', 'template', [ 'cs_layout1', 'cs_layout3'] );
	$shortcode->add_dependecy( 'cs_use_dot', 'template', [ 'cs_layout1', 'cs_layout3' ] );
	$shortcode->add_dependecy( 'cs_link_url', 'template', [ 'cs_layout1', 'cs_layout2', 'cs_layout3', 'cs_layout4' ] );
	$shortcode->add_dependecy( 'cs_link_text', 'template', [ 'cs_layout1', 'cs_layout3', 'cs_layout4' ] );

	$shortcode->add_dependecy( 'cs_logo_image', 'template', 'cs_layout2' );
	$shortcode->add_dependecy( 'cs_overlay', 'template', 'cs_layout2' );

	$shortcode->add_dependecy( 'cs_light_style', 'template', 'cs_layout3' );
	$shortcode->add_dependecy( 'cs_overlay_color', 'cs_overlay', 'true' );


	outsourceo_add_dependency( 's_image', [ 'cs_layout1', 'cs_layout2', 'cs_layout3', 'cs_layout4' ], $shortcode );
	outsourceo_add_dependency( 's_heading', [ 'cs_layout1', 'cs_layout2', 'cs_layout3', 'cs_layout4' ], $shortcode );
	outsourceo_add_dependency( ['use_heading', 't_heading'], [ 'cs_layout1', 'cs_layout3', 'cs_layout4' ], $shortcode );
	outsourceo_add_dependency( 's_description', [ 'cs_layout1', 'cs_layout2', 'cs_layout3', 'cs_layout4' ], $shortcode );
	outsourceo_add_dependency( 't_description', [ 'cs_layout1', 'cs_layout3', 'cs_layout4' ], $shortcode );
	outsourceo_add_dependency( 'use_description', [ 'cs_layout1', 'cs_layout3', 'cs_layout4' ], $shortcode );


	$shortcode->add_params( [
		'cs_light_style'   => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable light style?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_use_dot'       => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use dot in the end heading?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_link_text'     => [
			'type'    => 'text',
			'heading' => esc_html__( 'Link Text', 'outsourceo' ),
			'default' => 'Click Me'
		],
		'cs_link_url'      => [
			'type'    => 'text',
			'heading' => esc_html__( 'Link URL', 'outsourceo' ),
			'default' => '#'
		],
		'cs_overlay'       => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable overlay for background image?', 'outsourceo' ),
			'grid'    => 12,
		],
		'cs_overlay_color' => [
			'type'    => 'colorpicker',
			'heading' => esc_html__( 'Overlay Color', 'outsourceo' ),
			'grid'    => 12,
			'default' => ''
		],
		'cs_logo_image'    => [
			'type'    => 'attach_image',
			'heading' => esc_html__( 'Image Logo', 'outsourceo' ),
		],
		'cs_background_hover_color' => [
			'type'    => 'colorpicker',
			'heading' => esc_html__( 'Background Hover Color', 'outsourceo' ),
			'grid'    => 12,
			'default' => '',
			'selectors' => [ '{{WRAPPER}} .aheto-content-block__wrap:hover' => 'background: {{VALUE}}' ],
		],
	] );

	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout1', 'cs_layout2', 'cs_layout3' ] ]
	] );

	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'group'      => esc_html__( 'Images size for logo ', 'outsourceo' ),
		'prefix'     => 'cs_logo_',
		'dependency' => [ 'template', [ 'cs_layout2' ] ]
	] );
}


function outsourceo_features_single_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_background_hover_color'] ) ) {
		$color                               = Sanitize::color( $shortcode->atts['color'] );
		$css['global']['%1$s .aheto-content-block__wrap:hover']['color'] = $color;
	}

	return $css;
}

add_filter( 'aheto_features_single_dynamic_css', 'outsourceo_features_single_shortcode_dynamic_css', 10, 2 );


/**
 * Features Timeline Shortcode
 */

function outsourceo_features_timeline_shortcode( $shortcode ) {
	$dir = OUTSOURCEO_T_URI . '/aheto/features-timeline/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	$shortcode->add_dependecy( 'cs_timeline', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_dark_version', 'template', 'cs_layout1' );


	$shortcode->add_params( [
		'cs_timeline' => [
			'type'    => 'group',
			'heading' => esc_html__( 'Items', 'outsourceo' ),
			'params'  => [
				'cs_timeline_date'    => [
					'type'    => 'text',
					'heading' => esc_html__( 'Date', 'outsourceo' ),
				],
				'cs_timeline_title'   => [
					'type'        => 'textarea',
					'heading'     => esc_html__( 'Title', 'outsourceo' ),
					'description' => esc_html__( 'To Hightlight text insert text between: [[ Your Text Here ]]', 'outsourceo' ),
					'default'     => esc_html__( 'Title with [[ hightlight ]] text.', 'outsourceo' ),
				],
				'cs_use_dot'          => [
					'type'    => 'switch',
					'heading' => esc_html__( 'Use dot in the end title?', 'outsourceo' ),
					'grid'    => 12,
				],
				'cs_dot_color'        => [
					'type'    => 'select',
					'heading' => esc_html__( 'Color for dot', 'outsourceo' ),
					'options' => [
						'primary' => esc_html__( 'Primary', 'outsourceo' ),
						'dark'    => esc_html__( 'Dark', 'outsourceo' ),
						'white'   => esc_html__( 'White', 'outsourceo' ),
					],
					'default' => 'primary',
				],
				'cs_timeline_content' => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Content', 'outsourceo' ),
					'default' => esc_html__( 'Add some text for content', 'outsourceo' ),
				],
				'cs_timeline_image'   => [
					'type'    => 'attach_image',
					'heading' => esc_html__( 'Add image', 'outsourceo' ),
				],
			],
		],

		'cs_dark_version' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Enable dark version?', 'outsourceo' ),
			'grid'    => 3,
		],


	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_',
		'icons'      => true,
		'add_button' => true,
	], 'cs_timeline' );


	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );


}


/**
 * Features Banner Slider
 */

function outsourceo_banner_slider_shortcode( $shortcode ) {

	$dir = OUTSOURCEO_T_URI . '/aheto/banner-slider/previews/';

	$shortcode->add_layout( 'cs_layout1', [
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	] );

	outsourceo_add_dependency( 't_heading', [ 'cs_layout1' ], $shortcode );
	outsourceo_add_dependency( 'use_heading', [ 'cs_layout1' ], $shortcode );

	$shortcode->add_dependecy( 'outsourceo_modern_banners', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_overlay_color', 'cs_overlay', 'true' );

	$shortcode->add_dependecy( 'cs_use_descr_typo', 'template', 'cs_layout1' );
	$shortcode->add_dependecy( 'cs_descr_typo', 'cs_use_descr_typo', 'true' );

	$shortcode->add_params( [
		'outsourceo_modern_banners' => [
			'type'    => 'group',
			'heading' => esc_html__( 'Banners', 'outsourceo' ),
			'params'  => [
				'cs_image'         => [
					'type'    => 'attach_image',
					'heading' => esc_html__( 'Background Image', 'outsourceo' ),
				],
				'cs_add_image'     => [
					'type'    => 'attach_image',
					'heading' => esc_html__( 'Additional Image', 'outsourceo' ),
				],
				'cs_overlay'       => [
					'type'    => 'switch',
					'heading' => esc_html__( 'Enable overlay for background image?', 'outsourceo' ),
					'grid'    => 12,
				],
				'cs_overlay_color' => [
					'type'    => 'colorpicker',
					'heading' => esc_html__( 'Overlay Color', 'outsourceo' ),
					'grid'    => 12,
					'default' => ''
				],
				'cs_title'         => [
					'type'    => 'text',
					'heading' => esc_html__( 'Title', 'outsourceo' ),
				],
				'cs_use_dot'       => [
					'type'    => 'switch',
					'heading' => esc_html__( 'Use dot in the end title?', 'outsourceo' ),
					'grid'    => 12,
				],
				'cs_desc'          => [
					'type'    => 'textarea',
					'heading' => esc_html__( 'Description', 'outsourceo' ),
				],
				'cs_align' => [
					'type'    => 'select',
					'heading' => esc_html__('Align', 'outsourceo'),
					'options' => \Aheto\Helper::choices_alignment(),
				],
				'cs_btn_direction' => [
					'type'    => 'select',
					'heading' => esc_html__( 'Buttons Direction', 'outsourceo' ),
					'options' => [
						''            => esc_html__( 'Horizontal', 'outsourceo' ),
						'is-vertical' => esc_html__( 'Vertical', 'outsourceo' ),
					],
				],
			]
		],

		'cs_use_descr_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__( 'Use custom font for Description?', 'outsourceo' ),
			'grid'    => 6,
		],

		'cs_descr_typo' => [
			'type'     => 'typography',
			'group'    => 'Description Typography',
			'settings' => [
				'tag'        => false,
			],
			'selector' => '{{WRAPPER}} .aheto-banner-slider__desc',
		],

	] );

	\Aheto\Params::add_button_params( $shortcode, [
		'prefix'     => 'cs_main_',
		'add_button' => true,
	], 'outsourceo_modern_banners' );

	\Aheto\Params::add_carousel_params( $shortcode, [
		'custom_options' => true,
		'prefix'         => 'cs_swiper_',
		'include'        => [ 'effect', 'speed', 'loop', 'autoplay', 'arrows', 'arrows_style', 'lazy', 'arrows_size' ],
		'dependency'     => [ 'template', [ 'cs_layout1' ] ]
	] );

	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'prefix'     => 'cs_',
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );
	\Aheto\Params::add_image_sizer_params( $shortcode, [
		'group'      => esc_html__( 'Images size for additional image', 'outsourceo' ),
		'prefix'     => 'cs_add_',
		'dependency' => [ 'template', [ 'cs_layout1' ] ]
	] );

}

function outsourceo_banner_slider_shortcode_dynamic_css( $css, $shortcode ) {

	if ( ! empty( $shortcode->atts['cs_use_descr_typo'] ) && ! empty( $shortcode->atts['cs_descr_typo'] ) ) {
		\aheto_add_props( $css['global']['%1$s .aheto-banner-slider__desc'], $shortcode->parse_typography( $shortcode->atts['cs_descr_typo'] ) );
	}

	if ( !empty($this->atts['cs_swiper_arrows_size']) ) {
		$css['global']['%1$s .swiper-button-next, %1$s .swiper-button-prev']['font-size'] = Sanitize::size( $this->atts['cs_swiper_arrows_size'] );
	}

	return $css;
}

add_filter( 'aheto_banner_slider_dynamic_css', 'outsourceo_banner_slider_shortcode_dynamic_css', 10, 2 );


function outsourceo_banner_slider_carousel( $carousel_params ) {

	$carousel_params['include'][] = 'pagination';

	return $carousel_params;

}

add_filter( 'aheto_banner_slider_carousel', 'outsourceo_banner_slider_carousel', 10, 2 );


/**
 * Custom Button
 */

function outsourceo_button_all_layouts( $all_layouts ) {

	$dir                       = OUTSOURCEO_T_URI . '/aheto/button/previews/';
	$all_layouts['cs_layout1'] = array(
		'title' => esc_html__( 'Outsourceo Modern', 'outsourceo' ),
		'image' => $dir . 'cs_layout1.jpg',
	);

	return $all_layouts;

}

add_filter( 'aheto_button_all_layouts', 'outsourceo_button_all_layouts', 10, 2 );


/**
 * Aheto dependency
 */

function outsourceo_add_dependency( $id, $args = array(), $shortcode ) {

	if ( is_array( $id ) ) {

		foreach ( $id as $slug ) {
			$param = (array)$shortcode->depedency[$slug]['template'];
			$shortcode->depedency[$slug]['template'] = array_merge($args, $param );
		}

	} else {
		$param = (array)$shortcode->depedency[$id]['template'];
		$shortcode->depedency[$id]['template'] = array_merge($args, $param );
	}

	return;
}


/**
 * Dot string replace
 */

function outsourceo_dot_string( $string, $dot, $cs_dot_color ) {

	if ( $dot ) {

		$string = str_replace( '{{.}}', '<span class="outsourceo-dot dot-' . esc_attr( $cs_dot_color ) . '"></span>', $string );

		$words = explode( " ", $string );

		if ( count( $words ) > 0 ) {
			$last_word = $words[ count( $words ) - 1 ];

			$last_space_position = strrpos( $string, ' ' );
			$start_string        = substr( $string, 0, $last_space_position );

			return wp_kses( $start_string, 'post' ) . ' <span class="outsourceo-dot dot-' . esc_attr( $cs_dot_color ) . '">' . wp_kses( $last_word, 'post' ) . '</span>';
		} else {
			return '<span class="outsourceo-dot dot-' . esc_attr( $cs_dot_color ) . '">' . wp_kses( $string, 'post' ) . '</span>';
		}

	} else {
		return wp_kses( $string, 'post' );
	}
}