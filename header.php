<!DOCTYPE html>
<html class="no-js h-100" lang="ro">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <?php wp_head(); ?>

    <style>

        .main-navbar {
            background: <?php the_field( 'header_background_color', 'option' ); ?>
        }

        .menu-container .menu-list-link:before {
            border-top-color: <?php the_field( 'header_buttons_top_corner_color', 'option' ); ?>;
            border-right-color: <?php the_field( 'header_buttons_bottom_corner_color', 'option' ); ?>;
        }

        .menu-container .menu-list-link:after {
            border-bottom-color: <?php the_field( 'header_buttons_bottom_corner_color', 'option' ); ?>;
            border-left-color: <?php the_field( 'header_buttons_top_corner_color', 'option' ); ?>;
        }

        .hamburger:not(.collapsed) .hamburger-inner,
        .hamburger:not(.collapsed) .hamburger-inner::before,
        .hamburger:not(.collapsed) .hamburger-inner::after {
            background-color: <?php the_field( 'hamburger_color', 'option' ); ?>;
        }

        .hamburger-inner,
        .hamburger-inner::before,
        .hamburger-inner::after {
            background-color: <?php the_field( 'hamburger_color', 'option' ); ?>;
        }

        .navbar-brand .navbar-logo {
            background: <?php the_field( 'logo_background_color', 'option' ); ?>;
        }

        .navbar-brand .navbar-text {
            color: <?php the_field( 'logo_text_color', 'option' ); ?>;
        }

        .menu-container .menu-list-link {
            color: <?php the_field( 'header_link_color', 'option' ); ?>;
        }

        .menu-container .menu-list-link.active {
            color: <?php the_field( 'header_link_active_color', 'option' ); ?>;
        }
        
        <?php if ( have_rows( 'background_gradient_background', 'option' ) ) : ?>
           body {
            <?php while ( have_rows( 'background_gradient_background', 'option' ) ) : the_row(); ?>
                background: <?php the_sub_field( 'body_background_gradient_first_color' ); ?>;
                background: linear-gradient(to right, <?php the_sub_field( 'body_background_gradient_first_color' ); ?>, <?php the_sub_field( 'body_background_gradient_second_color' ); ?>);
            <?php endwhile; ?>
            }
        <?php endif; ?>

        <?php if ( have_rows( 'hero_container_background_gradient', 'option' ) ) : ?>
            <?php while ( have_rows( 'hero_container_background_gradient', 'option' ) ) : the_row(); ?>
                .hero-container {
                    background-image: linear-gradient( 112.5deg,  <?php the_sub_field( 'gradient_first_color' ); ?> 11.4%, <?php the_sub_field( 'gradient_second_color' ); ?> 60.2% );
                }
            <?php endwhile; ?>
        <?php endif; ?>

        .page-footer .contact-details, .page-footer .social-media {
            color: <?php the_field( 'footer_text_color', 'option' ); ?>;
        }
        
        .page-footer {
            background-color: <?php the_field( 'footer_background_color', 'option' ); ?>;
        }
        
        .page-footer .social-follow-button.facebook-messenger {
            background-image: url('http://halartcluj.com/wp-content/uploads/2019/12/facebook-messenger.png');
        }

        <?php if ( have_rows( 'anchors_styles', 'option' ) ) : ?>
            <?php while ( have_rows( 'anchors_styles', 'option' ) ) : the_row(); ?>
                a {
                    color: <?php the_sub_field( 'anchors_color' ); ?>;
                }

                a:hover {
                    color: <?php the_sub_field( 'anchors_color_hover' ); ?>
                }
            <?php endwhile; ?>
        <?php endif; ?>


        <?php if ( have_rows( 'inputs_styles', 'option' ) ) : ?>
            <?php while ( have_rows( 'inputs_styles', 'option' ) ) : the_row(); ?>

                .form-control {
                    background: linear-gradient(to right, <?php the_sub_field( 'input_active_color' ); ?>, <?php the_sub_field( 'input_active_color' ); ?>);
                    background-repeat: no-repeat;
                    background-size: 0%;
                }

                .form-control:focus {
                    border-color: <?php the_sub_field( 'input_border_color' ); ?>;
                }
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if ( have_rows( 'information_box_styles', 'option' ) ) : ?>
            <?php while ( have_rows( 'information_box_styles', 'option' ) ) : the_row(); ?>
                
                

                .info-box-body {
                    background: <?php the_sub_field( 'information_box_background_color' ); ?>;
                    border: 2px solid <?php the_sub_field( 'information_box_border_color' ); ?>
                }

            <?php endwhile; ?>
        <?php endif; ?>

        .section-container {
            background: <?php the_field( 'section_background_color', 'option' ); ?>;
        }

        .background-image-container {
            background: <?php the_field( 'background_image_overlay', 'option' ); ?>;
        }

        .container-img:after {
            background-color: <?php the_field( 'background_image_overlay', 'option' ); ?>;
        }
        
        .divider-wrapper .divider-transparent:before {
            background-image: linear-gradient(to right, transparent, <?php the_field( 'divider_color', 'option' ); ?>, transparent);
        }

        <?php if ( have_rows( 'button_light_simple', 'option' ) ) : ?>
            <?php while ( have_rows( 'button_light_simple', 'option' ) ) : the_row(); ?>

                .nav-light {
                    background-color: <?php the_sub_field( 'background_color' ); ?>;
                }

                .nav-light .btn-glass {
                    color: <?php the_sub_field( 'text_color' ); ?>;
                }
                .nav-light .btn-glass:hover,
                .nav-light .btn-glass:focus {
                    color: <?php the_sub_field( 'text_color_hover' ); ?>;
                    background-color: <?php the_sub_field( 'background_color_hover' ); ?>;
                    border-color: <?php the_sub_field( 'border_color_hover' ); ?>;

                }
                .nav-light .btn-glass:active {
                    box-shadow: 0 0 1em 0.5ex <?php the_sub_field( 'box_shadow_color_active' ); ?>;
                }

            <?php endwhile; ?>
        <?php endif; ?>
        
    </style>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>


