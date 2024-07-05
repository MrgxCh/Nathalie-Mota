<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */


//Ajout styles
function enqueue_custom_styles()
{
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
	wp_enqueue_style('single-photo', get_template_directory_uri() . '/assets/CSS/single-photo.css', array(), '1.0', 'all');
	wp_enqueue_style('photo-block', get_template_directory_uri() . '/assets/CSS/photo-block.css', array());
	wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/assets/CSS/lightbox.css');
	wp_enqueue_style('lightbox-single', get_template_directory_uri() . '/assets/CSS/lightbox-single-photo.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');


//Ajout scripts
function enqueue_custom_scripts()
{
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true);
	wp_enqueue_script('photo-block', get_template_directory_uri() . '/js/photo-block.js', array('jquery'), '1.1.1', true);
	wp_enqueue_script('script-lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


// PAGINATION INFINIE
function enqueue_infinite_pagination_js() {
    wp_enqueue_script('infinite-pagination', get_template_directory_uri() . '/js/infinite-pagination.js', array('jquery'), '', true);
    wp_localize_script('infinite-pagination', 'wp_data', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_pagination_js');


//Enregistrement des menus
function register_my_menus()
{
	register_nav_menu('main', __('Menu principal', 'text-domain'));
	register_nav_menu('footer', __('Footer', 'text-domain'));
}
add_action('after_setup_theme', 'register_my_menus');



function cptui_register_my_cpts_photo()
{
	/**
	 * Post Type: photos.
	 */

	$labels = [
		"name" => esc_html__("photos", "Nathalie-Mota"),
		"singular_name" => esc_html__("photo", "Nathalie-Mota"),
	];

	$args = [
		"label" => esc_html__("photos", "Nathalie-Mota"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => ["slug" => "photo", "with_front" => true],
		"query_var" => true,
		"menu_position" => 5,
		"supports" => ["title", "editor", "thumbnail", "custom-fields"],
		"taxonomies" => ["categorie", "format"],
		"show_in_graphql" => false,
	];

	register_post_type("photo", $args);
}

add_action('init', 'cptui_register_my_cpts_photo'); ?>

<?php include get_template_directory() . '/assets/includes/ajax.php';?>