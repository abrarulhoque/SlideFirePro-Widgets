/**
 * WooCommerce Products Widget JavaScript
 * Handles AJAX filtering, load more, and product interactions
 */

(function($) {
    'use strict';

    class SlideFireProProductsWidget {
        constructor() {
            // Prevent double-binding when both DOM ready and Elementor init fire
            if (window.__SlideFireProProductsBound) return;
            window.__SlideFireProProductsBound = true;
            this.init();
        }

        init() {
            this.bindEvents();
            this.setupFilterListeners();
        }

        bindEvents() {
            // Quick Add Button
            $(document).on('click', '.quick-add-button', this.handleQuickAdd.bind(this));
            
            // Wishlist Button
            $(document).on('click', '.wishlist-button', this.handleWishlist.bind(this));
            
            // Load More Button
            $(document).on('click', '.load-more-button', this.handleLoadMore.bind(this));
            
            // Product Card Click (for product page navigation)
            $(document).on('click', '.product-card', this.handleProductClick.bind(this));
        }

        setupFilterListeners() {
            // Listen for category filter changes - following Elementor Pro pattern
            $(document).on('slideFirePro:categoryChanged', this.handleCategoryFilter.bind(this));
            
            // Listen for product filter changes (search, sort, etc.)
            $(document).on('slideFirePro:productFilterChanged', this.handleProductFilter.bind(this));
            
            // Listen for products updated events
            $(document).on('slideFirePro:productsUpdated', this.handleProductsUpdated.bind(this));
        }

        handleQuickAdd(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const button = $(e.currentTarget);
            const productId = button.data('product-id');
            const productType = button.data('product-type');
            const productUrl = button.data('product-url');
            const quantity = parseInt(button.data('quantity'), 10) || 1;

            // For variable products (need option selection), go to product page
            if (productType === 'variable' && productUrl) {
                window.location.href = productUrl;
                return;
            }
            
            if (!productId) {
                console.error('Product ID not found');
                return;
            }

            // Add loading state
            button.addClass('loading').prop('disabled', true);
            const originalHtml = button.html();
            
            // Create loading spinner with icon structure matching Figma
            const loadingHtml = `
                <svg class="cart-icon animate-spin" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" opacity="0.25"></circle>
                    <path d="M4,12a8,8 0 1,1 8,-8V0C5.373,0 0,5.373 0,12h4zm2,5.291A7.962,7.962 0 0,1 4,12H0c0,3.042 1.135,5.824 3,7.938l3,-2.647z" opacity="0.75"></path>
                </svg>
                Adding...
            `;
            button.html(loadingHtml);

            // AJAX call to add product to cart
            $.ajax({
                url: slideFireProAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefirePro_add_to_cart',
                    product_id: productId,
                    quantity,
                    nonce: slideFireProAjax.nonce
                },
                success: (response) => {
                    if (response.success) {
                        // Show success message
                        this.showNotification('Product added to cart!', 'success');
                        
                        // Trigger WooCommerce cart update event
                        $(document.body).trigger('added_to_cart', [response.data.fragments, response.data.cart_hash, button]);
                        
                        // Update button with success state
                        const successHtml = `
                            <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 12 2 2 4-4"></path>
                                <path d="M21 12c.552 0 1-.448 1-1V5a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v6c0 .552.448 1 1 1"></path>
                            </svg>
                            Added!
                        `;
                        button.html(successHtml);
                        
                        setTimeout(() => {
                            button.html(originalHtml);
                        }, 2000);
                    } else {
                        this.showNotification(response.data.message || 'Failed to add product to cart', 'error');
                        button.html(originalHtml);
                    }
                },
                error: () => {
                    this.showNotification('Error adding product to cart', 'error');
                    button.html(originalHtml);
                },
                complete: () => {
                    button.removeClass('loading').prop('disabled', false);
                }
            });
        }

        handleWishlist(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const button = $(e.currentTarget);
            const productId = button.closest('.product-card').data('product-id');
            
            // Toggle wishlist state with visual feedback
            button.toggleClass('active');
            
            if (button.hasClass('active')) {
                // Fill the heart icon
                button.find('.heart-icon').attr('fill', 'currentColor');
                button.addClass('text-red-500');
                this.showNotification('Added to wishlist!', 'success');
                
                // Add subtle animation
                button.addClass('animate-pulse');
                setTimeout(() => {
                    button.removeClass('animate-pulse');
                }, 500);
            } else {
                // Unfill the heart icon
                button.find('.heart-icon').attr('fill', 'none');
                button.removeClass('text-red-500');
                this.showNotification('Removed from wishlist!', 'info');
            }
            
            // Here you would typically make an AJAX call to save wishlist state
            // This is a simplified version for demonstration
        }

        handleLoadMore(e) {
            e.preventDefault();
            
            const button = $(e.currentTarget);
            const currentPage = parseInt(button.data('page') || 1);
            const nextPage = currentPage + 1;
            const wrapper = button.closest('.slidefirePro-products-wrapper');
            const widgetId = wrapper.data('widget-id');
            const settings = wrapper.data('settings');
            
            // Add loading state
            button.addClass('loading').prop('disabled', true);
            const originalText = button.text();
            button.text('Loading...');
            
            // Get current filter states
            const filters = this.getCurrentFilters();
            
            $.ajax({
                url: slideFireProAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefirePro_load_more_products',
                    widget_id: widgetId,
                    page: nextPage,
                    settings: settings,
                    filters: filters,
                    nonce: slideFireProAjax.nonce
                },
                success: (response) => {
                    if (response.success && response.data.html) {
                        // Append new products to grid
                        const grid = wrapper.find('.slidefirePro-products-grid');
                        const newProducts = $(response.data.html);
                        
                        // Animate new products in
                        newProducts.css('opacity', '0').appendTo(grid);
                        newProducts.animate({ opacity: 1 }, 300);
                        
                        // Update page number
                        button.data('page', nextPage);
                        
                        // Hide button if no more products
                        if (!response.data.has_more) {
                            button.hide();
                        }
                    } else {
                        this.showNotification('No more products to load', 'info');
                        button.hide();
                    }
                },
                error: () => {
                    this.showNotification('Error loading more products', 'error');
                },
                complete: () => {
                    button.removeClass('loading').prop('disabled', false).text(originalText);
                }
            });
        }

        handleProductClick(e) {
            // Don't navigate if clicking on buttons or overlay
            if ($(e.target).closest('.quick-add-button, .wishlist-button, .product-overlay').length) {
                return;
            }
            
            const card = $(e.currentTarget);
            const productLink = card.find('.product-title a, .product-link').first().attr('href');
            
            if (productLink) {
                window.location.href = productLink;
            }
        }

        handleCategoryFilter(e, data) {
            // Determine the target products wrapper from provided selector
            let targetSelector = data && data.targetWidget ? data.targetWidget : null;
            let targetWrapper = null;
            if (targetSelector) {
                const $target = $(targetSelector);
                if ($target.length) {
                    // Find wrapper inside the target widget
                    const inner = $target.find('.slidefirePro-products-wrapper');
                    if (inner.length) targetWrapper = inner.first();
                }
            }

            // Normalize categories (support multiple)
            let category = '';
            if (data) {
                if (Array.isArray(data.categorySlugs)) {
                    category = data.categorySlugs;
                } else if (data.categorySlug) {
                    // Allow comma-separated string
                    if (typeof data.categorySlug === 'string' && data.categorySlug.includes(',')) {
                        category = data.categorySlug.split(',').map(s => s.trim()).filter(Boolean);
                    } else {
                        category = data.categorySlug;
                    }
                }
            }

            const payload = {
                category
            };

            if (targetWrapper && targetWrapper.length) {
                payload.widget_id = targetWrapper.data('widget-id');
            }

            this.filterProducts(payload);
        }

        handleProductFilter(e, data) {
            // Normalize payload for filterProducts (expects widget_id snake_case)
            const payload = { ...data };
            if (data && data.widgetId && !data.widget_id) {
                payload.widget_id = data.widgetId;
            }
            this.filterProducts(payload);
        }

        handleProductsUpdated(e, data) {
            console.log('Products updated:', data);
            // Refresh any dependent UI elements if needed
            this.refreshProductCount(data.productsCount);
        }

        refreshProductCount(count) {
            // Update any product count displays if they exist
            const countElement = $('.slidefirePro-products-count');
            if (countElement.length && typeof count === 'number') {
                countElement.text(count + (count === 1 ? ' product' : ' products'));
            }
        }

        filterProducts(filters) {
            // Resolve target wrapper more precisely
            let wrapper = null;
            // Prefer explicit selector if provided
            if (filters && filters.targetSelector) {
                const $t = $(filters.targetSelector);
                const inner = $t.find('.slidefirePro-products-wrapper');
                if (inner.length) wrapper = inner.first();
            }
            // Then try by widget id
            if (!wrapper) {
                const wid = (filters && (filters.widget_id || filters.widgetId)) ? (filters.widget_id || filters.widgetId) : null;
                if (wid) {
                    const byId = $(`.slidefirePro-products-wrapper[data-widget-id="${wid}"]`);
                    if (byId.length) wrapper = byId.first();
                }
            }
            // Fallback to first wrapper on page
            if (!wrapper) {
                const all = $('.slidefirePro-products-wrapper');
                if (!all.length) return;
                wrapper = all.first();
            }

            const widgetId = wrapper.data('widget-id');
            const settings = wrapper.data('settings');

            // Add loading state on wrapper only (avoid grid fade-out to prevent double blink)
            wrapper.addClass('loading');

            // Reset load more button
            const loadMoreButton = wrapper.find('.load-more-button');
            loadMoreButton.data('page', 1).show();

            $.ajax({
                url: slideFireProAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefirePro_filter_products',
                    widget_id: widgetId,
                    settings: settings,
                    filters: filters,
                    nonce: slideFireProAjax.nonce
                },
                success: (response) => {
                    const grid = wrapper.find('.slidefirePro-products-grid');
                    if (response.success && response.data.html) {
                        // Replace products grid content without fade-out to avoid double blink
                        grid.html(response.data.html);

                        // Update load more button state
                        if (response.data.has_more) {
                            loadMoreButton.show();
                        } else {
                            loadMoreButton.hide();
                        }

                        // Scroll to products if not already visible
                        this.scrollToProducts(wrapper);

                    } else if (response.success && response.data.html === '') {
                        // No products found - using grid structure
                        grid.html('<div class="no-products-message"><p>No products found matching your criteria.</p></div>');
                        loadMoreButton.hide();
                    } else {
                        this.showNotification('Error filtering products', 'error');
                    }
                },
                error: () => {
                    this.showNotification('Error filtering products', 'error');
                },
                complete: () => {
                    wrapper.removeClass('loading');
                }
            });
        }

        getCurrentFilters() {
            const filters = {};
            
            // Get category filter from category widget
            const activeCategoryButton = $('.category-filter-card.active, .category-filter-card[aria-pressed="true"]');
            if (activeCategoryButton.length) {
                const raw = (activeCategoryButton.attr('data-categories') || activeCategoryButton.data('category') || '').toString();
                if (raw.includes(',')) {
                    filters.category = raw.split(',').map(s => s.trim()).filter(Boolean);
                } else {
                    filters.category = raw || '';
                }
            }
            
            // Get filters from product filter widget
            const searchInput = $('.wc-filter-search-input');
            if (searchInput.length && searchInput.val()) {
                filters.search = searchInput.val();
            }
            
            const categorySelect = $('.wc-filter-dropdown[data-filter-type="category"]');
            if (categorySelect.length && categorySelect.val()) {
                filters.category = categorySelect.val();
            }
            
            const sortSelect = $('.wc-filter-dropdown[data-filter-type="sort"]');
            if (sortSelect.length && sortSelect.val()) {
                filters.orderby = sortSelect.val();
            }
            
            return filters;
        }

        scrollToProducts(wrapper) {
            const offset = wrapper.offset();
            if (offset && $(window).scrollTop() > offset.top) {
                $('html, body').animate({
                    scrollTop: offset.top - 100
                }, 500);
            }
        }

        showNotification(message, type = 'info') {
            // Create notification element
            const notification = $(`
                <div class="slidefire-notification slidefire-notification-${type}" style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${type === 'success' ? '#059669' : type === 'error' ? '#DC2626' : '#3B82F6'};
                    color: white;
                    padding: 12px 20px;
                    border-radius: 8px;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                    z-index: 10000;
                    max-width: 300px;
                    font-size: 14px;
                    opacity: 0;
                    transform: translateX(100%);
                    transition: all 0.3s ease;
                ">
                    ${message}
                </div>
            `);
            
            // Add to page
            $('body').append(notification);
            
            // Animate in
            setTimeout(() => {
                notification.css({
                    opacity: 1,
                    transform: 'translateX(0)'
                });
            }, 10);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.css({
                    opacity: 0,
                    transform: 'translateX(100%)'
                });
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    }

    // Initialize when document is ready
    $(document).ready(function() {
        new SlideFireProProductsWidget();
    });

    // Also initialize on Elementor frontend
    $(window).on('elementor/frontend/init', function() {
        new SlideFireProProductsWidget();
    });

})(jQuery);
