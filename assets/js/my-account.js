/**
 * SlideFirePro My Account Widget JavaScript
 * Based on the MyAccount.tsx component functionality
 */

(function($) {
    'use strict';

    class MyAccountWidget {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
            this.initTabs();
            this.initFormValidation();
        }

        bindEvents() {
            $(document).ready(() => {
                this.setupTabNavigation();
                this.setupNotifications();
            });
        }

        setupTabNavigation() {
            $('.my-account-tabs .tab-trigger').on('click', (e) => {
                const $target = $(e.currentTarget);
                const href = $target.attr('href') || '';
                const targetTab = $target.data('tab');

                // Only intercept in-page tab switches (anchors starting with #).
                if (href.startsWith('#')) {
                    e.preventDefault();
                    this.switchTab(targetTab);
                }
            });

            // Handle URL hash for direct tab access
            if (window.location.hash) {
                const hashTab = window.location.hash.substring(1);
                if ($(`[data-tab="${hashTab}"]`).length) {
                    this.switchTab(hashTab);
                }
            }
        }

        switchTab(targetTab) {
            // Update tab triggers
            $('.my-account-tabs .tab-trigger').removeClass('active');
            $(`.my-account-tabs .tab-trigger[data-tab="${targetTab}"]`).addClass('active');

            // Update tab content
            $('.tab-content').removeClass('active').hide();
            $(`#tab-${targetTab}`).addClass('active').show();

            // Update URL hash
            history.pushState(null, null, `#${targetTab}`);

            // Trigger custom event for analytics or other integrations
            $(document).trigger('myaccount:tab-changed', [targetTab]);
        }

        initTabs() {
            // Initialize with first visible tab
            const firstTab = $('.my-account-tabs .tab-trigger:first').data('tab');
            if (firstTab && !$('.tab-content.active').length) {
                this.switchTab(firstTab);
            }

            // Add smooth animations
            $('.tab-content').css({
                'opacity': '0',
                'transform': 'translateY(20px)',
                'transition': 'all 0.3s ease'
            });

            $('.tab-content.active').css({
                'opacity': '1',
                'transform': 'translateY(0)',
                'display': 'block'
            });
        }

        // Removed manual input disable/enable to allow WooCommerce forms to work as expected

        setupNotifications() {
            // Handle notification preference toggles
            $('.notification-item').on('click', (e) => {
                const $item = $(e.currentTarget);
                const $badge = $item.find('span');
                
                if ($badge.hasClass('bg-green-500')) {
                    $badge.removeClass('bg-green-500').addClass('bg-secondary')
                           .removeClass('text-white').addClass('text-secondary-foreground')
                           .text('Disabled');
                } else {
                    $badge.removeClass('bg-secondary').addClass('bg-green-500')
                           .removeClass('text-secondary-foreground').addClass('text-white')
                           .text('Enabled');
                }

                // Trigger notification change event
                const notificationType = $item.find('.font-medium').text();
                $(document).trigger('myaccount:notification-changed', [notificationType, $badge.text()]);
            });
        }

        initFormValidation() {
            // Enhanced form validation
            $('.my-account-wrapper form').on('submit', (e) => {
                const $form = $(e.currentTarget);
                const isValid = this.validateForm($form);
                
                if (!isValid) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading state
                this.showLoadingState($form);
            });

            // Real-time validation
            $('.my-account-wrapper input[type="email"]').on('blur', (e) => {
                this.validateEmail($(e.currentTarget));
            });

            $('.my-account-wrapper input[required]').on('blur', (e) => {
                this.validateRequired($(e.currentTarget));
            });
        }

        validateForm($form) {
            let isValid = true;
            const $inputs = $form.find('input[required], select[required], textarea[required]');

            $inputs.each((index, input) => {
                const $input = $(input);
                if (!this.validateRequired($input)) {
                    isValid = false;
                }
            });

            // Validate email fields
            const $emailInputs = $form.find('input[type="email"]');
            $emailInputs.each((index, input) => {
                const $input = $(input);
                if (!this.validateEmail($input)) {
                    isValid = false;
                }
            });

            return isValid;
        }

        validateRequired($input) {
            const value = $input.val().trim();
            const isValid = value.length > 0;

            this.toggleFieldError($input, !isValid, 'This field is required');
            return isValid;
        }

        validateEmail($input) {
            const value = $input.val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = !value || emailRegex.test(value);

            this.toggleFieldError($input, !isValid, 'Please enter a valid email address');
            return isValid;
        }

        toggleFieldError($input, hasError, message) {
            const $wrapper = $input.closest('.form-row, .field-wrapper');
            const $error = $wrapper.find('.field-error');

            if (hasError) {
                $input.addClass('error');
                if (!$error.length) {
                    $wrapper.append(`<div class="field-error text-red-500 text-sm mt-1">${message}</div>`);
                } else {
                    $error.text(message);
                }
            } else {
                $input.removeClass('error');
                $error.remove();
            }
        }

        showLoadingState($form) {
            const $submitBtn = $form.find('[type="submit"]');
            const originalText = $submitBtn.text();
            
            $submitBtn.prop('disabled', true).html(`
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            `);

            // Reset after 3 seconds (or on actual form response)
            setTimeout(() => {
                $submitBtn.prop('disabled', false).text(originalText);
            }, 3000);
        }

        // Utility methods
        showNotification(message, type = 'success') {
            const notificationHtml = `
                <div class="my-account-notification ${type} fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            ${type === 'success' ? 
                                '<svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' :
                                '<svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                            }
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">${message}</p>
                        </div>
                    </div>
                </div>
            `;

            $('body').append(notificationHtml);
            const $notification = $('.my-account-notification').last();
            
            // Slide in
            setTimeout(() => {
                $notification.removeClass('translate-x-full');
            }, 100);

            // Auto remove
            setTimeout(() => {
                $notification.addClass('translate-x-full');
                setTimeout(() => {
                    $notification.remove();
                }, 300);
            }, 3000);
        }

        // Animation utilities
        fadeIn($element, duration = 300) {
            $element.css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            }).animate({
                'opacity': '1'
            }, duration, () => {
                $element.css('transform', 'translateY(0)');
            });
        }

        slideDown($element, duration = 300) {
            $element.slideDown(duration);
        }

        // Mobile responsive handling
        handleMobileMenu() {
            if ($(window).width() < 768) {
                $('.my-account-tabs').addClass('mobile-tabs');
                // Convert to dropdown or accordion on mobile
                this.convertTabsToMobile();
            }
        }

        convertTabsToMobile() {
            // Implementation for mobile tab conversion
            // This could be a dropdown or accordion style
        }
    }

    // Initialize on document ready
    $(document).ready(() => {
        new MyAccountWidget();
    });

    // Handle window resize for responsive behavior
    $(window).on('resize', debounce(() => {
        // Re-initialize responsive elements
        if (window.myAccountWidget) {
            window.myAccountWidget.handleMobileMenu();
        }
    }, 250));

    // Utility function for debouncing
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

})(jQuery);
