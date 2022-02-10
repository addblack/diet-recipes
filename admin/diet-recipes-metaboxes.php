<?php
function diet_recipes_short_description_box_callback($post)
{
	wp_nonce_field(plugin_basename(__FILE__), 'diet_recipes_noncename');
	$value = get_post_meta($post->ID, 'diet_recipe_short_description', 1);
	?>
    <label for="diet_recipes_short_description_field">Here you can add some description for your recipe (Up to 163 symbols)</label>
    <textarea name="diet_recipes_short_description_field" id="diet_recipes_short_description_field" style="width:400px !important; height:80px !important;"><?php echo $value; ?>
    </textarea>
<?php }

function diet_recipes_cooktime_box_callback($post)
{
	wp_nonce_field(plugin_basename(__FILE__), 'diet_recipes_noncename');
	$value = get_post_meta($post->ID, 'diet_recipe_cooktime', 1);
	?>
    <label for="diet_recipes_short_description_field">How much time you need to cook it? (minutes)</label>
    <input type="number" name="diet_recipes_cooktime_field" id="diet_recipes_cooktime_field"
           value='<?php echo $value; ?>'>
<?php }

function diet_recipes_rating_box_callback($post)
{
	wp_nonce_field(plugin_basename(__FILE__), 'diet_recipes_noncename');
	$value = get_post_meta($post->ID, 'diet_recipe_rating', 1);
	?>

    <label for="diet_recipes_rating_field">Rate this recipe</label>
    <select name="diet_recipes_rating_field" id="diet_recipes_rating_field">
        <option value="5" <?php selected($value, '5'); ?>>5</option>
        <option value="4" <?php selected($value, '4'); ?>>4</option>
        <option value="3" <?php selected($value, '3'); ?>>3</option>
        <option value="2" <?php selected($value, '2'); ?>>2</option>
        <option value="1" <?php selected($value, '1'); ?>>1</option>
    </select>
<?php }

add_action('add_meta_boxes', 'diet_recipes_add_custom_box');
/**
 * Register Meta Boxes for Diet Recipe Screen
 */
function diet_recipes_add_custom_box()
{
	add_meta_box('diet_recipes_short_description', 'Short Description', 'diet_recipes_short_description_box_callback', ['recipe']);
	add_meta_box('diet_recipes_cooktime', 'Cooktime', 'diet_recipes_cooktime_box_callback', ['recipe']);
	add_meta_box('diet_recipes_rating', 'Rating', 'diet_recipes_rating_box_callback', ['recipe']);
}

# Save data
add_action('save_post', 'diet_recipes_save_postdata');
function diet_recipes_save_postdata($post_id)
{
	if (!wp_verify_nonce($_POST['diet_recipes_noncename'], plugin_basename(__FILE__)))
		return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if (!current_user_can('edit_post', $post_id))
		return;

	$short_desc = sanitize_text_field($_POST['diet_recipes_short_description_field']);
	$cooktime = sanitize_text_field($_POST['diet_recipes_cooktime_field']);
	$rating = sanitize_text_field($_POST['diet_recipes_rating_field']);

	if ("" == trim($_POST['diet_recipes_short_description_field'])) {
		$short_desc = 'The standard recipe format is the most commonly used — and for good reason.
		 This format checks all the boxes when it comes to what users define as a “good recipe.”';
	}

	if ("" == trim($_POST['diet_recipes_cooktime_field'])) {
	    $cooktime = '♾️';
	}

	update_post_meta($post_id, 'diet_recipe_short_description', $short_desc);
	update_post_meta($post_id, 'diet_recipe_cooktime', $cooktime);
	update_post_meta($post_id, 'diet_recipe_rating', $rating);
}