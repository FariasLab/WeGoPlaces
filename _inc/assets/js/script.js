document.addEventListener('DOMContentLoaded', function() {

    function init() {
        // Site Header Init
        window.initSiteHeaderById = initSiteHeaderById;
        window.dispatchEvent(new CustomEvent('siteHeaderReadyToInit'));

        // About Team Init
        window.initAboutTeamById = initAboutTeamById;
        window.dispatchEvent(new CustomEvent('aboutTeamReadyToInit'));

        // Contact Form Init
        window.initContactFormById = initContactFormById;
        window.dispatchEvent(new CustomEvent('contactFormReadyToInit'));

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

    function initContactFormById(widgetId) {
        const contactForm = document.querySelector(`[data-id="${widgetId}"] .form-wrap`),
            formElements = contactForm.elements,
            btnSubmitText = contactForm.querySelector('.btn-submit .btn-text'),
            xhr = new XMLHttpRequest();

        function initContactForm() {
            bindContactFormEvents();
        }

        function bindContactFormEvents() {
            contactForm.addEventListener('change', function (e) {
                const closestLabel = e.target.closest('.form-label');
                if (closestLabel) closestLabel.classList.remove('error-label');
            });
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();
                btnSubmitText.classList.add('submitting');
                for (let i = 0; i < formElements.length; i++) formElements[i].disabled = true;

                const formData = new FormData(e.target);
                let formDataString = new URLSearchParams(formData).toString();
                formDataString += '&action=contact_form&nonce=' + contactFormAdmin.nonce;

                xhr.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            // if (this.resposeText === 'Member Exists') {
                            //     newsletterText.setAttribute('data-show', 'already-subbed');
                            // } else {
                            //     newsletterText.setAttribute('data-show', 'success');
                            // }
                        } else {
                            // newsletterText.setAttribute('data-show', 'error');
                        }
                    }
                };

                xhr.open("POST", contactFormAdmin.ajaxUrl, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send(formDataString);
            });
        }

        initContactForm();
    }

    function initAboutTeamById(widgetId) {
        const teamWidget = document.querySelector(`[data-id="${widgetId}"]`),
            pageOverlay = teamWidget.querySelector('.wgp-page-overlay'),
            popupMemberAvatar = pageOverlay.querySelector('.team-avatar-wrap'),
            popupMemberName = pageOverlay.querySelector('.team-member-name'),
            popupMemberBio = pageOverlay.querySelector('.member-bio');

        function initAboutTeam() {
            // pageOverlay.remove();
            document.body.appendChild(pageOverlay);
            bindAboutTeamEvents();
        }

        function bindAboutTeamEvents() {
            teamWidget.addEventListener('click', function (e) {
                if (targetIs('.more-link', e)) {
                    e.preventDefault();
                    const member = e.target.closest('.team-member'),
                        memberAvatar = member.querySelector('.team-avatar-wrap'),
                        memberName = member.querySelector('.team-member-name'),
                        memberBio = member.querySelector('.member-bio');

                    popupMemberAvatar.innerHTML = memberAvatar.innerHTML;
                    popupMemberName.innerHTML = memberName.innerHTML;
                    popupMemberBio.innerHTML = memberBio.innerHTML;

                    document.body.style.top = `-${window.scrollY}px`;
                    document.body.style.position = 'fixed';
                    pageOverlay.scrollTo(0, 0);
                    pageOverlay.classList.add('show');
                }
            });

            pageOverlay.addEventListener('click', function (e) {
                if (targetIs('.btn-close-popup', e) || e.target.matches('.scrollable-wrap')) {
                    e.preventDefault();
                    pageOverlay.style.visibility = 'visible';
                    pageOverlay.classList.remove('show');

                    setTimeout(function () {
                        const scrollY = document.body.style.top;
                        document.body.style.position = '';
                        document.body.style.top = '';
                        window.scrollTo(0, parseInt(scrollY || '0') * -1);
                        pageOverlay.style.visibility = '';
                    }, 300);
                }
            });
        }

        initAboutTeam();
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
                    isLastWidthDesktop = document.documentElement.clientWidth >= desktopMinWidth,
                    currScrollTop;

                function initSiteHeader() {
                    animateSiteHeader();
                    bindSiteHeaderEvents();
                }

                function bindSiteHeaderEvents() {
                    window.addEventListener('scroll', animateSiteHeader);
                    window.addEventListener('resize', function () {
                        if (isLastWidthDesktop !== document.documentElement.clientWidth >= desktopMinWidth) {
                            headerHeight = headerExpanded.offsetHeight;
                            isLastWidthDesktop = document.documentElement.clientWidth >= desktopMinWidth;
                            animateSiteHeader();
                        }
                    });
                    siteHeader.addEventListener('click', function (e) {
                        if (targetIs('.btn-menu-icon', e)) {
                            e.preventDefault();
                            const targetRect = e.target.getBoundingClientRect();

                            headerDropdown.style.right = (document.documentElement.clientWidth - targetRect.right + 10) + 'px';
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

    function targetIs(selector, event) {
        return event.target.matches(selector) || event.target.closest(selector)
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