<?php

/**
 * Template Name: Home
 *
 * @package RightOnIT
 */

get_header(); ?>


<section class="hero">
    <div class="hero__bg">
        <?php
        $bg_image = carbon_get_theme_option('crb_hero_bg');
        $gradient = carbon_get_theme_option('crb_hero_gradient');

        if ($bg_image) {
            echo '<img src="' . esc_url($bg_image) . '" alt="" class="hero__bg-image">';
        } else {
            // Fallback image if no image is set
            echo '<img src="' . get_template_directory_uri() . '/assets/images/hp-desktop-gradiant.webp" alt="" class="hero__bg-image">';
        }

        if ($gradient === 'yes') {
            echo '<div class="hero__gradient-overlay"></div>';
        }
        ?>

        <div class="container">
            <h1 class="hero__title">
                <?php echo esc_html(carbon_get_theme_option('crb_hero_title')); ?>
            </h1>

            <h2 class="hero__subtitle">
                <?php echo wp_kses_post(carbon_get_theme_option('crb_hero_subtitle')); ?>
            </h2>
        </div>
    </div>
</section>
<section class="intro">
    <div class="container">
        <?php
        $image = carbon_get_theme_option('crb_intro_image');
        $title = carbon_get_theme_option('crb_intro_title');
        $description = carbon_get_theme_option('crb_intro_description');
        $layout = carbon_get_theme_option('crb_intro_layout');
        ?>

        <div class="intro__row intro__row--reverse">
            <?php if ($image) : ?>
                <img class="intro__image-content" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
            <?php endif; ?>

            <div class="intro__content">
                <?php if ($title) : ?>
                    <h2 class="intro__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="intro__desc"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="advantages">
    <div class="container">
        <?php
        $section_title = carbon_get_theme_option('crb_advantages_title');
        $advantages_items = carbon_get_theme_option('crb_advantages_items');
        ?>

        <?php if ($section_title) : ?>
            <h2 class="advantages__title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($advantages_items)) : ?>
            <ul class="advantages__list">
                <?php foreach ($advantages_items as $item) : ?>
                    <li class="advantages__item">
                        <?php if (!empty($item['icon'])) : ?>
                            <img src="<?php echo esc_url($item['icon']); ?>"
                                alt="<?php echo esc_attr($item['title']); ?>"
                                class="advantages__icon">
                        <?php endif; ?>

                        <?php if (!empty($item['title'])) : ?>
                            <span class="advantages__item-title"><?php echo esc_html($item['title']); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($item['description'])) : ?>
                            <p class="advantages__item-desc"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
<?php
// Проверяем, включена ли секция проектов

$projects_enabled = carbon_get_theme_option('crb_projects_enabled');
$selected_projects = carbon_get_theme_option('crb_related_projects');
$show_all_link = carbon_get_theme_option('crb_show_all_projects_link');

if ($projects_enabled && !empty($selected_projects)) :
    $project_ids = wp_list_pluck($selected_projects, 'id');
?>
    <section class="projects-section">
        <div class="container">
            <h2 class="section-title"><?php _e('Featured Projects', 'textdomain'); ?></h2>
  <?php if ($show_all_link) : ?>
          
                    <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="projects__link projects__link-all">
                        <?php _e('View All Projects', 'textdomain'); ?>
                    </a>
                
            <?php endif; ?>
            <div class="projects-grid">
                <?php
                $args = array(
                    'post_type' => 'project',
                    'post__in' => $project_ids,
                    'orderby' => 'post__in',
                    'posts_per_page' => -1,
                );

                $projects_query = new WP_Query($args);

                if ($projects_query->have_posts()) :
                    while ($projects_query->have_posts()) : $projects_query->the_post();
                        get_template_part('template-parts/content-project', 'project-featured');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

          
        </div>
    </section>
<?php endif; ?>


