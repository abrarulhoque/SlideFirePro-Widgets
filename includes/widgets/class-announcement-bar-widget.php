<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Announcement_Bar_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-announcement-bar';
	}

	public function get_title(): string {
		return esc_html__( 'Announcement Bar', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-info-box';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'announcement', 'bar', 'banner', 'notification', 'promo', 'alert' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-announcement-bar' ];
	}

	protected function register_controls(): void {

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'announcement_text',
			[
				'label' => esc_html__( 'Announcement Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( '🎉 FREE Design for new teams in 2025 - Start your custom apparel journey today!', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Enter your announcement text...', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'show_emoji',
			[
				'label' => esc_html__( 'Show Emoji', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'highlight_text',
			[
				'label' => esc_html__( 'Highlighted Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'FREE Design for new teams in 2025', 'slidefirePro-widgets' ),
				'placeholder' => esc_html__( 'Text to highlight...', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'show_sparkles',
			[
				'label' => esc_html__( 'Show Sparkle Effects', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'Hide', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'slidefirePro-widgets' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slidefire-announcement-bar',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .slidefire-announcement-bar .announcement-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'highlight_color',
			[
				'label' => esc_html__( 'Highlight Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'selectors' => [
					'{{WRAPPER}} .slidefire-announcement-bar .highlight-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => esc_html__( 'Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .slidefire-announcement-bar .announcement-content',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 8,
					'right' => 16,
					'bottom' => 8,
					'left' => 16,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .slidefire-announcement-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(35, 178, 238, 0.2)',
				'selectors' => [
					'{{WRAPPER}} .slidefire-announcement-bar' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Animation Section
		$this->start_controls_section(
			'animation_section',
			[
				'label' => esc_html__( 'Animation', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'enable_pulse_bg',
			[
				'label' => esc_html__( 'Enable Background Pulse', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'slidefirePro-widgets' ),
				'label_off' => esc_html__( 'No', 'slidefirePro-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'sparkle_color',
			[
				'label' => esc_html__( 'Sparkle Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#23B2EE',
				'condition' => [
					'show_sparkles' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .slidefire-announcement-bar .sparkle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$announcement_text = $settings['announcement_text'];
		$highlight_text = $settings['highlight_text'];

		// Replace highlight text with span wrapper
		if ( ! empty( $highlight_text ) && strpos( $announcement_text, $highlight_text ) !== false ) {
			$announcement_text = str_replace( 
				$highlight_text, 
				'<span class="highlight-text font-bold">' . esc_html( $highlight_text ) . '</span>', 
				$announcement_text 
			);
		}

		$pulse_class = ( 'yes' === $settings['enable_pulse_bg'] ) ? ' has-pulse-bg' : '';
		?>

		<div class="slidefire-announcement-bar<?php echo esc_attr( $pulse_class ); ?>">
			<!-- Animated background -->
			<?php if ( 'yes' === $settings['enable_pulse_bg'] ) : ?>
				<div class="animated-bg"></div>
			<?php endif; ?>
			
			<!-- Content -->
			<div class="announcement-content-wrapper">
				<p class="announcement-content">
					<?php echo wp_kses_post( $announcement_text ); ?>
				</p>
			</div>
			
			<!-- Sparkle effects -->
			<?php if ( 'yes' === $settings['show_sparkles'] ) : ?>
				<div class="sparkle sparkle-1 sparkle-ping"></div>
				<div class="sparkle sparkle-2 sparkle-pulse"></div>
				<div class="sparkle sparkle-3 sparkle-bounce"></div>
				<div class="sparkle sparkle-4 sparkle-ping"></div>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function content_template(): void {
		?>
		<#
		var announcementText = settings.announcement_text;
		var highlightText = settings.highlight_text;

		// Replace highlight text with span wrapper
		if ( highlightText && announcementText.indexOf( highlightText ) !== -1 ) {
			announcementText = announcementText.replace( 
				highlightText, 
				'<span class="highlight-text font-bold">' + highlightText + '</span>' 
			);
		}

		var pulseClass = ( 'yes' === settings.enable_pulse_bg ) ? ' has-pulse-bg' : '';
		#>

		<div class="slidefire-announcement-bar{{ pulseClass }}">
			<!-- Animated background -->
			<# if ( 'yes' === settings.enable_pulse_bg ) { #>
				<div class="animated-bg"></div>
			<# } #>
			
			<!-- Content -->
			<div class="announcement-content-wrapper">
				<p class="announcement-content">
					{{{ announcementText }}}
				</p>
			</div>
			
			<!-- Sparkle effects -->
			<# if ( 'yes' === settings.show_sparkles ) { #>
				<div class="sparkle sparkle-1 sparkle-ping"></div>
				<div class="sparkle sparkle-2 sparkle-pulse"></div>
				<div class="sparkle sparkle-3 sparkle-bounce"></div>
				<div class="sparkle sparkle-4 sparkle-ping"></div>
			<# } #>
		</div>
		<?php
	}
}