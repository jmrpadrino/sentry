<?php get_header(); ?>
<?php the_post(); ?>
<?php $prefix = 'sentry'; ?>
<?php $currect_location_ID =  get_the_id(); ?>
        <section id="map-navigation">
            <nav>
                <div class="location-navigation-area">
                   <div class="container">
                      <div class="row">
                          <div class="col-md-12 location-navbar">
                              <p>
                                    <?php
                                        $prev_p = get_previous_post( false, '', 'loc' );
                                        if (empty($prev_p)){
                                            $args = array(
                                                'post_type' => 'location',
                                                'posts_per_page' => -1,
                                                'orderby' => 'ID',
                                                'order' => 'ASC'
                                            );
                                            $post_items = get_posts( $args );
                                            $prev = get_post_permalink( $post_items[count($post_items)-1]->ID , $leavename = false, $sample = false );
                                        }else{
                                            $prev = get_post_permalink( $prev_p->ID , $leavename = false, $sample = false );
                                        }
                                    ?>
                                    <a class="location-nav-link" href="<?php echo $prev; ?>"><i class="zmdi zmdi-chevron-left"></i></a>
                                    <span class="nav-location-name"><?php the_title(); ?></span>
                                    <?php 
                                        $next_p = get_next_post( false, '', 'loc' );
                                        if (empty($next_p)){
                                            $args = array(
                                                'post_type' => 'location',
                                                'posts_per_page' => 1,
                                                'orderby' => 'ID',
                                                'order' => 'ASC'
                                            );
                                            $post_items = get_posts( $args );   
                                            foreach( $post_items as $post_item ){
                                                $next = get_post_permalink( $post_item->ID , $leavename = false, $sample = false );
                                            }
                                        }else{
                                            $next = get_post_permalink( $next_p->ID , $leavename = false, $sample = false );
                                        }
                                    ?>
                                    <a class="location-nav-link" href="<?php echo $next; ?>"><i class="zmdi zmdi-chevron-right"></i></a>
                              </p>
                              <span class="goto-googl-maps-icon pull-right hidden-xs">
                                  <a href="<?php echo get_post_meta( $currect_location_ID, $prefix . 'location_gmurl', true); ?>" title="View on Google Maps" target="_blank">
                                  </a>
                              </span>
                          </div>
                      </div>
                   </div>
                </div>
            </nav>
            <div id="location-map-area" class="location-map-area"></div>
            <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD_dM6f8DtpITbtLk1iFd6F_EnBW24RDsE&extension=.js'></script> 
            <script> 
                
                var markericon = '<?php echo get_template_directory_uri(); ?>/images/Various_MarkerMap2.png';
                google.maps.event.addDomListener(window, 'load', init);
                var map;
                function init() {
                    var mapOptions = {
                        center: new google.maps.LatLng(<?php echo get_post_meta( get_the_ID(), $prefix . 'location_coords', true); ?>),
                        zoom: 17,
                        zoomControl: true,
                        disableDoubleClickZoom: false,
                        mapTypeControl: false,
                        scaleControl: true,
                        scrollwheel: false,
                        panControl: false,
                        streetViewControl: false,
                        draggable : true,
                        overviewMapControl: false,
                        overviewMapControlOptions: {
                            opened: false,
                        },
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [{"featureType":"all","elementType":"all","stylers":[{"saturation":-100},{"gamma":0.5}]}],
                    }
                    var mapElement = document.getElementById('location-map-area');
                    var map = new google.maps.Map(mapElement, mapOptions);
                    var eaglefort_marker = new google.maps.Marker({
                        icon: markericon,
                        position: new google.maps.LatLng(<?php echo get_post_meta( get_the_ID(), $prefix . 'location_coords', true); ?>), 
                        map: map,
                        title: '<?php echo get_the_title(); ?>'
                    });
            }
            </script>
        </section>
        <section id="location-cards">
            <div class="location-cards-area">
                <?php 
                    $args = array(
                        'post_type' => 'location',
                        'posts_per_page' => -1,
                        'orderby' => 'ID',
                        'order' => 'ASC'
                    );
                    $locations = get_posts( $args );
                    //var_dump($locations);
                    foreach( $locations as $location ){
                ?>
                <div class="location-card">
                    <article>
                        <header>
                            <a class="location-anchor" href="<?php echo $location->guid; ?>">
                <?php if($location->ID == $currect_location_ID){ ?>
                            <h2 class="location-card-title active"><?php echo $location->post_title; ?></h2>
                <?php }else{ ?>
                            <h2 class="location-card-title"><?php echo $location->post_title; ?></h2>
                <?php } //end if ?>
                            </a>
                        </header>
                        <p class="location-card-address"><?php echo get_post_meta( $location->ID, $prefix . 'location_adress', true); ?></p>
                        <p class="location-card-address"><?php echo get_post_meta( $location->ID, $prefix . 'location_city', true); ?></p>
                        <p class="location-card-phone"><a href="tel:<?php echo get_post_meta( $location->ID, $prefix . 'location_phone', true); ?>"><?php echo get_post_meta( $location->ID, $prefix . 'location_phone', true); ?></a></p>
                        <footer>
                            <a href="<?php echo get_post_meta( $location->ID, $prefix . 'location_gmurl', true); ?>" target="_blank" alt="Sentry Location Address" class="location-card-direction-link">Directions</a>
                        </footer>
                    </article>
                </div>
                <?php } //End foreach ?>     
            </div>     
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php edit_post_link( __( '<span class="fa fa-edit"></span> Edit location "'. get_the_title() .'"', 'sentrywellheadsystem' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
            </div>
        </div>
<?php get_footer(); ?>