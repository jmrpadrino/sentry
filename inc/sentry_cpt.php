<?php
    /*--------------------------------------
    Custom Post Types for Sentry
    --------------------------------------*/

    // Register Custom Post Type for Products
    function sentry_cpt_product() {

        $labels = array(
            'name'                  => _x( 'Products', 'Post Type General Name', 'sentrywellheadsystem' ),
            'singular_name'         => _x( 'Sentry Product', 'Post Type Singular Name', 'sentrywellheadsystem' ),
            'menu_name'             => __( 'Sentry Products', 'sentrywellheadsystem' ),
            'name_admin_bar'        => __( 'Sentry Product', 'sentrywellheadsystem' ),
            'archives'              => __( 'Item Archives', 'sentrywellheadsystem' ),
            'attributes'            => __( 'Item Attributes', 'sentrywellheadsystem' ),
            'parent_item_colon'     => __( 'Parent Item:', 'sentrywellheadsystem' ),
            'all_items'             => __( 'All Items', 'sentrywellheadsystem' ),
            'add_new_item'          => __( 'Add New Item', 'sentrywellheadsystem' ),
            'add_new'               => __( 'Add New', 'sentrywellheadsystem' ),
            'new_item'              => __( 'New Item', 'sentrywellheadsystem' ),
            'edit_item'             => __( 'Edit Item', 'sentrywellheadsystem' ),
            'update_item'           => __( 'Update Item', 'sentrywellheadsystem' ),
            'view_item'             => __( 'View Item', 'sentrywellheadsystem' ),
            'view_items'            => __( 'View Items', 'sentrywellheadsystem' ),
            'search_items'          => __( 'Search Item', 'sentrywellheadsystem' ),
            'not_found'             => __( 'Not found', 'sentrywellheadsystem' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'sentrywellheadsystem' ),
            'featured_image'        => __( 'Featured Image', 'sentrywellheadsystem' ),
            'set_featured_image'    => __( 'Set featured image', 'sentrywellheadsystem' ),
            'remove_featured_image' => __( 'Remove featured image', 'sentrywellheadsystem' ),
            'use_featured_image'    => __( 'Use as featured image', 'sentrywellheadsystem' ),
            'insert_into_item'      => __( 'Insert into item', 'sentrywellheadsystem' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'sentrywellheadsystem' ),
            'items_list'            => __( 'Items list', 'sentrywellheadsystem' ),
            'items_list_navigation' => __( 'Items list navigation', 'sentrywellheadsystem' ),
            'filter_items_list'     => __( 'Filter items list', 'sentrywellheadsystem' ),
        );
        $args = array(
            'label'                 => __( 'Product', 'sentrywellheadsystem' ),
            'description'           => __( 'Sentry Wellhead System Product', 'sentrywellheadsystem' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail' ),
            'taxonomies'            => array( 'type' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => get_stylesheet_directory_uri().'/images/sentry_menu_icon.png',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'products',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'product', $args );

    }
    add_action( 'init', 'sentry_cpt_product', 0 );

    // Register Custom Post Type for Services
    function sentry_cpt_service() {

        $labels = array(
            'name'                  => _x( 'Services', 'Post Type General Name', 'sentrywellheadsystem' ),
            'singular_name'         => _x( 'Sentry Service', 'Post Type Singular Name', 'sentrywellheadsystem' ),
            'menu_name'             => __( 'Sentry Services', 'sentrywellheadsystem' ),
            'name_admin_bar'        => __( 'Sentry Service', 'sentrywellheadsystem' ),
            'archives'              => __( 'Item Archives', 'sentrywellheadsystem' ),
            'attributes'            => __( 'Item Attributes', 'sentrywellheadsystem' ),
            'parent_item_colon'     => __( 'Parent Item:', 'sentrywellheadsystem' ),
            'all_items'             => __( 'All Items', 'sentrywellheadsystem' ),
            'add_new_item'          => __( 'Add New Item', 'sentrywellheadsystem' ),
            'add_new'               => __( 'Add New', 'sentrywellheadsystem' ),
            'new_item'              => __( 'New Item', 'sentrywellheadsystem' ),
            'edit_item'             => __( 'Edit Item', 'sentrywellheadsystem' ),
            'update_item'           => __( 'Update Item', 'sentrywellheadsystem' ),
            'view_item'             => __( 'View Item', 'sentrywellheadsystem' ),
            'view_items'            => __( 'View Items', 'sentrywellheadsystem' ),
            'search_items'          => __( 'Search Item', 'sentrywellheadsystem' ),
            'not_found'             => __( 'Not found', 'sentrywellheadsystem' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'sentrywellheadsystem' ),
            'featured_image'        => __( 'Featured Image', 'sentrywellheadsystem' ),
            'set_featured_image'    => __( 'Set featured image', 'sentrywellheadsystem' ),
            'remove_featured_image' => __( 'Remove featured image', 'sentrywellheadsystem' ),
            'use_featured_image'    => __( 'Use as featured image', 'sentrywellheadsystem' ),
            'insert_into_item'      => __( 'Insert into item', 'sentrywellheadsystem' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'sentrywellheadsystem' ),
            'items_list'            => __( 'Items list', 'sentrywellheadsystem' ),
            'items_list_navigation' => __( 'Items list navigation', 'sentrywellheadsystem' ),
            'filter_items_list'     => __( 'Filter items list', 'sentrywellheadsystem' ),
        );
        $args = array(
            'label'                 => __( 'Service', 'sentrywellheadsystem' ),
            'description'           => __( 'Sentry Wellhead System Servicio', 'sentrywellheadsystem' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
            'taxonomies'            => array( '' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'menu_icon'             => get_stylesheet_directory_uri().'/images/sentry_menu_icon.png',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'services',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'service', $args );

    }
    add_action( 'init', 'sentry_cpt_service', 0 );

     // Register Custom Post Type for Locations
    function sentry_cpt_location() {

        $labels = array(
            'name'                  => _x( 'Sentry Locations', 'Post Type General Name', 'sentrywellheadsystem' ),
            'singular_name'         => _x( 'Sentry Location', 'Post Type Singular Name', 'sentrywellheadsystem' ),
            'menu_name'             => __( 'Sentry Locations', 'sentrywellheadsystem' ),
            'name_admin_bar'        => __( 'Sentry Location', 'sentrywellheadsystem' ),
            'archives'              => __( 'Item Archives', 'sentrywellheadsystem' ),
            'attributes'            => __( 'Item Attributes', 'sentrywellheadsystem' ),
            'parent_item_colon'     => __( 'Parent Item:', 'sentrywellheadsystem' ),
            'all_items'             => __( 'All Items', 'sentrywellheadsystem' ),
            'add_new_item'          => __( 'Add New Item', 'sentrywellheadsystem' ),
            'add_new'               => __( 'Add New', 'sentrywellheadsystem' ),
            'new_item'              => __( 'New Item', 'sentrywellheadsystem' ),
            'edit_item'             => __( 'Edit Item', 'sentrywellheadsystem' ),
            'update_item'           => __( 'Update Item', 'sentrywellheadsystem' ),
            'view_item'             => __( 'View Item', 'sentrywellheadsystem' ),
            'view_items'            => __( 'View Items', 'sentrywellheadsystem' ),
            'search_items'          => __( 'Search Item', 'sentrywellheadsystem' ),
            'not_found'             => __( 'Not found', 'sentrywellheadsystem' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'sentrywellheadsystem' ),
            'featured_image'        => __( 'Featured Image', 'sentrywellheadsystem' ),
            'set_featured_image'    => __( 'Set featured image', 'sentrywellheadsystem' ),
            'remove_featured_image' => __( 'Remove featured image', 'sentrywellheadsystem' ),
            'use_featured_image'    => __( 'Use as featured image', 'sentrywellheadsystem' ),
            'insert_into_item'      => __( 'Insert into item', 'sentrywellheadsystem' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'sentrywellheadsystem' ),
            'items_list'            => __( 'Items list', 'sentrywellheadsystem' ),
            'items_list_navigation' => __( 'Items list navigation', 'sentrywellheadsystem' ),
            'filter_items_list'     => __( 'Filter items list', 'sentrywellheadsystem' ),
        );
        $args = array(
            'label'                 => __( 'Location', 'sentrywellheadsystem' ),
            'description'           => __( 'Sentry Wellhead System Locations', 'sentrywellheadsystem' ),
            'labels'                => $labels,
            'supports'              => array( 'title', ),
            'taxonomies'            => array( '' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'menu_icon'             => get_stylesheet_directory_uri().'/images/sentry_menu_icon.png',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => '',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'location', $args );

    }
    add_action( 'init', 'sentry_cpt_location', 0 );

?>