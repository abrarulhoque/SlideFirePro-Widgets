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

		// Add our custom classes to the products list
		$content = str_replace( 
			'class="products', 
			'class="products slidefirePro-products-grid', 
			$content 
		);

		// Add data attributes to product items for AJAX functionality
		$content = preg_replace_callback(
			'/<li class="([^"]*product[^"]*)"/',
			function( $matches ) {
				return '<li class="' . $matches[1] . ' product-card"';
			},
			$content
		);

		// Add wishlist and quick add buttons if enabled
		if ( 'yes' === $settings['show_wishlist_button'] || 'yes' === $settings['show_quick_add_button'] ) {
			$content = $this->add_custom_buttons_to_products( $content, $settings );
		}

		return $content;
	}

	/**
	 * Add custom buttons (wishlist, quick add) to products
	 */
	private function add_custom_buttons_to_products( $content, $settings ): string {
		// This is a simplified version - in a real implementation, 
		// you might want to use WooCommerce hooks instead
		
		// Add custom buttons after the product image
		$content = preg_replace_callback(
			'/<a href="([^"]+)" class="woocommerce-LoopProduct-link[^"]*">/',
			function( $matches ) use ( $settings ) {
				$buttons_html = '';
				
				if ( 'yes' === $settings['show_wishlist_button'] ) {
					$buttons_html .= '<button class="wishlist-button" aria-label="Add to wishlist">♡</button>';
				}
				
				if ( 'yes' === $settings['show_quick_add_button'] ) {
					$buttons_html .= '<div class="quick-add-overlay"><button class="quick-add-button">' . esc_html( $settings['quick_add_text'] ?? 'Quick Add' ) . '</button></div>';
				}
				
				return $matches[0] . $buttons_html;
			},
			$content
		);

		return $content;
	}
}