<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use WP_Query;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WC_Products_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-wc-products';
	}

	public function get_title(): string {
		return esc_html__( 'WooCommerce Products Grid', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-products';
	}

	public function get_categories(): array {
		return [ 'woocommerce-elements' ];
	}

	public function get_keywords(): array {
		return [ 'woocommerce', 'products', 'grid', 'shop', 'ecommerce', 'product', 'card' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-wc-products' ];
	}

	public function get_script_depends(): array {
		return [ 'slidefirePro-wc-products' ];
	}

	protected function register_controls(): void {

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Products Settings', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'products_per_page',
			[
				'label' => esc_html__( 'Products Per Page', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 12,
				'min' => 1,
				'max' => 48,
				'step' => 1,
			]
		);

		$this->add_control(
			'default_category',
			[
				'label' => esc_html__( 'Default Category', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_product_categories(),
				'default' => '',
				'description' => esc_html__( 'Select default category to show on page load', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'show_sale_badge',
			[
				'label' => esc_html__( 'Show Sale Badge', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_featured_badge',
			[
				'label' => esc_html__( 'Show Featured Badge', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category_badge',
			[
				'label' => esc_html__( 'Show Category Badge', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_wishlist_button',
			[
				'label' => esc_html__( 'Show Wishlist Button', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_quick_add_button',
			[
				'label' => esc_html__( 'Show Quick Add Button', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

                $this->add_control(
                        'quick_add_text',
                        [
                                'label' => esc_html__( 'Quick Add Text', 'slidefirePro-widgets' ),
                                'type' => Controls_Manager::TEXT,
                                'default' => esc_html__( 'Quick Add', 'slidefirePro-widgets' ),
                                'condition' => [
                                        'show_quick_add_button' => 'yes',
                                ],
                        ]
                );

                $this->add_control(
                        'quick_add_quantity',
                        [
                                'label' => esc_html__( 'Quick Add Quantity', 'slidefirePro-widgets' ),
                                'type' => Controls_Manager::NUMBER,
                                'default' => 3,
                                'min' => 1,
                                'step' => 1,
                                'condition' => [
                                        'show_quick_add_button' => 'yes',
                                ],
                        ]
                );

		$this->add_control(
			'show_load_more',
			[
				'label' => esc_html__( 'Show Load More Button', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'load_more_text',
			[
				'label' => esc_html__( 'Load More Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Load More Products', 'slidefirePro-widgets' ),
				'condition' => [
					'show_load_more' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Layout Section
		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'tablet_default' => '3',
				'mobile_default' => '2',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors' => [
					'{{WRAPPER}} .slidefirePro-products-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label' => esc_html__( 'Gap', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => 1.5,
				],
				'selectors' => [
					'{{WRAPPER}} .slidefirePro-products-grid' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Controls
		$this->start_controls_section(
			'card_style_section',
			[
				'label' => esc_html__( 'Product Card Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_background_color',
			[
				'label' => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .product-card',
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .product-card .product-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .product-card',
			]
		);

		$this->add_control(
			'card_hover_effects',
			[
				'label' => esc_html__( 'Hover Effects', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-card:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_hover_transform',
			[
				'label' => esc_html__( 'Hover Scale Effect', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .product-card:hover .product-image img' => 'transform: scale(1.05);',
				],
			]
		);

		$this->end_controls_section();

		// Typography Section
		$this->start_controls_section(
			'typography_section',
			[
				'label' => esc_html__( 'Typography', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'product_title_typography',
				'label' => esc_html__( 'Product Title', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .product-title',
			]
		);

		$this->add_control(
			'product_title_color',
			[
				'label' => esc_html__( 'Title Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_title_hover_color',
			[
				'label' => esc_html__( 'Title Hover Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-card:hover .product-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'product_price_typography',
				'label' => esc_html__( 'Product Price', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .product-price',
			]
		);

		$this->add_control(
			'product_price_color',
			[
				'label' => esc_html__( 'Price Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_sale_price_color',
			[
				'label' => esc_html__( 'Sale Price Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price .woocommerce-Price-amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get WooCommerce product categories for the dropdown
	 */
	private function get_product_categories(): array {
		$categories = [ '' => esc_html__( 'All Categories', 'slidefirePro-widgets' ) ];
		
		if ( class_exists( 'WooCommerce' ) ) {
			$terms = get_terms( [
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
			] );
			
			if ( ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$categories[ $term->slug ] = $term->name;
				}
			}
		}
		
		return $categories;
	}

	/**
	 * Get WooCommerce products using WC shortcode approach
	 */
	private function get_products_content( $settings = [] ): string {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return '<div class="slidefirePro-no-products">' . esc_html__( 'WooCommerce is not active.', 'slidefirePro-widgets' ) . '</div>';
		}

		// Build shortcode attributes
		$shortcode_atts = [
			'limit' => $settings['products_per_page'] ?? 12,
			'columns' => $settings['columns'] ?? 4,
			'orderby' => 'menu_order',
			'order' => 'ASC',
		];

		// Add category filter if set
		if ( ! empty( $settings['default_category'] ) ) {
			$shortcode_atts['category'] = $settings['default_category'];
		}

		// Use WooCommerce's products shortcode
		$shortcode = new \WC_Shortcode_Products( $shortcode_atts, 'products' );
		$content = $shortcode->get_content();
		
		if ( empty( $content ) ) {
			return '<div class="slidefirePro-no-products">' . esc_html__( 'No products found.', 'slidefirePro-widgets' ) . '</div>';
		}

		return $content;
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		// Print WooCommerce notices if session exists
		if ( WC()->session ) {
			wc_print_notices();
		}

		// Get products content using WC shortcode approach
		$content = $this->get_products_content( $settings );
		
		?>
		<div class="slidefirePro-products-wrapper elementor-wc-products" data-widget-id="<?php echo esc_attr( $widget_id ); ?>" data-settings="<?php echo esc_attr( json_encode( $settings ) ); ?>">
			
			<?php 
			// Modify the WC content to include our custom styling and functionality
			$content = $this->customize_wc_content( $content, $settings );
			echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			?>

			<!-- Load More Button -->
			<?php if ( 'yes' === $settings['show_load_more'] ) : ?>
			<div class="text-center mt-12">
				<button class="load-more-button inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 border bg-background hover:text-accent-foreground h-10 rounded-md px-6 border-primary text-primary hover:bg-primary/10" data-page="1">
					<?php echo esc_html( $settings['load_more_text'] ); ?>
				</button>
			</div>
			<?php endif; ?>

		</div>
		<?php
	}

	/**
	 * Customize WooCommerce content with our styling and functionality
	 */
	private function customize_wc_content( $content, $settings ): string {
		if ( empty( $content ) ) {
			return $content;
		}

		// Replace WooCommerce products with our custom structure
		$content = $this->build_custom_product_grid( $settings );

		return $content;
	}

	/**
	 * Build custom product grid matching Figma design
	 */
	private function build_custom_product_grid( $settings ): string {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return '<div class="slidefirePro-no-products">' . esc_html__( 'WooCommerce is not active.', 'slidefirePro-widgets' ) . '</div>';
		}

		// Build WP_Query arguments
		$args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $settings['products_per_page'] ?? 12,
			'meta_query' => WC()->query->get_meta_query(),
			'tax_query' => WC()->query->get_tax_query(),
		];

		// Add category filter if set
		if ( ! empty( $settings['default_category'] ) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $settings['default_category'],
			];
		}

		$products = new \WP_Query( $args );

		if ( ! $products->have_posts() ) {
			return '<div class="slidefirePro-no-products">' . esc_html__( 'No products found.', 'slidefirePro-widgets' ) . '</div>';
		}

                $quick_add_quantity = max( 1, (int) ( $settings['quick_add_quantity'] ?? 3 ) );

                ob_start();
		?>
		<div class="slidefirePro-products-grid">
			<?php
			while ( $products->have_posts() ) :
				$products->the_post();
				global $product;
				?>
				<div data-slot="card" class="product-card text-card-foreground group cursor-pointer" data-product-id="<?php echo esc_attr( get_the_ID() ); ?>">
					<div class="product-image-wrapper">
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-link">
							<?php echo woocommerce_get_product_thumbnail( 'woocommerce_thumbnail', [ 'class' => 'product-image' ] ); ?>
						</a>
						
						<!-- Product Badges -->
						<?php $this->render_product_badges( $product, $settings ); ?>
						
						<!-- Wishlist Button -->
						<?php if ( 'yes' === $settings['show_wishlist_button'] ) : ?>
						<button class="wishlist-button" aria-label="<?php esc_attr_e( 'Add to wishlist', 'slidefirePro-widgets' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="heart-icon">
								<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
							</svg>
						</button>
						<?php endif; ?>
						
						<!-- Quick Add Overlay -->
						<?php if ( 'yes' === $settings['show_quick_add_button'] ) : ?>
						<div class="product-overlay">
							<?php 
							$is_variable = $product && method_exists( $product, 'is_type' ) ? $product->is_type( 'variable' ) : false;
							$button_text = $is_variable ? $product->add_to_cart_text() : ( $settings['quick_add_text'] ?? 'Quick Add' );
							?>
							<button 
								class="quick-add-button" 
                                                                data-product-id="<?php echo esc_attr( get_the_ID() ); ?>"
                                                                data-product-type="<?php echo esc_attr( $is_variable ? 'variable' : 'simple' ); ?>"
                                                                data-product-url="<?php echo esc_url( get_permalink() ); ?>"
                                                                data-quantity="<?php echo esc_attr( $quick_add_quantity ); ?>"
                                                        >
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="cart-icon">
									<circle cx="8" cy="21" r="1"></circle>
									<circle cx="19" cy="21" r="1"></circle>
									<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
								</svg>
								<?php echo esc_html( $button_text ); ?>
							</button>
						</div>
						<?php endif; ?>
					</div>
					
					<div class="product-content">
						<?php if ( 'yes' === $settings['show_category_badge'] ) : ?>
						<div class="product-category-wrapper">
							<?php $this->render_product_category_badge( $product ); ?>
						</div>
						<?php endif; ?>
						
						<h3 class="product-title">
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<?php echo esc_html( get_the_title() ); ?>
							</a>
						</h3>
						
						<div class="product-price-wrapper">
							<?php echo $product->get_price_html(); ?>
							<?php if ( $product->is_on_sale() && 'yes' === $settings['show_sale_badge'] ) : ?>
								<?php $this->render_sale_percentage_badge( $product ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php
		
		return ob_get_clean();
	}

	/**
	 * Render product badges (sale, featured, etc.)
	 */
	private function render_product_badges( $product, $settings ): void {
		if ( $product->is_on_sale() && 'yes' === $settings['show_sale_badge'] ) {
			echo '<span class="product-badge sale-badge">BESTSELLER</span>';
		}
		
		if ( $product->is_featured() && 'yes' === $settings['show_featured_badge'] ) {
			echo '<span class="product-badge featured-badge">FEATURED</span>';
		}
	}

	/**
	 * Render product category badge
	 */
	private function render_product_category_badge( $product ): void {
		$categories = wp_get_post_terms( $product->get_id(), 'product_cat' );
		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			$category = $categories[0];
			echo '<span class="category-badge">' . esc_html( $category->name ) . '</span>';
		}
	}

	/**
	 * Render sale percentage badge
	 */
	private function render_sale_percentage_badge( $product ): void {
		$regular_price = floatval( $product->get_regular_price() );
		$sale_price = floatval( $product->get_sale_price() );
		
		if ( $regular_price > 0 && $sale_price > 0 ) {
			$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
			echo '<span class="sale-percentage-badge">' . esc_html( $percentage . '% OFF' ) . '</span>';
		}
	}
}
