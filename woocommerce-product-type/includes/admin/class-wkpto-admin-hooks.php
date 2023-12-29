<?php
/**
 * Admin Hooks
 *
 * @package WooCommerce Product Type
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WKPTO_Admin_Hooks' ) ) {

	/**
	 * Admin Hooks  class
	 */
	class WKPTO_Admin_Hooks {
		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.0
		 */
		protected static $instance = null;

		/**
		 * Admin Hooks constructor
		 */
		public function __construct() {

			$function_handler = WKPTO_Admin_Functions::get_instance();

			add_filter( 'manage_edit-product_columns', array( $function_handler, 'wkpto_add_custom_column_type' ), 9999 );
			add_action( 'manage_product_posts_custom_column', array( $function_handler, 'wkpto_add_custom_column_content' ), 10, 2 );
			add_action( 'admin_head', array( $function_handler, 'wkpto_adjust_column_width' ) );
			add_filter( 'manage_edit-product_sortable_columns', array( $function_handler, 'wkpto_enable_column_sorting' ) );

		}

		/**
		 * Class WKPTO_Admin_Hooks Instance.
		 *
		 * Ensures only one instance of Class WKPTO_Admin_Hooks is loaded or can be loaded.
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
