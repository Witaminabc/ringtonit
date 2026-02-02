<?php
/**
 * Template part for displaying a single project
 */

// Получаем данные из Carbon Fields
$bg_color = carbon_get_the_post_meta('project_background_color');
$custom_color = carbon_get_the_post_meta('project_custom_bg_color');
$final_color = !empty($custom_color) ? $custom_color : ($bg_color ?: '#' . substr(md5(get_the_title()), 0, 6));

$project_link = get_permalink();
$info_items = carbon_get_the_post_meta('project_info_items');
$hero_enabled = carbon_get_the_post_meta('crb_project_hero_enabled');
$additional_info = carbon_get_the_post_meta('project_additional_info');
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
            
                <?php if (!empty($additional_info)): ?>
                    <div class="project-additional-info">
                        <?php echo apply_filters('the_content', $additional_info); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($project_link): ?>
                    <a class="projects__link" href="<?php echo esc_url($project_link); ?>">
                        Go to project
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