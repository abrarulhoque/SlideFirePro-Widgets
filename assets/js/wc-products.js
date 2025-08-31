/**
 * WooCommerce Products Widget JavaScript
 * Handles AJAX filtering, load more, and product interactions
 */

(function($) {
    'use strict';

    class SlideFireProProductsWidget {
        constructor() {
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
            // Listen for category filter changes
            $(document).on('slideFireProCategoryChanged', this.handleCategoryFilter.bind(this));
            
            // Listen for product filter changes (search, sort, etc.)
            $(document).on('slideFireProProductFilterChanged', this.handleProductFilter.bind(this));
        }

        handleQuickAdd(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const button = $(e.currentTarget);
            const productId = button.data('product-id');
            
            if (!productId) {
                console.error('Product ID not found');
                return;
            }

            // Add loading state
            button.addClass('loading').prop('disabled', true);
            const originalText = button.html();
            button.html('<svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Adding...');

            // AJAX call to add product to cart
            $.ajax({
                url: slideFireProAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefirePro_add_to_cart',
                    product_id: productId,
                    nonce: slideFireProAjax.nonce
                },
                success: (response) => {
                    if (response.success) {
                        // Show success message
                        this.showNotification('Product added to cart!', 'success');
                        
                        // Trigger WooCommerce cart update event
                        $(document.body).trigger('added_to_cart', [response.data.fragments, response.data.cart_hash, button]);
                        
                        // Update button text temporarily
                        button.html('✓ Added!');
                        setTimeout(() => {
                            button.html(originalText);
                        }, 2000);
                    } else {
                        this.showNotification(response.data.message || 'Failed to add product to cart', 'error');
                        button.html(originalText);
                    }
                },
                error: () => {
                    this.showNotification('Error adding product to cart', 'error');
                    button.html(originalText);
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
            
            // Toggle wishlist state
            button.toggleClass('active');
            
            if (button.hasClass('active')) {
                button.find('svg').addClass('fill-current');
                this.showNotification('Added to wishlist!', 'success');
            } else {
                button.find('svg').removeClass('fill-current');
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
            // Don't navigate if clicking on buttons
            if ($(e.target).closest('.quick-add-button, .wishlist-button').length) {
                return;
            }
            
            const card = $(e.currentTarget);
            const productLink = card.find('.product-title a').attr('href');
            
            if (productLink) {
                window.location.href = productLink;
            }
        }

        handleCategoryFilter(e, data) {
            this.filterProducts({
                category: data.category,
                widget_id: data.widget_id
            });
        }

        handleProductFilter(e, data) {
            this.filterProducts(data);
        }

        filterProducts(filters) {
            const wrapper = $('.slidefirePro-products-wrapper');
            if (!wrapper.length) return;
            
            const widgetId = filters.widget_id || wrapper.data('widget-id');
            const settings = wrapper.data('settings');
            
            // Add loading state
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
                    if (response.success && response.data.html) {
                        // Replace products grid content
                        const grid = wrapper.find('.slidefirePro-products-grid');
                        grid.fadeOut(200, function() {
                            grid.html(response.data.html).fadeIn(300);
                        });
                        
                        // Update load more button state
                        if (response.data.has_more) {
                            loadMoreButton.show();
                        } else {
                            loadMoreButton.hide();
                        }
                        
                        // Scroll to products if not already visible
                        this.scrollToProducts(wrapper);
                        
                    } else if (response.success && response.data.html === '') {
                        // No products found
                        const grid = wrapper.find('.slidefirePro-products-grid');
                        grid.html('<div class="col-span-full text-center py-12"><p class="text-muted-foreground text-lg">No products found matching your criteria.</p></div>');
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
                filters.category = activeCategoryButton.data('category') || '';
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