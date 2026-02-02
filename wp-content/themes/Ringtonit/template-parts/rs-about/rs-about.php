
<?php


function rs_about_functions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 8, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_about_title = get_field('rs_about_title');
    $rsadvantagesfull = get_field('rsaboutfull');
    $rsaboutnumber = get_field('rsaboutnumber');
    ?>


    <section class="about">
        <div class="container">
            <div class="about__row">
                <div class="about__column">
                    <h2 class="about__title">
                        <?php echo $rs_about_title; ?>
                    </h2>
                    <ul class="about__desc">
    <?php foreach ($rsadvantagesfull as $rsadvantagesfull_k => $rsadvantagesfull_v){ ?>
                        <li class="about__item">
                            <?php echo $rsadvantagesfull_v['title']; ?>
                        </li>
    <?php } ?>

                    </ul>
                </div>
                <div class="about__column">
                    <ul class="about__prevelegends-list">
                        <li class="about__prevelegends-item">
    <?php foreach ($rsaboutnumber as $rsaboutnumber_k => $rsaboutnumber_v){ ?>

    <p><span class="counter" data-target="<?php echo $rsaboutnumber_v['num']; ?>">0</span>  <?php echo $rsaboutnumber_v['title']; ?></p>
                            <div class="progress-bar">
                                <div class="progress"></div>
                            </div>
    <?php } ?>


                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <?php

    wp_reset_query();

}


