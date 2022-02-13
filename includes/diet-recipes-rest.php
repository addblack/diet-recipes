<?php

/**
 * @description Function to return post meta values
 * @param $id - Post id
 * @return mixed - array with post metadata
 */
function get_post_meta_single($id)
{
	$m = get_post_meta($id, false, true);
	foreach ($m as &$v) $v = array_shift($v);
	return $m;
}

/**
 * @description Get all recipes from api
 * @return array - all recipes
 */
function get_diet_recipes()
{
	$title = ( isset( $_GET['title'] ) ) ? sanitize_text_field( $_GET['title'] ) : '';

	$recipes = get_posts([
		'post_type' => 'recipe',
		'post_status' => 'publish',
		'numberposts' => -1,
		's' => strtolower($title)
	]);

	$response = [];

	foreach ($recipes as $recipe) {
		$id = $recipe->ID;
		$response[] = [
			'id' => $id,
			'title' => strtolower($recipe->post_title) ?: 'Tasty Recipe',
			'meta' => get_post_meta_single($id),
			'image_url' => get_the_post_thumbnail_url($id) ?: plugin_dir_url(dirname(__FILE__)) . 'public/default.jpg',
		];
	}

	return $response;
}

/**
 * Register Rest Route for recipe post type
 */
add_action('rest_api_init', function () {
	$namespace = 'dr/v1';
	$route = 'recipes';

	register_rest_route($namespace, $route, [
		'methods' => WP_REST_Server::READABLE,
		'callback' => 'get_diet_recipes'
	]);
});

