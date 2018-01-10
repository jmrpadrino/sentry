<?php
    $prefix = 'sentry';
    $contacto = get_page_by_path('contact');
    $link = get_post_meta( $contacto->ID, $prefix.'catalogue', true);
    //$link = wp_get_attachment_url( $link );
?>
                    <div class="catalog-download-card">
                        <a href="<?php echo $link; ?>" target="_blank" alt="Sentry Wellhead Systems Catalog">
                            <div class="catalog-download-card">
                                <div class="catalog-thumbnail">
                                    <div class="catalog-thumbnail-mask"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/DownloadIcon.png" alt="Sentry Wellhead Systems Catalog download"></div>
                                    <img class="catalog-img-thumb" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Image_1.png" width="230" alt="Sentry Wellhead Systems Catalog download">
                                </div>
                                <div class="catalog-download-button">
                                    <span>Download PDF Catalog</span>
                                </div>
                            </div>
                        </a>
                    </div>