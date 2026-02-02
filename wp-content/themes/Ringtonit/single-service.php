<?php get_header(); ?>
<?php
    $project_id = get_the_ID();
    $is_blocks_show = [
            'on_section_hero_showing' => carbon_get_post_meta($project_id,"section_hero_showing5"),
    'on_stages_showing' => carbon_get_post_meta($project_id,"stages_showing"),
    'on_add_ons_showing' => carbon_get_post_meta($project_id,"add_ons_showing2"),
    'on_our_projects_showing' => carbon_get_post_meta($project_id,"our_projects_showing3"),
    'on_project_cta_showing' => carbon_get_post_meta($project_id,"project_cta_showing4"),

    ];
    $is_blocks_rank = [
        'on_section_hero' => carbon_get_post_meta($project_id,"on_section_hero"),
    'on_stages' => carbon_get_post_meta($project_id,"on_stages"),
    'on_add_ons' => carbon_get_post_meta($project_id,"on_add_ons"),
    'on_our_projects' => carbon_get_post_meta($project_id,"on_our_projects"),
    'on_project_cta' => carbon_get_post_meta($project_id,"on_project_cta"),

    ];
$add_blocks = get_field("add_blocks",$project_id);

asort($is_blocks_rank);

?>

<section class="archive-top">
    <div class="container">
        <div class="archive-header">
            <?php custom_breadcrumbs(); ?>

            <?php
            // Получаем ID текущей записи
            $current_service_id = get_the_ID();

            // Получаем все услуги (записи типа 'service'), исключая текущую
            $services = get_posts(array(
                'post_type' => 'service',
                'numberposts' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'exclude' => array($current_service_id) // Исключаем текущий пост
            ));
            ?>

            <?php if ($services) : ?>
                <div class="tabs">
                    <?php foreach ($services as $service): ?>
                        <a href="<?php echo get_permalink($service->ID); ?>"
                            class="tabs__button"
                            data-category="category-<?php echo $service->ID; ?>">
                            <span><?php echo esc_html($service->post_title); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <!-- Заголовок и описание категории -->


        </div>
        </div>
</section>

<?php add_action('template_on_section_hero','section_hero_func'); ?>
<?php function section_hero_func(){ ?>
    <section class="archive-top">
        <div class="container">
            <div class="archive-header">
    <div class="category-heading">
        <h1 class="category-heading__title">
            <?php echo esc_html(get_the_title()); ?>
        </h1>

        <div class="category-heading__desc">
            <div class="category-heading__desc-row">
                <div class="category-heading__desc-col category-heading__desc-col--text">
                    <?php if ($subtitle = carbon_get_the_post_meta('crb_service_subtitle')) : ?>
                        <h3><?php echo esc_html($subtitle); ?></h3>
                    <?php endif; ?>
                    <?php echo apply_filters('the_content', carbon_get_the_post_meta('crb_service_description')); ?>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="category-heading__desc-col category-heading__desc-col--image parallax-image">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    </section>
<?php } ?>


<?php add_action('template_on_stages','stages_func'); ?>
<?php function stages_func(){ ?>
<section class="stages" data-section="stages"
    <?php if ($bg_color = carbon_get_the_post_meta('crb_stages_bg_color')) : ?>
    style="background-color: <?php echo esc_attr($bg_color); ?>"
    <?php endif; ?>>

    <div class="container">
        <h2 class="stages__title"
            <?php if ($text_color = carbon_get_the_post_meta('crb_stages_text_color')) : ?>
            style="color: <?php echo esc_attr($text_color); ?>"
            <?php endif; ?>>
            <?php echo esc_html(carbon_get_the_post_meta('crb_stages_title')); ?>
        </h2>
        <?php 
        $subtitle = carbon_get_the_post_meta('crb_stages_sub-title');
        if (!empty($subtitle)) : ?>
            <p class="stages__sub-title"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>       
        <?php $stages_items = carbon_get_the_post_meta('crb_stages_items'); ?>
        <?php if (!empty($stages_items)) : ?>
            <div class="stages__row">
                <div class="stages__left">
                    <?php foreach ($stages_items as $index => $stage) : ?>
                        <div class="stage" data-stage="<?php echo $index + 1; ?>">
                            <?php if (!empty($stage['icon'])) : ?>
                                <img src="<?php echo esc_url($stage['icon']); ?>" alt="" class="stage__icon">
                            <?php endif; ?>

                            <span class="stage__number"><?php echo esc_html($stage['number']); ?></span>
                            <h3 class="stage__title"><?php echo esc_html($stage['title']); ?></h3>
                            <div class="stage__desc"><?php echo apply_filters('the_content', $stage['description']); ?></div>
                            <div class="stage__border"></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="stages__right">
                    <div class="stages__category" data-category=""></div>
                </div>
            </div>

            <?php if ($button_text = carbon_get_the_post_meta('crb_stages_button_text')) : ?>
                <div class="stages__button-wrapper">
                    <a href="<?php echo esc_url(carbon_get_the_post_meta('crb_stages_button_url')); ?>"
                        class="stages__button">
                        <?php echo esc_html($button_text); ?>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
<?php } ?>


<?php add_action('template_on_add_ons','add_ons_func'); ?>
<?php function add_ons_func(){ ?>
<?php
// Получаем настройки для секции "Choose Wise"
$addons_title = carbon_get_the_post_meta('service_addons_title');
$addons_subtitle = carbon_get_the_post_meta('service_addons_sub_title');
$addons_items = carbon_get_the_post_meta('service_addons_items');

if (carbon_get_the_post_meta('service_addons_enabled')) :
?>
    <section class="choose-wise">
        <div class="container">
            <div class="choose-wise__row">
                <div class="choose-wise__column column--first">
                    <?php if ($addons_title) : ?>
                        <h2 class="choose-wise__title" data-parallax><?php echo wp_kses_post($addons_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($addons_subtitle) : ?>
                        <p class="choose-wise__subtitle" data-parallax><?php echo wp_kses_post($addons_subtitle); ?></p>
                    <?php endif; ?>
                </div>

                <div class="choose-wise__column column--second">
                    <?php if (!empty($addons_items)) : ?>
                        <div class="choose-wise__accordion accordion">
                            <?php foreach ($addons_items as $item) : ?>
                                <div class="accordion__item <?php echo !empty($item['featured']) ? 'featured' : ''; ?>">
                                    <button class="accordion__header">
                                        <span class="accordion__title"><?php echo esc_html($item['title']); ?></span>
                                        <span class="accordion__icon">+</span>
                                    </button>
                                    <div class="accordion__content">
                                        <p class="accordion__text"><?php echo esc_html($item['description']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php } ?>

<?php add_action('template_on_our_projects','our_projects_func'); ?>
<?php function our_projects_func(){ ?>
<?php get_template_part('template-parts/section-archive-projects'); ?>
<?php } ?>

<?php add_action('template_on_project_cta','project_cta_func'); ?>
<?php function project_cta_func(){ ?>
<?php get_template_part('template-parts/project-cta'); ?>
<?php } ?>

<?php
foreach ($is_blocks_rank as $key => $value) {
//        echo 'template_'. $key;
//        echo '</br>';
//        echo $is_blocks_show[$key.'_showing'];
//        echo '</br>';
    if ($is_blocks_show[$key.'_showing']) do_action( 'template_'. $key);

}


if ($add_blocks) {

    foreach ($add_blocks as $value) {

        do_action('template_' . $value['block_name']);
    }
}
?>

<?php get_footer(); ?>