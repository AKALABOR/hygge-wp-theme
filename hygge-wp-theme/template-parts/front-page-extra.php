<?php
// Extra sections for Front Page
?>
<!-- WHAT IS SAP -->
<section class="what-is-sap" id="about-sap" style="background: var(--bg-white);">
    <div class="container">
        <h2 style="text-align: left; margin-bottom: 20px;"><?php echo get_post_meta( get_the_ID(), 'fp_about_title', true ) ?: 'Що таке SAP Business One'; ?></h2>
        <p style="font-size: 1.15rem; color: var(--text-muted); margin-bottom: 50px; max-width: 800px;"><?php echo get_post_meta( get_the_ID(), 'fp_about_text', true ) ?: 'Це комплексне рішення (ERP), розроблене спеціально для малого та середнього бізнесу. Воно об\'єднує всі ключові процеси компанії.'; ?></p>

        <div class="about-grid">
            <?php 
            $fp_about_count = get_post_meta( get_the_ID(), 'fp_about_count', true ) ?: 4;
            for ($i = 1; $i <= $fp_about_count; $i++) {
                $title = get_post_meta( get_the_ID(), 'fp_about'.$i.'_title', true );
                if (empty($title)) {
                    if ($i == 1) $title = 'Міжнародний стандарт';
                    elseif ($i == 2) $title = 'Масштабованість';
                    elseif ($i == 3) $title = 'Модульна структура';
                    elseif ($i == 4) $title = 'Безпека даних';
                    else continue;
                }
                
                $text = get_post_meta( get_the_ID(), 'fp_about'.$i.'_text', true );
                if (empty($text)) {
                    $text = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.';
                }
                
                $icon = get_post_meta( get_the_ID(), 'fp_about'.$i.'_icon', true );
            ?>
            <div class="about-card">
                <div class="icon-wrapper">
                    <?php if ($icon) { echo $icon; } else { ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                            <path d="M2 12h20"></path>
                        </svg>
                    <?php } ?>
                </div>
                <h3><?php echo esc_html($title); ?></h3>
                <p><?php echo esc_html($text); ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- COMPARISON -->
<section class="comparison" id="comparison">
    <div class="container">
        <h2><?php echo get_post_meta( get_the_ID(), 'fp_comp_title', true ) ?: 'SAP Business One vs Локальні системи'; ?></h2>
        <div class="table-wrapper" tabindex="0">
            <table class="compare-table">
                <thead>
                    <tr>
                        <th scope="col"><?php echo get_post_meta( get_the_ID(), 'fp_comp_th1', true ) ?: 'Критерій'; ?></th>
                        <th scope="col" class="highlight"><?php echo get_post_meta( get_the_ID(), 'fp_comp_th2', true ) ?: 'SAP Business One'; ?></th>
                        <th scope="col"><?php echo get_post_meta( get_the_ID(), 'fp_comp_th3', true ) ?: 'Локальні системи'; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $fp_comp_count = get_post_meta( get_the_ID(), 'fp_comp_count', true ) ?: 3;
                    for ($i = 1; $i <= $fp_comp_count; $i++) {
                        $crit = get_post_meta( get_the_ID(), 'fp_comp'.$i.'_crit', true );
                        if (empty($crit)) {
                            if ($i == 1) $crit = 'Комплексність рішення';
                            elseif ($i == 2) $crit = 'Оновлення та розвиток';
                            elseif ($i == 3) $crit = 'Швидкодія';
                            else continue;
                        }
                        $sap_v = get_post_meta( get_the_ID(), 'fp_comp'.$i.'_sap', true );
                        if (empty($sap_v)) {
                            if ($i == 1) $sap_v = 'Все в одній системі (ERP)';
                            elseif ($i == 2) $sap_v = 'Регулярні глобальні оновлення';
                            elseif ($i == 3) $sap_v = 'SAP HANA (in-memory)';
                        }
                        $loc_v = get_post_meta( get_the_ID(), 'fp_comp'.$i.'_loc', true );
                        if (empty($loc_v)) {
                            if ($i == 1) $loc_v = 'Зоопарк різних програм';
                            elseif ($i == 2) $loc_v = 'Залежність від доопрацювань';
                            elseif ($i == 3) $loc_v = 'Повільна робота з базами';
                        }
                    ?>
                    <tr>
                        <th scope="row"><?php echo esc_html($crit); ?></th>
                        <td class="highlight">
                            <svg class="table-icon check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <?php echo esc_html($sap_v); ?>
                        </td>
                        <td>
                            <svg class="table-icon cross" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            <?php echo esc_html($loc_v); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="services" id="services">
    <div class="container">
        <h2><?php echo get_post_meta( get_the_ID(), 'fp_serv_title', true ) ?: 'Наші послуги'; ?></h2>

        <div class="zigzag-wrapper">
            <?php 
            $fp_serv_count = get_post_meta( get_the_ID(), 'fp_serv_count', true ) ?: 4;
            for ($i = 1; $i <= $fp_serv_count; $i++) {
                $title = get_post_meta( get_the_ID(), 'fp_serv'.$i.'_title', true );
                if (empty($title)) {
                    if ($i == 1) $title = 'Впровадження системи';
                    elseif ($i == 2) $title = 'Безшовні інтеграції';
                    elseif ($i == 3) $title = 'Кастомні доопрацювання';
                    elseif ($i == 4) $title = 'Технічна підтримка';
                    else continue;
                }
                
                $text = get_post_meta( get_the_ID(), 'fp_serv'.$i.'_text', true );
                if (empty($text)) {
                    if ($i == 1) $text = 'Повний цикл запуску SAP Business One під ключ. Ми не просто встановлюємо програму, а адаптуємо її логіку під унікальну специфіку вашого бізнесу, щоб система працювала на вас із першого дня.';
                    elseif ($i == 2) $text = 'Налаштування автоматичного обміну даними з вашими поточними інструментами: CRM-системами, інтернет-магазинами, клієнт-банками та сервісами електронного документообігу.';
                    elseif ($i == 3) $text = 'Створення унікальних модулів, звітів та друкованих форм. Розширення базового функціоналу системи під специфічні та нестандартні задачі вашої команди.';
                    elseif ($i == 4) $text = 'Надійний супровід після запуску. Ми консультуємо ваших співробітників, допомагаємо закривати періоди та забезпечуємо безперебійну роботу системи 24/7.';
                }
                
                $img = get_post_meta( get_the_ID(), 'fp_serv'.$i.'_img', true );
                if (empty($img)) {
                    if ($i == 1) $img = 'https://media.istockphoto.com/id/1488294044/photo/businessman-works-on-laptop-showing-business-analytics-dashboard-with-charts-metrics-and-kpi.jpg?s=612x612&w=0&k=20&c=AcxzQAe1LY4lGp0C6EQ6reI7ZkFC2ftS09yw_3BVkpk=';
                    elseif ($i == 2) $img = 'https://t4.ftcdn.net/jpg/02/35/43/73/360_F_235437333_5NnutLH9GJan9HxUdyAK3Mwwfh9wtPQo.jpg';
                    elseif ($i == 3) $img = 'https://www.shutterstock.com/image-photo/hands-typing-on-laptop-programming-600nw-2480023489.jpg';
                    elseif ($i == 4) $img = 'https://t3.ftcdn.net/jpg/05/80/52/84/360_F_580528498_nvubgu6PcpYGFMf1b6r0B8U6fhSdrfFe.jpg';
                }
                
                $btn = get_post_meta( get_the_ID(), 'fp_serv'.$i.'_btn', true ) ?: 'Детальніше';
                $btn_url = get_post_meta( get_the_ID(), 'fp_serv'.$i.'_btn_url', true ) ?: '#';
                
                $reverse_class = ($i % 2 == 0) ? ' reverse' : '';
            ?>
            <div class="zigzag-row<?php echo $reverse_class; ?>">
                <div class="zigzag-image">
                    <div class="placeholder-box">
                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $img, $title ) ); ?>">
                    </div>
                </div>
                <div class="zigzag-text">
                    <h3><?php echo esc_html($title); ?></h3>
                    <p><?php echo esc_html($text); ?></p>
                    <a href="<?php echo esc_url($btn_url); ?>" class="zigzag-btn"><?php echo esc_html($btn); ?></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- PROCESS -->
<section class="process" id="process">
    <div class="container">
        <h2><?php echo get_post_meta( get_the_ID(), 'fp_proc_title', true ) ?: 'Як проходить впровадження'; ?></h2>

        <div class="timeline">
            <?php 
            $fp_proc_count = get_post_meta( get_the_ID(), 'fp_proc_count', true ) ?: 5;
            for ($i = 1; $i <= $fp_proc_count; $i++) {
                $title = get_post_meta( get_the_ID(), 'fp_proc'.$i.'_title', true );
                if (empty($title)) {
                    if ($i == 1) $title = 'Аудит';
                    elseif ($i == 2) $title = 'Налаштування';
                    elseif ($i == 3) $title = 'Міграція';
                    elseif ($i == 4) $title = 'Запуск';
                    elseif ($i == 5) $title = 'Підтримка';
                    else continue;
                }
                
                $text = get_post_meta( get_the_ID(), 'fp_proc'.$i.'_text', true );
                if (empty($text)) {
                    if ($i == 1) $text = 'Глибокий аналіз поточних бізнес-процесів вашої компанії.';
                    elseif ($i == 2) $text = 'Адаптація та налаштування системи SAP під ваші конкретні задачі.';
                    elseif ($i == 3) $text = 'Безпечне перенесення всіх довідників та даних зі старих баз (1С/BAS).';
                    elseif ($i == 4) $text = 'Навчання вашої команди, тестування та фінальний старт роботи.';
                    elseif ($i == 5) $text = 'Повний технічний супровід на всіх етапах використання системи.';
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

<!-- INTEGRATIONS -->
<section class="integrations" id="integrations">
    <div class="container" style="overflow: hidden;">
        <h2><?php echo get_post_meta( get_the_ID(), 'fp_integ_title', true ) ?: 'Безшовні інтеграції'; ?></h2>
        <p class="subtitle" style="text-align:center; color:var(--text-muted); margin-bottom: 50px;"><?php echo get_post_meta( get_the_ID(), 'fp_integ_subtitle', true ) ?: 'SAP Business One легко об\'єднується з вашими поточними сервісами'; ?></p>

        <div class="marquee-wrapper">
            <div class="marquee-track">
                <?php 
                $fp_integ_count = get_post_meta( get_the_ID(), 'fp_integ_count', true ) ?: 5;
                for ($k = 0; $k < 2; $k++) { // Duplicate for marquee
                    for ($i = 1; $i <= $fp_integ_count; $i++) {
                        $img = get_post_meta( get_the_ID(), 'fp_integ'.$i.'_img', true );
                        if (empty($img)) {
                            if ($i == 1) $img = 'https://upload.wikimedia.org/wikipedia/commons/d/d6/Vchasno_logo.png';
                            elseif ($i == 2) $img = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQr_y-97Evou_xR6I4_LOyPOtTVqU7oCrcHmg&s';
                            elseif ($i == 3) $img = 'https://melsoft.com.ua/wp-content/uploads/assets/02/16/key1.png';
                            elseif ($i == 4) $img = 'https://upload.wikimedia.org/wikipedia/commons/7/73/%D0%9F%D1%80%D0%B8%D0%B2%D0%B0%D1%82%D0%91%D0%B0%D0%BD%D0%BA.png';
                            elseif ($i == 5) $img = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQe_3Bpehy4xABxhSMtqDrh28oi1pXu9K0mw&s';
                            else continue;
                        }
                        echo '<div class="logo-card"><img src="' . esc_url($img) . '" alt="' . esc_attr( hygge_get_image_alt( $img, 'Integration' ) ) . '"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- CASES -->
<section class="cases" id="cases">
    <div class="container">
        <h2><?php echo get_post_meta( get_the_ID(), 'fp_cases_title', true ) ?: 'Реалізовані проекти'; ?></h2>

        <div class="grid">
            <?php 
            $fp_cases_count = get_post_meta( get_the_ID(), 'fp_cases_count', true ) ?: 3;
            for ($i = 1; $i <= $fp_cases_count; $i++) {
                $title = get_post_meta( get_the_ID(), 'fp_cases'.$i.'_title', true );
                if (empty($title)) {
                    if ($i == 1) $title = 'Автоматизація заводу';
                    elseif ($i == 2) $title = 'Оптимізація логістики';
                    elseif ($i == 3) $title = 'Інтеграція з CRM';
                    else continue;
                }
                
                $text = get_post_meta( get_the_ID(), 'fp_cases'.$i.'_text', true );
                if (empty($text)) {
                    if ($i == 1) $text = 'Зменшили витрати на складський облік на 30% та пришвидшили випуск продукції завдяки SAP Business One.';
                    elseif ($i == 2) $text = 'Пришвидшили обробку замовлень втричі для національного дистриб\'ютора. Нульові втрати при відвантаженнях.';
                    elseif ($i == 3) $text = 'Об\'єднали 5 інтернет-магазинів в єдину базу SAP. Автоматичне оновлення залишків та цін у реальному часі.';
                }
                
                $img = get_post_meta( get_the_ID(), 'fp_cases'.$i.'_img', true );
                if (empty($img)) {
                    if ($i == 1) $img = 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&q=80';
                    elseif ($i == 2) $img = 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=600&q=80';
                    elseif ($i == 3) $img = 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=80';
                }
                
                $tag = get_post_meta( get_the_ID(), 'fp_cases'.$i.'_tag', true );
                if (empty($tag)) {
                    if ($i == 1) $tag = 'Виробництво';
                    elseif ($i == 2) $tag = 'Дистрибуція';
                    elseif ($i == 3) $tag = 'E-commerce';
                }
                
                $btn_url = get_post_meta( get_the_ID(), 'fp_cases'.$i.'_btn_url', true ) ?: '#!';
            ?>
            <div class="case-card">
                <div class="case-image">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( hygge_get_image_alt( $img, $tag ) ); ?>">
                    <span class="case-tag"><?php echo esc_html($tag); ?></span>
                </div>
                <div class="case-content">
                    <h3><?php echo esc_html($title); ?></h3>
                    <p><?php echo esc_html($text); ?></p>
                    <a href="<?php echo esc_url($btn_url); ?>" class="btn-link">Читати кейс &rarr;</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- TRANSITION -->
<section class="transition" id="transition">
    <div class="container">
        <div class="transition-center-box">
            <h2><?php echo get_post_meta( get_the_ID(), 'fp_trans_title', true ) ?: 'Безпечний перехід з 1С / BAS'; ?></h2>
            <p><?php echo get_post_meta( get_the_ID(), 'fp_trans_text', true ) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.'; ?></p>
            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'fp_trans_btn_url', true ) ?: '#!' ); ?>" class="btn-primary"><?php echo esc_html( get_post_meta( get_the_ID(), 'fp_trans_btn', true ) ?: 'Дізнатися про міграцію' ); ?></a>
        </div>
    </div>
</section>
