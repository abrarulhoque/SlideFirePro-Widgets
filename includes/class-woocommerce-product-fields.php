<?php
namespace SlideFirePro_Widgets;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WooCommerce_Product_Fields {

    public function __construct() {
        // Only run if WooCommerce is active
        if ( ! class_exists( 'WooCommerce' ) ) {
            return;
        }

        // Add custom tab to product data metabox
        add_filter( 'woocommerce_product_data_tabs', [ $this, 'add_product_features_tab' ] );
        
        // Display custom fields in the tab
        add_action( 'woocommerce_product_data_panels', [ $this, 'display_product_features_fields' ] );
        
        // Save custom fields
        add_action( 'woocommerce_process_product_meta', [ $this, 'save_product_features_fields' ] );
        
        // Enqueue admin scripts for repeater functionality
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
    }

    /**
     * Add custom tab to product data metabox
     */
    public function add_product_features_tab( $tabs ) {
        $tabs['slidefire_features'] = [
            'label'    => __( 'Features & Specs', 'slidefirePro-widgets' ),
            'target'   => 'slidefire_features_options',
            'class'    => [ 'show_if_simple', 'show_if_variable' ],
            'priority' => 21,
        ];

        return $tabs;
    }

    /**
     * Display custom fields in the tab
     */
    public function display_product_features_fields() {
        global $post;
        
        echo '<div id="slidefire_features_options" class="panel woocommerce_options_panel">';
        
        // Features Section
        echo '<div class="options_group">';
        echo '<h3>' . __( 'Product Features', 'slidefirePro-widgets' ) . '</h3>';
        echo '<p class="form-field">';
        echo '<label>' . __( 'Features List', 'slidefirePro-widgets' ) . '</label>';
        
        // Get existing features
        $features = get_post_meta( $post->ID, '_slidefire_product_features', true );
        $features = $features ? $features : [];
        
        echo '<div id="slidefire-features-repeater">';
        echo '<div class="slidefire-repeater-items">';
        
        if ( ! empty( $features ) ) {
            foreach ( $features as $index => $feature ) {
                $this->render_feature_item( $index, $feature );
            }
        } else {
            $this->render_feature_item( 0, '' );
        }
        
        echo '</div>';
        echo '<button type="button" class="button add-feature-item">' . __( 'Add Feature', 'slidefirePro-widgets' ) . '</button>';
        echo '</div>';
        echo '</p>';
        echo '</div>';

        // Shipping & Turnaround Section  
        echo '<div class="options_group">';
        echo '<h3>' . __( 'Shipping & Turnaround Time', 'slidefirePro-widgets' ) . '</h3>';
        
        woocommerce_wp_text_input( [
            'id'          => '_slidefire_production_time',
            'label'       => __( 'Production Time', 'slidefirePro-widgets' ),
            'placeholder' => __( 'e.g., 10 - 12 days plus shipping', 'slidefirePro-widgets' ),
            'desc_tip'    => true,
            'description' => __( 'Production time information displayed to customers', 'slidefirePro-widgets' ),
        ] );
        
        woocommerce_wp_text_input( [
            'id'          => '_slidefire_production_note',
            'label'       => __( 'Production Note', 'slidefirePro-widgets' ),
            'placeholder' => __( 'e.g., *Design time not included', 'slidefirePro-widgets' ),
            'desc_tip'    => true,
            'description' => __( 'Additional note about production time', 'slidefirePro-widgets' ),
        ] );
        
        woocommerce_wp_text_input( [
            'id'          => '_slidefire_shipping_info',
            'label'       => __( 'Shipping Information', 'slidefirePro-widgets' ),
            'placeholder' => __( 'e.g., Fast and reliable shipping', 'slidefirePro-widgets' ),
            'desc_tip'    => true,
            'description' => __( 'Shipping information displayed to customers', 'slidefirePro-widgets' ),
        ] );
        
        echo '</div>';

        // Product Specifications Section
        echo '<div class="options_group">';
        echo '<h3>' . __( 'Product Specifications', 'slidefirePro-widgets' ) . '</h3>';
        echo '<p class="form-field">';
        echo '<label>' . __( 'Specifications', 'slidefirePro-widgets' ) . '</label>';
        
        // Get existing specifications
        $specifications = get_post_meta( $post->ID, '_slidefire_product_specifications', true );
        $specifications = $specifications ? $specifications : [];
        
        echo '<div id="slidefire-specifications-repeater">';
        echo '<div class="slidefire-repeater-items">';
        
        if ( ! empty( $specifications ) ) {
            foreach ( $specifications as $index => $spec ) {
                $this->render_specification_item( $index, $spec );
            }
        } else {
            $this->render_specification_item( 0, [ 'name' => '', 'value' => '' ] );
        }
        
        echo '</div>';
        echo '<button type="button" class="button add-specification-item">' . __( 'Add Specification', 'slidefirePro-widgets' ) . '</button>';
        echo '</div>';
        echo '</p>';
        echo '</div>';
        
        echo '</div>';
    }

