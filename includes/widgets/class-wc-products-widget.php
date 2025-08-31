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
	 * Get WooCommerce products based on filters
	 */
	private function get_products( $args = [] ): array {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return [];
		}

		$default_args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 12,
			'meta_query' => [
				[
					'key' => '_visibility',
					'value' => [ 'catalog', 'visible' ],
					'compare' => 'IN',
				],
			],
		];

		$query_args = wp_parse_args( $args, $default_args );
		
		// Add WooCommerce specific query filters
		$query_args['meta_query'][] = WC()->query->get_meta_query();
		$query_args['tax_query'] = WC()->query->get_tax_query();

		$query = new WP_Query( $query_args );
		return $query->posts;
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		// Build query args
		$query_args = [
			'posts_per_page' => $settings['products_per_page'],
		];

		// Add default category filter if set
		if ( ! empty( $settings['default_category'] ) ) {
			$query_args['tax_query'] = [
				[
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $settings['default_category'],
				],
			];
		}

		$products = $this->get_products( $query_args );

		if ( empty( $products ) ) {
			echo '<div class="slidefirePro-no-products">' . esc_html__( 'No products found.', 'slidefirePro-widgets' ) . '</div>';
			return;
		}
		?>

		<div class="slidefirePro-products-wrapper" data-widget-id="<?php echo esc_attr( $widget_id ); ?>" data-settings="<?php echo esc_attr( json_encode( $settings ) ); ?>">
			
			<!-- Products Grid -->
			<div class="slidefirePro-products-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
				<?php foreach ( $products as $product_post ) :
					$product = wc_get_product( $product_post->ID );
					if ( ! $product ) continue;

					$product_categories = wp_get_post_terms( $product_post->ID, 'product_cat' );
					$main_category = ! empty( $product_categories ) ? $product_categories[0] : null;
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
							<?php if ( 'yes' === $settings['show_sale_badge'] && $product->is_on_sale() ) : ?>
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
							<?php if ( 'yes' === $settings['show_featured_badge'] && $product->is_featured() ) : ?>
							<span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap absolute top-3 left-3 bg-primary text-white border-transparent">
								<?php echo esc_html__( 'BESTSELLER', 'slidefirePro-widgets' ); ?>
							</span>
							<?php endif; ?>

							<!-- Wishlist Button -->
							<?php if ( 'yes' === $settings['show_wishlist_button'] ) : ?>
							<button class="wishlist-button inline-flex items-center justify-center whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 outline-none rounded-md absolute top-3 right-3 h-8 w-8 p-0 bg-background/80 hover:bg-background opacity-0 group-hover:opacity-100 transition-opacity" aria-label="<?php echo esc_attr__( 'Add to wishlist', 'slidefirePro-widgets' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" aria-hidden="true">
									<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
								</svg>
							</button>
							<?php endif; ?>

							<!-- Quick Add Button Overlay -->
							<?php if ( 'yes' === $settings['show_quick_add_button'] ) : ?>
							<div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
								<button class="quick-add-button inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all h-9 px-4 py-2 bg-primary hover:bg-primary/90 text-primary-foreground" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2" aria-hidden="true">
										<circle cx="8" cy="21" r="1"></circle>
										<circle cx="19" cy="21" r="1"></circle>
										<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
									</svg>
									<?php echo esc_html( $settings['quick_add_text'] ); ?>
								</button>
							</div>
							<?php endif; ?>
						</div>

						<!-- Product Content -->
						<div class="product-content p-4">
							<!-- Category Badge -->
							<?php if ( 'yes' === $settings['show_category_badge'] && $main_category ) : ?>
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

				<?php endforeach; ?>
			</div>

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
}