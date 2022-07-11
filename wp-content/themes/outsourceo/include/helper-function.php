<?php

/**
 * Create custom html structure for comments
 */
if ( !function_exists('outsourceo_comment') ) {
	function outsourceo_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback': ?>
				<div class="pinback">
					<span class="pin-title"><?php esc_html_e('Pingback: ', 'outsourceo'); ?></span><?php comment_author_link(); ?>
					<?php edit_comment_link(esc_html__('(Edit)', 'outsourceo'), '<span class="edit-link">', '</span>'); ?>

				<?php
				break;
			default:
				// generate comments
				?>
			<div <?php comment_class('outsourceo-blog--single__comments-item'); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>" class="outsourceo-blog--single__comments-item-wrap">
					<div class="outsourceo-blog--single__comments-content">
                        <span class="person-img">
							<?php echo get_avatar($comment, '80', '', '', array('class' => 'img-person')); ?>
                        </span>
						<div class="comment-content">
							<div class="author-wrap">
								<div class="author">
									<?php comment_author(); ?>
								</div>
								<?php comment_reply_link(
									array_merge($args,
										array(
											'reply_text' => esc_html__('Reply', 'outsourceo'),
											'after'      => '',
											'depth'      => $depth,
											'max_depth'  => $args['max_depth']
										)
									)
								); ?>
							</div>

							<div class="comment-text">
								<?php comment_text(); ?>
							</div>

                            <div class="comment-date">
								<?php comment_date(get_option('date_format')); ?>
                            </div>
						</div>
					</div>
				</div>
				<?php
				break;
		endswitch;
	}
}


/**
 * Filter for excerpt more string
 */

if ( !function_exists('outsourceo_excerpt_more') ) {
	function outsourceo_excerpt_more() {
		return ' ...';
	}

	add_filter('excerpt_more', 'outsourceo_excerpt_more');
}


/**
 * Header template
 */

if ( ! function_exists( 'outsourceo_main_header_html' ) ) {
	function outsourceo_main_header_html() {

		$active_plugin = function_exists( 'aheto' ) ? true : false;
		$template_name = $active_plugin ? 'aheto' : 'theme';

		get_template_part( 'template-parts/' . $template_name . '-header' );

	}
}

add_action( 'outsourceo_main_header', 'outsourceo_main_header_html' );



/**
 * Footer template
 */

if ( ! function_exists( 'outsourceo_main_footer_html' ) ) {
	function outsourceo_main_footer_html() {

		$active_plugin = function_exists( 'aheto' ) ? true : false;
		$template_name = $active_plugin ? 'aheto' : 'theme';

		get_template_part( 'template-parts/' . $template_name . '-footer' );

	}
}


add_action( 'outsourceo_main_footer', 'outsourceo_main_footer_html' );