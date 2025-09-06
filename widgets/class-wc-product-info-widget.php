<?php
/**
 * WooCommerce Product Info Widget Class
 * 
 * @since 1.33.0
 */

class SlideFirePro_WC_Product_Info_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     */
    public function get_name() {
        return 'slidefire_wc_product_info';
    }

    /**
     * Get widget title.
     */
    public function get_title() {
        return esc_html__( 'WC Product Info', 'slidefire-pro' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-woocommerce';
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
        return [ 'woocommerce', 'product', 'info', 'jersey', 'badge', 'price', 'title', 'description' ];
    }

    /**
     * Get style dependencies.
     */
    public function get_style_depends() {
        return [ 'slidefire-wc-product-info-widget' ];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Product Info', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_category_badge',
            [
                'label' => esc_html__( 'Show Category Badge', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'slidefire-pro' ),
                'label_off' => esc_html__( 'Hide', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'category_text',
            [
                'label' => esc_html__( 'Category Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Jerseys',
                'condition' => [
                    'show_category_badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_new_badge',
            [
                'label' => esc_html__( 'Show NEW Badge', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'slidefire-pro' ),
                'label_off' => esc_html__( 'Hide', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'new_badge_text',
            [
                'label' => esc_html__( 'NEW Badge Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'NEW',
                'condition' => [
                    'show_new_badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'use_dynamic_title',
            [
                'label' => esc_html__( 'Use Dynamic Product Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefire-pro' ),
                'label_off' => esc_html__( 'No', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__( 'Automatically get product title from WooCommerce', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'product_title',
            [
                'label' => esc_html__( 'Product Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Alpha Series Speedsoft Jersey (No Padding)',
                'condition' => [
                    'use_dynamic_title!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'use_dynamic_price',
            [
                'label' => esc_html__( 'Use Dynamic Product Price', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefire-pro' ),
                'label_off' => esc_html__( 'No', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__( 'Automatically get product price from WooCommerce', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'current_price',
            [
                'label' => esc_html__( 'Current Price', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 89,
                'condition' => [
                    'use_dynamic_price!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'original_price',
            [
                'label' => esc_html__( 'Original Price', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 120,
                'condition' => [
                    'use_dynamic_price!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'use_dynamic_description',
            [
                'label' => esc_html__( 'Use Dynamic Product Description', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefire-pro' ),
                'label_off' => esc_html__( 'No', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__( 'Automatically get product short description from WooCommerce', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'product_description',
            [
                'label' => esc_html__( 'Product Description', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'The Alpha Series Speedsoft Jerseys (No Padding) is made from the same materials as the Pro Light and includes the same base features, but doesn\'t have any padding. This is perfect for players who are running their own padding and armor setup on the field and just want to represent their team colors in style.',
                'rows' => 4,
                'condition' => [
                    'use_dynamic_description!' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Styling', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-product-info' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-product-info' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slidefire-product-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slidefire-product-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => esc_html__( 'Primary Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-current-price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slidefire-discount-badge' => 'border-color: {{VALUE}}; color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'new_badge_color',
            [
                'label' => esc_html__( 'NEW Badge Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}} .slidefire-new-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get current product if we're on a product page
     */
    private function get_current_product() {
        global $product;
        
        if ( $product && is_a( $product, 'WC_Product' ) ) {
            return $product;
        }
        
        if ( is_product() ) {
            global $post;
            if ( $post ) {
                return wc_get_product( $post->ID );
            }
        }
        
        return null;
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $product = $this->get_current_product();
        
        ?>
        <div class="slidefire-product-info">
            <!-- Badge Section -->
            <div class="slidefire-badges-wrapper">
                <?php if ( 'yes' === $settings['show_category_badge'] ) : ?>
                    <span class="slidefire-category-badge">
                        <?php if ( $product && 'yes' === $settings['use_dynamic_title'] ) : ?>
                            <?php 
                            $categories = wp_get_post_terms( $product->get_id(), 'product_cat' );
                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                echo esc_html( $categories[0]->name );
                            } else {
                                echo esc_html( $settings['category_text'] );
                            }
                            ?>
                        <?php else : ?>
                            <?php echo esc_html( $settings['category_text'] ); ?>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>

                <?php if ( 'yes' === $settings['show_new_badge'] ) : ?>
                    <span class="slidefire-new-badge">
                        <?php echo esc_html( $settings['new_badge_text'] ); ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Product Title -->
            <h1 class="slidefire-product-title">
                <?php if ( $product && 'yes' === $settings['use_dynamic_title'] ) : ?>
                    <?php echo esc_html( $product->get_name() ); ?>
                <?php else : ?>
                    <?php echo esc_html( $settings['product_title'] ); ?>
                <?php endif; ?>
            </h1>

            <!-- Price Section -->
            <div class="slidefire-price-wrapper">
                <?php if ( $product && 'yes' === $settings['use_dynamic_price'] ) : ?>
                    <?php if ( $product->is_on_sale() ) : ?>
                        <span class="slidefire-current-price"><?php echo wc_price( $product->get_sale_price() ); ?></span>
                        <span class="slidefire-original-price"><?php echo wc_price( $product->get_regular_price() ); ?></span>
                        <?php 
                        $regular_price = (float) $product->get_regular_price();
                        $sale_price = (float) $product->get_sale_price();
                        if ( $regular_price > 0 && $sale_price > 0 ) {
                            $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                            ?>
                            <span class="slidefire-discount-badge">
                                <?php echo esc_html( $discount . '% OFF' ); ?>
                            </span>
                            <?php
                        }
                        ?>
                    <?php else : ?>
                        <span class="slidefire-current-price"><?php echo wc_price( $product->get_price() ); ?></span>
                    <?php endif; ?>
                <?php else : ?>
                    <span class="slidefire-current-price">$<?php echo esc_html( $settings['current_price'] ); ?></span>
                    <?php if ( $settings['original_price'] && $settings['original_price'] > $settings['current_price'] ) : ?>
                        <span class="slidefire-original-price">$<?php echo esc_html( $settings['original_price'] ); ?></span>
                        <?php 
                        $discount = round( ( ( $settings['original_price'] - $settings['current_price'] ) / $settings['original_price'] ) * 100 );
                        ?>
                        <span class="slidefire-discount-badge">
                            <?php echo esc_html( $discount . '% OFF' ); ?>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Product Description -->
            <p class="slidefire-product-description">
                <?php if ( $product && 'yes' === $settings['use_dynamic_description'] ) : ?>
                    <?php 
                    $short_description = $product->get_short_description();
                    if ( $short_description ) {
                        echo wp_kses_post( $short_description );
                    } else {
                        echo esc_html( $settings['product_description'] );
                    }
                    ?>
                <?php else : ?>
                    <?php echo wp_kses_post( $settings['product_description'] ); ?>
                <?php endif; ?>
            </p>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor.
     */
    protected function content_template() {
        ?>
        <div class="slidefire-product-info">
            <!-- Badge Section -->
            <div class="slidefire-badges-wrapper">
                <# if ( 'yes' === settings.show_category_badge ) { #>
                    <span class="slidefire-category-badge">
                        {{{ settings.category_text }}}
                    </span>
                <# } #>

                <# if ( 'yes' === settings.show_new_badge ) { #>
                    <span class="slidefire-new-badge">
                        {{{ settings.new_badge_text }}}
                    </span>
                <# } #>
            </div>

            <!-- Product Title -->
            <h1 class="slidefire-product-title">
                <# if ( 'yes' === settings.use_dynamic_title ) { #>
                    Dynamic Product Title (Live Preview)
                <# } else { #>
                    {{{ settings.product_title }}}
                <# } #>
            </h1>

            <!-- Price Section -->
            <div class="slidefire-price-wrapper">
                <# if ( 'yes' === settings.use_dynamic_price ) { #>
                    <span class="slidefire-current-price">$89</span>
                    <span class="slidefire-original-price">$120</span>
                    <span class="slidefire-discount-badge">26% OFF</span>
                <# } else { #>
                    <span class="slidefire-current-price">${{{ settings.current_price }}}</span>
                    <# if ( settings.original_price && settings.original_price > settings.current_price ) { #>
                        <span class="slidefire-original-price">${{{ settings.original_price }}}</span>
                        <# 
                        var discount = Math.round( ( ( settings.original_price - settings.current_price ) / settings.original_price ) * 100 );
                        #>
                        <span class="slidefire-discount-badge">
                            {{ discount }}% OFF
                        </span>
                    <# } #>
                <# } #>
            </div>

            <!-- Product Description -->
            <p class="slidefire-product-description">
                <# if ( 'yes' === settings.use_dynamic_description ) { #>
                    Dynamic product description from WooCommerce (Live Preview)
                <# } else { #>
                    {{{ settings.product_description }}}
                <# } #>
            </p>
        </div>
        <?php
    }
}