<?php

/**
 * The admin-specific functionality of the uPort plugin.
 *
 * @link       http://uport.me/
 * @since      1.0.0
 *
 * @package    uPort-Wordpress
 * @subpackage uPort/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    uPort
 * @subpackage uPort/admin
 * @author     uPort <support@uport.me>
 */
class uPortWordPress_Admin {

	/**
	 * The ID of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      0.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of the plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function uPortWordPress_menu() {
		// add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function = '' )
		add_options_page( 'uPortWordPress Plugin Options', 'uPortWP Options', 'read', 'uport_wordpress_menu', array(
			$this,
			'uPortWordPress_plugin_options'
		) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	// public function enqueue_styles() {
	//
	// 	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uport-admin.css', array(), $this->version, 'all' );
	//
	// }

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	// public function enqueue_scripts() {
	//
	// 	wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uport-admin.js', array( 'jquery' ), $this->version, false );
	//
	// }

}

new uPortWordPress_Admin();
