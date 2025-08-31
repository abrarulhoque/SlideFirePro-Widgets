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
		add_action( 'wp_ajax_slidefirePro_load_more_products', [ $this, 'ajax_load_more_products' ] );
		add_action( 'wp_ajax_nopriv_slidefirePro_load_more_products', [ $this, 'ajax_load_more_products' ] );
		add_action( 'wp_ajax_slidefirePro_add_to_cart', [ $this, 'ajax_add_to_cart' ] );
		add_action( 'wp_ajax_nopriv_slidefirePro_add_to_cart', [ $this, 'ajax_add_to_cart' ] );
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
		
		// Register WC products assets
		wp_register_style(
			'slidefirePro-wc-products',
			SLIDEFIREPRO_WIDGETS_URL . 'assets/css/wc-products.css',
			[],
			SLIDEFIREPRO_WIDGETS_VERSION
		);
		
		wp_register_script(
			'slidefirePro-wc-products',
			SLIDEFIREPRO_WIDGETS_URL . 'assets/js/wc-products.js',
			[ 'jquery', 'elementor-frontend' ],
			SLIDEFIREPRO_WIDGETS_VERSION,
			true
		);
		
		// Localize script for AJAX
		$ajax_data = [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'slidefirePro_filter_nonce' )
		];
		
		wp_localize_script( 'slidefirePro-category-filter', 'slideFireProAjax', $ajax_data );
		wp_localize_script( 'slidefirePro-wc-product-filter', 'slideFireProAjax', $ajax_data );
		wp_localize_script( 'slidefirePro-wc-products', 'slideFireProAjax', $ajax_data );
	}

	/**
	 * Register widgets with Elementor
	 */
	public function register_widgets( $widgets_manager ) {
		// Include the widget class files.
		require_once( __DIR__. '/widgets/class-category-filter-widget.php' );
		require_once( __DIR__. '/widgets/class-wc-product-filter-widget.php' );
		require_once( __DIR__. '/widgets/class-wc-products-widget.php' );

		// Register the widget classes.
		$widgets_manager->register( new Widgets\Category_Filter_Widget() );
		$widgets_manager->register( new Widgets\WC_Product_Filter_Widget() );
		$widgets_manager->register( new Widgets\WC_Products_Widget() );
	}

	/**
	 * AJAX handler for product filtering
	 */
	public function ajax_filter_products() {
		// Security check: verify the nonce.
		check_ajax_referer( 'slidefirePro_filter_nonce', 'nonce' );

		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( [ 'message' => 'WooCommerce is not active' ] );
		}

		// Sanitize input
		$filters = isset( $_POST['filters'] ) ? $_POST['filters'] : [];
		$settings = isset( $_POST['settings'] ) ? $_POST['settings'] : [];
		$widget_id = isset( $_POST['widget_id'] ) ? sanitize_text_field( $_POST['widget_id'] ) : '';

		// Build query args
		$query_args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => isset( $settings['products_per_page'] ) ? intval( $settings['products_per_page'] ) : 12,
			'meta_query' => [
				[
					'key' => '_visibility',
					'value' => [ 'catalog', 'visible' ],
					'compare' => 'IN',
				],
			],
		];

		// Apply filters
		if ( ! empty( $filters['category'] ) ) {
			$query_args['tax_query'] = [
				[
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => sanitize_text_field( $filters['category'] ),
				],
			];
		}

		if ( ! empty( $filters['search'] ) ) {
			$query_args['s'] = sanitize_text_field( $filters['search'] );
		}

		if ( ! empty( $filters['orderby'] ) ) {
			$orderby = sanitize_text_field( $filters['orderby'] );
			switch ( $orderby ) {
				case 'popularity':
					$query_args['meta_key'] = 'total_sales';
					$query_args['orderby'] = 'meta_value_num';
					$query_args['order'] = 'DESC';
					break;
				case 'rating':
					$query_args['meta_key'] = '_wc_average_rating';
					$query_args['orderby'] = 'meta_value_num';
					$query_args['order'] = 'DESC';
					break;
				case 'date':
					$query_args['orderby'] = 'date';
					$query_args['order'] = 'DESC';
					break;
				case 'price':
					$query_args['meta_key'] = '_price';
					$query_args['orderby'] = 'meta_value_num';
					$query_args['order'] = 'ASC';
					break;
				case 'price-desc':
					$query_args['meta_key'] = '_price';
					$query_args['orderby'] = 'meta_value_num';
					$query_args['order'] = 'DESC';
					break;
			}
		}

		// Add WooCommerce specific query filters
		$query_args['meta_query'][] = WC()->query->get_meta_query();
		$query_args['tax_query'] = array_merge( 
			isset( $query_args['tax_query'] ) ? $query_args['tax_query'] : [], 
			WC()->query->get_tax_query() 
		);

		$query = new WP_Query( $query_args );
		$products = $query->posts;

		// Generate HTML
		$html = $this->generate_products_html( $products, $settings );
		$has_more = $query->found_posts > count( $products );

		wp_send_json_success( [
			'html' => $html,
			'has_more' => $has_more,
			'total_found' => $query->found_posts
		] );
	}

	/**
	 * AJAX handler for load more products
	 */
	public function ajax_load_more_products() {
		// Security check: verify the nonce.
		check_ajax_referer( 'slidefirePro_filter_nonce', 'nonce' );

		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( [ 'message' => 'WooCommerce is not active' ] );
		}

		// Sanitize input
		$page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
		$filters = isset( $_POST['filters'] ) ? $_POST['filters'] : [];
		$settings = isset( $_POST['settings'] ) ? $_POST['settings'] : [];
		$products_per_page = isset( $settings['products_per_page'] ) ? intval( $settings['products_per_page'] ) : 12;

		// Build query args (similar to filter products)
		$query_args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $products_per_page,
			'paged' => $page,
			'meta_query' => [
				[
					'key' => '_visibility',
					'value' => [ 'catalog', 'visible' ],
					'compare' => 'IN',
				],
			],
		];

		// Apply same filters as main query
		if ( ! empty( $filters['category'] ) ) {
			$query_args['tax_query'] = [
				[
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => sanitize_text_field( $filters['category'] ),
				],
			];
		}

		$query = new WP_Query( $query_args );
		$products = $query->posts;

		// Generate HTML
		$html = $this->generate_products_html( $products, $settings );
		$has_more = $query->max_num_pages > $page;

		wp_send_json_success( [
			'html' => $html,
			'has_more' => $has_more
		] );
	}

	/**
	 * AJAX handler for add to cart
	 */
	public function ajax_add_to_cart() {
		// Security check: verify the nonce.
		check_ajax_referer( 'slidefirePro_filter_nonce', 'nonce' );

		if ( ! class_exists( 'WooCommerce' ) ) {
			wp_send_json_error( [ 'message' => 'WooCommerce is not active' ] );
		}

		$product_id = intval( $_POST['product_id'] ?? 0 );
		$quantity = intval( $_POST['quantity'] ?? 1 );

		if ( ! $product_id ) {
			wp_send_json_error( [ 'message' => 'Invalid product ID' ] );
		}

		$result = WC()->cart->add_to_cart( $product_id, $quantity );

		if ( $result ) {
			// Get updated cart fragments
			$fragments = WC()->cart->get_cart_for_session();
			
			wp_send_json_success( [
				'message' => 'Product added to cart successfully',
				'cart_hash' => WC()->cart->get_cart_hash(),
				'fragments' => $fragments
			] );
		} else {
			wp_send_json_error( [ 'message' => 'Failed to add product to cart' ] );
		}
	}

	/**
	 * Generate products HTML
	 */
	private function generate_products_html( $products, $settings = [] ) {
		if ( empty( $products ) ) {
			return '';
		}

		$html = '';
		
		foreach ( $products as $product_post ) {
			$product = wc_get_product( $product_post->ID );
			if ( ! $product ) continue;

			$product_categories = wp_get_post_terms( $product_post->ID, 'product_cat' );
			$main_category = ! empty( $product_categories ) ? $product_categories[0] : null;

			ob_start();
			?>
			<div class="product-card text-card-foreground flex flex-col gap-6 rounded-xl border group bg-card border-border hover:border-primary/50 transition-all duration-300 overflow-hidden cursor-pointer" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
				
				<!-- Product Image -->
				<div class="product-image relative overflow-hidden">
					<?php 
					$image_id = $product->get_image_id();
					if ( $image_id ) {
						echo wp_get_attachment_image( $image_id, 'medium', false, [
							'alt' => $product->get_name(),
							'class' => 'w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500'
						] );
					} else {
						echo '<div class="w-full h-64 bg-muted flex items-center justify-center">';
						echo '<span class="text-muted-foreground">' . esc_html__( 'No Image', 'slidefirePro-widgets' ) . '</span>';
						echo '</div>';
					}
					?>

					<!-- Sale Badge -->
					<?php if ( ( ! isset( $settings['show_sale_badge'] ) || 'yes' === $settings['show_sale_badge'] ) && $product->is_on_sale() ) : ?>
					<span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap absolute top-3 left-3 bg-primary text-white border-transparent">
						<?php 
						$regular_price = (float) $product->get_regular_price();
						$sale_price = (float) $product->get_sale_price();
						if ( $regular_price > 0 ) {
							$discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
							echo esc_html( $discount . '% OFF' );
						} else {
							echo esc_html__( 'SALE', 'slidefirePro-widgets' );
						}
						?>
					</span>
					<?php endif; ?>

					<!-- Featured Badge -->
					<?php if ( ( ! isset( $settings['show_featured_badge'] ) || 'yes' === $settings['show_featured_badge'] ) && $product->is_featured() ) : ?>
					<span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap absolute top-3 left-3 bg-primary text-white border-transparent">
						<?php echo esc_html__( 'BESTSELLER', 'slidefirePro-widgets' ); ?>
					</span>
					<?php endif; ?>

					<!-- Wishlist Button -->
					<?php if ( ! isset( $settings['show_wishlist_button'] ) || 'yes' === $settings['show_wishlist_button'] ) : ?>
					<button class="wishlist-button inline-flex items-center justify-center whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 outline-none rounded-md absolute top-3 right-3 h-8 w-8 p-0 bg-background/80 hover:bg-background opacity-0 group-hover:opacity-100 transition-opacity" aria-label="<?php echo esc_attr__( 'Add to wishlist', 'slidefirePro-widgets' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" aria-hidden="true">
							<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
						</svg>
					</button>
					<?php endif; ?>

					<!-- Quick Add Button Overlay -->
					<?php if ( ! isset( $settings['show_quick_add_button'] ) || 'yes' === $settings['show_quick_add_button'] ) : ?>
					<div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
						<button class="quick-add-button inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all h-9 px-4 py-2 bg-primary hover:bg-primary/90 text-primary-foreground" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2" aria-hidden="true">
								<circle cx="8" cy="21" r="1"></circle>
								<circle cx="19" cy="21" r="1"></circle>
								<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
							</svg>
							<?php echo esc_html( $settings['quick_add_text'] ?? 'Quick Add' ); ?>
						</button>
					</div>
					<?php endif; ?>
				</div>

				<!-- Product Content -->
				<div class="product-content p-4">
					<!-- Category Badge -->
					<?php if ( ( ! isset( $settings['show_category_badge'] ) || 'yes' === $settings['show_category_badge'] ) && $main_category ) : ?>
					<div class="mb-2">
						<span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 font-medium w-fit whitespace-nowrap text-foreground text-xs mb-2">
							<?php echo esc_html( $main_category->name ); ?>
						</span>
					</div>
					<?php endif; ?>

					<!-- Product Title -->
					<h3 class="product-title font-semibold mb-2 group-hover:text-primary transition-colors text-sm">
						<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="text-inherit hover:text-inherit">
							<?php echo esc_html( $product->get_name() ); ?>
						</a>
					</h3>

					<!-- Product Price -->
					<div class="product-price flex items-center space-x-2">
						<?php if ( $product->is_on_sale() ) : ?>
							<span class="text-lg font-bold text-primary"><?php echo $product->get_sale_price() ? wc_price( $product->get_sale_price() ) : ''; ?></span>
							<span class="text-sm text-muted-foreground line-through"><?php echo wc_price( $product->get_regular_price() ); ?></span>
							<?php 
							$regular_price = (float) $product->get_regular_price();
							$sale_price = (float) $product->get_sale_price();
							if ( $regular_price > 0 ) {
								$discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
								?>
								<span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 font-medium w-fit whitespace-nowrap text-xs border-primary text-primary">
									<?php echo esc_html( $discount . '% OFF' ); ?>
								</span>
								<?php
							}
							?>
						<?php else : ?>
							<span class="text-lg font-bold text-primary"><?php echo wc_price( $product->get_price() ); ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			$html .= ob_get_clean();
		}

		return $html;
	}
}

new SlideFirePro_Widgets();