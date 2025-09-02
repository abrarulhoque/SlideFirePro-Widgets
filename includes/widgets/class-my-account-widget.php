<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class My_Account_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-my-account';
	}

	public function get_title(): string {
		return esc_html__( 'My Account Dashboard', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-person';
	}

	public function get_categories(): array {
		return [ 'woocommerce-elements' ];
	}

	public function get_keywords(): array {
		return [ 'woocommerce', 'my account', 'dashboard', 'profile', 'orders', 'user' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-my-account' ];
	}

	public function get_script_depends(): array {
		return [ 'slidefirePro-my-account' ];
	}

	protected function register_controls(): void {

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'My Account Settings', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_header',
			[
				'label' => esc_html__( 'Show Header', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'page_title',
			[
				'label' => esc_html__( 'Page Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'My Account', 'slidefirePro-widgets' ),
				'condition' => [
					'show_header' => 'yes',
				],
			]
		);

		$this->add_control(
			'page_subtitle',
			[
				'label' => esc_html__( 'Page Subtitle', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Manage your SlideFirePro account, orders, and preferences', 'slidefirePro-widgets' ),
				'condition' => [
					'show_header' => 'yes',
				],
			]
		);

		$this->add_control(
			'default_tab',
			[
				'label' => esc_html__( 'Default Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'dashboard' => esc_html__( 'Dashboard', 'slidefirePro-widgets' ),
					'orders' => esc_html__( 'Orders', 'slidefirePro-widgets' ),
					'downloads' => esc_html__( 'Downloads', 'slidefirePro-widgets' ),
					'edit-address' => esc_html__( 'Addresses', 'slidefirePro-widgets' ),
					'edit-account' => esc_html__( 'Account Details', 'slidefirePro-widgets' ),
					'customer-logout' => esc_html__( 'Logout', 'slidefirePro-widgets' ),
				],
				'default' => 'dashboard',
			]
		);

		$this->end_controls_section();

		// Tab Settings Section
		$this->start_controls_section(
			'tab_settings_section',
			[
				'label' => esc_html__( 'Tab Settings', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_profile_tab',
			[
				'label' => esc_html__( 'Show Profile Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_orders_tab',
			[
				'label' => esc_html__( 'Show Orders Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_addresses_tab',
			[
				'label' => esc_html__( 'Show Addresses Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_payments_tab',
			[
				'label' => esc_html__( 'Show Payment Methods Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_notifications_tab',
			[
				'label' => esc_html__( 'Show Notifications Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_security_tab',
			[
				'label' => esc_html__( 'Show Security Tab', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Style Controls
		$this->start_controls_section(
			'header_style_section',
			[
				'label' => esc_html__( 'Header Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_header' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .my-account-header h1',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .my-account-header h1' => 'color: {{VALUE}};',
					'{{WRAPPER}} .my-account-header .title-gradient' => 'background: linear-gradient(to right, var(--primary), #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .my-account-header .subtitle',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .my-account-header .subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Tab Style Section
		$this->start_controls_section(
			'tab_style_section',
			[
				'label' => esc_html__( 'Tab Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_background_color',
			[
				'label' => esc_html__( 'Tab Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .my-account-tabs .tab-trigger' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_background_color',
			[
				'label' => esc_html__( 'Active Tab Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .my-account-tabs .tab-trigger.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
				'selector' => '{{WRAPPER}} .my-account-tabs .tab-trigger',
			]
		);

		$this->end_controls_section();

		// Card Style Section
		$this->start_controls_section(
			'card_style_section',
			[
				'label' => esc_html__( 'Card Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_background_color',
			[
				'label' => esc_html__( 'Card Background Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .my-account-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .my-account-card',
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .my-account-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .my-account-card',
			]
		);

		$this->end_controls_section();
	}

    protected function render(): void {
        if ( ! class_exists( 'WooCommerce' ) ) {
            echo '<div class="slidefirePro-no-woocommerce">' . esc_html__( 'WooCommerce is not active.', 'slidefirePro-widgets' ) . '</div>';
            return;
        }

        if ( ! is_user_logged_in() ) {
            echo '<div class="my-account-login-prompt">';
            echo '<p>' . esc_html__( 'Please log in to access your account dashboard.', 'slidefirePro-widgets' ) . '</p>';
            wc_get_template( 'myaccount/form-login.php' );
            echo '</div>';
            return;
        }

        $settings      = $this->get_settings_for_display();
        $current_user  = wp_get_current_user();
        $my_account_url = wc_get_page_permalink( 'myaccount' );

        // Detect current WooCommerce endpoint to keep the widget in sync with Woo flows
        $current_endpoint = 'dashboard';
        if ( function_exists( 'is_wc_endpoint_url' ) ) {
            foreach ( [ 'orders', 'view-order', 'downloads', 'edit-address', 'edit-account', 'payment-methods', 'add-payment-method' ] as $ep ) {
                if ( is_wc_endpoint_url( $ep ) ) {
                    $current_endpoint = $ep;
                    break;
                }
            }
        }

        // Map endpoints to local tab keys used in the UI
        $endpoint_to_tab = [
            'dashboard'        => 'profile',
            'edit-account'     => 'profile',
            'orders'           => 'orders',
            'view-order'       => 'orders',
            'edit-address'     => 'addresses',
            'payment-methods'  => 'payments',
            'add-payment-method' => 'payments',
        ];
        $active_tab = isset( $endpoint_to_tab[ $current_endpoint ] ) ? $endpoint_to_tab[ $current_endpoint ] : 'profile';
		?>
		
		<section class="my-account-wrapper bg-background min-h-screen py-20">
			<div class="container mx-auto px-4">
				
				<?php if ( 'yes' === $settings['show_header'] ) : ?>
				<!-- Header -->
				<div class="my-account-header mb-12">
					<h1 class="text-4xl md:text-5xl font-bold mb-4">
						<?php 
						$title_parts = explode( ' ', $settings['page_title'] );
						if ( count( $title_parts ) > 1 ) {
							$last_word = array_pop( $title_parts );
							echo esc_html( implode( ' ', $title_parts ) );
							echo '<span class="title-gradient"> ' . esc_html( $last_word ) . '</span>';
						} else {
							echo esc_html( $settings['page_title'] );
						}
						?>
					</h1>
					<p class="subtitle text-xl text-muted-foreground">
						<?php echo esc_html( $settings['page_subtitle'] ); ?>
					</p>
				</div>
				<?php endif; ?>

				<div class="my-account-tabs-wrapper">
					<!-- Tab Navigation -->
                    <div class="my-account-tabs grid grid-cols-4 lg:grid-cols-6 gap-0 bg-card border border-border rounded-lg mb-8 overflow-hidden">
                        <?php if ( 'yes' === $settings['show_profile_tab'] ) : ?>
                        <a class="tab-trigger <?php echo ( 'profile' === $active_tab ) ? 'active' : ''; ?> bg-transparent border-0 p-4 text-center cursor-pointer transition-all duration-200 hover:bg-muted" data-tab="profile" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account', '', $my_account_url ) ); ?>">
                            <?php esc_html_e( 'Profile', 'slidefirePro-widgets' ); ?>
                        </a>
                        <?php endif; ?>
                        
                        <?php if ( 'yes' === $settings['show_orders_tab'] ) : ?>
                        <a class="tab-trigger <?php echo ( 'orders' === $active_tab ) ? 'active' : ''; ?> bg-transparent border-0 p-4 text-center cursor-pointer transition-all duration-200 hover:bg-muted" data-tab="orders" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', '', $my_account_url ) ); ?>">
                            <?php esc_html_e( 'Orders', 'slidefirePro-widgets' ); ?>
                        </a>
                        <?php endif; ?>
                        
                        <?php if ( 'yes' === $settings['show_addresses_tab'] ) : ?>
                        <a class="tab-trigger <?php echo ( 'addresses' === $active_tab ) ? 'active' : ''; ?> bg-transparent border-0 p-4 text-center cursor-pointer transition-all duration-200 hover:bg-muted" data-tab="addresses" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', '', $my_account_url ) ); ?>">
                            <?php esc_html_e( 'Addresses', 'slidefirePro-widgets' ); ?>
                        </a>
                        <?php endif; ?>
                        
                        <?php if ( 'yes' === $settings['show_payments_tab'] ) : ?>
                        <a class="tab-trigger <?php echo ( 'payments' === $active_tab ) ? 'active' : ''; ?> bg-transparent border-0 p-4 text-center cursor-pointer transition-all duration-200 hover:bg-muted" data-tab="payments" href="<?php echo esc_url( wc_get_endpoint_url( 'payment-methods', '', $my_account_url ) ); ?>">
                            <?php esc_html_e( 'Payment', 'slidefirePro-widgets' ); ?>
                        </a>
                        <?php endif; ?>
                        
                        <?php if ( 'yes' === $settings['show_notifications_tab'] ) : ?>
                        <a class="tab-trigger <?php echo ( 'notifications' === $active_tab ) ? 'active' : ''; ?> bg-transparent border-0 p-4 text-center cursor-pointer transition-all duration-200 hover:bg-muted" data-tab="notifications" href="#notifications">
                            <?php esc_html_e( 'Notifications', 'slidefirePro-widgets' ); ?>
                        </a>
                        <?php endif; ?>
                        
                        <?php if ( 'yes' === $settings['show_security_tab'] ) : ?>
                        <a class="tab-trigger <?php echo ( 'security' === $active_tab ) ? 'active' : ''; ?> bg-transparent border-0 p-4 text-center cursor-pointer transition-all duration-200 hover:bg-muted" data-tab="security" href="#security">
                            <?php esc_html_e( 'Security', 'slidefirePro-widgets' ); ?>
                        </a>
                        <?php endif; ?>
                    </div>

					<!-- Tab Content -->
					<div class="tab-content-wrapper space-y-8">
						
                        <?php if ( 'yes' === $settings['show_profile_tab'] ) : ?>
                        <!-- Profile / Account Details Tab -->
                        <div class="tab-content <?php echo ( 'profile' === $active_tab ) ? 'active' : ''; ?>" id="tab-profile">
                            <?php $this->render_profile_tab( $current_user ); ?>
                        </div>
                        <?php endif; ?>
						
						<?php if ( 'yes' === $settings['show_orders_tab'] ) : ?>
						<!-- Orders Tab -->
                        <div class="tab-content <?php echo ( 'orders' === $active_tab ) ? 'active' : ''; ?>" id="tab-orders">
                            <?php $this->render_orders_tab(); ?>
                        </div>
						<?php endif; ?>
						
						<?php if ( 'yes' === $settings['show_addresses_tab'] ) : ?>
						<!-- Addresses Tab -->
                        <div class="tab-content <?php echo ( 'addresses' === $active_tab ) ? 'active' : ''; ?>" id="tab-addresses">
                            <?php $this->render_addresses_tab(); ?>
                        </div>
						<?php endif; ?>
						
						<?php if ( 'yes' === $settings['show_payments_tab'] ) : ?>
						<!-- Payment Methods Tab -->
                        <div class="tab-content <?php echo ( 'payments' === $active_tab ) ? 'active' : ''; ?>" id="tab-payments">
                            <?php $this->render_payments_tab(); ?>
                        </div>
						<?php endif; ?>
						
						<?php if ( 'yes' === $settings['show_notifications_tab'] ) : ?>
						<!-- Notifications Tab -->
                        <div class="tab-content <?php echo ( 'notifications' === $active_tab ) ? 'active' : ''; ?>" id="tab-notifications">
                            <?php $this->render_notifications_tab(); ?>
                        </div>
						<?php endif; ?>
						
						<?php if ( 'yes' === $settings['show_security_tab'] ) : ?>
						<!-- Security Tab -->
                        <div class="tab-content <?php echo ( 'security' === $active_tab ) ? 'active' : ''; ?>" id="tab-security">
                            <?php $this->render_security_tab(); ?>
                        </div>
                        
                        <?php
                        // Handle special Woo endpoints without explicit tabs (e.g., downloads)
                        if ( in_array( $current_endpoint, [ 'downloads' ], true ) ) : ?>
                            <div class="tab-content active" id="tab-generic">
                                <div class="my-account-card p-6 bg-card border border-border rounded-lg">
                                    <?php
                                    if ( 'downloads' === $current_endpoint ) {
                                        wc_get_template( 'myaccount/downloads.php' );
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		
		<?php
	}

	/**
	 * Render Profile Tab
	 */
	private function render_profile_tab( $current_user ): void {
		?>
		<div class="my-account-card p-8 bg-card border border-border rounded-lg">
			<div class="profile-header flex items-center justify-between mb-6">
				<h2 class="text-2xl font-bold"><?php esc_html_e( 'Profile Information', 'slidefirePro-widgets' ); ?></h2>
				<button class="profile-edit-btn inline-flex items-center gap-2 px-4 py-2 border border-primary text-primary rounded-md hover:bg-primary/10 transition-colors">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
					</svg>
					<?php esc_html_e( 'Edit', 'slidefirePro-widgets' ); ?>
				</button>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
				<div class="profile-info space-y-6">
					<div class="profile-avatar flex items-center space-x-4 mb-6">
						<div class="w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center">
							<svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
							</svg>
						</div>
						<div>
							<h3 class="text-xl font-semibold"><?php echo esc_html( $current_user->display_name ); ?></h3>
							<p class="text-muted-foreground"><?php esc_html_e( 'SpeedSoft Enthusiast', 'slidefirePro-widgets' ); ?></p>
							<span class="inline-flex items-center px-3 py-1 mt-2 text-sm border border-primary text-primary rounded-full">
								<?php esc_html_e( 'Premium Member', 'slidefirePro-widgets' ); ?>
							</span>
						</div>
					</div>

					<?php wc_get_template( 'myaccount/form-edit-account.php' ); ?>
				</div>

				<div class="profile-stats space-y-6">
					<div>
						<h3 class="text-lg font-semibold mb-4"><?php esc_html_e( 'Account Stats', 'slidefirePro-widgets' ); ?></h3>
						<div class="grid grid-cols-2 gap-4">
							<?php
							$customer_orders = wc_get_customer_order_count( $current_user->ID );
							$total_spent = wc_get_customer_total_spent( $current_user->ID );
							?>
							<div class="stat-card p-4 bg-muted border border-border rounded-lg text-center">
								<div class="text-2xl font-bold text-primary"><?php echo esc_html( $customer_orders ); ?></div>
								<div class="text-sm text-muted-foreground"><?php esc_html_e( 'Total Orders', 'slidefirePro-widgets' ); ?></div>
							</div>
							<div class="stat-card p-4 bg-muted border border-border rounded-lg text-center">
								<div class="text-2xl font-bold text-primary"><?php echo wc_price( $total_spent ); ?></div>
								<div class="text-sm text-muted-foreground"><?php esc_html_e( 'Total Spent', 'slidefirePro-widgets' ); ?></div>
							</div>
							<div class="stat-card p-4 bg-muted border border-border rounded-lg text-center">
								<div class="text-2xl font-bold text-primary">3</div>
								<div class="text-sm text-muted-foreground"><?php esc_html_e( 'Custom Designs', 'slidefirePro-widgets' ); ?></div>
							</div>
							<div class="stat-card p-4 bg-muted border border-border rounded-lg text-center">
								<div class="text-2xl font-bold text-primary"><?php echo esc_html( date( 'Y', strtotime( $current_user->user_registered ) ) ); ?></div>
								<div class="text-sm text-muted-foreground"><?php esc_html_e( 'Member Since', 'slidefirePro-widgets' ); ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Orders Tab
	 */
    private function render_orders_tab(): void {
        ?>
        <div class="orders-header flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold"><?php esc_html_e( 'Order History', 'slidefirePro-widgets' ); ?></h2>
            <div class="flex space-x-2">
				<button class="filter-btn inline-flex items-center gap-2 px-4 py-2 text-sm border border-border rounded-md hover:bg-muted transition-colors">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
					</svg>
					<?php esc_html_e( 'Filter by Date', 'slidefirePro-widgets' ); ?>
				</button>
				<button class="filter-btn inline-flex items-center gap-2 px-4 py-2 text-sm border border-border rounded-md hover:bg-muted transition-colors">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
					</svg>
					<?php esc_html_e( 'Filter by Status', 'slidefirePro-widgets' ); ?>
				</button>
			</div>
        </div>

        <div class="orders-list space-y-4">
            <?php
            // If viewing a specific order, render that endpoint content
            if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'view-order' ) ) {
                $order_id = absint( get_query_var( 'view-order' ) );
                do_action( 'woocommerce_account_view-order_endpoint', $order_id );
            } else {
                wc_get_template( 'myaccount/orders.php' );
            }
            ?>
        </div>
        <?php
    }

	/**
	 * Render Addresses Tab
	 */
    private function render_addresses_tab(): void {
        ?>
        <div class="addresses-header flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold"><?php esc_html_e( 'Saved Addresses', 'slidefirePro-widgets' ); ?></h2>
            <button class="add-address-btn inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
				</svg>
				<?php esc_html_e( 'Add New Address', 'slidefirePro-widgets' ); ?>
			</button>
        </div>

        <div class="addresses-grid grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            // If editing a specific address (billing/shipping), render the edit form endpoint
            if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'edit-address' ) && get_query_var( 'edit-address' ) ) {
                $address_type = sanitize_text_field( get_query_var( 'edit-address' ) );
                do_action( 'woocommerce_account_edit-address_endpoint', $address_type );
            } else {
                wc_get_template( 'myaccount/my-address.php' );
            }
            ?>
        </div>
        <?php
    }

	/**
	 * Render Payment Methods Tab
	 */
    private function render_payments_tab(): void {
        ?>
        <div class="payments-header flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold"><?php esc_html_e( 'Payment Methods', 'slidefirePro-widgets' ); ?></h2>
            <button class="add-payment-btn inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
				<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
				</svg>
				<?php esc_html_e( 'Add Payment Method', 'slidefirePro-widgets' ); ?>
			</button>
        </div>

        <div class="payments-grid grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            // If adding a payment method, render the endpoint content
            if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'add-payment-method' ) ) {
                do_action( 'woocommerce_account_add-payment-method_endpoint' );
            } else {
                wc_get_template( 'myaccount/payment-methods.php' );
            }
            ?>
        </div>
        <?php
    }

	/**
	 * Render Notifications Tab
	 */
	private function render_notifications_tab(): void {
		?>
		<h2 class="text-2xl font-bold mb-6"><?php esc_html_e( 'Notification Preferences', 'slidefirePro-widgets' ); ?></h2>
		
		<div class="my-account-card p-6 bg-card border border-border rounded-lg">
			<h3 class="font-semibold mb-4"><?php esc_html_e( 'Email Notifications', 'slidefirePro-widgets' ); ?></h3>
			<div class="space-y-4">
				<div class="notification-item flex items-center justify-between">
					<div>
						<div class="font-medium"><?php esc_html_e( 'Order Updates', 'slidefirePro-widgets' ); ?></div>
						<div class="text-sm text-muted-foreground">
							<?php esc_html_e( 'Get notified about order status changes', 'slidefirePro-widgets' ); ?>
						</div>
					</div>
					<span class="inline-flex items-center px-3 py-1 text-sm bg-green-500 text-white rounded-full">
						<?php esc_html_e( 'Enabled', 'slidefirePro-widgets' ); ?>
					</span>
				</div>
				<div class="notification-item flex items-center justify-between">
					<div>
						<div class="font-medium"><?php esc_html_e( 'New Products', 'slidefirePro-widgets' ); ?></div>
						<div class="text-sm text-muted-foreground">
							<?php esc_html_e( 'Be the first to know about new releases', 'slidefirePro-widgets' ); ?>
						</div>
					</div>
					<span class="inline-flex items-center px-3 py-1 text-sm bg-green-500 text-white rounded-full">
						<?php esc_html_e( 'Enabled', 'slidefirePro-widgets' ); ?>
					</span>
				</div>
				<div class="notification-item flex items-center justify-between">
					<div>
						<div class="font-medium"><?php esc_html_e( 'Promotions & Sales', 'slidefirePro-widgets' ); ?></div>
						<div class="text-sm text-muted-foreground">
							<?php esc_html_e( 'Special offers and discount codes', 'slidefirePro-widgets' ); ?>
						</div>
					</div>
					<span class="inline-flex items-center px-3 py-1 text-sm bg-secondary text-secondary-foreground rounded-full">
						<?php esc_html_e( 'Disabled', 'slidefirePro-widgets' ); ?>
					</span>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Security Tab
	 */
	private function render_security_tab(): void {
		?>
		<h2 class="text-2xl font-bold mb-6"><?php esc_html_e( 'Security Settings', 'slidefirePro-widgets' ); ?></h2>
		
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<div class="my-account-card p-6 bg-card border border-border rounded-lg">
				<div class="flex items-center space-x-3 mb-4">
					<svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
					</svg>
					<h3 class="font-semibold"><?php esc_html_e( 'Password', 'slidefirePro-widgets' ); ?></h3>
				</div>
				<p class="text-sm text-muted-foreground mb-4">
					<?php esc_html_e( 'Last changed 3 months ago', 'slidefirePro-widgets' ); ?>
				</p>
				<button class="inline-flex items-center px-4 py-2 border border-primary text-primary rounded-md hover:bg-primary/10 transition-colors">
					<?php esc_html_e( 'Change Password', 'slidefirePro-widgets' ); ?>
				</button>
			</div>

			<div class="my-account-card p-6 bg-card border border-border rounded-lg">
				<div class="flex items-center space-x-3 mb-4">
					<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
					<h3 class="font-semibold"><?php esc_html_e( 'Two-Factor Authentication', 'slidefirePro-widgets' ); ?></h3>
				</div>
				<p class="text-sm text-muted-foreground mb-4">
					<?php esc_html_e( 'Add an extra layer of security to your account', 'slidefirePro-widgets' ); ?>
				</p>
				<button class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors">
					<?php esc_html_e( 'Enable 2FA', 'slidefirePro-widgets' ); ?>
				</button>
			</div>
		</div>
		<?php
	}
}
