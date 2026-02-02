<?php
// Подключение обработчика отправки форм
require 'inc/common.php';

// Подключение библиотеки обработки миниатюр
//require 'inc/BFI_Thumb.php';

// Подключение обработчика дополнительных типов записей
require 'inc/post-types.php';

// Подключение сервисных функций
require 'inc/services-functions.php';

// Подключение функций Woo дочерней темы
if ( function_exists( 'is_woocommerce' ) ) {
require 'woocommerce/wc-functions.php';
}

// Подключение функционала для хедера
require 'template-parts/rs-header/rs-header-functions.php';
//require 'template-parts/rs-header/st-header-functions.php';

// Подключение функционала для текстовых блоков
require 'template-parts/rs-text-block/rs-text-block-functions.php';

// Подключение функционала для блока Преимущества
require 'template-parts/rs-features/rs-features-functions.php';

// Подключение функционала для блока Преимущества 3 колонки
require 'template-parts/rs-features-3x/rs-features-3x-functions.php';

// Подключение функционала для блока Каталог
require 'template-parts/rs-services/rs-services-functions.php';

// Подключение функционала для слайдера
require 'template-parts/rs-slider/rs-slider-functions.php';

// Подключение функционала для блока Самые продаваемые
require 'template-parts/rs-best-sellers/rs-best-sellers-functions.php';

// Подключение функционала для блока Популярные
require 'template-parts/rs-popular/rs-popular-functions.php';

// Подключение функционала для блока Распродажа
require 'template-parts/rs-onsale/rs-onsale-functions.php';

// Подключение функционала для блока Новинки
require 'template-parts/rs-new-products/rs-new-products-functions.php';

// Подключение функционала для формы обратной связи
require 'template-parts/rs-form/rs-form-functions.php';

// Подключение функционала для блока Отзывы
require 'template-parts/rs-reviews/rs-reviews-functions.php';

// Подключение функционала для блока Новости
require 'template-parts/rs-news/rs-news-functions.php';

// Подключение функционала для блока Новости
require 'template-parts/rs-articles/rs-articles-functions.php';

// Подключение функционала для блока Наша команда
require 'template-parts/rs-team/rs-team-functions.php';

// Подключение функционала для блока Как мы работаем
require 'template-parts/rs-howworks/rs-howworks-functions.php';

// Подключение функционала для блока Предложения
require 'template-parts/rs-offers/rs-offers-functions.php';

// Подключение функционала для блока Преимущества с картинкой
require 'template-parts/rs-features-photo/rs-features-photo-functions.php';

// Подключение функционала для блока Цифры
require 'template-parts/rs-numbers/rs-numbers-functions.php';

// Подключение функционала для блока Свяжитесь с нами
require 'template-parts/rs-contactus/rs-contactus-functions.php';

// Подключение функционала для блока Цитата
require 'template-parts/rs-parallax-land/rs-parallax-land-functions.php';

// Подключение функционала для блока Партнёры
require 'template-parts/rs-partners/rs-partners-functions.php';

// Подключение функционала для блока Видео
require 'template-parts/rs-video/rs-video-functions.php';

// Подключение функционала для блока Тарифы
require 'template-parts/rs-price/rs-price-functions.php';

// Подключение функционала для блока Таймер
require 'template-parts/rs-counter/rs-counter-functions.php';

// Подключение функционала для блока Подписаться
require 'template-parts/rs-subscribe/rs-subscribe-functions.php';

// Подключение функционала для блока Фотогалерея
require 'template-parts/rs-photogallery/rs-photogallery-functions.php';

// Подключение функционала для блока Видеоролики
require 'template-parts/rs-video-new/rs-video-new-functions.php';

// Подключение функционала для страницы Галерея
require 'template-parts/rs-gallery/rs-gallery-functions.php';

// Подключение функционала для блока с переключателями
require 'template-parts/rs-tabs/rs-tabs-functions.php';

// Подключение функционала для блока Параллакс 1
require 'template-parts/rs-parallax-1/rs-parallax-1-functions.php';

// Подключение функционала для блока Параллакс 2
require 'template-parts/rs-parallax-2/rs-parallax-2-functions.php';

// Подключение функционала для блока Иконки с услугами
require 'template-parts/rs-services-icon/rs-services-icon-functions.php';

// Подключение функционала для блока Форма ОС с картнкой
require 'template-parts/rs-contact-land/rs-contact-land-functions.php';

// Подключение функционала для блока Рекоммендации
require 'template-parts/rs-recommendations/rs-recommendations-functions.php';

// Подключение функционала для блока наши проекты
require 'template-parts/rs-portfolio-slider/rs-portfolio-slider-functions.php';

// Подключение функционала для блока карусель фотографий
require 'template-parts/rs-carousel/rs-carousel-functions.php';

// Подключение функционала для футера
require 'template-parts/rs-footer/rs-footer-functions.php';

// Подключение функционала для блока Слайдер новый на главной
require 'template-parts/st-slider/stslider.php';

// Подключение функционала для блока новые Преимущества
require 'template-parts/st-advantage/st-advantage.php';

// Подключение функционала для блока новые Преимущества
require 'template-parts/st-partners/st-partners.php';

// Подключение функционала для блока новый Каталог
require 'template-parts/st-catalog/st-catalog.php';

add_action( 'template_redirect', 'rs_get_tpl_include' );
function rs_get_tpl_include(){
$get_template = get_page_template_slug( get_the_ID());
if($get_template =='template-allblocks.php'){
$file_path = locate_template( $get_template );
// Подключение функционала для шаблона страницы Все блоки
require 'template-parts/rs-page-allblocks/rs-page-allblocks-functions.php';
} else if ($get_template =='contacts.php'){
// Подключение функционала для шаблона страницы контакты
require 'template-parts/rs-page-contacts/rs-page-contacts-functions.php';
} else if ($get_template =='template-burger') {
// Подключение функционала для шаблона страницы бургер-меню
require 'template-parts/rs-page-burger-menu/rs-page-burger-menu-functions.php';
} else {


}
// Подключение функционала для шаблона основной страницы
require 'template-parts/rs-page-base/rs-page-base-functions.php';
}