<?php
/**
 * 404 Page Template
 * @package RightOnIT
 */
get_header();
?>
<section class="error-404 not-found">
    <div class="container">
        <h1 class="error-title" style="font-size:3rem; margin-bottom:1rem;">404</h1>
        <h2 class="error-subtitle" style="margin-bottom:2rem;">Page Not Found</h2>
        <p class="error-text" style="margin-bottom:2rem;">The page may have been removed or you mistyped the address.<br>Go to the <a href="<?php echo home_url(); ?>" class="error-link">homepage</a>.</p>
        <a href="<?php echo home_url(); ?>" class="btn btn-primary">Back to Home</a>
    </div>
</section>
<?php get_footer(); ?>
