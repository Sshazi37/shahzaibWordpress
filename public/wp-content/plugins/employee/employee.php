<?php
/* 
Plugin Name: Employee 
Plugin URI: https://www.shahzaib.info
Description: Custom plugin developer by shahzaib     
Author: Shahzaib
Version: 1.0 
Author URI: https://www.shahzaib.info
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly 
}

// Register Custom Post Type employee
function create_employee_cpt() {

	$labels = array(
		'name' => _x( 'employees', 'Post Type General Name', 'shazi' ),
		'singular_name' => _x( 'employee', 'Post Type Singular Name', 'shazi' ),
		'menu_name' => _x( 'employees', 'Admin Menu text', 'shazi' ),
		'name_admin_bar' => _x( 'employee', 'Add New on Toolbar', 'shazi' ),
		'archives' => __( 'employee Archives', 'shazi' ),
		'attributes' => __( 'employee Attributes', 'shazi' ),
		'parent_item_colon' => __( 'Parent employee:', 'shazi' ),
		'all_items' => __( 'All employees', 'shazi' ),
		'add_new_item' => __( 'Add New employee', 'shazi' ),
		'add_new' => __( 'Add New', 'shazi' ),
		'new_item' => __( 'New employee', 'shazi' ),
		'edit_item' => __( 'Edit employee', 'shazi' ),
		'update_item' => __( 'Update employee', 'shazi' ),
		'view_item' => __( 'View employee', 'shazi' ),
		'view_items' => __( 'View employees', 'shazi' ),
		'search_items' => __( 'Search employee', 'shazi' ),
		'not_found' => __( 'Not found', 'shazi' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'shazi' ),
		'featured_image' => __( 'Featured Image', 'shazi' ),
		'set_featured_image' => __( 'Set featured image', 'shazi' ),
		'remove_featured_image' => __( 'Remove featured image', 'shazi' ),
		'use_featured_image' => __( 'Use as featured image', 'shazi' ),
		'insert_into_item' => __( 'Insert into employee', 'shazi' ),
		'uploaded_to_this_item' => __( 'Uploaded to this employee', 'shazi' ),
		'items_list' => __( 'employees list', 'shazi' ),
		'items_list_navigation' => __( 'employees list navigation', 'shazi' ),
		'filter_items_list' => __( 'Filter employees list', 'shazi' ),
	);
	$args = array(
		'label' => __( 'employee', 'shazi' ),
		'description' => __( 'Employee Post type', 'shazi' ),
		'labels' => $labels,
		'menu_icon' => '',
		'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
        'menu_icon' => 'dashicons-businessman',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'employee', $args );

}
add_action( 'init', 'create_employee_cpt', 0 );

add_action('rest_api_init' , function(){

register_rest_field('employee',
        'employee_image_src',
        array(
            'get_callback'    => 'employee_image',
            'update_callback' => null,
            'schema'          => null
        )
    );
    
});

function employee_image($object,$field_name,$request){
    $img = wp_get_attachment_image_src($object['featured_media'],'full');
    
    return $img[0];
}