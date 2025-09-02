<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Shipping_Page_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-shipping-page';
	}

	public function get_title(): string {
		return esc_html__( 'Shipping & Payment Page', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-shipping';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'shipping', 'payment', 'delivery', 'slidefire', 'custom', 'commerce' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-shipping-page' ];
	}

	protected function register_controls(): void {

		// Header Content Section
		$this->start_controls_section(
			'header_section',
			[
				'label' => esc_html__( 'Header Content', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'back_button_text',
			[
				'label' => esc_html__( 'Back Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Back to Home',
			]
		);

		$this->add_control(
			'main_title',
			[
				'label' => esc_html__( 'Main Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Shipment &',
			]
		);

		$this->add_control(
			'title_gradient_text',
			[
				'label' => esc_html__( 'Gradient Title Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => ' Payment',
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Everything you need to know about shipping and payment methods for your SlideFirePro gear.',
			]
		);

		$this->end_controls_section();

		// Shipment Section
		$this->start_controls_section(
			'shipment_section',
			[
				'label' => esc_html__( 'Shipment Section', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shipment_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1. Shipment',
			]
		);

		$this->add_control(
			'shipment_badge',
			[
				'label' => esc_html__( 'Badge Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Worldwide Delivery',
			]
		);

		$this->add_control(
			'delivery_method_title',
			[
				'label' => esc_html__( 'Delivery Method Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1.1 Delivery Method',
			]
		);

		$this->add_control(
			'delivery_method_text',
			[
				'label' => esc_html__( 'Delivery Method Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => 'All of our orders are shipped <strong>worldwide</strong>.',
			]
		);

		$this->add_control(
			'delivery_time_title',
			[
				'label' => esc_html__( 'Delivery Time Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1.2 Delivery Time',
			]
		);

		$this->add_control(
			'delivery_time_main',
			[
				'label' => esc_html__( 'Delivery Time Main', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2-3 weeks',
			]
		);

		$this->add_control(
			'delivery_time_note',
			[
				'label' => esc_html__( 'Delivery Time Note', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '(Design time not included)',
			]
		);

		$this->add_control(
			'production_time_text',
			[
				'label' => esc_html__( 'Production Time Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Production time averages 10-12 days.',
			]
		);

		$this->end_controls_section();

		// Payment Section
		$this->start_controls_section(
			'payment_section',
			[
				'label' => esc_html__( 'Payment Section', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'payment_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2. Payment',
			]
		);

		$this->add_control(
			'payment_badge',
			[
				'label' => esc_html__( 'Badge Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Secure Checkout',
			]
		);

		$this->add_control(
			'payment_methods_title',
			[
				'label' => esc_html__( 'Payment Methods Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2.1 Payment Methods',
			]
		);

		$this->add_control(
			'payment_methods_text',
			[
				'label' => esc_html__( 'Payment Methods Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'The following methods are currently available:',
			]
		);

		$this->end_controls_section();

		// Security Section
		$this->start_controls_section(
			'security_section',
			[
				'label' => esc_html__( 'Security Notice', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'security_title',
			[
				'label' => esc_html__( 'Security Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Secure Payment Processing',
			]
		);

		$this->add_control(
			'security_text',
			[
				'label' => esc_html__( 'Security Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'All payments are processed securely using industry-standard encryption. Your payment information is never stored on our servers.',
			]
		);

		$this->end_controls_section();

		// Contact Section
		$this->start_controls_section(
			'contact_section',
			[
				'label' => esc_html__( 'Contact Section', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_title',
			[
				'label' => esc_html__( 'Contact Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Questions?',
			]
		);

		$this->add_control(
			'contact_text',
			[
				'label' => esc_html__( 'Contact Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'If you have any questions please contact us via contact form.',
			]
		);

		$this->add_control(
			'contact_button_text',
			[
				'label' => esc_html__( 'Contact Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Contact Us',
			]
		);

		$this->end_controls_section();

		// Footer Section
		$this->start_controls_section(
			'footer_section',
			[
				'label' => esc_html__( 'Footer Note', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'footer_note',
			[
				'label' => esc_html__( 'Footer Note Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Shipping times may vary during peak seasons or due to custom design complexity. We\'ll keep you updated throughout the process.',
			]
		);

		$this->end_controls_section();

		// Style Sections
		$this->start_controls_section(
			'style_colors_section',
			[
				'label' => esc_html__( 'Colors', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .slidefire-shipping-back-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-shipping-title-gradient' => 'background: linear-gradient(to right, {{VALUE}}, #60A5FA); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;',
					'{{WRAPPER}} .slidefire-shipping-card-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-shipping-item-content h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-shipping-item-content .highlight' => 'color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-contact-btn' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-contact-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .slidefire-shipping-page' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .slidefire-shipping-page' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_background',
			[
				'label' => esc_html__( 'Card Background', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111111',
				'selectors' => [
					'{{WRAPPER}} .slidefire-shipping-card' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-payment-method' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .slidefire-shipping-card' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-shipping-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .slidefire-footer-note' => 'border-color: {{VALUE}};',
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
				'name' => 'main_title_typography',
				'label' => esc_html__( 'Main Title Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .slidefire-shipping-main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .slidefire-shipping-subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_title_typography',
				'label' => esc_html__( 'Section Title Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .slidefire-shipping-card-title',
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		
		if ( empty( $settings['main_title'] ) ) {
			return;
		}
		?>

		<div class="slidefire-shipping-page">
			<div class="slidefire-shipping-container">
				
				<!-- Header -->
				<div class="slidefire-shipping-header">
					<button class="slidefire-shipping-back-btn" onclick="history.back()">
						<svg class="slidefire-shipping-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
						</svg>
						<?php echo esc_html( $settings['back_button_text'] ); ?>
					</button>
					
					<div class="slidefire-shipping-title-wrapper">
						<h1 class="slidefire-shipping-main-title">
							<?php echo esc_html( $settings['main_title'] ); ?>
							<span class="slidefire-shipping-title-gradient"><?php echo esc_html( $settings['title_gradient_text'] ); ?></span>
						</h1>
						<p class="slidefire-shipping-subtitle">
							<?php echo esc_html( $settings['subtitle'] ); ?>
						</p>
					</div>
				</div>

				<!-- Content -->
				<div class="slidefire-shipping-content">
					
					<!-- Shipment Section -->
					<div class="slidefire-shipping-card">
						<div class="slidefire-shipping-card-header">
							<div class="slidefire-shipping-card-icon-wrapper">
								<svg class="slidefire-shipping-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m6.75 4.5v-3a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5v3M6.75 21V3.75a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75V21"></path>
								</svg>
							</div>
							<div>
								<h2 class="slidefire-shipping-card-title"><?php echo esc_html( $settings['shipment_title'] ); ?></h2>
								<span class="slidefire-shipping-badge slidefire-shipping-badge-primary">
									<?php echo esc_html( $settings['shipment_badge'] ); ?>
								</span>
							</div>
						</div>

						<div class="slidefire-shipping-items">
							<!-- Delivery Method -->
							<div class="slidefire-shipping-item">
								<svg class="slidefire-shipping-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3s-4.5 4.03-4.5 9 2.015 9 4.5 9z"></path>
								</svg>
								<div class="slidefire-shipping-item-content">
									<h3><?php echo esc_html( $settings['delivery_method_title'] ); ?></h3>
									<div><?php echo wp_kses_post( $settings['delivery_method_text'] ); ?></div>
								</div>
							</div>

							<!-- Delivery Time -->
							<div class="slidefire-shipping-item">
								<svg class="slidefire-shipping-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
								<div class="slidefire-shipping-item-content">
									<h3><?php echo esc_html( $settings['delivery_time_title'] ); ?></h3>
									<p>
										<span class="highlight"><?php echo esc_html( $settings['delivery_time_main'] ); ?></span>
										<span class="muted"><?php echo esc_html( $settings['delivery_time_note'] ); ?></span>
									</p>
									<p class="small-text">
										Production time averages <span class="highlight">10-12 days</span>.
									</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Payment Section -->
					<div class="slidefire-shipping-card">
						<div class="slidefire-shipping-card-header">
							<div class="slidefire-shipping-card-icon-wrapper">
								<svg class="slidefire-shipping-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
								</svg>
							</div>
							<div>
								<h2 class="slidefire-shipping-card-title"><?php echo esc_html( $settings['payment_title'] ); ?></h2>
								<span class="slidefire-shipping-badge slidefire-shipping-badge-success">
									<?php echo esc_html( $settings['payment_badge'] ); ?>
								</span>
							</div>
						</div>

						<div class="slidefire-shipping-items">
							<div class="slidefire-shipping-item">
								<svg class="slidefire-shipping-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
								</svg>
								<div class="slidefire-shipping-item-content" style="flex: 1;">
									<h3><?php echo esc_html( $settings['payment_methods_title'] ); ?></h3>
									<p style="margin-bottom: 1rem;"><?php echo esc_html( $settings['payment_methods_text'] ); ?></p>
									
									<!-- Payment Method Cards -->
									<div class="slidefire-payment-methods-grid">
										<!-- Visa -->
										<div class="slidefire-payment-method">
											<div class="slidefire-payment-icon visa">
												VISA
											</div>
											<div class="slidefire-payment-info">
												<h4>Visa</h4>
												<p>Credit & Debit</p>
											</div>
											<svg class="slidefire-payment-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
										</div>

										<!-- Mastercard -->
										<div class="slidefire-payment-method">
											<div class="slidefire-payment-icon mastercard">
												<div class="slidefire-mastercard-circles">
													<div class="slidefire-mastercard-circle"></div>
													<div class="slidefire-mastercard-circle"></div>
												</div>
											</div>
											<div class="slidefire-payment-info">
												<h4>Mastercard</h4>
												<p>Credit & Debit</p>
											</div>
											<svg class="slidefire-payment-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
										</div>

										<!-- PayPal -->
										<div class="slidefire-payment-method">
											<div class="slidefire-payment-icon paypal">
												PP
											</div>
											<div class="slidefire-payment-info">
												<h4>PayPal</h4>
												<p>Digital Wallet</p>
											</div>
											<svg class="slidefire-payment-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Security Notice -->
					<div class="slidefire-shipping-card slidefire-security-notice">
						<div class="slidefire-shipping-card-header">
							<div class="slidefire-shipping-card-icon-wrapper">
								<svg class="slidefire-shipping-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
							</div>
							<div>
								<h3 class="slidefire-shipping-card-title"><?php echo esc_html( $settings['security_title'] ); ?></h3>
								<p style="margin: 0; color: var(--muted-foreground, #888888);">
									<?php echo esc_html( $settings['security_text'] ); ?>
								</p>
							</div>
						</div>
					</div>

					<!-- Contact Section -->
					<div class="slidefire-shipping-card slidefire-contact-card">
						<div class="slidefire-contact-icon-wrapper">
							<svg class="slidefire-contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
							</svg>
						</div>
						<h2 class="slidefire-contact-title"><?php echo esc_html( $settings['contact_title'] ); ?></h2>
						<p class="slidefire-contact-description">
							<?php echo esc_html( $settings['contact_text'] ); ?>
						</p>
						<button class="slidefire-contact-btn">
							<?php echo esc_html( $settings['contact_button_text'] ); ?>
						</button>
					</div>

					<!-- Footer Note -->
					<div class="slidefire-footer-note">
						<p><?php echo esc_html( $settings['footer_note'] ); ?></p>
					</div>

				</div>
			</div>
		</div>

		<?php
	}

	protected function content_template(): void {
		?>
		<div class="slidefire-shipping-page">
			<div class="slidefire-shipping-container">
				
				<!-- Header -->
				<div class="slidefire-shipping-header">
					<button class="slidefire-shipping-back-btn">
						<svg class="slidefire-shipping-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
						</svg>
						{{{ settings.back_button_text }}}
					</button>
					
					<div class="slidefire-shipping-title-wrapper">
						<h1 class="slidefire-shipping-main-title">
							{{{ settings.main_title }}}
							<span class="slidefire-shipping-title-gradient">{{{ settings.title_gradient_text }}}</span>
						</h1>
						<p class="slidefire-shipping-subtitle">
							{{{ settings.subtitle }}}
						</p>
					</div>
				</div>

				<!-- Content -->
				<div class="slidefire-shipping-content">
					
					<!-- Shipment Section -->
					<div class="slidefire-shipping-card">
						<div class="slidefire-shipping-card-header">
							<div class="slidefire-shipping-card-icon-wrapper">
								<svg class="slidefire-shipping-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m6.75 4.5v-3a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5v3M6.75 21V3.75a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75V21"></path>
								</svg>
							</div>
							<div>
								<h2 class="slidefire-shipping-card-title">{{{ settings.shipment_title }}}</h2>
								<span class="slidefire-shipping-badge slidefire-shipping-badge-primary">
									{{{ settings.shipment_badge }}}
								</span>
							</div>
						</div>

						<div class="slidefire-shipping-items">
							<!-- Delivery Method -->
							<div class="slidefire-shipping-item">
								<svg class="slidefire-shipping-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3s-4.5 4.03-4.5 9 2.015 9 4.5 9z"></path>
								</svg>
								<div class="slidefire-shipping-item-content">
									<h3>{{{ settings.delivery_method_title }}}</h3>
									<div>{{{ settings.delivery_method_text }}}</div>
								</div>
							</div>

							<!-- Delivery Time -->
							<div class="slidefire-shipping-item">
								<svg class="slidefire-shipping-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
								<div class="slidefire-shipping-item-content">
									<h3>{{{ settings.delivery_time_title }}}</h3>
									<p>
										<span class="highlight">{{{ settings.delivery_time_main }}}</span>
										<span class="muted">{{{ settings.delivery_time_note }}}</span>
									</p>
									<p class="small-text">
										{{{ settings.production_time_text }}}
									</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Payment Section -->
					<div class="slidefire-shipping-card">
						<div class="slidefire-shipping-card-header">
							<div class="slidefire-shipping-card-icon-wrapper">
								<svg class="slidefire-shipping-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
								</svg>
							</div>
							<div>
								<h2 class="slidefire-shipping-card-title">{{{ settings.payment_title }}}</h2>
								<span class="slidefire-shipping-badge slidefire-shipping-badge-success">
									{{{ settings.payment_badge }}}
								</span>
							</div>
						</div>

						<div class="slidefire-shipping-items">
							<div class="slidefire-shipping-item">
								<svg class="slidefire-shipping-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
								</svg>
								<div class="slidefire-shipping-item-content" style="flex: 1;">
									<h3>{{{ settings.payment_methods_title }}}</h3>
									<p style="margin-bottom: 1rem;">{{{ settings.payment_methods_text }}}</p>
									
									<!-- Payment Method Cards -->
									<div class="slidefire-payment-methods-grid">
										<!-- Visa -->
										<div class="slidefire-payment-method">
											<div class="slidefire-payment-icon visa">VISA</div>
											<div class="slidefire-payment-info">
												<h4>Visa</h4>
												<p>Credit & Debit</p>
											</div>
											<svg class="slidefire-payment-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
										</div>

										<!-- Mastercard -->
										<div class="slidefire-payment-method">
											<div class="slidefire-payment-icon mastercard">
												<div class="slidefire-mastercard-circles">
													<div class="slidefire-mastercard-circle"></div>
													<div class="slidefire-mastercard-circle"></div>
												</div>
											</div>
											<div class="slidefire-payment-info">
												<h4>Mastercard</h4>
												<p>Credit & Debit</p>
											</div>
											<svg class="slidefire-payment-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
										</div>

										<!-- PayPal -->
										<div class="slidefire-payment-method">
											<div class="slidefire-payment-icon paypal">PP</div>
											<div class="slidefire-payment-info">
												<h4>PayPal</h4>
												<p>Digital Wallet</p>
											</div>
											<svg class="slidefire-payment-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Security Notice -->
					<div class="slidefire-shipping-card slidefire-security-notice">
						<div class="slidefire-shipping-card-header">
							<div class="slidefire-shipping-card-icon-wrapper">
								<svg class="slidefire-shipping-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
							</div>
							<div>
								<h3 class="slidefire-shipping-card-title">{{{ settings.security_title }}}</h3>
								<p style="margin: 0; color: var(--muted-foreground, #888888);">
									{{{ settings.security_text }}}
								</p>
							</div>
						</div>
					</div>

					<!-- Contact Section -->
					<div class="slidefire-shipping-card slidefire-contact-card">
						<div class="slidefire-contact-icon-wrapper">
							<svg class="slidefire-contact-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
							</svg>
						</div>
						<h2 class="slidefire-contact-title">{{{ settings.contact_title }}}</h2>
						<p class="slidefire-contact-description">
							{{{ settings.contact_text }}}
						</p>
						<button class="slidefire-contact-btn">
							{{{ settings.contact_button_text }}}
						</button>
					</div>

					<!-- Footer Note -->
					<div class="slidefire-footer-note">
						<p>{{{ settings.footer_note }}}</p>
					</div>

				</div>
			</div>
		</div>
		<?php
	}
}