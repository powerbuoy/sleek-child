<?php
require_once get_stylesheet_directory() . '/inc/add-editor-styles.php';
require_once get_stylesheet_directory() . '/inc/add-wp-admin-cols.php';

######################################
# Modify WP's built in thumbnail sizes
add_action('after_setup_theme', function () {
	# Pass in the width/height of the largest image. Sizes will be registered for
	# thumbnail (25%), medium (50%), medium_large (75%) and large (the size you pass in)
	# Pass in additional sizes as last array with an optional 'crop' key
	sleek_register_image_sizes(1920, 1080, ['center', 'center']/*, [
		'portrait' => ['width' => 1080, 'height' => 1920],
		'square' => ['width' => 1920, 'height' => 1920],
	]*/);
});

###########################################
# Register custom post types and taxonomies
# NOTE: This can be an associative array if you need to override default post type config
$postTypes = [
	'movie',
	'director' => [
		'menu_icon' => 'dashicons-businessman',
		'description' => __('A list of famous film directors', 'sleek_child')
	]
];

add_action('init', function () use ($postTypes) {
	# Post types
#	sleek_register_post_types($postTypes, 'sleek_child');

	# Taxonomies
/*	sleek_register_taxonomies([
		'genre' => ['movie'],
		'country' => ['movie', 'director']
	], 'sleek_child'); */

	# Array of CPTs that should appear in search
	# NOTE: Run this function unless you want all your CPTs to appear in search
	# sleek_set_cpt_in_search(['post', 'page', 'movie']);
});

###################################################
# Create archive meta data pages for our post types
# NOTE: You can add more fields to these pages using the "${postType}_archive_meta" key
/* add_action('acf/init', function () use ($postTypes) {
	sleek_archive_meta_data($postTypes);
}); */

##############
# Register ACF
# Hide ACF from admin altogether (to prevent users from adding ACF from there)
add_filter('acf/settings/show_admin', '__return_false');

# Register fields
add_action('acf/init', function () {
	# Add an options page
/*	SleekACF::addOptionsPage([
		'page_title' => __('Theme settings', 'sleek_child'),
		'menu_slug' => 'theme_settings',
		'post_id' => 'theme_settings' # NOTE: Use this id in get_field('my_field', 'theme_settings')
	]); */

	# Add some fields to the options page
/*	SleekACF::addFieldGroup([
		'key' => 'theme_settings', # NOTE: This doesn't have to be the same as the post_id above, but it doesn't hurt either
		'title' => __('Theme settings', 'sleek_child'),
		'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'theme_settings']]],
		'fields' => [
			'contact-form'
		]
	]); */

	# Add more fields to the archive options page for movies
/*	SleekACF::addFieldGroup([
		'key' => 'movie_archive_meta',
		'title' => __('Archive options', 'sleek_child'),
		'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'movie_archive_meta']]],
		'fields' => [
			'contact-form'
		]
	]); */

	# Add ACF to a flexible content field named "below_content"
	# NOTE: Render these fields using SleekACF::addFieldGroup_render_modules('below_content')
	SleekACF::addFieldGroup([
		'key' => 'modules',
		'title' => __('Modules', 'sleek_child'),
		'flexible' => true,
		'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
		'fields' => [
			'below_content' => [
				'attachments', 'child-pages', 'contact-form', 'counter', 'divider', 'featured-posts', 'gallery',
				'google-map', 'hubspot-cta', 'hubspot-form', 'instagram', 'latest-posts', 'next-post', 'page-menu',
				'share-page', 'sibling-pages', 'sticky-post', 'text-block', 'text-blocks', 'users', 'video'
			],
			'aside_content' => [
				'attachments', 'child-pages', 'contact-form', 'counter', 'divider', 'featured-posts', 'gallery',
				'google-map', 'hubspot-cta', 'hubspot-form', 'instagram', 'latest-posts', 'next-post', 'page-menu',
				'share-page', 'sibling-pages', 'sticky-post', 'text-block', 'text-blocks', 'users', 'video'
			]
		]
	]);

	# Add fixed ACF fields to the sidebar
/*	SleekACF::addFieldGroup([
		'key' => 'page_meta',
		'title' => __('Page options', 'sleek_child'),
		'position' => 'side',
		'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
		'fields' => [
			'redirect-url'
		]
	]); */

	# Add fixed, tabbed ACF fields below the editor
	SleekACF::addFieldGroup([
		'key' => 'page_content',
		'title' => __('Page content', 'sleek_child'),
		'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
		'tab_placement' => 'left',
		'fields' => [
			# NOTE: Nested arrays create tabs
			__('Hero', 'sleek_child') => [
				'video-hero'
			]
		]
	]);

	# Add a single field below the title
/*	SleekACF::addFieldGroup([
		'key' => 'page_below_title',
		'title' => __('Subtitle'),
		'position' => 'acf_after_title',
		'layout' => 'seamless',
		'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
		'fields' => [
			'subtitle'
		]
	]); */
});

