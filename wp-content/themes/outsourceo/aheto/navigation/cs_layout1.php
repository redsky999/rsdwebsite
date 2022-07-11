<?php
/**
 * Header Modern Menu.
 */
use Aheto\Helper;
extract( $atts );

if ( empty( $menus ) ) {
	return;
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'main-header' );
$this->add_render_attribute( 'wrapper', 'class', 'main-header--simple' );
$this->add_render_attribute( 'wrapper', 'class', 'main-header-js' );
$this->add_render_attribute( 'wrapper', 'class', $transparent );

$type_logo = isset($type_logo) && !empty($type_logo) ? $type_logo : 'image';

if ( $type_logo == 'image' && is_array( $scroll_logo ) && is_array( $scroll_mob_logo ) ) {

	$scroll_logo     = ! empty( $scroll_logo['id'] ) ? $scroll_logo : $logo;
	$scroll_mob_logo = ! empty( $scroll_mob_logo['id'] ) ? $scroll_mob_logo : $mob_logo;

} elseif ( $type_logo == 'image' && ! is_array( $scroll_logo ) && ! is_array( $scroll_mob_logo ) ) {

	$scroll_logo     = isset( $scroll_logo ) && ! empty( $scroll_logo ) ? $scroll_logo : $logo;
	$scroll_mob_logo = isset( $scroll_mob_logo ) && ! empty( $scroll_mob_logo ) ? $scroll_mob_logo : $mob_logo;

}

$button = $this->get_button_attributes( 'main' );
$add_button = $this->get_button_attributes( 'add' );

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/navigation/';
wp_enqueue_style( 'outsourceo-navigation-header-simple', $sc_dir . 'assets/css/cs_layout1.css', null, null );
wp_enqueue_script( 'outsourceo-navigation-header-simple-js', $sc_dir . 'assets/js/cs_layout1.min.js', array( 'jquery' ), null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>
	<div class="main-header__main-line">
        <div class="aheto-logo main-header__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( ! empty( $logo ) && $type_logo == 'image' ) {
					echo Helper::get_attachment( $logo, [ 'class' => 'aheto-logo__image' ] );
				}
				if ( ! empty( $scroll_logo ) && $type_logo == 'image' ) {
					echo Helper::get_attachment( $scroll_logo, [ 'class' => 'aheto-logo__image aheto-logo__image-scroll' ] );
				}

				if ( ! empty( $mob_logo ) && $type_logo == 'image' ) {
					echo Helper::get_attachment( $mob_logo, [ 'class' => 'aheto-logo__image mob-logo' ] );
				}

				if ( ! empty( $scroll_mob_logo ) && $type_logo == 'image' ) {
					echo Helper::get_attachment( $scroll_mob_logo, [ 'class' => 'aheto-logo__image mob-logo aheto-logo__image-mob-scroll' ] );
				}


				if ( ! empty( $text_logo ) && $type_logo == 'text' ) { ?>
                    <span><?php echo esc_html( $text_logo ); ?></span>
				<?php } ?>
            </a>
        </div>
		<div class="main-header__menu-box">
            <span class="main-header__menu-box-title"><?php esc_html_e('Menu', 'outsourceo'); ?></span>
			<?php
			wp_nav_menu([
				'container'       => 'nav',
				'container_class' => 'menu-home-page-container',
				'menu_class'      => 'main-menu main-menu--inline',
				'menu'            => $menus,
			]);
			?>

            <div class="main-header__widget-box-mobile">
				<?php if ( $cs_main_mob_add_button ) { ?>
					<?php echo Helper::get_button($this, $atts, 'cs_main_mob_'); ?>
				<?php }

				if ( $cs_add_mob_add_button ) { ?>
					<?php echo Helper::get_button($this, $atts, 'cs_add_mob_'); ?>
				<?php } ?>
            </div>


        </div>
		<div class="main-header__widget-box">

            <div class="main-header__widget-box-desktop">
	            <?php if ( $cs_main_add_button ) { ?>
		            <?php echo Helper::get_button($this, $atts, 'cs_main_'); ?>
	            <?php }

	            if ( $cs_add_add_button ) { ?>
		            <?php echo Helper::get_button($this, $atts, 'cs_add_'); ?>
	            <?php } ?>
            </div>

			<button class="hamburger main-header__hamburger js-toggle-mobile-menu" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
			</button>
		</div>
	</div>
</div>