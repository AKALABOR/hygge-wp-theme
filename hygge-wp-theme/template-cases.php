<?php
/**
 * Template Name: Кейси
 */
get_header();
?>

<main id="primary" class="site-main">

    <section class="inner-hero">
        <div class="container">
            <h1><?php echo get_post_meta( get_the_ID(), 'cases_title', true ) ?: 'Реалізовані проекти'; ?></h1>
            <p><?php echo get_post_meta( get_the_ID(), 'cases_subtitle', true ) ?: 'Дізнайтеся, як ми допомагаємо бізнесу переходити на SAP Business One.'; ?></p>
        </div>
    </section>

    <section class="page-content" style="padding-top: 0;">
        <div class="container">

            <div class="page-filters">
                <button class="filter-btn active" data-filter="all">Всі кейси</button>
                <?php
                $filters_string = get_post_meta( get_the_ID(), 'cases_filters', true );
                if ( $filters_string ) {
                    $filters = array_map('trim', explode(',', $filters_string));
                    foreach ( $filters as $filter ) {
                        if ( !empty($filter) ) {
                            $slug = sanitize_title($filter);
                            echo '<button class="filter-btn" data-filter="' . esc_attr($slug) . '">' . esc_html($filter) . '</button>';
                        }
                    }
                } else {
                    // Fallback
                    echo '<button class="filter-btn" data-filter="production">Виробництво</button>';
                    echo '<button class="filter-btn" data-filter="distribution">Дистрибуція</button>';
                    echo '<button class="filter-btn" data-filter="retail">Рітейл</button>';
                }
                ?>
            </div>

            <!-- Динамічний вивід кейсів -->
            <div class="promo-grid">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $cases_query = new WP_Query( array(
                    'post_type' => array( 'page', 'post' ),
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'template-single-case.php',
                    'posts_per_page' => 6,
                    'paged' => $paged
                ) );

                if ( $cases_query->have_posts() ) :
                    while ( $cases_query->have_posts() ) : $cases_query->the_post();
                        $case_tag = get_post_meta( get_the_ID(), 'case_tag', true );
                        $filter_class = '';
                        if ( $case_tag ) {
                            $filter_class = sanitize_title($case_tag);
                        }
                        $case_result = get_post_meta( get_the_ID(), 'case_result', true );
                ?>
                        <article class="item-card" data-category="<?php echo esc_attr($filter_class); ?>">
                            <div class="card-image">
                                <?php if ( $case_tag ) : ?>
                                    <span class="card-tag"><?php echo esc_html($case_tag); ?></span>
                                <?php endif; ?>
                                <?php 
                                $case_hero_img_url = get_post_meta( get_the_ID(), 'case_hero_img_url', true );
                                if ( $case_hero_img_url ) : ?>
                                    <img src="<?php echo esc_url($case_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $case_hero_img_url, get_the_title() ) ); ?>">
                                <?php elseif ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo $case_result ? esc_html($case_result) : wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn-link"><?php echo esc_html( get_theme_mod( 'cases_read_more', 'Читати кейс →' ) ); ?></a>
                            </div>
                        </article>
                <?php
                    endwhile;
                else :
                    echo '<p>Кейси ще не додані. Створіть новий запис та оберіть шаблон "Кейс (Окремий)".</p>';
                endif;
                ?>
            </div>

            <div class="pagination">
                <?php 
                echo paginate_links( array(
                    'total' => $cases_query->max_num_pages,
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
