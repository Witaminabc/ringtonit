<?php get_header(); ?>
<?php
// Получаем ID текущего проекта
$project_id = get_the_ID();
$is_blocks_show = [
    'on_project_details_showing' => carbon_get_post_meta($project_id,"projectdetails_showing"),
    'on_project_cta_showing' => carbon_get_post_meta($project_id,"projectcta_showing2"),
    'on_project_gallery_showing' => carbon_get_post_meta($project_id,"projectgallery_showing3"),
    'on_project_testimonial_showing' => carbon_get_post_meta($project_id,"projecttestimonial_showing4"),
    'on_project_hero_showing' => carbon_get_post_meta($project_id,"project_hero_showing5"),
    'on_project_overview_showing' => carbon_get_post_meta($project_id,"project_overview_showing6")
];
$is_blocks_rank = [
    'on_project_details' => carbon_get_post_meta($project_id,"on_project_details"),
    'on_project_cta' => carbon_get_post_meta($project_id,"on_project_cta"),
    'on_project_gallery' => carbon_get_post_meta($project_id,"on_project_gallery"),
    'on_project_testimonial' => carbon_get_post_meta($project_id,"on_project_testimonial"),
    'on_project_hero' => carbon_get_post_meta($project_id,"on_project_hero"),
    'on_project_overview' => carbon_get_post_meta($project_id,"on_project_overview")
];

asort($is_blocks_rank);


$add_blocks = get_field("add_blocks",$project_id);

?>




<div class="single-project">

    <section class="single-page-top archive-top">
        <div class="container">
            <div class="single-page-header">
                <?php custom_breadcrumbs(); ?>
                <h1 class="project-title"> <?php the_title(); ?></h1>
            </div>
        </div>
    </section>
<?php add_action('template_on_project_hero','project_hero_func'); ?>
<?php function project_hero_func(){ ?>
   <?php $project_id = get_the_ID(); ?>

    <section class="project-hero">
        <div class="container">
            <?php if (carbon_get_post_meta($project_id, 'crb_project_hero_enabled')): ?>
                <div class="hero-content">
                    <div class="hero-text">
                        <?php if ($title = carbon_get_post_meta($project_id, 'crb_project_hero_title')): ?>
                            <h2><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <?php if ($desc = carbon_get_post_meta($project_id, 'crb_project_hero_description')): ?>
                            <p><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>

                        <?php $thumbnails = carbon_get_post_meta($project_id, 'crb_project_hero_thumbnails'); ?>
                        <?php if (!empty($thumbnails)): ?>
                            <div class="hero-thumbnails">
                                <div class="thumbnails-slider">
                                    <?php foreach ($thumbnails as $index => $thumbnail): ?>
                                        <?php if (!empty($thumbnail['thumbnail_image'])): ?>
                                            <div class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>"
                                                data-image="<?php echo esc_url($thumbnail['thumbnail_image']); ?>">
                                                <img src="<?php echo esc_url($thumbnail['thumbnail_image']); ?>"
                                                    alt="<?php echo !empty($thumbnail['thumbnail_alt']) ? esc_attr($thumbnail['thumbnail_alt']) : esc_attr($title); ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="hero-image">
                        <?php if ($main_image = carbon_get_post_meta($project_id, 'crb_project_hero_main_image')): ?>
                            <img src="<?php echo esc_url($main_image); ?>"
                                alt="<?php echo esc_attr($title ?? get_the_title()); ?> Preview"
                                class="hero-img" id="mainHeroImage">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php } ?>
