<?php
/**
 * File Handler
 *
 * @package WooCommerce Product Type
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'WKPTO_File_Handler' ) ) {

	/**
	 * File handler class
	 */
	final class WKPTO_File_Handler {

		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.0
		 */
		protected static $instance = null;

		/**
		 * File handler constructor
		 */
		public function __construct() {
			WKPTO_Admin_Hooks::get_instance();
		}

		/**
		 * Main WKPTO_File_Handler Instance.
		 *
		 * Ensures only one instance of WKPTO_File_Handler is loaded or can be loaded.
		 *
		 * @return Main instance.
		 * @since 1.0.0
		 * @static
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
	}
}
