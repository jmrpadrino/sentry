<?php get_header(); ?>
<?php 
    /* get term parent */
    $active_term = get_term_by('slug', $term, 'service_cat');
    if ($active_term->parent == 0)
    {
        //echo 'debo mostrar los hijos de la primera subcategoria';
        $terms = get_terms( array(
            'taxonomy' => 'service_cat',
            'hide_empty' => false,
            'parent' => $active_term->term_id,
            'orderby' => 'term_id',
            'order' => 'ASC'
        ) );
        if( count($terms) > 0 )
        {
            $the_slug = $terms[0]->slug;
            $active_title = $terms[0]->name;
        }
        else
        {
            $the_slug = $active_term->slug;
            $active_title = $active_term->name;
        }
        $elements = array(
            'post_type' => 'service',
            'orderby' => 'post_title',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'service_cat',
                    'field' => 'slug',   
                    'terms' => array ( $the_slug )
                )
            ),
        );
        
    }
    else
    {
        //echo 'es una subcategoria, debo mostrar los productos de esta.';
        $elements = array(
            'post_type' => 'service',
            'orderby' => 'post_title',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'service_cat',
                    'field' => 'slug',   
                    'terms' => array ( $active_term->slug )
                )
            ),
        );
        $the_slug = $active_term->slug;
        $active_title = $active_term->name;
    }
    $active_products = new WP_Query( $elements );
