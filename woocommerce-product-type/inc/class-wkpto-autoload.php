<?php
/**
 * Dynamically loads classes.
 *
 * @package WooCommerce Product Type
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKPTO_Autoload' ) ) {

	/**
	 * WKPTO_Autoload class
	 */
	class WKPTO_Autoload {

		/**
		 * Instance variable
		 *
		 * @var $instance
		 */
		protected static $instance = null;

		/**
		 * KOCH_Autoload constructor.
		 */
		public function __construct() {
			if ( function_exists( '__autoload' ) ) {
				spl_autoload_register( '__autoload' );
			}
			spl_autoload_register( array( $this, 'wkpto_class_autoload' ) );
		}

		/**
		 * Autoload callback
		 *
		 * @param string $class_name The name of the class to load.
		 */
		public function wkpto_class_autoload( $class_name ) {

			if ( false === strpos( $class_name, 'WKPTO' ) ) {
				return;
			}
			$current_file = strtolower( $class_name );
			$current_file = str_ireplace( '_', '-', $current_file );
			$file_name    = "class-{$current_file}.php";
			$filepath     = trailingslashit( dirname( dirname( __FILE__ ) ) );
			$file_exists  = false;

			$all_paths = array(
				'helper',
				'inc',
				'includes',
				'includes/admin',
			);

			foreach ( $all_paths as $path ) {

				$file_path = $filepath . $path . '/' . $file_name;
				if ( file_exists( $file_path ) ) {
					require_once $file_path;
					$file_exists = true;
					break;
				}
			}
			// If the file exists in the specified path, then include it.
			if ( ! $file_exists ) {
				wp_die(
					sprintf( /* Translators: %d: product filepath. */ esc_html__( 'The file attempting to be loaded at %s does not exist.', 'wk-pto' ), esc_html( $file_path ) )
				);
			}
		}

		/**
		 * This is a singleton page, access the single instance just using this method.
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! static::$instance ) {
				static::$instance = new self();
			}

			return static::$instance;
		}
	}
	WKPTO_Autoload::get_instance();
}
