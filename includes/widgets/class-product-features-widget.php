<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use SlideFirePro_Widgets\WooCommerce_Product_Fields;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Product_Features_Widget extends Widget_Base {

    public function get_name(): string {
        return 'slidefire-product-features';
    }

    public function get_title(): string {
        return esc_html__( 'Product Features & Specs', 'slidefirePro-widgets' );
    }

    public function get_icon(): string {
        return 'eicon-product-info';
    }

    public function get_categories(): array {
        return [ 'woocommerce-elements' ];
    }

    public function get_keywords(): array {
        return [ 'product', 'features', 'specifications', 'woocommerce' ];
    }

    public function get_style_depends(): array {
        return [ 'slidefire-product-features' ];
    }

    public function get_script_depends(): array {
        return [ 'slidefire-product-features' ];
    }

    protected function register_controls(): void {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'slidefirePro-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_source',
            [
                'label'   => esc_html__( 'Product Source', 'slidefirePro-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'current',
                'options' => [
                    'current' => esc_html__( 'Current Product', 'slidefirePro-widgets' ),
                    'custom'  => esc_html__( 'Custom Product', 'slidefirePro-widgets' ),
                ],
            ]
        );

        $this->add_control(
            'product_id',
            [
                'label'       => esc_html__( 'Product ID', 'slidefirePro-widgets' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'condition'   => [
                    'product_source' => 'custom',
                ],
                'description' => esc_html__( 'Enter the product ID to display features and specifications for.', 'slidefirePro-widgets' ),
            ]
        );

        $this->add_control(
            'show_features',
            [
                'label'   => esc_html__( 'Show Features', 'slidefirePro-widgets' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_shipping',
            [
                'label'   => esc_html__( 'Show Shipping Info', 'slidefirePro-widgets' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_specifications',
            [
                'label'   => esc_html__( 'Show Specifications', 'slidefirePro-widgets' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__( 'Layout Style', 'slidefirePro-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'tabs',
                'options' => [
                    'tabs'    => esc_html__( 'Tabs Layout', 'slidefirePro-widgets' ),
                    'stacked' => esc_html__( 'Stacked Layout', 'slidefirePro-widgets' ),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Cards
        $this->start_controls_section(
            'style_cards',
            [
                'label' => esc_html__( 'Cards', 'slidefirePro-widgets' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_background',
            [
                'label'     => esc_html__( 'Background Color', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--card)',
                'selectors' => [
                    '{{WRAPPER}} .product-features-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--border)',
                'selectors' => [
                    '{{WRAPPER}} .product-features-card' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'slidefirePro-widgets' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 12,
                    'right'  => 12,
                    'bottom' => 12,
                    'left'   => 12,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .product-features-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_padding',
            [
                'label'      => esc_html__( 'Padding', 'slidefirePro-widgets' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 24,
                    'right'  => 24,
                    'bottom' => 24,
                    'left'   => 24,
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .product-features-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Typography
        $this->start_controls_section(
            'style_typography',
            [
                'label' => esc_html__( 'Typography', 'slidefirePro-widgets' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__( 'Heading Color', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--foreground)',
                'selectors' => [
                    '{{WRAPPER}} .product-features-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--muted-foreground)',
                'selectors' => [
                    '{{WRAPPER}} .product-features-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__( 'Accent Color (Icons & Bullets)', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--primary)',
                'selectors' => [
                    '{{WRAPPER}} .feature-bullet'     => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .shipping-icon'      => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tabs-trigger.active' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Tabs
        $this->start_controls_section(
            'style_tabs',
            [
                'label'     => esc_html__( 'Tabs', 'slidefirePro-widgets' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout_style' => 'tabs',
                ],
            ]
        );

        $this->add_control(
            'tabs_background',
            [
                'label'     => esc_html__( 'Tabs Background', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--card)',
                'selectors' => [
                    '{{WRAPPER}} .tabs-list' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'active_tab_background',
            [
                'label'     => esc_html__( 'Active Tab Background', 'slidefirePro-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'var(--card)',
                'selectors' => [
                    '{{WRAPPER}} .tabs-trigger.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        // Get product ID
        if ( 'custom' === $settings['product_source'] && ! empty( $settings['product_id'] ) ) {
            $product_id = intval( $settings['product_id'] );
        } else {
            global $product;
            if ( ! $product || ! is_object( $product ) ) {
                echo '<p>' . esc_html__( 'This widget should be used on a product page.', 'slidefirePro-widgets' ) . '</p>';
                return;
            }
            $product_id = $product->get_id();
        }

        // Get product data
        $features = WooCommerce_Product_Fields::get_product_features( $product_id );
        $shipping_info = WooCommerce_Product_Fields::get_product_shipping_info( $product_id );
        $specifications = WooCommerce_Product_Fields::get_product_specifications( $product_id );

        // Check if there's any content to display
        if ( empty( $features ) && empty( array_filter( $shipping_info ) ) && empty( $specifications ) ) {
            echo '<p>' . esc_html__( 'No product features or specifications found.', 'slidefirePro-widgets' ) . '</p>';
            return;
        }

        ?>
        <div class="slidefire-product-features" data-layout="<?php echo esc_attr( $settings['layout_style'] ); ?>">
            <?php if ( 'tabs' === $settings['layout_style'] ) : ?>
                <?php $this->render_tabs_layout( $settings, $features, $shipping_info, $specifications ); ?>
            <?php else : ?>
                <?php $this->render_stacked_layout( $settings, $features, $shipping_info, $specifications ); ?>
            <?php endif; ?>
        </div>
        <?php
    }

    private function render_tabs_layout( $settings, $features, $shipping_info, $specifications ) {
        $tabs = [];
        
        if ( 'yes' === $settings['show_features'] && ( ! empty( $features ) || ! empty( array_filter( $shipping_info ) ) ) ) {
            $tabs['features'] = esc_html__( 'Features', 'slidefirePro-widgets' );
        }
        
        if ( 'yes' === $settings['show_specifications'] && ! empty( $specifications ) ) {
            $tabs['specifications'] = esc_html__( 'Specifications', 'slidefirePro-widgets' );
        }
        
        if ( empty( $tabs ) ) {
            return;
        }
        ?>
        <div class="product-features-tabs">
            <!-- Tabs List -->
            <div class="tabs-list">
                <?php foreach ( $tabs as $tab_key => $tab_label ) : ?>
                    <button class="tabs-trigger <?php echo $tab_key === array_key_first( $tabs ) ? 'active' : ''; ?>" 
                            data-tab="<?php echo esc_attr( $tab_key ); ?>">
                        <?php echo esc_html( $tab_label ); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Tabs Content -->
            <div class="tabs-content-wrapper">
                <?php if ( isset( $tabs['features'] ) ) : ?>
                    <div class="tabs-content <?php echo 'features' === array_key_first( $tabs ) ? 'active' : ''; ?>" 
                         data-tab-content="features">
                        <?php $this->render_features_content( $features, $shipping_info, $settings ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( isset( $tabs['specifications'] ) ) : ?>
                    <div class="tabs-content <?php echo 'specifications' === array_key_first( $tabs ) ? 'active' : ''; ?>" 
                         data-tab-content="specifications">
                        <?php $this->render_specifications_content( $specifications ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    private function render_stacked_layout( $settings, $features, $shipping_info, $specifications ) {
        if ( 'yes' === $settings['show_features'] && ( ! empty( $features ) || ! empty( array_filter( $shipping_info ) ) ) ) {
            $this->render_features_content( $features, $shipping_info, $settings );
        }
        
        if ( 'yes' === $settings['show_specifications'] && ! empty( $specifications ) ) {
            echo '<div class="stacked-section-spacing"></div>';
            $this->render_specifications_content( $specifications );
        }
    }

    private function render_features_content( $features, $shipping_info, $settings ) {
        ?>
        <div class="features-grid">
            <?php if ( ! empty( $features ) ) : ?>
                <div class="product-features-card">
                    <h3 class="product-features-heading"><?php esc_html_e( 'Product Features', 'slidefirePro-widgets' ); ?></h3>
                    <ul class="features-list">
                        <?php foreach ( $features as $feature ) : ?>
                            <li class="feature-item">
                                <div class="feature-bullet"></div>
                                <span class="product-features-text"><?php echo esc_html( $feature ); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( 'yes' === $settings['show_shipping'] && ! empty( array_filter( $shipping_info ) ) ) : ?>
                <div class="product-features-card">
                    <h3 class="product-features-heading"><?php esc_html_e( 'Shipping & Turnaround Time', 'slidefirePro-widgets' ); ?></h3>
                    <div class="shipping-info">
                        <?php if ( ! empty( $shipping_info['production_time'] ) ) : ?>
                            <div class="shipping-item">
                                <svg class="shipping-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12,6 12,12 16,14"/>
                                </svg>
                                <div class="shipping-content">
                                    <p class="shipping-title"><?php esc_html_e( 'Production Time', 'slidefirePro-widgets' ); ?></p>
                                    <p class="product-features-text"><?php echo esc_html( $shipping_info['production_time'] ); ?></p>
                                    <?php if ( ! empty( $shipping_info['production_note'] ) ) : ?>
                                        <p class="shipping-note"><?php echo esc_html( $shipping_info['production_note'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $shipping_info['shipping_info'] ) ) : ?>
                            <div class="shipping-item">
                                <svg class="shipping-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m8 7 4-4 4 4"/>
                                    <path d="m16 17-4 4-4-4"/>
                                    <path d="M12 3v18"/>
                                    <rect width="7" height="14" x="1" y="7" rx="1"/>
                                    <rect width="7" height="14" x="16" y="7" rx="1"/>
                                </svg>
                                <div class="shipping-content">
                                    <p class="shipping-title"><?php esc_html_e( 'Shipping', 'slidefirePro-widgets' ); ?></p>
                                    <p class="product-features-text"><?php echo esc_html( $shipping_info['shipping_info'] ); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    private function render_specifications_content( $specifications ) {
        ?>
        <div class="product-features-card specifications-card">
            <h3 class="product-features-heading"><?php esc_html_e( 'Specifications', 'slidefirePro-widgets' ); ?></h3>
            <div class="specifications-list">
                <?php foreach ( $specifications as $spec ) : ?>
                    <?php if ( ! empty( $spec['name'] ) && ! empty( $spec['value'] ) ) : ?>
                        <div class="specification-item">
                            <span class="spec-name"><?php echo esc_html( $spec['name'] ); ?></span>
                            <span class="product-features-text spec-value"><?php echo esc_html( $spec['value'] ); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}