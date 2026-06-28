<?php
/**
 * Template Name: Міграція
 */
get_header();
?>

<main id="primary" class="site-main">

    <section class="hero sap-hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="badge"><?php echo get_post_meta( get_the_ID(), 'mig_badge', true ) ?: 'Міграція та Розвиток'; ?></span>
                    <h1><?php echo get_post_meta( get_the_ID(), 'mig_title', true ) ?: 'Перехід на SAP Business One'; ?></h1>
                    <p><?php echo get_post_meta( get_the_ID(), 'mig_text', true ) ?: 'Позбавтеся залежності від застарілих систем. Перенесіть бізнес на міжнародну платформу з повною адаптацією під Україну.'; ?></p>
                    <div class="hero-buttons">
                        <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'mig_btn1_url', true ) ?: '#contacts' ); ?>" class="btn-primary"><?php echo get_post_meta( get_the_ID(), 'mig_btn1', true ) ?: 'Отримати консультацію'; ?></a>
                        <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'mig_btn2_url', true ) ?: '#solution' ); ?>" class="btn-secondary"><?php echo get_post_meta( get_the_ID(), 'mig_btn2', true ) ?: 'Деталі переходу'; ?></a>
                    </div>
                </div>

                <figure class="hero-visual">
                    <?php 
                    $mig_hero_img_url = get_post_meta( get_the_ID(), 'mig_hero_img_url', true );
                    if ( $mig_hero_img_url ) : ?>
                        <img src="<?php echo esc_url($mig_hero_img_url); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $mig_hero_img_url, 'Міграція даних на SAP' ) ); ?>" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                    <?php elseif ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80" alt="Міграція даних на SAP" style="border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                    <?php endif; ?>
                    <figcaption class="sr-only">Інтерфейс системи SAP Business One</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title" style="text-align: center;"><?php echo get_post_meta( get_the_ID(), 'mig_systems_title', true ) ?: 'З яких систем ми переводимо бізнес'; ?></h2>
            <div class="mig-grid-6">
                <?php 
                $mig_sys_count = get_post_meta( get_the_ID(), 'mig_sys_count', true ) ?: 6;
                for ($i = 1; $i <= $mig_sys_count; $i++) {
                    $title = get_post_meta( get_the_ID(), 'mig_sys'.$i.'_title', true );
                    if (empty($title)) {
                        if ($i == 1) $title = '1С / BAS';
                        elseif ($i == 2) $title = 'Odoo';
                        elseif ($i == 3) $title = 'Dynamics';
                        elseif ($i == 4) $title = 'Excel';
                        elseif ($i == 5) $title = 'Самописні';
                        elseif ($i == 6) $title = 'Застарілі ERP';
                        else continue;
                    }
                    
                    $desc = get_post_meta( get_the_ID(), 'mig_sys'.$i.'_desc', true );
                    if (empty($desc)) {
                        if ($i == 1) $desc = 'Повна заміна російського софту';
                        elseif ($i == 2) $desc = 'Перехід на стабільне ядро';
                        elseif ($i == 3) $desc = 'Оптимізація вартості';
                        elseif ($i == 4) $desc = 'Від хаосу до єдиної бази';
                        elseif ($i == 5) $desc = 'Стандартизація процесів';
                        elseif ($i == 6) $desc = 'Технологічне оновлення';
                    }
                ?>
                <div class="item-card">
                    <h4><?php echo esc_html($title); ?></h4>
                    <p><?php echo esc_html($desc); ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="solution-tabs" id="solution">
        <div class="container">
            <hgroup style="text-align: left; margin-bottom: 40px;">
                <h2><?php echo get_post_meta( get_the_ID(), 'mig_reasons_title', true ) ?: 'Чому компанії обирають міграцію'; ?></h2>
                <?php 
                $mig_reasons_text = get_post_meta( get_the_ID(), 'mig_reasons_text', true );
                if ( $mig_reasons_text ) : ?>
                    <p class="section-subtitle" style="text-align: left; margin-bottom: 0; color: var(--text-muted);">
                        <?php echo esc_html( $mig_reasons_text ); ?>
                    </p>
                <?php endif; ?>
            </hgroup>

            <div class="tabs-layout">
                <div class="tabs-sidebar">
                    <?php 
                    $mig_tab_count = get_post_meta( get_the_ID(), 'mig_tab_count', true ) ?: 6;
                    for ($i = 1; $i <= $mig_tab_count; $i++) {
                        $btn = get_post_meta( get_the_ID(), 'mig_tab'.$i.'_btn', true );
                        if (empty($btn)) {
                            if ($i == 1) $btn = 'Розрізнені дані';
                            elseif ($i == 2) $btn = 'Ручна робота';
                            elseif ($i == 3) $btn = 'Брак аналітики';
                            elseif ($i == 4) $btn = 'Масштабування';
                            elseif ($i == 5) $btn = 'Безпека';
                            elseif ($i == 6) $btn = 'Залежність';
                            else continue;
                        }
                        $active_class = ($i === 1) ? 'active' : '';
                        echo '<button class="tab-btn ' . $active_class . '" data-tab="tab' . $i . '">' . esc_html($btn) . '</button>';
                    }
                    ?>
                </div>

                <div class="tabs-content-area">
                    <?php 
                    for ($i = 1; $i <= $mig_tab_count; $i++) {
                        $btn = get_post_meta( get_the_ID(), 'mig_tab'.$i.'_btn', true );
                        if (empty($btn) && $i > 6) continue;
                        
                        $title = get_post_meta( get_the_ID(), 'mig_tab'.$i.'_title', true );
                        if (empty($title)) {
                            if ($i == 1) $title = 'Розрізнені дані';
                            elseif ($i == 2) $title = 'Повний контроль грошових потоків';
                            elseif ($i == 3) $title = 'Розумна автоматизація рутини';
                            elseif ($i == 4) $title = 'Миттєві дашборди та звіти';
                            elseif ($i == 5) $title = 'Безпека';
                            elseif ($i == 6) $title = 'Залежність';
                        }
                        
                        $text = get_post_meta( get_the_ID(), 'mig_tab'.$i.'_text', true );
                        if (empty($text)) {
                            if ($i == 1) $text = 'Коли кожен відділ працює у власному софті, дані дублюються або втрачаються, що створює повний хаос у звітності та заважає бачити реальну картину бізнесу.';
                            elseif ($i == 2) $text = 'Велика кількість механічних операцій призводить до критичних помилок через людський фактор, забирає дорогоцінний час працівників та гальмує всі процеси.';
                            elseif ($i == 3) $text = 'Відсутність оперативної звітності в реальному часі заважає відстежувати ключові показники (KPI) та приймати швидкі, обґрунтовані управлінські рішення.';
                            elseif ($i == 4) $text = 'Застарілі системи не мають гнучкості та потужності, щоб підтримувати розширення вашого бізнесу, відкриття нових філій чи вихід на міжнародні ринки.';
                            elseif ($i == 5) $text = 'Відсутність чіткого розмежування прав доступу та слабкий захист створюють постійні ризики витоку конфіденційної інформації або безповоротної втрати даних.';
                            elseif ($i == 6) $text = 'Ваш бізнес стає заручником окремих локальних розробників або системних адміністраторів, без яких неможливо внести навіть мінімальні зміни в систему.';
                        }
                        
                        $img = get_post_meta( get_the_ID(), 'mig_tab'.$i.'_img', true ) ?: 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        $active_class = ($i === 1) ? 'active' : '';
                    ?>
                    <div id="tab<?php echo $i; ?>" class="tab-panel <?php echo $active_class; ?>">
                        <div class="tab-image-placeholder">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $img, $title ) ); ?>" class="content-image">
                        </div>
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title" style="text-align: center;"><?php echo get_post_meta( get_the_ID(), 'mig_what_title', true ) ?: 'Що переноситься в SAP B1?'; ?></h2>
            <div class="orbit-wrap">
                <div class="orbit-center">
                    <span><?php echo get_post_meta( get_the_ID(), 'mig_orbit_center', true ) ?: 'Дані'; ?></span>
                </div>

                <div class="orbit-items">
                    <?php 
                    $mig_orbit_item_count = get_post_meta( get_the_ID(), 'mig_orbit_item_count', true ) ?: 8;
                    for ($i = 1; $i <= $mig_orbit_item_count; $i++) {
                        $item = get_post_meta( get_the_ID(), 'mig_orbit_item'.$i, true );
                        if (empty($item)) {
                            if ($i == 1) $item = 'Клієнти';
                            elseif ($i == 2) $item = 'Товари';
                            elseif ($i == 3) $item = 'Довідники';
                            elseif ($i == 4) $item = 'Залишки';
                            elseif ($i == 5) $item = 'Документи';
                            elseif ($i == 6) $item = 'Фінанси';
                            elseif ($i == 7) $item = 'Історія';
                            elseif ($i == 8) $item = 'Дані';
                            else continue;
                        }
                        echo '<div class="orbit-item oi-' . $i . '">' . esc_html($item) . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="process" id="process">
        <div class="container">
            <h2><?php echo get_post_meta( get_the_ID(), 'mig_process_title', true ) ?: 'Як проходить перехід'; ?></h2>

            <div class="timeline">
                <?php 
                $mig_step_count = get_post_meta( get_the_ID(), 'mig_step_count', true ) ?: 5;
                for ($i = 1; $i <= $mig_step_count; $i++) {
                    $title = get_post_meta( get_the_ID(), 'mig_step'.$i.'_title', true );
                    if (empty($title)) {
                        if ($i == 1) $title = 'Аудит';
                        elseif ($i == 2) $title = 'Карта даних';
                        elseif ($i == 3) $title = 'Перенесення';
                        elseif ($i == 4) $title = 'Тестування';
                        elseif ($i == 5) $title = 'Запуск';
                        else continue;
                    }
                    
                    $text = get_post_meta( get_the_ID(), 'mig_step'.$i.'_text', true );
                    if (empty($text)) {
                        if ($i == 1) $text = 'Аналіз поточної системи.';
                        elseif ($i == 2) $text = 'План перенесення полів.';
                        elseif ($i == 3) $text = 'Технічна міграція бази.';
                        elseif ($i == 4) $text = 'Перевірка результатів.';
                        elseif ($i == 5) $text = 'Старт роботи та підтримка.';
                    }
                ?>
                <div class="timeline-item">
                    <div class="timeline-number"><?php echo $i; ?></div>
                    <div class="timeline-content">
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>
    </section>

    <section class="transition" id="transition">
        <div class="container">
            <div class="transition-center-box">
                <h2><?php echo get_post_meta( get_the_ID(), 'mig_center_title', true ) ?: 'Міграція без зупинки бізнесу'; ?></h2>
                <p><?php echo get_post_meta( get_the_ID(), 'mig_center_text', true ) ?: 'Ми проводимо перенесення даних паралельно з вашою поточною діяльністю. Перехід відбувається у вихідні або в узгоджене вікно.'; ?></p>
                <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'mig_reasons_btn_url', true ) ?: '#contacts' ); ?>" class="btn-primary"><?php echo get_post_meta( get_the_ID(), 'mig_reasons_btn', true ) ?: 'Обговорити ваш проект'; ?></a>
            </div>
        </div>
    </section>

    <section class="section comparison-risks">
        <div class="container">
            <h2 class="section-title" style="text-align: center;"><?php echo get_post_meta( get_the_ID(), 'mig_safe_title', true ) ?: 'Безпека вашого переходу'; ?></h2>

            <div class="comparison-grid">
                <div class="comp-card risk-side">
                    <div class="comp-badge"><?php echo get_post_meta( get_the_ID(), 'mig_risk_badge', true ) ?: 'Ризики без підготовки'; ?></div>
                    <h3><?php echo get_post_meta( get_the_ID(), 'mig_risk_title', true ) ?: 'Чого побоюється бізнес?'; ?></h3>
                    <ul class="comp-list">
                        <?php 
                        $mig_risk_count = get_post_meta( get_the_ID(), 'mig_risk_count', true ) ?: 4;
                        for ($i = 1; $i <= $mig_risk_count; $i++) {
                            $risk = get_post_meta( get_the_ID(), 'mig_risk'.$i, true );
                            if (empty($risk)) {
                                if ($i == 1) $risk = '✕ <strong>Втрата історичних даних</strong><p>При перенесенні губляться залишки, взаєморозрахунки або історія продажів.</p>';
                                elseif ($i == 2) $risk = '✕ <strong>Сміття в довідниках</strong><p>Дублікати контрагентів та некоректні артикули товарів переїдуть у нову систему.</p>';
                                elseif ($i == 3) $risk = '✕ <strong>Саботаж з боку персоналу</strong><p>Співробітники не розуміють нову програму і продовжують працювати в Excel.</p>';
                                elseif ($i == 4) $risk = '✕ <strong>Зупинка відвантажень</strong><p>Бізнес "стоїть" тижнями, поки налаштовуються базові процеси.</p>';
                                else continue;
                            }
                        ?>
                        <li>
                            <div>
                                <?php echo wp_kses_post($risk); ?>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="comp-card solution-side">
                    <div class="comp-badge active"><?php echo get_post_meta( get_the_ID(), 'mig_sol_badge', true ) ?: 'Як ми це закриваємо'; ?></div>
                    <h3><?php echo get_post_meta( get_the_ID(), 'mig_sol_title', true ) ?: 'Рішення від Hygge System'; ?></h3>
                    <ul class="comp-list">
                        <?php 
                        $mig_risk_count = get_post_meta( get_the_ID(), 'mig_risk_count', true ) ?: 4;
                        for ($i = 1; $i <= $mig_risk_count; $i++) {
                            $sol = get_post_meta( get_the_ID(), 'mig_sol'.$i, true );
                            if (empty($sol)) {
                                if ($i == 1) $sol = '✓ <strong>Тестова міграція</strong><p>Проводимо 2-3 пробні завантаження, щоб перевірити кожну цифру до фінального запуску.</p>';
                                elseif ($i == 2) $sol = '✓ <strong>Нормалізація даних</strong><p>Вичищаємо та структуруємо вашу базу перед імпортом за допомогою наших скриптів.</p>';
                                elseif ($i == 3) $sol = '✓ <strong>Адаптивне навчання</strong><p>Проводимо воркшопи для команди та готуємо індивідуальні інструкції для кожного відділу.</p>';
                                elseif ($i == 4) $sol = '✓ <strong>Паралельна робота</strong><p>Навчаємо ключових користувачів на реальних даних, не зупиняючи поточну систему.</p>';
                                else continue;
                            }
                        ?>
                        <li>
                            <div>
                                <?php echo wp_kses_post($sol); ?>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
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

