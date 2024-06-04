<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Nathalie-Mota
 */

 function add_enqueue_scripts()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'add_enqueue_scripts');


wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');

//Enregistrement des menus header
function register_my_menus() {
    register_nav_menu( 'main', __( 'Menu principal', 'text-domain' ) );
    register_nav_menu('footer', __('Footer', 'text-domain' ));
}
add_action( 'after_setup_theme', 'register_my_menus' );

