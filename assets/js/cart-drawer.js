/**
 * Cart Drawer Widget JavaScript
 */

(function($) {
    'use strict';

    // Cart Drawer Widget Class
    var CartDrawerWidget = function($element) {
        this.$element = $element;
        this.widgetId = $element.find('.slidefire-cart-trigger').attr('id').replace('slidefire-cart-trigger-', '');
        this.$trigger = $element.find('.slidefire-cart-trigger');
        this.$overlay = $element.find('.slidefire-cart-drawer-overlay');
        this.$drawer = $element.find('.slidefire-cart-drawer');
        this.$closeBtn = $element.find('.slidefire-cart-close');
        this.$cartContent = $element.find('.slidefire-cart-drawer-body');
        this.$badge = $element.find('.slidefire-cart-badge');
        this.$headerBadge = $element.find('.slidefire-cart-header-badge');
        this.$headerCount = $element.find('[id^="slidefire-cart-count-header-"]');
        
        this.isOpen = false;
        this.isUpdating = false;
        
        this.init();
    };

    CartDrawerWidget.prototype = {
        init: function() {
            this.bindEvents();
            this.initializeCart();
            
            // Listen for WooCommerce cart updates
            $(document.body).on('added_to_cart updated_wc_div wc_fragment_refresh', this.handleCartUpdate.bind(this));
        },

        bindEvents: function() {
            var self = this;
            
            // Open drawer
            this.$trigger.on('click', function(e) {
                e.preventDefault();
                self.openDrawer();
            });
            
            // Close drawer
            this.$closeBtn.on('click', function(e) {
                e.preventDefault();
                self.closeDrawer();
            });
            
            this.$overlay.on('click', function(e) {
                if (e.target === this) {
                    self.closeDrawer();
                }
            });
            
            // Continue shopping button
            this.$drawer.on('click', '.slidefire-close-drawer', function(e) {
                e.preventDefault();
                self.closeDrawer();
            });
            
            // Quantity controls
            this.$drawer.on('click', '.slidefire-quantity-increase', function(e) {
                e.preventDefault();
                var $btn = $(this);
                var cartItemKey = $btn.data('cart-item-key');
                var $quantityEl = $btn.siblings('.slidefire-quantity-value');
                var currentQty = parseInt($quantityEl.text());
                self.updateQuantity(cartItemKey, currentQty + 1, $quantityEl);
            });
            
            this.$drawer.on('click', '.slidefire-quantity-decrease', function(e) {
                e.preventDefault();
                var $btn = $(this);
                var cartItemKey = $btn.data('cart-item-key');
                var $quantityEl = $btn.siblings('.slidefire-quantity-value');
                var currentQty = parseInt($quantityEl.text());
                if (currentQty > 1) {
                    self.updateQuantity(cartItemKey, currentQty - 1, $quantityEl);
                }
            });
            
            // Remove item
            this.$drawer.on('click', '.slidefire-remove-item', function(e) {
                e.preventDefault();
                var $btn = $(this);
                var cartItemKey = $btn.data('cart-item-key');
                self.removeItem(cartItemKey, $btn.closest('.slidefire-cart-item'));
            });
            
            // Keyboard support
            $(document).on('keydown', function(e) {
                if (e.keyCode === 27 && self.isOpen) { // ESC key
                    self.closeDrawer();
                }
            });
        },

        openDrawer: function() {
            if (this.isOpen) return;
            
            this.isOpen = true;
            this.$overlay.addClass('active');
            this.$drawer.addClass('active');
            
            // Prevent body scroll
            $('body').addClass('slidefire-drawer-open').css('overflow', 'hidden');
            
            // Focus management
            this.$closeBtn.focus();
            
            // Refresh cart content
            this.refreshCart();
        },

        closeDrawer: function() {
            if (!this.isOpen) return;
            
            this.isOpen = false;
            this.$overlay.removeClass('active');
            this.$drawer.removeClass('active');
            
            // Restore body scroll
            $('body').removeClass('slidefire-drawer-open').css('overflow', '');
            
            // Return focus to trigger
            this.$trigger.focus();
        },

        initializeCart: function() {
            this.refreshCart();
        },

        refreshCart: function() {
            var self = this;
            
            if (this.isUpdating) return;
            this.isUpdating = true;
            
            this.showLoading();
            
            // Get fresh cart content via AJAX
            $.ajax({
                url: slideFireProCartAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefire_get_cart_content',
                    nonce: slideFireProCartAjax.nonce,
                    widget_id: this.widgetId
                },
                success: function(response) {
                    if (response.success) {
                        self.$cartContent.html(response.data.content);
                        self.updateBadges(response.data.count);
                        
                        // Update WooCommerce fragments if available
                        if (response.data.fragments) {
                            self.updateFragments(response.data.fragments);
                        }
                    } else {
                        console.error('Failed to refresh cart:', response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Cart refresh error:', error);
                    self.showError('Failed to load cart content');
                },
                complete: function() {
                    self.isUpdating = false;
                    self.hideLoading();
                }
            });
        },

        updateQuantity: function(cartItemKey, quantity, $quantityEl) {
            var self = this;
            var $item = $quantityEl.closest('.slidefire-cart-item');
            
            if (this.isUpdating) return;
            this.isUpdating = true;
            
            $item.addClass('updating');
            
            $.ajax({
                url: slideFireProCartAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefire_update_cart_quantity',
                    nonce: slideFireProCartAjax.nonce,
                    cart_item_key: cartItemKey,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        // Update quantity display
                        $quantityEl.text(quantity);
                        
                        // Update item price
                        if (response.data.item_total) {
                            $item.find('.slidefire-item-total').html(response.data.item_total);
                        }
                        
                        // Update cart totals
                        if (response.data.cart_totals) {
                            self.updateCartTotals(response.data.cart_totals);
                        }
                        
                        // Update badges
                        self.updateBadges(response.data.cart_count);
                        
                        // Update disable state for decrease button
                        var $decreaseBtn = $item.find('.slidefire-quantity-decrease');
                        if (quantity <= 1) {
                            $decreaseBtn.prop('disabled', true);
                        } else {
                            $decreaseBtn.prop('disabled', false);
                        }
                        
                        // Trigger WooCommerce cart update event
                        $(document.body).trigger('wc_fragment_refresh');
                        
                    } else {
                        console.error('Failed to update quantity:', response.data);
                        self.showError('Failed to update item quantity');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Quantity update error:', error);
                    self.showError('Failed to update item quantity');
                },
                complete: function() {
                    $item.removeClass('updating');
                    self.isUpdating = false;
                }
            });
        },

        removeItem: function(cartItemKey, $item) {
            var self = this;
            
            if (this.isUpdating) return;
            this.isUpdating = true;
            
            $item.addClass('removing');
            
            $.ajax({
                url: slideFireProCartAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefire_remove_cart_item',
                    nonce: slideFireProCartAjax.nonce,
                    cart_item_key: cartItemKey
                },
                success: function(response) {
                    if (response.success) {
                        // Remove item with animation
                        $item.slideUp(300, function() {
                            $item.remove();
                            
                            // Check if cart is now empty
                            if (response.data.cart_count === 0) {
                                self.refreshCart(); // Show empty cart state
                            }
                        });
                        
                        // Update cart totals
                        if (response.data.cart_totals) {
                            self.updateCartTotals(response.data.cart_totals);
                        }
                        
                        // Update badges
                        self.updateBadges(response.data.cart_count);
                        
                        // Trigger WooCommerce cart update event
                        $(document.body).trigger('wc_fragment_refresh');
                        
                    } else {
                        console.error('Failed to remove item:', response.data);
                        self.showError('Failed to remove item from cart');
                        $item.removeClass('removing');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Item removal error:', error);
                    self.showError('Failed to remove item from cart');
                    $item.removeClass('removing');
                },
                complete: function() {
                    self.isUpdating = false;
                }
            });
        },

        updateBadges: function(count) {
            var displayCount = count > 99 ? '99+' : count;
            
            // Update trigger badge
            if (this.$badge.length) {
                if (count > 0) {
                    this.$badge.text(displayCount).show();
                } else {
                    this.$badge.hide();
                }
            }
            
            // Update header badge
            if (this.$headerCount.length) {
                this.$headerCount.text(displayCount);
                var itemText = count === 1 ? 'item' : 'items';
                this.$headerBadge.find('span').last().text(itemText);
                
                if (count > 0) {
                    this.$headerBadge.show();
                } else {
                    this.$headerBadge.hide();
                }
            }
        },

        updateCartTotals: function(totals) {
            var $summary = this.$drawer.find('.slidefire-cart-summary');
            
            if (totals.subtotal) {
                $summary.find('.slidefire-summary-row').eq(0).find('.slidefire-summary-value').html(totals.subtotal);
            }
            if (totals.tax) {
                $summary.find('.slidefire-summary-row').eq(1).find('.slidefire-summary-value').html(totals.tax);
            }
            if (totals.shipping) {
                $summary.find('.slidefire-summary-row').eq(2).find('.slidefire-summary-value').html(totals.shipping);
            }
            if (totals.total) {
                $summary.find('.slidefire-total-price').html(totals.total);
            }
            
            // Update free shipping notice
            if (totals.free_shipping_notice) {
                var $notice = $summary.find('.slidefire-free-shipping-notice');
                if (totals.free_shipping_notice.show) {
                    if ($notice.length === 0) {
                        $notice = $('<div class="slidefire-free-shipping-notice"></div>');
                        $summary.find('.slidefire-summary-separator').before($notice);
                    }
                    $notice.html(totals.free_shipping_notice.message).show();
                } else {
                    $notice.hide();
                }
            }
        },

        updateFragments: function(fragments) {
            // Update WooCommerce cart fragments
            if (typeof fragments === 'object') {
                $.each(fragments, function(key, value) {
                    $(key).replaceWith(value);
                });
            }
        },

        handleCartUpdate: function(event, fragments, cart_hash) {
            // Handle WooCommerce cart updates from other sources
            if (!this.isUpdating) {
                var self = this;
                setTimeout(function() {
                    self.refreshCart();
                }, 100);
            }
        },

        showLoading: function() {
            if (!this.$cartContent.find('.slidefire-cart-loading').length) {
                this.$cartContent.append('<div class="slidefire-cart-loading">Loading cart...</div>');
            }
        },

        hideLoading: function() {
            this.$cartContent.find('.slidefire-cart-loading').remove();
        },

        showError: function(message) {
            // You could implement a toast notification or inline error display here
            console.error('Cart Drawer Error:', message);
            
            // Simple alert for now - you might want to implement a better UX
            if (window.slideFireProCartAjax && slideFireProCartAjax.show_errors) {
                alert(message);
            }
        }
    };

    // Initialize cart drawer widgets
    function initCartDrawers() {
        $('.slidefire-cart-drawer-wrapper').each(function() {
            var $element = $(this);
            if (!$element.data('slidefire-cart-drawer')) {
                var cartDrawer = new CartDrawerWidget($element);
                $element.data('slidefire-cart-drawer', cartDrawer);
            }
        });
    }

    // Document ready
    $(document).ready(function() {
        initCartDrawers();
    });

    // Elementor frontend compatibility
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/slidefire_cart_drawer.default', function($scope) {
            var $wrapper = $scope.find('.slidefire-cart-drawer-wrapper');
            if ($wrapper.length && !$wrapper.data('slidefire-cart-drawer')) {
                var cartDrawer = new CartDrawerWidget($wrapper);
                $wrapper.data('slidefire-cart-drawer', cartDrawer);
            }
        });
    });

    // Global access for debugging
    window.SlideFireCartDrawer = CartDrawerWidget;

})(jQuery);