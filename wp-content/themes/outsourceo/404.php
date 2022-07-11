<?php
/**
 * 404 Page
 */

get_header(); ?>

    <div class="outsourceo-error--wrap">

        <div class="outsourceo-error--big-title"><?php esc_html_e( 'OOPS!', 'outsourceo' ); ?></div>

        <div class="outsourceo-error--small-title"><?php esc_html_e( '404', 'outsourceo' ); ?></div>

        <h1 class="outsourceo-error--title"><?php esc_html_e( 'Page not found', 'outsourceo' ); ?></h1>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="outsourceo-error--button"><?php esc_html_e( 'Go home', 'outsourceo' ); ?></a>

    </div>

<?php get_footer();
