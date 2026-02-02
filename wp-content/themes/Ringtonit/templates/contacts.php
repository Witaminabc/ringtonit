<?php

/**
 * Template Name: Contacts
 */

get_header();
?> 
  <?php render_page_overlay('blogs'); ?>
  <div class="single-page">
    <section class="archive-top single-page-top">
        <div class="container">
            <div class="archive-header single-page-header">
              
                <nav class="breadcrumbs">
                    <?php custom_breadcrumbs(); ?>
                </nav>
                <div class="single-page-column">
                    <h1 class="page-title">
                        <?php echo esc_html(carbon_get_the_post_meta('contacts_title')); ?>
                    </h1>
                    <a href="<?php echo esc_attr(carbon_get_the_post_meta('contacts_button_link')); ?>" class="cta-button">
                        <?php echo esc_html(carbon_get_the_post_meta('contacts_button_text')); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>   
    <?php get_template_part('template-parts/feedback'); ?>
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

    <section class="map-section">
        <div class="container">
            <div class="contacts__map">
                <?php echo carbon_get_theme_option('crb_contacts_map'); ?>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>