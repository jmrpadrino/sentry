<?php get_header(); ?>
    <nav>
        <div class="location-navigation-area">
            <div class="container">
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <?php show_parent_categories('type', $term); ?>
                    </div>
                </div>
                <div class="row hidden-md hidden-lg">
                    <div class="responsive-categories">
                        <a id="navbar-responsive-list-title" class="navbar-responsive-list-title">
                            Product Categories
                            <span class="fa fa-chevron-down pull-right"></span>
                        </a>
                        <?php
                            /* get term parent */
                            $active_term = get_term_by('slug', $term, 'type');
                            //var_dump($active_term);
                            //$terms = get_term_children( $active_term->term_id, 'type' );
                            $terms = get_terms( array(
                                'taxonomy' => 'type',
                                'hide_empty' => false,
                                'orderby' => 'term_id',
                                'order' => 'ASC'
                            ) );
                            //var_dump( $terms );
                            echo '<ul id="responsive-category-list" class="main-list hide">';
                            foreach( $terms as $term_item ){
                                if ( $term_item->parent == 0 ){
                                    $term_link = get_term_link( $term_item );
                                    if ( $term == $term_item->slug ){
                                        echo '<li class="main-item term-active">';
                                        echo '<a class="main-link active" href="' . $term_link .'">' . $term_item->name . ' <i class="fa fa-chevron-up pull-right"></i></a>';
                                    }else{
                                        if ( $term_item->term_id == $active_term->parent){
                                            echo '<li class="main-item term-active">';
                                            echo '<a class="main-link active" href="' . $term_link .'">' . $term_item->name . ' <i class="fa fa-chevron-down pull-right"></i></a>';
                                        }else{
                                            echo '<li class="main-item">';
                                            echo '<a class="main-link" href="' . $term_link .'">' . $term_item->name . ' <i class="fa fa-chevron-down pull-right"></i></a>';
                                        }
                                    }
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
                                            echo '<a class="child-link" href="' . $term_link .'">' . $child_term->name . ' <i class="fa fa-chevron-right pull-right"></i></a></li>';
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
                    <div class="col-sm-3 get-background">
                        <aside>
                            <div class="categories-list-container hidden-xs">
                            <?php
                                /* get term parent */
                                $active_term = get_term_by('slug', $term, 'type');
                                if ( $active_term->parent > 0 ){
                                    $terms = get_terms( array(
                                        'taxonomy' => 'type',
                                        'hide_empty' => false,
                                        'parent' => $active_term->parent,
                                        'orderby' => 'term_id',
                                        'order' => 'ASC'
                                    ) ); 
                                }else{
                                    $terms = get_terms( array(
                                        'taxonomy' => 'type',
                                        'hide_empty' => false,
                                        'parent' => $active_term->term_id,
                                        'orderby' => 'term_id',
                                        'order' => 'ASC'
                                    ) );   
                                }
                                
                                $list_counter = 0;
                                echo '<ul class="main-list">';
                                foreach( $terms as $term_item ){
                                    $term_link = get_term_link( $term_item );
                                    echo '<li class="main-item" onmouseover="showchild('.$term_item->term_id.')" onmouseout="hidechild('.$term_item->term_id.')">';
                                    if ( $list_counter == 0 ){
                                        echo '<a class="main-link active" href="' . $term_link .'">' . $term_item->name . ' <span class="zmdi zmdi-chevron-right pull-right"></span></a>';
                                    }else{
                                        echo '<a class="main-link" href="' . $term_link .'">' . $term_item->name . ' <span class="zmdi zmdi-chevron-down pull-right"></span></a>';
                                    }
                                    $args = array(
                                        'post_type' => 'product',
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
                                        echo '<ul id="parent-'.$term_item->term_id.'" class="children-list">';
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
                                    $list_counter++;
                                }
                                
                                echo '</ul>';
                            ?>
                            </div>
                            <?php get_template_part('templates/download-catalog'); ?>
                        </aside> 
                    </div>
                    <div class="col-sm-9 content-wrapper">
                        <div class="background-gray-sidebar"></div>
                        <?php
                        
                        ?>
                        <span class="hidden-xs">
                            <?php custom_breadcrumbs(); ?>
                        </span>
                        <h2 class="term-title"><?php echo $active_term->name; ?></h2>
                        <?php 
                        if ( $active_term->parent == 0 ){
                            
                            if ( have_posts() ){ $item_counter = 0;
                                while ( have_posts() ){ the_post();
                        ?>
                        <article>
                            <div class="col-sm-6 col-md-4">
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
                                   $item_counter++;
                                   if ($item_counter % 3 == 0){
                                       echo '<div class="clearfix"></div>';
                                   }
                                } //END WHILE
                            }else{
                        ?>
                        <article>
                            <div class="col-md-12">
                                <p class="no-items-category"><?php _e('There are no items in this category. Maybe a search can help.', 'sentrywellheadsystems'); ?></p>
                                <form id="search" class="search-form" method="get" action="<?php echo home_url(); ?>">
                                    <div class="inputs-container form-not-found">
                                        <input id="not-found-input" type="search" name="s" placeholder="Type in your search">
                                        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </article>
                        <?php       
                            } //END IF haVE POST

                       }else{
                            if ( have_posts() ){ $item_counter = 0;
                                while ( have_posts() ){ the_post();
                        ?>
                        <article>
                            <div class="col-sm-6 col-md-4">
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
                                    }
                                }else{
                        ?>
                        <article>
                            <div class="col-md-12">
                                <p class="no-items-category"><?php _e('There are no items in this category. Maybe a search can help.', 'sentrywellheadsystems'); ?></p>
                                <form id="search" class="search-form" method="get" action="<?php echo home_url(); ?>">
                                    <div class="inputs-container form-not-found">
                                        <input id="not-found-input" type="search" name="s" placeholder="Type in your search">
                                        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </article>
                        <?php 
                            }
                            }
                        ?>
                    </div>

                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>