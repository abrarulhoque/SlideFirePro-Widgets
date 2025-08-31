/**
 * WooCommerce Product Filter Widget JavaScript
 * Handles filter interactions and AJAX requests for product filtering
 */

(function($) {
    'use strict';

    class WCProductFilter {
        constructor(element) {
            this.element = $(element);
            this.widgetId = this.element.data('widget-id');
            this.searchInput = this.element.find('.wc-filter-search-input');
            this.categorySelect = this.element.find('[data-filter-type="category"]');
            this.sortSelect = this.element.find('[data-filter-type="sort"]');
            this.viewButtons = this.element.find('.wc-filter-view-button');
            this.container = this.element.find('.wc-filter-container');
            
            // Filter state
            this.filters = {
                search: '',
                category: '',
                sort: '',
                view: this.getDefaultView()
            };
            
            // Debounce timer for search
            this.searchTimer = null;
            this.searchDelay = 300;

            this.init();
        }

        init() {
            this.bindEvents();
            this.setupInitialState();
        }

        bindEvents() {
            // Search input with debouncing
            this.searchInput.on('input', (e) => {
                clearTimeout(this.searchTimer);
                this.searchTimer = setTimeout(() => {
                    this.handleSearchChange(e);
                }, this.searchDelay);
            });

            // Clear search on Escape key
            this.searchInput.on('keydown', (e) => {
                if (e.key === 'Escape') {
                    this.clearSearch();
                }
            });

            // Category filter change
            this.categorySelect.on('change', (e) => {
                this.handleCategoryChange(e);
            });

            // Sort filter change
            this.sortSelect.on('change', (e) => {
                this.handleSortChange(e);
            });

            // View toggle buttons
            this.viewButtons.on('click', (e) => {
                this.handleViewChange(e);
            });

            // Handle keyboard navigation for view buttons
            this.viewButtons.on('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.handleViewChange(e);
                }
            });
        }

        setupInitialState() {
            // Set initial view button state
            const defaultView = this.getDefaultView();
            this.setActiveView(defaultView);
            
            // Trigger initial filter event to notify other widgets
            this.triggerFilterEvent();
        }

        getDefaultView() {
            const activeButton = this.viewButtons.filter('.active');
            return activeButton.length ? activeButton.data('view') : 'grid';
        }

        handleSearchChange(e) {
            const searchTerm = $(e.target).val().trim();
            this.filters.search = searchTerm;
            
            // Add visual feedback
            this.addLoadingState();
            
            // Debounce and trigger filter
            this.triggerFilterEvent();
        }

        clearSearch() {
            this.searchInput.val('');
            this.filters.search = '';
            this.triggerFilterEvent();
            this.searchInput.focus();
        }

        handleCategoryChange(e) {
            const category = $(e.target).val();
            this.filters.category = category;
            
            this.addLoadingState();
            this.triggerFilterEvent();
        }

        handleSortChange(e) {
            const sortBy = $(e.target).val();
            this.filters.sort = sortBy;
            
            this.addLoadingState();
            this.triggerFilterEvent();
        }

        handleViewChange(e) {
            e.preventDefault();
            
            const button = $(e.currentTarget);
            const view = button.data('view');
            
            if (!button.hasClass('active')) {
                this.setActiveView(view);
                this.filters.view = view;
                this.triggerFilterEvent();
            }
        }

        setActiveView(view) {
            this.viewButtons.removeClass('active');
            this.viewButtons.filter(`[data-view="${view}"]`).addClass('active');
        }

        addLoadingState() {
            this.container.addClass('loading');
            
            // Remove loading state after a short delay if no other loading is happening
            setTimeout(() => {
                this.container.removeClass('loading');
            }, 1000);
        }

        triggerFilterEvent() {
            // Custom event that other widgets can listen to
            const filterEvent = new CustomEvent('wcProductFilter', {
                detail: {
                    widgetId: this.widgetId,
                    filters: { ...this.filters },
                    timestamp: Date.now()
                }
            });
            
            document.dispatchEvent(filterEvent);
            
            // Also trigger jQuery event for compatibility
            $(document).trigger('slideFirePro:productFilter', [{
                widgetId: this.widgetId,
                filters: { ...this.filters }
            }]);
        }

        // Method to programmatically set filters (for external control)
        setFilters(newFilters) {
            if (newFilters.search !== undefined) {
                this.filters.search = newFilters.search;
                this.searchInput.val(newFilters.search);
            }
            
            if (newFilters.category !== undefined) {
                this.filters.category = newFilters.category;
                this.categorySelect.val(newFilters.category);
            }
            
            if (newFilters.sort !== undefined) {
                this.filters.sort = newFilters.sort;
                this.sortSelect.val(newFilters.sort);
            }
            
            if (newFilters.view !== undefined) {
                this.filters.view = newFilters.view;
                this.setActiveView(newFilters.view);
            }
            
            this.triggerFilterEvent();
        }

        // Method to get current filters
        getFilters() {
            return { ...this.filters };
        }

        // Method to reset all filters
        resetFilters() {
            this.filters = {
                search: '',
                category: '',
                sort: '',
                view: this.getDefaultView()
            };
            
            this.searchInput.val('');
            this.categorySelect.val('');
            this.sortSelect.val('');
            this.setActiveView(this.filters.view);
            
            this.triggerFilterEvent();
        }
    }

    // Initialize when DOM is ready
    $(document).ready(function() {
        // Initialize all product filter widgets on the page
        $('.wc-product-filter-wrapper').each(function() {
            const filterWidget = new WCProductFilter(this);
            
            // Store instance on element for external access
            $(this).data('wcProductFilter', filterWidget);
        });
    });

    // Initialize for Elementor editor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/slidefirePro-wc-product-filter.default', function($scope) {
            const filterElement = $scope.find('.wc-product-filter-wrapper');
            if (filterElement.length) {
                const filterWidget = new WCProductFilter(filterElement[0]);
                filterElement.data('wcProductFilter', filterWidget);
            }
        });
    });

    // Expose the class globally for external use
    window.WCProductFilter = WCProductFilter;

    // Helper function to get filter instance
    window.getWCProductFilter = function(widgetId) {
        const element = $(`.wc-product-filter-wrapper[data-widget-id="${widgetId}"]`);
        return element.length ? element.data('wcProductFilter') : null;
    };

})(jQuery);