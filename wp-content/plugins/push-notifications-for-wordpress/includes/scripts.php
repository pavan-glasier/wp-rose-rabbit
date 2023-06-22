<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function push_notifications_enqueue_scripts() {
    // Enqueue service worker script
    wp_register_script('Firebase_App', 'https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js', array(), true);
		wp_enqueue_script('Firebase_App');

    wp_enqueue_script('firebase-messaging', 'https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js', array(), true);
    
    // wp_enqueue_script('push-notifications-service-worker', PLUGIN_URL . '/assets/firebase-messaging-sw.js', array('Firebase_App'), true);
    wp_enqueue_script('push-notificationsjs', PLUGIN_URL . '/assets/firebase-notification.js', array('Firebase_App'), true);
    wp_localize_script('push-notificationsjs', 'push_notification_ajax_object', array(
      'ajax_url'  			=> admin_url('admin-ajax.php'),
      'site_url'        => PLUGIN_URL,
    ));
    wp_add_inline_script('push-notificationsjs', 'push_notification_ajax_object.config = '. get_option('gi_firebase_config_code') );
}
if( ((int) get_option('gi_push_notification_enabled') == 1) && !empty( get_option('gi_firebase_config_code') ) ){
  add_action('wp_enqueue_scripts', 'push_notifications_enqueue_scripts', 10);
}