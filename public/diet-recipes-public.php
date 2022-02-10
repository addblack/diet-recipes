<?php

/**
 * Css and Js for front-end
 */
function diet_recipes_assets()
{
	// Dynamic version to prevent browser caching
	$version = is_user_logged_in() ? $_SERVER['REQUEST_TIME'] : '1.0';
	$rest_url = get_rest_url();

	wp_register_script('diet-recipes', plugin_dir_url(__FILE__) . 'diet-recipes.js', [], $version, true);
	wp_localize_script('diet-recipes', 'diet_recipes_data', ['resturl' => $rest_url]);
	wp_enqueue_script('diet-recipes');
	wp_enqueue_style('diet-recipes', plugin_dir_url(__FILE__) . 'diet-recipes.css', [], $version);
}

add_action('wp_enqueue_scripts', 'diet_recipes_assets');


function diet_recipes_shortcode()
{
	ob_start(); ?>
    <div id="recipes">
        <div class="search">
            <h4 class="search__title">Find your best recipe</h4>
            <form action="self" class="search__form">
                <input type="text" id="search-input" placeholder="Seach your recipe">
            </form>
        </div>

        <div id="results" class="recipes">
            <div class="loader"></div>
        </div>
    </div>
	<?php return ob_get_clean();
}

add_shortcode('recipes', 'diet_recipes_shortcode');