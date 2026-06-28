<?php
/**
 * Template Name: Блог (Загальна)
 */
get_header();
?>

<main id="primary" class="site-main">

    <section class="inner-hero">
        <div class="container">
            <h1><?php echo get_post_meta( get_the_ID(), 'blog_title', true ) ?: 'Наш Блог'; ?></h1>
            <p><?php echo get_post_meta( get_the_ID(), 'blog_subtitle', true ) ?: 'Ділимося експертними статтями про ERP, автоматизацію та розвиток бізнесу в Україні.'; ?></p>
        </div>
    </section>

    <section class="page-content" style="padding-top: 0;">
        <div class="container">
            <div class="page-filters">
                <button class="filter-btn active" data-filter="all">Всі статті</button>
                <?php
                $categories = get_categories();
                foreach($categories as $category) {
                    if ( $category->slug === 'uncategorized' || $category->slug === 'bez-kategoriyi' || $category->name === 'Без категорії' ) continue;
                    echo '<button class="filter-btn" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                }
                ?>
            </div>

            <div class="blog-grid">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $blog_query = new WP_Query( array(
                    'post_type' => 'post',
                    'posts_per_page' => 9,
                    'paged' => $paged,
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => '_wp_page_template',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_wp_page_template',
                            'value' => array('default', ''),
                            'compare' => 'IN'
                        )
                    )
                ) );

                if ( $blog_query->have_posts() ) :
                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
                ?>
                        
                        <?php 
                        $cats = get_the_category();
                        $cat_slug = !empty($cats) ? $cats[0]->slug : 'all'; 
                        ?>
                        <article class="item-card" data-category="<?php echo esc_attr($cat_slug); ?>">
                            <div class="card-image">
                                <?php 
                                $article_hero_img_url = get_post_meta( get_the_ID(), 'article_hero_img_url', true );
                                if ( $article_hero_img_url ) : ?>
                                    <img src="<?php echo esc_url($article_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $article_hero_img_url, get_the_title() ) ); ?>">
                                <?php elseif ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="card-meta"><?php echo get_post_meta( get_the_ID(), 'article_custom_date', true ) ?: '📅 ' . get_the_date(); ?></div>
                                <h3><?php the_title(); ?></h3>
                                <div class="excerpt-wrapper" style="margin-bottom: 15px; color: var(--text-muted);">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-link"><?php echo esc_html( get_theme_mod( 'blog_read_more', 'Читати статтю →' ) ); ?></a>
                            </div>
                        </article>

                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Статті ще не додані. Створіть новий запис у розділі "Записи".</p>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <?php 
                echo paginate_links( array(
                    'total' => $blog_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => get_theme_mod( 'pagination_prev', '←' ),
                    'next_text' => get_theme_mod( 'pagination_next', '→' ),
                    'type'      => 'plain',
                    'before_page_number' => '<span class="page-btn">',
                    'after_page_number' => '</span>'
                ) ); 
                wp_reset_postdata();
                ?>
            </div>
            <style>
                .pagination .page-numbers { display: inline-block; padding: 10px 16px; margin: 0 4px; border-radius: 8px; border: 1px solid var(--border-color); color: var(--text-color); text-decoration: none; font-weight: 500; transition: all 0.3s ease; }
                .pagination .page-numbers.current { background: var(--accent-blue); color: #fff; border-color: var(--accent-blue); }
                .pagination .page-numbers:not(.current):hover { background: var(--surface-bg); color: var(--accent-blue); border-color: var(--accent-blue); }
            </style>
        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
