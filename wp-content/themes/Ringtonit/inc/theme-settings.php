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
 * Theme setup
 */
function rightonit_setup() {
    // Register menus
    register_nav_menus(array(
        'header_menu' => __('Верхнее меню', 'rightonit'),
        'footer_menu' => __('Основное нижнее меню', 'rightonit'),
        'services_menu' => __('Меню услуг', 'rightonit'),
        'projects_menu' => __('Меню проектов', 'rightonit')
    ));
    
    // Enable menu item classes support
    add_filter('nav_menu_css_class', 'rightonit_menu_item_classes', 10, 4);
}
add_action('after_setup_theme', 'rightonit_setup');

/**
 * Custom menu item classes handler (для <li> элементов)
 */
function rightonit_menu_item_classes($classes, $item, $args, $depth) {
    // Очищаем все стандартные классы
    $classes = array();
    
    // Добавляем базовые классы в зависимости от расположения меню
    if ($args->theme_location == 'header_menu') {
        $classes[] = 'header__nav-item';
    } elseif (in_array($args->theme_location, array('footer_menu', 'services_menu', 'projects_menu'))) {
        $classes[] = 'footer-menu__item';
    }
    
    // Добавляем кастомные классы из админки
    $custom_classes = get_post_meta($item->ID, '_menu_item_classes', true);
    if ($custom_classes) {
        $custom_classes = is_string($custom_classes) ? explode(' ', $custom_classes) : (array)$custom_classes;
        $classes = array_merge($classes, array_map('sanitize_html_class', $custom_classes));
    }
    
    return $classes;
}

/**
 * Настройка классов для ссылок меню (для <a> элементов)
 */
function rightonit_menu_link_attributes($atts, $item, $args) {
    // Очищаем все стандартные классы
    $atts['class'] = '';
    
    // Добавляем базовые классы в зависимости от расположения меню
    if ($args->theme_location == 'header_menu') {
        $atts['class'] = 'header__nav-item-link';
    } elseif (in_array($args->theme_location, array('footer_menu', 'services_menu', 'projects_menu'))) {
        $atts['class'] = 'footer-menu__link';
    }
    
    // Добавляем кастомные классы для ссылки
    $link_classes = get_post_meta($item->ID, '_menu_item_link_classes', true);
    if ($link_classes) {
        $link_classes = is_string($link_classes) ? explode(' ', $link_classes) : (array)$link_classes;
        $atts['class'] .= ' ' . implode(' ', array_map('sanitize_html_class', $link_classes));
    }
    
    return $atts;
}
add_filter('nav_menu_link_attributes', 'rightonit_menu_link_attributes', 10, 3);

/**
 * Поле для кастомных классов ссылок в админке
 */
function rightonit_menu_item_link_classes_field($item_id, $item, $depth, $args) {
    $classes = get_post_meta($item->ID, '_menu_item_link_classes', true);
    ?>
    <div class="field-link-classes description-wide">
        <label for="edit-menu-item-link-classes-<?php echo $item_id; ?>">
            <?php _e('Link CSS Classes', 'rightonit'); ?><br />
            <input type="text" id="edit-menu-item-link-classes-<?php echo $item_id; ?>" 
                   class="widefat code" 
                   name="menu-item-link-classes[<?php echo $item_id; ?>]" 
                   value="<?php echo esc_attr($classes); ?>" />
        </label>
    </div>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'rightonit_menu_item_link_classes_field', 10, 4);

/**
 * Сохраняем кастомные классы для ссылок
 */
function rightonit_save_menu_item_link_classes($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu-item-link-classes'][$menu_item_db_id])) {
        $classes = $_POST['menu-item-link-classes'][$menu_item_db_id];
        $sanitized = array_filter(array_map('sanitize_html_class', explode(' ', $classes)));
        update_post_meta($menu_item_db_id, '_menu_item_link_classes', implode(' ', $sanitized));
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_link_classes');
    }
}
add_action('wp_update_nav_menu_item', 'rightonit_save_menu_item_link_classes', 10, 2);





/**
 * Разрешить загрузку SVG файлов
 */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Исправить отображение SVG в медиабиблиотеке
 */
function fix_svg() {
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'fix_svg');

/**
 * Добавить проверку безопасности для SVG
 */
function svg_sanitizer($file) {
    if ($file['type'] === 'image/svg+xml') {
        $svg_content = file_get_contents($file['tmp_name']);
        $svg_content = preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/i', '', $svg_content);
        
        file_put_contents($file['tmp_name'], $svg_content);
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'svg_sanitizer');


// function rightonit_admin_restrict_by_ip() {
//     // Убедитесь, что это именно ваш текущий IP!
//     $allowed_ips = ['127.0.0.1', '45.83.94.222']; // Можно добавить несколько IP через запятую
    
//     // Более точное определение IP (учёт прокси и облачных сервисов)
//     $user_ip = '';
//     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//         $user_ip = $_SERVER['HTTP_CLIENT_IP'];
//     } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//         $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
//         $user_ip = trim($ip_list[0]);
//     } else {
//         $user_ip = $_SERVER['REMOTE_ADDR'] ?? '';
//     }

//     // Для отладки - покажет ваш IP в админке
//     if (is_admin() && current_user_can('administrator')) {
//         add_action('admin_notices', function() use ($user_ip) {
//             echo '<div class="notice notice-warning"><p>Ваш текущий IP: <strong>' . esc_html($user_ip) . '</strong></p></div>';
//         });
//     }

//     // Если IP не в списке разрешённых
//     if (!in_array($user_ip, $allowed_ips)) {
//         // Удаление меню
//         add_action('admin_menu', function() {
//             remove_menu_page('plugins.php');
//             remove_menu_page('tools.php');
//             remove_menu_page('users.php');
//             remove_menu_page('ai1wm_export');
            
//             remove_submenu_page('themes.php', 'theme-editor.php');
//             remove_submenu_page('plugins.php', 'plugin-editor.php');
//         }, 999);

//         // Блокировка доступа
//         add_action('admin_init', function() {
//             $current_page = basename($_SERVER['SCRIPT_NAME']);
//             $current_subpage = $_GET['page'] ?? '';

//             $blocked = [
//                 'pages' => [
//                     'plugin-editor.php',
//                     'theme-editor.php',
//                     'plugins.php',
//                     'tools.php',
//                     'users.php',
//                     'user-edit.php',
//                     'user-new.php',
//                     'profile.php'
//                 ],
//                 'subpages' => [
//                     'ai1wm_export',
//                     'ai1wm_import',
//                     'ai1wm_backups'
//                 ]
//             ];

//             // Исключения (если нужно разрешить доступ к определённым страницам)
//             $exceptions = [
//                 'subpages' => [
//                     'crb_carbon_fields_container_'
//                 ]
//             ];

//             $is_exception = false;
//             foreach ($exceptions['subpages'] as $exception) {
//                 if (strpos($current_subpage, $exception) === 0) {
//                     $is_exception = true;
//                     break;
//                 }
//             }

//             if (!$is_exception && 
//                 (in_array($current_page, $blocked['pages']) || 
//                  in_array($current_subpage, $blocked['subpages']))) {
//                 wp_die('Доступ разрешён только с IP администратора. Ваш IP: ' . $user_ip);
//             }
//         });
//     }
// }
// // Более ранний хук для проверки
// add_action('init', 'rightonit_admin_restrict_by_ip', 1);