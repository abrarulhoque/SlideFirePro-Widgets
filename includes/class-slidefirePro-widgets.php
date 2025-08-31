<?php
namespace SlideFirePro_Widgets;

use Elementor\Widgets_Manager;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class SlideFirePro_Widgets {

	public function __construct() {
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_widget_assets' ] );
		
		// Register AJAX handlers
		add_action( 'wp_ajax_slidefirePro_filter_products', [ $this, 'ajax_filter_products' ] );
		add_action( 'wp_ajax_nopriv_slidefirePro_filter_products', [ $this, 'ajax_filter_products' ] );
	}

	/**
	 * Register widget assets (styles and scripts)
	 */
	public function register_widget_assets() {
		// Register category filter assets
		wp_register_style(
			'slidefirePro-category-filter',
			SLIDEFIREPRO_WIDGETS_URL . 'assets/css/category-filter.css',
			[],
			SLIDEFIREPRO_WIDGETS_VERSION
		);
		
		wp_register_script(
			'slidefirePro-category-filter',
			SLIDEFIREPRO_WIDGETS_URL . 'assets/js/category-filter.js',
			[ 'jquery', 'elementor-frontend' ],
			SLIDEFIREPRO_WIDGETS_VERSION,
			true
		);
		
		// Register WC product filter assets
		wp_register_style(
			'slidefirePro-wc-product-filter',
			SLIDEFIREPRO_WIDGETS_URL . 'assets/css/wc-product-filter.css',
			[],
			SLIDEFIREPRO_WIDGETS_VERSION
		);
		
		wp_register_script(
			'slidefirePro-wc-product-filter',
			SLIDEFIREPRO_WIDGETS_URL . 'assets/js/wc-product-filter.js',
			[ 'jquery', 'elementor-frontend' ],
			SLIDEFIREPRO_WIDGETS_VERSION,
			true
		);
		
		// Localize script for AJAX
		wp_localize_script( 'slidefirePro-category-filter', 'slideFireProAjax', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'slidefirePro_filter_nonce' )
		]);
		
		wp_localize_script( 'slidefirePro-wc-product-filter', 'slideFireProAjax', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'slidefirePro_filter_nonce' )
		]);
	}

	/**
	 * Register widgets with Elementor
	 */
	public function register_widgets( $widgets_manager ) {
		// Include the widget class files.
		require_once( __DIR__. '/widgets/class-category-filter-widget.php' );
		require_once( __DIR__. '/widgets/class-wc-product-filter-widget.php' );

		// Register the widget classes.
		$widgets_manager->register( new Widgets\Category_Filter_Widget() );
		$widgets_manager->register( new Widgets\WC_Product_Filter_Widget() );
	}

	/**
	 * AJAX handler for product filtering
	 */
	public function ajax_filter_products() {
		// Security check: verify the nonce.
		check_ajax_referer( 'slidefirePro_filter_nonce', 'nonce' );

		// Sanitize input
		$category_slug = isset( $_POST['category_slug'] ) ? sanitize_text_field( $_POST['category_slug'] ) : '';
		$widget_id = isset( $_POST['widget_id'] ) ? sanitize_text_field( $_POST['widget_id'] ) : '';

		// This will be used by the future product grid widget
		// For now, we'll just return success to confirm the filter is working
		wp_send_json_success( [
			'category_slug' => $category_slug,
			'widget_id' => $widget_id,
			'message' => 'Filter request received successfully'
		] );
	}
}

new SlideFirePro_Widgets();