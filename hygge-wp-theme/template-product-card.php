<?php
/**
 * Template Name: Картка програми/модуля
 * Template Post Type: post, page
 */
get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <section class="pc-hero">
            <div class="container">
                <div class="pc-hero-layout">

                    <div class="pc-hero-inner">
                        <span class="badge"><?php echo get_post_meta( get_the_ID(), 'prod_badge', true ) ?: 'Програмний модуль SAP Business One'; ?></span>
                        <h1><span><?php the_title(); ?></span></h1>
                        <p><?php echo get_post_meta( get_the_ID(), 'prod_hero_text', true ) ?: 'Функціональний блок допомагає Маркетингу фіксувати всі активності та кампанії, а Продажам – фіксувати активності по кожному клієнту.'; ?></p>
                        <div class="pc-hero-btns">
                            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'prod_btn1_url', true ) ?: '#contacts' ); ?>" class="btn-primary"><?php echo get_post_meta( get_the_ID(), 'prod_btn1', true ) ?: 'Отримати демо-доступ ↓'; ?></a>
                            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'prod_btn2_url', true ) ?: '#features' ); ?>" class="btn-secondary"><?php echo get_post_meta( get_the_ID(), 'prod_btn2', true ) ?: 'Дізнатися більше'; ?></a>
                        </div>
                    </div>

                    <div class="pc-hero-visual">
                        <figure class="hero-visual">
                            <?php 
                            $prod_hero_img_url = get_post_meta( get_the_ID(), 'prod_hero_img_url', true );
                            if ( $prod_hero_img_url ) : ?>
                                <img src="<?php echo esc_url($prod_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $prod_hero_img_url, 'Інтерфейс програми' ) ); ?>" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                            <?php elseif ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80"
                                    alt="Інтерфейс програми" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                            <?php endif; ?>
                            <figcaption class="sr-only">Інтерфейс програмного продукту</figcaption>
                        </figure>
                    </div>

                </div>
            </div>
        </section>

        <section class="pc-feature-intro">
            <div class="container">
                <div class="pc-feature-grid">

                    <div class="pc-feature-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80"
                            alt="Інтерфейс програми">
                        <div class="pc-feature-image-overlay"></div>
                    </div>

                    <div class="pc-feature-content">
                        <span class="section-label"><?php echo get_post_meta( get_the_ID(), 'prod_intro_label', true ) ?: 'Чому це важливо'; ?></span>
                        <h2><span style="-webkit-text-fill-color: transparent; background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text;">
                            <?php echo get_post_meta( get_the_ID(), 'prod_intro_title', true ) ?: 'Повністю прозоре ведення кожного клієнта'; ?>
                        </span></h2>
                        <p><?php echo get_post_meta( get_the_ID(), 'prod_intro_text', true ) ?: 'Керівництво компанії в будь-який час має можливість побачити статус кожного клієнта.'; ?></p>

                        <ul class="pc-feature-list">
                            <li>
                                <div>
                                    <strong><?php echo get_post_meta( get_the_ID(), 'prod_list1_title', true ) ?: 'Підвищення задоволеності клієнтів'; ?></strong>
                                    <span><?php echo get_post_meta( get_the_ID(), 'prod_list1_text', true ) ?: 'За рахунок можливості зручного та своєчасного управління відносинами.'; ?></span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <strong><?php echo get_post_meta( get_the_ID(), 'prod_list2_title', true ) ?: 'Збільшення кількості успішних угод'; ?></strong>
                                    <span><?php echo get_post_meta( get_the_ID(), 'prod_list2_text', true ) ?: 'Аналітика та чіткий контроль етапів продажів допомагають закривати більше угод.'; ?></span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <strong><?php echo get_post_meta( get_the_ID(), 'prod_list3_title', true ) ?: 'Скорочення часу на пошук інформації'; ?></strong>
                                    <span><?php echo get_post_meta( get_the_ID(), 'prod_list3_text', true ) ?: 'Всі дані по клієнтах в єдиному місці.'; ?></span>
                                </div>
                            </li>
                        </ul>

                        <a href="#contacts" class="btn-primary" style="align-self: flex-start;"><?php echo esc_html( get_post_meta( get_the_ID(), 'prod_intro_btn_text', true ) ?: 'Замовити презентацію →' ); ?></a>
                    </div>

                </div>
            </div>
        </section>

        <section class="pc-highlight-band">
            <div class="pc-highlight-inner">
                <div class="container">
                    <div class="pc-highlight-content">

                        <div class="pc-highlight-icon">
                            <?php 
                            $h_icon = get_post_meta( get_the_ID(), 'prod_highlight_icon', true );
                            if ($h_icon) { echo $h_icon; } else { ?>
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <?php } ?>
                        </div>

                        <div class="pc-highlight-text">
                            <strong><?php echo get_post_meta( get_the_ID(), 'prod_highlight_title', true ) ?: 'Мінімізація ризиків втрати клієнта'; ?></strong>
                            <p><?php echo get_post_meta( get_the_ID(), 'prod_highlight_text', true ) ?: 'Система не дозволить забути про клієнта: календар активностей, воронка продажів та інтеграція з Microsoft Outlook гарантують своєчасну комунікацію.'; ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="pc-features-section section" id="features">
            <div class="container">
                <h2><?php echo get_post_meta( get_the_ID(), 'prod_features_title', true ) ?: 'Ключові можливості'; ?></h2>
                <p class="pc-features-subtitle"><?php echo get_post_meta( get_the_ID(), 'prod_features_subtitle', true ) ?: 'Те, що відрізняє цю програму від решти'; ?></p>

                <div class="zigzag-wrapper">
                    <?php 
                    $prod_feat_count = get_post_meta( get_the_ID(), 'prod_feat_count', true ) ?: 3;
                    for ($i = 1; $i <= $prod_feat_count; $i++) {
                        $title = get_post_meta( get_the_ID(), 'prod_feat'.$i.'_title', true );
                        if (empty($title)) {
                            if ($i == 1) $title = 'Ведення можливостей продажів та історії клієнта';
                            elseif ($i == 2) $title = 'Маркетингові кампанії та активності';
                            elseif ($i == 3) $title = 'Детальна аналітика та звіти';
                            else continue;
                        }
                        
                        $text = get_post_meta( get_the_ID(), 'prod_feat'.$i.'_text', true );
                        if (empty($text)) {
                            if ($i == 1) $text = 'Картка бізнес-партнера містить контактну інформацію, характеристики та умови оплати.';
                            elseif ($i == 2) $text = 'Організовуйте календар активностей та маркетингові кампанії.';
                            elseif ($i == 3) $text = 'Відстежуйте прогнози продажів, аналізуйте причини втрачених угод та працюйте з детальними звітами в режимі реального часу.';
                        }
                        
                        $img = get_post_meta( get_the_ID(), 'prod_feat'.$i.'_img', true );
                        if (empty($img)) {
                            if ($i == 1) $img = 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80';
                            elseif ($i == 2) $img = 'https://images.unsplash.com/photo-1432888622747-4eb9a8f2c293?auto=format&fit=crop&w=800&q=80';
                            elseif ($i == 3) $img = 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                            else $img = 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80';
                        }
                        
                        $btn = get_post_meta( get_the_ID(), 'prod_feat'.$i.'_btn', true ) ?: 'Детальніше';
                        $url = get_post_meta( get_the_ID(), 'prod_feat'.$i.'_btn_url', true ) ?: '#contacts';
                        
                        $reverse_class = ($i % 2 == 0) ? ' reverse' : '';
                    ?>
                    <div class="zigzag-row<?php echo $reverse_class; ?>">
                        <div class="zigzag-image">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $img, $title ) ); ?>">
                        </div>
                        <div class="zigzag-text">
                            <h3><?php echo esc_html($title); ?></h3>
                            <p><?php echo esc_html($text); ?></p>
                            <a href="<?php echo esc_url($url); ?>" class="zigzag-btn"><?php echo esc_html($btn); ?></a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="pc-demo-steps section" id="demo">
            <div class="container">
                <h2><?php echo get_post_meta( get_the_ID(), 'prod_demo_title', true ) ?: 'Як отримати демо-версію програми?'; ?></h2>

                <div class="pc-demo-grid">
                    <?php 
                    $prod_demo_count = get_post_meta( get_the_ID(), 'prod_demo_count', true ) ?: 4;
                    for ($i = 1; $i <= $prod_demo_count; $i++) {
                        $title = get_post_meta( get_the_ID(), 'prod_demo'.$i.'_title', true );
                        if (empty($title)) {
                            if ($i == 1) $title = 'Залиште заявку';
                            elseif ($i == 2) $title = 'Знайомство та бриф';
                            elseif ($i == 3) $title = 'Онлайн-презентація';
                            elseif ($i == 4) $title = 'Тестовий доступ';
                            else continue;
                        }
                        
                        $text = get_post_meta( get_the_ID(), 'prod_demo'.$i.'_text', true );
                        if (empty($text)) {
                            if ($i == 1) $text = 'Заповніть коротку форму нижче або зателефонуйте нам — жодних зайвих питань на старті.';
                            elseif ($i == 2) $text = 'Наш консультант зв\'яжеться з вами, щоб зрозуміти ваш бізнес і підготувати персоналізоване демо.';
                            elseif ($i == 3) $text = 'Проводимо живу демонстрацію програми на ваших реальних кейсах — ви бачите систему в дії.';
                            elseif ($i == 4) $text = 'Надаємо доступ до тестового середовища, щоб ваша команда могла спробувати систему самостійно.';
                        }
                    ?>
                    <div class="pc-demo-step">
                        <div class="pc-demo-step-num"><?php echo $i; ?></div>
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="pc-other-programs section">
            <div class="container">
                <h2><?php echo get_post_meta( get_the_ID(), 'prod_other_title', true ) ?: 'Інші програми Hygge System'; ?></h2>
                <div class="pc-programs-grid">
                    <?php
                    $other_programs = get_posts(array(
                        'post_type'      => array('post', 'page'),
                        'meta_key'       => '_wp_page_template',
                        'meta_value'     => array('template-product-card.php', 'template-sap-b1.php'),
                        'posts_per_page' => 3,
                        'post__not_in'   => array(get_the_ID()),
                        'orderby'        => 'rand'
                    ));

                    if ( $other_programs ) :
                        foreach ( $other_programs as $op ) :
                            // Try to get a short description from prod_hero_text or sap meta
                            $desc = get_post_meta( $op->ID, 'prod_hero_text', true );
                            if ( ! $desc ) {
                                $desc = get_post_meta( $op->ID, 'hero_subtitle', true ); // Fallback for SAP template
                            }
                            // Limit description length if it exists
                            if ( $desc ) {
                                $desc = wp_trim_words( $desc, 15, '...' );
                            } else {
                                $desc = 'Комплексне рішення для управління бізнес-процесами.';
                            }
                            ?>
                            <a href="<?php echo esc_url( get_permalink($op->ID) ); ?>" class="pc-program-card">
                                <div class="pc-program-icon">
                                    <?php 
                                    $o_icon = get_theme_mod( 'prod_other_icon', '' );
                                    if ($o_icon) { echo $o_icon; } else { ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="3" width="20" height="14" rx="2" />
                                        <line x1="8" y1="21" x2="16" y2="21" />
                                        <line x1="12" y1="17" x2="12" y2="21" />
                                    </svg>
                                    <?php } ?>
                                </div>
                                <h3><?php echo esc_html( get_the_title($op->ID) ); ?></h3>
                                <p><?php echo esc_html( $desc ); ?></p>
                                <span class="pc-program-link"><?php echo esc_html( get_theme_mod( 'prod_other_btn', 'Детальніше →' ) ); ?></span>
                            </a>
                            <?php
                        endforeach;
                    else :
                        echo '<p style="grid-column: 1/-1;">Інших програм поки не додано.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <?php get_template_part( 'template-parts/form-cta' ); ?>

    <?php endwhile; ?>

</main><!-- #main -->

<?php
get_footer();
