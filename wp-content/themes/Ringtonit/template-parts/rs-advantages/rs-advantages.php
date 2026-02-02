
<?php


function rs_advantages_functions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 7, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_advantages_title = get_field('rs_advantages_title');
    $rsadvantagesfull = get_field('rsadvantagesfull');
//    $rs_intro_left_img = get_field('rs_intro_left_img');
    ?>


    <section class="advantages">
        <div class="container">
            <h2 class="advantages__title"><?php echo $rs_advantages_title; ?></h2>
            <ul class="advantages__list">
                <?php foreach ($rsadvantagesfull as $rsadvantagesfull_k => $rsadvantagesfull_v){ ?>
                <li class="advantages__item">
                    <img src="<?php echo $rsadvantagesfull_v['img']; ?>" alt="Big and Small Businesses"
                         class="advantages__icon">
                    <?php echo $rsadvantagesfull_v['title']; ?>
                </li>
               <?php } ?>
            </ul>
        </div>
    </section>


    <?php

    wp_reset_query();

}


