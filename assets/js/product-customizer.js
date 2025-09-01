/**
 * Product Customizer Widget JavaScript
 */
(function($) {
    'use strict';

    class ProductCustomizer {
        constructor(element) {
            this.$element = $(element);
            this.$form = this.$element.find('.slidefire-cart-form');
            this.$addToCartBtn = this.$element.find('.add-to-cart-button');
            this.$buyNowBtn = this.$element.find('.buy-now-button');
            this.$wishlistBtn = this.$element.find('.wishlist-button');
            this.$variationSelects = this.$element.find('.variation-select');
            this.$customInputs = this.$element.find('.customization-input');

            this.init();
        }

        init() {
            this.bindEvents();
            this.setupVariationHandling();
        }

        bindEvents() {
            // Add to cart button click
            this.$addToCartBtn.on('click', (e) => {
                e.preventDefault();
                this.handleAddToCart();
            });

            // Buy now button click  
            this.$buyNowBtn.on('click', (e) => {
                e.preventDefault();
                this.handleBuyNow();
            });

            // Wishlist button click
            this.$wishlistBtn.on('click', (e) => {
                e.preventDefault();
                this.handleWishlist();
            });

            // Variation selects change
            this.$variationSelects.on('change', () => {
                this.handleVariationChange();
            });

            // Custom input validation
            this.$customInputs.on('input', (e) => {
                this.validateCustomInput(e.target);
            });
        }

        setupVariationHandling() {
            if (this.$variationSelects.length > 0) {
                // Initialize WooCommerce variations if available
                if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                    this.$form.find('.variations_form').wc_variation_form();
                }
            }
        }

        handleAddToCart() {
            // Show loading state
            this.setButtonState(this.$addToCartBtn, 'loading');

            // Validate inputs
            if (!this.validateForm()) {
                this.setButtonState(this.$addToCartBtn, 'error');
                setTimeout(() => {
                    this.resetButtonState(this.$addToCartBtn);
                }, 3000);
                return;
            }

            // Get form data
            const formData = this.getFormData();

            // Handle different product types
            const productType = this.getProductType();
            
            if (productType === 'variable' && !this.areVariationsSelected()) {
                this.showNotification('Please select all product options.', 'error');
                this.setButtonState(this.$addToCartBtn, 'error');
                setTimeout(() => {
                    this.resetButtonState(this.$addToCartBtn);
                }, 3000);
                return;
            }

            // Use WooCommerce AJAX add to cart or custom handler
            if (productType === 'simple') {
                this.addSimpleProductToCart(formData);
            } else {
                this.addVariableProductToCart(formData);
            }
        }

        handleBuyNow() {
            // First add to cart, then redirect to checkout
            this.setButtonState(this.$buyNowBtn, 'loading');

            if (!this.validateForm()) {
                this.setButtonState(this.$buyNowBtn, 'error');
                setTimeout(() => {
                    this.resetButtonState(this.$buyNowBtn);
                }, 3000);
                return;
            }

            const formData = this.getFormData();
            
            // Add to cart first
            this.addToCartForBuyNow(formData);
        }

        handleWishlist() {
            // Add to wishlist functionality
            this.setButtonState(this.$wishlistBtn, 'loading');

            // Get product ID
            const productId = this.getProductId();

            if (!productId) {
                this.showNotification('Unable to add to wishlist.', 'error');
                this.resetButtonState(this.$wishlistBtn);
                return;
            }

            // Check if wishlist plugin is available
            if (typeof yith_wcwl_l10n !== 'undefined' || typeof tinvwl_add_to_wishlist !== 'function') {
                // Use custom wishlist handler
                this.addToWishlist(productId);
            } else {
                this.showNotification('Wishlist functionality not available.', 'error');
                this.resetButtonState(this.$wishlistBtn);
            }
        }

        handleVariationChange() {
            const variations = this.getSelectedVariations();
            this.updatePricing(variations);
            this.updateStock(variations);
        }

        validateForm() {
            let isValid = true;

            // Validate custom inputs
            this.$customInputs.each((index, input) => {
                if (!this.validateCustomInput(input)) {
                    isValid = false;
                }
            });

            return isValid;
        }

        validateCustomInput(input) {
            const $input = $(input);
            const name = $input.attr('name');
            const value = $input.val().trim();

            // Remove existing error styles
            $input.removeClass('error');

            if (name === 'jersey_number' && value) {
                // Validate jersey number (00-99)
                const numberPattern = /^[0-9]{1,2}$/;
                if (!numberPattern.test(value) || parseInt(value) > 99) {
                    $input.addClass('error');
                    this.showNotification('Jersey number must be between 00-99.', 'error');
                    return false;
                }
            }

            if (name === 'player_name' && value && value.length > 20) {
                $input.addClass('error');
                this.showNotification('Player name cannot exceed 20 characters.', 'error');
                return false;
            }

            return true;
        }

        getFormData() {
            const formData = new FormData();

            // Add product ID
            const productId = this.getProductId();
            formData.append('product_id', productId);

            // Add quantity
            formData.append('quantity', 1);

            // Add variations if any
            this.$variationSelects.each((index, select) => {
                const $select = $(select);
                const name = $select.attr('name');
                const value = $select.val();
                if (name && value) {
                    formData.append(name, value);
                }
            });

            // Add custom inputs
            this.$customInputs.each((index, input) => {
                const $input = $(input);
                const name = $input.attr('name');
                const value = $input.val().trim();
                if (name && value) {
                    formData.append(name, value);
                }
            });

            // Add action
            formData.append('action', 'woocommerce_add_to_cart');

            // Add security nonce if available
            if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.wc_ajax_url) {
                formData.append('security', wc_add_to_cart_params.add_to_cart_nonce);
            }

            return formData;
        }

        addSimpleProductToCart(formData) {
            $.ajax({
                url: wc_add_to_cart_params.ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    if (response.error) {
                        this.handleAddToCartError(response.error);
                    } else {
                        this.handleAddToCartSuccess(response);
                    }
                },
                error: () => {
                    this.handleAddToCartError('Failed to add product to cart.');
                }
            });
        }

        addVariableProductToCart(formData) {
            // Use the hidden WooCommerce form for variable products
            const $hiddenForm = this.$form.find('.variations_form');
            
            if ($hiddenForm.length > 0) {
                // Trigger WooCommerce add to cart
                $hiddenForm.find('.single_add_to_cart_button').trigger('click');
            } else {
                this.addSimpleProductToCart(formData);
            }
        }

        addToCartForBuyNow(formData) {
            $.ajax({
                url: wc_add_to_cart_params.ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    if (response.error) {
                        this.handleBuyNowError(response.error);
                    } else {
                        // Redirect to checkout
                        window.location.href = wc_add_to_cart_params.checkout_url;
                    }
                },
                error: () => {
                    this.handleBuyNowError('Failed to process buy now request.');
                }
            });
        }

        addToWishlist(productId) {
            // Custom wishlist implementation
            const wishlistData = {
                action: 'add_to_wishlist',
                product_id: productId,
                security: this.getWishlistNonce()
            };

            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: wishlistData,
                success: (response) => {
                    if (response.success) {
                        this.setButtonState(this.$wishlistBtn, 'success');
                        this.showNotification('Added to wishlist!', 'success');
                        setTimeout(() => {
                            this.resetButtonState(this.$wishlistBtn);
                        }, 3000);
                    } else {
                        this.handleWishlistError(response.data || 'Failed to add to wishlist.');
                    }
                },
                error: () => {
                    this.handleWishlistError('Failed to add to wishlist.');
                }
            });
        }

        handleAddToCartSuccess(response) {
            this.setButtonState(this.$addToCartBtn, 'success');
            this.showNotification('Added to cart!', 'success');
            
            // Update mini cart if available
            if (typeof wc_add_to_cart_params !== 'undefined') {
                $(document.body).trigger('wc_fragment_refresh');
            }

            setTimeout(() => {
                this.resetButtonState(this.$addToCartBtn);
            }, 3000);
        }

        handleAddToCartError(error) {
            this.setButtonState(this.$addToCartBtn, 'error');
            this.showNotification(error, 'error');
            
            setTimeout(() => {
                this.resetButtonState(this.$addToCartBtn);
            }, 3000);
        }

        handleBuyNowError(error) {
            this.setButtonState(this.$buyNowBtn, 'error');
            this.showNotification(error, 'error');
            
            setTimeout(() => {
                this.resetButtonState(this.$buyNowBtn);
            }, 3000);
        }

        handleWishlistError(error) {
            this.setButtonState(this.$wishlistBtn, 'error');
            this.showNotification(error, 'error');
            
            setTimeout(() => {
                this.resetButtonState(this.$wishlistBtn);
            }, 3000);
        }

        setButtonState($button, state) {
            $button.removeClass('loading success error');
            $button.addClass(state);
        }

        resetButtonState($button) {
            $button.removeClass('loading success error');
        }

        showNotification(message, type = 'info') {
            // Create or update notification
            let $notification = $('.slidefire-notification');
            
            if ($notification.length === 0) {
                $notification = $('<div class="slidefire-notification"></div>');
                $('body').append($notification);
            }

            $notification
                .removeClass('success error info warning')
                .addClass(type)
                .text(message)
                .fadeIn()
                .delay(4000)
                .fadeOut();
        }

        getProductId() {
            // Try to get product ID from various sources
            const productId = this.$element.find('[data-product-id]').data('product-id') ||
                             $('input[name="product_id"]').val() ||
                             $('input[name="add-to-cart"]').val() ||
                             $('.product').data('product-id');

            return productId;
        }

        getProductType() {
            // Determine if product is simple or variable
            return this.$variationSelects.length > 0 ? 'variable' : 'simple';
        }

        areVariationsSelected() {
            let allSelected = true;
            
            this.$variationSelects.each((index, select) => {
                if (!$(select).val()) {
                    allSelected = false;
                    return false;
                }
            });

            return allSelected;
        }

        getSelectedVariations() {
            const variations = {};
            
            this.$variationSelects.each((index, select) => {
                const $select = $(select);
                const name = $select.attr('name');
                const value = $select.val();
                
                if (name && value) {
                    variations[name] = value;
                }
            });

            return variations;
        }

        getWishlistNonce() {
            // Try to get wishlist nonce from various sources
            return $('input[name="wishlist_nonce"]').val() || '';
        }

        updatePricing(variations) {
            // Update pricing based on selected variations
            // This would integrate with WooCommerce variation price display
            if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                // Let WooCommerce handle price updates
                $(document.body).trigger('woocommerce_variation_has_changed');
            }
        }

        updateStock(variations) {
            // Update stock status based on selected variations
            // This would integrate with WooCommerce variation stock display
        }
    }

    // Initialize widget when DOM is ready
    $(document).ready(function() {
        $('.slidefire-product-customizer').each(function() {
            new ProductCustomizer(this);
        });
    });

    // Initialize for new instances (e.g., after AJAX)
    $(document).on('elementor/popup/show', function() {
        $('.slidefire-product-customizer').each(function() {
            if (!$(this).data('slidefire-initialized')) {
                new ProductCustomizer(this);
                $(this).data('slidefire-initialized', true);
            }
        });
    });

})(jQuery);