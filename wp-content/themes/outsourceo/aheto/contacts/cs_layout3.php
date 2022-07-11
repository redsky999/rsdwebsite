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

$contacts = $this->parse_group( $cs_contacts_group );

if ( empty( $contacts ) ) {
	return '';
}

$cs_light_version = isset( $cs_light_version ) && $cs_light_version ? 'light-version' : '';


$this->generate_css();

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-contact' );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-contact--outsourceo-text' );
$this->add_render_attribute( 'wrapper', 'class', $cs_light_version );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );


/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/contacts/';
wp_enqueue_style( 'outsourceo-contacts-text', $sc_dir . 'assets/css/cs_layout3.css', null, null );

?>

<div <?php $this->render_attribute_string( 'wrapper' ); ?>>

	<?php foreach ( $contacts as $contact ) :
		$contact = wp_parse_args( $contact, [
			'cs_heading' => '',
			'cs_address' => '',
			'cs_phone'   => '',
			'cs_email'   => '',
		] );
		extract( $contact );

		?>
        <div class="aheto-contact__item">
			<?php if ( ! empty( $contact['cs_heading'] ) ) { ?>
                <b class="aheto-contact__title"><?php echo wp_kses( $contact['cs_heading'], 'post' ); ?></b>
			<?php } ?>

			<?php if ( ! empty( $contact['cs_address'] ) ) : ?>
                <p class="aheto-contact__info"><?php echo wp_kses( $contact['cs_address'], 'post' ); ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $contact['cs_email'] ) ) : ?>
                <a class="aheto-contact__link"
                   href="mailto:<?php echo esc_attr( $contact['cs_email'] ); ?>"><?php echo esc_html( $contact['cs_email'] ); ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $contact['cs_phone'] ) ) : ?>
                <a class="aheto-contact__link"
                   href="tel:<?php echo esc_attr( $contact['cs_phone'] ); ?>"><?php echo esc_html( $contact['cs_phone'] ); ?></a>
			<?php endif; ?>
        </div>
	<?php endforeach; ?>

</div>
