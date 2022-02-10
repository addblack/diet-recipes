<?php
/*
Plugin Name: Diet Recipes
Plugin URI: add.black
Description: This plugin just allows you to create and show recipes.
Version: 1.0.0
Author: Alex Den
Author URI: add.black
License: GPLv2 or later
Text Domain: diet-recipes
*/

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Rest route file for recipe api
 */
include_once(plugin_dir_path(__FILE__) . 'includes/diet-recipes-rest.php');

if (is_admin()) {
	include_once(plugin_dir_path(__FILE__) . 'admin/diet-recipes-register-cpt.php');
	include_once(plugin_dir_path(__FILE__) . 'admin/diet-recipes-metaboxes.php');
} else {
	include_once(plugin_dir_path(__FILE__) . 'public/diet-recipes-public.php');
}