    /**
     * Render a single feature item
     */
    private function render_feature_item( $index, $value ) {
        ?>
        <div class="slidefire-repeater-item" data-index="<?php echo esc_attr( $index ); ?>">
            <input type="text" name="slidefire_product_features[<?php echo esc_attr( $index ); ?>]" 
                   value="<?php echo esc_attr( $value ); ?>" 
                   placeholder="<?php esc_attr_e( 'Enter feature description', 'slidefirePro-widgets' ); ?>" 
                   style="width: 90%;" />
            <button type="button" class="button remove-item" style="margin-left: 5px;"><?php esc_html_e( 'Remove', 'slidefirePro-widgets' ); ?></button>
        </div>
        <?php
    }

    /**
     * Render a single specification item
     */
    private function render_specification_item( $index, $spec ) {
        $name = isset( $spec['name'] ) ? $spec['name'] : '';
        $value = isset( $spec['value'] ) ? $spec['value'] : '';
        ?>
        <div class="slidefire-repeater-item" data-index="<?php echo esc_attr( $index ); ?>" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center;">
            <input type="text" name="slidefire_product_specifications[<?php echo esc_attr( $index ); ?>][name]" 
                   value="<?php echo esc_attr( $name ); ?>" 
                   placeholder="<?php esc_attr_e( 'Specification name (e.g., Origin)', 'slidefirePro-widgets' ); ?>" 
                   style="width: 40%;" />
            <input type="text" name="slidefire_product_specifications[<?php echo esc_attr( $index ); ?>][value]" 
                   value="<?php echo esc_attr( $value ); ?>" 
                   placeholder="<?php esc_attr_e( 'Specification value (e.g., Designed in USA)', 'slidefirePro-widgets' ); ?>" 
                   style="width: 40%;" />
            <button type="button" class="button remove-item"><?php esc_html_e( 'Remove', 'slidefirePro-widgets' ); ?></button>
        </div>
        <?php
    }

    /**
     * Save custom fields
     */
    public function save_product_features_fields( $post_id ) {
        // Save features
        if ( isset( $_POST['slidefire_product_features'] ) ) {
            $features = array_filter( array_map( 'sanitize_text_field', $_POST['slidefire_product_features'] ) );
            update_post_meta( $post_id, '_slidefire_product_features', $features );
        } else {
            delete_post_meta( $post_id, '_slidefire_product_features' );
        }

        // Save shipping & production fields
        $shipping_fields = [
            '_slidefire_production_time',
            '_slidefire_production_note',
            '_slidefire_shipping_info'
        ];

        foreach ( $shipping_fields as $field ) {
            // Field IDs are used as the POST keys by woocommerce_wp_text_input
            if ( isset( $_POST[ $field ] ) ) {
                $value = sanitize_text_field( $_POST[ $field ] );
                update_post_meta( $post_id, $field, $value );
            }
        }

        // Save specifications
        if ( isset( $_POST['slidefire_product_specifications'] ) ) {
            $specifications = [];
            foreach ( $_POST['slidefire_product_specifications'] as $spec ) {
                if ( ! empty( $spec['name'] ) || ! empty( $spec['value'] ) ) {
                    $specifications[] = [
                        'name'  => sanitize_text_field( $spec['name'] ),
                        'value' => sanitize_text_field( $spec['value'] )
                    ];
                }
            }
            update_post_meta( $post_id, '_slidefire_product_specifications', $specifications );
        } else {
            delete_post_meta( $post_id, '_slidefire_product_specifications' );
        }
    }

    /**
     * Enqueue admin scripts for repeater functionality
     */
    public function enqueue_admin_scripts( $hook ) {
        global $post;

        // Only load on product edit pages
        if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ] ) ) {
            return;
        }

        if ( ! $post || $post->post_type !== 'product' ) {
            return;
        }

        wp_enqueue_script(
            'slidefire-product-fields-admin',
            SLIDEFIREPRO_WIDGETS_URL . 'assets/js/product-fields-admin.js',
            [ 'jquery' ],
            SLIDEFIREPRO_WIDGETS_VERSION,
            true
        );

        wp_enqueue_style(
            'slidefire-product-fields-admin',
            SLIDEFIREPRO_WIDGETS_URL . 'assets/css/product-fields-admin.css',
            [],
            SLIDEFIREPRO_WIDGETS_VERSION
        );
    }

    /**
     * Get product features for frontend display
     */
    public static function get_product_features( $product_id ) {
        $features = get_post_meta( $product_id, '_slidefire_product_features', true );
        return $features ? $features : [];
    }

    /**
     * Get product shipping info for frontend display
     */
    public static function get_product_shipping_info( $product_id ) {
        return [
            'production_time' => get_post_meta( $product_id, '_slidefire_production_time', true ),
            'production_note' => get_post_meta( $product_id, '_slidefire_production_note', true ),
            'shipping_info'   => get_post_meta( $product_id, '_slidefire_shipping_info', true ),
        ];
    }

    /**
     * Get product specifications for frontend display
     */
    public static function get_product_specifications( $product_id ) {
        $specifications = get_post_meta( $product_id, '_slidefire_product_specifications', true );
        return $specifications ? $specifications : [];
    }
}

// Initialize the class
new WooCommerce_Product_Fields();
