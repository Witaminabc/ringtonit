<?php
add_action('wp_enqueue_scripts', 'style_rs_intro', 13);
function style_rs_intro()
{
//    wp_enqueue_style('stslider', get_stylesheet_directory_uri() . '/template-parts/st-slider/stslider.css');
}

function rs_intro_finctions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 6, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_intro_title = get_field('rs_intro_title');
    $rs_intro_subtitle = get_field('rs_intro_subtitle');
    $rs_intro_left_img = get_field('rs_intro_left_img');
    ?>


    <section class="intro">
        <div class="container">
            <div class="intro__row">
                <img class="intro__image-content" src=" <?php echo $rs_intro_left_img;?>" alt="">
                <div class="intro__content">
                    <h2 class="intro__title">
                        <?php echo $rs_intro_title;?>
                    </h2>
                    <p class="intro__desc">
                        <?php echo $rs_intro_subtitle;?>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <?php

    wp_reset_query();

}

