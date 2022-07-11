<?php


use Aheto\Helper;

add_action('aheto_before_aheto_contact-info_register', 'sterling_contact_info_layout2');


/**
 * Contact info
 */

function sterling_contact_info_layout2($shortcode)
{

	$dir = '//assets.aheto.co/contact-info/previews/';

	$shortcode->add_layout('sterling_layout2', [
		'title' => esc_html__('Sterling contacts info items', 'sterling'),
		'image' => $dir . 'sterling_layout2.jpg',
	]);

	$shortcode->add_dependecy('sterling_description', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_use_description_typo', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_description_typo', 'sterling_use_description_typo', 'true');
	$shortcode->add_dependecy('sterling_address', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_phone', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_phone2', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_email', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_use_info_typo', 'template', ['sterling_layout2']);
	$shortcode->add_dependecy('sterling_info_typo', 'sterling_use_info_typo', 'true');

	$shortcode->add_params([
		'sterling_description' => [
			'type'    => 'textarea',
			'heading' => esc_html__('Description', 'sterling'),
		],
		'sterling_use_description_typo'    => [
			'type'    => 'switch',
			'heading' => esc_html__('Use custom font for Descr?', 'sterling'),
			'grid'    => 4,
		],
		'sterling_description_typo' => [
			'type'     => 'typography',
			'group'    => 'Descr Typography',
			'settings' => [
				'tag'        => false,
				'text_align' => false,
			],
			'selector' => '{{WRAPPER}} .widget_aheto__desc',
		],
		'sterling_address'     => [
			'type'    => 'textarea',
			'heading' => esc_html__('Address', 'sterling'),
		],
		'sterling_email'       => [
			'type'    => 'text',
			'heading' => esc_html__('Email', 'sterling'),
		],
		'sterling_phone'       => [
			'type'    => 'text',
			'heading' => esc_html__('Phone', 'sterling'),
		],
		'sterling_phone2'       => [
			'type'    => 'text',
			'heading' => esc_html__('Phone 2', 'sterling'),
		],
		'sterling_use_info_typo' => [
			'type'    => 'switch',
			'heading' => esc_html__('Use custom font for info items?', 'sterling'),
			'grid'    => 3,
		],
		'sterling_info_typo' => [
			'type'     => 'typography',
			'group'    => 'Info items Typography',
			'settings' => [
				'tag'        => false,
				'text_align' => false,
			],
			'selector' => '{{WRAPPER}} .widget_aheto__info-item'
		],
	]);

	\Aheto\Params::add_icon_params($shortcode, [
		'add_icon'  => true,
		'add_label' => esc_html__('Add email icon?', 'sterling'),
		'group'     => esc_html__('Icons', 'sterling'),
		'prefix'    => 'email_',
		'exclude'    => ['align'],
		'dependency' => ['template', ['sterling_layout2']]
	]);

	\Aheto\Params::add_icon_params($shortcode, [
		'add_icon'  => true,
		'add_label' => esc_html__('Add phone icon?', 'sterling'),
		'group'     => esc_html__('Icons', 'sterling'),
		'prefix'    => 'phone_',
		'exclude'    => ['align'],
		'dependency' => ['template', ['sterling_layout2']]
	]);

	\Aheto\Params::add_icon_params($shortcode, [
		'add_icon'  => true,
		'add_label' => esc_html__('Add time icon?', 'sterling'),
		'group'     => esc_html__('Icons', 'sterling'),
		'prefix'    => 'time_',
		'exclude'    => ['align'],
		'dependency' => ['template', ['sterling_layout2']]
	]);

	\Aheto\Params::add_icon_params($shortcode, [
		'add_icon'  => true,
		'add_label' => esc_html__('Add address icon?', 'sterling'),
		'group'     => esc_html__('Icons', 'sterling'),
		'prefix'    => 'address_',
		'exclude'    => ['align'],
		'dependency' => ['template', ['sterling_layout2']]
	]);
}

function sterling_contact_info_layout2_dynamic_css($css, $shortcode)
{
  if (!empty($shortcode->atts['sterling_use_info_typo']) && !empty($shortcode->atts['sterling_info_typo'])) {
    \aheto_add_props($css['global']['%1$s .widget_aheto__info-item'], $shortcode->parse_typography($shortcode->atts['sterling_info_typo']));
  }
  return $css;
}

add_filter('aheto_contact_info_dynamic_css', 'sterling_contact_info_layout2_dynamic_css', 10, 2);