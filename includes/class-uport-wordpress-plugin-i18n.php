<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/raininja
 * @since      1.0.0
 *
 * @package    Uport_Wordpress_Plugin
 * @subpackage Uport_Wordpress_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Uport_Wordpress_Plugin
 * @subpackage Uport_Wordpress_Plugin/includes
 * @author     Dan Denkijin <dandenkijin@gmail.com>
 */
class Uport_Wordpress_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'uport-wordpress-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
