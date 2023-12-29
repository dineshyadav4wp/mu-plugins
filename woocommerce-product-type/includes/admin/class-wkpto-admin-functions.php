<?php
/**
 * Admin Functions
 *
 * @package WooCommerce Product Type
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WKPTO_Admin_Functions' ) ) {

	/**
	 * Admin Functions  class
	 */
	class WKPTO_Admin_Functions {

		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.0
		 */
		protected static $instance = null;

		/**
		 * Adding a new column name 'Type'.
		 *
		 * @param array $columns Product table columns.
		 *
		 * @return array
		 */
		public function wkpto_add_custom_column_type( $columns ) {
			$columns['type'] = esc_html__( 'Type', 'wk-pto' );
			return $columns;
		}

		/**
		 * Content for Column type.
		 *
		 * @param string $column Column Type.
		 * @param int    $product_id Column Type ID.
		 * @return void
		 */
		public function wkpto_add_custom_column_content( $column, $product_id ) {
			if ( 'type' === $column ) {
				$product = wc_get_product( $product_id );
				echo $product->get_type();
			}
		}

		/**
		 * Css for column type.
		 *
		 * @return void
		 */
		public function wkpto_adjust_column_width() {
			echo '<style>.column-type { width: 10%; }</style>';
		}



		/**
		 * Enabling sorting for column type.
		 *
		 * @param array $columns Product table columns.
		 *
		 * @return array
		 */
		public function wkpto_enable_column_sorting( $columns ) {
			$columns['type'] = 'type';
			return $columns;
		}


		/**
		 * Class WKPTO_Admin_Functions Instance.
		 *
		 * Ensures only one instance of Class WKPTO_Admin_Functions is loaded or can be loaded.
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
