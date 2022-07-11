<?php
/**
 * The Blockquote Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

extract($atts);
use Aheto\Helper;
if (empty($quote)) {
    return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('blockqoute', 'class', 'aheto-quote--rela-simple');
$this->add_render_attribute('blockqoute', 'class', $align);

/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/blockquote/';
$custom_css    = Helper::get_settings( 'general.custom_css_including' );
$custom_css    = ( isset( $custom_css ) && ! empty( $custom_css ) ) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
    wp_enqueue_style('rela-blockquote-layout1', $shortcode_dir . 'assets/css/rela_layout1.css', null, null);
}

if (isset($icon_position) && !empty($icon_position)) {
    $this->add_render_attribute('blockqoute', 'class', $icon_position);
    $this->add_render_attribute('blockqoute', 'class', $icon_size);
}
?>
<div <?php $this->render_attribute_string('wrapper'); ?>>
    <blockquote <?php $this->render_attribute_string('blockqoute'); ?>>

        <?php
        // Cite.
        if (!empty($author)) {
            echo '<h4 class="aheto-quote__author">' . wp_kses($author, 'post') . '</h4>';
        }
        // Qoute.
        $qoute_tag = isset($qoute_tag) && !empty($qoute_tag) ? $qoute_tag : 'h1';
        echo '<' . $qoute_tag . '>' . wp_kses($quote, 'post') . '</' . $qoute_tag . '>';

        // Author.
        if (!empty($rela_date)) {
            echo '<p class="aheto-quote__date">' . wp_kses($rela_date, 'post') . '</p>';
        }
        ?>

    </blockquote>
</div>
