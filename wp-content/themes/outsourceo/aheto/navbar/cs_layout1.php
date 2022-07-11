<?php
/**
 * Time Schedule default templates.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract( $atts );

$cs_navbar_links  = $this->parse_group( $cs_navbar_links );


$cs_center_hide_mobile = isset( $right_hide_mobile ) && ! empty( $right_hide_mobile ) ? 'hide-mobile' : '';
$cs_dark_style = isset( $cs_dark_style ) && ! empty( $cs_dark_style ) ? 'dark-style' : '';

if ( empty( $cs_navbar_links ) ) {
	return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-navbar aheto-navbar--outsourceo-simple' );
$this->add_render_attribute( 'wrapper', 'class', $columns . '-columns' );
$this->add_render_attribute( 'wrapper', 'class', $cs_dark_style );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/navbar/';
wp_enqueue_style('outsourceo-navbar-simple', $sc_dir . 'assets/css/cs_layout1.css', null, null);


?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="aheto-navbar--inner">

					<?php if ( ! empty( $cs_navbar_links ) ) { ?>
                        <div class="aheto-navbar--<?php echo esc_attr($cs_align); ?> <?php echo esc_attr( $cs_center_hide_mobile ); ?>">

							<?php foreach ( $cs_navbar_links as $index => $link ) : ?>

                                <div class="aheto-navbar--item">

									<?php if ( ! empty( $link['cs_label'] ) && ( $link['cs_type_link'] == 'text' ) ) : ?>
                                        <span class="aheto-navbar--item-label"><?php echo esc_html( $link['cs_label'] ); ?></span>
									<?php endif; ?>


									<?php if ( ( ! empty( $link['cs_label'] ) || $link['cs_add_icon'] ) && ( $link['cs_type_link'] == 'phone' || $link['cs_type_link'] == 'email' ) ) : ?>
                                        <span class="aheto-navbar--item-label">

                                             <?php if ( $link['cs_type_link'] == 'phone' && $link['cs_add_icon'] ) : ?>
                                                 <i class="ion-ios-telephone<?php echo esc_attr( $link['cs_type_icon'] ); ?>"></i>
                                             <?php endif; ?>

											<?php if ( $link['cs_type_link'] == 'email' && $link['cs_add_icon'] ) : ?>
                                                <i class="ion-ios-email<?php echo esc_attr( $link['cs_type_icon'] ); ?>"></i>
											<?php endif; ?>

											<?php if ( ! empty( $link['cs_label'] ) ) {
												echo esc_html( $link['cs_label'] );
											} ?>
                                        </span>
									<?php endif; ?>

									<?php if ( ! empty( $link['cs_phone'] ) && $link['cs_type_link'] == 'phone' ) : ?>
                                        <a href="tel:<?php echo esc_attr( str_replace(' ','', $link['cs_phone'])); ?>"
                                           class="aheto-navbar--item-link phone"><?php echo esc_html( $link['cs_phone'] ); ?></a>
									<?php endif; ?>

									<?php if ( ! empty( $link['cs_email'] ) && $link['cs_type_link'] == 'email' ) : ?>
                                        <a href="mailto:<?php echo esc_attr( $link['cs_email'] ); ?>"
                                           class="aheto-navbar--item-link email"><?php echo esc_html( $link['cs_email'] ); ?></a>
									<?php endif; ?>

									<?php if ( ! empty( $link['cs_custom_link'] ) && ! empty( $link['cs_label'] ) && $link['cs_type_link'] == 'custom' ) : ?>
                                        <a href="<?php echo esc_url( $link['cs_custom_link'] ); ?>"
                                           class="aheto-navbar--item-link"><?php echo esc_html( $link['cs_label'] ); ?></a>
									<?php endif; ?>
                                    <?php if ( $link['cs_type_link'] == 'searchbox' ) : ?>
                                        <a class="icons-widget__link search-btn js-open-search" href="#">
                                            <i class="icon ion-ios-search-strong" aria-hidden="true"></i>
                                        </a>
									<?php endif; ?>
                                    <?php if ( $link['cs_type_link'] == 'languague' && defined( 'ICL_SITEPRESS_VERSION' ) ) :
                                    
                                        $active = '';
                                        $submenu = '';
                                        foreach ( icl_get_languages( 'skip_missing=0' ) as $language_key => $args ) {
                                            if ( $args['active'] ) {
                                                $active .= sprintf( '<a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle js-lang"><img class="wpml-ls-flag" src="%1$s" alt="%2$s" title="%3$s"><span class="wpml-ls-native"><i class="icon ion-android-arrow-dropdown"></i></span></a>',
                                                    $args['country_flag_url'],
                                                    $args['language_code'],
                                                    $args['translated_name']
                                                );
                                                continue;
                                
                                            }
                                            elseif( $args['active'] ){
                                
                                                $active .= sprintf( '<a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle js-lang"><img class="wpml-ls-flag" src="%1$s" alt="%2$s" title="%3$s"><span class="wpml-ls-native"><i class="icon ion-android-arrow-dropdown"></i></span></a>',
                                                    $args['country_flag_url'],
                                                    $args['language_code'],
                                                    $args['translated_name']
                                                );
                                                continue;
                                            }
                                
                                
                                            $submenu .= sprintf(
                                                '<li class="wpml-ls-slot-sidebar-1 wpml-ls-item wpml-ls-item-de">
                                                <a href="%1$s">
                                                    <img class="wpml-ls-flag" src="%2$s" alt="%3$s" title="%4$s">
                                                    <span class="wpml-ls-native"></span>
                                                </a>
                                            </li>',
                                                $args['url'],
                                                $args['country_flag_url'],
                                                $args['language_code'],
                                                $args['translated_name']
                                            );
                                
                                        }
                                
                                        $html  = '<div class="wpml-ls-sidebars-sidebar-1 wpml-ls wpml-ls-legacy-dropdown js-wpml-ls-legacy-dropdown"><ul class="multi-lang">';
                                        $html .= '<li tabindex="0" class="wpml-ls-slot-sidebar-1 wpml-ls-item wpml-ls-item-en wpml-ls-current-language wpml-ls-first-item wpml-ls-item-legacy-dropdown">';
                                        $html .= $active;
                                        if ( ! empty( $submenu ) ) {
                                            $html .= '<ul class="wpml-ls-sub-menu js-lang-list">';
                                            $html .= $submenu;
                                            $html .= '</ul>';
                                        }
                                        $html .= '</li></ul></div>';
                                
                                        echo wp_kses($html, 'post');

                                        endif; ?>
                                </div>

							<?php endforeach; ?>


                        </div>
					<?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