</head>

<body class="h-100">
    <p class="browsehappy text-center">
        You are using an <strong>outdated</strong> browser. Please <a href="https://www.google.com/chrome/" class="font-weight-bold lead" rel="noreferrer noopener" target="_blank">upgrade your browser</a> to improve your experience.
    </p>

    <div id="content-main-container" class="h-100 flex-column justify-content-between">
        <header>
            <nav class="fixed-top shadow navbar navbar-expand-lg navbar-light fixed-top main-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand position-relative" href="<?php the_field( 'home_page_link', 'option' ); ?>">
                        <?php if ( get_field( 'logo_image_url', 'option' ) ) { ?>
                            <img class="navbar-logo" src="<?php the_field( 'logo_image_url', 'option' ); ?> "/>
                        <?php } ?>
                        <?php if(get_field( 'logo_text', 'option' ) != '') : ?>
                            <span class="navbar-text">
                                <?php the_field( 'logo_text', 'option' ); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <button class="navbar-toggler hamburger hamburger--elastic collapsed" type="button" data-toggle="collapse">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>

                    <div class="navbar-menu collapse navbar-collapse" id="navbar-collapse-menu">
                        <ul class="menu-container navbar-nav mx-auto">

                            <?php if ( have_rows( 'header_menu_links', 'option' ) ) : ?>
                                <?php while ( have_rows( 'header_menu_links', 'option' ) ) : the_row(); ?>
                                    <?php $header_menu_link = get_sub_field( 'header_menu_link' ); ?>
                                    <?php if ( $header_menu_link ) { ?>
                                        <li class="menu-list-item mx-1 mx-lg-2 mx-xl-3">
                                            <a 
                                                class="menu-list-link<?php echo $pagename == get_sub_field( 'header_link_page_slug' ) ? ' active' : '' ?>"
                                                href="<?php echo $header_menu_link['url']; ?>"
                                            >
                                            <?php echo $header_menu_link['title']; ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>