<?php
add_action('wp_enqueue_scripts', 'style_rs_stpartners', 14);
function style_rs_stpartners()
{
    wp_enqueue_style('st-partners', get_stylesheet_directory_uri() . '/template-parts/st-partners/st-partners.css');
}
function storefront_stpartners(){
    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 311, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $stpartneryall=get_field('stpartneryall');
//    $st_advantage_block_title = get_field('st_advantage_block_title');
//    $st_advantage_block_img = get_field('st_advantage_block_img');
//    $stpartnersall = get_field('stpartnersall');

    ?>
    <section class="partners-section">
        <div class="title-global">Наши партнеры</div>

        <div class="partners-section-wrap">
            <div class="partners-grid">

    <?php foreach ($stpartneryall as $stpartneryall_k => $stpartneryall_v){?>

        <div class="partner-card">
                    <a href="http://subtropic.su/" target="_blank" class="partner-link">
                        <div class="partner-image">
                            <img src="<?php echo $stpartneryall_v['img'];?>"

                                 class="partner-logo">
                            <div class="partner-overlay">
                                <div class="partner-description"><?php echo $stpartneryall_v['text'];?></div>
                            </div>
                        </div>
                    </a>
                </div>

<?php } ?>
            </div>
        </div>
    </section>


    <?php
    wp_reset_query();

}