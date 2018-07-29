<?php

/**
 * uPortWordPress setup
 *
 * @package uPortWordPress
 * @since   0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main uPortWordPress Class.
 *
 * @class uPortWordPress
 */
class uPortWordPress {

	/**
	 * uPortWordPress version.
	 *
	 * @var string
	 */
	public $version = '0.1.0';

	/**
	 * The single instance of the class.
	 *
	 * @var uPortWordPress
	 * @since 0.1.0
	 */
	protected static $_instance = null;

  /**
   * Main uPortWordPress Instance.
   *
   * Ensures only one instance of uPortWordPress is loaded or can be loaded.
   *
   * @since 0.1.0
   * @static
   * @see UWP()
   * @return uPortWordPress - Main instance.
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Cloning is forbidden.
   *
   * @since 0.1.0
   */
  public function __clone() {
    uwp_doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.', 'uPortWordPress' ), '0.1.0' );
  }

  /**
   * Unserializing instances of this class is forbidden.
   *
   * @since 0.1.0
   */
  public function __wakeup() {
    uwp_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'uPortWordPress' ), '0.1.0' );
  }


    // qr-login derived table code, might change
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
  		// require_once( dirname( __FILE__ ) . '/admin/uport-admin.inc');
  		// JWT functions
  		require_once( dirname( __FILE__ ) . '/jwt/api.inc');
  		require_once( dirname( __FILE__ ) . '/jwt/auth.inc');
  		require_once( dirname( __FILE__ ) . '/jwt/headers.inc');
  		require_once( dirname( __FILE__ ) . '/jwt/jwt.inc');

  		JWT\API\setup();
  		JWT\Auth\setup();
  		JWT\Headers\setup();
  	}

    public function load_actions() {
  			// add_action( 'login_enqueue_scripts', array( $this, 'wp_uport_login_injectjs' ) );
  			add_action( 'login_enqueue_scripts', array( $this, 'wp_uport_init' ) );

  	}

  // for reference: here is the method to get user_id
  // $users = $wpdb->get_results( "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'first_name' AND meta_value = 'Misha'" );
  // TODO: enable multisite option
  // if ( is_multisite() ) {	$blogname = $GLOBALS['current_site']->site_name; } else {
  // $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
  // }
  	public function wp_uport_init() {
  		wp_register_script( 'web3', 'https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js', $in_footer = false );
  		wp_register_script( 'uport-connect', 'https://unpkg.com/uport-connect/dist/uport-connect.min.js', $in_footer = false );
  		wp_register_script( 'mnid', 'https://unpkg.com/mnid@0.1.1/lib/index.js', $in_footer = false );
  		// wp_register_script( 'uport', 'https://unpkg.com/uport/dist/uport.js', $in_footer = false );
  		wp_enqueue_script( 'wp_uport_js', plugins_url( '/js/login.js', __FILE__ ), array( 'web3', 'uport-connect', 'mnid' ), $in_footer = false );
  		wp_localize_script( 'wp_uport_js', 'wp_uport_config', array(
  			'appName'			=> wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ),
  			// 'appName'   => if ( is_multisite() ) {	$blogname = $GLOBALS['current_site']->site_name; } else {
  			// 									$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
  			// 									},
  			// 'appMNID' 	=> constant('UPORT_APP_MNID'), // plugin user/site admin will need to define UPORT_APP_MNID in wp-config.php
				'appclientId' => constant('UPORT_APP_CLIENTID'), // defined in wp-config.php
				'signkey'			=> constant('SIGNING_KEY'), // admin to garnish SIGNING_KEY from uPort appManager and define in wp-config.php
  			'ajaxurl'   	=> admin_url( 'admin-ajax.php' ),  // here as an example of the syntax
  			'homeurl'   	=> preg_replace("(^https?://)", "//", get_home_url( null, "", "https" ))
  		));
  	}

  }
