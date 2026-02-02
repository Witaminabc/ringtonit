<?php
/**
 * RightOnIT - Theme Functions
 * 
 * @package RightOnIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue theme scripts and styles with filemtime versioning
 */
// Подключаем стили и скрипты

if (!defined('ABSPATH')) {
    exit;
}

// 1. ПОДКЛЮЧАЕМ СТИЛИ
function rightonit_styles() {
    // Ваши локальные файлы (версия по времени изменения)
    wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), filemtime(get_template_directory() . '/assets/css/normalize.css'));
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_template_directory() . '/assets/css/style.css'));
    wp_enqueue_style('style-head', get_template_directory_uri() . '/assets/css/head-style.css', array(), filemtime(get_template_directory() . '/assets/css/head-style.css'));

    // Сторонние библиотеки (БЕЗ версий)
    wp_enqueue_style('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_style('aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css');

    // Google Fonts (Inter + Manrope пример)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Manrope:wght@400;700&display=swap');
}

// 2. ПОДКЛЮЧАЕМ СКРИПТЫ
function rightonit_scripts() {
    // Ваши локальные скрипты (версия по времени изменения)
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/main.js'), true);


    // Сторонние библиотеки (БЕЗ версий)
    wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('anime', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array(), null, true);
    wp_enqueue_script('aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', array(), null, true);

    // Инициализация AOS
    wp_add_inline_script('aos', 'AOS.init({ once: true });');
}

// 3. ПОДКЛЮЧАЕМ ВСЕ
add_action('wp_enqueue_scripts', 'rightonit_styles');
add_action('wp_enqueue_scripts', 'rightonit_scripts');

// 4. PRELOAD ДЛЯ ШРИФТОВ (опционально)
function rightonit_preload_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'rightonit_preload_fonts', 1);

add_action('wp_enqueue_scripts', 'enqueue_ajax_forms');
// Подключаем AJAX формы
function enqueue_ajax_forms() {  
    wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/assets/js/ajax.js', ['jquery'], null, true);
    // Делаем ajaxurl глобальной переменной, как требует WordPress
    wp_add_inline_script('custom-ajax', 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";', 'before');
}

require_once get_template_directory() . '/inc/theme-settings.php';
require_once get_template_directory() . '/inc/custom-post-type.php';
require_once get_template_directory() . '/inc/carbon-fields.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/cover-background.php';
require_once get_template_directory() . '/inc/ajax.php';






// Подключение обработчика отправки форм
require 'inc/old-blocks/common.php';

// Подключение библиотеки обработки миниатюр
//require 'inc/old-blocks/BFI_Thumb.php';

// Подключение обработчика дополнительных типов записей
require 'inc/old-blocks/post-types.php';

// Подключение сервисных функций
require 'inc/old-blocks/services-functions.php';



// Подключение функционала для блока Слайдер новый на главной
require 'template-parts/st-slider/stslider.php';

// Подключение функционала для блока hero на главной
require 'template-parts/rs-hero/rs-hero-functions.php';
// Подключение функционала для блока hero на главной
require 'template-parts/rs-intro/rs-intro-functions.php';

require 'template-parts/rs-advantages/rs-advantages.php';

require 'template-parts/rs-about/rs-about.php';

require 'template-parts/rs-choose-wise/rs-choose-wise.php';

require 'template-parts/rs-our-clients/rs-our-clients.php';

require 'template-parts/rs-contacts/rs-contacts.php';

require 'template-parts/rs-ready-trans/rs-ready-trans.php';

require 'template-parts/rs-projects/rs-projects.php';



add_action( 'template_redirect', 'rs_get_tpl_include' );
function rs_get_tpl_include(){

// Подключение функционала для шаблона основной страницы
    require 'template-parts/rs-page-base/rs-page-base-functions.php';
}


function custom_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        $query->set( 'posts_per_page', 12 );
    }
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );