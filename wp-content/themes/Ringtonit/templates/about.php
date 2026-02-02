<?php

/**
 * Template Name: About us
 */

get_header();
?>

<?php render_page_overlay('about_us'); ?>
    <div class="about-page">
        <section class="archive-top single-page-top">


            <div class="container">
                <div class="archive-header single-page-header">
                    <?php custom_breadcrumbs(); ?>
                </div>
                <h1 class="about-page__title">   <?php echo carbon_get_the_post_meta('about_page_title'); ?></h1>
            </div>
        </section>
        <section class="about-story">
            <div class="container">
                <div class="about-story__content">
                    <h2 class="about-story__title">
                        <?php echo esc_html(carbon_get_the_post_meta('about_story_title')); ?>
                    </h2>
                    <div class="about-story__grid">
                        <div class="about-story__text">
                            <?php echo wp_kses_post(carbon_get_the_post_meta('about_story_paragraph')); ?></p>
                        </div>
                        <div class="about-story__image">
                            <img src="<?php echo esc_url(carbon_get_the_post_meta('about_story_image')); ?>"
                                 alt="Our team working">
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                                            <span class="counter"
                                                  data-target="<?php echo esc_attr($stat['stat_value']); ?>">0</span>+
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


        <?php
        if (carbon_get_post_meta(get_the_ID(), 'team_section_enabled')) :
            $section_title = carbon_get_post_meta(get_the_ID(), 'team_section_title');
            $team_members = carbon_get_post_meta(get_the_ID(), 'team_members');
            ?>
            <section class="team-section">
                <div class="container">
                    <?php if ($section_title): ?>
                        <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($team_members)): ?>
                        <div class="team-grid">
                            <?php foreach ($team_members as $member): ?>
                                <div class="team-member">
                                    <?php if (!empty($member['member_photo'])): ?>
                                        <img src="<?php echo esc_url($member['member_photo']); ?>"
                                             alt="<?php echo esc_attr($member['member_name']); ?>" class="member-photo">
                                    <?php endif; ?>
                                    <h3><?php echo esc_html($member['member_name']); ?></h3>
                                    <p class="member-role"><?php echo esc_html($member['member_position']); ?></p>
                                    <p class="member-bio"><?php echo esc_html($member['member_bio']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (carbon_get_post_meta(get_the_ID(), 'values_section_enabled')) : ?>
            <section class="values-section">
                <div class="container">
                    <?php
                    $title = carbon_get_post_meta(get_the_ID(), 'values_section_title');
                    $values = carbon_get_post_meta(get_the_ID(), 'values_list');
                    ?>

                    <?php if ($title): ?>
                        <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($values)): ?>
                        <div class="values-grid">
                            <?php foreach ($values as $value): ?>
                                <div class="value-card">
                                    <div class="value-icon">
                                        <?php
                                        $icon_url = $value['value_icon'];
                                        if ($icon_url && pathinfo($icon_url, PATHINFO_EXTENSION) === 'svg') {
                                            $svg_path = str_replace(home_url('/'), ABSPATH, $icon_url);
                                            if (file_exists($svg_path)) {
                                                echo file_get_contents($svg_path);
                                            } else {
                                                echo '<!-- SVG not found: ' . esc_html($svg_path) . ' -->';
                                            }
                                        } elseif ($icon_url) {
                                            echo '<img src="' . esc_url($icon_url) . '" alt="">';
                                        }
                                        ?>
                                    </div>
                                    <h3><?php echo esc_html($value['value_title']); ?></h3>
                                    <p><?php echo esc_html($value['value_description']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>


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
        <?php get_template_part('template-parts/project-cta'); ?>
    </div>


<?php get_footer(); ?>