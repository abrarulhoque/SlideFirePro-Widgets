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

		$repeater->add_control(
			'icon_svg',
			[
				'label' => esc_html__( 'Custom SVG Icon', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Optional: Enter custom SVG code to override the icon', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( '<svg>...</svg>', 'slidefirePro-widgets' ),
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
						'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grid3x3 w-8 h-8" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M3 15h18"></path><path d="M9 3v18"></path><path d="M15 3v18"></path></svg>',
					],
					[
						'category_title' => esc_html__( 'Jerseys', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-tshirt',
							'library' => 'fa-solid',
						],
						'category_slug' => 'jerseys',
						'icon_color' => 'primary',
						'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shirt w-8 h-8" aria-hidden="true"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"></path></svg>',
					],
					[
						'category_title' => esc_html__( 'Pants', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-box',
							'library' => 'fa-solid',
						],
						'category_slug' => 'pants',
						'icon_color' => 'blue',
						'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8" aria-hidden="true"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>',
					],
					[
						'category_title' => esc_html__( 'Headbands', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-headphones',
							'library' => 'fa-solid',
						],
						'category_slug' => 'headbands',
						'icon_color' => 'purple',
						'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-headphones w-8 h-8" aria-hidden="true"><path d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a9 9 0 0 1 18 0v7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3"></path></svg>',
					],
					[
						'category_title' => esc_html__( 'Hoodies', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-tshirt',
							'library' => 'fa-solid',
						],
						'category_slug' => 'hoodies',
						'icon_color' => 'orange',
						'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shirt w-8 h-8" aria-hidden="true"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"></path></svg>',
					],
					[
						'category_title' => esc_html__( 'Team Apparel', 'slidefirePro-widgets' ),
						'category_icon' => [
							'value' => 'fas fa-users',
							'library' => 'fa-solid',
						],
						'category_slug' => 'team-apparel',
						'icon_color' => 'blue',
						'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-8 h-8" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><path d="M16 3.128a4 4 0 0 1 0 7.744"></path><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="9" cy="7" r="4"></circle></svg>',
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

		<div class="mb-16" data-widget-id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
				<?php foreach ( $settings['categories'] as $index => $item ) : 
					$is_first = ( $index === 0 );
					$active_classes = $is_first ? 'border-primary ring-2 ring-primary/20' : 'border-border';
				?>
					<div data-slot="card" 
						 class="text-card-foreground flex flex-col gap-6 rounded-xl border bg-card hover:border-primary/50 transition-all duration-300 cursor-pointer group <?php echo esc_attr( $active_classes ); ?>" 
						 data-category="<?php echo esc_attr( $item['category_slug'] ); ?>"
						 role="button" 
						 tabindex="0"
						 aria-label="<?php echo esc_attr( sprintf( __( 'Filter by %s', 'slidefirePro-widgets' ), $item['category_title'] ) ); ?>">
						
						<div class="p-6 text-center">
							<div class="mb-4 flex justify-center">
								<div class="w-16 h-16 rounded-full bg-muted flex items-center justify-center group-hover:bg-primary/10 transition-colors">
									<?php if ( !empty( $item['icon_svg'] ) ) : ?>
										<div class="text-<?php echo esc_attr( $item['icon_color'] === 'primary' ? 'primary' : $item['icon_color'] . '-400' ); ?> group-hover:scale-110 transition-transform">
											<?php echo wp_kses( $item['icon_svg'], [
												'svg' => [
													'xmlns' => [],
													'width' => [],
													'height' => [],
													'viewBox' => [],
													'fill' => [],
													'stroke' => [],
													'stroke-width' => [],
													'stroke-linecap' => [],
													'stroke-linejoin' => [],
													'class' => [],
													'aria-hidden' => [],
												],
												'rect' => ['width' => [], 'height' => [], 'x' => [], 'y' => [], 'rx' => []],
												'path' => ['d' => []],
												'polyline' => ['points' => []],
												'circle' => ['cx' => [], 'cy' => [], 'r' => []],
											] ); ?>
										</div>
									<?php else : ?>
										<div class="text-<?php echo esc_attr( $item['icon_color'] === 'primary' ? 'primary' : $item['icon_color'] . '-400' ); ?> group-hover:scale-110 transition-transform">
											<?php Icons_Manager::render_icon( $item['category_icon'], [ 'aria-hidden' => 'true', 'class' => 'w-8 h-8' ] ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<h3 class="font-semibold mb-2 group-hover:text-primary transition-colors">
								<?php echo esc_html( $item['category_title'] ); ?>
							</h3>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}