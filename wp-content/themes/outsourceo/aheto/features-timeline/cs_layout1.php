<?php
/**
 * The Features Timeline Shortcode.
 *
 * @since      1.0.0
 * @package    Aheto
 * @subpackage Aheto\Shortcodes
 * @author     Upqode <info@upqode.com>
 */

use Aheto\Helper;

extract( $atts );

$cs_timeline = $this->parse_group( $cs_timeline );
if ( empty( $cs_timeline ) ) {
	return '';
}


$this->generate_css();

$cs_dark_version = isset($cs_dark_version) && $cs_dark_version ? 'dark-version' : '';

// Wrapper.
$this->add_render_attribute( 'wrapper', 'id', $element_id );
$this->add_render_attribute( 'wrapper', 'class', 'aheto-timeline--outsourceo-modern' );
$this->add_render_attribute( 'wrapper', 'class', $cs_dark_version );
$this->add_render_attribute( 'wrapper', 'class', $this->the_custom_classes() );



/**
 * Set dependent style
 */
$sc_dir = OUTSOURCEO_T_URI . '/aheto/features-timeline/';
wp_enqueue_style( 'outsourceo-features-timeline', $sc_dir . 'assets/css/cs_layout1.css', null, null );
wp_enqueue_script( 'outsourceo-features-timeline-js', $sc_dir . 'assets/js/cs_layout1.min.js', array( 'jquery' ), null );

?>
<div <?php $this->render_attribute_string( 'wrapper' ); ?>>


    <section class="aheto-timeline--outsourceo-modern">
        <div class="aheto-timeline__timeline">
            <div class="aheto-timeline__events-wrapper">
                <div class="aheto-timeline__events">
                    <ol>
						<?php

						$counter = 1;

						foreach ( $cs_timeline as $item ) :
							$item = wp_parse_args( $item, [
								'cs_timeline_date' => '',
							] );
							extract( $item );

							if ( $counter === 1 ) { ?>
                                <li><a href="#0" class="selected"
                                       data-date="<?php echo esc_attr( $cs_timeline_date ); ?>"><h5><?php echo esc_html( $cs_timeline_date ); ?></h5></a>
                                </li>
							<?php } else { ?>
                                <li><a href="#0"
                                       data-date="<?php echo esc_attr( $cs_timeline_date ); ?>"><h5><?php echo esc_html( $cs_timeline_date ); ?></h5></a>
                                </li>
							<?php } ?>


							<?php $counter ++;

						endforeach; ?>

                    </ol>

                    <span class="aheto-timeline__filling-line" aria-hidden="true"></span>
                </div> <!-- .events -->
            </div> <!-- .events-wrapper -->

            <ul class="aheto-timeline__navigation">
                <li><a href="#0" class="prev inactive ion-android-arrow-dropleft"></a></li>
                <li><a href="#0" class="next ion-android-arrow-dropright"></a></li>
            </ul> <!-- .cd-timeline-navigation -->
        </div> <!-- .timeline -->

        <div class="aheto-timeline__events-content">
            <ol>
				<?php

				$counter = 1;

				foreach ( $cs_timeline as $item ) :
					$item = wp_parse_args( $item, [
						'cs_timeline_date'    => '',
						'cs_timeline_image'   => '',
						'cs_timeline_title'   => '',
						'cs_timeline_content' => '',
						'cs_add_button'       => '',
						'cs_use_dot'       => '',
						'cs_dot_color'       => '',
					] );
					extract( $item );

					if ( $counter === 1 ) { ?>
                        <li class="selected" data-date="<?php echo esc_attr( $cs_timeline_date ); ?>">
					<?php } else { ?>
                        <li data-date="<?php echo esc_attr( $cs_timeline_date ); ?>">
					<?php } ?>

                    <div class="aheto-timeline__wrap">

                        <div class="aheto-timeline__image-wrap">
							<?php if ( ! empty( $cs_timeline_image ) ) { ?>
								<?php echo Helper::get_attachment( $cs_timeline_image, [ 'class' => 'aheto-timeline-slider__add-image' ], $cs_image_size, $atts, 'cs_' ); ?>
							<?php } ?>
                        </div>

                        <div class="aheto-timeline__content">
							<?php if ( ! empty( $cs_timeline_title ) ) {
								$cs_timeline_title = str_replace( ']]', '</span>', $cs_timeline_title );
								$cs_timeline_title = str_replace( '[[', '<span>', $cs_timeline_title ); ?>
                                <h3 class="aheto-timeline__title"><?php echo outsourceo_dot_string($cs_timeline_title, $cs_use_dot, $cs_dot_color); ?></h3>
							<?php }

							if ( ! empty( $cs_timeline_content ) ) { ?>
                                <p class="aheto-timeline__desc"><?php echo wp_kses($cs_timeline_content, 'post'); ?></p>
							<?php }

							if ( $cs_add_button ) { ?>
                                <div class="aheto-timeline-slider__links">
									<?php echo Helper::get_button( $this, $item, 'cs_' ); ?>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                    </li>
					<?php
					$counter ++;

				endforeach; ?>

            </ol>
        </div> <!-- .events-content -->
    </section>

</div>
