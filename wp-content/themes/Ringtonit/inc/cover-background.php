
<?php
function render_page_overlay($key) {
    $img_id     = carbon_get_theme_option("{$key}_page_image");
    $img_url    = $img_id ? wp_get_attachment_image_url($img_id, 'large') : '';
    $filter     = carbon_get_theme_option("{$key}_page_image_filter");
    $custom_css = carbon_get_theme_option("{$key}_page_image_custom_css");

    echo "<!-- 🔎 Ключ: {$key} -->";

    if (!$img_url) {
        echo "<!-- ⚠️ Нет изображения для ключа {$key} -->";
        return;
    }

    $style = '';

    switch ($filter) {
        case 'contrast':  $style .= 'filter: contrast(1.2);'; break;
        case 'blur':      $style .= 'filter: blur(2px);';     break;
        case 'grayscale': $style .= 'filter: grayscale(1);';  break;
        case 'sepia':     $style .= 'filter: sepia(1);';      break;
        case 'invert':    $style .= 'filter: invert(1);';     break;
    }

    if (!empty($custom_css)) {
        $style .= $custom_css;
    }

    echo '<img 
        src="' . esc_url($img_url) . '" 
        alt="' . esc_attr($key . ' background') . '" 
        class="background-section-img" 
        style="' . esc_attr($style) . '"
    >';
}
