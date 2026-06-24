<?php
/**
 * Hygge System Theme Customizer
 */

function hygge_customize_register( $wp_customize ) {
    // Panel or Section for Footer
    $wp_customize->add_section( 'hygge_footer_options', array(
        'title'       => __( 'Налаштування підвалу (Контакти)', 'hygge-system' ),
        'priority'    => 130,
    ) );

    // Panel or Section for Global CTA Form
    $wp_customize->add_section( 'hygge_cta_options', array(
        'title'       => __( 'Глобальна форма заявки (CTA)', 'hygge-system' ),
        'priority'    => 120,
    ) );


    // Panel or Section for Header Menu
    $wp_customize->add_section( 'hygge_header_options', array(
        'title'       => __( 'Налаштування шапки (Меню)', 'hygge-system' ),
        'priority'    => 110,
    ) );

    // Panel or Section for Global Products
    $wp_customize->add_section( 'hygge_product_options', array(
        'title'       => __( 'Глобальні налаштування програм', 'hygge-system' ),
        'priority'    => 125,
    ) );

    // Panel or Section for Blog & Cases Lists
    $wp_customize->add_section( 'hygge_lists_options', array(
        'title'       => __( 'Списки (Блог та Кейси)', 'hygge-system' ),
        'priority'    => 126,
    ) );

    // Footer Description
    $wp_customize->add_setting( 'footer_desc', array(
        'default'           => 'Надійне впровадження міжнародної ERP-системи SAP Business One для українського бізнесу.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'footer_desc', array(
        'label'    => __( 'Короткий опис під логотипом', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    // Phone
    $wp_customize->add_setting( 'footer_phone', array(
        'default'           => '+38 (000) 000-00-00',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_phone', array(
        'label'    => __( 'Телефон', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'text',
    ) );

    // Phone URL
    $wp_customize->add_setting( 'footer_phone_url', array(
        'default'           => 'tel:+380000000000',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_phone_url', array(
        'label'    => __( 'Телефон (URL для дзвінка)', 'hygge-system' ),
        'description' => 'Напр. tel:+380000000000',
        'section'  => 'hygge_footer_options',
        'type'     => 'text',
    ) );

    // Email
    $wp_customize->add_setting( 'footer_email', array(
        'default'           => 'hello@hyggesystem.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'footer_email', array(
        'label'    => __( 'Email', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'email',
    ) );

    // Address
    $wp_customize->add_setting( 'footer_address', array(
        'default'           => 'м. Київ, вул. Хрещатик, 1',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_address', array(
        'label'    => __( 'Адреса', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'footer_loc_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_loc_icon', array(
        'label'    => __( 'Іконка адреси (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'footer_phone_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_phone_icon', array(
        'label'    => __( 'Іконка телефону (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'footer_email_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_email_icon', array(
        'label'    => __( 'Іконка Email (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'footer_copyright', array(
        'default'           => '© {year} Hygge System. Всі права захищені.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_copyright', array(
        'label'    => __( 'Текст копірайту (використовуйте {year} для поточного року)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'text',
    ) );

    // Footer Titles
    $wp_customize->add_setting( 'footer_col1_title', array(
        'default'           => 'Карта сайту',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_col1_title', array(
        'label'    => __( 'Заголовок колонки 1', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'footer_col2_title', array(
        'default'           => 'Контакти',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_col2_title', array(
        'label'    => __( 'Заголовок колонки 2', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'text',
    ) );

    // Socials
    $wp_customize->add_setting( 'footer_linkedin', array(
        'default'           => '#!',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_linkedin', array(
        'label'    => __( 'LinkedIn (URL)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'footer_facebook', array(
        'default'           => '#!',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_facebook', array(
        'label'    => __( 'Facebook (URL)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'footer_youtube', array(
        'default'           => '#!',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'footer_youtube', array(
        'label'    => __( 'YouTube (URL)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'footer_linkedin_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_linkedin_icon', array(
        'label'    => __( 'LinkedIn Іконка (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'footer_facebook_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_facebook_icon', array(
        'label'    => __( 'Facebook Іконка (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'footer_youtube_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_youtube_icon', array(
        'label'    => __( 'YouTube Іконка (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_footer_options',
        'type'     => 'textarea',
    ) );

    // --- CTA FORM SETTINGS ---
    $wp_customize->add_setting( 'cta_title', array(
        'default'           => 'Запросити консультацію щодо переходу',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cta_title', array(
        'label'    => __( 'Заголовок форми', 'hygge-system' ),
        'section'  => 'hygge_cta_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'cta_subtitle', array(
        'default'           => 'Залиште заявку — ми зв\'яжемося з вами протягом одного робочого дня та відповімо на всі питання.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'cta_subtitle', array(
        'label'    => __( 'Опис під заголовком', 'hygge-system' ),
        'section'  => 'hygge_cta_options',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'cta_btn_text', array(
        'default'           => 'Надіслати заявку',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cta_btn_text', array(
        'label'    => __( 'Текст кнопки', 'hygge-system' ),
        'section'  => 'hygge_cta_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'cta_success_msg', array(
        'default'           => '✓ Дякуємо! Ваша заявка успішно відправлена. Ми зв\'яжемося з вами найближчим часом.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'cta_success_msg', array(
        'label'    => __( 'Повідомлення про успішну відправку', 'hygge-system' ),
        'section'  => 'hygge_cta_options',
        'type'     => 'textarea',
    ) );

    // --- HEADER SETTINGS ---
    $wp_customize->add_setting( 'header_col1_title', array(
        'default'           => 'Функціональні модулі SAP Business One',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_col1_title', array(
        'label'    => __( 'Заголовок колонки 1 (Мега-меню)', 'hygge-system' ),
        'section'  => 'hygge_header_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'header_col2_title', array(
        'default'           => 'Індустріальні рішення',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_col2_title', array(
        'label'    => __( 'Заголовок колонки 2 (Мега-меню)', 'hygge-system' ),
        'section'  => 'hygge_header_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'header_col3_title', array(
        'default'           => 'Локалізація для України',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'header_col3_title', array(
        'label'    => __( 'Заголовок колонки 3 (Мега-меню)', 'hygge-system' ),
        'section'  => 'hygge_header_options',
        'type'     => 'text',
    ) );

    // --- PRODUCT SETTINGS ---
    $wp_customize->add_setting( 'prod_other_btn', array(
        'default'           => 'Детальніше →',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'prod_other_btn', array(
        'label'    => __( 'Текст кнопки "Детальніше" на інших програмах', 'hygge-system' ),
        'section'  => 'hygge_product_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'prod_other_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'prod_other_icon', array(
        'label'    => __( 'Іконка для інших програм (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_product_options',
        'type'     => 'textarea',
    ) );

    // --- BLOG & CASES SETTINGS ---
    $wp_customize->add_setting( 'blog_read_more', array(
        'default'           => 'Читати статтю →',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'blog_read_more', array(
        'label'    => __( 'Текст кнопки "Читати статтю"', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'cases_read_more', array(
        'default'           => 'Читати кейс →',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cases_read_more', array(
        'label'    => __( 'Текст кнопки "Читати кейс"', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'blog_return_btn', array(
        'default'           => '← Повернутися до списку',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'blog_return_btn', array(
        'label'    => __( 'Кнопка "Повернутися до списку" (Блог)', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'cases_return_btn', array(
        'default'           => '← Всі реалізовані проекти',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cases_return_btn', array(
        'label'    => __( 'Кнопка "Повернутися до списку" (Кейси)', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'blog_read_more', array(
        'default'           => 'Читати далі →',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'blog_read_more', array(
        'label'    => __( 'Текст кнопки "Читати далі"', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'pagination_prev', array(
        'default'           => '←',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'pagination_prev', array(
        'label'    => __( 'Стрілка "Попередня сторінка" (Пагінація)', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'pagination_next', array(
        'default'           => '→',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'pagination_next', array(
        'label'    => __( 'Стрілка "Наступна сторінка" (Пагінація)', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'promo_benefit_icon', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'promo_benefit_icon', array(
        'label'    => __( 'Загальна іконка для переваг (SVG/Емодзі)', 'hygge-system' ),
        'section'  => 'hygge_lists_options',
        'type'     => 'textarea',
    ) );

}
add_action( 'customize_register', 'hygge_customize_register' );

