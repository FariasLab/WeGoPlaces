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
            const siteHeader = headerWidgets[0].querySelector(`[data-id="${widgetId}"] .wgp-site-header > .inner-wrap`);
            if (siteHeader) {
                const headerExpanded = siteHeader.querySelector('.wgp-site-header-expanded'),
                    headerCollapsed = siteHeader.querySelector('.wgp-site-header-collapsed'),
                    desktopMinWidth = 1240;
                let headerMaxYOffset = headerExpanded.offsetHeight - headerCollapsed.offsetHeight,
                    isLastWidthDesktop = window.innerWidth >= desktopMinWidth,
                    currScrollTop, headerYOffset;

                function initSiteHeader() {
                    animateSiteHeader();
                    bindSiteHeaderEvents();
                }

                function bindSiteHeaderEvents() {
                    window.addEventListener('scroll', animateSiteHeader);
                    window.addEventListener('resize', function () {
                        if (isLastWidthDesktop !== window.innerWidth >= desktopMinWidth) {
                            headerMaxYOffset = headerExpanded.offsetHeight - headerCollapsed.offsetHeight;
                            isLastWidthDesktop = window.innerWidth >= desktopMinWidth;
                            animateSiteHeader();
                        }
                    });
                }

                function animateSiteHeader() {
                    currScrollTop = window.pageYOffset;
                    headerYOffset = currScrollTop <= headerMaxYOffset ? currScrollTop : headerMaxYOffset;
                    siteHeader.style.transform = `translateY(-${headerYOffset}px)`;
                    if (currScrollTop < headerMaxYOffset) siteHeader.classList.remove('collapsed');
                    else siteHeader.classList.add('collapsed');
                }

                initSiteHeader();
            }
        }
    }

    init();
});