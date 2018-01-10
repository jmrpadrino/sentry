<?php session_start(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Webcreek">
        <title>Page not found | 404 | Sentry Wellhead Systems</title>
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon-152x152.png" />
        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png" sizes="16x16" />
        <meta name="application-name" content="Sentry Wellhead System"/>
        <meta name="msapplication-TileColor" content="#FF3C00" />
        <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/images/mstile-144x144.png" />
        <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
        <style>
            body{
                background: #ec2024;
                background: -moz-linear-gradient(left, #ec2024 1%, #f07721 100%);
                background: -webkit-linear-gradient(left, #ec2024 1%,#f07721 100%);
                background: linear-gradient(to right, #ec2024 1%,#f07721 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ec2024', endColorstr='#f07721',GradientType=1 );
                color: white;
            }
            .error-404-title{
                font-size: 120px;
                font-weight: 700;
                margin-top: 80px;
            }
            .error-404-subtitle{
                font-size: 60px;
                margin: 0px;
                margin-bottom: 40px;
            }
            .error-404-subtitle + p{
                margin-bottom: 40px;
            }
            .goto-button{
                padding: 12px 12px;
                text-transform: uppercase;
                font-weight: 800;
                color: white;
                border: 2px solid white;
                display: block;
                max-width: 135px;
                margin: 0 auto;
                
            }
            .goto-button,.goto-button:hover,.goto-button:active,.goto-button:focus{
                text-decoration: none;
                color: white;
            }
            .sentry-404-bottom-logo{
                margin: 0 auto;
                margin-top: 80px;
                display: block;
                max-width: 280px;
            }
        </style>
    </head>
    <body id="top" <?php body_class(); ?>>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="error-404-title">404</h1>
                    </div>
                </div>
            </div>
        </header>
        <main>
           <div class="container">
               <div clas="row">
                   <div class="col-md-12 text-center">
                        <h2 class="error-404-subtitle">Oops, something went wrong</h2>
                        <p>This page you are looking for either was moved, <br />removed or doesn't exist at all.</p>
                       <a class="goto-button" href="#" onclick="window.history.back()">Go Back</a>
                   </div>
               </div>
           </div>
        </main>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a class="sentry-404-bottom-logo" href="<?php echo home_url(); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/Logo-Sentry_white_login_form_responsive.png" alt="Sentry Wellhead System">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>