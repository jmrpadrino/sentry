<?php

/* Auxiliar scripts */
require_once('inc/wp_bootstrap_navwalker.php');
require_once('inc/class-tgm-plugin-activation.php');
//require_once('inc/recaptchalib.php');
require_once('inc/sentry_cpt.php');
require_once('inc/sentry_taxonomies.php');
require_once('inc/sentry_metaboxes.php');
require_once('inc/sentry_breadcrumbs.php');
require_once('inc/webcreek.php');

function send_previous_location(){
    session_start();
    $_SESSION['prev_page'] = filter_input(INPUT_POST, 'this_page_url');
    echo $_SESSION['prev_page'];
}
add_action('wp_ajax_send_previous_location', 'send_previous_location');
add_action('wp_ajax_nopriv_send_previous_location', 'send_previous_location');
function sentry_setup(){

    /* Theme translation */

    load_theme_textdomain( 'sentrywellheadsystem', get_template_directory() . '/languages' );

    /* Theme components */

    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    add_theme_support( 'post-thumbnails' );

    /* Enqueuing Styles and Sripts */

    function add_theme_scripts() {

        if (!is_admin())   
        {  
            wp_deregister_script('jquery');  

            // Load a copy of jQuery from the Google API CDN  
            // The last parameter set to TRUE states that it should be loaded  
            // in the footer.  
            wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', FALSE, '1.11.0', TRUE);  

            wp_enqueue_script('jquery');  
        }
        // Including Bootstrap, Owlcarousel and PrettyPhoto files
        wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all' );
        wp_enqueue_style( 'bootstrap_theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', array(), '3.3.7', 'all' );
        wp_enqueue_style( 'owlslider', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '2.2.0', null );
        wp_enqueue_style( 'owltheme', get_template_directory_uri() . '/css/owl.theme.min.css', array(), '2.2.0', null );
        wp_enqueue_style( 'owltransition', get_template_directory_uri() . '/css/owl.transitions.css', array(), '2.2.0', null );
        wp_enqueue_style( 'prettyPhotocss', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '3.1.6', null );
        wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array ( 'jquery' ), '3.3.7', true);
        wp_enqueue_script( 'owlsliderjs', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'sticky', get_stylesheet_directory_uri() . '/js/jquery.sticky.js', array('jquery'), null, true );

        // Including theme styles
        wp_enqueue_style( 'sentry_common', get_template_directory_uri() . '/css/sentry_common.css', array(), '1.1', 'all');
        wp_enqueue_style( 'sentry_fonts', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700,900', array(), '', 'all');
        wp_enqueue_style( 'style', get_stylesheet_uri() );
        wp_register_script( "sentry", get_template_directory_uri() .'/js/sentry.js', array('jquery') );
        wp_localize_script( 'sentry', 'sentryAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

        wp_enqueue_script( 'sentry', get_template_directory_uri() . '/js/sentry.js', array ( 'jquery' ), '1.1', true);


        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        if ( is_tax() or is_singular() ) {
            wp_enqueue_script( 'actual', get_stylesheet_directory_uri() . '/js/jquery.actual.min.js', array('jquery'), null, true );
        }
    }
    add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

    /* Theme Navigation */

    if (function_exists('register_nav_menus')) {
        register_nav_menus( array(
            'main-nav' => __( 'Main Navigation', 'sentrywellheadsystem' ),
            'footer-nav' => __( 'Footer Navigation', 'sentrywellheadsystem' ),
            'bottom-nav' => __( 'Bottom Navigaton', 'sentrywellheadsystem'),
        ) );
    };

    /* Create menu items */
    function add_items_to_menu($oldname, $oldtheme = false) {
        /* Create header and footer menus */
        $menus = array(
            'Main Navigation'  => array(
                'home' => 'Home',
                'about-us'  => 'About Us',
                'products' => 'Products',
                'services'  => 'Services', 
                'contact' => 'Contact'
            ), 
            'Footer Navigation' => array(
                'home' => 'Home',
                'about-us'  => 'About Us',
                'products' => 'Products',
                'services'  => 'Services',                    
                'contact' => 'Contact'
            ),
            'Bottom Navigaton' => array(
                'sitemap' => 'Sitemap', 
                'legal-notice' => 'Legal Notice', 
                'terms-conditions' => 'Terms & Conditions'
            )
        );
        foreach($menus as $menuname => $menuitems) {
            $menu_exists = wp_get_nav_menu_object($menuname);
            // If it doesn't exist, let's create it.
            if ( !$menu_exists) {
                $menu_id = wp_create_nav_menu($menuname);
                foreach($menuitems as $slug => $item) {
                    wp_update_nav_menu_item(
                        $menu_id, 0, array(
                            'menu-item-title'  => $item,
                            'menu-item-object'  => 'page',
                            'menu-item-object-id'  => get_page_by_path($slug)->ID,
                            'menu-item-type' => 'post_type',
                            'menu-item-status'  => 'publish'
                        )
                    );
                }
            }
        }
    }
    add_action('after_switch_theme', 'add_items_to_menu', 10 ,  2);

    /* Theme Sidebar(s) */

    register_sidebar( array(
        'name'          => __( 'Subscripcion del Footer', 'escape' ),
        'id'            => 'subscribe',
        'description'   => __( 'Aparece en la sección del footer del sitio.', 'escape' ),
        'before_widget' => '<aside id="%1$s" class="widget suscribe %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    /* IMPORTANT ISSUE */
    /* Theme page creation */
    function sentry_page_creation(){

        /* Please add the pages that worpress will create automaticaly as them are needed, write the title of the page as it will be plubished */
        $theme_pages = array(
            'Home',
            'About Us',
            'Products',
            'Services',
            'Contact',
            'Legal Notice',
            'Terms & Conditions',
            'Sitemap'
        );

        /* Verify if page exists for page creation*/
        foreach ( $theme_pages as $theme_page ){
            /* transform the page name to slug */
            //$page_title_transform = strtolower( str_replace(' ', '-', $theme_page) );

            /* get wordpress page */
            //$page = get_page_by_path( $page_title_transform );

            $page = get_page_by_title( $theme_page );

            if ( $page == NULL ){
                // Create the page   
                $page_to_be_created = array(
                    'post_title'    => $theme_page,
                    'post_content'  => '',
                    'post_status'   => 'publish',
                    'post_author'   => get_current_user_id(),
                    'post_type'     => 'page',
                );

                // Insert the post into the database
                wp_insert_post( $page_to_be_created, '' );
            }

        }
    }
    add_action( 'init', 'sentry_page_creation' );
    /*-------------------------*/

    // Remover opciones de actualizacion
    if ( !is_super_admin() ) {
        //add_action( 'admin_init', 'remove_menus' );
    }
    function remove_menus(){


        //remove_menu_page( 'index.php' );                  //Dashboard
        //remove_menu_page( 'post_new.php' );
        remove_menu_page( 'edit.php' );                   //Posts
        //remove_menu_page( 'upload.php' );                 //Media
        //remove_menu_page( 'edit.php?post_type=page' );    //Pages
        //remove_menu_page( 'edit-comments.php' );          //Comments
        //remove_menu_page( 'themes.php' );                 //Appearance
        //remove_menu_page( 'plugins.php' );                //Plugins
        //remove_menu_page( 'users.php' );                  //Users
        //remove_menu_page( 'tools.php' );                  //Tools
        //remove_menu_page( 'options-general.php' );        //Settings

    }
    add_action( 'admin_menu', 'remove_menus' );


    // Sentry register required plugins
    function sentrywellheadsystem_register_required_plugins() {

        $plugins = array(
            array(
                'name'      => 'Meta Box',
                'slug'      => 'meta-box',
                'required'  => true,
                'force_deactivation' => true,
                'is_automatic' => true
            ),
            array(
                'name'      => 'Category and Taxonomy Image',
                'slug'      => 'wp-custom-taxonomy-image',
                'required'  => true,
                'force_deactivation' => true,
                'is_automatic' => true
            ),
            array(
                'name'      => 'WP Super Cache',
                'slug'      => 'wp-super-cache',
                'required'  => false,
            )
        );

        $config = array(
            'id'           => 'sentrywellheadsystem',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );
        tgmpa( $plugins, $config );
    }
    add_action( 'tgmpa_register', 'sentrywellheadsystem_register_required_plugins' );

    function analitycs_support_page(){

        add_submenu_page(
            'tools.php',
            'Analytics Code Support',
            'Analytics Code Support',
            'manage_options',
            'analytics-code-support-page',
            'wpdocs_analytics_code_support_submenu_page_callback' );
        add_action( 'admin_init', 'theme_analytics_support_page' );


        if ( is_admin() ){
            echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
            echo '<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">';
            echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/webcreek.css" />';
            echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
        }

        function theme_analytics_support_page(){
            register_setting( 'analytics_support_page-settings-group', 'google_analytics_support' );
            register_setting( 'analytics_support_page-settings-group', 'bing_analytics_support' );
            register_setting( 'analytics_support_page-settings-group', 'yandex_analytics_support' );
        }

        function wpdocs_analytics_code_support_submenu_page_callback(){
?>
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Analytics Support Page</h1>
                <p>This page is for Web Analytics Scripts.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="options.php">
                    <?php 
                        settings_fields( 'analytics_support_page-settings-group' ); 
                        do_settings_sections( 'analytics_support_page-settings-group' );
                    ?>
                    <div class="col-md-12">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="googleanalytics">Google Analytics script</label>
                                <textarea rows="5" class="form-control" id="googleanalytics" placeholder="Google Analytics Script" name="google_analytics_support"><?php echo esc_attr( get_option('google_analytics_support') ); ?></textarea>
                                <p class="help-block">Without script tags.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="https://analytics.google.com/" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/Google_analytics_logo_wordpress_admin.png" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr />
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="binganalytics">Bing Meta tag content</label>
                                <input type="text" max="32" class="form-control" id="binganalytics" placeholder="Bing Analytics Script" name="bing_analytics_support" value="<?php echo esc_attr( get_option('bing_analytics_support') ); ?>">
                                <p class="help-block">This code is 32 characters long.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="www.bing.com/toolbox/webmaster" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/Bing_analytics_logo_wordpress_admin.png" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr />
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="binganalytics">Yandex Metrica Counter script</label>
                                <textarea rows="7" class="form-control" id="binganalytics" placeholder="Yandex Metrica Counter Script" name="yandex_analytics_support"><?php echo esc_attr( get_option('yandex_analytics_support') ); ?></textarea>
                                <p class="help-block">Without script tags.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="www.bing.com/toolbox/webmaster" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/yandex-logo.png" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php submit_button( 'Save changes', 'primary', 'save_analytics_scripts' ); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php       
        }
    }
    add_action( 'admin_menu', 'analitycs_support_page' );
    
    // get and add analytics to head tag
    function show_analytics_scripts(){
        
        $google_analytics_code = esc_attr( get_option('google_analytics_support') );
        $bing_analytics_code = esc_attr( get_option('bing_analytics_support') );
        $yandex_analytics_code = esc_attr( get_option('yandex_analytics_support') );
        
        if( !empty($google_analytics_code) ){
            if ( preg_match("/(GoogleAnalyticsObject)/", $google_analytics_code, $matches) ){
                //print_r($matches);
                echo '<script>';
                echo $google_analytics_code;
                echo '</script>';
            }
        }
        if( !empty($bing_analytics_code) ){
            if ( preg_match("/[a-zA-Z0-9]{32}/", $bing_analytics_code, $matches) ){
                echo '<meta name="msvalidate.01" content="'.$bing_analytics_code.'" />';
            }
        }
        if( !empty($yandex_analytics_code) ){
            if ( preg_match("/(accurateTrackBounce)/", $yandex_analytics_code, $matches) ){
                echo '<script>';
                echo $yandex_analytics_code;
                echo '</script>';
            }
        }
        
    }
    add_action( 'wp_head', 'show_analytics_scripts', 4 );


    // Sentry Color Scheme
    wp_admin_css_color(
        'sentry', __( 'Sentry Wellhead Systems', 'admin_schemes' ),
        get_template_directory_uri()."/style.css",
        array( '#ff3c00', '#ff9800', '#484848', '#2d2d2d' ),
        array( 'base' => '#ff3c00', 'focus' => '#ffa300', 'current' => '#efefef' )
    );
    add_filter('get_user_option_admin_color', 'change_admin_color');
    function change_admin_color($result) {
        return 'sentry';
    }

}
add_action( 'after_setup_theme', 'sentry_setup' );


/* Pagination Support */

function numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="zmdi zmdi-chevron-left"></i>') );

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="zmdi zmdi-chevron-right"></i>') );

    echo '</ul></div>' . "\n";

}

/* Product Categories */
function show_parent_categories( $taxonomy, $term_item ){
    $output = '';
    $count = 0;
    $active_term = get_term_by('slug', $term_item, $taxonomy);
    $categories = get_terms( array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'parent' => 0,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ) );
    $output .= '<ul class="main-categories-list">';
    foreach ($categories as $category){
        if ( $active_term->parent > 0 ){
            if( $active_term->parent == $category->term_id){
                $output .= '<li class="main-category-item active">';
            }else{
                $output .= '<li class="main-category-item">';
            }
        }else{
            if( $active_term->term_id == $category->term_id){
                $output .= '<li class="main-category-item active">';
            }else{
                $output .= '<li class="main-category-item">';
            }
        }
        $output .= '<a href="' . get_term_link( $category->term_id ) . '">';
        $output .= $category->name;
        $output .= '</a>';
        $output .= '</li>';
        $count++;
    }
    $output .= '</ul>';

    echo $output;
}

/* Send ajax mail */
function send_mail_via_ajax(){

    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $company = filter_input(INPUT_POST, 'company');
    $region = filter_input(INPUT_POST, 'region');
    $inquiry = filter_input(INPUT_POST, 'inquiry');

    // Google reCaptcha features
    $secret = "6LcxGBIUAAAAAFb8fviBHQGneE7KjP7XJLuUwDql";
    $response = null;

    $path = 'https://www.google.com/recaptcha/api/siteverify?';
    $path .= 'secret=' . $secret;
    $path .= '&remoteip=' . $_SERVER["REMOTE_ADDR"];
    $path .= '&v=php_1.0';
    $path .= '&response='. $_POST["g-recaptcha-response"];

    $response = file_get_contents( $path );

    $answers = json_decode($response, true);

    if ( $response != null && trim($answers ['success']) == true ) {

        ob_start();
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#cccccc" style="width: 100%;">
    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" style="margin-top:35px;margin-bottom:35px;font-family:Verdana !important;">
        <tr style="background-color: #232323;">
            <td align="center">
                <img src="http://sentry.choclomedia.com/wp-content/themes/sentry/images/sentry-wellhead-systems-logo-footer.png" width="280" style="margin-top:35px;margin-bottom:35px;">
            </td>
        </tr>
        <tr>
            <td style="color:#222222!important; padding: 30px;">
                <h1 style="text-align:center;font-size:36px;color:#ff3c00;text-transform:uppercase;font-weight:800;">Web Contact</h1>
                <h2 style="color:#ff3c00;text-transform:uppercase;font-weight:800;margin-top: 35px;">Contact Information</h2>
                <p><strong>Full Name:</strong> <?php echo $fname ?> <?php echo $lname ?></p>
                <p><strong>Phone:</strong> <a href="phone:<?php echo $phone ?>"><?php echo $phone ?></a></p>
                <p><strong>Email:</strong> <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></p>
                <p><strong>Company:</strong> <?php echo $company ?></p>
                <p><strong>Region:</strong> <?php echo $region ?></p>

                <h2 style="color:#ff3c00;text-transform:uppercase;font-weight:800;margin-top: 70px;">Inquiry</h2>
                <p style="font-size:20px;"><?php echo $inquiry ?></p>
            </td>
        </tr>
        <tr style="background-color: #FF3C00; color: #ffffff; margin-top: 35px;">
            <td align="center">
                <p style="margin-top:35px;margin-bottom:35px;">This mail was sent via Sentry Wellhead Systems Website, on <?php echo date("d/m/Y") ?> at <?php echo date("h:i") ?></p>
            </td>
        </tr>
    </table>
</table>
<?php
            $body = ob_get_clean();

        //$contacto = get_page_by_path('contact');
        //$mail_admin = get_post_meta($contacto->ID, 'em', true);
        //$to = 'colocar un solo email';
        $subject = 'New contact message - Sentry Wellhead Systems';
        $asunto = 'New contact message - Sentry Wellhead Systems';

        require_once ABSPATH . WPINC . '/class-phpmailer.php';

        $mail = new PHPMailer( true );

        //$mail->AddAddress($to);
        $mail->AddAddress('jrodriguez@webcreek.com', 'First Contact');
        $mail->AddAddress('ppazmino@webcreek.com', 'Second Contact');
        $mail->FromName = 'Sentry Wellhead Systems - Contact';
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->IsHTML();
        $mail->CharSet = 'utf-8';
        $mail->Send();
        echo trim($answers ['success']);
        /*try {
            $mail->AddAddress($to);
            $mail->FromName = 'Sentry Wellhead Systems - Contact';
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->IsHTML();
            $mail->CharSet = 'utf-8';
            $mail->Send();
            echo trim($answers ['success']);
        } catch (phpmailerException $e) {
          echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo trim($answers ['success']);
          echo $e->getMessage(); //Boring error messages from anything else!
        }*/
    }else{
        echo trim($answers ['success']);
    }
}
add_action('wp_ajax_send_mail_via_ajax', 'send_mail_via_ajax');
add_action('wp_ajax_nopriv_send_mail_via_ajax', 'send_mail_via_ajax');

/*
    * category image
    * category features
*/

?>