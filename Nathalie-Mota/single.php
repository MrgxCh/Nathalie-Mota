<?php
/**
 * Template Name: Blog
 */

get_header();
?>

<main class="main-content-post">
    <?php
    if (have_posts()) : 
        while (have_posts()) : 
            the_post(); 
    ?>
    <div class="post">
    <h1 class="post-title"><?php the_title(); ?></h1>
        <div>
            <?php the_content(); ?>
        </div>
    <?php
        endwhile;
    endif; 
    ?>
</main>

<?php
get_footer();