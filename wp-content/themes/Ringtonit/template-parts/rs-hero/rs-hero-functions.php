<?php
add_action('wp_enqueue_scripts', 'style_rs_hero', 13);
function style_rs_hero()
{
//    wp_enqueue_style('stslider', get_stylesheet_directory_uri() . '/template-parts/st-slider/stslider.css');
}

function rs_hero_finctions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 5, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_banner_title_main = get_field('rs_banner_title_main');
    $rs_banner_subtitle_main = get_field('rs_banner_subtitle_main');
    $rs_img_fhone = get_field('rs_img_fhone');

    ?>


    <section class="hero">
        <div class="hero__bg">
            <img src="<?php echo $rs_img_fhone; ?>" alt="" class="hero__bg-image">
            <div class="container">
                <h1 class="hero__title"><?php echo $rs_banner_title_main; ?></h1>

                <h2 class="hero__subtitle"><?php echo $rs_banner_subtitle_main; ?></h2>

            </div>
        </div>
    </section>

    <?php

    wp_reset_query();

}

