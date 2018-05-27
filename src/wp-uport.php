<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/raininja
 * @since             0.1.0
 * @package           Uport_Wordpress_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Uport WordPress Plugin
 * Plugin URI:        https://github.com/uport-project/uport-wordpress-plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.1.0
 * Author:            Dan Denkijin
 * Author URI:        https://github.com/raininja
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uport-wordpress-plugin
 * Domain Path:       /languages
 */

// this code is derivative of wp-qr-login-plugin

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$NoPasswords = New NoPasswords();

class NoPasswords {
	private $version;
	private $tbl_name;

	/**
	 * Contruct - sets up plugin and dependencies
	 *
	 */
	public function __construct() {
		$this->version  = get_option( "wp_uport_plugin_db_version", "0.1.0" );
		$this->tbl_name = "uport";
		if ( "0.1.0" != $this->version ) {
			$this->wpuportDB_install();
		}

		// $this->load_dependencies();
		$this->load_actions();
	}

	// private function load_dependencies() {

	// }

  	public function load_actions() {
			add_action( 'login_enqueue_scripts', array( $this, 'wp_uport_login' ) );
	}

	public function wp_uport_login() {
		// wp_register_script( 'web3', plugins_url( '/libs/web3.js', __FILE__ ), $in_footer = false );
		// wp_register_script( 'uport-connect', plugins_url( '/libs/uport-connect.js', __FILE__ ), $in_footer = false );
		wp_register_script( 'web3', 'https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js', $in_footer = false );
		wp_register_script( 'uport-connect', 'https://unpkg.com/uport-connect/dist/uport-connect.min.js', $in_footer = false );
		wp_enqueue_script( 'wp-uport_js', plugins_url( '/js/login_may25b.js', __FILE__ ), array( 'web3', 'uport-connect' ), false, false );
		// wp_enqueue_script( 'wp-uport_js', plugins_url( '/js/wp_uport.js', __FILE__ ) );
		// wp_enqueue_script( $handle, $src = false, $deps = array(), $ver = false, $in_footer = false )
	}


}
