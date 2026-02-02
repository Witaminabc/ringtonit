<?php
/**
 * Создание кастомных типов записей и таксономий
 */

// 1. Тип записи "Проекты"
function rightonit_register_projects_cpt() {
    $labels = array(
        'name'                  => __('Проекты', 'rightonit'),
        'singular_name'         => __('Проект', 'rightonit'),
        'menu_name'             => __('Проекты', 'rightonit'),
        'add_new'               => __('Добавить проект', 'rightonit'),
        'add_new_item'          => __('Добавить новый проект', 'rightonit'),
        'edit_item'             => __('Редактировать проект', 'rightonit'),
        'new_item'              => __('Новый проект', 'rightonit'),
        'view_item'             => __('Просмотреть проект', 'rightonit'),
        'view_items'            => __('Просмотреть проекты', 'rightonit'),
        'search_items'          => __('Искать проекты', 'rightonit'),
    );

    $args = array(
        'label'                 => __('Проекты', 'rightonit'),
        'labels'                => $labels,
        'description'           => __('Портфолио наших работ', 'rightonit'),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'query_var'            => true,
        'rewrite'              => array('slug' => 'projects'),
        'capability_type'      => 'post',
        'has_archive'          => true,
        'hierarchical'         => false,
        'menu_position'        => 20,
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'        => true,
    );

    register_post_type('project', $args);

    // Таксономия "Категории проектов"
    register_taxonomy(
        'project_category',
        'project',
        array(
            'label' => __('Категории проектов', 'rightonit'),
            'rewrite' => array('slug' => 'project-category'),
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'rightonit_register_projects_cpt');

// 2. Тип записи "Услуги"
function rightonit_register_services_cpt() {
    $labels = array(
        'name'                  => __('Услуги', 'rightonit'),
        'singular_name'         => __('Услуга', 'rightonit'),
        'menu_name'             => __('Услуги', 'rightonit'),
        'add_new'               => __('Добавить услугу', 'rightonit'),
        'add_new_item'          => __('Добавить новую услугу', 'rightonit'),
        'edit_item'             => __('Редактировать услугу', 'rightonit'),
        'new_item'              => __('Новая услуга', 'rightonit'),
        'view_item'             => __('Просмотреть услугу', 'rightonit'),
        'view_items'            => __('Просмотреть услуги', 'rightonit'),
        'search_items'          => __('Искать услуги', 'rightonit'),
    );

    $args = array(
        'label'                 => __('Услуги', 'rightonit'),
        'labels'                => $labels,
        'description'           => __('Наши услуги', 'rightonit'),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'query_var'            => true,
        'rewrite'              => array('slug' => 'services'),
        'capability_type'      => 'post',
        'has_archive'          => true,
        'hierarchical'         => false,
        'menu_position'        => 21,
        'menu_icon'           => 'dashicons-admin-tools',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'        => true,
    );

    register_post_type('service', $args);

    // Таксономия "Категории услуг"
    register_taxonomy(
        'service_category',
        'service',
        array(
            'label' => __('Категории услуг', 'rightonit'),
            'rewrite' => array('slug' => 'service-category'),
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'rightonit_register_services_cpt');

// 3. Создаем страницы архивов при активации темы
function rightonit_create_cpt_pages() {
    // Страница архивов проектов
    $projects_page = array(
        'post_title'    => __('Наши проекты', 'rightonit'),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'page_template' => 'template-projects.php'
    );
    
    $projects_page_id = wp_insert_post($projects_page);
    update_option('projects_page_id', $projects_page_id);

    // Страница архивов услуг
    $services_page = array(
        'post_title'    => __('Наши услуги', 'rightonit'),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'page_template' => 'template-services.php'
    );
    
    $services_page_id = wp_insert_post($services_page);
    update_option('services_page_id', $services_page_id);
}
register_activation_hook(__FILE__, 'rightonit_create_cpt_pages');

// 4. Шаблоны для архивов
function rightonit_cpt_templates($template) {
    if (is_post_type_archive('project')) {
        $new_template = locate_template(array('template-projects.php'));
        if ('' != $new_template) {
            return $new_template;
        }
    }
    
    if (is_post_type_archive('service')) {
        $new_template = locate_template(array('template-services.php'));
        if ('' != $new_template) {
            return $new_template;
        }
    }
    
    return $template;
}
add_filter('template_include', 'rightonit_cpt_templates');

// Добавляем поддержку миниатюр
add_theme_support('post-thumbnails');