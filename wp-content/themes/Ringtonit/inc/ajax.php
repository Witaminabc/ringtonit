<?php

add_action('wp_ajax_send_feedback_form', 'handle_feedback_form');
add_action('wp_ajax_nopriv_send_feedback_form', 'handle_feedback_form');

add_action('wp_ajax_send_modal_form', 'handle_modal_form');
add_action('wp_ajax_nopriv_send_modal_form', 'handle_modal_form');

function handle_feedback_form() {
    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $service = sanitize_text_field($_POST['services'] ?? '');
    $agreement = isset($_POST['agreement']) ? 'Yes' : 'No';

    $to = carbon_get_theme_option('crb_contacts_email');
    $subject = 'New Feedback Form Submission';
    $body = "Name: $name\nPhone: $phone\nService: $service\nMessage: $message\nAgreement: $agreement";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if ($to && is_email($to)) {
        wp_mail($to, $subject, $body, $headers);
    }

    wp_send_json_success(['message' => 'Thank you, we will contact you soon!']);
}

function handle_modal_form() {
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    $to = carbon_get_theme_option('crb_contacts_email');
    $subject = 'New Modal Form Submission';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if ($to && is_email($to)) {
        wp_mail($to, $subject, $body, $headers);
    }

    wp_send_json_success(['message' => 'Message sent successfully!']);
}
