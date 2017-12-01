<?php
require_once get_stylesheet_directory() . '/inc/add-youtube-args.php';
require_once get_stylesheet_directory() . '/inc/add-editor-styles.php';

######################################
# Modify WP's built in thumbnail sizes
add_action('after_setup_theme', function () {
	# (this prevents user's from overriding them inside the  admin - remove if you _want_ users to override your sizes)
	# Also note that all sizes should maintain the same aspect ratio otherwise WP will not add a srcset attribute
	update_option('thumbnail_size_w', 600);
	update_option('thumbnail_size_h', 338);
	update_option('thumbnail_crop', 1);

	update_option('medium_size_w', 900);
	update_option('medium_size_h', 506);
	update_option('medium_crop', 1);

	update_option('medium_large_size_w', 1200);
	update_option('medium_large_size_h', 675);
	update_option('medium_large_crop', 1);

	update_option('large_size_w', 1800);
	update_option('large_size_h', 1013);
	update_option('large_crop', 1);

	# Now set the sizes again so we can specify our own crop (note that if you only use this (and remove the above) users can still change the size in the admin)
	add_image_size('thumbnail', 600, 338, ['center', 'center']);
	add_image_size('medium', 900, 506, ['center', 'center']);
	add_image_size('medium_large', 1200, 675, ['center', 'center']);
	add_image_size('large', 1800, 1013, ['center', 'center']);

	# Add our own sizes if needed (you should probably add thumbnail, medium and large version of all your custom sizes so srcset works for them too)
#	add_image_size('thumbnail_portrait', 338, 600, ['center', 'center']);
#	add_image_size('medium_portrait', 506, 900, ['center', 'center']);
#	add_image_size('medium_large_portrait', 675, 1200, ['center', 'center']);
#	add_image_size('large_portrait', 1013, 1800, ['center', 'center']);

#	add_image_size('thumbnail_square', 600, 600, ['center', 'center']);
#	add_image_size('medium_square', 900, 900, ['center', 'center']);
#	add_image_size('medium_large_square', 1200, 1200, ['center', 'center']);
#	add_image_size('large_square', 1800, 1800, ['center', 'center']);
});

# Also add our own sizes to the image-size dropdown in the admin if you want
/* add_filter('image_size_names_choose', function ($sizes) {
	return array_merge($sizes, [
		'medium_portrait' => __('Thumbnail (portrait)', 'sleek_child'),
		'medium_square' => __('Thumbnail (square)', 'sleek_child')
	]);
}); */

###########################################
# Register custom post types and taxonomies
# NOTE: This can be an associative array if you need to override default post type config
$postTypes = ['movie', 'director' => [
	'description' => __('A list of famous film directors', 'sleek_child')
]];

add_action('init', function () use ($postTypes) {
	# Post types
#	sleek_register_post_types($postTypes, 'sleek_child');

	# Taxonomies
/*	sleek_register_taxonomies([
		'genre' => ['movie'],
		'country' => ['movie', 'director']
	], 'sleek_child'); */

	# Array of CPTs that should appear in search (on top of post/page)
	# NOTE: Run this function unless you want all your CPTs to appear in search
	# sleek_set_cpt_in_search(['movie']);
});

###################################################
# Create archive meta data pages for our post types
# NOTE: You can add more fields to these pages using the "${postType}-archive-data" key
/* add_action('acf/init', function () use ($postTypes) {
	sleek_archive_meta_data($postTypes);
}); */

########################
# 404 certain post types
add_filter('template_redirect', function () {
	global $wp_query;

	# NOTE: Add custom post types here as needed (is_singular('office') etc...)
	if (is_attachment()) {
		status_header(404); # Sets 404 header
		$wp_query->set_404(); # Shows 404 template
	}
});

##############
# Register ACF
# Hide ACF from admin altogether (to prevent users from adding ACF from there)
add_filter('acf/settings/show_admin', '__return_false');

# Register fields
add_action('acf/init', function () {
	# Add an options page
/*	acf_add_options_page([
		'page_title' => __('Theme settings', 'sleek_child'),
		'menu_slug' => 'theme-settings',
		'post_id' => 'theme-settings' # NOTE: Use this id in get_field('my-field', 'theme-settings')
	]); */

	# Add some fields to the options page
/*	sleek_acf([
		'key' => 'should-be-unique',
		'title' => __('Theme settings', 'sleek_child'),
		'location' => [[[
			'param' => 'options_page',
			'operator' => '==',
			'value' => 'theme-settings'
		]]],
		'fields' => [
			'contact-form'
		]
	]); */

	# Add more fields to the archive options page for movies
/*	sleek_acf([
		'key' => 'unique-key',
		'title' => __('Archive options', 'sleek_child'),
		'location' => [[[
			'param' => 'options_page',
			'operator' => '==',
			'value' => 'movie-archive-data'
		]]],
		'fields' => [
			'contact-form'
		]
	]); */

	# Add ACF to a flexible content field named "after-page-content"
	# NOTE: Render these fields using sleek_acf_render_modules('after-page-content')
	sleek_acf([
		'key' => 'must-be-unique',
		'title' => __('Modules', 'sleek_child'),
		'flexible' => true,
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'page'
		]]],
		'fields' => [
			'below-content' => ['text-block', 'text-blocks', 'post-list', 'latest-posts', 'child-pages', 'sibling-pages', 'users', 'video', 'instagram', 'contact-form', 'hubspot-form', 'hubspot-cta', 'google-map', 'gallery', 'divider'],
			'next-to-content' => ['page-menu', 'text-block', 'video', 'contact-form', 'attachments'],
			'inside-hero' => ['buttons']
		]
	]);

	# Add fixed ACF fields to the sidebar
