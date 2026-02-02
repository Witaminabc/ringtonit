<?php get_header(); 
	global $post;
	$query = new WP_Query( array (
		'post_type' => 'custom_block',
		'meta_query' => array (
			'relation' => 'OR',
			array (
				'key'     => 'block_id',
				'value'   => 5, // id блока
				'compare' => '='
			)
		)
	));
	while ( $query->have_posts() ) {
		$query->the_post();
		$post_meta = get_post_meta($query->post->ID);
	}
	if ($post_meta) {
		$title = get_field("title");
		$description = get_field("description");
	}
?>


    <section class="news-section">
        <div class="title-global"><?=$title; ?></div>
        <div class="section-descr" data-nekoanim="fadeInUp" data-nekodelay="200">
            <?=$description; ?>
        </div>
        <div class="news-section-wrap">
            <?
            $args = array(
                'post_type'	=> 'news',
                'order'		=> 'DESC',
                'orderby' => 'date'
            );
            ?>
            <?php
            $posts = query_posts( $args );?>
            <?if ( $posts ) : ?>
                <?php
                foreach( $posts as $post ) {
                    setup_postdata( $post );
                    get_template_part('template-parts/rs-news/content', $post->post_type);

                }
                wp_reset_postdata();
                ?>
            <?php
            else :
                get_template_part('content', 'none');
            endif;
            ?>
<!--            <article class="news-card">-->
<!--                <div class="news-image">-->
<!--                    <img src="https://cdn-ru.bitrix24.ru/b21003248/landing/ae1/ae1c3828e23f6202ac05ab1dcdec79e2/334_original_1x.jpg"-->
<!--                         alt="Новый проект по производству пищевых ингредиентов"-->
<!--                         class="news-img"-->
<!--                         srcset="https://cdn-ru.bitrix24.ru/b21003248/landing/0cc/0ccfbaa08cd552a43b5227f73354e664/334_original_2x.jpg 2x">-->
<!--                </div>-->
<!---->
<!--                <div class="news-content">-->
<!--                    <h3 class="news-title">Приглашаем к участию в новом проекте "Производство новых функционально-пищевых ингредиентов с улучшенным качеством"</h3>-->
<!--                    <p class="news-text">Профессиональная команда единомышленников, предлагает к рассмотрению всем заинтересованным и потенциальным инвесторам, наш новый проект «Растительное сырье как источник функционально-пищевых ингредиентов»</p>-->
<!--                </div>-->
<!---->
<!--                <div class="news-action">-->
<!--                    <a href="https://stophimiy.ru/news/В Сочи новые короеды!!! ДРЕВЕСНИК МНОГОЯДНЫЙ Xylosandrus compactus (Eichhoff)_hsho/" class="news-link">Подробнее</a>-->
<!--                </div>-->
<!--            </article>-->


        </div>
    </section>




<?php get_footer(); ?>