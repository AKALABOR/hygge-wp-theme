<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        
        <section class="inner-hero article-hero">
            <div class="container">
                <?php 
                $cats = get_the_category();
                if ( ! empty( $cats ) ) {
                    echo '<span class="card-tag">' . esc_html( $cats[0]->name ) . '</span>';
                }
                ?>
                <h1><?php the_title(); ?></h1>
                <div class="card-meta article-meta">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <?php 
                        $a_date_icon = get_post_meta( get_the_ID(), 'article_date_icon', true );
                        if ($a_date_icon) { echo $a_date_icon; } else { ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <?php } ?>
                        <?php echo get_post_meta( get_the_ID(), 'article_custom_date', true ) ?: get_the_date(); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <?php 
                        $a_time_icon = get_post_meta( get_the_ID(), 'article_time_icon', true );
                        if ($a_time_icon) { echo $a_time_icon; } else { ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?php } ?>
                        <?php echo get_post_meta( get_the_ID(), 'read_time', true ) ?: '5 хв на читання'; ?>
                    </span>
                </div>
            </div>
        </section>

        <section class="article-content">
            <div class="container">
                <div class="article-wrapper">
                    <?php 
                    $article_hero_img_url = get_post_meta( get_the_ID(), 'article_hero_img_url', true );
                    if ( $article_hero_img_url ) : ?>
                        <img src="<?php echo esc_url($article_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $article_hero_img_url, get_the_title() ) ); ?>" class="article-cover">
                    <?php elseif ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full', array('class' => 'article-cover')); ?>
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80"
                            alt="Обкладинка статті" class="article-cover">
                    <?php endif; ?>

                    <div class="article-body">
                        <?php the_content(); ?>
                    </div>

                    <div class="article-footer">
                        <?php
                        $blog_pages = get_posts(array(
                            'post_type' => array('post', 'page'),
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-blog.php',
                            'posts_per_page' => 1,
                            'fields' => 'ids'
                        ));
                        $blog_url = $blog_pages ? get_permalink($blog_pages[0]) : '#';
                        ?>
                        <a href="<?php echo esc_url( $blog_url ); ?>" class="btn-secondary"><?php echo esc_html( get_theme_mod( 'blog_return_btn', '← Повернутися до списку' ) ); ?></a>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; // End of the loop. ?>

</main><!-- #main -->

<?php
get_footer();
