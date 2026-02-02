<?php
add_action('wp_enqueue_scripts', 'style_rs_stcatalog', 14);
function style_rs_stcatalog()
{
    wp_enqueue_style('st-stcatalog', get_stylesheet_directory_uri() . '/template-parts/st-catalog/css/style.css');
}
function storefront_st_catalog()
{
    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 324, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
        $stcatalogsupernew=get_field('stcatalogsupernew'); ?>
    <div class="st-catalog">
        <div class="title-global">
            Каталог товаров
        </div>
        <div class="catalog-wrap">
        <?php

        foreach ($stcatalogsupernew as $stcatalogsupernew_k => $stcatalogsupernew_v){
            $term_id= $stcatalogsupernew_v['kategoriya'][0];
            $term_obj=get_term( $term_id );
            $term_name = $term_obj->name;
            $link = get_term_link( $term_obj );
            $thumbnail_id = get_woocommerce_term_meta($term_id, 'thumbnail_id', true);
          ?>
            <div class="catalog-item">
                <div class="catalog-item__title">
                   <?php echo $term_name; ?>
                </div>
                <div class="catalog-item__img">
                    <img src="<?php  echo  wp_get_attachment_url($thumbnail_id); ?>" alt="">
                </div>
                <div class="catalog-item__btn slide-button">
                    <a href="<?php echo $link; ?>">Перейти</a>
                </div>
            </div>
        <?php

        } ?>

        </div>
    </div>
    <?php


    ?>




<?php
wp_reset_query();

}
