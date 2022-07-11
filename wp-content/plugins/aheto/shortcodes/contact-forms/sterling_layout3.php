<?php

/**
 * Contact Forms default templates.
 */

use Aheto\Helper;

extract($atts);

$this->generate_css();

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', 'widget_aheto__cf--sterling-3');
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('form', 'class', 'widget_aheto__form text-' . $button_align . ' count-' . $count_input);


/**
 * Set dependent style
 */
$sc_dir = aheto()->plugin_url() . 'shortcodes/contact-forms/';
$custom_css    = Helper::get_settings('general.custom_css_including');
$custom_css    = (isset($custom_css) && !empty($custom_css)) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
	wp_enqueue_style('sterling-contact-forms-layout3', $sc_dir . 'assets/css/sterling_layout3.css', null, null);
}
?>

<div <?php $this->render_attribute_string('wrapper'); ?>>
  <div <?php $this->render_attribute_string('form'); ?>>
    <?php if (!empty($contact_form)) : ?>
      <div class="<?php echo Helper::get_button($this, $atts, 'form_', true); ?>">
        <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($contact_form) . '"]'); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
