<?php
/**
 * The List Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

extract($atts);

$lists = $this->parse_group($cs_lists);
if ( empty($lists) ) {
	return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());
$this->add_render_attribute('wrapper', 'class', 'aheto-list');
$this->add_render_attribute('wrapper', 'class', 'aheto-list--outsourceo-links');


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/list/';
wp_enqueue_style( 'outsourceo-link-list', $sc_dir . 'assets/css/cs_layout2.css', null, null );

?>
<div <?php $this->render_attribute_string('wrapper'); ?>>

	<ul>
		<?php

		foreach ( $lists as $item ) {

			$item_link = $this->get_link_attributes( $item['cs_link_url'] );

			echo '<li><i class="ion-android-arrow-dropright"></i><a href="'. esc_url($item_link['href']) .'">' . wp_kses($item['cs_link_text'], 'post') . '</a></li>';

		} ?>
	</ul>

</div>
