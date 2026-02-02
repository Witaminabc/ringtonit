<?php
function style_rs_articles_theme() {
    wp_enqueue_style( 'articles-new', get_stylesheet_directory_uri().'/template-parts/rs-articles/css/articles-new.css');
}
add_action( 'template_redirect', 'rs_template_articles_include' );
function rs_template_articles_include(){
    global $post;
    if(is_post_type_archive('articles') || isset($post->post_type) && $post->post_type == 'articles'){
        add_action( 'wp_print_scripts', 'style_rs_articles_theme', 12);
    }
}



// Регистрация типа записей
add_post_type('articles', 'Статья', array(
	'supports'   => array( 'title', 'editor', 'thumbnail' ),
	'taxonomies' => array( 'post_tag' ),
	'menu_icon' => 'dashicons-admin-page'
));
//$labels = apply_filters( "post_type_labels_{$post_type}", $labels );
add_filter('post_type_labels_articles', 'rename_posts_labels_articles');
function rename_posts_labels_articles ( $labels ){

	$new = array(
		'name'                  => 'Статья',
		'singular_name'         => 'Статья',
		'add_new'               => 'Добавить Статья',
		'add_new_item'          => 'Добавить Статья',
		'edit_item'             => 'Редактировать Статья',
		'new_item'              => 'Новая Статья',
		'view_item'             => 'Просмотреть Статья',
		'search_items'          => 'Поиск Статей',
		'not_found'             => 'Статей не найдено.',
		'not_found_in_trash'    => 'Статей в корзине не найдено.',
		'parent_item_colon'     => '',
		'all_items'             => 'Все Статьи',
		'archives'              => 'Архивы Статей',
		'insert_into_item'      => 'Вставить в Статья',
		'uploaded_to_this_item' => 'Загруженные для этой Статьи ',
		'featured_image'        => 'Миниатюра Статьи',
		'filter_items_list'     => 'Фильтровать список Статей',
		'items_list_navigation' => 'Навигация по списку Статей',
		'items_list'            => 'Список Статей',
		'menu_name'             => 'Статьи',
		'name_admin_bar'        => 'Статья', // пункте "добавить"
	);

	return (object) array_merge( (array) $labels, $new );
}

add_filter('template_include', 'my_template_articles');
function my_template_articles( $template ) {
	# шаблон для архива произвольного типа "articles"
	global $posts;
	if( is_post_type_archive('articles') ){
		return get_stylesheet_directory() . '/template-parts/rs-articles/articles-arhive-tpl.php';
	}
	# шаблон для страниц произвольного типа "articles"
	global $post;
	if(isset($post->post_type) && $post->post_type == 'articles' ){
		return get_stylesheet_directory() . '/template-parts/rs-articles/articles-tpl.php';
	}
	return $template;
}




// Функция вывода блока
function storefront_articles_child() {
    add_action( 'wp_print_scripts', 'style_rs_articles_theme', 12);
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
	if ($post_meta) :
        $title = get_field("zogolovok_title_st");
        $description = get_field("zogolovok_subtitle_st");

        ?>
<!-- rs-articles -->
<!--        articles-pages-->
        <section class="articles-section ">
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
                        get_template_part('template-parts/rs-articles/content', $post->post_type);
                    }
                    wp_reset_postdata();
                } ?>
                </div>
            </div>
        </section>


<?php
	unset($args);
	unset($posts);
	endif;
	wp_reset_query();
}
