
<?php


function rs_ready_trans_functions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 12, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_ready_trans_text = get_field('rs_ready_trans_text');
    $rs_ready_trans_button = get_field('rs_ready_trans_button');
    $rs_ready_trans_href = get_field('rs_ready_trans_href');

    ?>

    <section class="project-cta">
        <div class="container">
            <div class="cta-content">
                    <h2><?php echo $rs_ready_trans_text; ?></h2>

                    <a href="<?php echo $rs_ready_trans_href; ?>" class="cta-button">
                        <?php echo $rs_ready_trans_button; ?>
                    </a>
            </div>
        </div>
    </section>
    <?php

    wp_reset_query();

}





