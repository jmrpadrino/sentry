<?php
    /* Webcreek Enhance themes Branding */
    function webcreek_signature(){
        echo '<span id="footer-thankyou">Developed by <a href="http://www.webcreek.com" target="_blank">Webcreek Technology Inc</a></span>';
    }
    add_filter('admin_footer_text', 'webcreek_signature');
    
    function webcreek_custom_login() {
        echo '<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">';
        echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/webcreek.css" />';
    }
    add_action('login_head', 'webcreek_custom_login');
    function webcreek_login_logo_url() {
        return get_bloginfo( 'url' );
    }
    add_filter( 'login_headerurl', 'webcreek_login_logo_url' );

    function webcreek_login_logo_url_title() {
        return get_bloginfo('name');
    }
    add_filter( 'login_headertitle', 'webcreek_login_logo_url_title' );

    /* Webcreek Support Page */
    function webcreek_support_page_content(){
        if ( is_admin() ){
            echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
            echo '<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">';
            echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/webcreek.css" />';
            echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
        }
        /* Html template */
?>
    <div class="webcreek-info-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <header>
                        <div class="webcreek-page-title">
                            <h1><?php echo bloginfo('name'); ?> - Website Support Information</h1>
                            <p>We offer website maintenance and management that is professional, inexpensive and takes care of all your web support needs. Whether you are a small business or a large organisation with multiple websites, our three approaches to website maintenance cover all bases.</p>
                        </div>
                    </header>
                </div>
            </div>
        </div>        
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <section>
                            <div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#overview" aria-controls="home" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list-alt"></i> <?php echo bloginfo('name'); ?> Theme</a></li>
                                    <li role="presentation"><a href="#plugins-list" aria-controls="profile" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-cog"></i> Required Plugins</a></li>
                                    <li role="presentation"><a href="#users-manual" aria-controls="profile" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-education"></i> Users Manual</a></li>
                                    <li role="presentation"><a href="#support" aria-controls="settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-wrench"></i> Webcreek Support</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="overview">
                                        <h2><i class="glyphicon glyphicon-list-alt"></i> Overview</h2>
                                        <p>Carrot cake gingerbread biscuit dragée chocolate cake bonbon powder donut chocolate. Cake halvah I love donut bear claw toffee. Donut tootsie roll topping chocolate bar caramels gingerbread powder pudding. Danish I love powder I love cake I love oat cake sweet gummies.</p>
                                        <p>Tart jelly I love cake marzipan macaroon lemon drops. Topping lemon drops croissant I love. Marzipan sugar plum fruitcake I love. I love bonbon chocolate fruitcake candy canes danish sweet roll croissant chupa chups.</p>
                                        <p>Cheesecake fruitcake donut jelly. Jelly halvah macaroon sweet roll I love fruitcake. Macaroon tootsie roll I love gummi bears I love chocolate bar dessert.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="plugins-list">
                                        <h2><i class="glyphicon glyphicon-cog"></i> Plugins List</h2>
                                        <ol>
                                            <li><a href="https://metabox.io/" target="_blank">Metabox.io</a></li>
                                            <li><a href="https://wordpress.org/plugins/wp-custom-taxonomy-image/" target="_blank">Category and Taxonomy Image</a></li>
                                            <li><a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank">WP Super Cache</a></li>
                                        </ol>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="users-manual">
                                        <h2><i class="glyphicon glyphicon-education"></i> Users Manual</h2>
                                        <p>Carrot cake gingerbread biscuit dragée chocolate cake bonbon powder donut chocolate. Cake halvah I love donut bear claw toffee. Donut tootsie roll topping chocolate bar caramels gingerbread powder pudding. Danish I love powder I love cake I love oat cake sweet gummies.</p>
                                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/KiS8rZBeIO0" frameborder="0" allowfullscreen></iframe>
                                        
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="support">
                                        <h2><i class="glyphicon glyphicon-wrench"></i> Webcreek Support</h2>
                                        <p>Carrot cake gingerbread biscuit dragée chocolate cake bonbon powder donut chocolate. Cake halvah I love donut bear claw toffee. Donut tootsie roll topping chocolate bar caramels gingerbread powder pudding. Danish I love powder I love cake I love oat cake sweet gummies.</p>
                                        <p>Tart jelly I love cake marzipan macaroon lemon drops. Topping lemon drops croissant I love. Marzipan sugar plum fruitcake I love. I love bonbon chocolate fruitcake candy canes danish sweet roll croissant chupa chups.</p>
                                        <p>Cheesecake fruitcake donut jelly. Jelly halvah macaroon sweet roll I love fruitcake. Macaroon tootsie roll I love gummi bears I love chocolate bar dessert.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <aside>
                            <img src="http://placehold.it/250x600?text=Ad%20image" class="img-responsive" style="margin: 0 auto;    ">
                        </aside>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>add footer content</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
<?php   
        /* END Html template */
    }
    function webcreek_support_page(){
        
        add_menu_page( 
            'Webcreek', 
            'Webcreek', 
            'manage_options', 
            'webcreek_support_info', 
            $function = 'webcreek_support_page_content', 
            $icon_url = get_template_directory_uri() . '/images/webcreek-nav-icon.png', 
            81 
        );   
    }
    add_action( 'admin_menu', 'webcreek_support_page' );
    function remove_shake() {
        remove_action('login_head', 'wp_shake_js', 12);
    }
    add_action('login_head', 'remove_shake');
    

    function back_to_site_text( $translated ) {

        if ( in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) )
            $translated = str_ireplace(  '← Back to %s', 'Head back to My Site',  $translated );
            return $translated;
    }
    add_filter('gettext', 'back_to_site_text');
?>