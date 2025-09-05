<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Product_Customizer_Widget extends Widget_Base {

    public function get_name(): string {
        return 'slidefirePro-product-customizer';
    }

    public function get_title(): string {
        return esc_html__('Product Customizer', 'slidefirePro-widgets');
    }

    public function get_icon(): string {
        return 'eicon-product-add-to-cart';
    }

    public function get_categories(): array {
        return ['woocommerce-elements'];
    }

    public function get_keywords(): array {
        return ['woocommerce', 'product', 'add to cart', 'customizer', 'jersey', 'name', 'number'];
    }

    public function get_style_depends(): array {
        return ['slidefirePro-product-customizer'];
    }

    public function get_script_depends(): array {
        return ['slidefirePro-product-customizer'];
    }

    protected function register_controls(): void {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'woocommerce_integration_info',
            [
                'label' => esc_html__('WooCommerce Integration', 'slidefirePro-widgets'),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('This widget uses the native WooCommerce add to cart template, which automatically supports product variations, addons, and any plugin that hooks into WooCommerce forms (like Custom Product Addons, Product Bundles, etc.).', 'slidefirePro-widgets'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->end_controls_section();

        // Style Section - Container
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => esc_html__('Container', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Padding', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-product-customizer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__('Margin', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-product-customizer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - WCPA Form Integration
        $this->start_controls_section(
            'wcpa_style_section',
            [
                'label' => esc_html__('Custom Product Fields', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wcpa_styling_info',
            [
                'label' => esc_html__('Styling Information', 'slidefirePro-widgets'),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Custom product fields styling can be controlled through the WooCommerce Custom Product Addons plugin settings or by adding CSS targeting ".wcpa_form_outer" classes.', 'slidefirePro-widgets'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'wcpa_form_bg_color',
            [
                'label' => esc_html__('Form Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wcpa_form_outer' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wcpa_wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wcpa_form_padding',
            [
                'label' => esc_html__('Form Padding', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .wcpa_form_outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wcpa_form_margin',
            [
                'label' => esc_html__('Form Margin', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .wcpa_form_outer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Quantity Field
        $this->start_controls_section(
            'quantity_style_section',
            [
                'label' => esc_html__('Quantity Field', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_quantity' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'quantity_typography',
                'selector' => '{{WRAPPER}} .slidefire-quantity-field',
            ]
        );

        $this->add_control(
            'quantity_text_color',
            [
                'label' => esc_html__('Text Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-field' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quantity_bg_color',
            [
                'label' => esc_html__('Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-field' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'quantity_border',
                'selector' => '{{WRAPPER}} .slidefire-quantity-field',
            ]
        );

        $this->add_control(
            'quantity_border_radius',
            [
                'label' => esc_html__('Border Radius', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'quantity_padding',
            [
                'label' => esc_html__('Padding', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Quantity Controls (Buttons)
        $this->add_control(
            'quantity_controls_heading',
            [
                'label' => esc_html__('Quantity Controls', 'slidefirePro-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'quantity_control_color',
            [
                'label' => esc_html__('Control Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quantity_control_bg_color',
            [
                'label' => esc_html__('Control Background', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quantity_control_hover_color',
            [
                'label' => esc_html__('Control Hover Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1e9fdb',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-quantity-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Buttons
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Buttons', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .slidefire-button',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add to Cart Button Styles
        $this->add_control(
            'add_to_cart_heading',
            [
                'label' => esc_html__('Add to Cart Button', 'slidefirePro-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'add_to_cart_text_color',
            [
                'label' => esc_html__('Text Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .add-to-cart-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'add_to_cart_bg_color',
            [
                'label' => esc_html__('Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .add-to-cart-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'add_to_cart_hover_bg_color',
            [
                'label' => esc_html__('Hover Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1e9fdb',
                'selectors' => [
                    '{{WRAPPER}} .add-to-cart-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Buy Now Button Styles
        $this->add_control(
            'buy_now_heading',
            [
                'label' => esc_html__('Buy Now Button', 'slidefirePro-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'enable_buy_now' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'buy_now_text_color',
            [
                'label' => esc_html__('Text Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .buy-now-button' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_buy_now' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'buy_now_bg_color',
            [
                'label' => esc_html__('Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .buy-now-button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_buy_now' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'buy_now_border',
                'selector' => '{{WRAPPER}} .buy-now-button',
                'condition' => [
                    'enable_buy_now' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'buy_now_hover_bg_color',
            [
                'label' => esc_html__('Hover Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(35, 178, 238, 0.1)',
                'selectors' => [
                    '{{WRAPPER}} .buy-now-button:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'enable_buy_now' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        global $product;

        $product = $this->get_product();

        if (!$product) {
            return;
        }

        $settings = $this->get_settings_for_display();

        // Add WooCommerce hooks for proper add to cart functionality (same as Elementor Pro)
        add_action('woocommerce_before_add_to_cart_quantity', [$this, 'before_add_to_cart_quantity'], 95);
        add_action('woocommerce_before_add_to_cart_button', [$this, 'before_add_to_cart_quantity'], 5);
        add_action('woocommerce_after_add_to_cart_button', [$this, 'after_add_to_cart_button'], 5);
        ?>

        <div class="slidefire-product-customizer elementor-add-to-cart elementor-product-<?php echo esc_attr($product->get_type()); ?>">
            <?php 
            // Use the same approach as Elementor Pro - call the native WooCommerce template
            // This automatically triggers all WooCommerce hooks including those used by product addon plugins
            woocommerce_template_single_add_to_cart();
            ?>
        </div>

        <?php
        // Remove hooks after rendering (same as Elementor Pro)
        remove_action('woocommerce_before_add_to_cart_quantity', [$this, 'before_add_to_cart_quantity'], 95);
        remove_action('woocommerce_before_add_to_cart_button', [$this, 'before_add_to_cart_quantity'], 5);
        remove_action('woocommerce_after_add_to_cart_button', [$this, 'after_add_to_cart_button'], 5);
    }

    /**
     * Hook callbacks for proper WooCommerce integration (same as Elementor Pro)
     */
    public function before_add_to_cart_quantity() {
        ?>
        <div class="e-atc-qty-button-holder">
        <?php
    }

    public function after_add_to_cart_button() {
        ?>
        </div>
        <?php
    }

    /**
     * Get the current product for the widget context
     */
    private function get_product() {
        global $product;

        if ($product instanceof \WC_Product) {
            return $product;
        }

        // Try to get product from query or post
        $product_id = get_the_ID();
        if ($product_id && function_exists('wc_get_product')) {
            $product = wc_get_product($product_id);
            if ($product && $product instanceof \WC_Product) {
                return $product;
            }
        }

        return false;
    }

    public function render_plain_content() {}

    public function get_group_name() {
        return 'woocommerce';
    }
}