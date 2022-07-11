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

$terms_list = get_the_terms(get_the_ID(), $atts['terms']);
foreach ( $terms_list as $term ) {
	$classes[] = 'filter-' . $term->slug;
}

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/custom-post-types/';
wp_enqueue_style('outsourceo-skin-2', $sc_dir . 'assets/css/cs_skin-2.css', null, null);


?>

<article class="<?php echo esc_attr(implode(' ', $classes)) ?>">

	<div class="aheto-cpt-article__inner">

		<?php if ( has_post_thumbnail() ) {
			$isHasThumb = $this->getImage( $img_class, '', $atts['cpt_image_size'], true );
		?>
		<div class="aheto-cpt-article__content">
			<?php
			$this->getTerms($atts['terms'], '', ', ');
			$this->getTitle();
			?>
		</div>

		<?php } ?>

	</div>

</article>


