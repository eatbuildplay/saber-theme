jQuery(document).ready(function($) {

  /*
   * Particles
   */
  particlesJS.load('particle-hero', 'http://eatbuildplay.local/wp-content/themes/saber/assets/particles/demo/particles.json', function() {
    console.log('callback - particles.js config loaded');
  });

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
