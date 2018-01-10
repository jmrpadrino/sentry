<?php
    ////////////////////////////////////////
    // METABOXES
    ////////////////////////////////////////
    add_filter( 'rwmb_meta_boxes', 'sentry_register_meta_boxes' );
    /*-- METABOXES --*/
    function sentry_register_meta_boxes( $meta_box ) {
        
        $prefix = 'sentry';
        
        // Check if plugin is activated or included in theme

        if (!class_exists('RW_Meta_Box') or ! is_admin())
            return;

        $post_ID = !empty($_POST['post_ID']) ?
                $_POST['post_ID'] :
                (!empty($_GET['post']) ? $_GET['post'] : FALSE);

        if (!$post_ID)
            return;

        $current_post = get_post($post_ID);
        $current_post_type = $current_post->post_type;
        
        if($current_post_type = 'page'){
            if ($current_post->post_name != 'home' and $current_post->post_name != 'about-us' and $current_post->post_name != 'products' and $current_post->post_name != 'services' and $current_post->post_name != 'contact'){
                    $meta_box[] = array(
                        'id' => 'page_metas',
                        'title' => 'Sentry Page Meta Information',
                        'pages' => array('page'),
                        'context' => 'normal',
                        'priority' => 'high',
                        'fields' => array(
                            array(
                                'name' => 'Hero text',
                                'desc' => '<strong>Info!:</strong> This text will be desplayed over the top image.',
                                'id' => $prefix .'hero_text',
                                'type' => 'text',
                            ),
                            array(
                                'name' => 'Left Side Image',
                                'desc' => '<strong>Info!:</strong> This image will be displayed on the left side of the content, only if you selecte the Corpotare Pages Tamplate on the template selector on the right panel.',
                                'id' => $prefix .'corp_image',
                                'type' => 'file_input',
                            )
                        )
                    );
                }; // END if       
        };

        //Metaboxes for Locations
        if ($current_post->post_name == 'contact') {
            $meta_box[] = array(
                'id' => 'social_media',
                'title' => '<span class="dashicons dashicons-info"></span> Contact Info',
                'pages' => array('page'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Email',
                        'desc' => '<strong>Tip!:</strong> mymail@myweb.com',
                        'id' => $prefix .'em',
                        'type' => 'text',
                    ),
                    array(
                        'name' => 'Twitter',
                        'desc' => '<strong>Tip!:</strong> https://twitter.com/username',
                        'id' => $prefix .'tw',
                        'type' => 'url',
                    ),
                    array(
                        'name' => 'LinkedIn',
                        'desc' => '<strong>Tip!:</strong> https://www.facebook.com/username',
                        'id' => $prefix .'fb',
                        'type' => 'text',
                    ),
                    array(
                        'name' => 'Google Plus',
                        'desc' => '<strong>Tip!:</strong> https://www.gplus.com/username',
                        'id' => $prefix .'gp',
                        'type' => 'text',
                    )
            ));
            $meta_box[] = array(
                'id' => 'catalog',
                'title' => '<span class="dashicons dashicons-upload"></span> Catalog',
                'pages' => array('page'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Upload Catalog File',
                        'id' => $prefix .'catalogue',
                        'type' => 'file_input',
                    )
            ));
        };
        
        $meta_box[] = array(
            'id' => 'location_info',
            'title' => 'Location Info',
            'pages' => array('location'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(
                array(
                    'name' => 'Adress',
                    'id' => $prefix .'location_adress',
                    'type' => 'text',
                    'placeholder' => 'Please write the complete adress here.',
                    'desc' => '<strong>Tip!:</strong> 6401 W. Sam Houston Pkwy. N. Houston, TX 77041 United States'
                ),
            array(
                    'name' => 'City & Post Code',
                    'id' => $prefix .'location_city',
                    'type' => 'text',
                    'placeholder' => 'Please write the complete City & Post Code here.',
                    'desc' => '<strong>Tip!:</strong> 6401 W. Sam Houston Pkwy. N. Houston, TX 77041 United States'
                ),
                array(
                    'name' => 'Phone Number',
                    'id' => $prefix .'location_phone',
                    'type' => 'text'
                ),
                array(
                    'type' => 'divider'
                ),
                array(
                    'name' => 'Google Map URL',
                    'id' => $prefix .'location_gmurl',
                    'type' => 'textarea',
                    'desc' => '<strong>Tip!:</strong> Grab the complete URL from google maps view on the browser window'
                ),
                array(
                    'name' => 'Google Map Coords',
                    'id' => $prefix .'location_coords',
                    'type' => 'text',
                    'desc' => '<strong>Tip!:</strong> 30.1554244,-95.4608529'
                ),
        ));
        $meta_box[] = array(
            'id' => 'product_info',
            'title' => '<span style="color: #FF3600; font-size: 18px;"><i class="dashicons dashicons-products"></i> Sentry Wellhead Systems Product Information</span>',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(
                array(
                    'name' => '<span style="color: #FF3600;"><i class="dashicons dashicons-welcome-write-blog"></i> <strong>Description</strong></span>',
                    'id' => $prefix .'description',
                    'type' => 'wysiwyg'
                ),
                array(
                    'type' => 'divider'
                ),
                array(
                    'name' => '<span style="color: #FF3600;"><i class="dashicons dashicons-list-view"></i> <strong>Features/Benefits</strong></span>',
                    'id' => $prefix .'features',
                    'type' => 'wysiwyg'
                ),
                array(
                    'type' => 'divider'
                ),
                array(
                    'name' => '<span style="color: #FF3600;"><i class="dashicons dashicons-media-default"></i> <strong>Short Description</strong></span>',
                    'id' => $prefix .'shor_description',
                    'type' => 'wysiwyg'
                )
        ));
        $meta_box[] = array(
            'id' => 'service_info',
            'title' => '<span style="color: #FF3600; font-size: 18px;"><i class="dashicons dashicons-products"></i> Sentry Wellhead Systems Service Information</span>',
            'pages' => array('service'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(
                array(
                    'name' => '<span style="color: #FF3600;"><i class="dashicons dashicons-media-default"></i> <strong>Features (left side of featured image)</strong></span>',
                    'id' => $prefix .'short_description',
                    'type' => 'wysiwyg'
                )
        ));
        return $meta_box;
    }
    /*----- FIN DE LOS METABOXES -----*/

    function trademark() {
        echo "<!-- Dev by Jose Manuel Rodriguez Padrino with the Webcreek Team | email: jrodriguez@webcreek.com -->";
    }
    add_action( 'wp_head', 'trademark', 5 );
?>