<?php
// Подключение стилей
add_action( 'wp_enqueue_scripts', 'style_rs_header_theme', 11 );
function style_rs_header_theme() {
    //wp_enqueue_style( 'top-header', get_stylesheet_directory_uri().'/template-parts/rs-header/css/rs-top-header.css');
//    wp_enqueue_style( 'menu-cart', get_stylesheet_directory_uri().'/template-parts/rs-header/css/rs-menu-cart.css');
        wp_enqueue_style( 'menu-st', get_stylesheet_directory_uri().'/template-parts/rs-header/css/menu-st.css');

}

// Отключение лишних областей меню
function wpse_remove_parent_theme_locations() {
    unregister_nav_menu('secondary');
}
add_action( 'after_setup_theme', 'wpse_remove_parent_theme_locations', 20 );

// Отключение блоков хедера родительской темы
function delete_storefront_header() {
    remove_action('storefront_header', 'storefront_header_container', 0);
    remove_action('storefront_header', 'storefront_skip_links', 5);
    remove_action('storefront_header', 'storefront_social_icons', 10);
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_secondary_navigation', 30);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_header', 'storefront_header_container_close', 41);
    remove_action('storefront_header', 'storefront_primary_navigation_wrapper', 42);
    remove_action('storefront_header', 'storefront_primary_navigation', 50);
    remove_action('storefront_header', 'storefront_header_cart', 60);
    remove_action('storefront_header', 'storefront_primary_navigation_wrapper_close', 68);
};
add_action( 'init', 'delete_storefront_header', 1);

// Добавление новых блоков для хедера
function add_storefront_header() {
//   if(is_active_sidebar( 'top' )){
//        add_action('storefront_header', 'storefront_header_top_info_child', 0);
//    }
//	add_action('storefront_header', 'storefront_primary_navigation_wrapper_child', 42);
//	add_action('storefront_header', 'storefront_primary_navigation_logo_child', 45);
//	add_action('storefront_header', 'storefront_primary_navigation_child', 50);
	add_action('storefront_header', 'storefront_header_cart_child', 60);
//    add_action('storefront_header', 'rs_header_login', 61);
//    add_action('storefront_header', 'rs_header_search', 62);
//    add_action('storefront_header', 'rs_modal_form', 0);
//	add_action('storefront_header', 'storefront_primary_navvvvigation_wrapper_close_child', 68);
    	add_action('storefront_header', 'storefront_primary_st', 12);


}
add_action( 'init', 'add_storefront_header', 2);


function storefront_primary_st(){
    ?>
    <header class="site-header">
        <!-- Главное изображение -->
        <div class="header-hero">
            <img src="https://cdn-ru.bitrix24.ru/b21003248/landing/3da/3da43e0a8ac900fb0127144248479bb4/oblozhka_itog_1x.png"
                 alt="СтопХимия - экологичные продукты без химии"
                 class="hero-image">
        </div>

        <!-- Основная навигация -->
        <div class="main-navvvv">
            <div class="navvvv-container">

                <!-- Основное меню -->
                <div class="navvvv-menu">
                    <!-- Кнопка каталога -->

                    <?php
                    wp_nav_menu (
                        array (
                            'theme_location'  => 'primary',
                            'menu_class' => 'navvvv-links',
                            'fallback_cb' => '__return_empty_string'
                        ));
                    ?>
                </div>

                <!-- Контакты и соцсети -->
                <div class="navvvv-contacts">
                    <!-- Контактная информация -->
                    <div class="contact-info">
                        <a href="tel:+79181133510" class="contact-link">+7 (918) 113-35-10</a>
                        <a href="mailto:stophimiy@mail.ru" class="contact-link">stophimiy@mail.ru</a>
                    </div>
                    <button class="mobile-menu-toggle" aria-label="Открыть меню">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
<?php
}

// Подключение мини-корзины
function storefront_header_cart_child() {
    if ( storefront_is_woocommerce_activated() ) {
        include ('mini-cart.php');
    }
}