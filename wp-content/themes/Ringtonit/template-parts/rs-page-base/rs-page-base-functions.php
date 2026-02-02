<?php

// Подключить стили для основной страницы
add_action( 'wp_enqueue_scripts', 'style_rs_page_base_theme', 11);
function style_rs_page_base_theme() {
	wp_enqueue_style( 'rs-page-base', get_stylesheet_directory_uri().'/template-parts/rs-page-base/css/rs-page-base.css');
}

// Вывод дополнительных блоков в шаблоне


//top block
add_action('template_on_rs_hero', 'rs_hero_finctions');
//top intro

add_action('template_on_rs_intro', 'rs_intro_finctions');

add_action('template_on_rs_advantages', 'rs_advantages_functions');

add_action('template_on_rs_about', 'rs_about_functions');

add_action('template_on_rs_choose_wise', 'rs_choose_wise_functions');

add_action('template_on_rs_our_clients', 'rs_our_clients_functions');

add_action('template_on_rs_contacts', 'rs_contacts_functions');

add_action('template_on_rs_ready_trans', 'rs_ready_trans_functions');

add_action('template_on_rs_ready_trans', 'rs_ready_trans_functions');

add_action('template_on_rs_projects', 'rs_projects_functions');