?>
    <nav>
        <div class="location-navigation-area">
            <div class="container">
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <?php show_parent_categories('service_cat', $term); ?>
                    </div>
                </div>
                <div class="row hidden-md hidden-lg">
                    <div class="responsive-categories">
                        <a id="navbar-responsive-list-title" class="navbar-responsive-list-title">
                            Services Categories
                            <span class="zmdi zmdi-chevron-down pull-right"></span>
                        </a>
                        <?php
                            
                            //var_dump($active_term);
                            //$terms = get_term_children( $active_term->term_id, 'type' );
                            $terms = get_terms( array(
                                'taxonomy' => 'service_cat',
                                'hide_empty' => false,
                                'orderby' => 'term_id',
                                'order' => 'ASC'
                            ) );
                            echo '<ul id="responsive-category-list" class="main-list show">';
                            foreach( $terms as $term_item ){
                                if ( $term_item->parent == 0 ){
                                    $hijos = get_term_children( $term_item->term_id, 'service_cat' );
                                    //var_dump($hijos);
                                    $term_link = get_term_link( $term_item );
                                    if ( $term == $term_item->slug ){
                                        echo '<li class="main-item term-active item-mobile">';
                                        if ( count($hijos)>0){
                                            echo '<a class="main-link active" href="#">' . $term_item->name . ' <span class="zmdi zmdi-chevron-up pull-right chevron-toggle"></span></a>';    
                                        }else{
                                            echo '<a class="main-link active" href="#">' . $term_item->name . '</a>';
                                        }
                                    }else{
                                        if ( $term_item->term_id == $active_term->parent){
                                            echo '<li class="main-item term-active item-mobile">';
                                            echo '<a class="main-link active" href="#z">' . $term_item->name . ' <span class="zmdi zmdi-chevron-down pull-right chevron-toggle"></span></a>';
                                        }else{
                                            echo '<li class="main-item item-mobile">';
                                            echo '<a class="main-link" href="#">' . $term_item->name . ' <span class="zmdi zmdi-chevron-up pull-right chevron-toggle"></span></a>';
                                        }
                                    }
                                    $child_terms = get_terms( array(
                                        'taxonomy' => 'service_cat',
                                        'hide_empty' => false,
                                        'child_of' => $term_item->term_id,
                                        'orderby' => 'term_id',
                                        'order' => 'ASC'
                                    ) );
                                    if ( count( $child_terms ) > 0 ){
                                        echo '<ul class="children-list">';
                                        foreach( $child_terms as $child_term ){
                                            $term_link = get_term_link( $child_term );
                                            
                                            
                                            $args = array(
                                                'post_type' => 'service',
                                                'orderby' => 'post_title',
                                                'order' => 'ASC',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'service_cat',
                                                        'field' => 'slug',   
                                                        'terms' => array ( $child_term->slug )
                                                    )
                                                ),
                                            );
                                            $products = new WP_Query( $args );
                                            
                                            if ( $term == $child_term->slug ){
                                                echo '<li class="child-item term-active item-mobile">';
                                            }else{
                                                echo '<li class="child-item item-mobile">';
                                            }
                                            if ( count($products) > 0 ){
                                                echo '<a class="child-link" href="#">' . $child_term->name . ' <span class="zmdi zmdi-chevron-up pull-right child-chevron-toggle"></span></a>';
                                            }else{
                                                echo '<a class="child-link" href="#">' . $child_term->name . '</a>';
                                            }
                                            
                                            /* Mostrar hijos si tiene */
                                            $products = new WP_Query( $args );
                                            if ($products->have_posts()){ $item_counter = 0;
                                                echo '<ul id="parent-'.$term_item->term_id.'" class="products-children-list">';
                                                while ($products->have_posts()){ $products->the_post();
                                                    echo '<li class="child-product">';
                                                    echo '<a class="child-link" href="';
                                                    the_permalink();
                                                    echo '">';
                                                    $trimmed = wp_trim_words( get_the_title(), $num_words = 4, $more = ' ...' );
                                            	    echo $trimmed;
                                                    echo '</a>';
                                                    echo '</li>';
                                                    $item_counter++;
                                                }
                                                echo '</ul>';

                                            }
                                            wp_reset_postdata();
                                        }
                                        echo '</ul>';
                                    }else{
                                        /* Mostrar hijos si tiene */
                                        $products = new WP_Query( $args );
                                        if ($products->have_posts()){ $item_counter = 0;
                                            echo '<ul class="children-list">';
                                            while ($products->have_posts()){ $products->the_post();
                                                echo '<li class="child-item">';
                                                echo '<a class="child-link product-category-item" href="';
                                                the_permalink();
                                                echo '">';
                                                the_title();
                                                echo '</a>';
                                                echo '</li>';
                                                $item_counter++;
                                            }
                                            echo '</ul>';

                                        }
                                        wp_reset_postdata();
                                    }
                                    echo '</li>';
                                }
                            }
                            echo '</ul>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <section>
            <div class="container">
                <div class="row gray-fondo">
                    <div class="col-sm-3 get-background">
                        <aside>
                            <div class="categories-list-container hidden-xs">
                            <?php
                                /* get term parent */
                                $active_term = get_term_by('slug', $term, 'service_cat');
                                if ( $active_term->parent > 0 ){
                                    $terms = get_terms( array(
                                        'taxonomy' => 'service_cat',
                                        'hide_empty' => false,
                                        'parent' => $active_term->parent,
                                        'orderby' => 'term_id',
                                        'order' => 'ASC'
                                    ) ); 
                                    $active_term = $active_term->term_id;
                                }else{
                                    $terms = get_terms( array(
                                        'taxonomy' => 'service_cat',
                                        'hide_empty' => false,
                                        'parent' => $active_term->term_id,
                                        'orderby' => 'term_id',
                                        'order' => 'ASC'
                                    ) );
                                    if ( count($terms) > 0 ){
                                        $active_term = $terms[0]->term_id;    
                                    }else{
                                        $active_term = $active_term->term_id;
                                    }
                                }
                                
                                echo '<ul class="main-list">';
                                foreach( $terms as $term_item ){
                                    $term_link = get_term_link( $term_item );
                                    
                                    if ( $term_item->term_id == $active_term ){
                                        echo '<li class="main-item show-children">';
                                        echo '<a class="main-link active" href="' . $term_link .'">' . $term_item->name . ' <span class="zmdi zmdi-chevron-up pull-right chevron-toggle"></span></a>';
                                    }else{
                                        echo '<li class="main-item">';
                                        echo '<a class="main-link" href="' . $term_link .'">' . $term_item->name . ' <span class="zmdi zmdi-chevron-down pull-right chevron-toggle"></span></a>';
                                    }
                                    $args = array(
                                        'post_type' => 'service',
                                        'orderby' => 'post_title',
                                        'order' => 'ASC',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'service_cat',
                                                'field' => 'slug',   
                                                'terms' => array ( $term_item->slug )
                                            )
                                        ),
                                    );
                                    $products = new WP_Query( $args );
                                    if ($products->have_posts()){ $item_counter = 0;
                                        echo '<ul id="parent-'.$term_item->term_id.'"class="children-list">';
                                        while ($products->have_posts()){ $products->the_post();
                                            echo '<li class="child-item">';
                                            echo '<a class="child-link" href="';
                                            the_permalink();
                                            echo '">';
					    the_title();
                                            echo '</a>';
                                            echo '</li>';
                                            $item_counter++;
                                        }
                                        echo '</ul>';

                                    }
                                    wp_reset_postdata();
                                    echo '</li>';
                                }
                                
                                echo '</ul>';
                            ?>
                            </div>
                            <div class="hidden-xs">
                            <?php get_template_part('templates/download-catalog'); ?>
                            </div>
                        </aside> 
                    </div>
                    <?php
                        $termino = get_term_by('slug', $term, 'service_cat');
                        if ($termino->parent == 0){ 
                    ?>
                    <div class="col-sm-9 hidden-xs content-wrapper">
                    <?php }else{ ?>
                    <div class="col-sm-9 content-wrapper">
                    <?php } ?>
                        <div class="background-gray-sidebar"></div>
                        <span class="hidden-xs">
                            <?php custom_breadcrumbs('service_cat'); ?>
                        </span>
                        <h2 class="term-title"><?php echo $active_title; ?></h2>
                        <?php
                            if ($active_products->have_posts()){
                                
                                while ($active_products->have_posts())
                                { 
                                    $active_products->the_post();
                        ?>
                        <article>
                            <div class=" col-sm-6 col-md-4">
                                <div class="product-item">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <div class="product-item-header">
                                            <?php 
                                                if( has_post_thumbnail() ){
                                            ?>
                                            <img class="img-responsive" src="<?php echo the_post_thumbnail_url('thumbnail');?>" alt="<?php the_title(); ?>">
                                            <?php
                                                }else{
                                            ?>
                                            <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/sentrywellheadsystem-no-pic.gif">
                                            <?php 
                                                } //end has post thumbnail
                                            ?>
                                        </div>
                                        <div class="product-item-footer">
                                            <?php the_title('<h3 class="product-title">','</h3>',true); ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php 
                                } //end while have posts
                            }
                            else
                            {
                        ?>
                        <article>
                            <div class="col-md-12">
                                <p class="no-items-category"><?php _e('There are no items in this category. Maybe a search can help.', 'sentrywellheadsystems'); ?></p>
                                <form id="search" class="search-form" method="get" action="<?php echo home_url(); ?>">
                                    <div class="inputs-container form-not-found">
                                        <input id="not-found-input" type="search" name="s" placeholder="Type in your search">
                                        <button type="submit" class="search-button"><i class="zmdi zmdi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </article>                       
                        <?php    
                            } //End if have posts
                        ?>
                    </div>
                    <div class="col-md-12 visible-xs">
                        <?php get_template_part('templates/download-catalog'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>