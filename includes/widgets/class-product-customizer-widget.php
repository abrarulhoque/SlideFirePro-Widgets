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
            'enable_variations',
            [
                'label' => esc_html__('Show Variations', 'slidefirePro-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'slidefirePro-widgets'),
                'label_off' => esc_html__('Hide', 'slidefirePro-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'enable_customization',
            [
                'label' => esc_html__('Show Customization Form', 'slidefirePro-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'slidefirePro-widgets'),
                'label_off' => esc_html__('Hide', 'slidefirePro-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'customization_title',
            [
                'label' => esc_html__('Customization Title', 'slidefirePro-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Jersey Customization', 'slidefirePro-widgets'),
                'condition' => [
                    'enable_customization' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'player_name_label',
            [
                'label' => esc_html__('Player Name Label', 'slidefirePro-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Player Name', 'slidefirePro-widgets'),
                'condition' => [
                    'enable_customization' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jersey_number_label',
            [
                'label' => esc_html__('Jersey Number Label', 'slidefirePro-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Jersey Number', 'slidefirePro-widgets'),
                'condition' => [
                    'enable_customization' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'add_to_cart_text',
            [
                'label' => esc_html__('Add to Cart Text', 'slidefirePro-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add to Cart', 'slidefirePro-widgets'),
            ]
        );

        $this->add_control(
            'buy_now_text',
            [
                'label' => esc_html__('Buy Now Text', 'slidefirePro-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Buy Now', 'slidefirePro-widgets'),
            ]
        );

        $this->add_control(
            'enable_quantity',
            [
                'label' => esc_html__('Show Quantity Field', 'slidefirePro-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'slidefirePro-widgets'),
                'label_off' => esc_html__('Hide', 'slidefirePro-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'quantity_label',
            [
                'label' => esc_html__('Quantity Label', 'slidefirePro-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Quantity', 'slidefirePro-widgets'),
                'condition' => [
                    'enable_quantity' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_buy_now',
            [
                'label' => esc_html__('Show Buy Now Button', 'slidefirePro-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'slidefirePro-widgets'),
                'label_off' => esc_html__('Hide', 'slidefirePro-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
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

        // Style Section - Customization Form
        $this->start_controls_section(
            'customization_style_section',
            [
                'label' => esc_html__('Customization Form', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_customization' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'customization_bg_color',
            [
                'label' => esc_html__('Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .customization-section' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'customization_border',
                'selector' => '{{WRAPPER}} .customization-section',
            ]
        );

        $this->add_control(
            'customization_border_radius',
            [
                'label' => esc_html__('Border Radius', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .customization-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'customization_padding',
            [
                'label' => esc_html__('Padding', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .customization-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'customization_title_typography',
                'label' => esc_html__('Title Typography', 'slidefirePro-widgets'),
                'selector' => '{{WRAPPER}} .customization-title',
            ]
        );

        $this->add_control(
            'customization_title_color',
            [
                'label' => esc_html__('Title Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .customization-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Input Fields
        $this->start_controls_section(
            'input_style_section',
            [
                'label' => esc_html__('Input Fields', 'slidefirePro-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_customization' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .customization-input',
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__('Text Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .customization-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label' => esc_html__('Background Color', 'slidefirePro-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1a1a1a',
                'selectors' => [
                    '{{WRAPPER}} .customization-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} .customization-input',
            ]
        );

        $this->add_control(
            'input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .customization-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'slidefirePro-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .customization-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        ?>
        <div class="slidefire-product-customizer" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-type="<?php echo esc_attr($product->get_type()); ?>">
            <?php if ($settings['enable_variations'] === 'yes') : ?>
                <!-- Size Selection -->
                <div class="size-section space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2"><?php esc_html_e('Size', 'slidefirePro-widgets'); ?></label>
                        <?php
                        // Render WooCommerce variations if product is variable
                        if ($product->is_type('variable')) {
                            $this->render_variations_form();
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($settings['enable_customization'] === 'yes') : ?>
                <!-- Customization Form -->
                <div class="customization-section space-y-4 p-4 border border-border rounded-lg">
                    <h3 class="customization-title font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l11 11Z"/>
                        </svg>
                        <?php echo esc_html($settings['customization_title']); ?>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2"><?php echo esc_html($settings['player_name_label']); ?></label>
                            <input
                                type="text"
                                name="player_name"
                                class="customization-input"
                                placeholder="<?php esc_attr_e('Enter your name', 'slidefirePro-widgets'); ?>"
                                maxlength="20"
                            />
                            <p class="text-xs text-muted-foreground mt-1"><?php esc_html_e('Max 20 characters', 'slidefirePro-widgets'); ?></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2"><?php echo esc_html($settings['jersey_number_label']); ?></label>
                            <input
                                type="text"
                                name="jersey_number"
                                class="customization-input"
                                placeholder="00"
                                maxlength="2"
                                pattern="[0-9]*"
                            />
                            <p class="text-xs text-muted-foreground mt-1"><?php esc_html_e('Numbers 00-99', 'slidefirePro-widgets'); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 text-sm text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <line x1="4" x2="20" y1="9" y2="9"/>
                            <line x1="4" x2="20" y1="15" y2="15"/>
                            <line x1="10" x2="14" y1="3" y2="21"/>
                        </svg>
                        <span><?php esc_html_e('If no name or number is needed, please leave them blank', 'slidefirePro-widgets'); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            // Render product addons form if the plugin is active
            if (function_exists('wcpa_render_product_form')) {
                wcpa_render_product_form();
            }
            ?>

            <?php if ($settings['enable_quantity'] === 'yes') : ?>
                <!-- Quantity Section -->
                <div class="quantity-section space-y-2 mb-4">
                    <label class="block text-sm font-medium mb-2"><?php echo esc_html($settings['quantity_label']); ?></label>
                    <div class="slidefire-quantity-wrapper flex items-center">
                        <button class="slidefire-quantity-btn slidefire-quantity-decrease" type="button" aria-label="<?php esc_attr_e('Decrease quantity', 'slidefirePro-widgets'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <input 
                            type="number" 
                            name="quantity" 
                            class="slidefire-quantity-field" 
                            value="1" 
                            min="1" 
                            max="<?php echo esc_attr($product->get_max_purchase_quantity()); ?>"
                            step="1"
                        />
                        <button class="slidefire-quantity-btn slidefire-quantity-increase" type="button" aria-label="<?php esc_attr_e('Increase quantity', 'slidefirePro-widgets'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="actions-section space-y-4">
                <div class="flex gap-4">
                    <button class="slidefire-button add-to-cart-button flex-1 flex items-center justify-center gap-2" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <circle cx="8" cy="21" r="1"/>
                            <circle cx="19" cy="21" r="1"/>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                        </svg>
                        <?php echo esc_html($settings['add_to_cart_text']); ?>
                    </button>
                    
                    <button class="wishlist-button slidefire-button" aria-label="<?php esc_attr_e('Add to wishlist', 'slidefirePro-widgets'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                        </svg>
                    </button>
                </div>

                <?php if ($settings['enable_buy_now'] === 'yes') : ?>
                    <button class="slidefire-button buy-now-button w-full">
                        <?php echo esc_html($settings['buy_now_text']); ?>
                    </button>
                <?php endif; ?>
            </div>

            <!-- Hidden form for WooCommerce integration -->
            <form class="cart slidefire-cart-form" style="display: none;" method="post" enctype="multipart/form-data">
                <?php
                // Add WooCommerce add to cart functionality
                do_action('woocommerce_before_add_to_cart_form');
                ?>
                
                <?php if ($product->is_type('variable')) : ?>
                    <div class="variations_form" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
                        <?php woocommerce_variable_add_to_cart(); ?>
                    </div>
                <?php else : ?>
                    <?php woocommerce_simple_add_to_cart(); ?>
                <?php endif; ?>
                
                <?php
                do_action('woocommerce_after_add_to_cart_form');
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Render variations form for variable products
     */
    private function render_variations_form() {
        global $product;
        
        if (!$product->is_type('variable')) {
            return;
        }

        $available_variations = $product->get_available_variations();
        $attributes = $product->get_variation_attributes();

        if (empty($available_variations) && false !== $available_variations) {
            return;
        }

        foreach ($attributes as $attribute_name => $options) : ?>
            <div class="variation-selector">
                <label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                    <?php echo wc_attribute_label($attribute_name); ?>
                </label>
                <select 
                    id="<?php echo esc_attr(sanitize_title($attribute_name)); ?>" 
                    name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>" 
                    class="customization-input variation-select" 
                    data-attribute_name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>"
                >
                    <option value=""><?php echo esc_html__('Choose an option', 'slidefirePro-widgets'); ?></option>
                    <?php
                    if (!empty($options)) {
                        if ($product && taxonomy_exists($attribute_name)) {
                            $terms = wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'all'));
                            foreach ($terms as $term) {
                                if (in_array($term->slug, $options, true)) {
                                    echo '<option value="' . esc_attr($term->slug) . '">' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute_name, $product)) . '</option>';
                                }
                            }
                        } else {
                            foreach ($options as $option) {
                                echo '<option value="' . esc_attr($option) . '">' . esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute_name, $product)) . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>
        <?php endforeach;
    }

    /**
     * Get the current product for the widget context
     */
    private function get_product() {
        global $product;

        if ($product instanceof \WC_Product) {
            return $product;
        }

        return false;
    }

    public function render_plain_content() {}

    public function get_group_name() {
        return 'woocommerce';
    }
}