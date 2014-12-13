<?php

/**
 * Include the class
 */
include_once('class.custom-post-type.php');

/**
 * Include any post types here
 */
include_once('page-metaboxes.php');
include_once('example-recipe.php');

/**
 * Include our Styles and Scripts
 */
function wp_admin_scripts(){
	wp_register_script('cpt-js', get_stylesheet_directory_uri() . '/wp-cpt-helper-class/assets/js/cpt-admin.js', array('jquery'));
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'timepicker', get_stylesheet_directory_uri() . '/wp-cpt-helper-class/assets/js/timepicker/jquery.timepicker.js');
	wp_enqueue_script('cpt-js');
	
	wp_register_style('cpt-css', get_stylesheet_directory_uri() . '/wp-cpt-helper-class/assets/css/cpt-style.css');
	wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
	wp_enqueue_style( 'timepicker-style', get_stylesheet_directory_uri() . '/wp-cpt-helper-class/assets/js/timepicker/jquery.timepicker.css');
	wp_enqueue_style('cpt-css');
}
add_action( 'admin_enqueue_scripts', 'wp_admin_scripts' );
	
?>