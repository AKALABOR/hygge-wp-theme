<?php
/**
 * Hygge System Theme functions and definitions
 */

if ( ! function_exists( 'hygge_system_setup' ) ) :
	function hygge_system_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Головне Меню (Primary)', 'hygge-system' ),
				'footer-1' => esc_html__( 'Підвал: Навігація', 'hygge-system' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'hygge_system_setup' );

/**
 * Enqueue scripts and styles.
 */
function hygge_system_scripts() {
    // Fonts
    wp_enqueue_style( 'hygge-system-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );
    
	// Main Style
	wp_enqueue_style( 'hygge-system-style', get_stylesheet_uri(), array(), time() );

	// Scripts
	wp_enqueue_script( 'hygge-system-script', get_template_directory_uri() . '/hygge-main.js', array(), time(), true );
}
add_action( 'wp_enqueue_scripts', 'hygge_system_scripts' );

/**
 * Enqueue Admin scripts and styles.
 */
function hygge_system_admin_scripts() {
    wp_enqueue_style( 'hygge-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), time() );
    wp_enqueue_script( 'hygge-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), time(), true );
}
add_action( 'admin_enqueue_scripts', 'hygge_system_admin_scripts' );

/**
 * Custom Meta Boxes (Alternative to ACF)
 */
require_once get_template_directory() . '/inc/meta-boxes.php';

/**
 * Customizer settings
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * SAP B1 Integration
 */
require_once get_template_directory() . '/inc/sap-b1-integration.php';

/**
 * Handle Global Contact Form Submission
 */
function hygge_handle_contact_form() {
    // 1. Check Nonce for security
    if ( ! isset( $_POST['hygge_contact_nonce'] ) || ! wp_verify_nonce( $_POST['hygge_contact_nonce'], 'hygge_contact_action' ) ) {
        wp_die( 'Помилка перевірки безпеки. Будь ласка, спробуйте ще раз.' );
    }

    $return_url = isset( $_POST['return_url'] ) ? esc_url_raw( $_POST['return_url'] ) : home_url();

    // 1.5. Spam Protection: Honeypot & Timestamp
    // If the hidden 'website_url' field is filled out, it's a bot.
    if ( ! empty( $_POST['website_url'] ) ) {
        // Silently reject, pretend it succeeded so the bot doesn't retry
        wp_redirect( add_query_arg( 'contact_success', '1', $return_url ) . '#contacts' );
        exit;
    }
    
    // If submitted too fast (less than 3 seconds), it's probably a bot.
    $timestamp = isset( $_POST['form_timestamp'] ) ? intval( $_POST['form_timestamp'] ) : 0;
    if ( time() - $timestamp < 3 ) {
        wp_die( 'Заявка відхилена. Можлива автоматизована спам-активність.' );
    }

    // 2. Sanitize inputs
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $contact = isset( $_POST['contact'] ) ? sanitize_text_field( $_POST['contact'] ) : '';
    $company = isset( $_POST['company'] ) ? sanitize_text_field( $_POST['company'] ) : '';

    if ( empty( $name ) || empty( $contact ) ) {
        wp_die( 'Ім\'я та контакт є обов\'язковими.' );
    }

    // 3. Send Email to Admin
    $to      = get_option( 'admin_email' );
    $subject = 'Нова заявка з сайту Hygge System: ' . $name;
    $message = "Ім'я: $name\nКонтакт: $contact\n\nВідправлено зі сторінки: $return_url";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    wp_mail( $to, $subject, $message, $headers );

    // 4. Send Data to SAP Business One CRM via cURL (Placeholder)
    /*
    $sap_api_url = 'https://your-sap-server.com/b1s/v1/Leads';
    $sap_api_key = 'YOUR_SECRET_TOKEN';
    
    $sap_data = json_encode(array(
        'CardName'  => $name,
        'Phone1'    => $contact,
        'CardCode'  => 'L' . time(), // example logic
        'Notes'     => 'Website submission'
    ));

    $ch = curl_init($sap_api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $sap_api_key
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $sap_data);
    
    // $response = curl_exec($ch);
    // curl_close($ch);
    */

    // 5. Redirect back with success message
    $redirect_url = add_query_arg( 'contact_success', '1', $return_url ) . '#contacts';
    wp_redirect( $redirect_url );
    exit;
}
add_action( 'admin_post_nopriv_hygge_contact_form', 'hygge_handle_contact_form' );
add_action( 'admin_post_hygge_contact_form', 'hygge_handle_contact_form' );



/**
 * Helper function to get image alt text from Media Library.
 */
function hygge_get_image_alt( $image_url, $default_alt = '' ) {
    if ( empty( $image_url ) ) return $default_alt;
    
    if ( function_exists( "attachment_url_to_postid" ) ) {
        $attachment_id = attachment_url_to_postid( $image_url );
        if ( $attachment_id ) {
            $alt = get_post_meta( $attachment_id, "_wp_attachment_image_alt", true );
            if ( ! empty( $alt ) ) {
                return $alt;
            }
        }
    }
    return $default_alt;
}

