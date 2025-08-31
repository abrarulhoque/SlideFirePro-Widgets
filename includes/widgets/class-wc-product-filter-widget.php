<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WC_Product_Filter_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-wc-product-filter';
	}

	public function get_title(): string {
		return esc_html__( 'WooCommerce Product Filter', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-search';
	}

	public function get_categories(): array {
		return [ 'woocommerce-elements' ];
	}

	public function get_keywords(): array {
		return [ 'woocommerce', 'product', 'filter', 'search', 'category', 'sort', 'grid', 'list' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-wc-product-filter' ];
	}

	public function get_script_depends(): array {
		return [ 'slidefirePro-wc-product-filter' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Filter Settings', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_placeholder',
			[
				'label' => esc_html__( 'Search Placeholder', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Search products...', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Enter placeholder text', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'category_label',
			[
				'label' => esc_html__( 'Category Dropdown Label', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'All', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Default category label', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'sort_label',
			[
				'label' => esc_html__( 'Sort Dropdown Label', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Featured', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Default sort label', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'show_search',
			[
				'label' => esc_html__( 'Show Search Input', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category_filter',
			[
				'label' => esc_html__( 'Show Category Filter', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_sort_filter',
			[
				'label' => esc_html__( 'Show Sort Filter', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_view_toggle',
			[
				'label' => esc_html__( 'Show View Toggle', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'default_view',
			[
				'label' => esc_html__( 'Default View', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'grid' => esc_html__( 'Grid', 'slidefirePro-widgets' ),
					'list' => esc_html__( 'List', 'slidefirePro-widgets' ),
				],
				'default' => 'grid',
				'condition' => [
					'show_view_toggle' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Filter Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_background_color',
			[
				'label' => esc_html__( 'Input Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-filter-search-input' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wc-filter-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => esc_html__( 'Input Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-filter-search-input' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wc-filter-dropdown' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => esc_html__( 'Input Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-filter-search-input' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wc-filter-dropdown' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wc-filter-search-input::placeholder' => 'color: {{VALUE}}; opacity: 0.7;',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Button Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-filter-view-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_active_color',
			[
				'label' => esc_html__( 'Button Active Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-filter-view-button.active' => 'background-color: {{VALUE}}; color: var(--slidefire-background);',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		// Get WooCommerce product categories
		$product_categories = [];
		if ( class_exists( 'WooCommerce' ) ) {
			$terms = get_terms( [
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
			] );
			
			if ( ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$product_categories[ $term->slug ] = $term->name;
				}
			}
		}

		// Sort options
		$sort_options = [
			'' => esc_html__( 'Default sorting', 'slidefirePro-widgets' ),
			'popularity' => esc_html__( 'Sort by popularity', 'slidefirePro-widgets' ),
			'rating' => esc_html__( 'Sort by average rating', 'slidefirePro-widgets' ),
			'date' => esc_html__( 'Sort by latest', 'slidefirePro-widgets' ),
			'price' => esc_html__( 'Sort by price: low to high', 'slidefirePro-widgets' ),
			'price-desc' => esc_html__( 'Sort by price: high to low', 'slidefirePro-widgets' ),
		];
		?>

		<div class="wc-product-filter-wrapper" data-widget-id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="wc-filter-container">
				
				<?php if ( 'yes' === $settings['show_search'] ) : ?>
				<div class="wc-filter-search-container">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="wc-filter-search-icon" aria-hidden="true">
						<path d="m21 21-4.34-4.34"></path>
						<circle cx="11" cy="11" r="8"></circle>
					</svg>
					<input 
						type="text" 
						class="wc-filter-search-input" 
						placeholder="<?php echo esc_attr( $settings['search_placeholder'] ); ?>"
						data-filter-type="search"
					>
				</div>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_category_filter'] && ! empty( $product_categories ) ) : ?>
				<div class="wc-filter-dropdown-container">
					<select class="wc-filter-dropdown" data-filter-type="category">
						<option value=""><?php echo esc_html( $settings['category_label'] ); ?></option>
						<?php foreach ( $product_categories as $slug => $name ) : ?>
							<option value="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></option>
						<?php endforeach; ?>
					</select>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="wc-filter-dropdown-icon" aria-hidden="true">
						<path d="m6 9 6 6 6-6"></path>
					</svg>
				</div>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_sort_filter'] ) : ?>
				<div class="wc-filter-dropdown-container">
					<select class="wc-filter-dropdown" data-filter-type="sort">
						<option value=""><?php echo esc_html( $settings['sort_label'] ); ?></option>
						<?php foreach ( $sort_options as $value => $label ) : ?>
							<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="wc-filter-dropdown-icon" aria-hidden="true">
						<path d="m6 9 6 6 6-6"></path>
					</svg>
				</div>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_view_toggle'] ) : ?>
				<div class="wc-filter-view-toggle">
					<button 
						type="button" 
						class="wc-filter-view-button <?php echo ( 'grid' === $settings['default_view'] ) ? 'active' : ''; ?>" 
						data-view="grid"
						aria-label="<?php echo esc_attr__( 'Grid View', 'slidefirePro-widgets' ); ?>"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="wc-filter-view-icon" aria-hidden="true">
							<rect width="18" height="18" x="3" y="3" rx="2"></rect>
							<path d="M3 9h18"></path>
							<path d="M3 15h18"></path>
							<path d="M9 3v18"></path>
							<path d="M15 3v18"></path>
						</svg>
					</button>
					<button 
						type="button" 
						class="wc-filter-view-button <?php echo ( 'list' === $settings['default_view'] ) ? 'active' : ''; ?>" 
						data-view="list"
						aria-label="<?php echo esc_attr__( 'List View', 'slidefirePro-widgets' ); ?>"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="wc-filter-view-icon" aria-hidden="true">
							<path d="M3 12h.01"></path>
							<path d="M3 18h.01"></path>
							<path d="M3 6h.01"></path>
							<path d="M8 12h13"></path>
							<path d="M8 18h13"></path>
							<path d="M8 6h13"></path>
						</svg>
					</button>
				</div>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}
}