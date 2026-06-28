<?php
/**
 * Template Name: Акція (Окрема)
 * Template Post Type: post, page
 */
get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <section class="inner-hero" style="margin-bottom: 40px;">
            <div class="container">
                <span class="card-tag promo"><?php echo get_post_meta( get_the_ID(), 'promo_tag', true ) ?: 'Знижка -20%'; ?></span>
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section class="page-content">
            <div class="container">
                <div class="promo-single-layout">

                    <?php 
                    $promo_hero_img_url = get_post_meta( get_the_ID(), 'promo_hero_img_url', true );
                    if ( $promo_hero_img_url ) : ?>
                        <img src="<?php echo esc_url($promo_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $promo_hero_img_url, get_the_title() ) ); ?>" class="promo-cover">
                    <?php elseif ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full', array('class' => 'promo-cover')); ?>
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1000&q=80"
                            alt="Акція" class="promo-cover">
                    <?php endif; ?>

                    <div class="promo-text-content">
                        <h2><?php echo get_post_meta( get_the_ID(), 'promo_subtitle', true ) ?: 'Умови спеціальної пропозиції'; ?></h2>
                        <div class="promo-description">
                            <?php the_content(); ?>
                        </div>

                        <?php 
                        $benefits_html = get_post_meta( get_the_ID(), 'promo_benefits_html', true );
                        if ( $benefits_html ) :
                            echo $benefits_html;
                        else :
                        ?>
                        <ul class="promo-benefits">
                            <li>
                                <?php 
                                $b_icon = get_theme_mod('promo_benefit_icon', '');
                                if ($b_icon) { echo $b_icon; } else { ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D500F9"
                                    stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <?php } ?>
                                Безкоштовний передпроектний аудит
                            </li>
                            <li>
                                <?php 
                                $b_icon = get_theme_mod('promo_benefit_icon', '');
                                if ($b_icon) { echo $b_icon; } else { ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D500F9"
                                    stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <?php } ?>
                                -20% на ліцензії SAP Starter Package
                            </li>
                            <li>
                                <?php 
                                $b_icon = get_theme_mod('promo_benefit_icon', '');
                                if ($b_icon) { echo $b_icon; } else { ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D500F9"
                                    stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <?php } ?>
                                Пріоритетна підтримка на 3 місяці
                            </li>
                        </ul>
                        <?php endif; ?>

                        <div class="promo-action-box glass-card">
                            <div class="promo-deadline">
                                <?php 
                                $d_icon = get_post_meta( get_the_ID(), 'promo_deadline_icon', true );
                                if ($d_icon) { echo $d_icon; } else { ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <?php } ?>
                                <?php echo get_post_meta( get_the_ID(), 'promo_deadline', true ) ?: 'Пропозиція діє до 31.05.2026'; ?>
                            </div>
                            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'promo_btn_url', true ) ?: '#contacts' ); ?>" class="btn-primary"
                                style="font-size: 1.1rem; padding: 15px 40px;"><?php echo get_post_meta( get_the_ID(), 'promo_btn_text', true ) ?: 'Забронювати знижку'; ?></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
