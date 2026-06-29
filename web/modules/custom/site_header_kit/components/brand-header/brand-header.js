(function (Drupal, once) {
  'use strict';

  Drupal.behaviors.shkResponsiveMenu = {
    attach(context) {
      once('shkResponsiveMenu', '.shk-main-nav', context).forEach((nav) => {
        const button = nav.querySelector('.shk-menu-toggle');
        const menu = nav.querySelector('.shk-main-nav__links');

        if (!button || !menu) {
          return;
        }

        button.addEventListener('click', (event) => {
          event.preventDefault();

          const isOpen = nav.classList.toggle('is-open');

          button.classList.toggle('is-open', isOpen);
          menu.classList.toggle('is-open', isOpen);

          button.setAttribute('aria-expanded', isOpen);
        });

        window.addEventListener('resize', () => {
          if (window.innerWidth >= 768) {
            nav.classList.remove('is-open');
            button.classList.remove('is-open');
            menu.classList.remove('is-open');
            button.setAttribute('aria-expanded', 'false');
          }
        });
      });
    }
  };

})(Drupal, once);