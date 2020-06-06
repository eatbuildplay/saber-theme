jQuery(document).ready(function($) {

  /*
   * Particles
   */
  var $particleEl = $('#particle-hero .elementor-background-overlay');
  if( $particleEl.length ) {
    particlesJS.load(
      '#particle-hero .elementor-background-overlay',
      window.location.protocol + '//' + window.location.host + '/wp-content/themes/saber/assets/particles/demo/particles.json'
    );
  }

  /*
   * Skeleton
   */

  var $wrapper = $('.wrapper'), step = 0;

  $('#callback').click(function () {

    console.log('click callback...')

    switch (step) {
      case 0:
        $wrapper.avnSkeleton();
        step = 1;
        break;

      case 1:
        $wrapper.avnSkeleton('remove');
        step = 2;

        $wrapper.find('> header').append(`
          Lorem ipsum <br />
          dolor sit amet`);

        $wrapper.find('> main').append(`
          <p>
            Lorem ipsum dolor sit amet, <br />
            consectetur adipiscing elit, sed do eiusmod <br />
            tempor incididunt ut labore et dolore magna aliqua. <br />
            Ut enim ad minim veniam, quis nostrud...
          </p>
          <p>
            Lorem ipsum dolor sit amet, <br />
            consectetur adipiscing elit, sed do eiusmod <br />
            tempor incididunt ut labore et dolore magna aliqua. <br />
            Ut enim ad minim veniam, quis nostrud...
          </p>
          <p>
            Lorem ipsum dolor sit amet, <br />
            consectetur adipiscing elit, sed do eiusmod <br />
            tempor incididunt ut labore et dolore magna aliqua. <br />
            Ut enim ad minim veniam, quis nostrud...
          </p>`);
        break;

      case 2:
        $wrapper.avnSkeleton('display');
        step = 1;
        break;
    }
  });

});
