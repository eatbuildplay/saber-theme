<?php

/**
 *
 * The main template file
 *
 *
 */

get_header();

?>

HELLLOO!!!!

<main id="site-content" role="main">

<?php
if ( have_posts() ) :
	while ( have_posts() ):
		the_post();
    the_content();
	endwhile;
endif;
?>

</main>

<?php

get_footer();
