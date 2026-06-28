<?php
/**
 * The template for displaying the front page
 *
 * Template Name: Головна сторінка
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- HERO SECTION -->
    <section class="hero" id="hero" aria-labelledby="hero-title">
        <div class="hero-container container">
            <div class="hero-content">
                <?php 
                $hero_badge = get_post_meta( get_the_ID(), 'hero_badge', true );
                if ( $hero_badge ) : ?>
                    <span class="hero-badge"><?php echo esc_html( $hero_badge ); ?></span>
                <?php endif; ?>
                
                <h1 id="hero-title">
                    <?php 
                    $hero_title_main = get_post_meta( get_the_ID(), 'hero_title_main', true );
                    $hero_title_highlight = get_post_meta( get_the_ID(), 'hero_title_highlight', true );
                    
                    if ( $hero_title_main || $hero_title_highlight ) {
                        if ( $hero_title_main ) echo esc_html( $hero_title_main ) . '<br>';
                        if ( $hero_title_highlight ) echo '<span>' . esc_html( $hero_title_highlight ) . '</span>';
                    } else {
                        echo 'Надійне впровадження <br><span>SAP Business One</span>';
                    }
                    ?>
                </h1>
                <p>
                    <?php 
                    $hero_subtitle = get_post_meta( get_the_ID(), 'hero_subtitle', true );
                    echo $hero_subtitle ? esc_html( $hero_subtitle ) : 'Позбавляємо від хаосу в обліку. Перехід з 1С/BAS на міжнародне рішення для стабільного контролю та зростання вашого бізнесу.'; 
                    ?>
                </p>
                <ul class="hero-buttons">
                    <li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'hero_btn1_url', true ) ?: '#contacts' ); ?>" class="btn-primary">
                        <?php 
                        $hero_btn1 = get_post_meta( get_the_ID(), 'hero_btn1', true );
                        echo $hero_btn1 ? esc_html( $hero_btn1 ) : 'Отримати консультацію'; 
                        ?>
                    </a></li>
                    <li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'hero_btn2_url', true ) ?: '#solution' ); ?>" class="btn-secondary">
                        <?php 
                        $hero_btn2 = get_post_meta( get_the_ID(), 'hero_btn2', true );
                        echo $hero_btn2 ? esc_html( $hero_btn2 ) : 'Дізнатися більше'; 
                        ?>
                    </a></li>
                </ul>
            </div>
            <figure class="hero-visual">
                <?php 
                $hero_img_url = get_post_meta( get_the_ID(), 'hero_img_url', true );
                if ( $hero_img_url ) : ?>
                    <img src="<?php echo esc_url($hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $hero_img_url, 'Інтерфейс програми' ) ); ?>" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                <?php elseif ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('full'); ?>
                <?php else: ?>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80" alt="Інтерфейс системи SAP Business One" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                <?php endif; ?>
                <figcaption class="sr-only">Інтерфейс системи SAP Business One</figcaption>
            </figure>
        </div>
    </section>

    <!-- PROBLEMS SECTION -->
    <section class="problems" id="problems">
        <div class="container">
            <h2>
                <?php 
                $problems_title = get_post_meta( get_the_ID(), 'problems_title', true );
                echo $problems_title ? esc_html( $problems_title ) : 'Знайомі проблеми?'; 
                ?>
            </h2>
            <?php 
            $problems_text = get_post_meta( get_the_ID(), 'problems_text', true );
            if ( $problems_text ) : ?>
                <p class="section-subtitle" style="text-align: center; margin-bottom: 40px; color: var(--text-muted);">
                    <?php echo esc_html( $problems_text ); ?>
                </p>
            <?php endif; ?>
            
            <ul class="grid">
                <?php 
                $prob_count = get_post_meta( get_the_ID(), 'prob_count', true ) ?: 4;
                for ($i = 1; $i <= $prob_count; $i++) {
                    $title = get_post_meta( get_the_ID(), 'prob'.$i.'_title', true );
                    if (empty($title)) {
                        // Fallback defaults for the first 4 if they are empty
                        if ($i == 1) $title = 'Хаос в обліку';
                        elseif ($i == 2) $title = 'Помилки в даних';
                        elseif ($i == 3) $title = 'Ручні процеси';
                        elseif ($i == 4) $title = 'Залежність від 1С';
                        else continue;
                    }
                    
                    $text = get_post_meta( get_the_ID(), 'prob'.$i.'_text', true );
                    if (empty($text)) {
                        if ($i == 1) $text = 'Дані розкидані по різних таблицях. Немає єдиної картини.';
                        elseif ($i == 2) $text = 'Через ручне введення виникають дублікати та втрати.';
                        elseif ($i == 3) $text = 'Години на зведення звітів замість реальної аналітики.';
                        elseif ($i == 4) $text = 'Ризики старого софту та складнощі з інтеграціями.';
                    }
                    
                    $icon = get_post_meta( get_the_ID(), 'prob'.$i.'_icon', true );
                ?>
                <li class="card">
                    <div class="icon-wrapper">
                        <?php if ($icon) { echo $icon; } else { ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?php } ?>
                    </div>
                    <h3><?php echo esc_html($title); ?></h3>
                    <p><?php echo esc_html($text); ?></p>
                </li>
                <?php } ?>
            </ul>
        </div>
    </section>

    <!-- SOLUTION SECTION -->
    <section class="solution-tabs" id="solution">
        <div class="container">
            <hgroup style="text-align: left; margin-bottom: 40px;">
                <h2>
                    <?php 
                    $solution_title = get_post_meta( get_the_ID(), 'solution_title', true );
                    echo $solution_title ? esc_html( $solution_title ) : 'Як SAP вирішує ці задачі'; 
                    ?>
                </h2>
                <?php 
                $solution_text = get_post_meta( get_the_ID(), 'solution_text', true );
                if ( $solution_text ) : ?>
                    <p class="section-subtitle" style="text-align: left; margin-bottom: 0; color: var(--text-muted);">
                        <?php echo esc_html( $solution_text ); ?>
                    </p>
                <?php endif; ?>
            </hgroup>

            <div class="tabs-layout">
                <div class="tabs-sidebar">
                    <?php 
                    $fp_tab_count = get_post_meta( get_the_ID(), 'fp_tab_count', true ) ?: 4;
                    for ($i = 1; $i <= $fp_tab_count; $i++) {
                        $btn = get_post_meta( get_the_ID(), 'fp_tab'.$i.'_btn', true );
                        if (empty($btn)) {
                            if ($i == 1) $btn = 'Єдина система';
                            elseif ($i == 2) $btn = 'Контроль фінансів';
                            elseif ($i == 3) $btn = 'Автоматизація процесів';
                            elseif ($i == 4) $btn = 'Прозора аналітика';
                            else continue;
                        }
                        $active_class = ($i === 1) ? 'active' : '';
                        echo '<button class="tab-btn ' . $active_class . '" data-tab="tab' . $i . '">' . esc_html($btn) . '</button>';
                    }
                    ?>
                </div>

                <div class="tabs-content-area">
                    <?php 
                    for ($i = 1; $i <= $fp_tab_count; $i++) {
                        $btn = get_post_meta( get_the_ID(), 'fp_tab'.$i.'_btn', true );
                        if (empty($btn) && $i > 4) continue;
                        
                        $title = get_post_meta( get_the_ID(), 'fp_tab'.$i.'_title', true );
                        if (empty($title)) {
                            if ($i == 1) $title = 'Єдина екосистема для всього бізнесу';
                            elseif ($i == 2) $title = 'Повний контроль грошових потоків';
                            elseif ($i == 3) $title = 'Розумна автоматизація рутини';
                            elseif ($i == 4) $title = 'Миттєві дашборди та звіти';
                        }
                        
                        $text = get_post_meta( get_the_ID(), 'fp_tab'.$i.'_text', true );
                        if (empty($text)) {
                            if ($i == 1) $text = 'Управління всіма аспектами бізнесу (продажі, закупівлі, склад) відбувається в єдиному середовищі. Це повністю виключає дублювання даних.';
                            elseif ($i == 2) $text = 'Система дозволяє вести паралельний управлінський та бухгалтерський облік у реальному часі, автоматизує звірки та зводить до нуля ризики.';
                            elseif ($i == 3) $text = 'Налаштування жорстких алгоритмів погодження, автоматичне формування супровідних документів та сповіщення відповідальних осіб.';
                            elseif ($i == 4) $text = 'Вбудовані інтерактивні дашборди дозволяють керівництву приймати швидкі рішення на основі реальних цифр 24/7.';
                        }
                        
                        $img = get_post_meta( get_the_ID(), 'fp_tab'.$i.'_img', true ) ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        $active_class = ($i === 1) ? 'active' : '';
                    ?>
                    <div id="tab<?php echo $i; ?>" class="tab-panel <?php echo $active_class; ?>">
                        <div class="tab-image-placeholder">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $img, 'Ілюстрація' ) ); ?>" class="content-image">
                        </div>
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php get_template_part( 'template-parts/front-page-extra' ); ?>
    
    <?php get_template_part( 'template-parts/form-cta' ); ?>

    <!-- Content from the regular WordPress Editor -->
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

