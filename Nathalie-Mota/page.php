<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */
?>

<?php get_header(); ?>

<div class="main page">

	<?php if (have_posts()): while (have_posts()): the_post(); ?>

		<h1 class="post-title"><?php get_the_title(); ?></h1>
			<div class="post-content">
					<?php the_content(); ?>
				</div>

		<?php endwhile; ?>
	<?php endif; ?>

</div>

<?php get_sidebar();  get_footer(); 