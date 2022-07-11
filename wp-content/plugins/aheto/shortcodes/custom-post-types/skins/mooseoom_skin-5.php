<?php

use Aheto\Helper;

$ID = get_the_ID();


$classes   = [];
$classes[] = 'aheto-cpt-article';
$classes[] = 'aheto-cpt-article--' . $atts['layout'];
$classes[] = 'aheto-cpt-article--' . $atts['skin'];
$img_class = $atts['layout'] === 'slider' || $atts['layout'] === 'grid' ? 'js-bg' : '';

$terms_list = get_the_terms(get_the_ID(), $atts['terms']);

if(isset($terms_list) && !empty($terms_list)){
	foreach ( $terms_list as $term ) {
		$classes[] = 'filter-' . $term->slug;
	}
}

$tag = isset( $atts['title_tag'] ) && ! empty( $atts['title_tag'] ) ? $atts['title_tag'] : 'h4';

/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/custom-post-types/';
if (!Helper::is_Elementor_Live()) {
	wp_enqueue_style('mooseoom-skin-5', $shortcode_dir . 'assets/css/mooseoom_skin-5.css', null, null);
}
?>

<article class="<?php echo esc_attr(implode(' ', $classes)); ?>">

	<div class="aheto-cpt-article__inner">

		<?php $isHasThumb = $this->getImage( $img_class, '', $atts['image_size'], true ); ?>

		<div class="aheto-cpt-article__content">
			<?php echo '<' . $tag . ' class="aheto-cpt-article__title">'; ?>
				<a href="<?php the_permalink(); ?>"><?php

					$title = get_the_title();

					?>
				</a>
			<?php echo '</' . $tag . '>'; ?>

			<?php $this->getTerms( $atts['terms'], '', ', ' ); ?>
		</div>
	</div>

</article>


