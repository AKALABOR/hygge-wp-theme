<?php
/**
 * Template Name: Акції
 */
get_header();
?>

<main id="primary" class="site-main">

    <section class="inner-hero">
        <div class="container">
            <h1><?php echo get_post_meta( get_the_ID(), 'promos_title', true ) ?: 'Акції та Спецпропозиції'; ?></h1>
            <p><?php echo get_post_meta( get_the_ID(), 'promos_subtitle', true ) ?: 'Ми цінуємо наших клієнтів і регулярно готуємо вигідні умови для старту автоматизації.'; ?></p>
        </div>
    </section>

    <section class="page-content" style="padding-top: 0;">
        <div class="container">
            <div class="cards-grid">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $promos_query = new WP_Query( array(
                    'post_type' => array( 'page', 'post' ),
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'template-promo-single.php',
                    'posts_per_page' => 6,
                    'paged' => $paged
                ) );

                if ( $promos_query->have_posts() ) :
                    while ( $promos_query->have_posts() ) : $promos_query->the_post();
                        $promo_tag = get_post_meta( get_the_ID(), 'promo_tag', true );
                        $promo_deadline = get_post_meta( get_the_ID(), 'promo_deadline', true );
                        $promo_btn_text = get_post_meta( get_the_ID(), 'promo_btn_text', true );
                ?>
                        <article class="item-card">
                            <div class="card-image">
                                <?php if ( $promo_tag ) : ?>
                                    <span class="card-tag promo"><?php echo esc_html($promo_tag); ?></span>
                                <?php endif; ?>
                                <?php 
                                $promo_hero_img_url = get_post_meta( get_the_ID(), 'promo_hero_img_url', true );
                                if ( $promo_hero_img_url ) : ?>
                                    <img src="<?php echo esc_url($promo_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $promo_hero_img_url, get_the_title() ) ); ?>">
                                <?php elseif ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=800&q=80" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <?php if ( $promo_deadline ) : ?>
                                    <?php 
                                    $d_icon = get_post_meta( get_the_ID(), 'promo_deadline_icon', true );
                                    $icon_out = $d_icon ? $d_icon . ' ' : '⏳ '; 
                                    ?>
                                    <div class="card-meta"><?php echo wp_kses_post($icon_out); ?><?php echo esc_html($promo_deadline); ?></div>
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn-primary" style="margin-top: auto;">
                                    <?php echo $promo_btn_text ? esc_html($promo_btn_text) : 'Детальніше'; ?>
                                </a>
                            </div>
                        </article>
                <?php
                    endwhile;
                else :
                    echo '<p>Акції ще не додані. Створіть новий запис та оберіть шаблон "Акція (Окрема)".</p>';
                endif;
                ?>
            </div>
            
            <div class="pagination" style="margin-top: 40px; display: flex; justify-content: center; gap: 8px;">
                <?php 
                echo paginate_links( array(
                    'total' => $promos_query->max_num_pages,
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

    <?php
    while ( have_posts() ) :
        the_post();
        // Here you can output any additional content added via the standard WP editor
        echo '<div class="container">';
        the_content();
        echo '</div>';
    endwhile;
    ?>

</main><!-- #main -->

<?php
get_footer();
