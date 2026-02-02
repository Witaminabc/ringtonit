<?php get_header(); ?>
  <section class="archive-top single-page-top">
        <div class="container">
            <div class="archive-header single-page-header">
                <?php custom_breadcrumbs(); ?>
            </div>
        
        </div>
    </section>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-template'); ?>>
  <div class="post-container container">
    
  
    
    <div class="post-content-wrapper">
      <!-- Блок с изображением -->

<!--        <div class="post-image-block">-->
<!--            --><?php //if (has_post_thumbnail()) : ?>
<!--                <div class="post-thumbnail">-->
<!--                    --><?php //the_post_thumbnail('large', ['class' => 'featured-image']); ?>
<!--                </div>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
      <!-- Текст поста (справа) -->
      <div class="post-text-content">
            <?php the_title('<h1 class="post-title">', '</h1>'); ?>
          <div class="post-image-block">
              <?php if (has_post_thumbnail()) : ?>
                  <div class="post-thumbnail">
                      <?php the_post_thumbnail('large', ['class' => 'featured-image']); ?>
                  </div>
              <?php endif; ?>
          </div>
        <div class="post-content">
          <?php the_content(); ?>
        </div>
        
      <footer class="post-footer">
        <div class="post-meta-footer">
            <?php 
            // Дата публикации на английском
            $post_date = get_the_date('F j, Y');
            echo '<span class="post-date">' . esc_html($post_date) . '</span>';
            
            // Теги
            the_tags('<div class="post-tags">', ' ', '</div>'); 
            ?>
        </div>
        </footer>
      </div>
    </div>
    
  </div>
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
    <?php
    $project_id = get_the_ID();

    $add_blocks = get_field("add_blocks",$project_id);


    if ($add_blocks) {

        foreach ($add_blocks as $value) {

            do_action('template_' . $value['block_name']);
        }
    }
     ?>
</article>
<?php get_footer(); ?>