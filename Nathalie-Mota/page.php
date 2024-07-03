<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */
?>

<?php

get_header(); ?>

<main class="main-page">
	<div class="container-page">
    <?php
    
    while ( have_posts() ) : the_post();

        the_content();

    endwhile; ?>
	</div>
</main>

<?php

get_footer();
?>