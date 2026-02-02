<?php
function custom_breadcrumbs() {
    // Получаем текущий пост/страницу
    global $post;
    
    echo '<nav class="breadcrumbs"><ul class="breadcrumbs__list">';
    
    // Главная страница
    echo '<li class="breadcrumbs__item"><a href="' . esc_url(home_url('/')) . '" class="breadcrumbs__link">' . __('Home', 'textdomain') . '</a></li>';
    
    if (is_single()) {
        // Для записей (постов)
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category = $categories[0];
            echo '<li class="breadcrumbs__item"><a href="' . esc_url(get_category_link($category->term_id)) . '" class="breadcrumbs__link">' . esc_html($category->name) . '</a></li>';
        }
        echo '<li class="breadcrumbs__item"><span class="breadcrumbs__current">' . esc_html(get_the_title()) . '</span></li>';
    } elseif (is_page()) {
        // Для страниц
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                echo '<li class="breadcrumbs__item"><a href="' . esc_url(get_permalink($ancestor)) . '" class="breadcrumbs__link">' . esc_html(get_the_title($ancestor)) . '</a></li>';
            }
        }
        echo '<li class="breadcrumbs__item"><span class="breadcrumbs__current">' . esc_html(get_the_title()) . '</span></li>';
    } elseif (is_category()) {
        // Для категорий
        $category = get_category(get_query_var('cat'));
        echo '<li class="breadcrumbs__item"><span class="breadcrumbs__current">' . esc_html($category->name) . '</span></li>';
    } elseif (is_search()) {
        // Для страницы поиска
        echo '<li class="breadcrumbs__item"><span class="breadcrumbs__current">' . __('Search Results', 'textdomain') . '</span></li>';
    } elseif (is_404()) {
        // Для 404 страницы
        echo '<li class="breadcrumbs__item"><span class="breadcrumbs__current">' . __('404', 'textdomain') . '</span></li>';
    }
    
    echo '</ul></nav>';
}