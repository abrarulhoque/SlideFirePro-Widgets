<?php
/**
 * Plugin Name:       SlideFirePro Widgets
 * Plugin URI:        https://abrarulhoque.com/
 * Description:       A collection of custom Elementor widgets for SlideFirePro, including WooCommerce category filters and product grids.
 * Version:           1.31.0
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author:            Abrar
 * Author URI:        https://abrarulhoque.com/
 * Text Domain:       slidefirePro-widgets
 * Domain Path:       /languages
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'SLIDEFIREPRO_WIDGETS_VERSION', '1.30.0' );
define( 'SLIDEFIREPRO_WIDGETS_FILE', __FILE__ );
define( 'SLIDEFIREPRO_WIDGETS_PATH', plugin_dir_path( __FILE__ ) );
define( 'SLIDEFIREPRO_WIDGETS_URL', plugin_dir_url( __FILE__ ) );

final class SlideFirePro_Widgets_Core {

    const VERSION = '1.30.0';

	public function __construct() {
		// Load our main plugin class after all plugins are loaded.
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// Check if Elementor is installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, '3.20.0', '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, '8.1', '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Load the core plugin file.
		require_once( __DIR__. '/includes/class-slidefirePro-widgets.php' );
	}

	/**
	 * Admin notice - Missing main plugin.
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'slidefirePro-widgets' ),
			'<strong>' . esc_html__( 'SlideFirePro Widgets', 'slidefirePro-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'slidefirePro-widgets' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice - Minimum Elementor version.
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'slidefirePro-widgets' ),
			'<strong>' . esc_html__( 'SlideFirePro Widgets', 'slidefirePro-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'slidefirePro-widgets' ) . '</strong>',
			'3.20.0'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice - Minimum PHP version.
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'slidefirePro-widgets' ),
			'<strong>' . esc_html__( 'SlideFirePro Widgets', 'slidefirePro-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'slidefirePro-widgets' ) . '</strong>',
			'8.1'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

}

new SlideFirePro_Widgets_Core();
