<?php
add_action('wp_enqueue_scripts', 'style_rs_stadvantage', 13);
function style_rs_stadvantage()
{
    wp_enqueue_style('stadvantage', get_stylesheet_directory_uri() . '/template-parts/st-advantage/st-advantage.css');
}
function storefront_stadvantage(){
    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 296, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
    $st_advantage_block_title = get_field('st_advantage_block_title');
    $st_advantage_block_img = get_field('st_advantage_block_img');
    $stadvantageall = get_field('stadvantageall');


    ?>
    <section class="features-section">
        <div class="features-section-wrap">
            <div class="features-wrapper">
                <div class="features-image">
                    <img src="<?php echo $st_advantage_block_img; ?>"
                         alt="Наши преимущества"
                         class="features-img">
                </div>
                <div class="features-content">
                    <header class="features-header">
                        <h2 class="features-title"><?php echo $st_advantage_block_title; ?></h2>
                    </header>

                    <div class="features-list">

                        <?php foreach ($stadvantageall as $stadvantageall_k => $stadvantageall_v){?>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <img src="<?php echo $stadvantageall_v['img']; ?>" alt="">
                            </div>
                            <div class="feature-text">
                                <h3 class="feature-title"><?php echo $stadvantageall_v['title']; ?></h3>
                                <p class="feature-description"><?php echo $stadvantageall_v['subtitle']; ?></p>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    wp_reset_query();

}