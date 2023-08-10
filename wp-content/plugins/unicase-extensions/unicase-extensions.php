<?php
/**
 * Plugin Name:    	Unicase Extensions
 * Plugin URI:     	https://transvelo.github.io/unicase/
 * Description:    	This selection of extensions compliment our lean and mean theme for WooCommerce, Unicase. Please note: they don’t work with any WordPress theme, just Unicase.
 * Author:         	MadrasThemes
 * Author URL:     	https://madrasthemes.com/
 * Version:        	1.6.10
 * Text Domain: 	unicase-extensions
 * Domain Path: 	/languages
 * WC tested up to: 4.5.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Unicase_Extensions' ) ) {
	/**
	 * Main Unicase_Extensions Class
	 *
	 * @class Unicase_Extensions
	 * @version	1.0.0
	 * @since 1.0.0
	 * @package	Kudos
	 * @author Ibrahim
	 */
	final class Unicase_Extensions {
		/**
		 * Unicase_Extensions The single instance of Unicase_Extensions.
		 * @var 	object
		 * @access  private
		 * @since 	1.0.0
		 */
		private static $_instance = null;

		/**
		 * The token.
		 * @var     string
		 * @access  public
		 * @since   1.0.0
		 */
		public $token;

		/**
		 * The version number.
		 * @var     string
		 * @access  public
		 * @since   1.0.0
		 */
		public $version;

		/**
		 * Constructor function.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function __construct () {

			$this->token 	= 'unicase-extensions';
			$this->version 	= '0.0.1';

			add_action( 'plugins_loaded', array( $this, 'setup_constants' ),		10 );
			add_action( 'plugins_loaded', array( $this, 'includes' ),				20 );
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ),	30 );
		}

		/**
		 * Main Unicase_Extensions Instance
		 *
		 * Ensures only one instance of Unicase_Extensions is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 * @see Unicase_Extensions()
		 * @return Main Kudos instance
		 */
		public static function instance () {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function setup_constants() {

			// Plugin Folder Path
			if ( ! defined( 'UNICASE_EXTENSIONS_DIR' ) ) {
				define( 'UNICASE_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'UNICASE_EXTENSIONS_URL' ) ) {
				define( 'UNICASE_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'UNICASE_EXTENSIONS_FILE' ) ) {
				define( 'UNICASE_EXTENSIONS_FILE', __FILE__ );
			}

			// Modules File
			if ( ! defined( 'UNICASE_MODULES_DIR' ) ) {
				define( 'UNICASE_MODULES_DIR', UNICASE_EXTENSIONS_DIR . '/modules' );
			}
		}

		/**
		 * Include required files
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function includes() {

			#-----------------------------------------------------------------
			# Static Block Post Type
			#-----------------------------------------------------------------
			require_once UNICASE_MODULES_DIR . '/post-types/static-block.php';

			#-----------------------------------------------------------------
			# Visual Composer Extensions
			#-----------------------------------------------------------------
			require_once UNICASE_MODULES_DIR . '/js_composer/js_composer.php';

			#-----------------------------------------------------------------
			# Theme Shortcodes
			#-----------------------------------------------------------------
			require_once UNICASE_MODULES_DIR . '/theme-shortcodes/theme-shortcodes.php';

			#-----------------------------------------------------------------
			# Product Taxonomies
			#-----------------------------------------------------------------
			require_once UNICASE_MODULES_DIR . '/product-taxonomies/class-uc-product-taxonomies.php';
		}

		/**
		 * Load the localisation file.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'unicase-extensions', false, dirname( plugin_basename( UNICASE_EXTENSIONS_FILE ) ) . '/languages/' );
		}

		/**
		 * Cloning is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __clone () {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'unicase-extensions' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __wakeup () {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'unicase-extensions' ), '1.0.0' );
		}
	}
}

/**
 * Returns the main instance of Unicase_Extensions to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Unicase_Extensions
 */
function Unicase_Extensions() {
	return Unicase_Extensions::instance();
}

/**
 * Initialise the plugin
 */
Unicase_Extensions();
