<?php $prefix = 'sentry'; ?>                    
                    <div class="col-md-12 post-meta-wrapper">
                    <?php
                        $product_meta = get_post_meta($post->ID, $prefix.'description', true);
                        echo $product_meta;
                    ?>
		            </div>
                    <?php 
                        if (has_post_thumbnail())
                        { 
                    ?>
                    <div class="col-md-6 text-center">
                        <?php echo the_post_thumbnail('full', array( 'class' => 'img-responsive')); ?>
                    </div>
                    <?php 
                        }        
                    ?>
                    <div class="col-md-6 post-meta-wrapper">
                        <?php
                            $product_meta = get_post_meta($post->ID, $prefix.'features', true);
                            if (!empty($product_meta)){
                                echo $product_meta;
                            }
                        ?>
                    </div>
		            <div class="col-md-12">
                        <!-- the short dscription -->
                        <?php
                            $product_meta = get_post_meta($post->ID, $prefix.'shor_description', true);
                            if (!empty($product_meta)){
                                echo '<div class="col-md-12 single-product-short-description">';
                                echo $product_meta;
                                echo '</div>';
                            }
                        ?>
                        
                    </div>