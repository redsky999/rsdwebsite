<?php
/**
 * The List Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     UPQODE <info@upqode.com>
 */

use Aheto\Helper;

extract($atts);

$lists = $this->parse_group($aira_styled_lists);
if ( empty($lists) ) {
	return '';
}

$aira_light_theme = $aira_light_theme ? 'aheto-list__light_theme' : '';

$this->generate_css();

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', $aira_light_theme);
$this->add_render_attribute('wrapper', 'class', 'aheto-list--styled');


/**
 * Set dependent style
 */
$sc_dir = aheto()->plugin_url() . 'shortcodes/list/';
$custom_css    = Helper::get_settings( 'general.custom_css_including' );
$custom_css    = ( isset( $custom_css ) && ! empty( $custom_css ) ) ? $custom_css : false;
if ( (empty( $custom_css ) || ( $custom_css == "disabled" ) ) && !Helper::is_Elementor_Live()) {
    wp_enqueue_style('aira-styled-list', $sc_dir . 'assets/css/aira_layout2.css', null, null);
}
?>
<div <?php $this->render_attribute_string('wrapper'); ?>>

	<ul>
		<?php
        $styled_i = 1;
		foreach ( $lists as $item ) {
			echo '<li><span class="aheto-list__number">' . absint($styled_i) . '</span>' . esc_html($item['aira_list_item']) . '</li>';
            $styled_i++;
		}
		?>
	</ul>

</div>