<?php add_action('template_on_project_overview','project_overview_func'); ?>
<?php function project_overview_func(){ ?>
    <?php

    $project_id = get_the_ID();
    $overview_enabled = carbon_get_post_meta($project_id, 'crb_project_overview_enabled');
    $overview_items = carbon_get_post_meta($project_id, 'crb_project_overview_items');
    ?>

    <?php if ($overview_enabled && !empty($overview_items)): ?>
        <section class="project-overview">
            <div class="container">
                <div class="overview-grid">
                    <?php foreach ($overview_items as $item): ?>
                        <div class="overview-item">
                            <?php if (!empty($item['overview_title'])): ?>
                                <h3><?php echo esc_html($item['overview_title']); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($item['overview_icon'])): ?>
                                <div class="icon-container">
                                    <?php
                                    // Если это SVG-файл, вставляем его содержимое напрямую
                                    if (pathinfo($item['overview_icon'], PATHINFO_EXTENSION) === 'svg') {
                                        $svg_content = file_get_contents(esc_url($item['overview_icon']));
                                        // Удаляем возможные XML-декларации и doctype для чистого встраивания
                                        $svg_content = preg_replace('/<\?xml.*?\?>|<!DOCTYPE.*?>/', '', $svg_content);
                                        echo $svg_content;
                                    } else {
                                        // Для других форматов используем стандартный img
                                        echo '<img src="' . esc_url($item['overview_icon']) . '" 
                  alt="' . (!empty($item['overview_title']) ? esc_attr($item['overview_title']) . ' Icon' : 'Overview Icon') . '">';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($item['overview_content'])): ?>
                                <p><?php echo esc_html($item['overview_content']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php } ?>

 <?php add_action('template_on_project_details','project_details_func'); ?>
    <?php function project_details_func(){ ?>
    <?php  $project_id = get_the_ID();
    $details_enabled = carbon_get_post_meta($project_id, 'crb_project_details_enabled');
    ?>
    <?php if ($details_enabled): ?>
        <section class="project-details">
            <div class="container">
                <div class="project-details__content">
                    <?php if ($title = carbon_get_post_meta($project_id, 'crb_project_details_title')): ?>
                        <h2 class="project-details__title section-title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php // The Challenge Block
                    $challenge = carbon_get_post_meta($project_id, 'crb_project_challenge');
                    if (!empty($challenge)):
                        $challenge = $challenge[0]; // Get first item
                    ?>
                        <div class="project-details__block">
                            <?php if (!empty($challenge['challenge_title'])): ?>
                                <h3 class="project-details__subtitle"><?php echo esc_html($challenge['challenge_title']); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($challenge['challenge_description'])): ?>
                                <p class="project-details__text"><?php echo esc_html($challenge['challenge_description']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($challenge['challenge_points'])): ?>
                                <ul class="project-details__list">
                                    <?php foreach ($challenge['challenge_points'] as $point): ?>
                                        <?php if (!empty($point['point'])): ?>
                                            <li class="project-details__item"><?php echo esc_html($point['point']); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php // Our Solution Block
                    $solution = carbon_get_post_meta($project_id, 'crb_project_solution');
                    if (!empty($solution)):
                        $solution = $solution[0]; // Get first item
                    ?>
                        <div class="project-details__block">
                            <?php if (!empty($solution['solution_title'])): ?>
                                <h3 class="project-details__subtitle"><?php echo esc_html($solution['solution_title']); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($solution['solution_description'])): ?>
                                <p class="project-details__text"><?php echo esc_html($solution['solution_description']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($solution['solution_features'])): ?>
                                <div class="solution-features">
                                    <?php foreach ($solution['solution_features'] as $feature): ?>
                                        <div class="solution-features__item">
                                            <?php if (!empty($feature['feature_title'])): ?>
                                                <h4 class="solution-features__title"><?php echo esc_html($feature['feature_title']); ?></h4>
                                            <?php endif; ?>

                                            <?php if (!empty($feature['feature_description'])): ?>
                                                <p class="solution-features__text"><?php echo esc_html($feature['feature_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php // The Results Block
                    $results = carbon_get_post_meta($project_id, 'crb_project_results');
                    if (!empty($results)):
                        $results = $results[0]; // Get first item
                    ?>
                        <div class="about">
                            <div class="project-details__block">
                                <?php if (!empty($results['results_title'])): ?>
                                    <h3 class="project-details__subtitle"><?php echo esc_html($results['results_title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($results['results_stats'])): ?>
                                    <div class="results-stats about__column">
                                        <?php foreach ($results['results_stats'] as $stat): ?>
                                            <div class="stat-item">
                                                <p>
                                                    <span class="counter stat-item-counter" data-target="<?php echo esc_attr($stat['stat_value']); ?>">0</span>
                                                    % <?php echo esc_html($stat['stat_description']); ?>
                                                </p>
                                                <div class="progress-bar">
                                                    <div class="progress" style="width: <?php echo esc_attr($stat['stat_value']); ?>%"></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php } ?>

    <?php add_action('template_on_project_gallery','project_gallery_func'); ?>
    <?php function project_gallery_func(){ ?>
    <?php
    $project_id = get_the_ID();
    $gallery_enabled = carbon_get_post_meta($project_id, 'crb_project_gallery_enabled');
    $gallery_items = carbon_get_post_meta($project_id, 'crb_project_gallery_items');
    ?>

    <?php if ($gallery_enabled && !empty($gallery_items)): ?>
        <section class="project-gallery">
            <div class="container">
                <?php if ($title = carbon_get_post_meta($project_id, 'crb_project_gallery_title')): ?>
                    <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <div class="gallery-grid">
                    <?php foreach ($gallery_items as $item): ?>
                        <?php if (!empty($item['gallery_image'])): ?>
                            <div class="gallery-item">
                                <img src="<?php echo esc_url($item['gallery_image']); ?>"
                                    alt="<?php echo !empty($item['gallery_caption']) ? esc_attr($item['gallery_caption']) : 'Project image'; ?>">
                                <?php if (!empty($item['gallery_caption'])): ?>
                                    <p><?php echo esc_html($item['gallery_caption']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php } ?>

    <?php add_action('template_on_project_testimonial','project_testimonial_func');
    function project_testimonial_func(){
    ?>
    <?php
        $project_id = get_the_ID();
    $testimonial_enabled = carbon_get_post_meta($project_id, 'crb_project_testimonial_enabled');
    $testimonial_quote = carbon_get_post_meta($project_id, 'crb_project_testimonial_quote');
    $testimonial_author = carbon_get_post_meta($project_id, 'crb_project_testimonial_author');
    $testimonial_position = carbon_get_post_meta($project_id, 'crb_project_testimonial_position');
    ?>

    <?php if ($testimonial_enabled && $testimonial_quote): ?>


        <section class="project-testimonial">
            <div class="container">
                <blockquote>
                    <p><?php echo esc_html($testimonial_quote); ?></p>
                    <?php if ($testimonial_author): ?>
                        <small>- <?php echo esc_html($testimonial_author); ?>
                            <?php if ($testimonial_position): ?>
                                , <?php echo esc_html($testimonial_position); ?>
                            <?php endif; ?>
                        </small>
                    <?php endif; ?>
                </blockquote>
            </div>
        </section>

    <?php endif; ?>
    <?php }
    ?>

<?php add_action('template_on_project_cta','project_cta_func');
function project_cta_func(){
    ?>
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
<?php } ?>
    <?php
    foreach ($is_blocks_rank as $key => $value) {
//        echo 'template_'. $key;
//        echo '</br>';
//        echo $is_blocks_show[$key.'_showing'];
//        echo '</br>';
        if ($is_blocks_show[$key.'_showing']) do_action( 'template_'. $key);

    }
    ?>




</div>
<?php   if ($add_blocks) {

    foreach ($add_blocks as $value) {

        do_action( 'template_'. $value['block_name'] );
    }
} ?>

<?php get_footer(); ?>