<?php

$footer_text = get_bloginfo( 'name' ) . ' ' . esc_html__( ' &copy;', 'outsourceo' ) . date( 'Y' );

?>

</div><!-- #content -->

<footer id="footer" class="outsourceo-footer">
	<div class="outsourceo-footer--copyright"><?php echo wp_kses($footer_text, 'post'); ?></div>
</footer>