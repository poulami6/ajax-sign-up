<?php ob_start(); ?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php
            global $page, $paged;
            wp_title( '|', true, 'right' );
        ?>
    </title>

    <?php sd_favicon(); ?>

    <?php wp_head(); ?>    

</head>

<body <?php body_class(); ?> >
<div id="page" class="site">
        <div class="site-inner">
        <!-- header -->
            <header id="masthead" class="site-header">
                <div class="container">
                    <div class="site-header-main">
                        <div class="site-branding">
                            <div class="site-title">
                                <a href="javascript:void(0);" rel="home">
                                    <img src="<?php echo get_field('logo','option'); ?>" alt="">
                                </a>
                            </div>
                        </div>
                        <nav id="site-navigation" class="main-navigation">
                           <?php 
                                $args = array(
                                    'theme_location' => 'main-menu',
                                    'menu_class' => 'primary-menu',
                                    'container'   => 'ul',
                                    'container_id' => 'menu-main-menu'
                                );
                                wp_nav_menu( $args ); 
                            ?>
                        </nav>
                        <a href="javascript:void(0);" class="toggleMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </header>    