#####################
# Register CSS and JS
# (automatically adds dist/all.css and dist/all.js which are generated by Gulp)
add_action('wp_enqueue_scripts', function () {
	sleek_register_assets(); # Pass in more as array: ['https://fonts.googleapis.com/css?family=Lato:300,900|Roboto:900', 'https://cdn.jsdelivr.net/npm/vue@latest/dist/vue.js']
});

###################
# Register sidebars
add_action('init', function () {
	sleek_register_sidebars([
		'header' => __('Header', 'sleek_child'),
		'footer' => __('Footer', 'sleek_child')
	]);
});

###################
# Add menu location
/* add_action('after_setup_theme', function () {
	register_nav_menu('header', __('Header menu', 'sleek_child'));
}); */

########################
# Add more theme options
/* add_action('admin_init', function () {
	sleek_add_settings_field('hubspot_portal_id', __('Hubspot Portal ID', 'sleek'), 'text');
});

# Use the new theme options
add_action('wp_head', function () {
	$options = get_option(SLEEK_SETTINGS_NAME);

	if (isset($options['hubspot_portal_id']) and !empty($options['hubspot_portal_id'])) {
		echo '<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/' . $options['hubspot_portal_id'] . '.js"></script>';
	}
}); */

##########################
# Add more fields to users
/* add_filter('user_contactmethods', function ($fields) {
	$fields['tagline'] = __('Tagline', 'sleek_child');
	$fields['phone'] = __('Telephone', 'sleek_child');
	$fields['facebook'] = __('Facebook', 'sleek_child');
	$fields['twitter'] = __('Twitter', 'sleek_child');
	$fields['instagram'] = __('Instagram', 'sleek_child');
	$fields['linkedin'] = __('LinkedIn', 'sleek_child');
	$fields['googleplus'] = __('Google+', 'sleek_child');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek_child');
	$fields['github'] = __('GitHub', 'sleek_child');

	return $fields;
}); */

###################
# Allow SVG uploads
/* add_action('upload_mimes', function ($file_types) {
	$file_types['svg'] = 'image/svg+xml';

	return $file_types;
}); */

###############################
# Add custom fields to rest API
# NOTE: Add more post types and fields as needed
add_action('rest_api_init', function () {
	register_rest_field(['page', 'post'], 'custom_fields', ['get_callback' => function ($post) {
		return get_post_custom($post['id']);
	}]);

	register_rest_field(['page'], 'modules_below_content', ['get_callback' => function ($post) {
		return get_field('modules_below_content', $post['id']);
	}]);
});

##########################################################
# Add a "post_type" argument to get_terms() if you need it
# add_filter('terms_clauses', 'sleek_terms_clauses', 10, 3);

##################################
# Require login on the entire site
/* add_action('init', function () {
	if (!defined('WP_CLI') and !is_admin() and !sleek_is_login_page() and !is_user_logged_in()) {
		auth_redirect();
	}
}); */

########################
# Set up for translation
# NOTE: Put your mo/po-files in the /languages directory
add_action('after_setup_theme', function () {
	load_child_theme_textdomain('sleek_child', get_stylesheet_directory() . '/languages');

	# If you want to override parent theme translations, add them to languages/sleek/lang_Code.po and uncomment this:
	# load_theme_textdomain('sleek', get_stylesheet_directory() . '/languages/sleek');
});
