<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Cart_Drawer_Widget extends Widget_Base {

    /**
     * Get widget name.
     */
    public function get_name() {
        return 'slidefire_cart_drawer';
    }

    /**
     * Get widget title.
     */
    public function get_title() {
        return esc_html__( 'Cart Drawer', 'slidefirePro-widgets' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-cart';
    }

    /**
     * Get widget categories.
     */
    public function get_categories() {
        return [ 'slidefire-widgets' ];
    }

    /**
     * Get widget keywords.
     */
    public function get_keywords() {
        return [ 'cart', 'drawer', 'woocommerce', 'shopping', 'checkout' ];
    }

    /**
     * Get style dependencies.
     */
    public function get_style_depends() {
        return [ 'slidefire-cart-drawer' ];
    }

    /**
     * Get script dependencies.
     */
    public function get_script_depends() {
        return [ 'slidefire-cart-drawer' ];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        
        // Content Tab
        $this->start_controls_section(
            'section_cart_icon',
            [
                'label' => esc_html__( 'Cart Icon', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cart_icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'shopping-bag',
                'options' => [
                    'shopping-bag' => esc_html__( 'Shopping Bag', 'slidefirePro-widgets' ),
                    'shopping-cart' => esc_html__( 'Shopping Cart', 'slidefirePro-widgets' ),
                    'basket' => esc_html__( 'Basket', 'slidefirePro-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'show_cart_count',
            [
                'label' => esc_html__( 'Show Item Count', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
                'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Drawer Settings
        $this->start_controls_section(
            'section_drawer_settings',
            [
                'label' => esc_html__( 'Drawer Settings', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'drawer_title',
            [
                'label' => esc_html__( 'Drawer Title', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Shopping Cart', 'slidefirePro-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'drawer_description',
            [
                'label' => esc_html__( 'Drawer Description', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Review and manage your selected items before checkout', 'slidefirePro-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'empty_cart_title',
            [
                'label' => esc_html__( 'Empty Cart Title', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Your cart is empty', 'slidefirePro-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'empty_cart_message',
            [
                'label' => esc_html__( 'Empty Cart Message', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Add some tactical gear to get started', 'slidefirePro-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'continue_shopping_text',
            [
                'label' => esc_html__( 'Continue Shopping Text', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Continue Shopping', 'slidefirePro-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'checkout_button_text',
            [
                'label' => esc_html__( 'Checkout Button Text', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Proceed to Checkout', 'slidefirePro-widgets' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Checkout Messages
        $this->start_controls_section(
            'section_checkout_messages',
            [
                'label' => esc_html__( 'Checkout Messages', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_shipping_message',
            [
                'label' => esc_html__( 'Show Shipping Message', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
                'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'shipping_message_text',
            [
                'label' => esc_html__( 'Shipping Message', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Shipping calculated at checkout', 'slidefirePro-widgets' ),
                'label_block' => true,
                'condition' => [
                    'show_shipping_message' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_tax_message',
            [
                'label' => esc_html__( 'Show Tax Message', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
                'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tax_message_text',
            [
                'label' => esc_html__( 'Tax Message', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tax calculated at checkout', 'slidefirePro-widgets' ),
                'label_block' => true,
                'condition' => [
                    'show_tax_message' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Cart Icon
        $this->start_controls_section(
            'section_style_cart_icon',
            [
                'label' => esc_html__( 'Cart Icon', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'cart_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-trigger svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-trigger svg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cart_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-trigger:hover svg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cart_badge_color',
            [
                'label' => esc_html__( 'Badge Background', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cart_badge_text_color',
            [
                'label' => esc_html__( 'Badge Text Color', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Drawer
        $this->start_controls_section(
            'section_style_drawer',
            [
                'label' => esc_html__( 'Drawer', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'drawer_background',
                'label' => esc_html__( 'Background', 'slidefirePro-widgets' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .slidefire-cart-drawer-content',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#000000',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'drawer_border',
                'label' => esc_html__( 'Border', 'slidefirePro-widgets' ),
                'selector' => '{{WRAPPER}} .slidefire-cart-drawer-content',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#333333',
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'drawer_width',
            [
                'label' => esc_html__( 'Drawer Width', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 800,
                    ],
                    '%' => [
                        'min' => 20,
                        'max' => 90,
                    ],
                    'vw' => [
                        'min' => 20,
                        'max' => 90,
                    ],
                ],
                'default' => [
                    'size' => 400,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-drawer-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Typography
        $this->start_controls_section(
            'section_style_typography',
            [
                'label' => esc_html__( 'Typography', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'drawer_title_typography',
                'label' => esc_html__( 'Drawer Title', 'slidefirePro-widgets' ),
                'selector' => '{{WRAPPER}} .slidefire-cart-drawer-title',
            ]
        );

        $this->add_control(
            'drawer_title_color',
            [
                'label' => esc_html__( 'Title Color', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-drawer-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cart_item_typography',
                'label' => esc_html__( 'Cart Items', 'slidefirePro-widgets' ),
                'selector' => '{{WRAPPER}} .slidefire-cart-item-name',
            ]
        );

        $this->add_control(
            'cart_item_color',
            [
                'label' => esc_html__( 'Item Text Color', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-cart-item-name, {{WRAPPER}} .slidefire-cart-item-meta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Buttons
        $this->start_controls_section(
            'section_style_buttons',
            [
                'label' => esc_html__( 'Buttons', 'slidefirePro-widgets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'checkout_button_bg_color',
            [
                'label' => esc_html__( 'Checkout Button Background', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-checkout-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkout_button_text_color',
            [
                'label' => esc_html__( 'Checkout Button Text', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-checkout-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'continue_shopping_bg_color',
            [
                'label' => esc_html__( 'Continue Shopping Background', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-continue-shopping-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'continue_shopping_text_color',
            [
                'label' => esc_html__( 'Continue Shopping Text', 'slidefirePro-widgets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-continue-shopping-button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        // Check if WooCommerce is active
        if ( ! class_exists( 'WooCommerce' ) ) {
            echo '<div class="slidefire-notice">' . esc_html__( 'WooCommerce is not installed or activated.', 'slidefirePro-widgets' ) . '</div>';
            return;
        }

        $settings = $this->get_settings_for_display();
        
        ?>
        <div class="slidefire-cart-drawer-wrapper">
            <!-- Cart Trigger Button -->
            <button class="slidefire-cart-trigger" id="slidefire-cart-trigger-<?php echo esc_attr( $this->get_id() ); ?>" aria-label="<?php esc_attr_e( 'Open cart', 'slidefirePro-widgets' ); ?>">
                <?php $this->render_cart_icon( $settings['cart_icon_type'] ); ?>
                <?php if ( 'yes' === $settings['show_cart_count'] ) : ?>
                    <span class="slidefire-cart-badge" id="slidefire-cart-badge-<?php echo esc_attr( $this->get_id() ); ?>">
                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                    </span>
                <?php endif; ?>
            </button>

            <!-- Cart Drawer Overlay -->
            <div class="slidefire-cart-drawer-overlay" id="slidefire-cart-overlay-<?php echo esc_attr( $this->get_id() ); ?>"></div>

            <!-- Cart Drawer -->
            <div class="slidefire-cart-drawer" id="slidefire-cart-drawer-<?php echo esc_attr( $this->get_id() ); ?>">
                <div class="slidefire-cart-drawer-content">
                    <!-- Drawer Header -->
                    <div class="slidefire-cart-drawer-header">
                        <div class="slidefire-cart-drawer-title-wrapper">
                            <?php $this->render_cart_icon( $settings['cart_icon_type'] ); ?>
                            <h3 class="slidefire-cart-drawer-title"><?php echo esc_html( $settings['drawer_title'] ); ?></h3>
                            <?php if ( 'yes' === $settings['show_cart_count'] ) : ?>
                                <span class="slidefire-cart-header-badge">
                                    <span id="slidefire-cart-count-header-<?php echo esc_attr( $this->get_id() ); ?>">
                                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                                    </span>
                                    <?php echo WC()->cart->get_cart_contents_count() === 1 ? esc_html__( 'item', 'slidefirePro-widgets' ) : esc_html__( 'items', 'slidefirePro-widgets' ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <p class="slidefire-cart-drawer-description"><?php echo esc_html( $settings['drawer_description'] ); ?></p>
                        <button class="slidefire-cart-close" aria-label="<?php esc_attr_e( 'Close cart', 'slidefirePro-widgets' ); ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>

                    <!-- Cart Content -->
                    <div class="slidefire-cart-drawer-body" id="slidefire-cart-content-<?php echo esc_attr( $this->get_id() ); ?>">
                        <?php $this->render_cart_content( $settings ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render cart icon based on type
     */
    private function render_cart_icon( $icon_type ) {
        switch ( $icon_type ) {
            case 'shopping-cart':
                ?>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="8" cy="21" r="1"></circle>
                    <circle cx="19" cy="21" r="1"></circle>
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                </svg>
                <?php
                break;
            case 'basket':
                ?>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 12h20l-2 7H4l-2-7z"></path>
                    <path d="M7 12V7a5 5 0 0 1 10 0v5"></path>
                </svg>
                <?php
                break;
            case 'shopping-bag':
            default:
                ?>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <?php
                break;
        }
    }

    /**
     * Render cart content
     */
    private function render_cart_content( $settings ) {
        if ( WC()->cart->is_empty() ) {
            $this->render_empty_cart( $settings );
        } else {
            $this->render_cart_items( $settings );
            $this->render_cart_summary( $settings );
        }
    }

    /**
     * Render empty cart state
     */
    private function render_empty_cart( $settings ) {
        ?>
        <div class="slidefire-empty-cart">
            <div class="slidefire-empty-cart-icon">
                <?php $this->render_cart_icon( $settings['cart_icon_type'] ); ?>
            </div>
            <h3 class="slidefire-empty-cart-title"><?php echo esc_html( $settings['empty_cart_title'] ); ?></h3>
            <p class="slidefire-empty-cart-message"><?php echo esc_html( $settings['empty_cart_message'] ); ?></p>
            <button class="slidefire-continue-shopping-button slidefire-close-drawer">
                <?php echo esc_html( $settings['continue_shopping_text'] ); ?>
            </button>
        </div>
        <?php
    }

    /**
     * Render cart items
     */
    private function render_cart_items( $settings ) {
        ?>
        <div class="slidefire-cart-items">
            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    ?>
                    <div class="slidefire-cart-item" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>">
                        <div class="slidefire-cart-item-image">
                            <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                            echo $thumbnail;
                            ?>
                        </div>
                        <div class="slidefire-cart-item-details">
                            <div class="slidefire-cart-item-header">
                                <h4 class="slidefire-cart-item-name">
                                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                                </h4>
                                <button class="slidefire-remove-item" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>" aria-label="<?php esc_attr_e( 'Remove item', 'slidefirePro-widgets' ); ?>">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="slidefire-cart-item-meta">
                                <?php
                                // Display product attributes (size, color, etc.)
                                if ( ! empty( $cart_item['variation'] ) ) {
                                    foreach ( $cart_item['variation'] as $name => $value ) {
                                        if ( '' === $value ) continue;
                                        $attribute_name = wc_attribute_label( str_replace( 'attribute_', '', $name ), $_product );
                                        echo '<div class="slidefire-cart-item-variation">' . esc_html( $attribute_name ) . ': ' . esc_html( $value ) . '</div>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="slidefire-cart-item-actions">
                                <div class="slidefire-quantity-controls">
                                    <button class="slidefire-quantity-decrease" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>" <?php echo $cart_item['quantity'] <= 1 ? 'disabled' : ''; ?>>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                    <span class="slidefire-quantity-value"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                                    <button class="slidefire-quantity-increase" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="slidefire-cart-item-price">
                                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                    <?php if ( $cart_item['quantity'] > 1 ) : ?>
                                        <div class="slidefire-item-total">
                                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }

    /**
     * Render cart summary
     */
    private function render_cart_summary( $settings ) {
        $cart = WC()->cart;
        $subtotal = $cart->get_subtotal();
        ?>
        <div class="slidefire-cart-summary">
            <div class="slidefire-summary-row">
                <span class="slidefire-summary-label"><?php esc_html_e( 'Subtotal', 'slidefirePro-widgets' ); ?></span>
                <span class="slidefire-summary-value"><?php echo wc_price( $subtotal ); ?></span>
            </div>
            
            <?php if ( 'yes' === $settings['show_shipping_message'] ) : ?>
                <div class="slidefire-summary-row">
                    <span class="slidefire-summary-label"><?php esc_html_e( 'Shipping', 'slidefirePro-widgets' ); ?></span>
                    <span class="slidefire-summary-value slidefire-calculated-message">
                        <?php echo esc_html( $settings['shipping_message_text'] ); ?>
                    </span>
                </div>
            <?php endif; ?>
            
            <?php if ( 'yes' === $settings['show_tax_message'] ) : ?>
                <div class="slidefire-summary-row">
                    <span class="slidefire-summary-label"><?php esc_html_e( 'Tax', 'slidefirePro-widgets' ); ?></span>
                    <span class="slidefire-summary-value slidefire-calculated-message">
                        <?php echo esc_html( $settings['tax_message_text'] ); ?>
                    </span>
                </div>
            <?php endif; ?>
            
            <div class="slidefire-summary-separator"></div>
            
            <div class="slidefire-summary-row slidefire-summary-total">
                <span class="slidefire-summary-label"><?php esc_html_e( 'Total', 'slidefirePro-widgets' ); ?></span>
                <span class="slidefire-summary-value slidefire-total-price"><?php echo wc_price( $subtotal ); ?></span>
            </div>

            <div class="slidefire-cart-actions">
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="slidefire-checkout-button">
                    <?php echo esc_html( $settings['checkout_button_text'] ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12,5 19,12 12,19"></polyline>
                    </svg>
                </a>
                <button class="slidefire-continue-shopping-button slidefire-close-drawer">
                    <?php echo esc_html( $settings['continue_shopping_text'] ); ?>
                </button>
            </div>

            <div class="slidefire-security-badge">
                <span class="slidefire-security-icon">🔒</span>
                <span class="slidefire-security-text"><?php esc_html_e( 'Secure checkout powered by Stripe', 'slidefirePro-widgets' ); ?></span>
            </div>
        </div>
        <?php
    }

    /**
     * Render widget content in the editor.
     */
    protected function content_template() {
        ?>
        <#
        var iconSvg = '';
        switch (settings.cart_icon_type) {
            case 'shopping-cart':
                iconSvg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>';
                break;
            case 'basket':
                iconSvg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h20l-2 7H4l-2-7z"></path><path d="M7 12V7a5 5 0 0 1 10 0v5"></path></svg>';
                break;
            default:
                iconSvg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>';
        }
        #>
        
        <div class="slidefire-cart-drawer-wrapper">
            <button class="slidefire-cart-trigger">
                {{{ iconSvg }}}
                <# if ( 'yes' === settings.show_cart_count ) { #>
                    <span class="slidefire-cart-badge">3</span>
                <# } #>
            </button>
            
            <div class="slidefire-cart-drawer-preview">
                <div class="slidefire-cart-drawer-content">
                    <div class="slidefire-cart-drawer-header">
                        <div class="slidefire-cart-drawer-title-wrapper">
                            {{{ iconSvg }}}
                            <h3 class="slidefire-cart-drawer-title">{{{ settings.drawer_title }}}</h3>
                            <# if ( 'yes' === settings.show_cart_count ) { #>
                                <span class="slidefire-cart-header-badge">3 items</span>
                            <# } #>
                        </div>
                        <p class="slidefire-cart-drawer-description">{{{ settings.drawer_description }}}</p>
                    </div>
                    
                    <div class="slidefire-editor-preview-notice">
                        <p>Cart content will be displayed here dynamically on the frontend.</p>
                        <p>Preview shows the cart drawer structure and styling.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}