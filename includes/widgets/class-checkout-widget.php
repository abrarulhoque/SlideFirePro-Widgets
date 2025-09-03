<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Checkout_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-checkout';
	}

	public function get_title(): string {
		return esc_html__( 'Checkout', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-checkout';
	}

	public function get_categories(): array {
		return [ 'woocommerce-elements' ];
	}

	public function get_keywords(): array {
		return [ 'woocommerce', 'checkout', 'order', 'payment', 'billing', 'shipping' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-checkout', 'select2' ];
	}

	public function get_script_depends(): array {
		return [ 'wc-checkout', 'wc-password-strength-meter', 'selectWoo' ];
	}

	protected function register_controls(): void {

		// Layout Section
		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'checkout_layout',
			[
				'label' => esc_html__( 'Layout', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'two-column' => esc_html__( 'Two Column', 'slidefirePro-widgets' ),
					'one-column' => esc_html__( 'One Column', 'slidefirePro-widgets' ),
				],
				'default' => 'two-column',
				'prefix_class' => 'e-checkout-layout-',
			]
		);

		$this->add_control(
			'sticky_right_column',
			[
				'label' => esc_html__( 'Sticky Right Column', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'checkout_layout' => 'two-column',
				],
			]
		);

		$this->add_control(
			'sticky_right_column_offset',
			[
				'label' => esc_html__( 'Sticky Offset', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'condition' => [
					'checkout_layout' => 'two-column',
					'sticky_right_column' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Returning Customer Section
		$this->start_controls_section(
			'returning_customer_section',
			[
				'label' => esc_html__( 'Returning Customer', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_login_section',
			[
				'label' => esc_html__( 'Show Login Section', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'login_title',
			[
				'label' => esc_html__( 'Login Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Returning customer?', 'slidefirePro-widgets' ),
				'condition' => [
					'show_login_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'login_description',
			[
				'label' => esc_html__( 'Login Description', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'If you have shopped with us before, please enter your details below.', 'slidefirePro-widgets' ),
				'condition' => [
					'show_login_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'login_button_text',
			[
				'label' => esc_html__( 'Login Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click here to login', 'slidefirePro-widgets' ),
				'condition' => [
					'show_login_section' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Coupon Section
		$this->start_controls_section(
			'coupon_section',
			[
				'label' => esc_html__( 'Coupon', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_coupon_section',
			[
				'label' => esc_html__( 'Show Coupon Section', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'coupon_label',
			[
				'label' => esc_html__( 'Coupon Label', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Have a coupon?', 'slidefirePro-widgets' ),
				'condition' => [
					'show_coupon_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'coupon_button_text',
			[
				'label' => esc_html__( 'Apply Coupon Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Apply coupon', 'slidefirePro-widgets' ),
				'condition' => [
					'show_coupon_section' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Billing Details Section
		$this->start_controls_section(
			'billing_section',
			[
				'label' => esc_html__( 'Billing Details', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'billing_section_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Billing details', 'slidefirePro-widgets' ),
			]
		);

		// Billing Field Overrides Repeater
		$billing_repeater = new Repeater();

		$billing_repeater->add_control(
			'field_key',
			[
				'label' => esc_html__( 'Field', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'billing_first_name' => esc_html__( 'First Name', 'slidefirePro-widgets' ),
					'billing_last_name' => esc_html__( 'Last Name', 'slidefirePro-widgets' ),
					'billing_company' => esc_html__( 'Company', 'slidefirePro-widgets' ),
					'billing_country' => esc_html__( 'Country', 'slidefirePro-widgets' ),
					'billing_address_1' => esc_html__( 'Street Address', 'slidefirePro-widgets' ),
					'billing_address_2' => esc_html__( 'Apartment/Suite', 'slidefirePro-widgets' ),
					'billing_city' => esc_html__( 'City', 'slidefirePro-widgets' ),
					'billing_state' => esc_html__( 'State', 'slidefirePro-widgets' ),
					'billing_postcode' => esc_html__( 'Postcode', 'slidefirePro-widgets' ),
					'billing_phone' => esc_html__( 'Phone', 'slidefirePro-widgets' ),
					'billing_email' => esc_html__( 'Email', 'slidefirePro-widgets' ),
				],
				'default' => 'billing_first_name',
			]
		);

		$billing_repeater->add_control(
			'field_label',
			[
				'label' => esc_html__( 'Label', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$billing_repeater->add_control(
			'field_placeholder',
			[
				'label' => esc_html__( 'Placeholder', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'billing_field_overrides',
			[
				'label' => esc_html__( 'Field Overrides', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $billing_repeater->get_controls(),
				'title_field' => '{{{ field_label || field_key }}}',
			]
		);

		$this->end_controls_section();

		// Shipping Address Section
		$this->start_controls_section(
			'shipping_section',
			[
				'label' => esc_html__( 'Shipping Address', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shipping_section_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Ship to a different address?', 'slidefirePro-widgets' ),
			]
		);

		// Shipping Field Overrides Repeater
		$shipping_repeater = new Repeater();

		$shipping_repeater->add_control(
			'field_key',
			[
				'label' => esc_html__( 'Field', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'shipping_first_name' => esc_html__( 'First Name', 'slidefirePro-widgets' ),
					'shipping_last_name' => esc_html__( 'Last Name', 'slidefirePro-widgets' ),
					'shipping_company' => esc_html__( 'Company', 'slidefirePro-widgets' ),
					'shipping_country' => esc_html__( 'Country', 'slidefirePro-widgets' ),
					'shipping_address_1' => esc_html__( 'Street Address', 'slidefirePro-widgets' ),
					'shipping_address_2' => esc_html__( 'Apartment/Suite', 'slidefirePro-widgets' ),
					'shipping_city' => esc_html__( 'City', 'slidefirePro-widgets' ),
					'shipping_state' => esc_html__( 'State', 'slidefirePro-widgets' ),
					'shipping_postcode' => esc_html__( 'Postcode', 'slidefirePro-widgets' ),
				],
				'default' => 'shipping_first_name',
			]
		);

		$shipping_repeater->add_control(
			'field_label',
			[
				'label' => esc_html__( 'Label', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$shipping_repeater->add_control(
			'field_placeholder',
			[
				'label' => esc_html__( 'Placeholder', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'shipping_field_overrides',
			[
				'label' => esc_html__( 'Field Overrides', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $shipping_repeater->get_controls(),
				'title_field' => '{{{ field_label || field_key }}}',
			]
		);

		$this->end_controls_section();

		// Additional Information Section
		$this->start_controls_section(
			'additional_info_section',
			[
				'label' => esc_html__( 'Additional Information', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_additional_info',
			[
				'label' => esc_html__( 'Show Additional Information', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'additional_info_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Additional information', 'slidefirePro-widgets' ),
				'condition' => [
					'show_additional_info' => 'yes',
				],
			]
		);

		$this->add_control(
			'order_notes_placeholder',
			[
				'label' => esc_html__( 'Order Notes Placeholder', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Notes about your order, e.g. special notes for delivery.', 'slidefirePro-widgets' ),
				'condition' => [
					'show_additional_info' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Order Summary Section
		$this->start_controls_section(
			'order_summary_section',
			[
				'label' => esc_html__( 'Order Summary', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'order_summary_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Your order', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'order_summary_description',
			[
				'label' => esc_html__( 'Section Description', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Review your order details before completing your purchase.', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'show_product_thumbnails',
			[
				'label' => esc_html__( 'Show Product Thumbnails', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_totals_subtotals',
			[
				'label' => esc_html__( 'Show Totals/Subtotals', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Payment Section
		$this->start_controls_section(
			'payment_section',
			[
				'label' => esc_html__( 'Payment', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'payment_section_title',
			[
				'label' => esc_html__( 'Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Payment', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'purchase_button_text',
			[
				'label' => esc_html__( 'Purchase Button Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Place order', 'slidefirePro-widgets' ),
			]
		);

		$this->end_controls_section();

		// Style Sections

		// Section Styles
		$this->start_controls_section(
			'sections_style',
			[
				'label' => esc_html__( 'Sections Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sections_background_color',
			[
				'label' => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .checkout-section' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sections_border',
				'selector' => '{{WRAPPER}} .checkout-section',
			]
		);

		$this->add_control(
			'sections_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .checkout-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sections_padding',
			[
				'label' => esc_html__( 'Padding', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .checkout-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sections_margin',
			[
				'label' => esc_html__( 'Margin', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .checkout-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Form Styles
		$this->start_controls_section(
			'forms_style',
			[
				'label' => esc_html__( 'Forms Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Labels
		$this->add_control(
			'labels_heading',
			[
				'label' => esc_html__( 'Labels', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' => esc_html__( 'Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'labels_typography',
				'selector' => '{{WRAPPER}} .woocommerce-form label',
			]
		);

		// Fields
		$this->add_control(
			'fields_heading',
			[
				'label' => esc_html__( 'Fields', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'fields_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form input[type="text"], {{WRAPPER}} .woocommerce-form input[type="email"], {{WRAPPER}} .woocommerce-form input[type="tel"], {{WRAPPER}} .woocommerce-form select, {{WRAPPER}} .woocommerce-form textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_background_color',
			[
				'label' => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form input[type="text"], {{WRAPPER}} .woocommerce-form input[type="email"], {{WRAPPER}} .woocommerce-form input[type="tel"], {{WRAPPER}} .woocommerce-form select, {{WRAPPER}} .woocommerce-form textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'fields_border',
				'selector' => '{{WRAPPER}} .woocommerce-form input[type="text"], {{WRAPPER}} .woocommerce-form input[type="email"], {{WRAPPER}} .woocommerce-form input[type="tel"], {{WRAPPER}} .woocommerce-form select, {{WRAPPER}} .woocommerce-form textarea',
			]
		);

		$this->add_control(
			'fields_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form input[type="text"], {{WRAPPER}} .woocommerce-form input[type="email"], {{WRAPPER}} .woocommerce-form input[type="tel"], {{WRAPPER}} .woocommerce-form select, {{WRAPPER}} .woocommerce-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_padding',
			[
				'label' => esc_html__( 'Padding', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form input[type="text"], {{WRAPPER}} .woocommerce-form input[type="email"], {{WRAPPER}} .woocommerce-form input[type="tel"], {{WRAPPER}} .woocommerce-form select, {{WRAPPER}} .woocommerce-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Button Styles
		$this->start_controls_section(
			'buttons_style',
			[
				'label' => esc_html__( 'Buttons Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'buttons_typography',
				'selector' => '{{WRAPPER}} .woocommerce-form .button, {{WRAPPER}} #place_order',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form .button, {{WRAPPER}} #place_order' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .woocommerce-form .button, {{WRAPPER}} #place_order',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form .button:hover, {{WRAPPER}} #place_order:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .woocommerce-form .button:hover, {{WRAPPER}} #place_order:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .woocommerce-form .button, {{WRAPPER}} #place_order',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form .button, {{WRAPPER}} #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-form .button, {{WRAPPER}} #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		// Check WooCommerce availability
		if ( ! class_exists( 'WooCommerce' ) ) {
			echo '<div class="slidefirePro-no-woocommerce">' . esc_html__( 'WooCommerce is not active.', 'slidefirePro-widgets' ) . '</div>';
			return;
		}

		// Check if cart is not empty
		if ( WC()->cart->is_empty() && ! is_admin() ) {
			echo '<div class="woocommerce"><div class="wc-empty-cart-message">';
			echo '<p>' . esc_html__( 'Your cart is currently empty.', 'woocommerce' ) . '</p>';
			echo '<a class="button wc-backward" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">';
			echo esc_html__( 'Return to shop', 'woocommerce' );
			echo '</a>';
			echo '</div></div>';
			return;
		}

		$settings = $this->get_settings_for_display();

		// Add hooks for custom layout
		$this->add_checkout_hooks();

		// Apply field overrides filter
		add_filter( 'woocommerce_checkout_fields', [ $this, 'filter_checkout_fields' ] );

		// Simulate logged-out user in editor for preview
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$current_user_id = get_current_user_id();
			wp_set_current_user( 0 );
		}

		?>
		<section class="slidefirePro-checkout-wrapper bg-background min-h-screen py-20">
			<div class="container mx-auto px-4">
				<!-- Header -->
				<div class="checkout-header mb-8">
					<h1 class="text-4xl md:text-5xl font-bold">
						Secure
						<span class="bg-gradient-to-r from-primary to-blue-400 bg-clip-text text-transparent"> Checkout</span>
					</h1>
					<p class="text-muted-foreground mt-2">
						<?php esc_html_e( 'Complete your SlideFirePro order securely', 'slidefirePro-widgets' ); ?>
					</p>
				</div>

				<?php
				// Output the checkout form
				echo do_shortcode( '[woocommerce_checkout]' );
				?>
			</div>
		</section>
		<?php

		// Restore user in editor
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && isset( $current_user_id ) ) {
			wp_set_current_user( $current_user_id );
		}

		// Remove field overrides filter
		remove_filter( 'woocommerce_checkout_fields', [ $this, 'filter_checkout_fields' ] );

		// Remove hooks after rendering
		$this->remove_checkout_hooks();
	}

	/**
	 * Add checkout hooks for custom layout
	 */
	private function add_checkout_hooks(): void {
		// Remove default login and coupon forms
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

		// Add custom hooks for layout
		add_action( 'woocommerce_checkout_before_customer_details', [ $this, 'before_customer_details' ], 5 );
		add_action( 'woocommerce_checkout_after_customer_details', [ $this, 'after_customer_details' ], 95 );
		add_action( 'woocommerce_checkout_before_order_review_heading', [ $this, 'before_order_review_heading_open' ], 5 );
		add_action( 'woocommerce_checkout_before_order_review_heading', [ $this, 'before_order_review_heading_close' ], 95 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'order_review_custom' ], 15 );
		add_action( 'woocommerce_checkout_after_order_review', [ $this, 'after_order_review' ], 95 );
	}

	/**
	 * Remove checkout hooks
	 */
	private function remove_checkout_hooks(): void {
		// Restore default login and coupon forms
		add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
		add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

		// Remove custom hooks
		remove_action( 'woocommerce_checkout_before_customer_details', [ $this, 'before_customer_details' ], 5 );
		remove_action( 'woocommerce_checkout_after_customer_details', [ $this, 'after_customer_details' ], 95 );
		remove_action( 'woocommerce_checkout_before_order_review_heading', [ $this, 'before_order_review_heading_open' ], 5 );
		remove_action( 'woocommerce_checkout_before_order_review_heading', [ $this, 'before_order_review_heading_close' ], 95 );
		remove_action( 'woocommerce_checkout_order_review', [ $this, 'order_review_custom' ], 15 );
		remove_action( 'woocommerce_checkout_after_order_review', [ $this, 'after_order_review' ], 95 );
	}

	/**
	 * Hook callback: Before customer details
	 */
	public function before_customer_details(): void {
		$settings = $this->get_settings_for_display();

		// Login section
		if ( 'yes' === $settings['show_login_section'] && ! is_user_logged_in() && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
			?>
			<div class="checkout-section login-section bg-card border border-border rounded-lg p-6 mb-6">
				<h3 class="text-lg font-semibold mb-2"><?php echo esc_html( $settings['login_title'] ); ?></h3>
				<p class="text-muted-foreground text-sm mb-4"><?php echo esc_html( $settings['login_description'] ); ?></p>
				<button type="button" class="login-toggle-btn text-primary hover:text-primary/80 text-sm font-medium">
					<?php echo esc_html( $settings['login_button_text'] ); ?>
				</button>
				<div class="login-form-wrapper" style="display: none;">
					<?php wc_get_template( 'checkout/form-login.php', [ 'checkout' => WC()->checkout() ] ); ?>
				</div>
			</div>
			<?php
		}

		// Open left column wrapper
		$layout_class = 'two-column' === $settings['checkout_layout'] ? 'lg:grid-cols-3' : 'lg:grid-cols-1';
		?>
		<div class="checkout-grid grid grid-cols-1 <?php echo esc_attr( $layout_class ); ?> gap-8">
			<div class="checkout-customer-details <?php echo 'two-column' === $settings['checkout_layout'] ? 'lg:col-span-2' : ''; ?>">
		<?php
	}

	/**
	 * Hook callback: After customer details
	 */
	public function after_customer_details(): void {
		$settings = $this->get_settings_for_display();

		// Additional Information section
		if ( 'yes' === $settings['show_additional_info'] ) {
			?>
			<div class="checkout-section additional-info-section bg-card border border-border rounded-lg p-6 mt-6">
				<h3 class="text-lg font-semibold mb-4"><?php echo esc_html( $settings['additional_info_title'] ); ?></h3>
				<?php if ( ! empty( $settings['order_notes_placeholder'] ) ) : ?>
				<textarea name="order_comments" class="input-text bg-input-background border-border w-full" placeholder="<?php echo esc_attr( $settings['order_notes_placeholder'] ); ?>" rows="2"></textarea>
				<?php endif; ?>
			</div>
			<?php
		}

		// Close left column wrapper
		?>
			</div>
		<?php
	}

	/**
	 * Hook callback: Before order review heading (open)
	 */
	public function before_order_review_heading_open(): void {
		$settings = $this->get_settings_for_display();
		
		// Open right column wrapper
		$sticky_class = 'two-column' === $settings['checkout_layout'] && 'yes' === $settings['sticky_right_column'] ? 'sticky-sidebar' : '';
		$sticky_offset = ! empty( $settings['sticky_right_column_offset'] ) ? $settings['sticky_right_column_offset'] : 100;
		?>
		<div class="checkout-order-review <?php echo 'two-column' === $settings['checkout_layout'] ? 'lg:col-span-1' : ''; ?> <?php echo esc_attr( $sticky_class ); ?>" <?php echo 'yes' === $settings['sticky_right_column'] ? 'style="top: ' . esc_attr( $sticky_offset ) . 'px;"' : ''; ?>>
			<div class="checkout-section order-summary-section bg-card border border-border rounded-lg p-6">
				<h3 class="text-lg font-semibold mb-2 flex items-center">
					<svg class="h-5 w-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
					</svg>
					<?php echo esc_html( $settings['order_summary_title'] ); ?>
				</h3>
				<?php if ( ! empty( $settings['order_summary_description'] ) ) : ?>
				<p class="text-muted-foreground text-sm mb-4"><?php echo esc_html( $settings['order_summary_description'] ); ?></p>
				<?php endif; ?>
		<?php
	}

	/**
	 * Hook callback: Before order review heading (close)
	 */
	public function before_order_review_heading_close(): void {
		// This is handled in order_review_custom
	}

	/**
	 * Hook callback: Custom order review
	 */
	public function order_review_custom(): void {
		$settings = $this->get_settings_for_display();

		// Coupon section
		if ( 'yes' === $settings['show_coupon_section'] && wc_coupons_enabled() ) {
			?>
			<div class="coupon-section mb-4">
				<div class="flex space-x-2">
					<input type="text" name="coupon_code" class="input-text bg-input-background border-border text-sm" placeholder="<?php echo esc_attr( $settings['coupon_label'] ); ?>" id="coupon_code" value="" />
					<button type="submit" class="button apply-coupon text-sm px-4 py-2 bg-primary text-primary-foreground rounded" name="apply_coupon" value="<?php echo esc_attr( $settings['coupon_button_text'] ); ?>">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
						</svg>
					</button>
				</div>
			</div>
			<?php
		}

		// Let WooCommerce handle the rest of the order review
	}

	/**
	 * Hook callback: After order review
	 */
	public function after_order_review(): void {
		?>
			</div>
		</div>
	</div>
		<?php
	}

	/**
	 * Filter checkout fields for customization
	 */
	public function filter_checkout_fields( $fields ): array {
		$settings = $this->get_settings_for_display();

		// Apply billing field overrides
		if ( ! empty( $settings['billing_field_overrides'] ) ) {
			foreach ( $settings['billing_field_overrides'] as $override ) {
				$field_key = $override['field_key'];
				if ( isset( $fields['billing'][ $field_key ] ) ) {
					if ( ! empty( $override['field_label'] ) ) {
						$fields['billing'][ $field_key ]['label'] = $override['field_label'];
					}
					if ( ! empty( $override['field_placeholder'] ) ) {
						$fields['billing'][ $field_key ]['placeholder'] = $override['field_placeholder'];
					}
				}
			}
		}

		// Apply shipping field overrides
		if ( ! empty( $settings['shipping_field_overrides'] ) ) {
			foreach ( $settings['shipping_field_overrides'] as $override ) {
				$field_key = $override['field_key'];
				if ( isset( $fields['shipping'][ $field_key ] ) ) {
					if ( ! empty( $override['field_label'] ) ) {
						$fields['shipping'][ $field_key ]['label'] = $override['field_label'];
					}
					if ( ! empty( $override['field_placeholder'] ) ) {
						$fields['shipping'][ $field_key ]['placeholder'] = $override['field_placeholder'];
					}
				}
			}
		}

		// Update section titles
		if ( ! empty( $settings['billing_section_title'] ) ) {
			add_filter( 'woocommerce_checkout_get_value', function( $value, $key ) use ( $settings ) {
				if ( 'billing_section_title' === $key ) {
					return $settings['billing_section_title'];
				}
				return $value;
			}, 10, 2 );
		}

		return $fields;
	}

	protected function content_template(): void {
		?>
		<div class="slidefirePro-checkout-wrapper bg-background min-h-screen py-20">
			<div class="container mx-auto px-4">
				<!-- Header -->
				<div class="checkout-header mb-8">
					<h1 class="text-4xl md:text-5xl font-bold">
						Secure
						<span class="bg-gradient-to-r from-primary to-blue-400 bg-clip-text text-transparent"> Checkout</span>
					</h1>
					<p class="text-muted-foreground mt-2">
						Complete your SlideFirePro order securely
					</p>
				</div>

				<div class="checkout-grid grid grid-cols-1 <# if ( settings.checkout_layout === 'two-column' ) { #>lg:grid-cols-3<# } #> gap-8">
					<div class="checkout-customer-details <# if ( settings.checkout_layout === 'two-column' ) { #>lg:col-span-2<# } #>">
						
						<# if ( settings.show_login_section === 'yes' ) { #>
						<!-- Login Section -->
						<div class="checkout-section login-section bg-card border border-border rounded-lg p-6 mb-6">
							<h3 class="text-lg font-semibold mb-2">{{{ settings.login_title }}}</h3>
							<p class="text-muted-foreground text-sm mb-4">{{{ settings.login_description }}}</p>
							<button type="button" class="text-primary hover:text-primary/80 text-sm font-medium">
								{{{ settings.login_button_text }}}
							</button>
						</div>
						<# } #>

						<!-- Billing Details -->
						<div class="checkout-section billing-section bg-card border border-border rounded-lg p-6 mb-6">
							<h3 class="text-lg font-semibold mb-4">{{{ settings.billing_section_title }}}</h3>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<input type="text" placeholder="First Name" class="bg-input-background border-border rounded p-3" />
								<input type="text" placeholder="Last Name" class="bg-input-background border-border rounded p-3" />
							</div>
						</div>

						<# if ( settings.show_additional_info === 'yes' ) { #>
						<!-- Additional Information -->
						<div class="checkout-section additional-info-section bg-card border border-border rounded-lg p-6">
							<h3 class="text-lg font-semibold mb-4">{{{ settings.additional_info_title }}}</h3>
							<textarea placeholder="{{{ settings.order_notes_placeholder }}}" class="bg-input-background border-border rounded p-3 w-full" rows="3"></textarea>
						</div>
						<# } #>
					</div>

					<!-- Order Summary -->
					<div class="checkout-order-review <# if ( settings.checkout_layout === 'two-column' ) { #>lg:col-span-1<# } #>">
						<div class="checkout-section order-summary-section bg-card border border-border rounded-lg p-6">
							<h3 class="text-lg font-semibold mb-2 flex items-center">
								<svg class="h-5 w-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
								</svg>
								{{{ settings.order_summary_title }}}
							</h3>
							<# if ( settings.order_summary_description ) { #>
							<p class="text-muted-foreground text-sm mb-4">{{{ settings.order_summary_description }}}</p>
							<# } #>

							<# if ( settings.show_coupon_section === 'yes' ) { #>
							<!-- Coupon Section -->
							<div class="coupon-section mb-4">
								<div class="flex space-x-2">
									<input type="text" placeholder="{{{ settings.coupon_label }}}" class="input-text bg-input-background border-border text-sm flex-1 rounded p-2" />
									<button type="button" class="button text-sm px-4 py-2 bg-primary text-primary-foreground rounded">
										<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
										</svg>
									</button>
								</div>
							</div>
							<# } #>

							<!-- Order Items Preview -->
							<div class="order-items mb-4">
								<div class="flex items-center justify-between py-2 border-b border-border">
									<span class="text-sm">Product Name × 1</span>
									<span class="text-sm font-semibold">$99.00</span>
								</div>
								<div class="flex items-center justify-between py-2 border-b border-border">
									<span class="text-sm">Subtotal</span>
									<span class="text-sm font-semibold">$99.00</span>
								</div>
								<div class="flex items-center justify-between py-2 border-b border-border">
									<span class="text-sm">Shipping</span>
									<span class="text-sm font-semibold">$15.00</span>
								</div>
								<div class="flex items-center justify-between py-2 font-semibold">
									<span>Total</span>
									<span class="text-primary">$114.00</span>
								</div>
							</div>

							<!-- Place Order Button -->
							<button class="w-full bg-primary hover:bg-primary/90 text-primary-foreground font-semibold py-3 px-4 rounded flex items-center justify-center">
								<svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
								</svg>
								{{{ settings.purchase_button_text }}}
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}