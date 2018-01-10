<?php get_header(); ?>
<?php the_post(); ?>
<?php $prefix = 'sentry'; ?>
    <main>
        <section>
            <div class="contact-sidebar-background">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <aside>
			    <h1 class="page-sub-title contact-page-title visible-xs">Contact Us</h1>            
                            <div class="contact-sidebar">
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
                                <div class="contact-sidebar-location">
                                    <h2 class="contact-sidebar-title pull-down"><?php echo $location->post_title; ?></h2>
                                    <p class="contact-address"><?php echo get_post_meta( $location->ID, $prefix . 'location_adress', true); ?></p>
				    <p class="location-card-address"><?php echo get_post_meta( $location->ID, $prefix . 'location_city', true); ?></p>
                                    <p class="contact-phone"><a href="tel:<?php echo get_post_meta( $location->ID, $prefix . 'location_phone', true); ?>"><?php echo get_post_meta( $location->ID, $prefix . 'location_phone', true); ?></a></p>
                                </div>
                                <?php } ?>
                                <div class="hidden-xs">
                                <?php get_template_part('templates/download-catalog'); ?>
                                </div>
                            </div>
                        </aside> 
                    </div>
                    <div id="form-container" class="col-sm-6 col-md-6 col-md-offset-1">                        
                        <article>
                            <h1 class="page-sub-title contact-page-title hidden-xs">Contact Us</h1>
                            <p class="contact-form-instructions">Please complete the following information and we will get back to you shortly.</p>
                            <form id="contact-form" class="contact-form">
                                <div class="group">      
                                    <input type="text" name="fname" required>
                                    <span class="highlight"></span>
                                    
                                    <label>First Name*</label>
                                </div>
                                <div class="group">      
                                    <input type="text" name="lname" required>
                                    <span class="highlight"></span>
                                    
                                    <label>Last Name*</label>
                                </div>
                                <div class="group">      
                                    <input type="email" name="email" required>
                                    <span class="highlight"></span>
                                    
                                    <label>E-mail Address*</label>
                                </div>
                                <div class="group">      
                                    <input type="tel" pattern="[0-9]" name="phone" required>
                                    <span class="highlight"></span>
                                    
                                    <label>Phone Number*</label>
                                </div>
                                <div class="group">      
                                    <input type="text" name="company" required>
                                    <span class="highlight"></span>
                                    
                                    <label>Company*</label>
                                </div>
                                <div class="group">      
                                    <input type="text" name="region" required>
                                    <span class="highlight"></span>
                                    
                                    <label>Region*</label>
                                </div>
                                <div class="group">      
                                    <textarea name="inquiry" required></textarea>
                                    <span class="highlight"></span>
                                    
                                    <label>Your message</label>
                                </div>
                                <div id="message-wrapper"></div>
                                <p><strong>All fields are required</strong></p>
                                <input id="submit-btn" type="submit" class="contact-sumbit pull-right" value="Send">
                            </form>
                        </article>
                    </div>
                </div>
                <div class="row visible-xs">
                <?php get_template_part('templates/download-catalog'); ?>
                </div>
            </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>