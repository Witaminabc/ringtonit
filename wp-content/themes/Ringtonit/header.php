<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="header__fixed">
            <div class="container">
                <div class="header__row">
                   <?php
                    $header_logo = carbon_get_theme_option('crb_header_logo');
                    if ($header_logo) : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo-link">
                            <img src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>" class="header__logo">
                        </a>
                    <?php endif; ?>
                    
                    <nav class="header__nav">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header_menu',
                            'menu_class' => 'header__nav-list',
                            'container' => false,
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                            'add_li_class' => 'header__nav-item',
                            'link_class' => 'header__nav-item-link'
                        ));
                        ?>
                    </nav>
                    
                    <div class="header__actions">
                        <button class="header__actions-btn btn">
                            <?php _e('contact us', 'rightonit'); ?>
                        </button>
                        <div class="header__burger-menu">
                            <span class="header__burger-line header__burger-line--first"></span>
                            <span class="header__burger-line header__burger-line--second"></span>
                            <span class="header__burger-line header__burger-line--third"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">