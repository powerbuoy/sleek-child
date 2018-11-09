<?php
# Example of adding your own WP admin columns, replace "movie" and "movie_release_year" with your own CPTs and fields
# Add columns
/* add_filter('manage_movie_posts_columns', function ($cols) {
	$newCols = $cols;
	$addCols = [
		'movie_release_year' => __('Released (Year)', 'sleek_child')
	];

	# Remove these cols
	unset($newCols['author']);
	unset($newCols['comments']);

	# Insert new cols
	$newCols = array_slice($newCols, 0, 2, false) + $addCols + array_slice($newCols, 2, null, false);

	return $newCols;
});

# Insert their values
add_action('manage_movie_posts_custom_column', function ($col, $postId) {
	if ($col === 'movie_release_year') {
		$val = get_post_meta('movie_release_year', $postId, true);

		echo $val;
	}
}, 10, 2);

# Make them sortable
add_action('manage_edit-movie_sortable_columns', function ($cols) {
	# Key should be same as col name, value is the name of the sort used in pre_get_posts
	$cols['movie_release_year'] = 'movie_release_year';

	return $cols;
});

# Make WP understand how to sort them
add_action('pre_get_posts', function ($query) {
	if (is_admin()) {
		if ($query->get('orderby') == 'movie_release_year') {
			$query->set('meta_key', 'movie_release_year');
			$query->set('orderby', 'meta_value_num'); # NOTE: Use meta_value_num for numeric values and meta_value for strings
		}
	}
}); */
