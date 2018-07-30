<?php

/**
 *
 * @link              https://github.com/raininja
 * @since             0.1.0
 * @package           Uport_Wordpress_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Uport WordPress Plugin
 * Plugin URI:        https://github.com/uport-project/uport-wordpress-plugin
 * Description:       This plugin is a bridge between WordPress and your decentralized world, through the uPort ecosystem.
 * Version:           0.1.0
 * Author:            Dan Denkijin
 * Author URI:        https://github.com/raininja
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uport-wordpress-plugin
 */

 namespace UportWP;

// this code is derivative of wp-qr-login-plugin
// also contains code from jwt-wp-auth


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Include the main uPortWordPress class.
if ( ! class_exists( '\UportWP\Main\uPortWordPress' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-uportwordpress.php';
}

/**
 * Main instance of uPortWordPress.
 *
 * Returns the main instance of UWP to prevent the need to use globals.
 *
 * @since  0.1.0
 * @return uPortWordPress
 */
function UWP() {
	return \UportWP\Main\uPortWordPress::instance();
}

// Global for backwards compatibility.
$GLOBALS['uportwordpress'] = UWP();
