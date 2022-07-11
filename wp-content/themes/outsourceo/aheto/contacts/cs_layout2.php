<?php
/**
 * The Contacts Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract( $atts );

$contacts = $this->parse_group($outsourceo_contacts_group);

if ( empty($contacts) ) {
    return '';
}

$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-contact' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-contact--outsourceo-classic' );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );

/**
 * Set carousel params
 */
$carousel_default_params = [
    'speed' => 1000,
    'arrows' => true
]; // will use when not chosen option 'Change slider params'

$carousel_params = Helper::get_carousel_params($atts, 'cs_contacts_', $carousel_default_params);

/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/contacts/';
wp_enqueue_style('outsourceo-contacts-classic', $sc_dir . 'assets/css/cs_layout2.css', null, null);

?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

    <div class="swiper">
        <div class="swiper-container" <?php echo esc_attr($carousel_params); ?>>
            <div class="swiper-wrapper">
                <?php foreach ( $contacts  as $contact ) :
                    $contact = wp_parse_args($contact, [
                        'cs_heading_tag'         => '',
                        'cs_heading'         => '',
                        'cs_address'         => '',
                        'cs_phone'         => '',
                        'cs_email'          => '',
                    ]);
                    extract($contact);

                    ?>
                    <div class="swiper-slide">
                        <?php if ( !empty($contact['cs_heading']) ) :
                            echo '<' . $contact['cs_heading_tag'] . ' class="aheto-contact__title">' . wp_kses( $contact['cs_heading'], 'post' ) . '</' . $contact['cs_heading_tag'] . '>';
                        endif; ?>

                        <?php if ( !empty($contact['cs_address']) ) : ?>
                            <div class="aheto-contact__info">
                                <i class="widget_aheto__icon el icon_pin_alt "></i>
                                <p class="aheto-contact__info"><?php echo wp_kses( $contact['cs_address'], 'post' ); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ( !empty($contact['cs_email']) ) :
                            ?>
                            <div class="aheto-contact__info">
                                <i class="widget_aheto__icon el icon_mail_alt "></i>
                                <a class="aheto-contact__link" href="mailto:<?php echo esc_attr( $contact['cs_email'] ); ?>"><?php echo esc_html( $contact['cs_email']); ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if ( !empty($contact['cs_phone'])) : ?>
                            <div class="aheto-contact__info">
                                <i class="widget_aheto__icon el icon_phone "></i>
                                <a class="aheto-contact__link" href="tel:<?php echo esc_attr( $contact['cs_phone'] ); ?>"><?php echo esc_html( $contact['cs_phone'] ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $this->swiper_pagination('cs_contacts_'); ?>
        </div>
        <?php $this->swiper_arrow('cs_contacts_'); ?>
    </div>



</div>
