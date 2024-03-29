<?php
/**
 * Plugin Name:       Filter WC Orders
 * Plugin URI:        https://dineshinaublog.wordpress.com/filter-wc-orders/
 * Description:       It helps in sorting woocommerce orders based on a payment gateway.
 * Version:           1.0.3
 * Author:            Dinesh Yadav
 * Author URI:        https://dineshinaublog.wordpress.com
 * Text Domain:       filter-wc-orders
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP:      7.4
 *
 * @package filter-wc-orders
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'DKFWCO_Core' ) ) {
	/**
	 * Core class of the plugin.
	 *
	 * Class DKFWCO_Core
	 */
	class DKFWCO_Core {
		/**
		 * Instance variable of this class.
		 *
		 * @var DKFWCO_Core
		 */
		public static $instance = null;

		/**
		 * DKFWCO_Core constructor.
		 */
		public function __construct() {
			/**
			 * Load important variables and constants.
			 */
			$this->define_plugin_properties();

			/**
			 * Initiates and load hooks.
			 */
			$this->load_hooks();
		}

		/**
		 * Defining constants.
		 */
		public function define_plugin_properties() {
			define( 'DKFWCO_VERSION', '1.0.3' );
			define( 'DKFWCO_PLUGIN_FILE', __FILE__ );
			define( 'DKFWCO_PLUGIN_DIR', __DIR__ );
			define( 'DKFWCO_PLUGIN_SLUG', 'filter-wc-orders' );
			add_action( 'plugins_loaded', array( $this, 'load_wp_dependent_properties' ), 1 );
		}

		/**
		 * Defining WP dependent properties.
		 */
		public function load_wp_dependent_properties() {
			define( 'DKFWCO_PLUGIN_URL', untrailingslashit( plugin_dir_url( DKFWCO_PLUGIN_FILE ) ) );
			define( 'DKFWCO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		}

		/**
		 * Loading hooks.
		 */
		public function load_hooks() {
			/**
			 * Initialize Localization.
			 */
			add_action( 'init', array( $this, 'localization' ) );
			add_action( 'plugins_loaded', array( $this, 'load_classes' ), 1 );
		}

		/**
		 * Localizing the plugin text strings.
		 */
		public function localization() {
			load_plugin_textdomain( 'filter-wc-orders', false, __DIR__ . '/languages/' );
		}

		/**
		 * Loading plugin classes.
		 */
		public function load_classes() {
			/**
			 * Loads the Admin file.
			 */
			require __DIR__ . '/filter-wc-orders/admin/class-dkfwco-admin.php';
			DKFWCO_Admin::get_instance();
		}

		/**
		 * Function to provide instance of this class.
		 *
		 * @return DKFWCO_Core|null
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}
	DKFWCO_Core::get_instance();
}
