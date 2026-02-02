<?php


function rs_our_clients_functions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 10, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_our_clients_title = get_field('rs_our_clients_title');
    $rs_our_clients_subtitle = get_field('rs_our_clients_subtitle');
    $rsourclientsfulling = get_field('rsourclientsfulling');
    ?>



    <section class="clients">
        <div class="clients__container container">
            <h2 class="clients__title"><?php echo $rs_our_clients_title; ?></h2>
            <p class="clients__subtitle"><?php echo $rs_our_clients_subtitle; ?></p>


            <div class="clients__slider swiper">
                <div class="clients__wrapper swiper-wrapper">
    <?php foreach ($rsourclientsfulling as $rsourclientsfulling_k => $rsourclientsfulling_v){ ?>
                    <div class="clients__slide swiper-slide">
                        <img src="<?php echo $rsourclientsfulling_v; ?>" alt="Логотип клиента 1" class="clients__logo">
                    </div>

    <?php } ?>

                </div>


                <div class="clients__navigation">
                    <div class="clients__pagination swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <?php

    wp_reset_query();

}


