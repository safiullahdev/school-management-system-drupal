(function (Drupal) {
  console.log('responsive-menu.js loaded');

  Drupal.behaviors.shkResponsiveMenu = {
    attach(context) {
      var navs = context.querySelectorAll('.shk-main-nav');

      navs.forEach(function (nav) {
        if (nav.dataset.shkInit === '1') {
          return;
        }
        nav.dataset.shkInit = '1';

        var toggle = nav.querySelector('.shk-menu-toggle');
        var menu   = nav.querySelector('.shk-main-nav__links');

        if (!toggle || !menu) {
          return;
        }

        toggle.addEventListener('click', function () {
          var isOpen = menu.classList.toggle('is-open');

          toggle.classList.toggle('is-open', isOpen);
          toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
      });
    }
  };
})(Drupal);
