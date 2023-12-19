const navlinkEls = document.querySelectorAll('.nav-link');
const windowPathname = window.location.pathname;

navlinkEls.forEach(navlinkEl => {
    if (navlinkEl.href.includes(windowPathname)) {
        navlinkEl.classList.add('active')
    }
});