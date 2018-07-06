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

// this code is derivative of wp-qr-login-plugin
// also contains code from jwt-wp-auth

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$uPortWordPress = New uPortWordPress();

class uPortWordPress {
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

		$this->load_dependencies();
		$this->load_actions();
	}

	private function load_dependencies() {
		require_once( dirname( __FILE__ ) . '/includes/api.inc');
		require_once( dirname( __FILE__ ) . '/includes/auth.inc');
		require_once( dirname( __FILE__ ) . '/includes/headers.inc');
		require_once( dirname( __FILE__ ) . '/includes/jwt.inc');

		JWT\API\setup();
		JWT\Auth\setup();
		JWT\Headers\setup();
	}

  	public function load_actions() {
			// add_action( 'login_enqueue_scripts', array( $this, 'wp_uport_login_injectjs' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'wp_uport_init' ) );

	// for reference: here is the method to get user_id
// $users = $wpdb->get_results( "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'first_name' AND meta_value = 'Misha'" );
// TODO: enable multisite option
// if ( is_multisite() ) {	$blogname = $GLOBALS['current_site']->site_name; } else {
// $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
// }
	public function wp_uport_init() {
		wp_register_script( 'web3', 'https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js', $in_footer = false );
		wp_register_script( 'uport-connect', 'https://unpkg.com/uport-connect/dist/uport-connect.min.js', $in_footer = false );
		wp_enqueue_script( 'wp_uport_js', plugins_url( '/js/login.js', __FILE__ ), array( 'web3', 'uport-connect' ), $in_footer = false );
		wp_localize_script( 'wp_uport_js', 'wp_uport_config', array(
			'appName'		=> wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ),
			'appMNID' 	=> constant('UPORT_APP_MNID'), // plugin user/site admin will need to define UPORT_APP_MNID in wp-config.php
			'signkey'		=> constant('SIGNING_KEY'), // admin to garnish SIGNING_KEY from uPort appManager and define in wp-config.php
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),  // here as an example of the syntax
			'homeurl'   => preg_replace("(^https?://)", "//", get_home_url( null, "", "https" ))
		));
	}

}
