<section class="services">
    <div class="container">
        <div class="services__row">
            <?php
            $services = new WP_Query(array(
                'post_type' => 'service',
                'posts_per_page' => -1,
            ));

            if ($services->have_posts()) :
                $i = 1;
                while ($services->have_posts()) : $services->the_post();
                    $accordion_items = carbon_get_the_post_meta('crb_services_accordion');
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
                <div class="services__tab" data-tab="<?php echo esc_attr($i); ?>">
                    <?php if ($thumbnail): ?>
                        <img class="services__tab-image" src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php endif; ?>
                    <h3 class="services__tab-title"><?php the_title(); ?></h3>
                    
                    <?php if (!empty($accordion_items)) : ?>
                        <div class="services__tab-content">
                            <div class="services__accordion">
                                <?php foreach ($accordion_items as $item) : ?>
                                    <div class="services__item">
                                        <div class="services__item-header"><?php echo esc_html($item['accordion_title']); ?></div>
                                        <div class="services__item-content">
                                            <?php echo apply_filters('the_content', $item['accordion_content']); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
