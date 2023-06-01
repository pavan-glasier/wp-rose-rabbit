<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// hook into contact form 7 form
function cf7_highen_editor_panels ( $panels ) {
	$new_page = array(
		'Redirect' => array(
			'title' => __( 'Redirect & Thank You Page', 'cf7_highen' ),
			'callback' => 'cf7_highen_admin_after_additional_settings'
		)
	);
	$panels = array_merge($panels, $new_page);
	return $panels;
}
add_filter( 'wpcf7_editor_panels', 'cf7_highen_editor_panels' );


function cf7_highen_admin_after_additional_settings( $cf7 ) {
	$post_id = sanitize_text_field($_GET['post']);
    $enable = 						get_post_meta($post_id, "_cf7_highen_enable", true);
    $cf7_highen_redirect_type = 	get_post_meta($post_id, "_cf7_highen_redirect_type", true);
    $cf7_highen_url = 				get_post_meta($post_id, "_cf7_highen_url", true);
    $tab = 							get_post_meta($post_id, "_cf7_highen_tab", true);
    $cf7_highen_page = 				get_post_meta($post_id, "_cf7_highen_page", true);
    $page_tab = 						get_post_meta($post_id, "_cf7_highen_page_tab", true);

	if ($enable == "1") { $checked = "CHECKED"; } else { $checked = ""; }
	if ($tab == "1") { $tab = "CHECKED"; } else { $tab = ""; }
	if ($page_tab == "1") { $page_tab = "CHECKED"; } else { $page_tab = ""; }

	$admin_table_output = "";
	$admin_table_output .= "<h1>Redirect</h1>";
	$admin_table_output .= "<div class='mail-field'></div>";
	$admin_table_output .= "<table class='cf7_highen_tabs_table_main'><tr>";
	$admin_table_output .= "<td><h3>General Settings</h3></td></tr>";
	$admin_table_output .= "<td class='cf7_highen_tabs_table_title_width'><label for='cf7_highen_enable'><b>Enable Redirect: </b></label></td>";
	$admin_table_output .= "<td class='cf7_highen_tabs_table_body_width'><input name='cf7_highen_enable' id='cf7_highen_enable' value='1' type='checkbox' $checked></td></tr>";
	$admin_table_output .= "<td class='cf7_highen_tabs_table_title_width'><label for='cf7_highen_redirect_type'><b>Redirect Type:</b> </label></td>";
	$admin_table_output .= "<td class='cf7_highen_tabs_table_body_width'><select id='cf7_highen_redirect_type' name='cf7_highen_redirect_type'>
	<option  "; if ($cf7_highen_redirect_type == 'url') { $admin_table_output .= 'SELECTED'; } $admin_table_output .= " value='url'>URL</option>
	<option  "; if ($cf7_highen_redirect_type == 'page') { $admin_table_output .= 'SELECTED'; } $admin_table_output .= " value='page'>Link Form Item</option></select></td></tr>";	
	
	// URL redirect
	$admin_table_output .= "<tr class='cf7_highen_url cf7_highen_redirect_option'><td><br /><h3>URL Redirect Settings</h3></td></tr>";
	$admin_table_output .= "<tr class='cf7_highen_url cf7_highen_redirect_option'><td><label for='cf7_highen_url'><b>URL: </b></label></td>";
	$admin_table_output .= "<td><input type='url' name='cf7_highen_url' id='cf7_highen_url' value='$cf7_highen_url'> </td><td> Example: http://www.domain.com</td></tr><tr><td colspan='3'></td></tr>";
	
	$admin_table_output .= "<tr class='cf7_highen_url cf7_highen_redirect_option'><td class='cf7_highen_tabs_table_title_width'><label for='cf7_highen_tab'>Open In New Tab: </label></td>";
	$admin_table_output .= "<td class='cf7_highen_tabs_table_body_width'><input name='cf7_highen_tab' id='cf7_highen_tab' value='1' type='checkbox' $tab></td></tr>";
	
	// Link Form Page
	$admin_table_output .= "<tr class='cf7_highen_page cf7_highen_redirect_option' style='display:none;'><td><br /><h3>Link Form Item</h3></td></tr>";
	$admin_table_output .= "<tr class='cf7_highen_page cf7_highen_redirect_option'><td><b>Form Item:</b> </td>";
	$admin_table_output .= "<td><select name='cf7_highen_page' id='cf7_highen_page'>";
	$admin_table_output .= "<option value selected hidden>Select Page</option>";
	foreach ( get_pages() as $page ) {
		$admin_table_output .= "<option value='".get_page_link( $page->ID )."'";
		$admin_table_output .= ($cf7_highen_page==get_page_link( $page->ID ) )?"selected":'';
		$admin_table_output .= ">". $page->post_title ."</option>";
	}
	$admin_table_output .= "</select></td></tr>";
	
	$admin_table_output .= "<tr class='cf7_highen_page cf7_highen_redirect_option'><td class='cf7_highen_tabs_table_title_width'><label for='cf7_highen_page_tab'><b>Open In New Tab:</b> </label></td>";
	$admin_table_output .= "<td class='cf7_highen_tabs_table_body_width'><input name='cf7_highen_page_tab' id='cf7_highen_page_tab' value='1' type='checkbox' $page_tab></td></tr>";	
	
	$admin_table_output .= "<input type='hidden' name='cf7_highen_post' value='$post_id'>";
	$admin_table_output .= "</td></tr></table>";
	echo $admin_table_output;
}


// hook into contact form 7 admin form save
add_action('wpcf7_after_save', 'cf7_highen_save_contact_form');
function cf7_highen_save_contact_form( $cf7 ) {
    $post_id = sanitize_text_field($_POST['cf7_highen_post']);
    if (!empty($_POST['cf7_highen_enable'])) {
        $enable = sanitize_text_field($_POST['cf7_highen_enable']);
        update_post_meta($post_id, "_cf7_highen_enable", $enable);
    } else {
        update_post_meta($post_id, "_cf7_highen_enable", 0);
    }
    if (!empty($_POST['cf7_highen_tab'])) {
        $tab = sanitize_text_field($_POST['cf7_highen_tab']);
        update_post_meta($post_id, "_cf7_highen_tab", $tab);
    } else {
        update_post_meta($post_id, "_cf7_highen_tab", 0);
    }
	if (!empty($_POST['cf7_highen_page_tab'])) {
        $page_tab = sanitize_text_field($_POST['cf7_highen_page_tab']);
        update_post_meta($post_id, "_cf7_highen_page_tab", $page_tab);
    } else {
        update_post_meta($post_id, "_cf7_highen_page_tab", 0);
    }
    $cf7_highen_redirect_type = sanitize_text_field($_POST['cf7_highen_redirect_type']);
    update_post_meta($post_id, "_cf7_highen_redirect_type", $cf7_highen_redirect_type);
    
    $cf7_highen_redirect_type = sanitize_text_field($_POST['cf7_highen_redirect_type']);
    update_post_meta($post_id, "_cf7_highen_redirect_type", $cf7_highen_redirect_type);
    
    $cf7_highen_url = sanitize_text_field($_POST['cf7_highen_url']);
    update_post_meta($post_id, "_cf7_highen_url", $cf7_highen_url);
    
    $cf7_highen_page = sanitize_textarea_field($_POST['cf7_highen_page']);
    update_post_meta($post_id, "_cf7_highen_page", $cf7_highen_page);
}