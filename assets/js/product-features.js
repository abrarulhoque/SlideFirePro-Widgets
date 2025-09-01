jQuery(document).ready(function($) {
    'use strict';

    class ProductFeaturesWidget {
        constructor() {
            this.init();
        }

        init() {
            // Initialize tabs functionality
            this.initTabs();
            
            // Handle dynamic content loading in Elementor editor
            if (typeof elementor !== 'undefined') {
                elementor.hooks.addAction('panel/open_editor/widget/slidefire-product-features', this.onElementorEdit.bind(this));
            }
        }

        initTabs() {
            $('.slidefire-product-features').each((index, element) => {
                this.setupTabsForWidget($(element));
            });
        }

        setupTabsForWidget($widget) {
            const $tabsTriggers = $widget.find('.tabs-trigger');
            const $tabsContent = $widget.find('.tabs-content');

            if ($tabsTriggers.length === 0 || $tabsContent.length === 0) {
                return;
            }

            // Tab click handler
            $tabsTriggers.on('click', (e) => {
                e.preventDefault();
                const $trigger = $(e.currentTarget);
                const targetTab = $trigger.data('tab');
                
                // Don't proceed if this tab is already active
                if ($trigger.hasClass('active')) {
                    return;
                }

                this.switchTab($widget, targetTab);
            });

            // Keyboard navigation
            $tabsTriggers.on('keydown', (e) => {
                const $trigger = $(e.currentTarget);
                const $triggers = $widget.find('.tabs-trigger');
                const currentIndex = $triggers.index($trigger);
                
                let newIndex = currentIndex;
                
                switch (e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        newIndex = currentIndex > 0 ? currentIndex - 1 : $triggers.length - 1;
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        newIndex = currentIndex < $triggers.length - 1 ? currentIndex + 1 : 0;
                        break;
                    case 'Home':
                        e.preventDefault();
                        newIndex = 0;
                        break;
                    case 'End':
                        e.preventDefault();
                        newIndex = $triggers.length - 1;
                        break;
                    default:
                        return;
                }
                
                const $newTrigger = $triggers.eq(newIndex);
                const targetTab = $newTrigger.data('tab');
                
                $newTrigger.focus();
                this.switchTab($widget, targetTab);
            });
        }

        switchTab($widget, targetTab) {
            const $triggers = $widget.find('.tabs-trigger');
            const $contents = $widget.find('.tabs-content');
            
            // Update triggers
            $triggers.removeClass('active').attr('aria-selected', 'false');
            $triggers.filter(`[data-tab="${targetTab}"]`).addClass('active').attr('aria-selected', 'true');
            
            // Update content
            $contents.removeClass('active').attr('aria-hidden', 'true');
            $contents.filter(`[data-tab-content="${targetTab}"]`).addClass('active').attr('aria-hidden', 'false');
            
            // Trigger custom event for other scripts to listen to
            $widget.trigger('slidefire:tab-changed', [targetTab]);
        }

        onElementorEdit(panel, model, view) {
            // Re-initialize tabs when widget is edited in Elementor
            setTimeout(() => {
                this.init();
            }, 100);
        }
    }

    // Initialize the widget
    const productFeaturesWidget = new ProductFeaturesWidget();

    // Re-initialize when Elementor frontend is loaded (for preview)
    $(window).on('elementor/frontend/init', function() {
        // Wait a bit for Elementor to finish rendering
        setTimeout(() => {
            productFeaturesWidget.init();
        }, 500);
    });

    // Handle AJAX page loads and dynamic content
    $(document).ajaxComplete(function() {
        setTimeout(() => {
            productFeaturesWidget.init();
        }, 100);
    });
});