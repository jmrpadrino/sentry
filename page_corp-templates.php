<?php
/**
 * Template Name: Corporate Info Templates
 *
 * @package WordPress
 * @subpackage sentry
 * @since Sentry 1.0
 */
    get_header(); 
?>
<?php the_post(); ?>
<?php 
if ( has_post_thumbnail() ){
?>
<div class="page-hero about-us-hero" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);">
    <?php
                           }else{
    ?>
    <div class="page-hero about-us-hero">
        <?php 
}
        ?>
        <?php
        $prefix = 'sentry';
        $hero_text = get_post_meta( $post->ID, $prefix . 'hero_text', true );
        if (!empty($hero_text)){
        ?>
        <h1 class="banner-text"><?php echo $hero_text; ?></h1>
        <?php } ?>
    </div>
    <main>
        <section>
            <div class="container">
                <div class="row">                    
                    <div class="col-sm-6">
                        <div class="corp-pages-left-side-images">
                            <img class="img-responsive" src="<?php echo $left_side_image = get_post_meta( $post->ID, $prefix . 'corp_image', true ); ?>"  />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <article>
                            <h1 class="search-page-title"><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php get_footer(); ?>