<?php get_header(); ?>
<?php the_post(); ?>
    <nav>
        <div class="location-navigation-area">
            <div class="container">
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <?php show_parent_categories('type', $term = ''); ?>
                    </div>
                </div>
                <div class="row hidden-md hidden-lg">
                    <div class="responsive-categories">
                        <a id="navbar-responsive-list-title" class="navbar-responsive-list-title">
                            Product Categories
                            <i class="zmdi zmdi-chevron-down pull-right"></i>
                        </a>
                        <?php
                            /* get term parent */
                            $terms = get_terms( array(
                                'taxonomy' => 'type',
                                'hide_empty' => false,
                            ) );
                            //var_dump( $terms );
                            echo '<ul id="responsive-category-list" class="main-list hide">';
                            foreach( $terms as $term_item ){
                                if ( $term_item->parent == 0 ){
                                    $term_link = get_term_link( $term_item );
                                    echo '<li class="main-item">';
                                    echo '<a class="main-link" href="' . $term_link .'">' . $term_item->name . ' <i class="zmdi zmdi-chevron-down pull-right"></i></a>';
                                    $child_terms = get_terms( array(
                                        'taxonomy' => 'type',
                                        'hide_empty' => false,
                                        'child_of' => $term_item->term_id,
                                    ) );
                                    if ( count( $child_terms ) > 0 ){
                                        echo '<ul class="children-list">';
                                        foreach( $child_terms as $child_term ){
                                            $term_link = get_term_link( $child_term );
                                            if ( $term == $child_term->slug ){
                                                echo '<li class="child-item term-active">';
                                            }else{
                                                echo '<li class="child-item">';
                                            }
                                            echo '<a class="child-link" href="' . $term_link .'">' . $child_term->name . '</a></li>';
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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <aside>
                            <div class="categories-list-container hidden-xs">
                            <?php
                                /* get term parent */
                                $terms = get_terms( array(
                                    'taxonomy' => 'type',
                                    'hide_empty' => false,
                                ) );
                                echo '<ul class="main-list">';
                                foreach( $terms as $term_item ){
                                    if ( $term_item->parent == 0 ){
                                        $term_link = get_term_link( $term_item );
                                        echo '<li class="main-item" onmouseover="showchild('.$term_item->term_id.')" onmouseout="hidechild('.$term_item->term_id.')">';
                                        echo '<a class="main-link" href="#">' . $term_item->name . ' <i class="zmdi zmdi-chevron-down pull-right"></i></a>';
                                        $child_terms = get_terms( array(
                                            'taxonomy' => 'type',
                                            'hide_empty' => false,
                                            'child_of' => $term_item->term_id,
                                        ) );
                                        if ( count( $child_terms ) > 0 ){
                                            echo '<ul id="parent-'.$term_item->term_id.'" class="children-list">';
                                            foreach( $child_terms as $child_term ){
                                                $term_link = get_term_link( $child_term );
                                                if ( $term_item->slug == $child_term->slug ){
                                                    echo '<li class="child-item term-active">';
                                                }else{
                                                    echo '<li class="child-item">';
                                                }
                                                echo '<a class="child-link" href="' . $term_link .'">' . $child_term->name . '</a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                            ?>
                            </div>
                            <?php get_template_part('templates/download-catalog'); ?>
                        </aside> 
                    </div>
                    <div class="col-md-9 content-wrapper">
                        <div class="background-gray-sidebar"></div>
                        <span class="hidden-xs">
                            <?php custom_breadcrumbs(); ?>
                        </span>
                        <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'type',
                                'hide_empty' => false,
                                'parent' => 0
                            ) );
                            foreach( $terms as $term_item ){
                                $term_link = get_term_link( $term_item );
                                if (function_exists('get_wp_term_image'))
                                {
                                    $meta_image = get_wp_term_image($term_item->term_id); 
                                    //It will give category/term image url 
                                }
                        ?>
                        <article>
                            <div class="col-md-4">
                                <div class="product-item">
                                    <a href="<?php echo $term_link; ?>">
                                        <div class="product-item-header">
                                            <?php if (empty($meta_image)){ ?>
                                            <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/sentrywellheadsystem-no-pic.gif">
                                            <?php }else{ ?>
                                            <img class="img-responsive" src="<?php echo $meta_image; ?>">
                                            <?php } ?>
                                        </div>
                                        <div class="product-item-footer">
                                            <h3 class="product-title">
                                            <?php echo $term_item->name; ?>
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php
                                     /*add clearfix
                                     $item_counter++;
                                     if ($item_counter % 3 == 0){
                                         echo '<div class="clearfix"></div>';
                                     }*/
                            }// END if
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>