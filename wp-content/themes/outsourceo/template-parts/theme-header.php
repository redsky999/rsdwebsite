<div class="outsourceo-preloader"></div>

<div class="outsourceo-main-wrapper">
    <header class="outsourceo-header--wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- HEADER -->
                    <div class="outsourceo-header">

                        <!-- NAVIGATION -->
                        <nav id="topmenu" class="outsourceo-header--topmenu">

                            <div class="outsourceo-header--logo-wrap">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="outsourceo-header--logo">
                                    <span><?php echo get_option( 'blogname' ); ?></span>
                                </a>
                            </div>

                            <div class="outsourceo-header--menu-wrapper">
								<?php if ( has_nav_menu( 'primary-menu' ) ) {

									$args                   = array( 'container' => '' );
									$args['theme_location'] = 'primary-menu';
									wp_nav_menu( $args );

								} else {

									echo '<span class="no-menu primary-no-menu">' . esc_html__( 'Please register Top Navigation from', 'outsourceo' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'outsourceo' ) . '</a></span>';

								} ?>

                            </div>

                            <!-- SEARCH -->
                            <div class="outsourceo-header--search-wrap">
								<?php do_action( 'outsourceo_search' ); ?>
                            </div>

                            <!-- MOB MENU ICON -->
                            <div class="outsourceo-header--mob-nav">
                                <a href="#" class="outsourceo-header--mob-nav__hamburger">
                                    <span></span>
                                </a>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </header>

