<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Icons_Manager;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Category_Filter_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-category-filter';
	}

	public function get_title(): string {
		return esc_html__( 'Category Filter', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-filter';
	}

	public function get_categories(): array {
		return [ 'woocommerce-elements' ];
	}

	public function get_keywords(): array {
		return [ 'category', 'filter', 'woocommerce', 'product', 'grid' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-category-filter' ];
	}

	public function get_script_depends(): array {
		return [ 'slidefirePro-category-filter' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Categories', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'category_icon',
			[
				'label' => esc_html__( 'Icon', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-grid-alt',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'category_title',
			[
				'label' => esc_html__( 'Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Category Name', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Type your category title here', 'slidefirePro-widgets' ),
			]
		);

		// WooCommerce category selection
		$product_categories = [];
		if ( class_exists( 'WooCommerce' ) ) {
			$terms = get_terms( [
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
			] );
			
			$product_categories[''] = esc_html__( 'All Products', 'slidefirePro-widgets' );
			
			if ( ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$product_categories[ $term->slug ] = $term->name;
				}
			}
		}

		$repeater->add_control(
			'category_slug',
			[
				'label' => esc_html__( 'WooCommerce Category', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => $product_categories,
				'default' => '',
				'description' => esc_html__( 'Select a WooCommerce category to filter products, or leave empty for "All Products"', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'primary' => esc_html__( 'Primary Blue', 'slidefirePro-widgets' ),
					'blue' => esc_html__( 'Blue 400', 'slidefirePro-widgets' ),
					'purple' => esc_html__( 'Purple 400', 'slidefirePro-widgets' ),
					'orange' => esc_html__( 'Orange 400', 'slidefirePro-widgets' ),
				],
				'default' => 'primary',
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Category Items', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'category_title' => esc_html__( 'All', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-grid-alt',
							'library' => 'fa-solid',
						],
						'category_slug' => '',
						'icon_color' => 'primary',
					],
					[
						'category_title' => esc_html__( 'Jerseys', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-tshirt',
							'library' => 'fa-solid',
						],
						'category_slug' => 'jerseys',
						'icon_color' => 'primary',
					],
					[
						'category_title' => esc_html__( 'Pants', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-box',
							'library' => 'fa-solid',
						],
						'category_slug' => 'pants',
						'icon_color' => 'blue',
					],
					[
						'category_title' => esc_html__( 'Headbands', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-headphones',
							'library' => 'fa-solid',
						],
						'category_slug' => 'headbands',
						'icon_color' => 'purple',
					],
					[
						'category_title' => esc_html__( 'Hoodies', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-tshirt',
							'library' => 'fa-solid',
						],
						'category_slug' => 'hoodies',
						'icon_color' => 'orange',
					],
					[
						'category_title' => esc_html__( 'Team Apparel', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-users',
							'library' => 'fa-solid',
						],
						'category_slug' => 'team-apparel',
						'icon_color' => 'blue',
					],
				],
				'title_field' => '{{{ category_title }}}',
			]
		);

		$this->end_controls_section();

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
				'default' => '6',
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
					'{{WRAPPER}} .slidefirePro-category-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
					'{{WRAPPER}} .slidefirePro-category-grid' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Controls
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Card Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_background_color',
			[
				'label' => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category-filter-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_border_color',
			[
				'label' => esc_html__( 'Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category-filter-card' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_active_border_color',
			[
				'label' => esc_html__( 'Active Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category-filter-card.active' => 'border-color: {{VALUE}}; box-shadow: 0 0 0 2px {{VALUE}}20;',
				],
			]
		);

		$this->add_control(
			'card_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category-filter-card:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['categories'] ) ) {
			return;
		}

		$widget_id = $this->get_id();
		?>

		<div class="slidefirePro-category-filter" data-widget-id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="slidefirePro-category-grid">
				<?php foreach ( $settings['categories'] as $index => $item ) : 
					$is_first = ( $index === 0 );
					$active_class = $is_first ? ' active' : '';
				?>
					<div class="category-filter-card<?php echo esc_attr( $active_class ); ?>" 
						 data-category="<?php echo esc_attr( $item['category_slug'] ); ?>"
						 role="button" 
						 tabindex="0"
						 aria-label="<?php echo esc_attr( sprintf( __( 'Filter by %s', 'slidefirePro-widgets' ), $item['category_title'] ) ); ?>">
						
						<div class="card-content">
							<div class="icon-wrapper <?php echo esc_attr( 'color-' . $item['icon_color'] ); ?>">
								<?php Icons_Manager::render_icon( $item['category_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</div>
							<h3 class="category-title"><?php echo esc_html( $item['category_title'] ); ?></h3>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}