<?php
/**
 * Template Name: Кейс (Окремий)
 * Template Post Type: post, page
 */
get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <section class="inner-hero" style="margin-bottom: 60px;">
            <div class="container">
                <span class="card-tag"><?php echo get_post_meta( get_the_ID(), 'case_tag', true ) ?: 'Виробництво'; ?></span>
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section class="page-content">
            <div class="container">
                <div class="case-single-layout">

                    <aside class="case-sidebar glass-card">
                        <h3><?php echo get_post_meta( get_the_ID(), 'case_sidebar_title', true ) ?: 'Деталі проекту'; ?></h3>
                        <ul class="case-details-list">
                            <?php 
                            $case_detail_count = get_post_meta( get_the_ID(), 'case_detail_count', true ) ?: 3;
                            for ($i = 1; $i <= $case_detail_count; $i++) {
                                $icon = get_post_meta( get_the_ID(), 'case_detail'.$i.'_icon', true );
                                $label = get_post_meta( get_the_ID(), 'case_detail'.$i.'_label', true );
                                $value = get_post_meta( get_the_ID(), 'case_detail'.$i.'_value', true );

                                // Fallbacks for existing 3 items to preserve legacy data
                                if (empty($icon) && empty($label) && empty($value)) {
                                    if ($i == 1) {
                                        $icon = get_post_meta( get_the_ID(), 'case_client_icon', true ) ?: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
                                        $label = get_post_meta( get_the_ID(), 'case_client_label', true ) ?: 'Клієнт:';
                                        $value = get_post_meta( get_the_ID(), 'case_client', true ) ?: 'ТОВ "МеталБуд"';
                                    } elseif ($i == 2) {
                                        $icon = get_post_meta( get_the_ID(), 'case_duration_icon', true ) ?: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
                                        $label = get_post_meta( get_the_ID(), 'case_duration_label', true ) ?: 'Термін:';
                                        $value = get_post_meta( get_the_ID(), 'case_duration', true ) ?: '4 місяці';
                                    } elseif ($i == 3) {
                                        $icon = get_post_meta( get_the_ID(), 'case_result_icon', true ) ?: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>';
                                        $label = get_post_meta( get_the_ID(), 'case_result_label', true ) ?: 'Результат:';
                                        $value = get_post_meta( get_the_ID(), 'case_result', true ) ?: '+40% до швидкості обробки';
                                    } else {
                                        continue;
                                    }
                                }
                            ?>
                            <li>
                                <?php echo $icon; ?>
                                <div><strong><?php echo esc_html($label); ?></strong> <?php echo esc_html($value); ?></div>
                            </li>
                            <?php } ?>
                        </ul>
                    </aside>

                    <div class="case-main-content">
                        <?php 
                        $case_hero_img_url = get_post_meta( get_the_ID(), 'case_hero_img_url', true );
                        if ( $case_hero_img_url ) : ?>
                            <img src="<?php echo esc_url($case_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $case_hero_img_url, get_the_title() ) ); ?>" class="case-cover">
                        <?php elseif ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'case-cover')); ?>
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1200&q=80"
                                alt="Завод" class="case-cover">
                        <?php endif; ?>

                        <?php the_content(); ?>

                        <?php 
                        $highlight_title = get_post_meta( get_the_ID(), 'case_highlight_title', true );
                        $highlight_text = get_post_meta( get_the_ID(), 'case_highlight_text', true );
                        if ($highlight_title || $highlight_text) :
                        ?>
                        <div class="result-highlight glass-card">
                            <h3><?php echo esc_html($highlight_title ?: 'Головний результат'); ?></h3>
                            <p><?php echo esc_html($highlight_text ?: 'Усунення касових розривів та скорочення часу виконання замовлення на 40% за рахунок прозорого планування.'); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="article-footer" style="margin-top: 50px;">
                    <a href="<?php echo esc_url( home_url( '/cases' ) ); ?>" class="btn-secondary"><?php echo esc_html( get_theme_mod( 'cases_return_btn', '← Всі реалізовані проекти' ) ); ?></a>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
