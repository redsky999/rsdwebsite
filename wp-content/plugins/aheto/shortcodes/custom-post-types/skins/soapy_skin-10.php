<?php
/**
 * Skin 1.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

$ID = get_the_ID();


$soapy_terms = [];
$classes     = [];
$classes[]   = 'aheto-cpt-article';
$classes[]   = 'aheto-cpt-article--' . $atts['layout'];
$classes[]   = $this->getAdditionalItemClasses($atts['layout'], false);
$classes[]   = 'aheto-cpt-article--' . $atts['skin'];
$img_class   = $atts['layout'] === 'slider' || $atts['layout'] === 'grid' ? 'js-bg' : '';

$terms_list = get_the_terms(get_the_ID(), $atts['terms']);
if ( $atts['layout'] !== 'slider' ) {
	if ( $terms_list ) {
		foreach ( $terms_list as $term ) {
			$classes[]     = 'filter-' . $term->slug;
			$soapy_terms[] = $term->name;
		}
	}
}


/**
 * Set dependent style
 */
$shortcode_dir = aheto()->plugin_url() . 'shortcodes/custom-post-types/';
if (!Helper::is_Elementor_Live()) {
	wp_enqueue_style('soapy-skin-10', $shortcode_dir . 'assets/css/soapy_skin-10.css', null, null);
}

$format = $this->get_post_format();
$remove_link = ($atts['soapy_remove_arrow'] == true) ? 'aheto-cpt-article__remove-arrow' : '';
?>

<article class="<?php echo esc_attr(implode(' ', $classes)); ?>">

	<div class="aheto-cpt-article__inner">

		<?php
		if ( has_post_thumbnail($ID) ) {
			$isHasThumb = $this->getImage($img_class, '', $atts['cpt_image_size'], true, true, $atts, 'cpt_');
		}
		?>

		<h4 class="aheto-cpt-article__date">
			<?php echo get_the_date('F jS Y') ?>
		</h4>
		<div class="aheto-cpt-article__content">
			<?php $this->getTitle();
			$this->getExcerpt(); ?>
			<div class="aheto-cpt-article__links">
				<a href="<?php echo esc_url(get_permalink()); ?>" class="<?php echo esc_attr($remove_link);?>"><?php esc_html_e('Read More', 'soapy'); ?></a>
			</div>
		</div>
	</div>
</article>

