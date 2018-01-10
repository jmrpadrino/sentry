<?php
    ////////////////////////////////////////
    // SENTRY TAXONOMIES
    ////////////////////////////////////////
    

    // Register Custom Taxonomy products
    function product_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Types', 'Taxonomy General Name', 'sentrywellheadsystem' ),
            'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'sentrywellheadsystem' ),
            'menu_name'                  => __( 'Product Types', 'sentrywellheadsystem' ),
            'all_items'                  => __( 'All Items', 'sentrywellheadsystem' ),
            'parent_item'                => __( 'Parent Item', 'sentrywellheadsystem' ),
            'parent_item_colon'          => __( 'Parent Item:', 'sentrywellheadsystem' ),
            'new_item_name'              => __( 'New Item Name', 'sentrywellheadsystem' ),
            'add_new_item'               => __( 'Add New Item', 'sentrywellheadsystem' ),
            'edit_item'                  => __( 'Edit Item', 'sentrywellheadsystem' ),
            'update_item'                => __( 'Update Item', 'sentrywellheadsystem' ),
            'view_item'                  => __( 'View Item', 'sentrywellheadsystem' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'sentrywellheadsystem' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'sentrywellheadsystem' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'sentrywellheadsystem' ),
            'popular_items'              => __( 'Popular Items', 'sentrywellheadsystem' ),
            'search_items'               => __( 'Search Items', 'sentrywellheadsystem' ),
            'not_found'                  => __( 'Not Found', 'sentrywellheadsystem' ),
            'no_terms'                   => __( 'No items', 'sentrywellheadsystem' ),
            'items_list'                 => __( 'Items list', 'sentrywellheadsystem' ),
            'items_list_navigation'      => __( 'Items list navigation', 'sentrywellheadsystem' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => array( 'slug' => 'products' ),
        );
        register_taxonomy( 'type', array( 'product' ), $args );

    }
    add_action( 'init', 'product_taxonomy', 0 );


    // Register Custom Taxonomy Services
    function services_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Service Categories', 'Taxonomy General Name', 'sentrywellheadsystem' ),
            'singular_name'              => _x( 'Service Category', 'Taxonomy Singular Name', 'sentrywellheadsystem' ),
            'menu_name'                  => __( 'Service Categories', 'sentrywellheadsystem' ),
            'all_items'                  => __( 'All Items', 'sentrywellheadsystem' ),
            'parent_item'                => __( 'Parent Item', 'sentrywellheadsystem' ),
            'parent_item_colon'          => __( 'Parent Item:', 'sentrywellheadsystem' ),
            'new_item_name'              => __( 'New Item Name', 'sentrywellheadsystem' ),
            'add_new_item'               => __( 'Add New Item', 'sentrywellheadsystem' ),
            'edit_item'                  => __( 'Edit Item', 'sentrywellheadsystem' ),
            'update_item'                => __( 'Update Item', 'sentrywellheadsystem' ),
            'view_item'                  => __( 'View Item', 'sentrywellheadsystem' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'sentrywellheadsystem' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'sentrywellheadsystem' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'sentrywellheadsystem' ),
            'popular_items'              => __( 'Popular Items', 'sentrywellheadsystem' ),
            'search_items'               => __( 'Search Items', 'sentrywellheadsystem' ),
            'not_found'                  => __( 'Not Found', 'sentrywellheadsystem' ),
            'no_terms'                   => __( 'No items', 'sentrywellheadsystem' ),
            'items_list'                 => __( 'Items list', 'sentrywellheadsystem' ),
            'items_list_navigation'      => __( 'Items list navigation', 'sentrywellheadsystem' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => array( 'slug' => 'services' ),
        );
        register_taxonomy( 'service_cat', array( 'service' ), $args );

    }
    add_action( 'init', 'services_taxonomy', 0 );


    // Register Custom Taxonomy locations
    function location_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Locations', 'Taxonomy General Name', 'sentrywellheadsystem' ),
            'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'sentrywellheadsystem' ),
            'menu_name'                  => __( 'Locations', 'sentrywellheadsystem' ),
            'all_items'                  => __( 'All Items', 'sentrywellheadsystem' ),
            'parent_item'                => __( 'Parent Item', 'sentrywellheadsystem' ),
            'parent_item_colon'          => __( 'Parent Item:', 'sentrywellheadsystem' ),
            'new_item_name'              => __( 'New Item Name', 'sentrywellheadsystem' ),
            'add_new_item'               => __( 'Add New Item', 'sentrywellheadsystem' ),
            'edit_item'                  => __( 'Edit Item', 'sentrywellheadsystem' ),
            'update_item'                => __( 'Update Item', 'sentrywellheadsystem' ),
            'view_item'                  => __( 'View Item', 'sentrywellheadsystem' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'sentrywellheadsystem' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'sentrywellheadsystem' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'sentrywellheadsystem' ),
            'popular_items'              => __( 'Popular Items', 'sentrywellheadsystem' ),
            'search_items'               => __( 'Search Items', 'sentrywellheadsystem' ),
            'not_found'                  => __( 'Not Found', 'sentrywellheadsystem' ),
            'no_terms'                   => __( 'No items', 'sentrywellheadsystem' ),
            'items_list'                 => __( 'Items list', 'sentrywellheadsystem' ),
            'items_list_navigation'      => __( 'Items list navigation', 'sentrywellheadsystem' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
            'rewrite'                    => array( 'slug' => 'location' ),
        );
        register_taxonomy( 'loc', array( 'location' ), $args );

    }
    add_action( 'init', 'location_taxonomy', 0 );
?>