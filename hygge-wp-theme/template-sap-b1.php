<?php
/**
 * Template Name: SAP Business One
 */
get_header();
?>

<main id="primary" class="site-main">

    <section class="hero sap-hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="badge"><?php echo get_post_meta( get_the_ID(), 'sap_badge', true ) ?: 'Міжнародний стандарт ERP'; ?></span>
                    <h1><?php echo get_post_meta( get_the_ID(), 'sap_hero_title', true ) ?: 'SAP Business One: Інтелектуальне управління бізнесом'; ?></h1>
                    <p><?php echo get_post_meta( get_the_ID(), 'sap_hero_text', true ) ?: 'Єдина екосистема для масштабування компанії, яка об\'єднує фінанси, продажі, склад та виробництво в одному вікні. Рішення, якому довіряють понад 75,000 компаній у світі.'; ?></p>
                    <div class="hero-buttons">
                        <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'sap_btn1_url', true ) ?: '#contacts' ); ?>" class="btn-primary"><?php echo get_post_meta( get_the_ID(), 'sap_btn1', true ) ?: 'Замовити презентацію'; ?></a>
                        <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'sap_btn2_url', true ) ?: '#modules' ); ?>" class="btn-secondary"><?php echo get_post_meta( get_the_ID(), 'sap_btn2', true ) ?: 'Завантажити брошуру'; ?></a>
                    </div>
                </div>

                <figure class="hero-visual">
                    <?php 
                    $sap_hero_img_url = get_post_meta( get_the_ID(), 'sap_hero_img_url', true );
                    if ( $sap_hero_img_url ) : ?>
                        <img src="<?php echo esc_url($sap_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $sap_hero_img_url, 'Інтерфейс системи SAP Business One' ) ); ?>" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                    <?php elseif ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80" alt="Інтерфейс системи SAP Business One" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                    <?php endif; ?>
                    <figcaption class="sr-only">Інтерфейс системи SAP Business One</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="sap-intro-section">
        <div class="container">
            <div class="sap-intro-grid">
                <div class="intro-text">
                    <h2><?php echo get_post_meta( get_the_ID(), 'sap_intro_title', true ) ?: 'Більше ніж просто облік'; ?></h2>
                    <p><?php echo get_post_meta( get_the_ID(), 'sap_intro_text1', true ) ?: '<strong>SAP Business One</strong> — це не окрема бухгалтерська програма, а комплексне рішення для управління підприємством (ERP). Вона розроблена спеціально для середнього та малого бізнесу, який прагне працювати за світовими стандартами.'; ?></p>
                    <p><?php echo get_post_meta( get_the_ID(), 'sap_intro_text2', true ) ?: 'На відміну від локального софту, SAP B1 побудована на принципі <strong>єдиного джерела істини</strong>. Це означає, що дані, введені у відділі продажу, миттєво відображаються у фінансовому звіті та плані закупівель на складі без будь-яких ручних переносів чи синхронізацій.'; ?></p>
                </div>
                <div class="intro-stats">
                    <div class="stat-card glass-card">
                        <h3><?php echo esc_html( get_post_meta( get_the_ID(), 'sap_stat1_num', true ) ?: '170+' ); ?></h3>
                        <p><?php echo esc_html( get_post_meta( get_the_ID(), 'sap_stat1_text', true ) ?: 'країн підтримують SAP B1' ); ?></p>
                    </div>
                    <div class="stat-card glass-card">
                        <h3><?php echo esc_html( get_post_meta( get_the_ID(), 'sap_stat2_num', true ) ?: '50+' ); ?></h3>
                        <p><?php echo esc_html( get_post_meta( get_the_ID(), 'sap_stat2_text', true ) ?: 'локалізацій (включаючи Україну)' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="modules" class="sap-modules">
        <div class="container">
            <h2 class="section-title"><?php echo get_post_meta( get_the_ID(), 'sap_modules_title', true ) ?: 'Функціональні можливості системи'; ?></h2>
            <div class="modules-grid">
                <?php 
                $sap_mod_count = get_post_meta( get_the_ID(), 'sap_mod_count', true ) ?: 4;
                for ($i = 1; $i <= $sap_mod_count; $i++) {
                    $title = get_post_meta( get_the_ID(), 'sap_mod'.$i.'_title', true );
                    if (empty($title)) {
                        if ($i == 1) $title = 'Фінанси та бухгалтерський облік';
                        elseif ($i == 2) $title = 'Продажі та CRM';
                        elseif ($i == 3) $title = 'Запаси та Дистрибуція';
                        elseif ($i == 4) $title = 'Виробництво та MRP';
                        else continue;
                    }
                    
                    $text = get_post_meta( get_the_ID(), 'sap_mod'.$i.'_text', true );
                    if (empty($text)) {
                        if ($i == 1) $text = 'Автоматизація всіх основних бухгалтерських операцій: від плану рахунків та проводок до багатовалютної звітності та податкового обліку. Повний контроль грошових потоків у реальному часі.';
                        elseif ($i == 2) $text = 'Керуйте всім життєвим циклом клієнта. Відстежуйте потенційні угоди (Opportunities), історію комунікацій, сервісне обслуговування та аналітику продажів у розрізі менеджерів.';
                        elseif ($i == 3) $text = 'Точний облік складських залишків, керування декількома складами, облік за серійними номерами та партіями. Оптимізація закупівель на основі прогнозів споживання.';
                        elseif ($i == 4) $text = 'Планування потреби в матеріалах (MRP), створення специфікацій (BOM), керування замовленнями на виробництво та розрахунок точної собівартості готової продукції.';
                    }
                    
                    $icon = get_post_meta( get_the_ID(), 'sap_mod'.$i.'_icon', true );
                ?>
                <div class="module-card item-card">
                    <div class="card-body">
                        <div class="module-icon">
                            <?php if ($icon) { echo $icon; } else { ?>
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--accent-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                    <path d="M2 17l10 5 10-5"></path>
                                    <path d="M2 12l10 5 10-5"></path>
                                </svg>
                            <?php } ?>
                        </div>
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="sap-tech-block">
        <div class="container">
            <div class="tech-layout">
                <div class="tech-image">
                    <div class="hana-badge"><?php echo esc_html( get_post_meta( get_the_ID(), 'sap_hana_badge', true ) ?: 'Powered by SAP HANA' ); ?></div>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80"
                        alt="SAP HANA Analytics">
                </div>
                <div class="tech-content">
                    <h2><?php echo get_post_meta( get_the_ID(), 'sap_tech_title', true ) ?: 'Швидкість SAP HANA та Аналітика'; ?></h2>
                    <p><?php echo get_post_meta( get_the_ID(), 'sap_tech_text', true ) ?: 'Завдяки технології обробки даних у пам\'яті (In-Memory), ви отримуєте звіти за мілісекунди, навіть якщо у вас мільйони записів.'; ?></p>
                    <ul class="check-list">
                        <?php 
                        $sap_tech_check_count = get_post_meta( get_the_ID(), 'sap_tech_check_count', true ) ?: 3;
                        for ($i = 1; $i <= $sap_tech_check_count; $i++) {
                            $check = get_post_meta( get_the_ID(), 'sap_tech_check'.$i, true );
                            if (empty($check)) {
                                if ($i == 1) $check = '✓ <strong>Інтерактивні дашборди:</strong> бачте ключові показники (KPI) на головному екрані.';
                                elseif ($i == 2) $check = '✓ <strong>Прогнозний аналіз:</strong> система підкаже, коли товар закінчиться на складі.';
                                elseif ($i == 3) $check = '✓ <strong>Мобільність:</strong> працюйте через Web-клієнт або мобільний додаток з будь-якої точки світу.';
                                else continue;
                            }
                            echo '<li>' . wp_kses_post($check) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="deployment-section">
        <div class="container">
            <h2 style="text-align: center;"><?php echo get_post_meta( get_the_ID(), 'sap_deploy_title', true ) ?: 'Де розмістити систему?'; ?></h2>
            <p style="text-align: center; color: var(--text-muted);"><?php echo get_post_meta( get_the_ID(), 'sap_deploy_subtitle', true ) ?: 'Виберіть варіант, який найкраще підходить вашому масштабу та ІТ-стратегії'; ?></p>

            <div class="comparison-wrapper">
                <div class="comparison-card">
                    <h3><?php echo get_post_meta( get_the_ID(), 'sap_dep_op_title', true ) ?: 'On-Premise'; ?></h3>
                    <p><strong><?php echo get_post_meta( get_the_ID(), 'sap_dep_op_subtitle', true ) ?: 'Ваш власний сервер'; ?></strong></p>
                    <ul>
                        <?php 
                        $sap_dep_op_l_count = get_post_meta( get_the_ID(), 'sap_dep_op_l_count', true ) ?: 5;
                        for ($i = 1; $i <= $sap_dep_op_l_count; $i++) {
                            $item = get_post_meta( get_the_ID(), 'sap_dep_op_l'.$i, true );
                            if (empty($item)) {
                                if ($i == 1) $item = '✓ Повний контроль над даними';
                                elseif ($i == 2) $item = '✓ Одноразова інвестиція в ліцензії';
                                elseif ($i == 3) $item = '✓ Власна ІТ-інфраструктура';
                                elseif ($i == 4) $item = '✓ Можливість глибокої кастомізації';
                                elseif ($i == 5) $item = '✓ Незалежність від провайдерів';
                                else continue;
                            }
                            echo '<li>' . esc_html($item) . '</li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="comparison-card" style="border: 2px solid var(--accent-blue);">
                    <h3><?php echo get_post_meta( get_the_ID(), 'sap_dep_cl_title', true ) ?: 'Cloud'; ?></h3>
                    <p><strong><?php echo get_post_meta( get_the_ID(), 'sap_dep_cl_subtitle', true ) ?: 'Хмарне рішення'; ?></strong></p>
                    <ul>
                        <?php 
                        $sap_dep_cl_l_count = get_post_meta( get_the_ID(), 'sap_dep_cl_l_count', true ) ?: 5;
                        for ($i = 1; $i <= $sap_dep_cl_l_count; $i++) {
                            $item = get_post_meta( get_the_ID(), 'sap_dep_cl_l'.$i, true );
                            if (empty($item)) {
                                if ($i == 1) $item = '✓ Швидкий запуск (від 2 днів)';
                                elseif ($i == 2) $item = '✓ Щомісячна передплата без великих вкладень';
                                elseif ($i == 3) $item = '✓ Доступ з будь-якої точки світу 24/7';
                                elseif ($i == 4) $item = '✓ Автоматичне оновлення системи';
                                elseif ($i == 5) $item = '✓ Висока безпека та бекапи від провайдера';
                                else continue;
                            }
                            echo '<li>' . esc_html($item) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 style="text-align:center"><?php echo get_post_meta( get_the_ID(), 'sap_features_title', true ) ?: 'Основні можливості SAP Business One'; ?></h2>
            <div class="features-grid-8">
                <?php 
                $sap_feat_count = get_post_meta( get_the_ID(), 'sap_feat_count', true ) ?: 8;
                for ($i = 1; $i <= $sap_feat_count; $i++) {
                    $title = get_post_meta( get_the_ID(), 'sap_feat'.$i.'_title', true );
                    if (empty($title)) {
                        if ($i == 1) $title = 'Фінанси';
                        elseif ($i == 2) $title = 'CRM';
                        elseif ($i == 3) $title = 'Закупівлі';
                        elseif ($i == 4) $title = 'Склад';
                        elseif ($i == 5) $title = 'Виробництво';
                        elseif ($i == 6) $title = 'Проекти';
                        elseif ($i == 7) $title = 'Аналітика';
                        elseif ($i == 8) $title = 'Мобільність';
                        else continue;
                    }
                    
                    $text = get_post_meta( get_the_ID(), 'sap_feat'.$i.'_text', true );
                    if (empty($text)) {
                        if ($i == 1) $text = 'Управління капіталом та звітність';
                        elseif ($i == 2) $text = 'Продажі та лояльність клієнтів';
                        elseif ($i == 3) $text = 'Контроль витрат та постачальників';
                        elseif ($i == 4) $text = 'Оптимізація залишків та логістика';
                        elseif ($i == 5) $text = 'MRP та контроль ресурсів';
                        elseif ($i == 6) $text = 'Облік робочого часу та етапів';
                        elseif ($i == 7) $text = 'Звіти в реальному часі HANA';
                        elseif ($i == 8) $text = 'Доступ через iOS та Android';
                    }
                ?>
                <div class="item-card feature-mini-card">
                    <h4><?php echo esc_html($title); ?></h4>
                    <p><?php echo esc_html($text); ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/form-cta' ); ?>

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