/*	sleek_acf([
		'key' => 'must-also-be-unique',
		'title' => __('Page options', 'sleek_child'),
		'position' => 'side',
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'page'
		]]],
		'fields' => [
			'redirect-url'
		]
	]); */

	# Add fixed, tabbed ACF fields below the editor
	sleek_acf([
		'key' => 'must-be-unique-too',
		'title' => __('Page options', 'sleek_child'),
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'page'
		]]],
		'fields' => [
			# NOTE: Nested arrays create tabs
			__('Hero', 'sleek_child') => [
				'video-hero'
			]
		]
	]);

	# Add a single field below the title
/*	sleek_acf([
		'key' => 'yea-this-also-needs-to-be-unique',
		'title' => __('Subtitle'),
		'position' => 'acf_after_title',
		'layout' => 'seamless',
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'page'
		]]],
		'fields' => [
			'subtitle'
		]
	]); */
});

#####################
# Register CSS and JS
# (automatically adds dist/all.css and dist/all.js which are generated by Gulp)
add_action('wp_enqueue_scripts', function () {
	sleek_register_assets(['https://fonts.googleapis.com/css?family=Open+Sans:300,300i,600']); # Pass in more as array: ['https://fonts.googleapis.com/css?family=Lato:300,900|Roboto:900']
});

###################
# Register sidebars
add_action('init', function () {
	sleek_register_sidebars([
		'header' => __('Header', 'sleek_child'),
		'footer' => __('Footer', 'sleek_child')
	]);
});

##############################################################
# Add more options to Appearance -> Customize -> Theme Options
# (then use your options with get_theme_mod('option_name') any way you like)
# NOTE: You may want to add these types of fields to an ACF options page instead
/* add_action('customize_register', function ($wpCustomize) {
	sleek_register_theme_options($wpCustomize, [
		'hubspot_portal_id' => 'text'
	], 'sleek_child');
});

add_action('wp_head', function () {
	# HubSpot tracking code
	if ($hsId = get_theme_mod('hubspot_portal_id')) {
		echo '<!-- Start of Async HubSpot Analytics Code -->
			<script type="text/javascript">
				(function(d,s,i,r) {
				if (d.getElementById(i)){return;}
				var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
				n.id=i;n.src=\'//js.hs-analytics.net/analytics/\'+(Math.ceil(new Date()/r)*r)+\'/' . $hsId . '.js\';
				e.parentNode.insertBefore(n, e);
				})(document,"script","hs-analytics",300000);
			</script>
			<!-- End of Async HubSpot Analytics Code -->';
	}
}); */

##########################
# Add more fields to users
/* add_filter('user_contactmethods', function () {
	$fields['job_title'] = __('Job title', 'sleek_child');
	$fields['tel'] = __('Telephone', 'sleek_child');
	$fields['facebook'] = __('Facebook', 'sleek_child');
	$fields['twitter'] = __('Twitter', 'sleek_child');
	$fields['instagram'] = __('Instagram', 'sleek_child');
	$fields['linkedin'] = __('LinkedIn', 'sleek_child');
	$fields['googleplus'] = __('Google+', 'sleek_child');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek_child');
	$fields['github'] = __('GitHub', 'sleek_child');

	return $fields;
}); */

#################
# Shorter excerpt
add_filter('excerpt_length', function () {
	return 25;
});

add_filter('excerpt_more', function () {
	return ' /../';
});

###############################
# Add custom fields to rest API
# NOTE: Add more post types here as needed
add_action('rest_api_init', function () {
	register_rest_field(['page', 'post'], 'custom_fields', ['get_callback' => function () {
		return get_post_custom($post['id']);
	}]);
});

##########################################################
# Add a "post_type" argument to get_terms() if you need it
# add_filter('terms_clauses', 'sleek_terms_clauses', 10, 3);

####################################################
# Enable search inside custom fields (including ACF)
# require_once get_template_directory() . '/inc/include-postmeta-in-search.php';

##################################
# Require login on the entire site
/* add_action('init', function () {
	if (!is_admin() and !sleek_is_login_page() and !is_user_logged_in()) {
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