<section class="about">
    <div class="container">
        <div class="about__row">
            <div class="about__column">
                <?php $about_title = carbon_get_theme_option('crb_about_title'); ?>
                <?php if ($about_title) : ?>
                    <h2 class="about__title"><?php echo esc_html($about_title); ?></h2>
                <?php endif; ?>

                <?php $about_items = carbon_get_theme_option('crb_about_items'); ?>
                <?php if (!empty($about_items)) : ?>
                    <ul class="about__desc">
                        <?php foreach ($about_items as $item) : ?>
                            <li class="about__item"><?php echo esc_html($item['item_text']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="about__column">
                <?php $stats_items = carbon_get_theme_option('crb_about_stats'); ?>
                <?php if (!empty($stats_items)) : ?>
                    <ul class="about__prevelegends-list">
                        <li class="about__prevelegends-item">
                            <?php foreach ($stats_items as $stat) : ?>
                                <p>
                                    <span class="counter" data-target="<?php echo esc_attr($stat['stat_value']); ?>">0</span>+
                                    <?php echo esc_html($stat['stat_label']); ?>
                                </p>
                                <div class="progress-bar">
                                    <div class="progress"></div>
                                </div>
                            <?php endforeach; ?>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/section-preview-services'); ?>
<section class="choose-wise">
    <div class="container">
        <div class="choose-wise__row">
            <div class="choose-wise__column column--first">
                <?php $title = carbon_get_theme_option('crb_choose_wise_title'); ?>
                <?php if ($title) : ?>
                    <h2 class="choose-wise__title" data-parallax><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php $subtitle = carbon_get_theme_option('crb_choose_wise_subtitle'); ?>
                <?php if ($subtitle) : ?>
                    <p class="choose-wise__subtitle" data-parallax><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>

            <div class="choose-wise__column column--second">
                <?php $accordion_items = carbon_get_theme_option('crb_choose_wise_accordion'); ?>
                <?php if (!empty($accordion_items)) : ?>
                    <div class="choose-wise__accordion accordion">
                        <?php foreach ($accordion_items as $item) : ?>
                            <div class="accordion__item">
                                <button class="accordion__header">
                                    <span class="accordion__title"><?php echo esc_html($item['title']); ?></span>
                                    <span class="accordion__icon">+</span>
                                </button>
                                <div class="accordion__content">
                                    <p class="accordion__text"><?php echo esc_html($item['content']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="clients">
    <div class="clients__container container">
        <h2 class="clients__title"><?php echo esc_html(carbon_get_theme_option('crb_clients_title')); ?></h2>
        <p class="clients__subtitle"><?php echo esc_html(carbon_get_theme_option('crb_clients_subtitle')); ?></p>

        <?php
        $logos = carbon_get_theme_option('crb_clients_logos');
        if (!empty($logos)) :
        ?>
            <div class="clients__slider swiper">
                <div class="clients__wrapper swiper-wrapper">
                    <?php foreach ($logos as $logo_id) :
                        $logo_url = wp_get_attachment_image_url($logo_id, 'medium');
                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                    ?>
                        <div class="clients__slide swiper-slide">
                            <img src="<?php echo esc_url($logo_url); ?>"
                                alt="<?php echo esc_attr($logo_alt ?: 'Client logo'); ?>"
                                class="clients__logo">
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="clients__navigation">
                    <div class="clients__pagination swiper-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="contacts">
    <div class="container">
        <h2 class="contacts__title"><?php echo esc_html(carbon_get_theme_option('crb_contacts_title')); ?></h2>
        <div class="contacts__row">
            <div class="contacts__info">
                <div class="contacts__details">
                    <?php if ($address = carbon_get_theme_option('crb_contacts_address')) : ?>
                        <div class="contacts__item">
                            <i class="fas fa-map-marker-alt contacts__icon"></i>
                            <a href="https://maps.google.com/?q=<?php echo urlencode($address); ?>" target="_blank" class="contacts__link">
                                <?php echo esc_html($address); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($email = carbon_get_theme_option('crb_contacts_email')) : ?>
                        <div class="contacts__item">
                            <i class="fas fa-envelope contacts__icon"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="contacts__link">
                                <?php echo esc_html($email); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone = carbon_get_theme_option('crb_contacts_phone')) : ?>
                        <div class="contacts__item">
                            <i class="fas fa-phone contacts__icon"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="contacts__link">
                                <?php echo esc_html($phone); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="contacts__map">
                <?php echo carbon_get_theme_option('crb_contacts_map'); ?>
            </div>
        </div>
    </div>
</section>
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
<?php get_footer(); ?>