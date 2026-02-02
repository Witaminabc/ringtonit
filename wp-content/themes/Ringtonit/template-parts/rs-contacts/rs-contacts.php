<?php


function rs_contacts_functions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 11, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $rs_contacts = get_field('rs_contacts');
    $rs_contacts_fraim = get_field('rs_contacts_fraim');
    $rscontactsinfraimtext = get_field('rscontactsinfraimtext');
    ?>




    <section class="contacts">
        <div class="container">
            <h2 class="contacts__title"><?php echo $rs_contacts; ?></h2>
            <div class="contacts__row">
                <div class="contacts__info">
                    <div class="contacts__details">
    <?php foreach ($rscontactsinfraimtext as $rscontactsinfraimtext_k => $rscontactsinfraimtext_v){ ?>

                            <div class="contacts__item">
                            <i class="fas fa-map-marker-alt contacts__icon"></i>
                            <a href="https://maps.google.com/?q=123 Main Street, City, Country" target="_blank"
                               class="contacts__link">
                                <?php echo $rscontactsinfraimtext_v['text']; ?>
                            </a>
                        </div>
    <?php } ?>

                    </div>
                </div>
                <div class="contacts__map">
                    <?php echo $rs_contacts_fraim; ?>
                </div>
            </div>

        </div>
    </section>
    <?php

    wp_reset_query();

}





