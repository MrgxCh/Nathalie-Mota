<?php
/**
 * The template for displaying all single posts
 *
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */
?>

<?php
get_header();
?>
<div class="main single">
	<?php
	if (have_posts()):
		while (have_posts()):
			the_post();
			?>
			<div class="post">
				<h1 class="post-title"><?php the_title(); ?> </h1>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
				<div class="post-comments">
					<?php
					comments_template(); ?>
				</div>
			</div>
			<?php
		endwhile;
	endif;
	?>
</div>
<?php
get_sidebar();
get_footer();
