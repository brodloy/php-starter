/* ============================================================================
   APP.JS — deliberately tiny.
   ----------------------------------------------------------------------------
   This boilerplate renders real HTML on the server, so JavaScript is only for
   light enhancement, not for running the app. Right now it does one thing: ask
   for confirmation before any form that deletes something is submitted.

   Mark such a form with  data-confirm="Your message?".
   ========================================================================== */
document.addEventListener('submit', function (event) {
    var form = event.target;
    if (form instanceof HTMLFormElement && form.dataset.confirm) {
        if (!window.confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    }
});

/* ----------------------------------------------------------------------------
   Mobile nav drawer. On phones the dashboard sidebar is hidden off-screen; the
   hamburger in the top bar slides it in, and tapping the backdrop or any link
   closes it again. Pure class toggling — the slide itself is CSS.
   -------------------------------------------------------------------------- */
(function () {
    var shell = document.querySelector('.app-shell');
    if (!shell) {
        return; // not on an app-layout page
    }

    function setOpen(open) {
        shell.classList.toggle('nav-open', open);
        var toggle = document.querySelector('[data-nav-open]');
        if (toggle) {
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        }
    }

    document.addEventListener('click', function (event) {
        if (event.target.closest('[data-nav-open]')) {
            setOpen(!shell.classList.contains('nav-open'));
        } else if (event.target.closest('[data-nav-close]')) {
            setOpen(false);
        } else if (event.target.closest('.app-sidebar a')) {
            setOpen(false); // close after tapping a nav link
        }
    });
})();
