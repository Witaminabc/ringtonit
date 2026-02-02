<?php
get_header(); ?>
<?php render_page_overlay('blogs'); ?>
<div class="container">


    <!-- Заголовок и описание категории -->
    <div class="category-heading">
        <div class="category-heading-row archive-top single-page-top">
    
            <!-- Хлебные крошки -->
            <?php custom_breadcrumbs(); ?>

            <!-- Табы для категорий -->
<!--            <div class="tabs">-->
<!--                <button class="tabs__button tabs__button--active" data-category="all">All</button>-->
<!--                --><?php
//                $categories = get_categories();
//                foreach ($categories as $category) {
//                    echo '<button class="tabs__button" data-category="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
//                }
//                ?>
<!--            </div>-->
        </div>
        <?php
        if( is_post_type_archive('service') ) { ?>
            <h1 class="category-heading__title">Services</h1>
            <p class="category-heading__desc">Here you can find all posts for the Services.</p>
            <style>.grid-container-posts{
                    padding-bottom: 40px;
                }</style>
     <?php   }else{
        ?>
        <h1 class="category-heading__title">Blogs</h1>
            <p class="category-heading__desc">Here you can find all posts for the selected category.</p>
            <?php } ?>

    </div>

    <!-- Сетка карточек -->
    <div class="grid-container grid-container-posts">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="card" data-category="<?php echo esc_attr(get_the_category()[0]->slug); ?>">
                    <div class="card__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('full', ['class' => 'card__img']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                    <div class="card__description">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <p>Not found</p>
        <?php endif; ?>
    </div>

    <!-- Пагинация -->
    <div class="pagination">
        <?php

        the_posts_pagination(array(
//            'prev_text' => __('« Prev'),
//            'next_text' => __('Next »'),
            'mid_size' => 3,          // Количество страниц по бокам от текущей
            'prev_text' => '« Prev',  // Текст для кнопки "Назад"
            'next_text' => 'Next »', // Текст для кнопки "Вперед"
            'end_size' => 1           // Количество страниц в начале и конце
        ));
        ?>
    </div>
</div>

<?php get_footer(); ?>