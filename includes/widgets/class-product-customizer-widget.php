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
            'customization_info',
            [
                'label' => esc_html__('Product Customization', 'slidefirePro-widgets'),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Product customization fields (like name and number) are automatically handled by the WooCommerce Custom Product Addons plugin and will appear dynamically based on your product configuration.', 'slidefirePro-widgets'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
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

        // Add WooCommerce hooks for proper add to cart functionality
        add_action('woocommerce_before_add_to_cart_quantity', [$this, 'before_add_to_cart_quantity'], 95);
        add_action('woocommerce_before_add_to_cart_button', [$this, 'before_add_to_cart_quantity'], 5);
        add_action('woocommerce_after_add_to_cart_button', [$this, 'after_add_to_cart_button'], 5);

        ?>
        <div class="slidefire-product-customizer elementor-add-to-cart elementor-product-<?php echo esc_attr($product->get_type()); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-type="<?php echo esc_attr($product->get_type()); ?>">
            
            <!-- Use native WooCommerce form for proper functionality -->
            <form class="cart" method="post" enctype="multipart/form-data">
                <?php do_action('woocommerce_before_add_to_cart_form'); ?>

                <?php if ($settings['enable_variations'] === 'yes' && $product->is_type('variable')) : ?>
                    <!-- Variations Section -->
                    <div class="variations-section mb-4">
                        <label class="block text-sm font-medium mb-2"><?php esc_html_e('Options', 'slidefirePro-widgets'); ?></label>
                        <?php
                        $available_variations = $product->get_available_variations();
                        $attributes = $product->get_variation_attributes();
                        
                        if (!empty($available_variations) && !empty($attributes)) {
                            foreach ($attributes as $attribute_name => $options) {
                                $sanitized_name = sanitize_title($attribute_name);
                                ?>
                                <div class="variation-selector mb-3">
                                    <label for="<?php echo esc_attr($sanitized_name); ?>" class="block text-sm mb-1">
                                        <?php echo wc_attribute_label($attribute_name); ?>
                                    </label>
                                    <select 
                                        id="<?php echo esc_attr($sanitized_name); ?>" 
                                        name="attribute_<?php echo esc_attr($sanitized_name); ?>" 
                                        class="customization-input variation-select" 
                                        data-attribute_name="attribute_<?php echo esc_attr($sanitized_name); ?>"
                                    >
                                        <option value=""><?php echo esc_html__('Choose an option', 'slidefirePro-widgets'); ?></option>
                                        <?php
                                        if (!empty($options)) {
                                            if (taxonomy_exists($attribute_name)) {
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
                                <?php
                            }
                        }
                        ?>
                        <div class="single_variation_wrap">
                            <div class="woocommerce-variation single_variation" style="display:none;"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // Let WCPA plugin render its fields naturally through WooCommerce hooks
                // This will automatically render WCPA fields if they exist for this product
                // The WCPA plugin hooks into 'woocommerce_before_add_to_cart_button' by default
                ?>

                <?php if ($settings['enable_quantity'] === 'yes') : ?>
                    <!-- Quantity Section -->
                    <div class="quantity-section mb-4">
                        <label class="block text-sm font-medium mb-2"><?php echo esc_html($settings['quantity_label']); ?></label>
                        <div class="slidefire-quantity-wrapper">
                            <button class="slidefire-quantity-btn slidefire-quantity-decrease" type="button" aria-label="<?php esc_attr_e('Decrease quantity', 'slidefirePro-widgets'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </button>
                            <?php
                            $min_quantity = apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product);
                            $max_quantity = apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product);
                            $input_value = $product->get_min_purchase_quantity();
                            
                            woocommerce_quantity_input(array(
                                'min_value'   => $min_quantity,
                                'max_value'   => $max_quantity,
                                'input_value' => $input_value,
                                'classes'     => array('input-text', 'qty', 'text', 'slidefire-quantity-field'),
                                'step'        => 1
                            ), $product);
                            ?>
                            <button class="slidefire-quantity-btn slidefire-quantity-increase" type="button" aria-label="<?php esc_attr_e('Increase quantity', 'slidefirePro-widgets'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php else : ?>
                    <input type="hidden" name="quantity" value="1" />
                <?php endif; ?>

                <!-- Action Buttons Section -->
                <div class="actions-section">
                    <div class="button-group">
                        <?php
                        // Use WooCommerce's native add to cart button
                        if ($product->is_type('variable')) {
                            echo '<input type="hidden" name="add-to-cart" value="' . esc_attr($product->get_id()) . '" />';
                            echo '<input type="hidden" name="product_id" value="' . esc_attr($product->get_id()) . '" />';
                            echo '<input type="hidden" name="variation_id" class="variation_id" value="0" />';
                        } else {
                            echo '<input type="hidden" name="add-to-cart" value="' . esc_attr($product->get_id()) . '" />';
                        }
                        ?>
                        
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="slidefire-button add-to-cart-button single_add_to_cart_button button alt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="cart-icon">
                                <circle cx="8" cy="21" r="1"/>
                                <circle cx="19" cy="21" r="1"/>
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                            </svg>
                            <span class="button-text"><?php echo esc_html($settings['add_to_cart_text']); ?></span>
                        </button>
                        
                        <button type="button" class="wishlist-button slidefire-button" aria-label="<?php esc_attr_e('Add to wishlist', 'slidefirePro-widgets'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/>
                            </svg>
                        </button>
                    </div>

                    <?php if ($settings['enable_buy_now'] === 'yes') : ?>
                        <button type="button" class="slidefire-button buy-now-button">
                            <?php echo esc_html($settings['buy_now_text']); ?>
                        </button>
                    <?php endif; ?>
                </div>

                <?php do_action('woocommerce_after_add_to_cart_form'); ?>
            </form>
        </div>
        <?php

        // Remove hooks after rendering
        remove_action('woocommerce_before_add_to_cart_quantity', [$this, 'before_add_to_cart_quantity'], 95);
        remove_action('woocommerce_before_add_to_cart_button', [$this, 'before_add_to_cart_quantity'], 5);
        remove_action('woocommerce_after_add_to_cart_button', [$this, 'after_add_to_cart_button'], 5);
    }

    /**
     * Hook callbacks for proper WooCommerce integration
     */
    public function before_add_to_cart_quantity() {
        echo '<div class="e-atc-qty-button-holder">';
    }

    public function after_add_to_cart_button() {
        echo '</div>';
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