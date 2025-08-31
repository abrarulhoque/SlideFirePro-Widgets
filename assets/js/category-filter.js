/**
 * SlideFirePro Category Filter Widget JavaScript
 * Handles active state management and AJAX product filtering
 */

(function($) {
    'use strict';

    class SlideFireProCategoryFilter {
        constructor(element) {
            this.element = element;
            this.widgetId = element.data('widget-id');
            this.cards = element.find('[data-slot="card"]');
            this.isLoading = false;
            
            this.init();
        }

        init() {
            this.bindEvents();
            this.setInitialActiveState();
        }

        bindEvents() {
            // Handle card clicks
            this.cards.on('click', (e) => {
                this.handleCardClick($(e.currentTarget));
            });

            // Handle keyboard navigation
            this.cards.on('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.handleCardClick($(e.currentTarget));
                }
            });

            // Handle arrow key navigation
            this.element.on('keydown', (e) => {
                this.handleArrowNavigation(e);
            });
        }

        setInitialActiveState() {
            // First card should be active by default
            const firstCard = this.cards.first();
            if (firstCard.length) {
                this.setCardActive(firstCard);
            }
        }

        setCardActive(card) {
            // Remove active classes from all cards
            this.cards.each((index, element) => {
                const $card = $(element);
                $card.removeClass('border-primary ring-2 ring-primary/20 active');
                $card.addClass('border-border');
            });

            // Add active classes to selected card
            card.removeClass('border-border');
            card.addClass('border-primary ring-2 ring-primary/20 active');
            card.attr('aria-pressed', 'true');
        }

        handleCardClick(clickedCard) {
            if (this.isLoading) {
                return;
            }

            // Set active state
            this.setCardActive(clickedCard);

            // Get category slug
            const categorySlug = clickedCard.data('category') || '';
            const categoryTitle = clickedCard.find('h3').text();
            const targetWidget = this.element.data('target-widget');

            // Trigger custom event for product filtering - grid listens and will update
            $(document).trigger('slideFirePro:categoryChanged', {
                categorySlug: categorySlug,
                categoryTitle: categoryTitle,
                widgetId: this.widgetId,
                targetWidget: targetWidget,
                clickedCard: clickedCard
            });

            // If no target widget or no products grid present, fallback to direct update
            if (targetWidget) {
                const $targetElement = $(targetWidget);
                const hasGrid = $targetElement.find('.slidefirePro-products-wrapper').length > 0;
                if (!hasGrid) {
                    this.updateTargetProductsWidget(targetWidget, categorySlug);
                }
            }

            // Announce to screen readers
            this.announceToScreenReader(`Filtered by ${categoryTitle}`);
        }

        sendFilterRequest(categorySlug) {
            if (typeof slideFireProAjax === 'undefined') {
                console.warn('SlideFirePro AJAX not available');
                return;
            }

            this.setLoadingState(true);

            $.ajax({
                url: slideFireProAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefirePro_filter_products',
                    category_slug: categorySlug,
                    widget_id: this.widgetId,
                    nonce: slideFireProAjax.nonce
                },
                success: (response) => {
                    // This path is kept for backward compatibility; grid updates via categoryChanged
                    if (!response.success) {
                        console.error('Filter request failed:', response.data);
                    }
                },
                error: (xhr, status, error) => {
                    console.error('AJAX request failed:', error);
                },
                complete: () => {
                    this.setLoadingState(false);
                }
            });
        }

        setLoadingState(loading) {
            this.isLoading = loading;
            this.element.toggleClass('loading', loading);
            
            if (loading) {
                this.cards.attr('aria-busy', 'true');
            } else {
                this.cards.removeAttr('aria-busy');
            }
        }

        handleArrowNavigation(e) {
            const focusedCard = this.cards.filter(':focus');
            if (!focusedCard.length) return;

            let targetCard;
            const currentIndex = this.cards.index(focusedCard);

            switch(e.key) {
                case 'ArrowLeft':
                    e.preventDefault();
                    targetCard = this.cards.eq(currentIndex - 1);
                    if (!targetCard.length) {
                        targetCard = this.cards.last();
                    }
                    targetCard.focus();
                    break;
                    
                case 'ArrowRight':
                    e.preventDefault();
                    targetCard = this.cards.eq(currentIndex + 1);
                    if (!targetCard.length) {
                        targetCard = this.cards.first();
                    }
                    targetCard.focus();
                    break;
                    
                case 'Home':
                    e.preventDefault();
                    this.cards.first().focus();
                    break;
                    
                case 'End':
                    e.preventDefault();
                    this.cards.last().focus();
                    break;
            }
        }

        announceToScreenReader(message) {
            // Create a temporary element to announce changes
            const announcement = $('<div>')
                .attr('aria-live', 'polite')
                .attr('aria-atomic', 'true')
                .addClass('sr-only')
                .css({
                    position: 'absolute',
                    left: '-10000px',
                    width: '1px',
                    height: '1px',
                    overflow: 'hidden'
                })
                .text(message);

            $('body').append(announcement);
            
            setTimeout(() => {
                announcement.remove();
            }, 1000);
        }

        // Public method to programmatically set active category
        setActiveCategory(categorySlug) {
            const targetCard = this.cards.filter(`[data-category="${categorySlug}"]`);
            if (targetCard.length) {
                this.handleCardClick(targetCard);
            }
        }

        // Public method to get current active category
        getActiveCategory() {
            const activeCard = this.cards.filter('.active');
            return activeCard.length ? activeCard.data('category') : null;
        }

        // Update target products widget - following Elementor Pro pattern
        updateTargetProductsWidget(targetWidget, categorySlug) {
            if (!targetWidget) return;

            const $targetElement = $(targetWidget);
            if (!$targetElement.length) {
                console.warn('Target products widget not found:', targetWidget);
                return;
            }

            // Find the products grid within the target widget
            const $productsGrid = $targetElement.find('.slidefirePro-products-grid');
            if (!$productsGrid.length) {
                console.warn('Products grid not found in target widget');
                return;
            }

            // Add loading state
            $targetElement.addClass('filtering-products');
            $productsGrid.css('opacity', '0.5');

            // Make AJAX request to get filtered products
            $.ajax({
                url: slideFireProAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'slidefirePro_filter_products_by_category',
                    category_slug: categorySlug,
                    target_widget: targetWidget,
                    nonce: slideFireProAjax.nonce
                },
                success: (response) => {
                    if (response.success && response.data.html) {
                        // Update products grid with new content
                        $productsGrid.html(response.data.html);
                        
                        // Trigger refresh event for any dependent widgets
                        $(document).trigger('slideFirePro:productsUpdated', {
                            categorySlug: categorySlug,
                            targetWidget: targetWidget,
                            productsCount: response.data.count || 0
                        });
                    } else {
                        console.error('Failed to filter products:', response.data);
                        $productsGrid.html('<div class="no-products-message"><p>No products found for this category.</p></div>');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('AJAX request failed:', error);
                    $productsGrid.html('<div class="no-products-message"><p>Error loading products. Please try again.</p></div>');
                },
                complete: () => {
                    $targetElement.removeClass('filtering-products');
                    $productsGrid.css('opacity', '1');
                }
            });
        }
    }

    // Initialize widget on DOM ready and Elementor frontend init
    function initCategoryFilters() {
        $('[data-widget-id]').each(function() {
            const $this = $(this);
            
            // Avoid double initialization
            if ($this.data('slideFirePro-initialized')) {
                return;
            }
            
            // Only initialize if it contains category cards
            if ($this.find('[data-slot="card"]').length > 0) {
                const filterInstance = new SlideFireProCategoryFilter($this);
                $this.data('slideFirePro-initialized', true);
                $this.data('slideFirePro-instance', filterInstance);
            }
        });
    }

    // Initialize on DOM ready
    $(document).ready(function() {
        initCategoryFilters();
    });

    // Initialize on Elementor frontend
    $(window).on('elementor/frontend/init', function() {
        // For Elementor editor and frontend
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.hooks.addAction('frontend/element_ready/slidefirePro-category-filter.default', function($scope) {
                const filterWidget = $scope.find('.slidefirePro-category-filter');
                if (filterWidget.length && !filterWidget.data('slideFirePro-initialized')) {
                    const filterInstance = new SlideFireProCategoryFilter(filterWidget);
                    filterWidget.data('slideFirePro-initialized', true);
                    filterWidget.data('slideFirePro-instance', filterInstance);
                }
            });
        }
    });

    // Re-initialize after AJAX content loads
    $(document).ajaxComplete(function() {
        initCategoryFilters();
    });

    // Global access for debugging and external integration
    window.SlideFireProCategoryFilter = SlideFireProCategoryFilter;

})(jQuery);
