<?php
/**
 * Template Name: Simple Page
 * Description: Simple page template with your styles
 */
get_header();
?>
<section class="simple-page">
    <div class="container">
        <h1 class="simple-page__title"><?php the_title(); ?></h1>
        <div class="simple-page__content">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
