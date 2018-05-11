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
 * @since             0.0.1
 * @package           Uport_Wordpress_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Uport WordPress Plugin
 * Plugin URI:        https://github.com/uport-project/uport-wordpress-plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.0.1
 * Author:            Dan Denkijin
 * Author URI:        https://github.com/raininja
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uport-wordpress-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// TODO: create randomID code

// TODO:

$NoPasswords = New NoPasswords();

class NoPasswords {
	private $version;
	private $tbl_name;

	/**
	 * Contruct - sets up plugin and dependencies
	 *
	 */
	public function __construct() {
		$this->version  = get_option( "wp_uport_plugin_db_version", "0.0.1" );
		$this->tbl_name = "uport";
		if ( "0.0.1" != $this->version ) {
			$this->wpuportDB_install();
		}

		$this->load_dependencies();
		$this->load_actions();
	}


	/**
	 * Package dependencies
	 * need to add uport-connect stuff here
	 */
	private function load_dependencies() {
		require_once( dirname( __FILE__ ) . '/libs/TimeOTP.inc' ); // replace with random-js
		require_once( dirname( __FILE__ ) . '/libs/phpqrcode.inc' );
	}
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '0.0.1' );

// TODO: Generate WP REST endpoints for chasqui, infura, login stages
add_action( 'rest_api_init', function () {
  register_rest_route( 'wp-uport/v1', '/topic/{topicID}'), array(
    'methods' => 'GET',
    'callback' => 'wp_uport_msg',
	),
	register_rest_route( 'wp-uport/v1',  'topic/'), array(
		'methods' => 'POST',
		'callback' => 'wp_uport_msg_send',
	)
});

public function wp_qr_code_login_head() {
	// only the login action should get the qr code
	if ( isset( $_GET['action'] ) && ( $_GET['action'] == 'lostpassword' || $_GET['action'] == 'register' ) ) {
		return;
	}

	if ( $qrHash = $this->generateHash() ) {
		// Enqueue script that creates and places QR-code on login page
		wp_enqueue_script( 'qrLogin_js', plugins_url( '/js/qrLogin.js', __FILE__ ), array( 'jquery' ) );
		// Here we need to createid
		wp_enqueue_script( $handle, $src = false, $deps = array(), $ver = false, $in_footer = false )
		// here is the process to expose these values to js;  wp_localize_script( $handle, $name, $data )
		wp_localize_script( 'qrLogin_js', 'qrLoginAjaxRequest', array(
				'ajaxurl'      => admin_url( 'admin-ajax.php' ),
				'homeurl'      => preg_replace("(^https?://)", "//", get_home_url( null, "", "https" )),
				'qrLoginNonce' => wp_create_nonce( 'qrLogin-nonce' ),
				'qrHash'       => $this->generateHash(),
				'reloadNonce'  => wp_create_nonce( 'reload-nonce' )
			)
		);
	}

}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-uport-wordpress-plugin-activator.php
 */
function activate_uport_wordpress_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uport-wordpress-plugin-activator.php';
	Uport_Wordpress_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-uport-wordpress-plugin-deactivator.php
 */
function deactivate_uport_wordpress_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uport-wordpress-plugin-deactivator.php';
	Uport_Wordpress_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_uport_wordpress_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_uport_wordpress_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-uport-wordpress-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_uport_wordpress_plugin() {

	$plugin = new Uport_Wordpress_Plugin();
	$plugin->run();

}
run_uport_wordpress_plugin();
