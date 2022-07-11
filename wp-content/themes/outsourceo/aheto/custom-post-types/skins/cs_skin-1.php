<?php
/**
 * Skin 1.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

$ID = get_the_ID();

$classes   = [];
$classes[] = 'aheto-cpt-article';
$classes[] = 'aheto-cpt-article--' . $atts['layout'];
$classes[] = $this->getAdditionalItemClasses($atts['layout'], false);
$classes[] = 'aheto-cpt-article--' . $atts['skin'];
$img_class = $atts['layout'] === 'slider' || $atts['layout'] === 'grid' ? 'js-bg' : '';

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/custom-post-types/';
wp_enqueue_style('outsourceo-skin-1', $sc_dir . 'assets/css/cs_skin-1.css', null, null);

$format = $this->get_post_format();
$tag           = isset( $atts['title_tag'] ) && ! empty( $atts['title_tag'] ) ? $atts['title_tag'] : 'h4';
?>

<article class="<?php echo esc_attr(implode(' ', $classes)); ?>">

	<div class="aheto-cpt-article__inner">

		<?php

		if ( !$atts['cs_img_off'] ) {
			$isHasThumb = $this->getImage($img_class, '', $atts['cpt_image_size'], true);
		}

		?>

		<div class="aheto-cpt-article__content">

			<div class="aheto-cpt-article__date">
                <i class="ion-clock"></i>
				<?php the_time(get_option('date_format')); esc_html_e(' in World', 'outsourceo');?>
			</div>
			<?php echo '<' . $tag . ' class="aheto-cpt-article__title">'; ?>
            <a href="<?php the_permalink(); ?>">
                <?php

				$title = get_the_title();

				echo outsourceo_dot_string( $title, $atts['cs_use_dot'], 'primary' ); ?>
            </a>
			<?php echo '</' . $tag . '>';
			$this->getExcerpt();
			?>

			<div class="aheto-cpt-article__author">

				<?php
				$author_id = get_the_author_meta('ID');

				echo get_avatar($author_id, 30); ?>
				<strong><?php echo esc_html__('by ', 'outsourceo') . esc_html(get_the_author()); ?></strong>
			</div>

		</div>

	</div>

</article>

