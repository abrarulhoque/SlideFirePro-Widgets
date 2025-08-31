/**
 * SlideFirePro Header Navigation Widget JavaScript
 */

class SlideFireProHeaderNavigation {
    constructor(element) {
        this.element = element;
        this.init();
    }

    init() {
        this.bindEvents();
        this.initMobileMenu();
        this.initSearch();
    }

    bindEvents() {
        // Logo click handler
        const logoWrapper = this.element.querySelector('.slidefire-logo-wrapper');
        if (logoWrapper) {
            logoWrapper.addEventListener('click', () => {
                window.location.href = window.location.origin;
            });

            // Keyboard support for logo
            logoWrapper.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    window.location.href = window.location.origin;
                }
            });
        }

        // Mobile menu button
        const mobileMenuBtn = this.element.querySelector('.slidefire-mobile-menu-btn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleMobileMenu();
            });
        }

        // Mobile search button
        const mobileSearchBtn = this.element.querySelector('.slidefire-mobile-search-btn');
        if (mobileSearchBtn) {
            mobileSearchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleMobileSearch();
            });
        }

        // Search form handling
        const searchForm = this.element.querySelector('.slidefire-search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => {
                const searchInput = searchForm.querySelector('.slidefire-search-input');
                if (!searchInput.value.trim()) {
                    e.preventDefault();
                    searchInput.focus();
                }
            });
        }

        // Instagram link analytics (if needed)
        const instagramLink = this.element.querySelector('.slidefire-instagram-link');
        if (instagramLink) {
            instagramLink.addEventListener('click', () => {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'click', {
                        'event_category': 'social',
                        'event_label': 'instagram',
                        'value': 1
                    });
                }
            });
        }

        // Handle window resize for mobile menu
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (window.innerWidth >= 768) {
                    this.closeMobileMenu();
                    this.closeMobileSearch();
                }
            }, 150);
        });
    }

    initMobileMenu() {
        // Create mobile menu overlay if it doesn't exist
        if (!document.querySelector('.slidefire-mobile-menu-overlay')) {
            this.createMobileMenuOverlay();
        }
    }

    createMobileMenuOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'slidefire-mobile-menu-overlay';
        overlay.innerHTML = `
            <div class="slidefire-mobile-menu-content">
                <div class="slidefire-mobile-menu-header">
                    <button class="slidefire-mobile-menu-close" aria-label="Close menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="slidefire-mobile-menu-items">
                    ${this.getMobileMenuItems()}
                </div>
            </div>
        `;

        // Style the overlay
        Object.assign(overlay.style, {
            position: 'fixed',
            top: '0',
            left: '0',
            right: '0',
            bottom: '0',
            backgroundColor: 'rgba(0, 0, 0, 0.95)',
            backdropFilter: 'blur(12px)',
            zIndex: '9999',
            opacity: '0',
            visibility: 'hidden',
            transition: 'opacity 0.3s ease-in-out, visibility 0.3s ease-in-out',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center'
        });

        document.body.appendChild(overlay);

        // Close button event
        const closeBtn = overlay.querySelector('.slidefire-mobile-menu-close');
        closeBtn.addEventListener('click', () => this.closeMobileMenu());

        // Close on overlay click
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                this.closeMobileMenu();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && overlay.style.visibility === 'visible') {
                this.closeMobileMenu();
            }
        });
    }

    getMobileMenuItems() {
        const navMenu = this.element.querySelector('.slidefire-nav-menu .slidefire-menu-items');
        if (!navMenu) return '';

        const menuItems = navMenu.cloneNode(true);
        menuItems.className = 'slidefire-mobile-menu-list';
        
        // Style mobile menu items
        const items = menuItems.querySelectorAll('li');
        items.forEach(item => {
            item.style.cssText = `
                margin: 0;
                padding: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            `;
            
            const link = item.querySelector('a');
            if (link) {
                link.style.cssText = `
                    display: block;
                    padding: 20px 0;
                    color: #ffffff;
                    text-decoration: none;
                    font-size: 24px;
                    font-weight: 300;
                    text-align: center;
                    transition: color 0.2s ease-in-out;
                `;
                
                link.addEventListener('mouseover', () => {
                    link.style.color = '#23B2EE';
                });
                
                link.addEventListener('mouseout', () => {
                    link.style.color = '#ffffff';
                });
            }
        });

        return menuItems.outerHTML;
    }

    toggleMobileMenu() {
        const overlay = document.querySelector('.slidefire-mobile-menu-overlay');
        if (!overlay) return;

        const isVisible = overlay.style.visibility === 'visible';
        
        if (isVisible) {
            this.closeMobileMenu();
        } else {
            this.openMobileMenu();
        }
    }

    openMobileMenu() {
        const overlay = document.querySelector('.slidefire-mobile-menu-overlay');
        if (!overlay) return;

        overlay.style.visibility = 'visible';
        overlay.style.opacity = '1';
        document.body.style.overflow = 'hidden';
    }

    closeMobileMenu() {
        const overlay = document.querySelector('.slidefire-mobile-menu-overlay');
        if (!overlay) return;

        overlay.style.visibility = 'hidden';
        overlay.style.opacity = '0';
        document.body.style.overflow = '';
    }

    initSearch() {
        const searchInput = this.element.querySelector('.slidefire-search-input');
        if (!searchInput) return;

        // Add search suggestions (basic implementation)
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            if (query.length > 2) {
                // Here you could implement search suggestions
                this.handleSearchSuggestions(query);
            }
        });

        // Handle Enter key
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.target.closest('form').submit();
            }
        });
    }

    handleSearchSuggestions(query) {
        // Basic search suggestions implementation
        // This could be enhanced to show dropdown with suggestions
        console.log('Search query:', query);
    }

    toggleMobileSearch() {
        // Create mobile search overlay
        let searchOverlay = document.querySelector('.slidefire-mobile-search-overlay');
        
        if (!searchOverlay) {
            searchOverlay = document.createElement('div');
            searchOverlay.className = 'slidefire-mobile-search-overlay';
            searchOverlay.innerHTML = `
                <div class="slidefire-mobile-search-content">
                    <form role="search" method="get" action="${window.location.origin}" class="slidefire-mobile-search-form">
                        <div class="slidefire-mobile-search-wrapper">
                            <input type="search" name="s" placeholder="Search designs..." class="slidefire-mobile-search-input" autofocus>
                            <button type="submit" class="slidefire-mobile-search-submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m21 21-4.34-4.34"></path>
                                    <circle cx="11" cy="11" r="8"></circle>
                                </svg>
                            </button>
                            <button type="button" class="slidefire-mobile-search-close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            `;

            // Style the search overlay
            Object.assign(searchOverlay.style, {
                position: 'fixed',
                top: '0',
                left: '0',
                right: '0',
                bottom: '0',
                backgroundColor: 'rgba(0, 0, 0, 0.95)',
                backdropFilter: 'blur(12px)',
                zIndex: '9998',
                opacity: '0',
                visibility: 'hidden',
                transition: 'opacity 0.3s ease-in-out, visibility 0.3s ease-in-out',
                display: 'flex',
                alignItems: 'flex-start',
                justifyContent: 'center',
                paddingTop: '100px'
            });

            document.body.appendChild(searchOverlay);

            // Event handlers
            const closeBtn = searchOverlay.querySelector('.slidefire-mobile-search-close');
            closeBtn.addEventListener('click', () => this.closeMobileSearch());

            searchOverlay.addEventListener('click', (e) => {
                if (e.target === searchOverlay) {
                    this.closeMobileSearch();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && searchOverlay.style.visibility === 'visible') {
                    this.closeMobileSearch();
                }
            });
        }

        // Toggle visibility
        const isVisible = searchOverlay.style.visibility === 'visible';
        if (isVisible) {
            this.closeMobileSearch();
        } else {
            this.openMobileSearch();
        }
    }

    openMobileSearch() {
        const overlay = document.querySelector('.slidefire-mobile-search-overlay');
        if (!overlay) return;

        overlay.style.visibility = 'visible';
        overlay.style.opacity = '1';
        document.body.style.overflow = 'hidden';

        // Focus the search input
        setTimeout(() => {
            const input = overlay.querySelector('.slidefire-mobile-search-input');
            if (input) input.focus();
        }, 100);
    }

    closeMobileSearch() {
        const overlay = document.querySelector('.slidefire-mobile-search-overlay');
        if (!overlay) return;

        overlay.style.visibility = 'hidden';
        overlay.style.opacity = '0';
        document.body.style.overflow = '';
    }
}

// Initialize when DOM is ready
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/slidefirePro-header-navigation.default', ($scope) => {
        const element = $scope[0];
        new SlideFireProHeaderNavigation(element);
    });
});