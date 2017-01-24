<?php
# Register thumbnail sizes
add_action('after_setup_theme', function () {
	add_image_size('sleek-small', 120, 120, ['center', 'top']);
	add_image_size('sleek-hd', 1920, 1080, ['center', 'top']);
});

# Register custom post types and taxonomies
/* $postTypes = ['movie', 'director'];

add_action('init', function () use ($postTypes) {
	# Post types
	sleek_register_post_types($postTypes, 'sleek_child');

	# Taxonomies
	sleek_register_taxonomies([
		'genre' => ['movie'],
		'country' => ['movie', 'director']
	], 'sleek_child');

	# Array of CPTs that should appear in search (on top of post/page)
	# (run this function unless you want all your CPTs to appear)
	# sleek_set_cpt_in_search(['movie']);
}); */

# Add meta data (title, description, image) to CPTs
/* add_action('admin_menu', function () use ($postTypes) {
	sleek_register_post_type_meta_data($postTypes, 'sleek_child', ['subtitle' => 'text']); // Pass in more fields as last argument
}); */

# Register ACF
# Hide ACF from admin altogether (to prevent people from adding ACF)
# add_filter('acf/settings/show_admin', '__return_false');

# Use these fields (add your fields to acf/my-group.php)
add_action('acf/init', function () {
	# ACF in post types
/*	sleek_register_acf([
		'page' => ['page-meta', 'redirect-url']
	]); */

	# ACF in options pages
/*	sleek_register_acf_options([
		'theme-settings' => ['page-meta', 'redirect-url']
	]); */

	# ACF in module containers
/*	sleek_register_acf_modules([
		'page' => [
			'below-content' => ['video'],
			'above-content' => ['video']
		]
	]); */
});

# Register CSS and JS
add_action('init', function () {
	sleek_register_assets(); # Pass in more as only argument; ['https://fonts.googleapis.com/css?family=Lato:300,900']
});

# Register sidebars
/* add_action('init', function () {
	sleek_register_sidebars([
		'aside' => [
			'name' => __('Aside', 'sleek_child'),
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		],
		'header' => __('Header', 'sleek_child'),
		'footer' => __('Footer', 'sleek_child')
	]);
}); */

# Add more options to Appearance -> Customize -> Theme Options
# (then use your options with get_theme_mod('option_name') any way you like)
/* add_action('customize_register', function ($wpCustomize) {
	sleek_register_theme_options($wpCustomize, [
		'hubspot_portal_id' => 'text',
		'hubspot_vacancies_form_id' => 'text'
	], 'sleek_child');
}); */

# Allow svg etc uploads
/* add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['eps'] = 'application/postscript';

	return $mimes;
}); */

# Add more fields to users
/* add_filter('user_contactmethods', function () {
	$fields['googleplus'] = __('Google+', 'sleek_child');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek_child');
	$fields['github'] = __('GitHub', 'sleek_child');

	return $fields;
}); */

# Give pages excerpts
/* add_action('init', function () {
	add_post_type_support('page', 'excerpt');
}); */

# Set up for translation (put your mo/po-files in your-theme/languages/)
add_action('after_setup_theme', function () {
	load_child_theme_textdomain('sleek_child', get_stylesheet_directory() . '/languages');

	# If you want to override parent theme translations, add them to languages/sleek/lang_Code.po
	# load_theme_textdomain('sleek', get_stylesheet_directory() . '/languages/sleek');
});
