<?php get_header(); ?>
<?php the_post(); ?>
<?php $prefix = 'sentry'; ?>
<?php
$args = array(
    'parent' => 0
);
$terms = wp_get_post_terms( $post->ID, 'service_cat', $args );
foreach ($terms as $term){
    $termslug = $term->slug;
    $parent_id = $term->term_id;
}
$args = array(
    'parent' => $parent_id
);
$child_post_terms = wp_get_post_terms( $post->ID, 'service_cat', $args );
?>
    <nav>
        <div class="location-navigation-area">
            <div class="container">
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <?php show_parent_categories('service_cat', $termslug ); ?>
                    </div>
                </div>
                <div class="row hidden-md hidden-lg">
                    <div class="responsive-categories">
                        <a id="navbar-responsive-list-title" class="navbar-responsive-list-title">
                            Service Categories
                            <i class="zmdi zmdi-chevron-down pull-right"></i>
                        </a>
                        <?php
                            /* get term parent */
                            $active_term = get_term_by('slug', $termslug, 'service_cat');
                            //var_dump($active_term);
                            //$terms = get_term_children( $active_term->term_id, 'type' );
                            $terms = get_terms( array(
                                'taxonomy' => 'service_cat',
                                'hide_empty' => false,
                            ) );
                            //var_dump( $terms );
                            echo '<ul id="responsive-category-list" class="main-list hide">';
                            foreach( $terms as $term_item ){
                                if ( $term_item->parent == 0 ){
                                    $term_link = get_term_link( $term_item );
                                    if ( $term == $term_item->slug ){
                                        echo '<li class="main-item term-active">';
                                        echo '<a class="main-link active" href="' . $term_link .'">' . $term_item->name . ' <i class="zmdi zmdi-chevron-right pull-right chevron-toggle"></i></a>';
                                    }else{
                                        if ( $term_item->term_id == $active_term->parent){
                                            echo '<li class="main-item term-active">';
                                            echo '<a class="main-link active" href="' . $term_link .'">' . $term_item->name . ' <i class="zmdi zmdi-chevron-down pull-right chevron-toggle"></i></a>';
                                        }else{
                                            echo '<li class="main-item">';
                                            echo '<a class="main-link" href="' . $term_link .'">' . $term_item->name . ' <i class="zmdi zmdi-chevron-right pull-right chevron-toggle"></i></a>';
                                        }
                                    }
                                    $child_terms = get_terms( array(
                                        'taxonomy' => 'service_cat',
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
        <div class="container">
            <div class="row gray-fondo">
                <div class="col-sm-3 hidden-xs get-background">
                    <aside>
                        <?php get_template_part('templates/download-catalog'); ?>
                    </aside>
                </div>
                <div class="col-sm-9 content-wrapper">
                    <div class="background-gray-sidebar"></div>
                    <div>
                        <?php custom_breadcrumbs('service_cat'); ?>    
                    </div>
                    <?php if( has_post_thumbnail() ){ ?>
                    <?php
                                //obtener las dimensiones de la imagen y cambiar la vista
                                //$featured_image_id = get_post_thumbnail_id( get_the_ID() );
                                //$post_featured_image = wp_get_attachment_metadata( $featured_image_id, true );
                                //var_dump($post_featured_image);
                                //if ( $post_featured_image['width'] < $post_featured_image['height'] ) {
                    ?>
                    <div class="col-md-12">
                        <h1 class="product-title"><?php the_title(); ?></h1>
                    </div>
                    <div class="col-md-12">
                        <?php the_content(); ?>
                    </div>
                    <div class="col-md-6">
                        <?php the_post_thumbnail('full', array( 'class' => 'img-responsive', 'alt' => get_the_title() )); ?>
                    </div>
                    <div class="col-md-6 post-meta-wrapper">
                       <?php echo get_post_meta($post->ID, $prefix.'short_description', true); ?>
                    </div>
                    <?php 
                               // }else{
                        /*
                    ?>
                    <div class="col-md-12">
                        <h1 class="product-title"><?php the_title(); ?></h1>
                    </div>
                    <div class="col-md-12">
                        <?php the_post_thumbnail('full', array( 'class' => 'img-landscape img-responsive', 'alt' => get_the_title() )); ?>
                    </div>
                    <div class="col-md-12">
                        <?php the_content(); ?>
                    </div>
                    <?php           
                               // } //END calculating image dimentions
                               */
                    ?>
                    <?php }else{ ?>
                    <div class="col-md-12">
                        <h1 class="product-title"><?php the_title(); ?></h1>
                    </div>
                    <div class="col-md-12">
                        <?php the_content(); ?>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <?php edit_post_link( __( '<span class="fa fa-edit"></span> Edit this service', 'sentrywellheadsystem' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                </div>
                <div class="col-sm-3 visible-xs">
                    <aside>
                        <?php get_template_part('templates/download-catalog'); ?>
                    </aside>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>