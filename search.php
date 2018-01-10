<?php get_header(); ?>
<?php
    $product_array = array();
    $service_array = array();
    $default_posts_per_page = get_option( 'posts_per_page' );
    $entire_posts_count = 0;
    $post_in_page = 0;
    global $wp_query;

    if ( $wp_query->is_search ) {
        $wp_query->set( 'post_type', array( 'product', 'service' ) );
    }
    if( have_posts () ){
        while ( have_posts() ){
        
            the_post();

            $p_type = get_post_type( $post->ID );

            $entire_posts_count++;
        
            switch( $p_type ){
                case 'product' : $product_array[] = $post->ID; break;
                case 'service' : $service_array[] = $post->ID; break;
            } //END Switch
        }//END While
        if ($default_posts_per_page < $entire_posts_count){
            $entire_posts_count = $default_posts_per_page;
        }
?>
    <main>
        <div class="responsive-search-page-form hidden-md hidden-lg">
            <div class="row">
                <div class="col-xs-12">
                    <form id="search" class="search-form" method="get" action="<?php echo home_url(); ?>">
                        <div class="inputs-container">
                            <input id="search_input" type="search" name="s" placeholder="Type in your search">
                            <input type="hidden" name="post_type[]" value="product">
                            <input type="hidden" name="post_type[]" value="service">
                            <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="search-page-title">Search results</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 hidden-xs">
                    <aside>
                        <h2 class="search-sidebar-title">Search Filters</h2>
                        <hr />
                        <ul class="main-list">
                            <?php if ( count ( $product_array ) > 0 ) { ?>
                            <li class="main-item"><a class="main-link" href="<?php echo home_url(); ?>?s=<?php echo $_GET['s']; ?>&post_type=product">Products</a></li>
                            <?php } ?>
                            <?php if ( count ( $service_array ) > 0 ) { ?>
                            <li class="main-item"><a class="main-link" href="<?php echo home_url(); ?>?s=<?php echo $_GET['s']; ?>&post_type=service">Services</a></li>
                            <?php } ?>
                        </ul>
                        <?php get_template_part('templates/download-catalog'); ?>
                    </aside>
                </div>
                <div class="col-md-12 hidden-sm hidden-md hidden-lg">
                    <div class="search-filter-group text-center">
                        <label for="search-filters">Search Filter: </label>
                        <select id="search-filters">
                            <?php if(is_array($_GET['post_type'])){ ?>
                            <option value="<?php echo home_url(); ?>/?s=<?php echo $_GET['s']; ?>&post_type[]=product&post_type[]=service" selected>All</option>
                            <?php }else{ ?>
                            <option value="<?php echo home_url(); ?>/?s=<?php echo $_GET['s']; ?>&post_type[]=product&post_type[]=service">All</option>
                            <?php } ?>
                            <?php if($_GET['post_type'] == 'product'){ ?>
                            <option value="<?php echo home_url(); ?>/?s=<?php echo $_GET['s']; ?>&post_type=product" selected>Products</option>
                            <?php }else{ ?>
                            <option value="<?php echo home_url(); ?>/?s=<?php echo $_GET['s']; ?>&post_type=product">Products</option>
                            <?php } ?>
                            <?php if($_GET['post_type'] == 'service'){ ?>
                            <option value="<?php echo home_url(); ?>/?s=<?php echo $_GET['s']; ?>&post_type=service" selected>Services</option>
                            <?php }else{ ?>
                            <option value="<?php echo home_url(); ?>/?s=<?php echo $_GET['s']; ?>&post_type=service">Services</option>
                            <?php } ?>
                        </select>
                    </div>
                    <hr />
                </div>
                <?php //} ?>
                <div class="col-md-8 col-sm-8">
                    <div class="pull-left search-list-title hidden-xs">
                        <span>Results 1 of <?php echo $entire_posts_count; ?> of about <?php echo $wp_query->found_posts; ?>  for <?php echo get_search_query(); ?>.</span>
                    </div>
                    <div class="pull-right search-list-title text-right pagination-info-frame">
                        <span class="pagination-info">Page <?php echo $page_no = ( $paged == 0 )? 1: $paged; ?> of <?php echo $wp_query->max_num_pages; ?></span><span class="numeric-post-nav"><?php numeric_posts_nav(); ?></span>
                    </div>
                    <br />
                    <hr />
                    <?php while ( have_posts() ){ the_post(); ?>
                    <div class="search-result-item">
                        <h2 class="searh-result-item-title"><a href="<?php echo the_permalink() ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                    </div>
                    <?php } //END WHILE ?>
                    <hr />                    
                    <div class="pull-right search-list-title text-right pagination-info-frame bottom-pagination">
                        <span class="pagination-info">Page <?php echo $page_no = ( $paged == 0 )? 1: $paged; ?> of <?php echo $wp_query->max_num_pages; ?></span><span class="numeric-post-nav"><?php numeric_posts_nav(); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php 
    }else{
    ?>
    <main>
        <div class="responsive-search-page-form hidden-md hidden-lg">
            <div class="row">
                <div class="col-xs-12">
                    <form id="search" class="search-form" method="get" action="<?php echo home_url(); ?>">
                        <div class="inputs-container">
                            <input id="search_input" type="search" name="s" placeholder="Type in your search">
                            <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <?php get_template_part('templates/download-catalog'); ?>
                </div>
                <div class="col-md-9 col-sm-8">
                    <h1 class="nothing-found-title">Nothing found</h1>
                    <p class="sorry-not-found">Sorry, nothing matched your search criteria. Please try again with different keywords.</p>
                    <div class="hidden-xs">
                        <form id="search" class="search-form not-found" method="get" action="<?php echo home_url(); ?>">
                            <div class="inputs-container form-not-found">
                                <input id="not-found-input" type="search" name="s" placeholder="Type in your search" autofocus>
                                <button type="submit" class="search-button"><i class="zmdi zmdi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php } ?>
<?php get_footer(); ?>