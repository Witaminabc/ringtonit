<?php
// Проверяем контекст сервиса
$is_service_context = is_singular('service') || (isset($args['service_context']) && $args['service_context']);
$projects_to_show = array();

if ($is_service_context) {
    // Получаем связанные проекты из Carbon Fields
    $related_projects = carbon_get_the_post_meta('crb_related_projects');
    if (!empty($related_projects)) {
        $projects_to_show = wp_list_pluck($related_projects, 'id');
    }
    
    // Если это контекст сервиса и нет выбранных проектов - не выводим секцию вообще
    if (empty($projects_to_show)) {
        return; // Прерываем выполнение, секция не будет выведена
    }
}

// Если мы здесь, значит либо это не контекст сервиса, либо есть выбранные проекты
?>
<section class="projects">
    <div class="container">
        <?php if (is_post_type_archive('project')): ?>
            <h1 class="projects__title">Our Projects</h1>
        <?php else: ?>
            <h2 class="projects__title">Our Projects</h2>
            <a href="/projects/" class="projects__link projects__link-all">More Works</a>
        <?php endif; ?>
    </div>

    <div class="projects__list">
        <?php
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => $is_service_context ? -1 : 6,
            'orderby' => $is_service_context ? 'post__in' : 'date',
            'order' => 'DESC'
        );
        
        if (!empty($projects_to_show)) {
            $args['post__in'] = $projects_to_show;
            $args['orderby'] = 'post__in';
        }
        
        $projects_query = new WP_Query($args);
        
        if ($projects_query->have_posts()) :
            while ($projects_query->have_posts()) : $projects_query->the_post();
                $bg_color = carbon_get_the_post_meta('project_background_color');
                $custom_color = carbon_get_the_post_meta('project_custom_bg_color');
                $final_color = !empty($custom_color) ? $custom_color : ($bg_color ?: '#' . substr(md5(get_the_title()), 0, 6));
                
                $project_link = get_permalink();
                $info_items = carbon_get_the_post_meta('project_info_items');
                $hero_enabled = carbon_get_the_post_meta('crb_project_hero_enabled');
        ?>
                <div class="projects__item">
                    <div class="projects__container">
                        <div class="projects__box">
                            <h3 class="projects__item-title"><?php the_title(); ?></h3>
                            <div class="projects__item-desc">                              
                                <ul class="project-features">                                   
                                    <li>                                                                                            
                                        <?php echo wp_kses_post(carbon_get_the_post_meta('info_text')); ?>
                                    </li>                                  
                                </ul>
                            
                                <?php 
                                $additional_info = carbon_get_the_post_meta('project_additional_info');
                                if (!empty($additional_info)): ?>
                                    <div class="project-additional-info">
                                        <?php echo apply_filters('the_content', $additional_info); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($project_link): ?>
                                    <a class="projects__link" href="<?php echo esc_url($project_link); ?>">
                                        Go the project
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="projects__image-box" style="background-color: <?php echo esc_attr($final_color); ?>">
                            <a href="<?php echo esc_url($project_link); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'projects__image')); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-project.png" alt="<?php the_title(); ?>" class="projects__image">
                            <?php endif; ?>
                            </a>
                        </div>
                        
                        <div class="projects__meta">
                            <span class="projects__date">Date: <?php echo get_the_date('F j, Y'); ?></span>
                            <?php if ($hero_enabled): ?>
                                <span class="project-has-hero">Featured Project</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No projects found</p>';
        endif;
        ?>
    </div>
</section>