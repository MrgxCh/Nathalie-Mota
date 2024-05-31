<?php
/**
 * The template for displaying the footer
 *
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */

?>

<?php
get_template_part('template-parts/contact');
?>

<footer id="site-footer">
	<div class="navigation-footer">
		<!-- Lance la popup contact -->
		<?php
		// Affichage du menu footer déclaré dans functions.php
		wp_nav_menu(array('theme_location' => 'footer'));
		?>
	</div>
	<!-- Ajout du widget dans le pied de page -->
	<aside id="widget-area">
		<?php dynamic_sidebar('footer-widget'); ?>
	</aside>
</footer>

<?php wp_footer(); ?>

</body>

</html>