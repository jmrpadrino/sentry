<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Webcreek">
        <title>Sentry Wellhead Systems</title>
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-152x152.png" />
        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png" sizes="16x16" />
        <meta name="application-name" content="Sentry Wellhead System"/>
        <meta name="msapplication-TileColor" content="#FF3C00" />
        <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/images/mstile-144x144.png" />
        <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body id="top" <?php body_class(); ?>>
        <!-- header & navigation -->
        <header>
            <div id="navbar-container" class="navbar-items-container">
                <div id="search-frame-responsive" class="search-frame-responsive">
                    <form id="responsive-search-form" class="responsive-search-form" method="get" action="<?php echo home_url(); ?>">
                       <div class="responsive-inputs-frame">
                            <input id="resonsive-search_input" type="search" name="s" placeholder="Type in your search">
                            <input type="hidden" name="post_type[]" value="product">
                            <input type="hidden" name="post_type[]" value="service">
                            <button type="submit" class="search-button"><i class="zmdi zmdi-search"></i></button>
                        </div>
                    </form>
                </div>
                <nav class="navbar navba-default header-bar sentry-navbar">
                    <div class="container">
                        <div class="navbar-header">
                            <button id="nav-collaping" type="button" class="navbar-toggle collapsed c-hamburger c-hamburger--htx" data-toggle="collapse" data-target="#responsive-nav" aria-expanded="false">
                                <span>toggle menu</span>
                            </button>
                            <a class="navbar-brand sentry-brand" href="<?php echo home_url(); ?>" alt="Sentry Wellhead Systems"><img id="header-logo" class="header-logo"  src="<?php echo get_stylesheet_directory_uri(); ?>/images/sentry-wellhead-systems-logo.png" alt="Sentry Wellhead Systems"></a>
                        </div>
                        <ul class="search-icon pull-right hidden-xs hidden-sm hidden-md">
                            <li><span id="search-toggle"><i class="zmdi zmdi-search"></i></span></li>
                        </ul>
                        <?php 
                            wp_nav_menu( array(
                                'theme_location'    => 'main-nav',
                                'depth'             => 3,
                                'container'         => 'div',
                                'container_class'   => 'hidden-sm hidden-xs pull-right no-transition',
                                'container_id'      => 'desktop-navbar',
                                'menu_class'        => 'nav navbar-nav sentry-nav-list',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker())
                            );
                        ?>
                    </div><!-- /.container-fluid -->
                </nav>
                <div id="search-frame" class="search-holder hidden-sm hidden-xs hidden-md">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <form id="search" class="search-form" method="get" action="<?php echo home_url(); ?>">
                                    <div class="inputs-container">
                                        <input id="search_input" type="search" name="s" placeholder="Type in your search">
                                        <input type="hidden" name="post_type[]" value="product">
                                        <input type="hidden" name="post_type[]" value="service">
                                        <button type="submit" class="search-button"><i class="zmdi zmdi-search"></i></button>
                                        <div id="search-icon-box" class="icon-box">
                                            <span class="pull-right close-search-icon zmdi zmdi-close"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="hidden-md hidden-lg responsive-copyright">Copyright &copy; 2016 SentryWellhead Systems</p>
                </div>
                <div id="responsive-nav" class="responsive-nav hidden-md hidden-lg">
                    <?php 
                        wp_nav_menu( array(
                            'theme_location'    => 'main-nav',
                            'depth'             => 1,
                            'container'         => '',
                            'container_class'   => 'responsive-navbar-list navbar-collapse collapse',
                            'container_id'      => 'responsive-navbar-list',
                            'menu_class'        => 'responsive-nav-menu',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker())
                        );
                    ?>
                    <div id="search-button-nav-responsive" class="search-button-nav-responsive"><p><span class="fa fa-search"></span>&nbsp; SEARCH</p></div>
                    <p class="responsive-copyright">Copyright &copy; 2016 SentryWellhead Systems</p>
                </div>
            </div>
            <?php 
                if ( is_front_page() or is_home() ){
                    get_template_part('templates/hero-home');    
                }
            ?>
        </header><!-- END header & navigation -->