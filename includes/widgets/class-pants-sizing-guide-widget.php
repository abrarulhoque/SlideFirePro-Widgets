<?php
namespace SlideFirePro_Widgets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

if (! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Pants_Sizing_Guide_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-pants-sizing-guide';
	}

	public function get_title(): string {
		return esc_html__( 'Pants Sizing Guide', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-table';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'sizing', 'guide', 'table', 'pants', 'measurements', 'chart', 'slidefire', 'waist', 'length' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-pants-sizing-guide' ];
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
			'title',
			[
				'label' => esc_html__( 'Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Pants Sizing Guide', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'All measurements are in inches. For the best fit, measure yourself and compare to the chart below.', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'measurement_title',
			[
				'label' => esc_html__( 'Measurement Section Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Measurement Points', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'size_chart_title',
			[
				'label' => esc_html__( 'Size Chart Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Size Chart (Inches)', 'slidefirePro-widgets' ),
			]
		);

		$this->end_controls_section();

		// Sizing Data Section
		$this->start_controls_section(
			'sizing_data_section',
			[
				'label' => esc_html__( 'Sizing Data', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'M', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'waist',
			[
				'label' => esc_html__( 'Waist', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '32', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'length',
			[
				'label' => esc_html__( 'Length', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '41', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'sizing_data',
			[
				'label' => esc_html__( 'Sizing Data', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'size' => 'S',
						'waist' => '30',
						'length' => '40'
					],
					[
						'size' => 'M',
						'waist' => '32',
						'length' => '41'
					],
					[
						'size' => 'L',
						'waist' => '34',
						'length' => '42'
					],
					[
						'size' => 'XL',
						'waist' => '36',
						'length' => '43'
					],
					[
						'size' => '2XL',
						'waist' => '38',
						'length' => '44'
					],
					[
						'size' => '3XL',
						'waist' => '40',
						'length' => '45'
					]
				],
				'title_field' => '{{{ size }}}',
			]
		);

		$this->end_controls_section();

		// Fitting Tips Section
		$this->start_controls_section(
			'fitting_tips_section',
			[
				'label' => esc_html__( 'Fitting Tips', 'slidefirePro-widgets' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tips_title',
			[
				'label' => esc_html__( 'Tips Title', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Fitting Tips', 'slidefirePro-widgets' ),
			]
		);

		$tips_repeater = new Repeater();

		$tips_repeater->add_control(
			'tip_text',
			[
				'label' => esc_html__( 'Tip Text', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'For a comfortable fit, add 1-2 inches to your actual waist measurement', 'slidefirePro-widgets' ),
			]
		);

		$this->add_control(
			'fitting_tips',
			[
				'label' => esc_html__( 'Fitting Tips', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $tips_repeater->get_controls(),
				'default' => [
					[
						'tip_text' => 'For a comfortable fit, add 1-2 inches to your actual waist measurement'
					],
					[
						'tip_text' => 'Tactical cut designed for mobility and performance'
					],
					[
						'tip_text' => 'Length can be hemmed to your preferred inseam'
					],
					[
						'tip_text' => 'Contact us if you need help choosing the right size'
					]
				],
				'title_field' => '{{{ tip_text }}}',
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
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .pants-sizing-guide-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pants-sizing-guide-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__( 'Description Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .pants-sizing-guide-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pants-sizing-guide-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['title'] ) && empty( $settings['sizing_data'] ) ) {
			return;
		}

		$title = esc_html( $settings['title'] );
		$description = wp_kses_post( $settings['description'] );
		$measurement_title = esc_html( $settings['measurement_title'] );
		$size_chart_title = esc_html( $settings['size_chart_title'] );
		$tips_title = esc_html( $settings['tips_title'] );
		?>

		<div class="slidefire-pants-sizing-guide-wrapper">
			<div class="pants-sizing-guide-card">
				<div class="pants-sizing-guide-header">
					<div class="pants-sizing-guide-title-wrapper">
						<svg class="pants-sizing-guide-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21 6H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 14H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 2L20 3L21 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 2L4 3L3 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 10L20 11L21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 10L4 11L3 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<h3 class="pants-sizing-guide-title"><?php echo $title; ?></h3>
					</div>
					<p class="pants-sizing-guide-description"><?php echo $description; ?></p>
				</div>

				<div class="pants-sizing-guide-content">
					<!-- Measurement Diagram -->
					<div class="pants-measurement-section">
						<div class="pants-measurement-diagram">
							<div class="pants-diagram-header">
								<div class="pants-measurement-badge"><?php echo $measurement_title; ?></div>
							</div>
							
							<!-- Pants Diagram with SVG -->
							<div class="pants-diagram">
								<svg viewBox="0 0 200 300" class="pants-svg" xmlns="http://www.w3.org/2000/svg">
									<!-- Pants Outline -->
									<path
										d="M70 40 L130 40 L135 70 L140 100 L145 130 L150 160 L155 190 L160 220 L165 250 L170 280 L165 285 L155 285 L150 280 L145 275 L140 270 L135 265 L130 260 L125 255 L120 250 L115 245 L110 240 L105 235 L100 230 L100 200 L95 170 L90 140 L85 110 L80 80 L75 50 L70 40 Z"
										fill="white"
										stroke="#333"
										stroke-width="2"
									/>
									
									<!-- Left Leg -->
									<path
										d="M100 200 L95 230 L90 260 L85 285 L80 290 L70 290 L65 285 L70 280 L75 275 L80 270 L85 265 L90 260 L95 255 L100 250 L100 200"
										fill="white"
										stroke="#333"
										stroke-width="2"
									/>

									<!-- Waistband -->
									<rect x="70" y="35" width="60" height="10" fill="white" stroke="#333" stroke-width="2" />
									
									<!-- Belt loops -->
									<rect x="75" y="32" width="2" height="8" fill="#333" />
									<rect x="85" y="32" width="2" height="8" fill="#333" />
									<rect x="98" y="32" width="2" height="8" fill="#333" />
									<rect x="111" y="32" width="2" height="8" fill="#333" />
									<rect x="123" y="32" width="2" height="8" fill="#333" />

									<!-- Pockets -->
									<path d="M75 60 L85 60 L85 80 L75 80 Z" fill="none" stroke="#333" stroke-width="1" />
									<path d="M115 60 L125 60 L125 80 L115 80 Z" fill="none" stroke="#333" stroke-width="1" />
									
									<!-- Measurement Lines and Labels -->
									
									<!-- Waist Measurement -->
									<line x1="50" y1="40" x2="150" y2="40" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="100" y="30" text-anchor="middle" class="pants-measurement-label">WAIST</text>
									
									<!-- Length Measurement -->
									<line x1="25" y1="40" x2="25" y2="285" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="15" y="160" text-anchor="middle" class="pants-measurement-label" transform="rotate(-90 15 160)">LENGTH</text>
									
									<!-- Arrow markers -->
									<defs>
										<marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
											<polygon points="0 0, 10 3.5, 0 7" fill="var(--slidefire-primary)" />
										</marker>
									</defs>
								</svg>
							</div>

							<div class="pants-measurement-notes">
								<div class="pants-measurement-note">
									<svg class="pants-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Measurements taken with garment laying flat</span>
								</div>
								<div class="pants-measurement-note">
									<svg class="pants-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Waist measurement is around the waistband</span>
								</div>
								<div class="pants-measurement-note">
									<svg class="pants-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Length is measured from waistband to hem</span>
								</div>
							</div>
						</div>
					</div>

					<!-- Sizing Table -->
					<div class="pants-sizing-table-section">
						<div class="pants-sizing-table-wrapper">
							<div class="pants-sizing-table-card">
								<div class="pants-sizing-table-header">
									<h4 class="pants-sizing-table-title"><?php echo $size_chart_title; ?></h4>
								</div>
								
								<div class="pants-sizing-table-container">
									<table class="pants-sizing-table">
										<thead>
											<tr>
												<th>Size</th>
												<th>Waist</th>
												<th>Length</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if ( ! empty( $settings['sizing_data'] ) ) {
												$index = 0;
												foreach ( $settings['sizing_data'] as $size_data ) {
													$row_class = $index % 2 === 0 ? 'pants-even-row' : 'pants-odd-row';
													?>
													<tr class="<?php echo $row_class; ?>">
														<td>
															<div class="pants-size-badge"><?php echo esc_html( $size_data['size'] ); ?></div>
														</td>
														<td class="pants-measurement-value"><?php echo esc_html( $size_data['waist'] ); ?>"</td>
														<td class="pants-measurement-value"><?php echo esc_html( $size_data['length'] ); ?>"</td>
													</tr>
													<?php
													$index++;
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- Fitting Tips -->
						<?php if ( ! empty( $settings['fitting_tips'] ) ) : ?>
						<div class="pants-fitting-tips-card">
							<h5 class="pants-fitting-tips-title"><?php echo $tips_title; ?></h5>
							<ul class="pants-fitting-tips-list">
								<?php foreach ( $settings['fitting_tips'] as $tip ) : ?>
								<li class="pants-fitting-tip">
									<div class="pants-tip-bullet"></div>
									<span><?php echo esc_html( $tip['tip_text'] ); ?></span>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	protected function content_template(): void {
		?>
		<div class="slidefire-pants-sizing-guide-wrapper">
			<div class="pants-sizing-guide-card">
				<div class="pants-sizing-guide-header">
					<div class="pants-sizing-guide-title-wrapper">
						<svg class="pants-sizing-guide-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21 6H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 14H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 2L20 3L21 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 2L4 3L3 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 10L20 11L21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 10L4 11L3 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<h3 class="pants-sizing-guide-title">{{{ settings.title }}}</h3>
					</div>
					<p class="pants-sizing-guide-description">{{{ settings.description }}}</p>
				</div>

				<div class="pants-sizing-guide-content">
					<!-- Measurement Diagram -->
					<div class="pants-measurement-section">
						<div class="pants-measurement-diagram">
							<div class="pants-diagram-header">
								<div class="pants-measurement-badge">{{{ settings.measurement_title }}}</div>
							</div>
							
							<!-- Pants Diagram with SVG -->
							<div class="pants-diagram">
								<svg viewBox="0 0 200 300" class="pants-svg" xmlns="http://www.w3.org/2000/svg">
									<!-- Pants Outline -->
									<path
										d="M70 40 L130 40 L135 70 L140 100 L145 130 L150 160 L155 190 L160 220 L165 250 L170 280 L165 285 L155 285 L150 280 L145 275 L140 270 L135 265 L130 260 L125 255 L120 250 L115 245 L110 240 L105 235 L100 230 L100 200 L95 170 L90 140 L85 110 L80 80 L75 50 L70 40 Z"
										fill="white"
										stroke="#333"
										stroke-width="2"
									/>
									
									<!-- Left Leg -->
									<path
										d="M100 200 L95 230 L90 260 L85 285 L80 290 L70 290 L65 285 L70 280 L75 275 L80 270 L85 265 L90 260 L95 255 L100 250 L100 200"
										fill="white"
										stroke="#333"
										stroke-width="2"
									/>

									<!-- Waistband -->
									<rect x="70" y="35" width="60" height="10" fill="white" stroke="#333" stroke-width="2" />
									
									<!-- Belt loops -->
									<rect x="75" y="32" width="2" height="8" fill="#333" />
									<rect x="85" y="32" width="2" height="8" fill="#333" />
									<rect x="98" y="32" width="2" height="8" fill="#333" />
									<rect x="111" y="32" width="2" height="8" fill="#333" />
									<rect x="123" y="32" width="2" height="8" fill="#333" />

									<!-- Pockets -->
									<path d="M75 60 L85 60 L85 80 L75 80 Z" fill="none" stroke="#333" stroke-width="1" />
									<path d="M115 60 L125 60 L125 80 L115 80 Z" fill="none" stroke="#333" stroke-width="1" />
									
									<!-- Measurement Lines and Labels -->
									
									<!-- Waist Measurement -->
									<line x1="50" y1="40" x2="150" y2="40" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="100" y="30" text-anchor="middle" class="pants-measurement-label">WAIST</text>
									
									<!-- Length Measurement -->
									<line x1="25" y1="40" x2="25" y2="285" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="15" y="160" text-anchor="middle" class="pants-measurement-label" transform="rotate(-90 15 160)">LENGTH</text>
									
									<!-- Arrow markers -->
									<defs>
										<marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
											<polygon points="0 0, 10 3.5, 0 7" fill="var(--slidefire-primary)" />
										</marker>
									</defs>
								</svg>
							</div>

							<div class="pants-measurement-notes">
								<div class="pants-measurement-note">
									<svg class="pants-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Measurements taken with garment laying flat</span>
								</div>
								<div class="pants-measurement-note">
									<svg class="pants-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Waist measurement is around the waistband</span>
								</div>
								<div class="pants-measurement-note">
									<svg class="pants-info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Length is measured from waistband to hem</span>
								</div>
							</div>
						</div>
					</div>

					<!-- Sizing Table -->
					<div class="pants-sizing-table-section">
						<div class="pants-sizing-table-wrapper">
							<div class="pants-sizing-table-card">
								<div class="pants-sizing-table-header">
									<h4 class="pants-sizing-table-title">{{{ settings.size_chart_title }}}</h4>
								</div>
								
								<div class="pants-sizing-table-container">
									<table class="pants-sizing-table">
										<thead>
											<tr>
												<th>Size</th>
												<th>Waist</th>
												<th>Length</th>
											</tr>
										</thead>
										<tbody>
											<# if ( settings.sizing_data ) { #>
												<# _.each( settings.sizing_data, function( item, index ) { 
													var rowClass = index % 2 === 0 ? 'pants-even-row' : 'pants-odd-row';
												#>
													<tr class="{{ rowClass }}">
														<td>
															<div class="pants-size-badge">{{{ item.size }}}</div>
														</td>
														<td class="pants-measurement-value">{{{ item.waist }}}"</td>
														<td class="pants-measurement-value">{{{ item.length }}}"</td>
													</tr>
												<# }); #>
											<# } #>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- Fitting Tips -->
						<# if ( settings.fitting_tips ) { #>
						<div class="pants-fitting-tips-card">
							<h5 class="pants-fitting-tips-title">{{{ settings.tips_title }}}</h5>
							<ul class="pants-fitting-tips-list">
								<# _.each( settings.fitting_tips, function( tip ) { #>
								<li class="pants-fitting-tip">
									<div class="pants-tip-bullet"></div>
									<span>{{{ tip.tip_text }}}</span>
								</li>
								<# }); #>
							</ul>
						</div>
						<# } #>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}