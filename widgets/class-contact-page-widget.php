<?php
/**
 * Contact Page Widget Class
 * 
 * @since 1.27.0
 */

class SlideFirePro_Contact_Page_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     */
    public function get_name() {
        return 'slidefire_contact_page';
    }

    /**
     * Get widget title.
     */
    public function get_title() {
        return esc_html__( 'Contact Page', 'slidefire-pro' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-mail';
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
        return [ 'contact', 'form', 'mail', 'message', 'inquiry', 'support' ];
    }

    /**
     * Get style dependencies.
     */
    public function get_style_depends() {
        return [ 'slidefire-contact-page-widget' ];
    }

    /**
     * Get script dependencies.
     */
    public function get_script_depends() {
        return [ 'slidefire-contact-page-widget' ];
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
            'main_title',
            [
                'label' => esc_html__( 'Main Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Contact', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'title_highlight',
            [
                'label' => esc_html__( 'Title Highlight Word', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Us', 'slidefire-pro' ),
                'description' => esc_html__( 'This word will have gradient styling', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Ready to gear up with premium SpeedSoft and tactical apparel? We\'re here to help you create the perfect custom designs for your team or answer any questions you might have.', 'slidefire-pro' ),
                'rows' => 4,
            ]
        );

        $this->end_controls_section();

        // Form Section
        $this->start_controls_section(
            'form_section',
            [
                'label' => esc_html__( 'Contact Form', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label' => esc_html__( 'Form Title', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Get In Touch', 'slidefire-pro' ),
            ]
        );

        $this->add_control(
            'form_description',
            [
                'label' => esc_html__( 'Form Description', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Whether you need custom designs, have questions about our products, or want to discuss a team order, we\'re here to help make your vision a reality.', 'slidefire-pro' ),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'enable_file_upload',
            [
                'label' => esc_html__( 'Enable File Upload', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'slidefire-pro' ),
                'label_off' => esc_html__( 'No', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'recipient_email',
            [
                'label' => esc_html__( 'Recipient Email', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => get_option( 'admin_email' ),
                'description' => esc_html__( 'Email address to receive contact form submissions', 'slidefire-pro' ),
            ]
        );

        $this->end_controls_section();

        // Contact Info Section
        $this->start_controls_section(
            'contact_info_section',
            [
                'label' => esc_html__( 'Contact Information', 'slidefire-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_contact_info',
            [
                'label' => esc_html__( 'Show Contact Info', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'slidefire-pro' ),
                'label_off' => esc_html__( 'Hide', 'slidefire-pro' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'contact_email',
            [
                'label' => esc_html__( 'Display Email', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'support@slidefirepro.com',
                'condition' => [
                    'show_contact_info' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'response_time',
            [
                'label' => esc_html__( 'Response Time Text', 'slidefire-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'We\'ll get back to you within 24 hours with a detailed response to your inquiry.', 'slidefire-pro' ),
                'condition' => [
                    'show_contact_info' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab Controls
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
                    '{{WRAPPER}} .slidefire-contact-page' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .slidefire-contact-page' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .slidefire-contact-primary' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slidefire-contact-btn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slidefire-contact-gradient' => 'background: linear-gradient(to right, {{VALUE}}, #00ff88);',
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
        
        // Handle form submission
        $this->handle_form_submission();
        
        ?>
        <div class="slidefire-contact-page">
            <div class="slidefire-contact-container">
                <!-- Header -->
                <div class="slidefire-contact-header">
                    <h1 class="slidefire-contact-main-title">
                        <?php echo esc_html( $settings['main_title'] ); ?>
                        <span class="slidefire-contact-gradient slidefire-contact-highlight"><?php echo esc_html( $settings['title_highlight'] ); ?></span>
                    </h1>
                    <p class="slidefire-contact-description">
                        <?php echo wp_kses_post( $settings['description'] ); ?>
                    </p>
                </div>

                <!-- Contact Form -->
                <div class="slidefire-contact-form-wrapper">
                    <div class="slidefire-contact-card">
                        <div class="slidefire-contact-form-header">
                            <h2 class="slidefire-contact-form-title"><?php echo esc_html( $settings['form_title'] ); ?></h2>
                            <p class="slidefire-contact-form-description">
                                <?php echo wp_kses_post( $settings['form_description'] ); ?>
                            </p>
                        </div>

                        <form class="slidefire-contact-form" method="post" enctype="multipart/form-data" id="slidefire-contact-form">
                            <?php wp_nonce_field( 'slidefire_contact_form', 'slidefire_contact_nonce' ); ?>
                            
                            <!-- Contact Information Grid -->
                            <div class="slidefire-contact-grid">
                                <div class="slidefire-contact-field">
                                    <label for="slidefire-name" class="slidefire-contact-label">Full Name *</label>
                                    <input type="text" id="slidefire-name" name="slidefire_name" class="slidefire-contact-input" placeholder="Enter your full name" required>
                                </div>
                                <div class="slidefire-contact-field">
                                    <label for="slidefire-email" class="slidefire-contact-label">Email Address *</label>
                                    <input type="email" id="slidefire-email" name="slidefire_email" class="slidefire-contact-input" placeholder="Enter your email" required>
                                </div>
                            </div>

                            <div class="slidefire-contact-field">
                                <label for="slidefire-team" class="slidefire-contact-label">Team/Organization</label>
                                <input type="text" id="slidefire-team" name="slidefire_team" class="slidefire-contact-input" placeholder="Enter team or company name">
                            </div>

                            <!-- Inquiry Type -->
                            <div class="slidefire-contact-field">
                                <label for="slidefire-inquiry-type" class="slidefire-contact-label">Type of Inquiry</label>
                                <select id="slidefire-inquiry-type" name="slidefire_inquiry_type" class="slidefire-contact-select">
                                    <option value="">Select inquiry type</option>
                                    <option value="custom-design">Custom Design Request</option>
                                    <option value="team-order">Team/Bulk Order</option>
                                    <option value="product-question">Product Questions</option>
                                    <option value="sizing-help">Sizing Assistance</option>
                                    <option value="order-status">Order Status</option>
                                    <option value="general">General Inquiry</option>
                                </select>
                            </div>

                            <!-- Message -->
                            <div class="slidefire-contact-field">
                                <label for="slidefire-message" class="slidefire-contact-label">Message *</label>
                                <textarea id="slidefire-message" name="slidefire_message" class="slidefire-contact-textarea" placeholder="Tell us about your needs, questions, or project details. The more information you provide, the better we can assist you." rows="5" required></textarea>
                            </div>

                            <?php if ( 'yes' === $settings['enable_file_upload'] ) : ?>
                            <!-- File Upload -->
                            <div class="slidefire-contact-field">
                                <label for="slidefire-files" class="slidefire-contact-label">Attach Files (Optional)</label>
                                <p class="slidefire-contact-file-info">Upload design references, logos, or any relevant files</p>
                                <div class="slidefire-contact-file-upload">
                                    <input type="file" id="slidefire-files" name="slidefire_files[]" class="slidefire-contact-file-input" multiple accept="image/*,.pdf,.ai,.psd,.doc,.docx">
                                    <label for="slidefire-files" class="slidefire-contact-file-label">
                                        <svg class="slidefire-contact-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p><span class="slidefire-contact-primary">Click to upload</span> or drag and drop</p>
                                        <p class="slidefire-contact-file-types">PNG, JPG, PDF, AI, PSD, DOC up to 10MB each</p>
                                    </label>
                                </div>
                                <div id="slidefire-uploaded-files" class="slidefire-contact-uploaded-files"></div>
                            </div>
                            <?php endif; ?>

                            <!-- Submit Button -->
                            <button type="submit" name="slidefire_contact_submit" class="slidefire-contact-btn">
                                <svg class="slidefire-contact-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Send Message
                                <svg class="slidefire-contact-btn-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>

                            <?php if ( 'yes' === $settings['show_contact_info'] && !empty( $settings['response_time'] ) ) : ?>
                            <p class="slidefire-contact-response-time">
                                <?php echo esc_html( $settings['response_time'] ); ?>
                            </p>
                            <?php endif; ?>
                        </form>
                    </div>

                    <?php if ( 'yes' === $settings['show_contact_info'] && !empty( $settings['contact_email'] ) ) : ?>
                    <!-- Additional Contact Info -->
                    <div class="slidefire-contact-info">
                        <h3 class="slidefire-contact-info-title">Other Ways to Reach Us</h3>
                        <div class="slidefire-contact-email">
                            <svg class="slidefire-contact-email-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span><?php echo esc_html( $settings['contact_email'] ); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Handle contact form submission
     */
    private function handle_form_submission() {
        if ( ! isset( $_POST['slidefire_contact_submit'] ) ) {
            return;
        }

        // Verify nonce
        if ( ! wp_verify_nonce( $_POST['slidefire_contact_nonce'], 'slidefire_contact_form' ) ) {
            wp_die( esc_html__( 'Security check failed. Please try again.', 'slidefire-pro' ) );
        }

        // Sanitize and validate form data
        $name = sanitize_text_field( $_POST['slidefire_name'] );
        $email = sanitize_email( $_POST['slidefire_email'] );
        $team = sanitize_text_field( $_POST['slidefire_team'] );
        $inquiry_type = sanitize_text_field( $_POST['slidefire_inquiry_type'] );
        $message = sanitize_textarea_field( $_POST['slidefire_message'] );

        // Basic validation
        if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
            echo '<div class="slidefire-contact-error">Please fill in all required fields.</div>';
            return;
        }

        if ( ! is_email( $email ) ) {
            echo '<div class="slidefire-contact-error">Please enter a valid email address.</div>';
            return;
        }

        // Get settings
        $settings = $this->get_settings_for_display();
        $to_email = ! empty( $settings['recipient_email'] ) ? $settings['recipient_email'] : get_option( 'admin_email' );

        // Prepare email
        $subject = 'New Contact Form Submission from ' . $name;
        $email_body = "Name: {$name}\n";
        $email_body .= "Email: {$email}\n";
        if ( ! empty( $team ) ) {
            $email_body .= "Team/Organization: {$team}\n";
        }
        if ( ! empty( $inquiry_type ) ) {
            $email_body .= "Inquiry Type: {$inquiry_type}\n";
        }
        $email_body .= "\nMessage:\n{$message}\n";

        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . $name . ' <' . $email . '>',
            'Reply-To: ' . $email,
        );

        // Handle file attachments
        $attachments = array();
        if ( isset( $_FILES['slidefire_files'] ) && ! empty( $_FILES['slidefire_files']['name'][0] ) ) {
            $upload_dir = wp_upload_dir();
            $files = $_FILES['slidefire_files'];
            
            for ( $i = 0; $i < count( $files['name'] ); $i++ ) {
                if ( $files['error'][$i] === UPLOAD_ERR_OK ) {
                    $filename = sanitize_file_name( $files['name'][$i] );
                    $tmp_name = $files['tmp_name'][$i];
                    $upload_path = $upload_dir['path'] . '/' . $filename;
                    
                    if ( move_uploaded_file( $tmp_name, $upload_path ) ) {
                        $attachments[] = $upload_path;
                    }
                }
            }
        }

        // Send email
        $sent = wp_mail( $to_email, $subject, $email_body, $headers, $attachments );

        // Clean up uploaded files
        foreach ( $attachments as $attachment ) {
            if ( file_exists( $attachment ) ) {
                unlink( $attachment );
            }
        }

        if ( $sent ) {
            echo '<div class="slidefire-contact-success">Thank you for your message! We\'ll get back to you soon.</div>';
        } else {
            echo '<div class="slidefire-contact-error">There was an error sending your message. Please try again.</div>';
        }
    }

    /**
     * Render widget output in the editor.
     */
    protected function content_template() {
        ?>
        <div class="slidefire-contact-page">
            <div class="slidefire-contact-container">
                <!-- Header -->
                <div class="slidefire-contact-header">
                    <h1 class="slidefire-contact-main-title">
                        {{{ settings.main_title }}}
                        <span class="slidefire-contact-gradient slidefire-contact-highlight">{{{ settings.title_highlight }}}</span>
                    </h1>
                    <p class="slidefire-contact-description">
                        {{{ settings.description }}}
                    </p>
                </div>

                <!-- Contact Form -->
                <div class="slidefire-contact-form-wrapper">
                    <div class="slidefire-contact-card">
                        <div class="slidefire-contact-form-header">
                            <h2 class="slidefire-contact-form-title">{{{ settings.form_title }}}</h2>
                            <p class="slidefire-contact-form-description">
                                {{{ settings.form_description }}}
                            </p>
                        </div>

                        <form class="slidefire-contact-form">
                            <!-- Contact Information Grid -->
                            <div class="slidefire-contact-grid">
                                <div class="slidefire-contact-field">
                                    <label class="slidefire-contact-label">Full Name *</label>
                                    <input type="text" class="slidefire-contact-input" placeholder="Enter your full name">
                                </div>
                                <div class="slidefire-contact-field">
                                    <label class="slidefire-contact-label">Email Address *</label>
                                    <input type="email" class="slidefire-contact-input" placeholder="Enter your email">
                                </div>
                            </div>

                            <div class="slidefire-contact-field">
                                <label class="slidefire-contact-label">Team/Organization</label>
                                <input type="text" class="slidefire-contact-input" placeholder="Enter team or company name">
                            </div>

                            <div class="slidefire-contact-field">
                                <label class="slidefire-contact-label">Type of Inquiry</label>
                                <select class="slidefire-contact-select">
                                    <option>Select inquiry type</option>
                                    <option>Custom Design Request</option>
                                    <option>Team/Bulk Order</option>
                                    <option>Product Questions</option>
                                    <option>Sizing Assistance</option>
                                    <option>Order Status</option>
                                    <option>General Inquiry</option>
                                </select>
                            </div>

                            <div class="slidefire-contact-field">
                                <label class="slidefire-contact-label">Message *</label>
                                <textarea class="slidefire-contact-textarea" placeholder="Tell us about your needs, questions, or project details." rows="5"></textarea>
                            </div>

                            <# if ( 'yes' === settings.enable_file_upload ) { #>
                            <div class="slidefire-contact-field">
                                <label class="slidefire-contact-label">Attach Files (Optional)</label>
                                <p class="slidefire-contact-file-info">Upload design references, logos, or any relevant files</p>
                                <div class="slidefire-contact-file-upload">
                                    <input type="file" class="slidefire-contact-file-input" multiple>
                                    <label class="slidefire-contact-file-label">
                                        <svg class="slidefire-contact-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p><span class="slidefire-contact-primary">Click to upload</span> or drag and drop</p>
                                        <p class="slidefire-contact-file-types">PNG, JPG, PDF, AI, PSD, DOC up to 10MB each</p>
                                    </label>
                                </div>
                            </div>
                            <# } #>

                            <button type="button" class="slidefire-contact-btn">
                                <svg class="slidefire-contact-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Send Message
                                <svg class="slidefire-contact-btn-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>

                            <# if ( 'yes' === settings.show_contact_info && settings.response_time ) { #>
                            <p class="slidefire-contact-response-time">
                                {{{ settings.response_time }}}
                            </p>
                            <# } #>
                        </form>
                    </div>

                    <# if ( 'yes' === settings.show_contact_info && settings.contact_email ) { #>
                    <div class="slidefire-contact-info">
                        <h3 class="slidefire-contact-info-title">Other Ways to Reach Us</h3>
                        <div class="slidefire-contact-email">
                            <svg class="slidefire-contact-email-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{{ settings.contact_email }}}</span>
                        </div>
                    </div>
                    <# } #>
                </div>
            </div>
        </div>
        <?php
    }
}