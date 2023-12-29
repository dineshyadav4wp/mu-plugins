<?php
/**
 * Plugin Name:  WooCommerce Product Type
 * Plugin URI:   https://codecanyon.net/item/woocommerce-product-type-option-communication/30623663
 * Description:  Using this module a 'Type' column will be attached with WooCommerce table along with Screen Option
 * Version:      1.0.0
 * Author:       Webkul
 * Author URI:   https://webkul.com/
 * Text Domain:  wk-pto
 * Domain Path:  /languages
 * Requires at least: 5.0
 * Requires PHP: 7.3
 * WooCommerce requires at least: 5.0
 * License:      For more info see license.txt included with plugin
 * License URI:  https://store.webkul.com/license.html.
 *
 * Requires Plugins: WooCommerce
 *
 * @package WooCommerce Product Type Option
 */

defined( 'ABSPATH' ) || exit();

// Define Constants.
defined( 'WKPTO_PLUGIN_FILE' ) || define( 'WKPTO_PLUGIN_FILE', plugin_dir_path( __FILE__ ) );
defined( 'WKPTO_PLUGIN_URL' ) || define( 'WKPTO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
defined( 'WKPTO_SCRIPT_VERSION' ) || define( 'WKPTO_SCRIPT_VERSION', '1.0.0' );

require_once WKPTO_PLUGIN_FILE . 'inc/class-wkpto-autoload.php';
if ( ! class_exists( 'WKPTO', false ) ) {
	include_once WKPTO_PLUGIN_FILE . '/includes/class-wkpto.php';
	WKPTO::get_instance();
}

