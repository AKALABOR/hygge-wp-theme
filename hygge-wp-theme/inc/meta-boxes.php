<?php
/**
 * Custom Meta Boxes for Hygge System Theme
 * This file registers custom meta boxes for different page templates natively.
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register all meta boxes
 */
function hygge_register_meta_boxes() {
    global $post;

    if ( ! $post ) {
        return;
    }

    // Get the template of the current post
    $template = get_post_meta( $post->ID, '_wp_page_template', true );

    // 1. Головна сторінка (front-page.php)
    if ( $template === 'front-page.php' || ( is_front_page() && empty( $template ) ) || get_option('page_on_front') == $post->ID ) {
        add_meta_box(
            'hygge_front_page_meta',
            'Налаштування Головної сторінки',
            'hygge_render_front_page_meta_box',
            'page',
            'normal',
            'high'
        );
    }

    // 2. SAP Business One (template-sap-b1.php)
    if ( $template === 'template-sap-b1.php' ) {
        add_meta_box(
            'hygge_sap_meta',
            'Налаштування сторінки SAP Business One',
            'hygge_render_sap_meta_box',
            'page',
            'normal',
            'high'
        );
    }

    // 3. Перехід з інших програм (template-migration.php)
    if ( $template === 'template-migration.php' ) {
        add_meta_box(
            'hygge_migration_meta',
            'Налаштування: Перехід з інших програм',
            'hygge_render_migration_meta_box',
            'page',
            'normal',
            'high'
        );
    }

    // 4. Акції (template-promos.php)
    if ( $template === 'template-promos.php' ) {
        add_meta_box(
            'hygge_promos_meta',
            'Налаштування: Акції',
            'hygge_render_promos_meta_box',
            'page',
            'normal',
            'high'
        );
    }

    // 5. Кейси (template-cases.php)
    if ( $template === 'template-cases.php' ) {
        add_meta_box(
            'hygge_cases_meta',
            'Налаштування: Кейси',
            'hygge_render_cases_meta_box',
            'page',
            'normal',
            'high'
        );
    }

    // 6. Окрема акція (template-promo-single.php)
    if ( $template === 'template-promo-single.php' ) {
        add_meta_box(
            'hygge_promo_single_meta',
            'Налаштування: Окрема акція',
            'hygge_render_promo_single_meta_box',
            array('page', 'post'),
            'normal',
            'high'
        );
    }

    // 7. Окремий кейс (template-single-case.php)
    if ( $template === 'template-single-case.php' ) {
        add_meta_box(
            'hygge_case_single_meta',
            'Налаштування: Окремий кейс',
            'hygge_render_case_single_meta_box',
            array('page', 'post'),
            'normal',
            'high'
        );
    }

    // 8. Картка програми/модуля (template-product-card.php)
    if ( $template === 'template-product-card.php' ) {
        add_meta_box(
            'hygge_product_card_meta',
            'Налаштування: Програма (Картка продукту)',
            'hygge_render_product_card_meta_box',
            array('page', 'post'),
            'normal',
            'high'
        );
    }

    // 9. Блог (Posts Page)
    if ( $template === 'template-blog.php' || get_option( 'page_for_posts' ) == $post->ID ) {
        add_meta_box(
            'hygge_blog_meta',
            'Налаштування сторінки Блогу',
            'hygge_render_blog_meta_box',
            'page',
            'normal',
            'high'
        );
    }

    // 10. Окремий запис блогу (single.php)
    add_meta_box(
        'hygge_single_post_meta',
        'Додаткові налаштування статті',
        'hygge_render_single_post_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hygge_register_meta_boxes' );

/**
 * Generic field rendering function
 */
function hygge_render_field( $post_id, $id, $label, $type = 'text', $description = '', $class = '' ) {
    $value = get_post_meta( $post_id, $id, true );
    $wrapper_class = 'hygge-field-wrapper';
    if ( $class ) {
        $wrapper_class .= ' ' . $class;
    }
    echo '<div class="' . esc_attr($wrapper_class) . '" style="margin-bottom: 15px;">';
    echo '<label for="' . esc_attr( $id ) . '" style="display:block; font-weight:bold; margin-bottom:5px;">' . esc_html( $label ) . '</label>';

    // Вимикаємо розширення для перевірки граматики, які часто крадуть фокус у великих формах
    $disable_ext = ' data-gramm="false" data-gramm_editor="false" data-enable-grammarly="false" spellcheck="false"';

    if ( $type === 'textarea' ) {
        echo '<textarea id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '" style="width:100%; min-height:80px;"' . $disable_ext . '>' . esc_textarea( $value ) . '</textarea>';
    } else {
        echo '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '" value="' . esc_attr( $value ) . '" style="width:100%;" />';
    }

    if ( $description ) {
        echo '<p class="description" style="margin-top:5px; color:#666;">' . wp_kses_post( $description ) . '</p>';
    }
    echo '</div>';
}

/**
 * Render Meta Box: Front Page
 */
function hygge_render_front_page_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'hero_badge', 'Текст над заголовком (Бейдж)' );
    hygge_render_field( $post->ID, 'hero_title_highlight', 'Виділена частина заголовку (кольоровий градієнт)' );
    hygge_render_field( $post->ID, 'hero_title_main', 'Основний заголовок' );
    hygge_render_field( $post->ID, 'hero_subtitle', 'Підзаголовок', 'textarea' );
    hygge_render_field( $post->ID, 'hero_btn1', 'Текст першої кнопки' );
    hygge_render_field( $post->ID, 'hero_btn1_url', 'Посилання першої кнопки (URL)' );
    hygge_render_field( $post->ID, 'hero_btn2', 'Текст другої кнопки' );
    hygge_render_field( $post->ID, 'hero_btn2_url', 'Посилання другої кнопки (URL)' );
    hygge_render_field( $post->ID, 'hero_img_url', 'Головне зображення першого екрану (URL)' );
    echo '<hr style="margin:20px 0;"><h3>Секція: Проблема та Рішення</h3>';
    hygge_render_field( $post->ID, 'problems_title', 'Заголовок секції з проблемами' );
    hygge_render_field( $post->ID, 'problems_text', 'Опис проблем', 'textarea' );

    echo '<hr style="margin:20px 0;"><h3>Картки "Знайомі проблеми?"</h3>';
    $prob_count = get_post_meta( $post->ID, 'prob_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="prob">';
    echo '<input type="hidden" name="prob_count" class="repeater-count" value="' . esc_attr($prob_count) . '">';
    for ($i = 1; $i <= $prob_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'prob'.$i.'_icon', 'Проблема '.$i.': Іконка', 'textarea', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'prob'.$i.'_title', 'Проблема '.$i.': Заголовок', 'text', '', 'hygge-grid-col-2-3' );
        echo '</div>';
        hygge_render_field( $post->ID, 'prob'.$i.'_text', 'Проблема '.$i.': Опис', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати проблему</button>';
    echo '</div>';
    hygge_render_field( $post->ID, 'solution_title', 'Заголовок секції з рішенням' );
    hygge_render_field( $post->ID, 'solution_text', 'Опис рішення', 'textarea' );

    echo '<hr style="margin:20px 0;"><h3>Таби (Як SAP вирішує ці задачі)</h3>';
    $fp_tab_count = get_post_meta( $post->ID, 'fp_tab_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="fp_tab">';
    echo '<input type="hidden" name="fp_tab_count" class="repeater-count" value="' . esc_attr($fp_tab_count) . '">';
    for ($i = 1; $i <= $fp_tab_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'fp_tab'.$i.'_btn', 'Таб '.$i.': Текст кнопки зліва', 'text', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'fp_tab'.$i.'_title', 'Таб '.$i.': Заголовок', 'text', '', 'hygge-grid-col-2-3' );
        echo '</div>';
        hygge_render_field( $post->ID, 'fp_tab'.$i.'_text', 'Таб '.$i.': Опис', 'textarea' );
        hygge_render_field( $post->ID, 'fp_tab'.$i.'_img', 'Таб '.$i.': Зображення (URL)' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати таб</button>';
    echo '</div>';
    // --- NEW SECTIONS ---

    echo '<hr style="margin:20px 0;"><h3>Секція: Що таке SAP Business One</h3>';
    hygge_render_field( $post->ID, 'fp_about_title', 'Заголовок секції' );
    hygge_render_field( $post->ID, 'fp_about_text', 'Опис', 'textarea' );
    $fp_about_count = get_post_meta( $post->ID, 'fp_about_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="fp_about">';
    echo '<input type="hidden" name="fp_about_count" class="repeater-count" value="' . esc_attr($fp_about_count) . '">';
    for ($i = 1; $i <= $fp_about_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'fp_about'.$i.'_icon', 'Картка '.$i.': Іконка (SVG)', 'textarea', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'fp_about'.$i.'_title', 'Картка '.$i.': Заголовок', 'text', '', 'hygge-grid-col-2-3' );
        echo '</div>';
        hygge_render_field( $post->ID, 'fp_about'.$i.'_text', 'Картка '.$i.': Текст', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати картку</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція: Порівняння (Таблиця)</h3>';
    hygge_render_field( $post->ID, 'fp_comp_title', 'Заголовок секції' );
    echo '<div class="hygge-grid-row">';
    hygge_render_field( $post->ID, 'fp_comp_th1', 'Заголовок колонки 1', 'text', '', 'hygge-grid-col-1-3' );
    hygge_render_field( $post->ID, 'fp_comp_th2', 'Заголовок колонки 2', 'text', '', 'hygge-grid-col-1-3' );
    hygge_render_field( $post->ID, 'fp_comp_th3', 'Заголовок колонки 3', 'text', '', 'hygge-grid-col-1-3' );
    echo '</div>';
    $fp_comp_count = get_post_meta( $post->ID, 'fp_comp_count', true ) ?: 3;
    echo '<div class="hygge-repeater" data-prefix="fp_comp">';
    echo '<input type="hidden" name="fp_comp_count" class="repeater-count" value="' . esc_attr($fp_comp_count) . '">';
    for ($i = 1; $i <= $fp_comp_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'fp_comp'.$i.'_crit', 'Рядок '.$i.': Критерій', 'text', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'fp_comp'.$i.'_sap', 'Рядок '.$i.': SAP', 'text', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'fp_comp'.$i.'_loc', 'Рядок '.$i.': Локальні', 'text', '', 'hygge-grid-col-1-3' );
        echo '</div>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати рядок</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція: Наші послуги</h3>';
    hygge_render_field( $post->ID, 'fp_serv_title', 'Заголовок секції' );
    $fp_serv_count = get_post_meta( $post->ID, 'fp_serv_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="fp_serv">';
    echo '<input type="hidden" name="fp_serv_count" class="repeater-count" value="' . esc_attr($fp_serv_count) . '">';
    for ($i = 1; $i <= $fp_serv_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'fp_serv'.$i.'_title', 'Послуга '.$i.': Заголовок', 'text', '', 'hygge-grid-col-1-2' );
        hygge_render_field( $post->ID, 'fp_serv'.$i.'_img', 'Послуга '.$i.': Зображення (URL)', 'text', '', 'hygge-grid-col-1-2' );
        echo '</div>';
        hygge_render_field( $post->ID, 'fp_serv'.$i.'_text', 'Послуга '.$i.': Опис', 'textarea' );
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'fp_serv'.$i.'_btn', 'Послуга '.$i.': Кнопка', 'text', '', 'hygge-grid-col-1-2' );
        hygge_render_field( $post->ID, 'fp_serv'.$i.'_btn_url', 'Послуга '.$i.': URL кнопки', 'text', '', 'hygge-grid-col-1-2' );
        echo '</div>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати послугу</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція: Як проходить впровадження</h3>';
    hygge_render_field( $post->ID, 'fp_proc_title', 'Заголовок секції' );
    $fp_proc_count = get_post_meta( $post->ID, 'fp_proc_count', true ) ?: 5;
    echo '<div class="hygge-repeater" data-prefix="fp_proc">';
    echo '<input type="hidden" name="fp_proc_count" class="repeater-count" value="' . esc_attr($fp_proc_count) . '">';
    for ($i = 1; $i <= $fp_proc_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'fp_proc'.$i.'_title', 'Крок '.$i.': Заголовок' );
        hygge_render_field( $post->ID, 'fp_proc'.$i.'_text', 'Крок '.$i.': Опис', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати крок</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція: Безшовні інтеграції</h3>';
    hygge_render_field( $post->ID, 'fp_integ_title', 'Заголовок секції' );
    hygge_render_field( $post->ID, 'fp_integ_subtitle', 'Підзаголовок' );
    $fp_integ_count = get_post_meta( $post->ID, 'fp_integ_count', true ) ?: 5;
    echo '<div class="hygge-repeater" data-prefix="fp_integ">';
    echo '<input type="hidden" name="fp_integ_count" class="repeater-count" value="' . esc_attr($fp_integ_count) . '">';
    for ($i = 1; $i <= $fp_integ_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'fp_integ'.$i.'_img', 'Логотип '.$i.': Зображення (URL)' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати логотип</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція: Реалізовані проекти</h3>';
    hygge_render_field( $post->ID, 'fp_cases_title', 'Заголовок секції' );
    $fp_cases_count = get_post_meta( $post->ID, 'fp_cases_count', true ) ?: 3;
    echo '<div class="hygge-repeater" data-prefix="fp_cases">';
    echo '<input type="hidden" name="fp_cases_count" class="repeater-count" value="' . esc_attr($fp_cases_count) . '">';
    for ($i = 1; $i <= $fp_cases_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'fp_cases'.$i.'_tag', 'Кейс '.$i.': Тег', 'text', '', 'hygge-grid-col-1-2' );
        hygge_render_field( $post->ID, 'fp_cases'.$i.'_img', 'Кейс '.$i.': Зображення (URL)', 'text', '', 'hygge-grid-col-1-2' );
        echo '</div>';
        hygge_render_field( $post->ID, 'fp_cases'.$i.'_title', 'Кейс '.$i.': Заголовок' );
        hygge_render_field( $post->ID, 'fp_cases'.$i.'_text', 'Кейс '.$i.': Опис', 'textarea' );
        hygge_render_field( $post->ID, 'fp_cases'.$i.'_btn_url', 'Кейс '.$i.': URL кнопки' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати кейс</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція: Безпечний перехід</h3>';
    hygge_render_field( $post->ID, 'fp_trans_title', 'Заголовок' );
    hygge_render_field( $post->ID, 'fp_trans_text', 'Опис', 'textarea' );
    echo '<div class="hygge-grid-row">';
    hygge_render_field( $post->ID, 'fp_trans_btn', 'Кнопка', 'text', '', 'hygge-grid-col-1-2' );
    hygge_render_field( $post->ID, 'fp_trans_btn_url', 'URL кнопки', 'text', '', 'hygge-grid-col-1-2' );
    echo '</div>';
}

/**
 * Render Meta Box: SAP Business One
 */
function hygge_render_sap_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'sap_badge', 'Бейдж над заголовком' );
    hygge_render_field( $post->ID, 'sap_hero_title', 'Заголовок' );
    hygge_render_field( $post->ID, 'sap_hero_text', 'Опис', 'textarea' );
    hygge_render_field( $post->ID, 'sap_btn1', 'Текст кнопки 1' );
    hygge_render_field( $post->ID, 'sap_btn1_url', 'Посилання кнопки 1 (URL)' );
    hygge_render_field( $post->ID, 'sap_btn2', 'Текст кнопки 2' );
    hygge_render_field( $post->ID, 'sap_btn2_url', 'Посилання кнопки 2 (URL)' );
    hygge_render_field( $post->ID, 'sap_hero_img_url', 'Головне зображення (URL)' );
    echo '<hr style="margin:20px 0;"><h3>Інші заголовки сторінки</h3>';
    hygge_render_field( $post->ID, 'sap_intro_title', 'Заголовок "Більше ніж просто облік"' );
    hygge_render_field( $post->ID, 'sap_intro_text1', 'Текст "Більше ніж просто облік" (Абзац 1)', 'textarea' );
    hygge_render_field( $post->ID, 'sap_intro_text2', 'Текст "Більше ніж просто облік" (Абзац 2)', 'textarea' );
    hygge_render_field( $post->ID, 'sap_stat1_num', 'Статистика 1: Число (напр. 170+)' );
    hygge_render_field( $post->ID, 'sap_stat1_text', 'Статистика 1: Текст' );
    hygge_render_field( $post->ID, 'sap_stat2_num', 'Статистика 2: Число' );
    hygge_render_field( $post->ID, 'sap_stat2_text', 'Статистика 2: Текст' );
    hygge_render_field( $post->ID, 'sap_stat3_num', 'Статистика 3: Число' );
    hygge_render_field( $post->ID, 'sap_stat3_text', 'Статистика 3: Текст' );
    hygge_render_field( $post->ID, 'sap_modules_title', 'Заголовок "Функціональні можливості"' );
    hygge_render_field( $post->ID, 'sap_tech_title', 'Заголовок технологій (HANA/Аналітика)' );
    hygge_render_field( $post->ID, 'sap_hana_badge', 'Бейдж технологій (напр. Powered by SAP HANA)' );
    hygge_render_field( $post->ID, 'sap_deploy_title', 'Заголовок "Де розмістити систему?"' );
    hygge_render_field( $post->ID, 'sap_deploy_subtitle', 'Підзаголовок "Де розмістити систему?"', 'textarea' );
    hygge_render_field( $post->ID, 'sap_features_title', 'Заголовок "Основні можливості SAP"' );

    echo '<hr style="margin:20px 0;"><h3>Функціональні можливості системи (4 модулі)</h3>';
    $sap_mod_count = get_post_meta( $post->ID, 'sap_mod_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="sap_mod">';
    echo '<input type="hidden" name="sap_mod_count" class="repeater-count" value="' . esc_attr($sap_mod_count) . '">';
    for ($i = 1; $i <= $sap_mod_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'sap_mod'.$i.'_icon', 'Модуль '.$i.': Іконка (SVG/Емодзі)', 'textarea', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'sap_mod'.$i.'_title', 'Модуль '.$i.': Заголовок', 'text', '', 'hygge-grid-col-2-3' );
        echo '</div>';
        hygge_render_field( $post->ID, 'sap_mod'.$i.'_text', 'Модуль '.$i.': Опис', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати модуль</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Швидкість SAP HANA (Список)</h3>';
    hygge_render_field( $post->ID, 'sap_tech_text', 'HANA: Основний текст під заголовком', 'textarea' );
    $sap_tech_check_count = get_post_meta( $post->ID, 'sap_tech_check_count', true ) ?: 3;
    echo '<div class="hygge-repeater" data-prefix="sap_tech_check">';
    echo '<input type="hidden" name="sap_tech_check_count" class="repeater-count" value="' . esc_attr($sap_tech_check_count) . '">';
    for ($i = 1; $i <= $sap_tech_check_count; $i++) {
        echo '<div class="hygge-repeater-row" style="position:relative; padding-right:40px;">';
        hygge_render_field( $post->ID, 'sap_tech_check'.$i, 'HANA: Пункт '.$i, 'textarea' );
        echo '<button type="button" class="hygge-remove-row" title="Видалити" style="top:30px;">&times;</button>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати пункт</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Де розмістити систему (On-Premise vs Cloud)</h3>';
    hygge_render_field( $post->ID, 'sap_dep_op_title', 'On-Premise: Заголовок' );
    hygge_render_field( $post->ID, 'sap_dep_op_subtitle', 'On-Premise: Підзаголовок' );
    $sap_dep_op_l_count = get_post_meta( $post->ID, 'sap_dep_op_l_count', true ) ?: 5;
    echo '<div class="hygge-repeater" data-prefix="sap_dep_op_l">';
    echo '<input type="hidden" name="sap_dep_op_l_count" class="repeater-count" value="' . esc_attr($sap_dep_op_l_count) . '">';
    for ($i = 1; $i <= $sap_dep_op_l_count; $i++) {
        echo '<div class="hygge-repeater-row" style="position:relative; padding-right:40px;">';
        hygge_render_field( $post->ID, 'sap_dep_op_l'.$i, 'On-Premise: Пункт '.$i );
        echo '<button type="button" class="hygge-remove-row" title="Видалити" style="top:30px;">&times;</button>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary" style="margin-bottom:15px;">+ Додати пункт On-Premise</button>';
    echo '</div>';
    
    hygge_render_field( $post->ID, 'sap_dep_cl_title', 'Cloud: Заголовок' );
    hygge_render_field( $post->ID, 'sap_dep_cl_subtitle', 'Cloud: Підзаголовок' );
    $sap_dep_cl_l_count = get_post_meta( $post->ID, 'sap_dep_cl_l_count', true ) ?: 5;
    echo '<div class="hygge-repeater" data-prefix="sap_dep_cl_l">';
    echo '<input type="hidden" name="sap_dep_cl_l_count" class="repeater-count" value="' . esc_attr($sap_dep_cl_l_count) . '">';
    for ($i = 1; $i <= $sap_dep_cl_l_count; $i++) {
        echo '<div class="hygge-repeater-row" style="position:relative; padding-right:40px;">';
        hygge_render_field( $post->ID, 'sap_dep_cl_l'.$i, 'Cloud: Пункт '.$i );
        echo '<button type="button" class="hygge-remove-row" title="Видалити" style="top:30px;">&times;</button>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати пункт Cloud</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Основні можливості (Сітка 8 елементів)</h3>';
    $sap_feat_count = get_post_meta( $post->ID, 'sap_feat_count', true ) ?: 8;
    echo '<div class="hygge-repeater" data-prefix="sap_feat">';
    echo '<input type="hidden" name="sap_feat_count" class="repeater-count" value="' . esc_attr($sap_feat_count) . '">';
    echo '<div class="hygge-grid-row repeater-rows" style="flex-wrap: wrap;">';
    for ($i = 1; $i <= $sap_feat_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row" style="flex: 0 0 calc(50% - 7.5px);">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'sap_feat'.$i.'_title', 'Властивість '.$i.': Заголовок' );
        hygge_render_field( $post->ID, 'sap_feat'.$i.'_text', 'Властивість '.$i.': Опис' );
        echo '</div>';
    }
    echo '</div>';
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати можливість</button>';
    echo '</div>';
}

/**
 * Render Meta Box: Migration
 */
function hygge_render_migration_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'mig_badge', 'Бейдж' );
    hygge_render_field( $post->ID, 'mig_title', 'Заголовок' );
    hygge_render_field( $post->ID, 'mig_text', 'Опис', 'textarea' );
    hygge_render_field( $post->ID, 'mig_btn1', 'Кнопка 1' );
    hygge_render_field( $post->ID, 'mig_btn1_url', 'Посилання кнопки 1 (URL)' );
    hygge_render_field( $post->ID, 'mig_btn2', 'Кнопка 2' );
    hygge_render_field( $post->ID, 'mig_btn2_url', 'Посилання кнопки 2 (URL)' );    
    hygge_render_field( $post->ID, 'mig_hero_img_url', 'Головне зображення (URL)' );
    echo '<hr style="margin:20px 0;"><h3>Причини переходу</h3>';
    hygge_render_field( $post->ID, 'mig_reasons_title', 'Заголовок секції "Час переходити"' );
    hygge_render_field( $post->ID, 'mig_reasons_text', 'Опис під заголовком', 'textarea' );
    hygge_render_field( $post->ID, 'mig_reasons_btn', 'Кнопка секції' );
    hygge_render_field( $post->ID, 'mig_reasons_btn_url', 'Посилання кнопки секції (URL)' );

    echo '<hr style="margin:20px 0;"><h3>Таби (Чому компанії обирають міграцію)</h3>';
    $mig_tab_count = get_post_meta( $post->ID, 'mig_tab_count', true ) ?: 6;
    echo '<div class="hygge-repeater" data-prefix="mig_tab">';
    echo '<input type="hidden" name="mig_tab_count" class="repeater-count" value="' . esc_attr($mig_tab_count) . '">';
    for ($i = 1; $i <= $mig_tab_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'mig_tab'.$i.'_btn', 'Таб '.$i.': Текст кнопки зліва', 'text', '', 'hygge-grid-col-1-3' );
        hygge_render_field( $post->ID, 'mig_tab'.$i.'_title', 'Таб '.$i.': Заголовок', 'text', '', 'hygge-grid-col-2-3' );
        echo '</div>';
        hygge_render_field( $post->ID, 'mig_tab'.$i.'_text', 'Таб '.$i.': Опис', 'textarea' );
        hygge_render_field( $post->ID, 'mig_tab'.$i.'_img', 'Таб '.$i.': Зображення (URL)' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати таб</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Кругова діаграма (Орбіта)</h3>';
    hygge_render_field( $post->ID, 'mig_orbit_center', 'Текст в центрі орбіти' );
    $mig_orbit_item_count = get_post_meta( $post->ID, 'mig_orbit_item_count', true ) ?: 8;
    echo '<div class="hygge-repeater" data-prefix="mig_orbit_item">';
    echo '<input type="hidden" name="mig_orbit_item_count" class="repeater-count" value="' . esc_attr($mig_orbit_item_count) . '">';
    for ($i = 1; $i <= $mig_orbit_item_count; $i++) {
        echo '<div class="hygge-repeater-row" style="position:relative; padding-right:40px;">';
        hygge_render_field( $post->ID, 'mig_orbit_item'.$i, 'Орбіта: Елемент '.$i );
        echo '<button type="button" class="hygge-remove-row" title="Видалити" style="top:30px;">&times;</button>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати елемент орбіти</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Що переноситься в SAP B1</h3>';
    hygge_render_field( $post->ID, 'mig_what_title', 'Заголовок секції' );

    echo '<hr style="margin:20px 0;"><h3>Міграція без зупинки бізнесу</h3>';
    hygge_render_field( $post->ID, 'mig_center_title', 'Заголовок секції' );
    hygge_render_field( $post->ID, 'mig_center_text', 'Опис', 'textarea' );

    echo '<hr style="margin:20px 0;"><h3>З яких систем ми переводимо бізнес (6 систем)</h3>';
    hygge_render_field( $post->ID, 'mig_systems_title', 'Заголовок секції' );
    $mig_sys_count = get_post_meta( $post->ID, 'mig_sys_count', true ) ?: 6;
    echo '<div class="hygge-repeater" data-prefix="mig_sys">';
    echo '<input type="hidden" name="mig_sys_count" class="repeater-count" value="' . esc_attr($mig_sys_count) . '">';
    for ($i = 1; $i <= $mig_sys_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'mig_sys'.$i.'_title', 'Система '.$i.': Назва' );
        hygge_render_field( $post->ID, 'mig_sys'.$i.'_desc', 'Система '.$i.': Опис' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати систему</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Безпека вашого переходу (Ризики та Рішення)</h3>';
    hygge_render_field( $post->ID, 'mig_safe_title', 'Головний заголовок секції' );
    hygge_render_field( $post->ID, 'mig_risk_badge', 'Бейдж "Ризики"' );
    hygge_render_field( $post->ID, 'mig_risk_title', 'Заголовок "Чого побоюється бізнес?"' );
    hygge_render_field( $post->ID, 'mig_sol_badge', 'Бейдж "Рішення"' );
    hygge_render_field( $post->ID, 'mig_sol_title', 'Заголовок "Рішення від Hygge System"' );
    
    $mig_risk_count = get_post_meta( $post->ID, 'mig_risk_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="mig_risk">';
    echo '<input type="hidden" name="mig_risk_count" class="repeater-count" value="' . esc_attr($mig_risk_count) . '">';
    for ($i = 1; $i <= $mig_risk_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'mig_risk'.$i, 'Ризик '.$i, 'textarea', '', 'hygge-grid-col-1-2' );
        hygge_render_field( $post->ID, 'mig_sol'.$i, 'Рішення '.$i, 'textarea', '', 'hygge-grid-col-1-2' );
        echo '</div>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати ризик/рішення</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Етапи переходу</h3>';
    hygge_render_field( $post->ID, 'mig_process_title', 'Заголовок "Як проходить перехід"' );
    
    $mig_step_count = get_post_meta( $post->ID, 'mig_step_count', true ) ?: 5;
    echo '<div class="hygge-repeater" data-prefix="mig_step">';
    echo '<input type="hidden" name="mig_step_count" class="repeater-count" value="' . esc_attr($mig_step_count) . '">';
    for ($i = 1; $i <= $mig_step_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'mig_step'.$i.'_title', 'Етап '.$i.': Заголовок' );
        hygge_render_field( $post->ID, 'mig_step'.$i.'_text', 'Етап '.$i.': Опис', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати етап</button>';
    echo '</div>';
}

/**
 * Render Meta Box: Promos
 */
function hygge_render_promos_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'promos_title', 'Заголовок сторінки' );
    hygge_render_field( $post->ID, 'promos_subtitle', 'Підзаголовок', 'textarea' );
}

/**
 * Render Meta Box: Cases
 */
function hygge_render_cases_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'cases_title', 'Заголовок сторінки' );
    hygge_render_field( $post->ID, 'cases_subtitle', 'Підзаголовок', 'textarea' );
    hygge_render_field( $post->ID, 'cases_filters', 'Фільтри (через кому, напр. "Виробництво, Дистрибуція, Рітейл")' );
}

/**
 * Render Meta Box: Promo Single
 */
function hygge_render_promo_single_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'promo_tag', 'Бейдж (Тег)' );
    hygge_render_field( $post->ID, 'promo_subtitle', 'Підзаголовок перед текстом' );
    hygge_render_field( $post->ID, 'promo_benefits_html', 'HTML список переваг', 'textarea', 'Можете вставити HTML код списку <ul>...</ul>' );
    hygge_render_field( $post->ID, 'promo_deadline_icon', 'Іконка дедлайну (SVG/Емодзі)', 'textarea' );
    hygge_render_field( $post->ID, 'promo_deadline', 'Текст дедлайну (до якого числа діє)' );
    hygge_render_field( $post->ID, 'promo_btn_text', 'Текст кнопки "Забронювати"' );
    hygge_render_field( $post->ID, 'promo_btn_url', 'Посилання кнопки "Забронювати" (URL)' );
    hygge_render_field( $post->ID, 'promo_hero_img_url', 'Головне зображення акції (URL)' );
}

/**
 * Render Meta Box: Case Single
 */
function hygge_render_case_single_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'case_tag', 'Тег (напр. "Виробництво")' );
    hygge_render_field( $post->ID, 'case_sidebar_title', 'Заголовок сайдбару' );
    echo '<hr style="margin:20px 0;"><h3>Деталі проекту (Сайдбар)</h3>';
    $case_detail_count = get_post_meta( $post->ID, 'case_detail_count', true ) ?: 3;
    echo '<div class="hygge-repeater" data-prefix="case_detail">';
    echo '<input type="hidden" name="case_detail_count" class="repeater-count" value="' . esc_attr($case_detail_count) . '">';
    for ($i = 1; $i <= $case_detail_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'case_detail'.$i.'_label', 'Підпис (напр. "Клієнт:")', 'text', '', 'hygge-grid-col-1-2' );
        hygge_render_field( $post->ID, 'case_detail'.$i.'_value', 'Значення (напр. "ТОВ МеталБуд")', 'text', '', 'hygge-grid-col-1-2' );
        echo '</div>';
        hygge_render_field( $post->ID, 'case_detail'.$i.'_icon', 'Іконка (SVG/Емодзі)', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати рядок</button>';
    echo '</div>';
    hygge_render_field( $post->ID, 'case_highlight_title', 'Заголовок виділеного результату' );
    hygge_render_field( $post->ID, 'case_highlight_text', 'Текст виділеного результату', 'textarea' );
    hygge_render_field( $post->ID, 'case_hero_img_url', 'Головне зображення кейсу (URL)' );
}

/**
 * Render Meta Box: Product Card
 */
function hygge_render_product_card_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );

    $cat_val = get_post_meta($post->ID, 'prod_category', true);
    echo '<div style="margin-bottom: 15px;">';
    echo '<label for="prod_category" style="display:block; font-weight:bold; margin-bottom:5px;">Колонка в Головному Меню (Програми)</label>';
    echo '<select id="prod_category" name="prod_category" style="width:100%; max-width:400px;">';
    echo '<option value="func" ' . selected($cat_val, 'func', false) . '>Функціональні модулі SAP Business One</option>';
    echo '<option value="ind" ' . selected($cat_val, 'ind', false) . '>Індустріальні рішення</option>';
    echo '<option value="loc" ' . selected($cat_val, 'loc', false) . '>Локалізація для України</option>';
    echo '</select>';
    echo '</div>';
    
    hygge_render_field( $post->ID, 'prod_badge', 'Бейдж' );
    hygge_render_field( $post->ID, 'prod_hero_text', 'Опис головного екрану', 'textarea' );
    hygge_render_field( $post->ID, 'prod_btn1', 'Кнопка 1' );
    hygge_render_field( $post->ID, 'prod_btn1_url', 'Посилання кнопки 1 (URL)' );
    hygge_render_field( $post->ID, 'prod_btn2', 'Кнопка 2' );
    hygge_render_field( $post->ID, 'prod_btn2_url', 'Посилання кнопки 2 (URL)' );
    hygge_render_field( $post->ID, 'prod_hero_img_url', 'Головне зображення програми (URL)' );
    echo '<hr style="margin:20px 0;"><h3>Секція "Чому це важливо"</h3>';
    hygge_render_field( $post->ID, 'prod_intro_label', 'Лейбл секції' );
    hygge_render_field( $post->ID, 'prod_intro_title', 'Заголовок секції' );
    hygge_render_field( $post->ID, 'prod_intro_text', 'Опис', 'textarea' );
    hygge_render_field( $post->ID, 'prod_list1_title', 'Пункт 1: Заголовок' );
    hygge_render_field( $post->ID, 'prod_list1_text', 'Пункт 1: Опис', 'textarea' );
    hygge_render_field( $post->ID, 'prod_list2_title', 'Пункт 2: Заголовок' );
    hygge_render_field( $post->ID, 'prod_list2_text', 'Пункт 2: Опис', 'textarea' );
    hygge_render_field( $post->ID, 'prod_list3_title', 'Пункт 3: Заголовок' );
    hygge_render_field( $post->ID, 'prod_list3_text', 'Пункт 3: Опис', 'textarea' );
    hygge_render_field( $post->ID, 'prod_intro_btn_text', 'Текст кнопки під списком' );

    echo '<hr style="margin:20px 0;"><h3>Секція "Мінімізація" (Темний блок)</h3>';
    hygge_render_field( $post->ID, 'prod_highlight_icon', 'Іконка (SVG/Емодзі)', 'textarea' );
    hygge_render_field( $post->ID, 'prod_highlight_title', 'Заголовок хайлайту' );
    hygge_render_field( $post->ID, 'prod_highlight_text', 'Текст хайлайту', 'textarea' );

    echo '<hr style="margin:20px 0;"><h3>Секція "Можливості"</h3>';
    hygge_render_field( $post->ID, 'prod_features_title', 'Головний заголовок секції' );
    hygge_render_field( $post->ID, 'prod_features_subtitle', 'Підзаголовок секції' );
    
    $prod_feat_count = get_post_meta( $post->ID, 'prod_feat_count', true ) ?: 3;
    echo '<div class="hygge-repeater" data-prefix="prod_feat">';
    echo '<input type="hidden" name="prod_feat_count" class="repeater-count" value="' . esc_attr($prod_feat_count) . '">';
    for ($i = 1; $i <= $prod_feat_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'prod_feat'.$i.'_title', 'Можливість '.$i.': Заголовок' );
        hygge_render_field( $post->ID, 'prod_feat'.$i.'_text', 'Можливість '.$i.': Опис', 'textarea' );
        hygge_render_field( $post->ID, 'prod_feat'.$i.'_img', 'Можливість '.$i.': Зображення (URL на картинку)' );
        echo '<div class="hygge-grid-row">';
        hygge_render_field( $post->ID, 'prod_feat'.$i.'_btn', 'Можливість '.$i.': Текст кнопки', 'text', '', 'hygge-grid-col-1-2' );
        hygge_render_field( $post->ID, 'prod_feat'.$i.'_btn_url', 'Можливість '.$i.': Посилання', 'text', '', 'hygge-grid-col-1-2' );
        echo '</div>';
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати можливість</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Як отримати демо-версію програми? (4 кроки)</h3>';
    hygge_render_field( $post->ID, 'prod_demo_title', 'Заголовок секції "Як отримати демо"' );
    
    $prod_demo_count = get_post_meta( $post->ID, 'prod_demo_count', true ) ?: 4;
    echo '<div class="hygge-repeater" data-prefix="prod_demo">';
    echo '<input type="hidden" name="prod_demo_count" class="repeater-count" value="' . esc_attr($prod_demo_count) . '">';
    for ($i = 1; $i <= $prod_demo_count; $i++) {
        echo '<div class="hygge-admin-card hygge-repeater-row">';
        echo '<button type="button" class="hygge-remove-row" title="Видалити">&times;</button>';
        hygge_render_field( $post->ID, 'prod_demo'.$i.'_title', 'Крок '.$i.': Заголовок' );
        hygge_render_field( $post->ID, 'prod_demo'.$i.'_text', 'Крок '.$i.': Опис', 'textarea' );
        echo '</div>';
    }
    echo '<button type="button" class="hygge-add-row button button-primary">+ Додати крок</button>';
    echo '</div>';

    echo '<hr style="margin:20px 0;"><h3>Секція "Інші програми"</h3>';
    hygge_render_field( $post->ID, 'prod_other_title', 'Заголовок секції "Інші програми"' );
}

/**
 * Render Meta Box: Blog Page
 */
function hygge_render_blog_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    
    hygge_render_field( $post->ID, 'blog_title', 'Заголовок сторінки блогу' );
    hygge_render_field( $post->ID, 'blog_subtitle', 'Підзаголовок', 'textarea' );
}

/**
 * Render Meta Box: Single Post (Blog Article)
 */
function hygge_render_single_post_meta_box( $post ) {
    wp_nonce_field( 'hygge_save_meta', 'hygge_meta_nonce' );
    hygge_render_field( $post->ID, 'article_time_icon', 'Іконка часу читання (SVG/Емодзі)', 'textarea' );
    hygge_render_field( $post->ID, 'read_time', 'Час на читання (напр. "5 хв на читання")' );
    hygge_render_field( $post->ID, 'article_date_icon', 'Іконка дати (SVG/Емодзі)', 'textarea' );
    hygge_render_field( $post->ID, 'article_custom_date', 'Кастомна дата (якщо порожньо, буде дата публікації)' );
    hygge_render_field( $post->ID, 'article_hero_img_url', 'Обкладинка статті (URL)' );
}

/**
 * Save Meta Box Data
 */
function hygge_save_meta_boxes( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['hygge_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hygge_meta_nonce'], 'hygge_save_meta' ) ) {
        return;
    }

    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user permissions
    if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // List of all possible fields
    $fields = [
        'hero_badge', 'hero_title_highlight', 'hero_title_main', 'hero_subtitle', 'hero_btn1', 'hero_btn2', 'hero_btn1_url', 'hero_btn2_url',
        'problems_title', 'problems_text', 'solution_title', 'solution_text',
        'prob1_title', 'prob1_text', 'prob2_title', 'prob2_text', 'prob3_title', 'prob3_text', 'prob4_title', 'prob4_text',
        'prob1_icon', 'prob2_icon', 'prob3_icon', 'prob4_icon',
        'fp_tab1_btn', 'fp_tab1_img', 'fp_tab1_title', 'fp_tab1_text',
        'fp_tab2_btn', 'fp_tab2_img', 'fp_tab2_title', 'fp_tab2_text',
        'fp_tab3_btn', 'fp_tab3_img', 'fp_tab3_title', 'fp_tab3_text',
        'fp_tab4_btn', 'fp_tab4_img', 'fp_tab4_title', 'fp_tab4_text',
        'sap_badge', 'sap_hero_title', 'sap_hero_text', 'sap_btn1', 'sap_btn2', 'sap_btn1_url', 'sap_btn2_url',
        'sap_intro_title', 'sap_intro_text1', 'sap_intro_text2', 'sap_stat1_num', 'sap_stat1_text', 'sap_stat2_num', 'sap_stat2_text', 'sap_stat3_num', 'sap_stat3_text',
        'sap_modules_title', 'sap_tech_title', 'sap_tech_text', 'sap_hana_badge', 'sap_deploy_title', 'sap_deploy_subtitle', 'sap_features_title',
        'sap_mod1_title', 'sap_mod1_text', 'sap_mod2_title', 'sap_mod2_text', 'sap_mod3_title', 'sap_mod3_text', 'sap_mod4_title', 'sap_mod4_text',
        'sap_mod1_icon', 'sap_mod2_icon', 'sap_mod3_icon', 'sap_mod4_icon',
        'sap_tab1_btn', 'sap_tab1_img', 'sap_tab1_title', 'sap_tab1_text',
        'sap_tech_check1', 'sap_tech_check2', 'sap_tech_check3',
        'sap_dep_op_title', 'sap_dep_op_subtitle', 'sap_dep_op_l1', 'sap_dep_op_l2', 'sap_dep_op_l3', 'sap_dep_op_l4', 'sap_dep_op_l5',
        'sap_dep_cl_title', 'sap_dep_cl_subtitle', 'sap_dep_cl_l1', 'sap_dep_cl_l2', 'sap_dep_cl_l3', 'sap_dep_cl_l4', 'sap_dep_cl_l5',
        'sap_feat1_title', 'sap_feat1_text', 'sap_feat2_title', 'sap_feat2_text', 'sap_feat3_title', 'sap_feat3_text', 'sap_feat4_title', 'sap_feat4_text',
        'sap_feat5_title', 'sap_feat5_text', 'sap_feat6_title', 'sap_feat6_text', 'sap_feat7_title', 'sap_feat7_text', 'sap_feat8_title', 'sap_feat8_text',
        'mig_badge', 'mig_title', 'mig_text', 'mig_btn1', 'mig_btn2', 'mig_btn1_url', 'mig_btn2_url', 'mig_hero_img_url',
        'mig_reasons_title', 'mig_reasons_text', 'mig_reasons_btn', 'mig_reasons_btn_url',
        'mig_what_title', 'mig_center_title', 'mig_center_text', 'mig_systems_title',
        'mig_safe_title', 'mig_risk_badge', 'mig_risk_title', 'mig_sol_badge', 'mig_sol_title',
        'mig_process_title', 'mig_step1_title', 'mig_step1_text', 'mig_step2_title', 'mig_step2_text', 'mig_step3_title', 'mig_step3_text', 'mig_step4_title', 'mig_step4_text', 'mig_step5_title', 'mig_step5_text',
        'mig_tab1_btn', 'mig_tab1_img', 'mig_tab1_title', 'mig_tab1_text',
        'mig_tab2_btn', 'mig_tab2_img', 'mig_tab2_title', 'mig_tab2_text',
        'mig_tab3_btn', 'mig_tab3_img', 'mig_tab3_title', 'mig_tab3_text',
        'mig_tab4_btn', 'mig_tab4_img', 'mig_tab4_title', 'mig_tab4_text',
        'mig_tab5_btn', 'mig_tab5_img', 'mig_tab5_title', 'mig_tab5_text',
        'mig_tab6_btn', 'mig_tab6_img_url', 'mig_tab6_title', 'mig_tab6_text',
        'mig_orbit_center', 'mig_orbit_item1', 'mig_orbit_item2', 'mig_orbit_item3', 'mig_orbit_item4', 'mig_orbit_item5', 'mig_orbit_item6', 'mig_orbit_item7', 'mig_orbit_item8',
        'mig_sys1_title', 'mig_sys1_desc', 'mig_sys2_title', 'mig_sys2_desc', 'mig_sys3_title', 'mig_sys3_desc',
        'mig_sys4_title', 'mig_sys4_desc', 'mig_sys5_title', 'mig_sys5_desc', 'mig_sys6_title', 'mig_sys6_desc',
        'mig_risk1', 'mig_sol1', 'mig_risk2', 'mig_sol2', 'mig_risk3', 'mig_sol3', 'mig_risk4', 'mig_sol4',
        'mig_step3_title', 'mig_step3_text', 'mig_step4_title', 'mig_step4_text', 'mig_step5_title', 'mig_step5_text',
        'promos_title', 'promos_subtitle', 'cases_title', 'cases_subtitle', 'cases_filters',
        'promo_tag', 'promo_subtitle', 'promo_benefits_html', 'promo_deadline', 'promo_deadline_icon', 'promo_btn_text', 'promo_btn_url',
        'case_tag', 'case_sidebar_title', 'case_highlight_title', 'case_highlight_text',
        'prod_category', 'prod_badge', 'prod_hero_text', 'prod_btn1', 'prod_btn1_url', 'prod_btn2', 'prod_btn2_url', 'prod_hero_img_url',
        'prod_intro_label', 'prod_intro_title', 'prod_intro_text', 'prod_list1_title', 'prod_list1_text', 'prod_list2_title', 'prod_list2_text', 'prod_list3_title', 'prod_list3_text', 'prod_intro_btn_text',
        'prod_highlight_title', 'prod_highlight_text', 'prod_highlight_icon',
        'prod_features_title', 'prod_features_subtitle',
        'prod_feat1_img', 'prod_feat1_title', 'prod_feat1_text', 'prod_feat1_btn', 'prod_feat1_btn_url',
        'prod_feat2_img', 'prod_feat2_title', 'prod_feat2_text', 'prod_feat2_btn', 'prod_feat2_btn_url',
        'prod_feat3_img', 'prod_feat3_title', 'prod_feat3_text', 'prod_feat3_btn', 'prod_feat3_btn_url',
        'prod_demo_title', 'prod_demo1_title', 'prod_demo1_text', 'prod_demo2_title', 'prod_demo2_text', 'prod_demo3_title', 'prod_demo3_text', 'prod_demo4_title', 'prod_demo4_text', 'prod_other_title',
        'blog_title', 'blog_subtitle', 'read_time', 'article_time_icon', 'article_custom_date', 'article_date_icon',
        'hero_img_url', 'sap_hero_img_url', 'mig_hero_img_url', 'prod_hero_img_url', 'case_hero_img_url', 'promo_hero_img_url', 'article_hero_img_url'
    ];

    // Repeater prefixes
    $repeater_prefixes = ['prob', 'fp_tab', 'sap_mod', 'sap_tech_check', 'sap_dep_op_l', 'sap_dep_cl_l', 'sap_feat', 'mig_tab', 'mig_orbit_item', 'mig_sys', 'mig_risk', 'mig_sol', 'mig_step', 'prod_feat', 'prod_demo', 'case_detail'];

    foreach ( $_POST as $key => $value ) {
        $should_save = false;
        
        // Skip WordPress internal hidden fields
        if ( strpos($key, '_') === 0 ) continue;
        
        if ( in_array( $key, $fields ) ) {
            $should_save = true;
        } else {
            foreach ( $repeater_prefixes as $prefix ) {
                if ( preg_match( '/^' . preg_quote( $prefix, '/' ) . '\\d+(_.*)?$/', $key ) || $key === $prefix . '_count' ) {
                    $should_save = true;
                    break;
                }
            }
        }

        if ( $should_save ) {
            if ( $key === 'promo_benefits_html' ) {
                if ( current_user_can('unfiltered_html') ) {
                    update_post_meta( $post_id, $key, wp_unslash( $value ) );
                } else {
                    update_post_meta( $post_id, $key, wp_kses_post( wp_unslash( $value ) ) );
                }
            } elseif ( strpos( $key, 'text' ) !== false || strpos( $key, 'subtitle' ) !== false ) {
                update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $value ) ) );
            } elseif ( strpos( $key, 'icon' ) !== false ) {
                // allow SVG tags for icons
                update_post_meta( $post_id, $key, wp_kses( wp_unslash( $value ), array( 'svg' => array( 'class' => true, 'viewbox' => true, 'xmlns' => true, 'fill' => true, 'width' => true, 'height' => true ), 'path' => array( 'd' => true, 'fill' => true ) ) ) );
            } else {
                update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $value ) ) );
            }
        }
    }
}
add_action( 'save_post', 'hygge_save_meta_boxes' );

