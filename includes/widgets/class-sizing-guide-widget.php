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

class Sizing_Guide_Widget extends Widget_Base {

	public function get_name(): string {
		return 'slidefirePro-sizing-guide';
	}

	public function get_title(): string {
		return esc_html__( 'Jersey Sizing Guide', 'slidefirePro-widgets' );
	}

	public function get_icon(): string {
		return 'eicon-table';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'sizing', 'guide', 'table', 'jersey', 'measurements', 'chart', 'slidefire' ];
	}

	public function get_style_depends(): array {
		return [ 'slidefirePro-sizing-guide' ];
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
				'default' => esc_html__( 'Jersey Sizing Guide', 'slidefirePro-widgets' ),
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
			'chest',
			[
				'label' => esc_html__( 'Chest', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '22', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'length',
			[
				'label' => esc_html__( 'Length', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '31', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'sleeve',
			[
				'label' => esc_html__( 'Sleeve', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '22.75', 'slidefirePro-widgets' ),
			]
		);

		$repeater->add_control(
			'across_shoulder',
			[
				'label' => esc_html__( 'Across Shoulder', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '18.5', 'slidefirePro-widgets' ),
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
						'size' => 'XS',
						'chest' => '20',
						'length' => '29',
						'sleeve' => '21.75',
						'across_shoulder' => '16.5'
					],
					[
						'size' => 'S',
						'chest' => '21',
						'length' => '30',
						'sleeve' => '22.25',
						'across_shoulder' => '17.5'
					],
					[
						'size' => 'M',
						'chest' => '22',
						'length' => '31',
						'sleeve' => '22.75',
						'across_shoulder' => '18.5'
					],
					[
						'size' => 'L',
						'chest' => '23',
						'length' => '32',
						'sleeve' => '23.25',
						'across_shoulder' => '19.5'
					],
					[
						'size' => 'XL',
						'chest' => '24',
						'length' => '33',
						'sleeve' => '23.75',
						'across_shoulder' => '20.5'
					],
					[
						'size' => '2XL',
						'chest' => '25',
						'length' => '34',
						'sleeve' => '24.25',
						'across_shoulder' => '21.5'
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
				'default' => esc_html__( 'For a relaxed fit, choose one size up from your measured size', 'slidefirePro-widgets' ),
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
						'tip_text' => 'For a relaxed fit, choose one size up from your measured size'
					],
					[
						'tip_text' => 'Athletic cut designed for active movement and performance'
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
				'selector' => '{{WRAPPER}} .sizing-guide-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sizing-guide-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__( 'Description Typography', 'slidefirePro-widgets' ),
				'selector' => '{{WRAPPER}} .sizing-guide-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'slidefirePro-widgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sizing-guide-description' => 'color: {{VALUE}};',
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

		<div class="slidefire-sizing-guide-wrapper">
			<div class="sizing-guide-card">
				<div class="sizing-guide-header">
					<div class="sizing-guide-title-wrapper">
						<svg class="sizing-guide-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21 6H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 14H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 2L20 3L21 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 2L4 3L3 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 10L20 11L21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 10L4 11L3 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<h3 class="sizing-guide-title"><?php echo $title; ?></h3>
					</div>
					<p class="sizing-guide-description"><?php echo $description; ?></p>
				</div>

				<div class="sizing-guide-content">
					<!-- Measurement Diagram -->
					<div class="measurement-section">
						<div class="measurement-diagram">
							<div class="diagram-header">
								<div class="measurement-badge"><?php echo $measurement_title; ?></div>
							</div>
							
							<!-- Jersey Diagram with SVG -->
							<div class="jersey-diagram">
								<svg viewBox="0 0 200 240" class="jersey-svg" xmlns="http://www.w3.org/2000/svg">
									<!-- Jersey Outline -->
									<path
										d="M50 60 L50 40 C50 35 55 30 60 30 L140 30 C145 30 150 35 150 40 L150 60 L180 70 L180 110 L160 115 L160 210 C160 215 155 220 150 220 L50 220 C45 220 40 215 40 210 L40 115 L20 110 L20 70 L50 60 Z"
										fill="white"
										stroke="#333"
										stroke-width="2"
									/>
									
									<!-- Collar -->
									<ellipse cx="100" cy="35" rx="15" ry="8" fill="white" stroke="#333" stroke-width="2" />
									
									<!-- Measurement Lines and Labels -->
									<line x1="25" y1="80" x2="175" y2="80" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="100" y="75" text-anchor="middle" class="measurement-label">CHEST</text>
									
									<line x1="15" y1="35" x2="15" y2="215" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="5" y="125" text-anchor="middle" class="measurement-label" transform="rotate(-90 5 125)">LENGTH</text>
									
									<line x1="150" y1="60" x2="180" y2="110" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="175" y="90" text-anchor="middle" class="measurement-label-small" transform="rotate(45 175 90)">SLEEVE</text>
									
									<line x1="50" y1="25" x2="150" y2="25" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="100" y="20" text-anchor="middle" class="measurement-label">ACROSS SHOULDER</text>
									
									<!-- Arrow markers -->
									<defs>
										<marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
											<polygon points="0 0, 10 3.5, 0 7" fill="var(--slidefire-primary)" />
										</marker>
									</defs>
								</svg>
							</div>

							<div class="measurement-notes">
								<div class="measurement-note">
									<svg class="info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Measurements taken with garment laying flat</span>
								</div>
								<div class="measurement-note">
									<svg class="info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Allow 1-2 inches for comfortable fit</span>
								</div>
							</div>
						</div>
					</div>

					<!-- Sizing Table -->
					<div class="sizing-table-section">
						<div class="sizing-table-wrapper">
							<div class="sizing-table-card">
								<div class="sizing-table-header">
									<h4 class="sizing-table-title"><?php echo $size_chart_title; ?></h4>
								</div>
								
								<div class="sizing-table-container">
									<table class="sizing-table">
										<thead>
											<tr>
												<th>Size</th>
												<th>Chest</th>
												<th>Length</th>
												<th>Sleeve</th>
												<th>Across Shoulder</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if ( ! empty( $settings['sizing_data'] ) ) {
												$index = 0;
												foreach ( $settings['sizing_data'] as $size_data ) {
													$row_class = $index % 2 === 0 ? 'even-row' : 'odd-row';
													?>
													<tr class="<?php echo $row_class; ?>">
														<td>
															<div class="size-badge"><?php echo esc_html( $size_data['size'] ); ?></div>
														</td>
														<td class="measurement-value"><?php echo esc_html( $size_data['chest'] ); ?>"</td>
														<td class="measurement-value"><?php echo esc_html( $size_data['length'] ); ?>"</td>
														<td class="measurement-value"><?php echo esc_html( $size_data['sleeve'] ); ?>"</td>
														<td class="measurement-value"><?php echo esc_html( $size_data['across_shoulder'] ); ?>"</td>
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
						<div class="fitting-tips-card">
							<h5 class="fitting-tips-title"><?php echo $tips_title; ?></h5>
							<ul class="fitting-tips-list">
								<?php foreach ( $settings['fitting_tips'] as $tip ) : ?>
								<li class="fitting-tip">
									<div class="tip-bullet"></div>
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
		<div class="slidefire-sizing-guide-wrapper">
			<div class="sizing-guide-card">
				<div class="sizing-guide-header">
					<div class="sizing-guide-title-wrapper">
						<svg class="sizing-guide-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21 6H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 14H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 2L20 3L21 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 2L4 3L3 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M21 10L20 11L21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M3 10L4 11L3 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<h3 class="sizing-guide-title">{{{ settings.title }}}</h3>
					</div>
					<p class="sizing-guide-description">{{{ settings.description }}}</p>
				</div>

				<div class="sizing-guide-content">
					<!-- Measurement Diagram -->
					<div class="measurement-section">
						<div class="measurement-diagram">
							<div class="diagram-header">
								<div class="measurement-badge">{{{ settings.measurement_title }}}</div>
							</div>
							
							<!-- Jersey Diagram with SVG -->
							<div class="jersey-diagram">
								<svg viewBox="0 0 200 240" class="jersey-svg" xmlns="http://www.w3.org/2000/svg">
									<!-- Jersey Outline -->
									<path
										d="M50 60 L50 40 C50 35 55 30 60 30 L140 30 C145 30 150 35 150 40 L150 60 L180 70 L180 110 L160 115 L160 210 C160 215 155 220 150 220 L50 220 C45 220 40 215 40 210 L40 115 L20 110 L20 70 L50 60 Z"
										fill="white"
										stroke="#333"
										stroke-width="2"
									/>
									
									<!-- Collar -->
									<ellipse cx="100" cy="35" rx="15" ry="8" fill="white" stroke="#333" stroke-width="2" />
									
									<!-- Measurement Lines and Labels -->
									<line x1="25" y1="80" x2="175" y2="80" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="100" y="75" text-anchor="middle" class="measurement-label">CHEST</text>
									
									<line x1="15" y1="35" x2="15" y2="215" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="5" y="125" text-anchor="middle" class="measurement-label" transform="rotate(-90 5 125)">LENGTH</text>
									
									<line x1="150" y1="60" x2="180" y2="110" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="175" y="90" text-anchor="middle" class="measurement-label-small" transform="rotate(45 175 90)">SLEEVE</text>
									
									<line x1="50" y1="25" x2="150" y2="25" stroke="var(--slidefire-primary)" stroke-width="2" marker-end="url(#arrowhead)" marker-start="url(#arrowhead)" />
									<text x="100" y="20" text-anchor="middle" class="measurement-label">ACROSS SHOULDER</text>
									
									<!-- Arrow markers -->
									<defs>
										<marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
											<polygon points="0 0, 10 3.5, 0 7" fill="var(--slidefire-primary)" />
										</marker>
									</defs>
								</svg>
							</div>

							<div class="measurement-notes">
								<div class="measurement-note">
									<svg class="info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Measurements taken with garment laying flat</span>
								</div>
								<div class="measurement-note">
									<svg class="info-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
										<path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
										<path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
									</svg>
									<span>Allow 1-2 inches for comfortable fit</span>
								</div>
							</div>
						</div>
					</div>

					<!-- Sizing Table -->
					<div class="sizing-table-section">
						<div class="sizing-table-wrapper">
							<div class="sizing-table-card">
								<div class="sizing-table-header">
									<h4 class="sizing-table-title">{{{ settings.size_chart_title }}}</h4>
								</div>
								
								<div class="sizing-table-container">
									<table class="sizing-table">
										<thead>
											<tr>
												<th>Size</th>
												<th>Chest</th>
												<th>Length</th>
												<th>Sleeve</th>
												<th>Across Shoulder</th>
											</tr>
										</thead>
										<tbody>
											<# if ( settings.sizing_data ) { #>
												<# _.each( settings.sizing_data, function( item, index ) { 
													var rowClass = index % 2 === 0 ? 'even-row' : 'odd-row';
												#>
													<tr class="{{ rowClass }}">
														<td>
															<div class="size-badge">{{{ item.size }}}</div>
														</td>
														<td class="measurement-value">{{{ item.chest }}}"</td>
														<td class="measurement-value">{{{ item.length }}}"</td>
														<td class="measurement-value">{{{ item.sleeve }}}"</td>
														<td class="measurement-value">{{{ item.across_shoulder }}}"</td>
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
						<div class="fitting-tips-card">
							<h5 class="fitting-tips-title">{{{ settings.tips_title }}}</h5>
							<ul class="fitting-tips-list">
								<# _.each( settings.fitting_tips, function( tip ) { #>
								<li class="fitting-tip">
									<div class="tip-bullet"></div>
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