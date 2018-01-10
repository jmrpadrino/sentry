<?php get_header(); ?>
<?php the_post(); ?>
<?php $prefix = 'sentry'; ?>
<?php
$actual_post = $post->post_title;
$args = array(
    'parent' => 0
);
$terms = wp_get_post_terms( $post->ID, 'type', $args );
foreach ($terms as $term){
    $termslug = $term->slug;
    $parent_id = $term->term_id;
}
$args = array(
    'parent' => $parent_id
);
$child_post_terms = wp_get_post_terms( $post->ID, 'type', $args );
?>

    <nav>
        <div class="location-navigation-area">
            <div class="container">
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <?php show_parent_categories('type', $termslug); ?>
                    </div>
                </div>
                <div class="row hidden-md hidden-lg">
                    <div class="responsive-categories">
                        <a id="navbar-responsive-list-title" class="navbar-responsive-list-title">
                            Product Categories
                            <span class="zmdi zmdi-chevron-down pull-right"></span>
                        </a>
                        <?php
                            
                            //var_dump($active_term);
                            //$terms = get_term_children( $active_term->term_id, 'type' );
                            $terms = get_terms( array(
                                'taxonomy' => 'type',
                                'hide_empty' => false,
                                'orderby' => 'term_id',
                                'order' => 'ASC'
                            ) );
                            //var_dump( $terms );
                            echo '<ul id="responsive-category-list" class="main-list show">';
                            foreach( $terms as $term_item ){
                                if ( $term_item->parent == 0 ){
                                    $hijos = get_term_children( $term_item->term_id, 'type' );
                                    //var_dump($hijos);
                                    $term_link = get_term_link( $term_item );
                                    if ( $term == $term_item->slug ){
                                        echo '<li class="main-item term-active">';
                                        if ( count($hijos)>0){
                                            echo '<a class="main-link active" href="#">' . $term_item->name . ' <span class="zmdi zmdi-chevron-up pull-right chevron-toggle"></span></a>';    
                                        }else{
                                            echo '<a class="main-link active" href="#">' . $term_item->name . '</a>';
                                        }
                                    }else{
                                        if ( $term_item->term_id == $active_term->parent){
                                            echo '<li class="main-item term-active">';
                                            echo '<a class="main-link active" href="#z">' . $term_item->name . ' <span class="zmdi zmdi-chevron-down pull-right chevron-toggle"></span></a>';
                                        }else{
                                            echo '<li class="main-item">';
                                            if ( count($hijos)>0){
                                                    echo '<a class="main-link" href="#">' . $term_item->name . ' <span class="zmdi zmdi-chevron-up pull-right chevron-toggle"></span></a>';    
                                                }else{
                                                    echo '<a class="main-link" href="#">' . $term_item->name . '</a>';
                                                }
                                        }
                                    }
                                    $child_terms = get_terms( array(
                                        'taxonomy' => 'type',
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
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'type',
                                                        'field' => 'slug',   
                                                        'terms' => array ( $child_term->slug )
                                                    )
                                                ),
                                            );
                                            $products = new WP_Query( $args );
                                            
                                            if ( $term == $child_term->slug ){
                                                echo '<li class="child-item term-active">';
                                            }else{
                                                echo '<li class="child-item">';
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
        <div class="container">
            <div class="row gray-fondo">
                <div class="col-sm-3 get-background">
                    <aside>
                            <div class="categories-list-container hidden-xs">
                            <?php
                            if ( !empty($child_post_terms) ){
                                $terms = get_terms( array(
                                    'taxonomy' => 'type',
                                    'hide_empty' => false,
                                    'parent' => $child_post_terms[0]->parent,
                                    'orderby' => 'term_id',
                                    'order' => 'ASC'
                                ) );
                                echo '<ul class="main-list">';
                                foreach( $terms as $term_item ){
                                    $term_link = get_term_link( $term_item );
                                    if ( $term_item->term_id == $child_post_terms[0]->term_id ){
                                        echo '<li class="main-item show-children">';
                                        echo '<a class="main-link active" href="'.$term_link.'">' . $term_item->name . ' <span class="zmdi zmdi-chevron-up pull-up chevron-toggle"></span></a>';
                                    }else{
                                        echo '<li class="main-item">';
                                        echo '<a class="main-link" href="'.$term_link.'">' . $term_item->name . ' <span class="zmdi zmdi-chevron-down pull-right chevron-toggle"></span></a>';
                                    }
                                    $args = array(
                                        'post_type' => 'product',
                                        'orderby' => 'post_date',
                                        'order' => 'ASC',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'type',
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
                                            $post_list_title = get_the_title();
                                            if ( $post_list_title == $actual_post ){
                                                echo '<a class="child-link active" href="';
                                            }else{
                                                echo '<a class="child-link" href="';
                                            }
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
                            }
                            ?>
                            </div>
                            <div class="hidden-xs">
                            <?php get_template_part('templates/download-catalog'); ?>
                            </div>
                        </aside>
                </div>
                <div class="col-sm-9 content-wrapper">
                    <div class="background-gray-sidebar"></div>
                    <div class="hidden-xs">
                        <?php custom_breadcrumbs('type'); ?>
                    </div>
                    <div class="col-md-12">
                        <h1 class="product-title"><?php the_title(); ?></h1>
                    </div>
                    <?php 
                        $product_meta_desc = get_post_meta($post->ID, $prefix.'description', true);
                        $product_meta_fea = get_post_meta($post->ID, $prefix.'features', true);
                        $product_meta_sdes = get_post_meta($post->ID, $prefix.'shor_description', true);
                    
                        if ( !empty($product_meta_desc) or !empty($product_meta_fea) or !empty($product_meta_sdes)){
                            get_template_part('templates/single-product-content');
                        }else{
                            get_template_part('templates/single-product-no-content');
                        }
                    ?>
                    <hr />
                    <div class="col-md-12 hidden-sm hidden-md hidden-lg">
                        <?php get_template_part('templates/download-catalog'); ?>
                    </div>
                    <div class="col-md-12 hidden-md hidden-lg">
                        <a href="<?php echo home_url('contact'); ?>" class="contact-sales" style="">Contact Sales</a>
                    </div>
                    <div class="col-md-12">
                        <?php edit_post_link( __( '<span class="fa fa-edit"></span> Edit this product', 'sentrywellheadsystem' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>
<script>
    $('.child-chevron-toggle').click(function(e){
        e.preventDefault();
        $(this).parents('.child-item').toggleClass('show-children');
        $(this).toggleClass('zmdi-chevron-down').toggleClass('zmdi-chevron-up');
    });
</script>