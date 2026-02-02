<?php get_header(); 
	global $post;
	$query = new WP_Query( array (
		'post_type' => 'custom_block',
		'meta_query' => array (
			'relation' => 'OR',
			array (
				'key'     => 'block_id',
				'value'   => 275, // id блока
				'compare' => '='
			)
		)
	));
	while ( $query->have_posts() ) {
		$query->the_post();
		$post_meta = get_post_meta($query->post->ID);
	}
	if ($post_meta) {
        $title = get_field("zogolovok_title_st");
        $description = get_field("zogolovok_subtitle_st");
	}
?>
    <section class="articles-section articles-pages">
        <div class="title-global"><?=$title; ?></div>
        <div class="title-description"><?=$description; ?></div>
        <div class="articles-section-wrap">
            <div class="articles-grid">
                <?
                wp_reset_query();
                $args = array(
                    'post_type'	=> 'articles',
                    'posts_per_page' => 4,
                    'order'		=> 'DESC',
                    'orderby' => 'date'
                );
                $posts = query_posts( $args );

                if ( $posts ) {
                    foreach( $posts as $post ) {
                        setup_postdata( $post );
                        get_template_part('template-parts/rs-articles/contentarhive', $post->post_type);
                    }
                    wp_reset_postdata();
                } ?>
            </div>
        </div>
    </section>







    <!-- /.rs-news -->
<?php
	unset($args);
	unset($posts);
	wp_reset_query();
?>
<?php get_footer(); ?>