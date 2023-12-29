<?php
/**
 * Main Class
 *
 * @package WooCommerce Product Type
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKPTO' ) ) {

	/**
	 * WKPTO Main Class
	 */
	final class WKPTO {

		/**
		 * Instance variable
		 *
		 * @var $instance
		 */
		protected static $instance = null;

		/**
		 * WKPTO Constructor.
		 */
		public function __construct() {
			$this->wkpto_define_constants();
			$this->wkpto_init_hooks();
		}

		/**
		 * Defining plugin's constant.
		 *
		 * @return void
		 */
		public function wkpto_define_constants() {
			defined( 'WKPTO_PLUGIN_URL' ) || define( 'WKPTO_PLUGIN_URL', plugin_dir_url( dirname( __FILE__ ) ) );
			defined( 'WKPTO_VERSION' ) || define( 'WKPTO_VERSION', '1.0.0' );
			defined( 'WKPTO_SCRIPT_VERSION' ) || define( 'WKPTO_SCRIPT_VERSION', '1.0.0' );
			$path = WP_CONTENT_DIR . '/uploads/wkpto_uploads/';
			if ( ! file_exists( $path ) ) {
				$directory = WP_CONTENT_DIR . '/uploads/wkpto_uploads';
				wp_mkdir_p( $directory );
				defined( 'WKPTO_UPLOADS_PATH' ) || define( 'WKPTO_UPLOADS_PATH', $path );
			} else {
				defined( 'WKPTO_UPLOADS_PATH' ) || define( 'WKPTO_UPLOADS_PATH', $path );
			}
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 */
		private function wkpto_init_hooks() {
			add_action( 'init', array( $this, 'wkpto_load_plugin_textdomain' ) );
			add_action( 'plugins_loaded', array( $this, 'wkpto_load_plugin' ) );
		}

		/**
		 * Load plugin text domain.
		 */
		public function wkpto_load_plugin_textdomain() {
			load_plugin_textdomain( 'wk-pto', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Load WooCommerce Product Type Option plugin.
		 *
		 * @return void
		 */
		public function wkpto_load_plugin() {
			if ( $this->wkpto_dependency_satisfied() ) {
				WKPTO_File_Handler::get_instance();
			} else {
				add_action( 'admin_notices', array( $this, 'wkpto_show_wc_not_installed_notice' ) );
			}
		}

		/**
		 * Check if WooCommerce are installed and activated.
		 *
		 * @return bool
		 */
		public function wkpto_dependency_satisfied() {
			if ( ! function_exists( 'WC' ) || ! defined( 'WC_VERSION' ) ) {
				return false;
			}

			return true;
		}

		/**
		 * Cloning is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __clone() {
			wp_die( __FUNCTION__ . esc_html__( 'Cloning is forbidden.', 'wk-pto' ) );
		}

		/**
		 * Show wc not installed notice.
		 *
		 * @return void
		 */
		public function wkpto_show_wc_not_installed_notice() {
			?>
			<div class="error">
				<p>
					<?php
					echo sprintf(
						/* translators: %s wkpto links */
						esc_html__( 'WooCommerce Product Type Option is enabled but not effective. It requires the last version of %s to work!', 'wk-pto' ),
						'<a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '" target="_blank">' . esc_html__( 'WooCommerce', 'wk-pto' ) . '</a>'
					);
					?>
				</p>
			</div>
			<?php
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
}
