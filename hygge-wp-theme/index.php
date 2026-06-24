<?php
/**
 * The main template file
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 100px 0;">
    <div class="container">
        <?php
        if ( have_posts() ) :

            if ( is_home() && ! is_front_page() ) :
                ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
                <?php
            endif;

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;
                        ?>
                    </header><!-- .entry-header -->

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail" style="margin-bottom: 20px;">
                            <?php the_post_thumbnail('large', array('style' => 'max-width:100%; height:auto; border-radius:12px;')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        if ( is_singular() ) :
                            the_content();
                        else :
                            the_excerpt();
                            ?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-link"><?php echo esc_html( get_theme_mod( 'blog_read_more', 'Читати далі →' ) ); ?></a>
                            <?php
                        endif;
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <hr style="margin: 40px 0; border: none; border-top: 1px solid rgba(0,0,0,0.1);">
                <?php
            endwhile;

            the_posts_navigation();

        else :
            ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title">Нічого не знайдено</h1>
                </header>
                <div class="page-content">
                    <p>Схоже, за вашим запитом нічого не знайдено.</p>
                </div>
            </section>
            <?php
        endif;
        ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
