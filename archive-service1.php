<?php get_header(); ?>
<?php the_post(); ?>
    <nav>
        <div class="location-navigation-area">
           <div class="container">
              <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">Services</div>
              </div>
           </div>
        </div>
    </nav>
    <main>
        <section>
            <div class="container">
                <div class="row">
                   <div class="col-sm-3">
                        <aside>
                            <?php get_template_part('templates/download-catalog'); ?>
                        </aside> 
                    </div>
                    <div class="col-sm-9 content-wrapper">
                        <div class="background-gray-sidebar"></div>
                        <?php custom_breadcrumbs(); ?>
                        <?php 
                            $args = array(
                                'post_type' => 'service',
                                'paged' => $paged,
                            );
                            $services = new WP_Query( $args );
                            if ($services->have_posts()){ $item_counter = 0;
                                while ($services->have_posts()){ $services->the_post();
                        ?>
                            <article>
                                <div class="col-md-4">
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
                                //add clearfix
                                $item_counter++;
                                if ($item_counter % 3 == 0){
                                    echo '<div class="clearfix"></div>';
                                }
                                }
                            }

                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
<?php 
/*
$terms = wp_get_post_terms( $post_id, $taxonomy, $args );
*/
?>