<?php
add_action('admin_menu', 'push_notifications_settings_page');
function push_notifications_settings_page(){
    add_menu_page( 
        'Push Notifications Settings', // page <title>Title</title>
        'Push Notifications', // menu link text
        'manage_options', // capability to access the page
        'push_notifications_settings', // page URL slug
        'push_notifications_render_settings', // callback function /w content
        'dashicons-bell', // menu icon
        60
    );
}
function push_notifications_render_settings() {

if(isset($_REQUEST['message'])  && $_REQUEST['message'] == 'success'){ ?>
<div class="notice notice-success is-dismissible">
    <p><strong><?php echo __( 'Setting saved successfully.', 'mail-smtp-phpmailer' );?></strong></p>
</div>
<?php }

// Output the settings fields
settings_fields('push_notifications_settings');
do_settings_sections('push_notifications_settings'); ?>
<div class="wrap">
    <h1>Push Notifications Settings</h1>
    <form method="post" action="<?php echo the_permalink(); ?>">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><?php echo __('Enable','pnfwp'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" class="ui-toggle" id="gi_push_notification_enabled"
                                name="gi_push_notification_enabled" value="1"
                                <?php echo ((int) get_option('gi_push_notification_enabled') == 1) ? 'checked' : ''; ?>>
                            <label
                                for="gi_push_notification_enabled"><?php echo __('Enable Push Notification.','pnfwp'); ?></label>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php echo __('Firebase Configuration','pnfwp'); ?></th>
                    <td>
                        <label>
                            <textarea type="text" rows="8" name="gi_firebase_config_code"
                                class="form-control"><?php echo esc_attr(get_option('gi_firebase_config_code')); ?></textarea>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="action" value="push_notification_save_option">
        <?php submit_button(); ?>
    </form>
</div>
<?php
} 

// Update Form Data
add_action('init', 'update_push_notofication_form_data');
function update_push_notofication_form_data(){
   if( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'push_notification_save_option' ) {
      if (isset($_REQUEST['gi_push_notification_enabled'])) {
        update_option('gi_push_notification_enabled', sanitize_text_field($_REQUEST['gi_push_notification_enabled']));
      }else{
        update_option('gi_push_notification_enabled', '0');
      }
        update_option('gi_firebase_config_code', stripslashes($_REQUEST['gi_firebase_config_code']));
        wp_redirect( admin_url( '/admin.php?page=push_notifications_settings&message=success' ));
   }
}

// save device token in db via ajax
function save_device_token() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'users_device_token';
    $device_token = $_REQUEST['device_token'];

    $response = array();
    // Check if the value already exists in the table
    $value_exists = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE device_token = %s",
            $device_token
        )
    );
    if ($value_exists > 0) {
        // Value already exists, handle accordingly
        $response['status'] = false;
        $response['message'] = "Token is already exists";
    } else {
        // Value doesn't exist, proceed with inserting the data
        $inserted = $wpdb->insert( $table_name, array(
                'device_token' => $device_token, 
                'status' => 1,
            ),
            array( '%s', '%s' )
        );

        if ($inserted) {
            // Data inserted successfully
            $response['status'] = true;
            $response['message'] = "Token inserted successfully";
        } else {
            // Failed to insert data
            echo "Failed to insert data.";
            $response['status'] = false;
            $response['message'] = "Failed to insert token";
        }
    }
    echo json_encode($response);
    exit;
}
add_action( 'wp_ajax_save_device_token', 'save_device_token');
add_action( 'wp_ajax_nopriv_save_device_token', 'save_device_token' );