<?php

if (!function_exists('register_recipe_post_type')) {

// Register Custom Post Type
	function diet_recipes_register_recipe_post_type()
	{

		$labels = [
			'name' => _x('Recipes', 'Post Type General Name', 'diet-recipes'),
			'singular_name' => _x('Recipe', 'Post Type Singular Name', 'diet-recipes'),
			'menu_name' => __('Recipes', 'diet-recipes'),
			'name_admin_bar' => __('Recipe', 'diet-recipes'),
			'archives' => __('Item Archives', 'diet-recipes'),
			'attributes' => __('Item Attributes', 'diet-recipes'),
			'parent_item_colon' => __('Parent Item:', 'diet-recipes'),
			'all_items' => __('All Items', 'diet-recipes'),
			'add_new_item' => __('Add New Item', 'diet-recipes'),
			'add_new' => __('Add New', 'diet-recipes'),
			'new_item' => __('New Item', 'diet-recipes'),
			'edit_item' => __('Edit Item', 'diet-recipes'),
			'update_item' => __('Update Item', 'diet-recipes'),
			'view_item' => __('View Item', 'diet-recipes'),
			'view_items' => __('View Items', 'diet-recipes'),
			'search_items' => __('Search Item', 'diet-recipes'),
			'not_found' => __('Not found', 'diet-recipes'),
			'not_found_in_trash' => __('Not found in Trash', 'diet-recipes'),
			'featured_image' => __('Featured Image', 'diet-recipes'),
			'set_featured_image' => __('Set featured image', 'diet-recipes'),
			'remove_featured_image' => __('Remove featured image', 'diet-recipes'),
			'use_featured_image' => __('Use as featured image', 'diet-recipes'),
			'insert_into_item' => __('Insert into item', 'diet-recipes'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'diet-recipes'),
			'items_list' => __('Items list', 'diet-recipes'),
			'items_list_navigation' => __('Items list navigation', 'diet-recipes'),
			'filter_items_list' => __('Filter items list', 'diet-recipes'),
		];
		$args = [
			'label' => __('Recipe', 'diet-recipes'),
			'description' => __('Recipes', 'diet-recipes'),
			'labels' => $labels,
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'can_export' => true,
			'has_archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'show_in_rest' => true,
		];

		register_post_type('recipe', $args);
	}

	add_action('init', 'diet_recipes_register_recipe_post_type');
}
