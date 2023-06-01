<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// admin enqueue
function cf7_highen_admin_enqueue() {
	// admin css
	wp_register_style('cf7_highen-admin-css', plugins_url('../assets/css/admin.css', __FILE__), false, false);
	wp_enqueue_style('cf7_highen-admin-css');
	// admin js
	wp_enqueue_script('cf7_highen-admin', plugins_url('../assets/js/admin.js', __FILE__), array('jquery'), false);
}
add_action('admin_enqueue_scripts', 'cf7_highen_admin_enqueue');


// public enqueue
function cf7_highen_public_enqueue() {
	// redirect method js
	wp_enqueue_script('cf7_highen-redirect_method', plugins_url('../assets/js/redirect_method.js', __FILE__), array('jquery'), null);
	wp_localize_script('cf7_highen-redirect_method', 'cf7_highen_ajax_object',
		array (
			'cf7_highen_ajax_url' 		=> admin_url('admin-ajax.php'),
			'cf7_highen_forms' 			=> cf7_highen_forms_enabled(),
		)
	);
}
add_action('wp_enqueue_scripts', 'cf7_highen_public_enqueue', 10);