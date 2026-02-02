<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: All Blocks
 *
 * @package storefront
 */

$add_blocks = get_field("add_blocks") ?: '';

get_header();

?>
<?php   if ($add_blocks) {

    foreach ($add_blocks as $value) {

        do_action( 'template_'. $value['block_name'] );
    }
} ?>


<?php
get_footer();
