document.addEventListener('DOMContentLoaded', function() {

    function init() {
        window.initSiteHeaderById = initSiteHeaderById;
        window.dispatchEvent(new CustomEvent('siteHeaderReadyToInit'));

        /*
        new Swiper('.logos-slider', {
            slidesPerView: 6,
            speed: 500,
            loop: true,
            grabCursor: true,
            breakpoints: {
                767:
            }
        });
         */
    }

    function initSiteHeaderById(widgetId) {
        const headerWidgets = document.querySelectorAll('.site-header-wrap .elementor-widget');
        if (headerWidgets) {
            const siteHeader = headerWidgets[0].querySelector(`[data-id="${widgetId}"] .wgp-site-header`);
            if (siteHeader) {
                const headerExpanded = siteHeader.querySelector('.wgp-site-header-expanded'),
                    headerCollapsed = siteHeader.querySelector('.wgp-site-header-collapsed'),
                    dropdownSelector = '.wgp-site-header-dropdown',
                    headerDropdown = siteHeader.querySelector(dropdownSelector),
                    btnCloseDropdown = headerDropdown.querySelector('.btn-close-dropdown'),
                    desktopMinWidth = 1240;
                let headerHeight = headerExpanded.offsetHeight,
                    isLastWidthDesktop = window.innerWidth >= desktopMinWidth,
                    currScrollTop;

                function initSiteHeader() {
                    animateSiteHeader();
                    bindSiteHeaderEvents();
                }

                function bindSiteHeaderEvents() {
                    window.addEventListener('scroll', animateSiteHeader);
                    window.addEventListener('resize', function () {
                        if (isLastWidthDesktop !== window.innerWidth >= desktopMinWidth) {
                            headerHeight = headerExpanded.offsetHeight;
                            isLastWidthDesktop = window.innerWidth >= desktopMinWidth;
                            animateSiteHeader();
                        }
                    });
                    siteHeader.addEventListener('click', function (e) {
                        const clickedMenuBtn = e.target.closest('.btn-menu-icon');
                        if (clickedMenuBtn || e.target.matches('.btn-menu-icon')) {
                            e.preventDefault();
                            const targetRect = e.target.getBoundingClientRect();

                            headerDropdown.style.right = (window.innerWidth - targetRect.right + 10) + 'px';
                            headerDropdown.style.top = (targetRect.top + 10) + 'px';
                            headerDropdown.classList.add('show');

                            btnCloseDropdown.addEventListener('click', closeDropdown);
                            window.addEventListener('scroll', closeDropdown);
                            window.addEventListener('resize', closeDropdown);
                            document.addEventListener('mouseup', documentMouseUp);
                            document.addEventListener('pointerup', documentMouseUp);
                        }
                    });
                }

                function closeDropdown(e) {
                    if (e) e.preventDefault();
                    headerDropdown.classList.remove('show');

                    btnCloseDropdown.removeEventListener('click', closeDropdown);
                    window.removeEventListener('scroll', closeDropdown);
                    window.removeEventListener('resize', closeDropdown);
                    document.removeEventListener('mouseup', documentMouseUp);
                    document.removeEventListener('pointerup', documentMouseUp);
                }

                function documentMouseUp(e) {
                    if (!e.target.matches(dropdownSelector) && !e.target.closest(dropdownSelector) ) {
                        closeDropdown()
                    }
                }

                function animateSiteHeader() {
                    currScrollTop = window.pageYOffset;
                    if (currScrollTop >= headerHeight) headerCollapsed.classList.add('show');
                    else headerCollapsed.classList.remove('show');
                }

                initSiteHeader();
            }
        }
    }

    init();
});


// Polyfills

(function () {

    // Closest
    if (!Element.prototype.closest) {
        if (!Element.prototype.matches) {
            Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
        }
        Element.prototype.closest = function (s) {
            var el = this;
            var ancestor = this;
            if (!document.documentElement.contains(el)) return null;
            do {
                if (ancestor.matches(s)) return ancestor;
                ancestor = ancestor.parentElement;
            } while (ancestor !== null);
            return null;
        };
    }

    // CustomEvent
    if ( typeof window.CustomEvent === "function" ) return false;
    function CustomEvent ( event, params ) {
        params = params || { bubbles: false, cancelable: false, detail: undefined };
        var evt = document.createEvent( 'CustomEvent' );
        evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
        return evt;
    }
    CustomEvent.prototype = window.Event.prototype;
    window.CustomEvent = CustomEvent;
})();