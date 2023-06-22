=== Push Notification FCM ===
Contributors: ivijanstefan, creativform
Tags: Firebase Cloud Messaging, FCM, push notifications, Android, iOS, integration, REST API, device registration
Requires at least: 5.0
Tested up to: 6.2
Requires PHP: 7.0
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.buymeacoffee.com/ivijanstefan

Simple FCM plugin for push notifications on Android & iOS devices. Easy integration, REST API endpoints for device registration & more!

== Description ==

Introducing you a simple and easy-to-use framework plugin for Firebase Cloud Messaging (FCM) primarily intended for Android and iOS developers, that allows you to send push notifications to all Android and iOS devices worldwide. With our plugin, integration and use are a breeze.

Simply install the plugin, enter your Firebase Server (API) key in the settings, generate a site key, and select the types of posts for which you want to send notifications. 

Our plugin also includes REST API endpoints, which are used to register and deregister devices with your site when the mobile application is launched or deleted. Once a device is registered, it will receive notifications every time a new article or page is published in the selected post types. Don't miss out on important updates, try our FCM plugin today!

= REST API Endpoints =

In order to send push notifications to a device, the device's unique identification (ID) and token need to be recorded in the site's database. To accomplish this, the plugin provides two REST API endpoints: one for subscribing a device when the mobile application is installed or launched, and another for unsubscribing a device when the application is deleted. These endpoints allow the site to keep track of which devices are registered to receive notifications and which are not.

**Subscribe device:**

`https://example.domain/wp-json/fcm/pn/subscribe`

**Parameters:**

* `rest_api_key` (required) - Unique generated site key provided by the plugin
* `device_uuid` (required)
* `device_token` (required)
* `subscription` (required) - This would be the some category name in which the device is registered, if there is no category exists in WordPress it’ll be created automatically.
* `device_name` (optional)
* `os_version` (optional)

**Returns JSON:**
`
{
	"error": false,
	"message": "Device token registered",
	"subscription_id": 123
}
`

**Unsubscribe device:**

`https://example.domain/wp-json/fcm/pn/unsubscribe`

**Parameters:**

* `rest_api_key` (required) - Unique generated site key provided by the plugin
* `device_uuid` (required)

**Returns JSON:**
`
{
	"error": false,
	"message": "The device token was successfully removed"
}
`

This plugin is a free and open-source software, which means that it can be used in any WordPress installation without any cost and can be modified as per the requirement.

== Screenshots ==

1. General plugin settings
2. All registered devices
3. Settings within the article for push notifications
4. WP-JSON REST API format for Subscribe
5. WP-JSON REST API format for Unsubscribe
6. Test and Compatibility

== Changelog ==

= 1.0.0 =
* First stabile version

= 1.0.1 =
* Improved REST API
* Improved UX
* Improved documentation

= 1.0.2 =
* Improved plugin security
* Improved plugin cache

== Upgrade Notice ==

= 1.0.2 =
* Improved plugin security
* Improved plugin cache

== Other Notes ==

- Before using the plugin, make sure that you have a Firebase project set up and that you have your Firebase Server (API) key.

- The plugin requires a unique generated site key, which can be obtained by accessing the plugin settings page after installation.

- The plugin allows you to select the types of posts for which you want to send notifications, so you can choose to only send notifications for certain types of content.

- The plugin uses REST API endpoints to register and deregister devices, so it is important that your mobile application is able to communicate with these endpoints.

- The plugin is compatible with both Android and iOS devices.

- The plugin provides a way to send push notifications to all the devices that are registered for the particular category of the post.

- Before sending the push notifications to the device, the plugin checks if the device is still registered or not.

- The plugin is compatible with the latest version of WordPress, however, make sure to check the version compatibility before installing the plugin.

- The plugin can be customized as per requirement, since it is open-source software.

== Installation ==

To install the "Push Notification FCM" plugin via the WordPress admin dashboard, please follow these steps:

* Log in to your WordPress site as an administrator.
* Navigate to the "Plugins" section in the WordPress dashboard.
* Click on the "Add New" button.
* In the search bar, type "Push Notification FCM"
* Click on the "Install" button next to the plugin.
* Once installation is complete, click on the "Activate" button.
* Once activated, navigate to the "Push Notification FCM" settings page and enter your Firebase Server (API) keys, generate a site key, and select the types of posts for which you want to send notifications.
* Insert the generated REST endpoints of your site in your mobile application.
* Now you can start sending push notifications to your subscribed devices.

Note: Make sure that the plugin is compatible with your version of WordPress.

== Frequently Asked Questions ==

= What is the "Push Notification FCM" plugin? =

The "Push Notification FCM" plugin is a simple and easy-to-use plugin for WordPress that allows you to send push notifications to all Android and iOS devices worldwide, using the Firebase Cloud Messaging (FCM) system.

= How do I install the plugin? =

To install the plugin, you can either download it from the WordPress plugin repository or upload it to your WordPress site via the "Plugins" section in the WordPress dashboard. Once installed, you will need to activate the plugin and enter your Firebase Server (API) key, generate a site key, and select the types of posts for which you want to send notifications.

= What are the REST API endpoints provided by the plugin? =

The plugin provides two REST API endpoints: one for subscribing a device when the mobile application is installed or launched, and another for unsubscribing a device when the application is deleted. These endpoints allow the site to keep track of which devices are registered to receive notifications and which are not.

= Is this plugin free to use? =

Yes, the plugin is a free and open-source software, which means that it can be used in any WordPress installation without any cost and can be modified as per the requirement.

= How do I subscribe or unsubscribe devices for push notifications? =

You can subscribe or unsubscribe devices for push notifications using the REST API endpoints provided by the plugin. The endpoints require specific parameters, such as the device's unique identification (ID) and token, as well as a unique generated site key provided by the plugin.