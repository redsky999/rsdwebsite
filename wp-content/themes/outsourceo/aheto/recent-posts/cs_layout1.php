<?php
/**
 * Recent Posts default templates.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

extract($atts);

$this->generate_css();

// Wrapper.
$this->add_render_attribute('wrapper', 'id', $element_id);
$this->add_render_attribute('wrapper', 'class', 'widget widget_recent_posts--creative');
$this->add_render_attribute('wrapper', 'class', 'modern');
$this->add_render_attribute('wrapper', 'class', $this->the_custom_classes());


$underline        = isset($underline) && $underline ? 'underline' : '';
$hide_thumb_class = isset($hide_thumb) && $hide_thumb ? 'hide-thumb' : 'with-thumb';
$title_space      = isset($title_space) && $title_space ? 'smaller-space' : '';

$this->add_render_attribute('title', 'class', 'widget-title');
$this->add_render_attribute('title', 'class', $underline);
$this->add_render_attribute('title', 'class', $title_space);

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/recent-posts/';
wp_enqueue_style('outsourceo-recent-posts-creative', $sc_dir . 'assets/css/cs_layout1.css', null, null);


echo '<div ' . $this->get_render_attribute_string('wrapper') . '>';

if ( !empty($title) ) {
	echo '<h5 ' . $this->get_render_attribute_string('title') . '>' . wp_kses($title, 'post') . '</h5>';
}

// Posts Content.
$post_query = new WP_Query([
	'post_type'      => $post_type,
	'posts_per_page' => $limit,
]);
if ( $post_query->have_posts() ) {
	echo '<ul>';

	// Post Loop.
	while ( $post_query->have_posts() ) {
		$post_query->the_post(); ?>

		<li class="<?php echo esc_attr($hide_thumb_class); ?>">
			<?php if ( !$hide_thumb ) {
				$post_id = get_the_ID();
				$post_image = array();
				$post_image['id'] = get_post_thumbnail_id($post_id);
				$background_image = \Aheto\Helper::get_background_attachment($post_image, $cs_image_size, $atts, 'cs_'); ?>

				<div class="widget-img s-back-switch" <?php echo esc_attr($background_image); ?>></div>
			<?php } ?>
			<div class="widget-text">
				<a href="<?php the_permalink(); ?>" class="post-title"><h5><?php the_title(); ?></h5></a>
				<span class="post-date"><?php echo get_the_date('F d, Y'); ?></span>
			</div>
		</li>


		<?php

	}

	echo '</ul>';
	wp_reset_postdata();
}

echo '</div>';
