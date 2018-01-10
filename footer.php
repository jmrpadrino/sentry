        <div class="bottom-navigation-area">
            <div class="container">
                <div class="row">
                    <?php 
                        wp_nav_menu( array(
                                'theme_location'    => 'footer-nav',
                                'depth'             => 1,
                                'container'         => '',
                                'container_class'   => '',
                                'container_id'      => '',
                                'menu_class'        => 'bottom-navigation hidden-xs',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker()
                            )
                        );
                    ?>
                    <a class="gototop-botton-nav hidden-sm hidden-md hidden-lg" href="#top">Back to top</a>
                </div>
            </div>
        </div>
        <!-- footer area -->
        <footer>
            <div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <img class="footer-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/sentry-wellhead-systems-logo-footer.png" alt="Sentry Wellhead Systems - Logo">
                        </div>
                        <div class="col-md-5 col-sm-9 text-right">
                            <h3 class="footer-title">Corporate Office</h3>
                            <div class="adress">
                                <a class="home-adress-link" href="https://www.google.com.ec/maps/place/1610+Woodstead+Ct+%23100,+Spring,+TX+77380,+EE.+UU./@30.1554244,-95.4630416,17z/data=!3m1!4b1!4m5!3m4!1s0x864736bea1021d0f:0xb4c5b084acb16af6!8m2!3d30.1554244!4d-95.4608529?hl=es" target="_blank">
                                <p>1610 Woodstead Court, Suite 100</p>
                                <p>The Woodlands, TX 77380</p>
                                <p>United States</p>
                                </a>
                                <p><a class="home-adress-link" href="tel:+1.281.210.0070">1-281-210-0070</a></p>
                            </div>
                        </div>
                        <!--
                        <div class="col-md-2 col-sm-3 text-center">
                            <h3 class="footer-title">Follow Us</h3>
                            <?php 
                                $contact_page = get_page_by_path('contact');
                                $prefix = 'sentry';
                            ?>
                            <ul class="socialmedia-icons">
                                <li>
                                    <a href="<?php echo get_post_meta( $contact_page->ID, $prefix . 'gp', true); ?>" alt="Sentry Wellhead Systems Google Plus Profile" title="Go To Sentry Wellhead Systems Google Plus Profile"><i class="zmdi zmdi-google-plus"></i></a>
                                </li><li>
                                    <a href="<?php echo get_post_meta( $contact_page->ID, $prefix . 'fb', true); ?>" alt="Sentry Wellhead Systems LinkedIn Profile" title="Go To Sentry Wellhead Systems Linkedin Profile"><i class="zmdi zmdi-linkedin"></i></a>
                                </li><li>
                                    <a href="<?php echo get_post_meta( $contact_page->ID, $prefix . 'tw', true); ?>" alt="Sentry Wellhead Systems Twitter Profile" title="Go To Sentry Wellhead Systems Twitter Profile"><i class="zmdi zmdi-twitter"></i></a>
                                </li>
                            </ul>
                        </div>
                        -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="footer-line" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="copyright-area">
                            <div class="col-sm-12">
                                <p class="copy-text text-center">Copyright &copy; 2017 Sentry Wellhead Systems</p>
                            </div>
                            <!--
                            <div class="col-sm-6">
                                <p class="dev-team">
                                    <?php 
                                        wp_nav_menu( array(
                                                'theme_location'    => 'bottom-nav',
                                                'depth'             => 1,
                                                'container'         => 'div',
                                                'container_class'   => 'dev-team',
                                                'container_id'      => 'footer-navigation',
                                                'menu_class'        => 'footer-navigation',
                                            )
                                        );
                                    ?>
                                </p>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- END footer area -->
        <!-- Scripts -->
<?php wp_footer(); ?>
    </body>
</html>