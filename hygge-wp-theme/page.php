<?php
/**
 * The template for displaying all single pages
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        
        // Output the content from the WordPress editor. 
        // If you paste your raw HTML sections here, they will render exactly as in the template.
        the_content();

    endwhile; // End of the loop.
    ?>
</main><!-- #main -->

<?php
get_footer();
