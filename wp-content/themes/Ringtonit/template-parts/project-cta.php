   <?php
// Проверяем глобальные настройки и локальное отключение
$global_cta_enabled = carbon_get_theme_option('crb_global_cta_enabled');
$project_cta_disabled = carbon_get_post_meta(get_the_ID(), 'crb_project_cta_disabled');

// Если глобально включено и не отключено для проекта
if ($global_cta_enabled && !$project_cta_disabled):
    // Получаем значения (используем глобальные по умолчанию)
    $cta_title = carbon_get_post_meta(get_the_ID(), 'crb_project_cta_title') 
        ?: carbon_get_theme_option('crb_global_cta_title');
        
    $cta_button_text = carbon_get_post_meta(get_the_ID(), 'crb_project_cta_button_text') 
        ?: carbon_get_theme_option('crb_global_cta_button_text');
        
    $cta_button_url = carbon_get_post_meta(get_the_ID(), 'crb_project_cta_button_url') 
        ?: carbon_get_theme_option('crb_global_cta_button_url');
?>
<section class="project-cta">
     <?php render_page_overlay('cta'); ?>
    <div class="container">
        <div class="cta-content">
            <?php if ($cta_title): ?>
                <h2><?php echo esc_html($cta_title); ?></h2>
            <?php endif; ?>
            
            <?php if ($cta_button_text && $cta_button_url): ?>
                <a href="<?php echo esc_url($cta_button_url); ?>" class="cta-button">
                    <?php echo esc_html($cta_button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>