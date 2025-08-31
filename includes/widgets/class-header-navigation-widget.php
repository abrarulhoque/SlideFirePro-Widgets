<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Header_Navigation_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-header-navigation';
	}

	public function get_title(): string {
		return esc_html__( 'Header Navigation', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-nav-menu';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'header', 'navigation', 'nav', 'menu', 'logo', 'search' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-header-navigation' ];
	}

	public function get_script_depends(): array {
		return [ 'slidefirePro-header-navigation' ];
	}

	protected function register_controls(): void {

		// Logo Section
		$this->start_controls_section(
			'logo_section',
			[
				'label' => esc_html__( 'Logo', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label' => esc_html__( 'Logo Image', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__( 'Logo Width', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 300,
					],
					'%' => [
						'min' => 5,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 48,
				],
				'selectors' => [
					'{{WRAPPER}} .header-logo-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_height',
			[
				'label' => esc_html__( 'Logo Height', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 48,
				],
				'selectors' => [
					'{{WRAPPER}} .header-logo-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'site_title',
			[
				'label' => esc_html__( 'Site Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'SLIDEFIRE',
				'placeholder' => esc_html__( 'Enter site title', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'site_tagline',
			[
				'label' => esc_html__( 'Site Tagline', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'PRO',
				'placeholder' => esc_html__( 'Enter tagline', 'slidefirePro-widgets' ),
			]
		);

		$this->end_controls_section();

		// Navigation Menu Section
		$this->start_controls_section(
			'menu_section',
			[
				'label' => esc_html__( 'Navigation Menu', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$menus = $this->get_available_menus();
		
		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => esc_html__( 'Menu', 'slidefirePro-widgets' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf(
						/* translators: 1: Link opening tag, 2: Link closing tag. */
						esc_html__( 'Go to the %1$sMenus screen%2$s to manage your menus.', 'slidefirePro-widgets' ),
						sprintf( '<a href="%s" target="_blank">', admin_url( 'nav-menus.php' ) ),
						'</a>'
					),
				]
			);
		} else {
			$this->add_control(
				'menu_alert',
				[
					'type' => Controls_Manager::ALERT,
					'alert_type' => 'info',
					'heading' => esc_html__( 'There are no menus in your site.', 'slidefirePro-widgets' ),
					'content' => sprintf(
						/* translators: 1: Link opening tag, 2: Link closing tag. */
						esc_html__( 'Go to the %1$sMenus screen%2$s to create one.', 'slidefirePro-widgets' ),
						sprintf( '<a href="%s" target="_blank">', admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
						'</a>'
					),
					'separator' => 'after',
				]
			);
		}

		$this->end_controls_section();

		// Search Section
		$this->start_controls_section(
			'search_section',
			[
				'label' => esc_html__( 'Search', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_search',
			[
				'label' => esc_html__( 'Show Search', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'search_placeholder',
			[
				'label' => esc_html__( 'Search Placeholder', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Search designs...',
				'condition' => [
					'show_search' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Social & Actions Section
		$this->start_controls_section(
			'actions_section',
			[
				'label' => esc_html__( 'Social & Actions', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'instagram_url',
			[
				'label' => esc_html__( 'Instagram URL', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://instagram.com/slidefirepro',
				'default' => [
					'url' => 'https://instagram.com/slidefirepro',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'show_my_account',
			[
				'label' => esc_html__( 'Show My Account', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_cart',
			[
				'label' => esc_html__( 'Show Cart', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Style Section - Header
		$this->start_controls_section(
			'header_style_section',
			[
				'label' => esc_html__( 'Header Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_background_color',
			[
				'label' => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slidefire-header' => 'background-color: {{VALUE}};',
				],
				'default' => 'rgba(0, 0, 0, 0.8)',
			]
		);

		$this->add_responsive_control(
			'header_height',
			[
				'label' => esc_html__( 'Header Height', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 60,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .slidefire-header .container' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'label' => esc_html__( 'Border', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .slidefire-header',
			]
		);

		$this->end_controls_section();

		// Style Section - Logo
		$this->start_controls_section(
			'logo_style_section',
			[
				'label' => esc_html__( 'Logo Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'site_title_typography',
				'label' => esc_html__( 'Title Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .header-logo-title',
			]
		);

		$this->add_control(
			'site_title_color',
			[
				'label' => esc_html__( 'Title Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-logo-title' => 'color: {{VALUE}};',
				],
				'default' => '#23B2EE',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'site_tagline_typography',
				'label' => esc_html__( 'Tagline Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .header-logo-tagline',
			]
		);

		$this->add_control(
			'site_tagline_color',
			[
				'label' => esc_html__( 'Tagline Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-logo-tagline' => 'color: {{VALUE}};',
				],
				'default' => '#888888',
			]
		);

		$this->end_controls_section();

		// Style Section - Navigation
		$this->start_controls_section(
			'nav_style_section',
			[
				'label' => esc_html__( 'Navigation Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_typography',
				'label' => esc_html__( 'Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .slidefire-nav-menu a',
			]
		);

		$this->add_control(
			'nav_text_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slidefire-nav-menu a' => 'color: {{VALUE}};',
				],
				'default' => '#ffffff',
			]
		);

		$this->add_control(
			'nav_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slidefire-nav-menu a:hover' => 'color: {{VALUE}};',
				],
				'default' => '#23B2EE',
			]
		);

		$this->end_controls_section();
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		?>
		<header class="slidefire-header border-b border-border bg-background/80 backdrop-blur-md sticky top-0 z-50">
			<div class="container mx-auto px-4 py-4">
				<div class="flex items-center justify-between">
					
					<!-- Mobile Menu Button -->
					<button class="slidefire-mobile-menu-btn md:hidden" aria-label="<?php esc_attr_e( 'Toggle menu', 'slidefirePro-widgets' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5" aria-hidden="true">
							<path d="M4 12h16"></path>
							<path d="M4 18h16"></path>
							<path d="M4 6h16"></path>
						</svg>
					</button>

					<!-- Logo Section -->
					<div class="slidefire-logo-wrapper">
						<div class="slidefire-logo-content">
							<?php if ( ! empty( $settings['logo_image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $settings['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['site_title'] ); ?>" class="header-logo-image">
							<?php else : ?>
								<!-- Default SVG Logo -->
								<svg class="header-logo-image" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="2" y="2" width="44" height="44" rx="8" stroke="currentColor" stroke-width="1.5" class="text-border"></rect>
									<rect x="6" y="6" width="36" height="36" rx="4" fill="currentColor" class="text-secondary"></rect>
									<path d="M24 12L32 20L28 24L32 28L24 36L16 28L20 24L16 20L24 12Z" fill="currentColor" class="text-primary"></path>
									<path d="M10 16L14 16M10 20L16 20M10 24L14 24M10 28L16 28M10 32L14 32" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-primary/60"></path>
									<path d="M34 16L38 16M32 20L38 20M34 24L38 24M32 28L38 28M34 32L38 32" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-primary/60"></path>
									<circle cx="8" cy="8" r="1.5" fill="currentColor" class="text-primary"></circle>
									<circle cx="40" cy="8" r="1.5" fill="currentColor" class="text-primary"></circle>
									<circle cx="8" cy="40" r="1.5" fill="currentColor" class="text-primary"></circle>
									<circle cx="40" cy="40" r="1.5" fill="currentColor" class="text-primary"></circle>
								</svg>
							<?php endif; ?>

							<div class="slidefire-logo-text">
								<?php if ( ! empty( $settings['site_title'] ) ) : ?>
									<div class="header-logo-title"><?php echo esc_html( $settings['site_title'] ); ?></div>
								<?php endif; ?>
								<?php if ( ! empty( $settings['site_tagline'] ) ) : ?>
									<div class="header-logo-tagline"><?php echo esc_html( $settings['site_tagline'] ); ?></div>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<!-- Navigation Menu -->
					<nav class="slidefire-nav-menu hidden md:flex">
						<?php
						if ( ! empty( $settings['menu'] ) ) {
							wp_nav_menu( [
								'menu' => $settings['menu'],
								'menu_class' => 'slidefire-menu-items',
								'container' => false,
								'theme_location' => '',
								'fallback_cb' => false,
							] );
						}
						?>
					</nav>

					<!-- Search Bar -->
					<?php if ( 'yes' === $settings['show_search'] ) : ?>
						<div class="slidefire-search-wrapper hidden md:flex">
							<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="slidefire-search-form">
								<div class="slidefire-search-input-wrapper">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="slidefire-search-icon" aria-hidden="true">
										<path d="m21 21-4.34-4.34"></path>
										<circle cx="11" cy="11" r="8"></circle>
									</svg>
									<input type="search" name="s" class="slidefire-search-input" placeholder="<?php echo esc_attr( $settings['search_placeholder'] ); ?>" value="<?php echo get_search_query(); ?>">
								</div>
							</form>
						</div>
					<?php endif; ?>

					<!-- Action Icons -->
					<div class="slidefire-header-actions">
						
						<!-- Mobile Search Button -->
						<?php if ( 'yes' === $settings['show_search'] ) : ?>
							<button class="slidefire-mobile-search-btn md:hidden" aria-label="<?php esc_attr_e( 'Search', 'slidefirePro-widgets' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5" aria-hidden="true">
									<path d="m21 21-4.34-4.34"></path>
									<circle cx="11" cy="11" r="8"></circle>
								</svg>
							</button>
						<?php endif; ?>

						<!-- Instagram Link -->
						<?php if ( ! empty( $settings['instagram_url']['url'] ) ) : ?>
							<a href="<?php echo esc_url( $settings['instagram_url']['url'] ); ?>" 
							   target="_blank" 
							   rel="noopener noreferrer" 
							   class="slidefire-instagram-link"
							   title="<?php esc_attr_e( 'Follow us on Instagram', 'slidefirePro-widgets' ); ?>">
								<div class="slidefire-instagram-icon">
									<div class="slidefire-instagram-glow"></div>
									<div class="slidefire-instagram-bg">
										<div class="slidefire-instagram-effects">
											<div class="instagram-effect instagram-ping"></div>
											<div class="instagram-effect instagram-pulse"></div>
											<div class="instagram-effect instagram-bounce"></div>
										</div>
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="instagram-svg" aria-hidden="true">
											<rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
											<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
											<line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
										</svg>
									</div>
									<div class="slidefire-instagram-shine"></div>
									<div class="slidefire-instagram-border"></div>
								</div>
							</a>
						<?php endif; ?>

						<!-- My Account -->
						<?php if ( 'yes' === $settings['show_my_account'] && class_exists( 'WooCommerce' ) ) : ?>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="slidefire-my-account-btn" title="<?php esc_attr_e( 'My Account', 'slidefirePro-widgets' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5" aria-hidden="true">
									<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
									<circle cx="12" cy="7" r="4"></circle>
								</svg>
							</a>
						<?php endif; ?>

						<!-- Cart -->
						<?php if ( 'yes' === $settings['show_cart'] && class_exists( 'WooCommerce' ) ) : ?>
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="slidefire-cart-btn" title="<?php esc_attr_e( 'View cart', 'slidefirePro-widgets' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5" aria-hidden="true">
									<circle cx="8" cy="21" r="1"></circle>
									<circle cx="19" cy="21" r="1"></circle>
									<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
								</svg>
								<?php
								$cart_count = WC()->cart->get_cart_contents_count();
								if ( $cart_count > 0 ) :
								?>
									<span class="slidefire-cart-count"><?php echo esc_html( $cart_count ); ?></span>
								<?php endif; ?>
							</a>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</header>
		<?php
	}
}