<?php
/*
Plugin Name: Push Notifications for WordPress
Plugin URI: https://glasierinc.com
Description: Sends push notifications to users.
Version: 1.0.0
Author: GlasierInc
Author URI: https://glasierinc.com
License: GPL2

*/

if( ! defined('ABSPATH') ){
    die();
}

// define for plugin dir path
define('PLUGIN_URL', plugins_url('', __FILE__));

class PushNotificationWP {
    function __construct(){
        include_once('includes/scripts.php');
        include_once('includes/settings.php');
    }

    function activate_function() {
        // Create New Table For Store Device Token
        global $wpdb;
        $table_name = $wpdb->prefix . 'users_device_token';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            device_token TEXT,
            status int,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        // End

        // create option fields in wp-option table for configuration
        update_option('gi_push_notification_enabled', '0');
        update_option('gi_firebase_config_code', '');
    }

    // function deactivate_function(){
    //     global $wpdb;
    //     $table_name = $wpdb->prefix . 'users_device_token';
    //     $sql = "DROP TABLE IF EXISTS $table_name;";
    //     $wpdb->query($sql);
    // }

    function uninstall_function(){
        // delete table on uninstall the plugin
        global $wpdb;
        $table_name = $wpdb->prefix . 'users_device_token';
        $sql = "DROP TABLE IF EXISTS $table_name;";
        $wpdb->query($sql);
        // End

        // delete option fields
        delete_option('gi_push_notification_enabled');
        delete_option('gi_firebase_config_code');
    }
    
}

if( class_exists('PushNotificationWP') ){
    $pushNotificationWP = new PushNotificationWP();
}
register_activation_hook( __FILE__, array($pushNotificationWP, 'activate_function') );
register_deactivation_hook( __FILE__, array($pushNotificationWP, 'uninstall_function') );
// register_uninstall_hook( __FILE__, array($pushNotificationWP, 'uninstall_function') );