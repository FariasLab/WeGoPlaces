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

        // Fixed Footer
        initFixedFooter();
    }

    function initFixedFooter() {
        const heroBtnQuote = document.querySelector('.site-main .btn-ask-quote'),
            fixedFooter = document.querySelector('.fixed-footer'),
            footerBtnQuote = fixedFooter.querySelector('.btn-ask-quote'),
            consentSection = fixedFooter.querySelector('.consent-section'),

            dropCookie = true, // false to disable cookie and do some testing
            cookieDuration = 365, // number of days before cookie expires
            cookieName = 'complianceCookie', //Name of our cookie
            cookieValue = 'on'; // Value of cookie;



        function initFixedFooter() {
            if (userHasConsented() && !heroBtnQuote) {
                fixedFooter.remove();
                return;
            }
            if (!heroBtnQuote) footerBtnQuote.remove();
            else if (userHasConsented()) consentSection.remove();
            fixedFooter.classList.add('show');
            bindFixedFooterEvents();
        }

        function bindFixedFooterEvents() {
            if (heroBtnQuote) {
                // console.log({
                //     'heroBtnTop+Height': heroBtnQuote.scrollTop + heroBtnQuote.offsetHeight
                // });
                window.addEventListener('scroll', function () {
                    // console.log('pageY', window.pageYOffset);

                    // if (heroBtnQuote.scrollTop + heroBtnQuote.offsetHeight < document.documentElement.scrollTop)
                    // if (heroBtnQuote.getBoundingClientRect().top + heroBtnQuote.offsetHeight < window.pageYOffset)
                    if (heroBtnQuote.getBoundingClientRect().top + heroBtnQuote.offsetHeight < 0)
                    // if (heroBtnQuote.getBoundingClientRect().top + heroBtnQuote.offsetHeight < document.documentElement.scrollTop)
                        footerBtnQuote.classList.add('show');
                    else footerBtnQuote.classList.remove('show');
                });
            }
            if (!userHasConsented()) {
                function closeConsent(e) {
                    if (targetIs('.btn-close-consent, .btn-ok-consent', e)) {
                        e.preventDefault();
                        createCookie(cookieName, cookieValue, cookieDuration);
                        fixedFooter.classList.remove('show');
                        consentSection.removeEventListener('click', closeConsent);
                    }
                }
                consentSection.addEventListener('click', closeConsent);
            }
        }

        function userHasConsented() {
            return checkCookie(cookieName) === cookieValue;
        }

        function createCookie(name, value, days) {
            let expires;
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires="+date.toGMTString();
            }
            else expires = "";
            if (dropCookie) {
                document.cookie = name+"="+value+expires+"; path=/";
            }
        }

        function checkCookie(name) {
            const nameEQ = name + "=",
                ca = document.cookie.split(';');

            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) ===' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name,"",-1);
        }

        initFixedFooter();
    }

    function initContactFormById(widgetId) {
        const contactForm = document.querySelector(`[data-id="${widgetId}"] .form-wrap`),
            formElements = contactForm.elements,
            btnSubmitText = contactForm.querySelector('.btn-submit .btn-text'),
            xhr = new XMLHttpRequest(),
            hiddenAlerts = document.querySelector(`[data-id="${widgetId}"] .alert-wrap`),
            successAlert = hiddenAlerts.querySelector('.success'),
            clientErrorAlert = hiddenAlerts.querySelector('.client-error'),
            serverErrorAlert = hiddenAlerts.querySelector('.server-error'),
            heroAlerts = document.querySelector('.wgp-contact-hero .alert-wrap');

        function initContactForm() {
            hiddenAlerts.remove();
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
                heroAlerts.innerHTML = '';

                let formDataString = 'action=contact_form&nonce=' + contactFormAdmin.nonce;
                for (let i = 0; i < formElements.length; i++) {
                    formElements[i].disabled = true;
                    if (formElements[i].name) {
                        formElements[i].parentElement.classList.remove('error-label');
                        formDataString += '&' + formElements[i].name + '=' + encodeURIComponent(formElements[i].value);
                    }
                }

                xhr.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            if (heroAlerts) heroAlerts.appendChild(successAlert);
                            contactForm.innerHTML = '';
                        }
                        else {
                            const jsonResponse = JSON.parse(this.response);
                            btnSubmitText.classList.remove('submitting');
                            if (jsonResponse.data && jsonResponse.data.fieldsWithErrors) {
                                // client error
                                for (let i = 0; i < formElements.length; i++) {
                                    formElements[i].disabled = false;
                                    if (jsonResponse.data.fieldsWithErrors.includes(formElements[i].name)) {
                                        formElements[i].parentElement.classList.add('error-label');
                                    }
                                }
                                heroAlerts.appendChild(clientErrorAlert);
                            }
                            else {
                                // server error
                                for (let i = 0; i < formElements.length; i++)
                                    formElements[i].disabled = false;
                                heroAlerts.appendChild(serverErrorAlert);
                            }

                        }

                        scrollPageToElement(heroAlerts, -60);
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

    function scrollPageToElement(element, offsetTop = 0) {
        const elementTop = element.getBoundingClientRect().top + document.documentElement.scrollTop + offsetTop;

        if (elementTop >= document.documentElement.scrollTop)
            document.documentElement.scrollTop = elementTop - 50;
        else
            document.documentElement.scrollTop = elementTop + 50;

        scrollTo(document.documentElement, elementTop, 300);
    }

    function scrollTo(element, to, duration) {
        const start = element.scrollTop,
            change = to - start,
            increment = 20;

        let currentTime = 0;

        function animateScroll() {
            currentTime += increment;
            element.scrollTop = Math.easeOutCirc(currentTime, start, change, duration);
            if (currentTime < duration) {
                setTimeout(animateScroll, increment);
            }
        }

        animateScroll();
    }

    Math.easeOutCirc = function (t, b, c, d) {
        return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
    };

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