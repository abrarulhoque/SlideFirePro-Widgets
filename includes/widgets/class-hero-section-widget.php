<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Hero_Section_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-hero-section';
	}

	public function get_title(): string {
		return esc_html__( 'Hero Section', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-header';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'hero', 'banner', 'header', 'slidefire', 'custom', 'apparel' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-hero-section' ];
	}

	protected function register_controls(): void {

		// Content Section
		$this->start_controls_section(
			'hero_content_section',
			[
				'label' => esc_html__( 'Hero Content', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hero_badge_icon',
			[
				'label' => esc_html__( 'Badge Icon', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-bolt',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'hero_badge_text',
			[
				'label' => esc_html__( 'Badge Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Custom Speedsoft, Airsoft & SpeedQB Apparel', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Enter badge text', 'slidefirePro-widgets' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_title',
			[
				'label' => esc_html__( 'Hero Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'STYLE, COMFORT, PROTECTION', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Enter your title', 'slidefirePro-widgets' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_description',
			[
				'label' => esc_html__( 'Description', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'When it comes to SpeedSoft and Airsoft apparel, SlideFirePro stands apart as the ultimate choice for players who demand nothing but the best.', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Enter description', 'slidefirePro-widgets' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__( 'Hero Image', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->end_controls_section();

		// Buttons Section
		$this->start_controls_section(
			'hero_buttons_section',
			[
				'label' => esc_html__( 'Buttons', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'primary_button_text',
			[
				'label' => esc_html__( 'Primary Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Start Custom Design', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'primary_button_link',
			[
				'label' => esc_html__( 'Primary Button Link', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'secondary_button_text',
			[
				'label' => esc_html__( 'Secondary Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'View Portfolio', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'secondary_button_link',
			[
				'label' => esc_html__( 'Secondary Button Link', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'slidefirePro-widgets' ),
			]
		);

		$this->end_controls_section();

		// Teams Section
		$this->start_controls_section(
			'teams_section',
			[
				'label' => esc_html__( 'Teams Scroll', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'teams_title',
			[
				'label' => esc_html__( 'Teams Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Custom Teams from Around the World', 'slidefirePro-widgets' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'team_icon',
			[
				'label' => esc_html__( 'Team Icon', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-shield',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'team_name',
			[
				'label' => esc_html__( 'Team Name', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Team Name', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
			]
		);

		$this->add_control(
			'teams_list',
			[
				'label' => esc_html__( 'Teams', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'team_name' => esc_html__( 'Alpha Squad', 'slidefirePro-widgets' ),
						'icon_color' => '#23B2EE',
					],
					[
						'team_name' => esc_html__( 'Phoenix Gaming', 'slidefirePro-widgets' ),
						'icon_color' => '#fb923c',
					],
					[
						'team_name' => esc_html__( 'Elite Force', 'slidefirePro-widgets' ),
						'icon_color' => '#60a5fa',
					],
					[
						'team_name' => esc_html__( 'Tactical Unit', 'slidefirePro-widgets' ),
						'icon_color' => '#facc15',
					],
					[
						'team_name' => esc_html__( 'Viper Squadron', 'slidefirePro-widgets' ),
						'icon_color' => '#c084fc',
					],
				],
				'title_field' => '{{{ team_name }}}',
			]
		);

		$this->end_controls_section();

		// Particles Section
		$this->start_controls_section(
			'particles_section',
			[
				'label' => esc_html__( 'Floating Particles', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_particles',
			[
				'label' => esc_html__( 'Enable Particles', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Style Section - Hero
		$this->start_controls_section(
			'hero_style_section',
			[
				'label' => esc_html__( 'Hero Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'hero_min_height',
			[
				'label' => esc_html__( 'Minimum Height', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh', '%' ],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1200,
					],
					'vh' => [
						'min' => 30,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 65,
				],
				'selectors' => [
					'{{WRAPPER}} .hero-section' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hero_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .hero-bg-main',
			]
		);

		$this->end_controls_section();

		// Badge Style Section
		$this->start_controls_section(
			'badge_style_section',
			[
				'label' => esc_html__( 'Badge Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'badge_text_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .hero-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .hero-badge i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .hero-badge svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Style Section
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Title Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .hero-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .hero-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Description Style Section
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__( 'Description Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .hero-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#888888',
				'selectors' => [
					'{{WRAPPER}} .hero-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Buttons Style Section
		$this->start_controls_section(
			'buttons_style_section',
			[
				'label' => esc_html__( 'Buttons Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_button_bg',
			[
				'label' => esc_html__( 'Primary Button Background', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .hero-btn-primary' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'primary_button_color',
			[
				'label' => esc_html__( 'Primary Button Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .hero-btn-primary' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_button_border',
			[
				'label' => esc_html__( 'Secondary Button Border', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .hero-btn-secondary' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_button_color',
			[
				'label' => esc_html__( 'Secondary Button Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .hero-btn-secondary' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Teams Style Section
		$this->start_controls_section(
			'teams_style_section',
			[
				'label' => esc_html__( 'Teams Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'teams_title_typography',
				'label' => esc_html__( 'Title Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .teams-title',
			]
		);

		$this->add_control(
			'teams_card_bg',
			[
				'label' => esc_html__( 'Card Background', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111111',
				'selectors' => [
					'{{WRAPPER}} .team-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'teams_card_border',
			[
				'label' => esc_html__( 'Card Border', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .team-card' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$primary_button_target = $settings['primary_button_link']['is_external'] ? ' target="_blank"' : '';
		$primary_button_nofollow = $settings['primary_button_link']['nofollow'] ? ' rel="nofollow"' : '';
		$secondary_button_target = $settings['secondary_button_link']['is_external'] ? ' target="_blank"' : '';
		$secondary_button_nofollow = $settings['secondary_button_link']['nofollow'] ? ' rel="nofollow"' : '';
		?>

		<section class="hero-section">
			<!-- Full Background Gradient -->
			<div class="hero-bg-wrapper">
				<div class="hero-bg-main"></div>
				<div class="hero-bg-gradient-1"></div>
				<div class="hero-bg-gradient-2"></div>
			</div>

			<?php if ( 'yes' === $settings['enable_particles'] ) : ?>
			<!-- Particle Effects -->
			<div class="hero-particles">
				<!-- Large particles -->
				<div class="hero-dot hero-dot-1"></div>
				<div class="hero-dot hero-dot-2"></div>
				<div class="hero-dot hero-dot-3"></div>
				<div class="hero-dot hero-dot-4"></div>
				<div class="hero-dot hero-dot-5"></div>
				
				<!-- Medium particles -->
				<div class="hero-dot hero-dot-6"></div>
				<div class="hero-dot hero-dot-7"></div>
				<div class="hero-dot hero-dot-8"></div>
				<div class="hero-dot hero-dot-9"></div>
				
				<!-- Small particles -->
				<div class="hero-dot hero-dot-10"></div>
				<div class="hero-dot hero-dot-11"></div>
				<div class="hero-dot hero-dot-12"></div>
				<div class="hero-dot hero-dot-13"></div>
				<div class="hero-dot hero-dot-14"></div>
				
				<!-- Extra floating particles -->
				<div class="hero-dot hero-dot-15"></div>
				<div class="hero-dot hero-dot-16"></div>
				<div class="hero-dot hero-dot-17"></div>
			</div>
			<?php endif; ?>

			<!-- Content -->
			<div class="hero-container">
				<div class="hero-grid">
					<!-- Left side - Text content -->
					<div class="hero-content">
						<?php if ( $settings['hero_badge_text'] || $settings['hero_badge_icon']['value'] ) : ?>
						<div class="hero-badge">
							<?php if ( $settings['hero_badge_icon']['value'] ) : ?>
								<?php Icons_Manager::render_icon( $settings['hero_badge_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							<?php endif; ?>
							<span><?php echo esc_html( $settings['hero_badge_text'] ); ?></span>
						</div>
						<?php endif; ?>
						
						<?php if ( $settings['hero_title'] ) : ?>
						<h1 class="hero-title">
							<?php echo esc_html( $settings['hero_title'] ); ?>
						</h1>
						<?php endif; ?>
						
						<?php if ( $settings['hero_description'] ) : ?>
						<p class="hero-description">
							<?php echo esc_html( $settings['hero_description'] ); ?>
						</p>
						<?php endif; ?>

						<!-- Mobile Jersey Image - appears between text and buttons -->
						<?php if ( $settings['hero_image']['url'] ) : ?>
						<div class="hero-image-mobile">
							<div class="hero-image-card">
								<div class="hero-image-gradient"></div>
								<div class="hero-image-wrapper">
									<img src="<?php echo esc_url( $settings['hero_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['hero_title'] ); ?>" class="hero-image">
								</div>
								<div class="hero-image-dot-1"></div>
								<div class="hero-image-dot-2"></div>
							</div>
						</div>
						<?php endif; ?>
						
						<div class="hero-buttons">
							<?php if ( $settings['primary_button_text'] ) : ?>
							<a href="<?php echo esc_url( $settings['primary_button_link']['url'] ); ?>"<?php echo $primary_button_target; ?><?php echo $primary_button_nofollow; ?> class="hero-btn hero-btn-primary">
								<?php echo esc_html( $settings['primary_button_text'] ); ?>
								<svg class="hero-btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M5 12h14m-7-7 7 7-7 7"/>
								</svg>
							</a>
							<?php endif; ?>
							
							<?php if ( $settings['secondary_button_text'] ) : ?>
							<a href="<?php echo esc_url( $settings['secondary_button_link']['url'] ); ?>"<?php echo $secondary_button_target; ?><?php echo $secondary_button_nofollow; ?> class="hero-btn hero-btn-secondary">
								<?php echo esc_html( $settings['secondary_button_text'] ); ?>
							</a>
							<?php endif; ?>
						</div>

						<!-- Custom Teams Section -->
						<?php if ( $settings['teams_title'] || $settings['teams_list'] ) : ?>
						<div class="teams-section">
							<?php if ( $settings['teams_title'] ) : ?>
							<h3 class="teams-title">
								<?php echo esc_html( $settings['teams_title'] ); ?>
							</h3>
							<?php endif; ?>
							
							<!-- Scrolling Icons -->
							<?php if ( $settings['teams_list'] ) : ?>
							<div class="teams-scroll-container">
								<div class="teams-scroll-wrapper">
									<?php 
									// Duplicate the items for infinite scroll effect
									$teams_items = array_merge( $settings['teams_list'], $settings['teams_list'] );
									foreach ( $teams_items as $index => $item ) : ?>
									<div class="team-card">
										<?php if ( $item['team_icon']['value'] ) : ?>
											<?php Icons_Manager::render_icon( $item['team_icon'], [ 
												'aria-hidden' => 'true',
												'style' => 'color: ' . esc_attr( $item['icon_color'] ) . ';'
											] ); ?>
										<?php endif; ?>
									</div>
									<?php endforeach; ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>

					<!-- Right side - Jersey Image - hidden on mobile -->
					<?php if ( $settings['hero_image']['url'] ) : ?>
					<div class="hero-image-desktop">
						<div class="hero-image-card">
							<div class="hero-image-gradient"></div>
							<div class="hero-image-wrapper">
								<img src="<?php echo esc_url( $settings['hero_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['hero_title'] ); ?>" class="hero-image">
							</div>
							
							<!-- Decorative elements -->
							<div class="hero-image-dot-1"></div>
							<div class="hero-image-dot-2"></div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Animated elements -->
			<div class="hero-animated-dot hero-animated-dot-1"></div>
			<div class="hero-animated-dot hero-animated-dot-2"></div>
			<div class="hero-animated-dot hero-animated-dot-3"></div>
		</section>
		<?php
	}
}