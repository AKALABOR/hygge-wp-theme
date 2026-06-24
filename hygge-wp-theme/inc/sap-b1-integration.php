<?php
/**
 * SAP Business One CRM Integration
 * This file handles form submissions from the frontend and prepares them 
 * to be sent to the SAP B1 Service Layer API.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle the AJAX request from the frontend form
 */
function hygge_handle_sap_form_submission() {
    // 1. Verify Nonce (Security)
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'hygge_sap_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Невірна перевірка безпеки (Nonce).' ) );
    }

    // 2. Sanitize Input Data
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $contact = isset( $_POST['contact'] ) ? sanitize_text_field( wp_unslash( $_POST['contact'] ) ) : '';
    $company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';

    if ( empty( $name ) || empty( $contact ) ) {
        wp_send_json_error( array( 'message' => 'Будь ласка, заповніть обов\'язкові поля.' ) );
    }

    // 3. Prepare data array for SAP
    $lead_data = array(
        'CardName'  => $company ? $company : $name,
        'CardType'  => 'cCustomer', // Or 'cLid' depending on your SAP B1 settings
        'Phone1'    => $contact,    // Assuming contact is phone. You might want to parse email/phone separately
        'ContactPerson' => $name,
        'Notes'     => 'Заявка з сайту Hygge System',
    );

    // 4. Send to SAP Business One (Call the integration function)
    $sap_response = hygge_send_to_sap_b1( $lead_data );

    if ( $sap_response['success'] ) {
        wp_send_json_success( array( 'message' => 'Дякуємо! Ваша заявка успішно відправлена. Ми зв\'яжемося з вами найближчим часом.' ) );
    } else {
        // Log error locally if needed
        error_log( 'SAP B1 API Error: ' . $sap_response['error_message'] );
        wp_send_json_error( array( 'message' => 'Вибачте, сталася помилка при відправці. Спробуйте пізніше або зателефонуйте нам.' ) );
    }
}
// Hook for logged-in and non-logged-in users
add_action( 'wp_ajax_submit_sap_form', 'hygge_handle_sap_form_submission' );
add_action( 'wp_ajax_nopriv_submit_sap_form', 'hygge_handle_sap_form_submission' );


/**
 * Core function to send data to SAP Business One Service Layer
 * 
 * @param array $data Structured data for the lead
 * @return array array('success' => bool, 'error_message' => string)
 */
function hygge_send_to_sap_b1( $data ) {
    
    // =========================================================
    // TODO: CONFIGURATION FOR SAP B1 SERVICE LAYER
    // =========================================================
    $sap_url      = 'https://your-sap-server:50000/b1s/v1/'; // Replace with your Service Layer URL
    $company_db   = 'YOUR_COMPANY_DB';
    $username     = 'manager';
    $password     = 'your_password';

    /**
     * Щоб інтеграція запрацювала:
     * 1. Спочатку потрібно зробити POST запит на `/b1s/v1/Login` з CompanyDB, UserName, Password.
     * 2. Отримати `B1SESSION` cookie зі збереженням.
     * 3. Зробити POST запит на `/b1s/v1/BusinessPartners` (або Activities) з передачею $data.
     * 4. Зробити POST запит на `/b1s/v1/Logout`.
     */

    // For now, we simulate a successful API connection since credentials are not provided.
    $simulate_success = true;

    if ( $simulate_success ) {
        return array( 'success' => true, 'error_message' => '' );
    }

    /* === EXAMPLE OF REAL IMPLEMENTATION ===
    
    // 1. Login
    $login_args = array(
        'body'    => json_encode( array(
            'CompanyDB' => $company_db,
            'UserName'  => $username,
            'Password'  => $password
        ) ),
        'headers' => array( 'Content-Type' => 'application/json' ),
        'timeout' => 15,
        'sslverify' => false // Set to true in production with valid SSL
    );

    $login_response = wp_remote_post( $sap_url . 'Login', $login_args );
    
    if ( is_wp_error( $login_response ) ) {
        return array( 'success' => false, 'error_message' => $login_response->get_error_message() );
    }

    $cookies = wp_remote_retrieve_header( $login_response, 'set-cookie' );
    // Extract B1SESSION cookie here...

    // 2. Create Lead (BusinessPartner)
    $bp_args = array(
        'body'    => json_encode( $data ),
        'headers' => array( 
            'Content-Type' => 'application/json',
            'Cookie'       => $cookies // Pass the session cookie
        ),
        'timeout' => 15,
        'sslverify' => false
    );

    $bp_response = wp_remote_post( $sap_url . 'BusinessPartners', $bp_args );
    $bp_body     = wp_remote_retrieve_body( $bp_response );
    $bp_code     = wp_remote_retrieve_response_code( $bp_response );

    // Logout after action...
    // wp_remote_post( $sap_url . 'Logout', ... );

    if ( $bp_code == 201 ) {
        return array( 'success' => true, 'error_message' => '' );
    } else {
        return array( 'success' => false, 'error_message' => $bp_body );
    }

    ========================================================= */
}

/**
 * Pass AJAX URL and Nonce to the frontend script
 */
function hygge_enqueue_sap_scripts() {
    wp_localize_script( 'hygge-system-script', 'hyggeAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'hygge_sap_nonce' )
    ));
}
add_action( 'wp_enqueue_scripts', 'hygge_enqueue_sap_scripts', 20 );
