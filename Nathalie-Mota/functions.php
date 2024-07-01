<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */

//Ajout styles
function enqueue_custom_styles() {
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('single-photo', get_template_directory_uri() . '/assets/CSS/single-photo.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

//Ajout scripts
function enqueue_custom_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


//Enregistrement des menus
function register_my_menus()
{
    register_nav_menu('main', __('Menu principal', 'text-domain'));
    register_nav_menu('footer', __('Footer', 'text-domain'));
}
add_action('after_setup_theme', 'register_my_menus');

function cptui_register_my_cpts_photo() {

	/**
	 * Post Type: photos.
	 */

	$labels = [
		"name" => esc_html__( "photos", "Nathalie-Mota" ),
		"singular_name" => esc_html__( "photo", "Nathalie-Mota" ),
	];

	$args = [
		"label" => esc_html__( "photos", "Nathalie-Mota" ),
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
		"rewrite" => [ "slug" => "photo", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 5,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
		"taxonomies" => [ "categorie", "format" ],
		"show_in_graphql" => false,
	];

	register_post_type( "photo", $args );
}

add_action( 'init', 'cptui_register_my_cpts_photo' );


