<?php
/**
 * Returns Policy Widget Class
 * 
 * @since 1.2.0
 */

class SlideFirePro_Returns_Policy_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     */
    public function get_name() {
        return 'slidefire_returns_policy';
    }

    /**
     * Get widget title.
     */
    public function get_title() {
        return esc_html__( 'Returns Policy', 'slidefire-pro' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-shield-check';
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
        return [ 'returns', 'policy', 'refund', 'guarantee', 'terms' ];
    }

    /**
     * Get style dependencies.
     */
    public function get_style_depends() {
        return [ 'slidefire-returns-policy-widget' ];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        
        // Header Section
        $this->start_controls_section(
            'header_section',
            [
                'label' => esc_html__( 'Header', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_back_button',
            [
                'label' => esc_html__( 'Show Back Button', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'slidefire-pro' ),
                'label_off' => esc_html__( 'Hide', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'back_button_text',
            [
                'label' => esc_html__( 'Back Button Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Back to Home', 'slidefire-pro' ),
                'condition' => [
                    'show_back_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'back_button_url',
            [
                'label' => esc_html__( 'Back Button URL', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'slidefire-pro' ),
                'default' => [
                    'url' => home_url(),
                ],
                'condition' => [
                    'show_back_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_part_1',
            [
                'label' => esc_html__( 'Title (Part 1)', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Refunds &', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'title_part_2',
            [
                'label' => esc_html__( 'Title (Part 2 - Gradient)', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( ' Returns', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'We want you to love your purchases, but we get it – sometimes things don\'t quite slide into place.', 'slidefire-pro' ),
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Introduction Section
        $this->start_controls_section(
            'intro_section',
            [
                'label' => esc_html__( 'Introduction', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'intro_title',
            [
                'label' => esc_html__( 'Introduction Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Need to return?', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'intro_text',
            [
                'label' => esc_html__( 'Introduction Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Don\'t worry, we\'re here to make it right! Here\'s the scoop on our Returns and Refunds Policy:', 'slidefire-pro' ),
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Returns Section
        $this->start_controls_section(
            'returns_section',
            [
                'label' => esc_html__( 'Returns Section', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'returns_title',
            [
                'label' => esc_html__( 'Returns Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '1. Returns', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'returns_badge',
            [
                'label' => esc_html__( 'Returns Badge Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Easy Return Process', 'slidefire-pro' ),
            ]
        );

        // Returns Items Repeater
        $returns_repeater = new \Elementor\Repeater();

        $returns_repeater->add_control(
            'item_title',
            [
                'label' => esc_html__( 'Item Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Item Title', 'slidefire-pro' ),
            ]
        );

        $returns_repeater->add_control(
            'item_content',
            [
                'label' => esc_html__( 'Item Content', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Item content goes here...', 'slidefire-pro' ),
            ]
        );

        $returns_repeater->add_control(
            'item_type',
            [
                'label' => esc_html__( 'Item Type', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => esc_html__( 'Primary', 'slidefire-pro' ),
                    'yellow' => esc_html__( 'Warning', 'slidefire-pro' ),
                    'green' => esc_html__( 'Success', 'slidefire-pro' ),
                    'destructive' => esc_html__( 'Destructive', 'slidefire-pro' ),
                ],
            ]
        );

        $this->add_control(
            'returns_items',
            [
                'label' => esc_html__( 'Returns Items', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $returns_repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__( '1.1 Time Frame', 'slidefire-pro' ),
                        'item_content' => 'You have <span class="highlight">30 days</span> from the date of purchase to return your item. If you\'re not sliding with joy, we\'ll gladly take it back.',
                        'item_type' => 'primary',
                    ],
                    [
                        'item_title' => esc_html__( '1.2 Return Condition', 'slidefire-pro' ),
                        'item_content' => 'Please make sure your item is in its <span class="highlight">original, unworn, and tag-hanging state</span>. We love the sweaty vibe, but we can\'t accept returns for items that have been played in.',
                        'item_type' => 'yellow',
                    ],
                    [
                        'item_title' => esc_html__( '1.3 Proof of Purchase', 'slidefire-pro' ),
                        'item_content' => 'To complete your return, we require a <span class="highlight">receipt or proof of purchase</span>. Please ensure to include this with your returned item.',
                        'item_type' => 'green',
                    ],
                    [
                        'item_title' => esc_html__( '1.4 Custom Gear', 'slidefire-pro' ),
                        'item_content' => 'Some items are just too unique to return, like <span class="highlight">personalized gear or items with custom designs, names and numbers</span>. We don\'t accept returns on personalized gear.',
                        'item_type' => 'destructive',
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Refunds Section
        $this->start_controls_section(
            'refunds_section',
            [
                'label' => esc_html__( 'Refunds Section', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'refunds_title',
            [
                'label' => esc_html__( 'Refunds Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '2. Refunds', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'refunds_badge',
            [
                'label' => esc_html__( 'Refunds Badge Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Fast Processing', 'slidefire-pro' ),
            ]
        );

        // Refunds Items Repeater
        $refunds_repeater = new \Elementor\Repeater();

        $refunds_repeater->add_control(
            'item_title',
            [
                'label' => esc_html__( 'Item Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Item Title', 'slidefire-pro' ),
            ]
        );

        $refunds_repeater->add_control(
            'item_content',
            [
                'label' => esc_html__( 'Item Content', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Item content goes here...', 'slidefire-pro' ),
            ]
        );

        $refunds_repeater->add_control(
            'item_type',
            [
                'label' => esc_html__( 'Item Type', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => esc_html__( 'Primary', 'slidefire-pro' ),
                    'yellow' => esc_html__( 'Warning', 'slidefire-pro' ),
                    'green' => esc_html__( 'Success', 'slidefire-pro' ),
                    'destructive' => esc_html__( 'Destructive', 'slidefire-pro' ),
                ],
            ]
        );

        $refunds_repeater->add_control(
            'show_new_badge',
            [
                'label' => esc_html__( 'Show NEW Badge', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'slidefire-pro' ),
                'label_off' => esc_html__( 'Hide', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'refunds_items',
            [
                'label' => esc_html__( 'Refunds Items', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $refunds_repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__( '2.1 How it works', 'slidefire-pro' ),
                        'item_content' => 'Once we receive your returned item and it passes our <span class="highlight">slide inspection</span>, we\'ll process the refund. Expect your refund in the same way you paid.',
                        'item_type' => 'primary',
                        'show_new_badge' => 'no',
                    ],
                    [
                        'item_title' => esc_html__( '2.2 SlideFirePro Credits', 'slidefire-pro' ),
                        'item_content' => 'We also offer <span class="highlight">SlideFirePro store credit</span> as an alternative to a refund.',
                        'item_type' => 'primary',
                        'show_new_badge' => 'yes',
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Contact Section
        $this->start_controls_section(
            'contact_section',
            [
                'label' => esc_html__( 'Contact Section', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_title',
            [
                'label' => esc_html__( 'Contact Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Need Help?', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'contact_text',
            [
                'label' => esc_html__( 'Contact Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'If you need to contact us about anything related to your gear – please fill out the email form below.', 'slidefire-pro' ),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'contact_button_text',
            [
                'label' => esc_html__( 'Contact Button Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Contact Us', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'contact_button_url',
            [
                'label' => esc_html__( 'Contact Button URL', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'slidefire-pro' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Footer Section
        $this->start_controls_section(
            'footer_section',
            [
                'label' => esc_html__( 'Footer', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'footer_text',
            [
                'label' => esc_html__( 'Footer Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'This policy is designed to ensure a smooth experience for all SlideFirePro customers. We reserve the right to update this policy as needed.', 'slidefire-pro' ),
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Style Tab - Typography
        $this->start_controls_section(
            'typography_section',
            [
                'label' => esc_html__( 'Typography', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'slidefire-pro' ),
                'selector' => '{{WRAPPER}} .returns-policy-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__( 'Subtitle Typography', 'slidefire-pro' ),
                'selector' => '{{WRAPPER}} .returns-policy-subtitle',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Content Typography', 'slidefire-pro' ),
                'selector' => '{{WRAPPER}} .returns-policy-item-content p, {{WRAPPER}} .returns-policy-intro-text',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Colors
        $this->start_controls_section(
            'colors_section',
            [
                'label' => esc_html__( 'Colors', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => esc_html__( 'Primary Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#23B2EE',
                'selectors' => [
                    '{{WRAPPER}}' => '--slidefire-primary: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}}' => '--slidefire-background: {{VALUE}};',
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
                    '{{WRAPPER}}' => '--slidefire-foreground: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'muted_text_color',
            [
                'label' => esc_html__( 'Muted Text Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}}' => '--slidefire-muted-foreground: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_background',
            [
                'label' => esc_html__( 'Card Background', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}}' => '--slidefire-card: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}}' => '--slidefire-border: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'destructive_color',
            [
                'label' => esc_html__( 'Destructive Color', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff3366',
                'selectors' => [
                    '{{WRAPPER}}' => '--slidefire-destructive: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <div class="slidefire-returns-policy-widget">
            <div class="returns-policy-container">
                
                <!-- Header -->
                <div class="returns-policy-header">
                    <?php if ( 'yes' === $settings['show_back_button'] && ! empty( $settings['back_button_text'] ) ) : 
                        $back_url = ! empty( $settings['back_button_url']['url'] ) ? $settings['back_button_url']['url'] : home_url();
                        $target = $settings['back_button_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $settings['back_button_url']['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <a href="<?php echo esc_url( $back_url ); ?>" class="returns-policy-back-button"<?php echo $target . $nofollow; ?>>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <?php echo esc_html( $settings['back_button_text'] ); ?>
                        </a>
                    <?php endif; ?>
                    
                    <div>
                        <h1 class="returns-policy-title">
                            <?php echo esc_html( $settings['title_part_1'] ); ?>
                            <span class="returns-policy-title-gradient"><?php echo esc_html( $settings['title_part_2'] ); ?></span>
                        </h1>
                        <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                            <p class="returns-policy-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Content -->
                <div class="returns-policy-content">
                    
                    <!-- Introduction Card -->
                    <?php if ( ! empty( $settings['intro_title'] ) || ! empty( $settings['intro_text'] ) ) : ?>
                        <div class="returns-policy-card returns-policy-intro-card">
                            <div class="returns-policy-intro-content">
                                <div class="returns-policy-intro-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <div>
                                    <?php if ( ! empty( $settings['intro_title'] ) ) : ?>
                                        <h2 class="returns-policy-intro-title"><?php echo esc_html( $settings['intro_title'] ); ?></h2>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $settings['intro_text'] ) ) : ?>
                                        <p class="returns-policy-intro-text"><?php echo esc_html( $settings['intro_text'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Returns Section -->
                    <?php if ( ! empty( $settings['returns_title'] ) || ! empty( $settings['returns_items'] ) ) : ?>
                        <div class="returns-policy-card returns-policy-card-lg">
                            <div class="returns-policy-section-header">
                                <div class="returns-policy-section-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <div>
                                    <?php if ( ! empty( $settings['returns_title'] ) ) : ?>
                                        <h2 class="returns-policy-section-title"><?php echo esc_html( $settings['returns_title'] ); ?></h2>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $settings['returns_badge'] ) ) : ?>
                                        <div class="returns-policy-badge returns-policy-badge-primary">
                                            <?php echo esc_html( $settings['returns_badge'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if ( ! empty( $settings['returns_items'] ) ) : ?>
                                <div class="returns-policy-items">
                                    <?php foreach ( $settings['returns_items'] as $item ) : ?>
                                        <div class="returns-policy-item <?php echo esc_attr( $item['item_type'] ); ?>">
                                            <div class="returns-policy-item-icon <?php echo esc_attr( $item['item_type'] ); ?>">
                                                <?php $this->render_item_icon( $item['item_type'] ); ?>
                                            </div>
                                            <div class="returns-policy-item-content">
                                                <?php if ( ! empty( $item['item_title'] ) ) : ?>
                                                    <h3><?php echo esc_html( $item['item_title'] ); ?></h3>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $item['item_content'] ) ) : ?>
                                                    <p><?php echo wp_kses_post( $item['item_content'] ); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Refunds Section -->
                    <?php if ( ! empty( $settings['refunds_title'] ) || ! empty( $settings['refunds_items'] ) ) : ?>
                        <div class="returns-policy-card returns-policy-card-lg">
                            <div class="returns-policy-section-header">
                                <div class="returns-policy-section-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <?php if ( ! empty( $settings['refunds_title'] ) ) : ?>
                                        <h2 class="returns-policy-section-title"><?php echo esc_html( $settings['refunds_title'] ); ?></h2>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $settings['refunds_badge'] ) ) : ?>
                                        <div class="returns-policy-badge returns-policy-badge-green">
                                            <?php echo esc_html( $settings['refunds_badge'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if ( ! empty( $settings['refunds_items'] ) ) : ?>
                                <div class="returns-policy-items">
                                    <?php foreach ( $settings['refunds_items'] as $item ) : ?>
                                        <div class="returns-policy-item <?php echo esc_attr( $item['item_type'] ); ?>">
                                            <?php if ( 'yes' === $item['show_new_badge'] ) : ?>
                                                <div class="returns-policy-item-icon">
                                                    <div class="returns-policy-badge returns-policy-badge-new">NEW</div>
                                                </div>
                                            <?php else : ?>
                                                <div class="returns-policy-item-icon <?php echo esc_attr( $item['item_type'] ); ?>">
                                                    <?php $this->render_item_icon( $item['item_type'] ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="returns-policy-item-content">
                                                <?php if ( ! empty( $item['item_title'] ) ) : ?>
                                                    <h3><?php echo esc_html( $item['item_title'] ); ?></h3>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $item['item_content'] ) ) : ?>
                                                    <p><?php echo wp_kses_post( $item['item_content'] ); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Contact Section -->
                    <?php if ( ! empty( $settings['contact_title'] ) || ! empty( $settings['contact_text'] ) ) : ?>
                        <div class="returns-policy-card returns-policy-card-lg returns-policy-contact-card">
                            <div class="returns-policy-contact-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <?php if ( ! empty( $settings['contact_title'] ) ) : ?>
                                <h2 class="returns-policy-contact-title"><?php echo esc_html( $settings['contact_title'] ); ?></h2>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['contact_text'] ) ) : ?>
                                <p class="returns-policy-contact-text"><?php echo esc_html( $settings['contact_text'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['contact_button_text'] ) && ! empty( $settings['contact_button_url']['url'] ) ) : 
                                $contact_url = $settings['contact_button_url']['url'];
                                $target = $settings['contact_button_url']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $settings['contact_button_url']['nofollow'] ? ' rel="nofollow"' : '';
                                ?>
                                <a href="<?php echo esc_url( $contact_url ); ?>" class="returns-policy-contact-button"<?php echo $target . $nofollow; ?>>
                                    <?php echo esc_html( $settings['contact_button_text'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Footer -->
                    <?php if ( ! empty( $settings['footer_text'] ) ) : ?>
                        <div class="returns-policy-footer">
                            <p><?php echo esc_html( $settings['footer_text'] ); ?></p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        
        <?php
    }

    /**
     * Render item icon based on type
     */
    private function render_item_icon( $type ) {
        switch ( $type ) {
            case 'primary':
                echo '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                break;
            case 'yellow':
                echo '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
                break;
            case 'green':
                echo '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>';
                break;
            case 'destructive':
                echo '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
                break;
            default:
                echo '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        }
    }

    /**
     * Render widget output in the editor.
     */
    protected function content_template() {
        ?>
        <div class="slidefire-returns-policy-widget">
            <div class="returns-policy-container">
                
                <!-- Header -->
                <div class="returns-policy-header">
                    <# if ( 'yes' === settings.show_back_button && settings.back_button_text ) { #>
                        <a href="{{{ settings.back_button_url.url || '#' }}}" class="returns-policy-back-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            {{{ settings.back_button_text }}}
                        </a>
                    <# } #>
                    
                    <div>
                        <h1 class="returns-policy-title">
                            {{{ settings.title_part_1 }}}
                            <span class="returns-policy-title-gradient">{{{ settings.title_part_2 }}}</span>
                        </h1>
                        <# if ( settings.subtitle ) { #>
                            <p class="returns-policy-subtitle">{{{ settings.subtitle }}}</p>
                        <# } #>
                    </div>
                </div>

                <!-- Content -->
                <div class="returns-policy-content">
                    
                    <!-- Introduction Card -->
                    <# if ( settings.intro_title || settings.intro_text ) { #>
                        <div class="returns-policy-card returns-policy-intro-card">
                            <div class="returns-policy-intro-content">
                                <div class="returns-policy-intro-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <div>
                                    <# if ( settings.intro_title ) { #>
                                        <h2 class="returns-policy-intro-title">{{{ settings.intro_title }}}</h2>
                                    <# } #>
                                    <# if ( settings.intro_text ) { #>
                                        <p class="returns-policy-intro-text">{{{ settings.intro_text }}}</p>
                                    <# } #>
                                </div>
                            </div>
                        </div>
                    <# } #>

                    <!-- Returns Section -->
                    <# if ( settings.returns_title || settings.returns_items.length ) { #>
                        <div class="returns-policy-card returns-policy-card-lg">
                            <div class="returns-policy-section-header">
                                <div class="returns-policy-section-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <div>
                                    <# if ( settings.returns_title ) { #>
                                        <h2 class="returns-policy-section-title">{{{ settings.returns_title }}}</h2>
                                    <# } #>
                                    <# if ( settings.returns_badge ) { #>
                                        <div class="returns-policy-badge returns-policy-badge-primary">
                                            {{{ settings.returns_badge }}}
                                        </div>
                                    <# } #>
                                </div>
                            </div>

                            <# if ( settings.returns_items.length ) { #>
                                <div class="returns-policy-items">
                                    <# _.each( settings.returns_items, function( item ) { #>
                                        <div class="returns-policy-item {{{ item.item_type }}}">
                                            <div class="returns-policy-item-icon {{{ item.item_type }}}">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="returns-policy-item-content">
                                                <# if ( item.item_title ) { #>
                                                    <h3>{{{ item.item_title }}}</h3>
                                                <# } #>
                                                <# if ( item.item_content ) { #>
                                                    <p>{{{ item.item_content }}}</p>
                                                <# } #>
                                            </div>
                                        </div>
                                    <# }); #>
                                </div>
                            <# } #>
                        </div>
                    <# } #>

                    <!-- Contact Section -->
                    <# if ( settings.contact_title || settings.contact_text ) { #>
                        <div class="returns-policy-card returns-policy-card-lg returns-policy-contact-card">
                            <div class="returns-policy-contact-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <# if ( settings.contact_title ) { #>
                                <h2 class="returns-policy-contact-title">{{{ settings.contact_title }}}</h2>
                            <# } #>
                            <# if ( settings.contact_text ) { #>
                                <p class="returns-policy-contact-text">{{{ settings.contact_text }}}</p>
                            <# } #>
                            <# if ( settings.contact_button_text && settings.contact_button_url.url ) { #>
                                <a href="{{{ settings.contact_button_url.url }}}" class="returns-policy-contact-button">
                                    {{{ settings.contact_button_text }}}
                                </a>
                            <# } #>
                        </div>
                    <# } #>

                    <!-- Footer -->
                    <# if ( settings.footer_text ) { #>
                        <div class="returns-policy-footer">
                            <p>{{{ settings.footer_text }}}</p>
                        </div>
                    <# } #>

                </div>
            </div>
        </div>
        <?php
    }
}