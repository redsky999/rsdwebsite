<?php


use Aheto\Helper;

add_action('aheto_before_aheto_contact-forms_register', 'pointe_contact_forms_layout1');

/**
 * Contact forms
 */

function pointe_contact_forms_layout1($shortcode)
{

	$preview_dir = '//assets.aheto.co/contact-forms/previews/';

	$shortcode->add_layout('pointe_layout1', [
        'title' => esc_html__('Pointe form center', 'pointe'),
        'image' => $preview_dir . 'pointe_layout1.jpg',
    ]);



    $shortcode->add_dependecy('pointe_use_text_typo', 'template', 'pointe_layout1');
    $shortcode->add_dependecy('pointe_text_typo', 'template', 'pointe_layout1');
    $shortcode->add_dependecy('pointe_text_typo', 'pointe_use_text_typo', 'true');

    $shortcode->add_dependecy('pointe_form_theme', 'template', 'pointe_layout1');

	$shortcode->add_params([
		
		'pointe_use_text_typo' => [
            'type'    => 'switch',
            'heading' => esc_html__('Use custom font for Text?', 'pointe'),
            'grid'    => 2,
        ],

        'pointe_text_typo' => [
            'type'     => 'typography',
            'group'    => 'Pointe text Typography',
            'settings' => [
                'tag'        => false,
                'text_align' => false,
            ],
            'selector' => '{{WRAPPER}} p input:not([type=submit]), {{WRAPPER}} .wpcf7 textarea',
		],

		'pointe_form_theme'         => [
            'type'    => 'select',
            'heading' => esc_html__('Form theme', 'pointe'),
            'options' => [
                ''            => esc_html__('Light', 'pointe'),
                'form-dark' => esc_html__('Dark', 'pointe'),
            ],
        ],

	]);
}

function pointe_contact_forms_layout1_dynamic_css( $css, $shortcode ) {

	if (!empty($shortcode->atts['pointe_use_text_typo']) && !empty($shortcode->atts['pointe_text_typo'])) {
        \aheto_add_props($css['global']['%1$s p input:not([type=submit]), %1$s .wpcf7 textarea'], $shortcode->parse_typography($shortcode->atts['pointe_text_typo']));
    }
	
	return $css;
}

add_filter( 'aheto_contact_forms_dynamic_css', 'pointe_contact_forms_layout1_dynamic_css', 10, 2 );

function pointe_contact_forms_layout1_button($form_button)
{

	$form_button['dependency'][1][] = 'pointe_layout1';

	return $form_button;
}

add_filter('aheto_button_contact-forms', 'pointe_contact_forms_layout1_button', 10, 2);
