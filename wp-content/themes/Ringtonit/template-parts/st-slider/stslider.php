<?php
add_action('wp_enqueue_scripts', 'style_rs_stslider', 12);
function style_rs_stslider()
{
    wp_enqueue_style('stslider', get_stylesheet_directory_uri() . '/template-parts/st-slider/stslider.css');
}

function storefront_stslider()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 298, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $st_slaider = get_field('stblokistslajdera');
    ?>
    <div class="swiper-container swiper-main-slaider-container">
        <div class="swiper-wrapper">
            <?php foreach ($st_slaider as $st_slaider_k => $st_slaider_v) { ?>
                <div class="swiper-slide" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('<?php echo $st_slaider_v['img']; ?>'); background-size:cover">
                    <div class="slide-content">
                        <h2><?php echo $st_slaider_v['title']; ?></h2>
                        <p><?php echo $st_slaider_v['subtitle']; ?></p>
                        <button class="slide-button"><a href="<?php echo $st_slaider_v['href']; ?>">Подробнее</a>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination-new"></div>
    </div>


    <?php

    wp_reset_query();

}