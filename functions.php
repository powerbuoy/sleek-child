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
	sleek_set_cpt_in_search(['movie']);
}); */

# Add meta data (title, description, image) to CPTs
/* add_action('admin_menu', function () use ($postTypes) {
	sleek_register_post_type_meta_data($postTypes, 'sleek_child', ['subtitle' => 'text']); // Pass in more fields as last argument
}); */

# Register ACF
# Hide ACF from admin altogether (to prevent people from adding ACF)
# add_filter('acf/settings/show_admin', '__return_false');

# Use these fields (add your fields to acf/my-group.definition.php)
/* add_action('acf/init', function () {
	sleek_register_acf([
		'my_group' => ['movie'] # Second argument can be array of post types or normal ACF location definition
	]);
}); */

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
/* add_action('customize_register', function ($wpCustomize) {
	sleek_register_theme_options($wpCustomize, [
		'hubspot_portal_id' => 'text',
		'hubspot_vacancies_form_id' => 'text'
	], 'sleek_child');
}); */

# Give attachments an archive and make attachment taxonomy archives work
/* add_action('init', function () {
	sleek_attachment_archives(__('url_attachment', 'sleek_child'), []); # Pass in any potential attachment taxonomies (image_category for example) as the last array to enable taxonomy archives
}); */

# Allow svg etc uploads
/* add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['eps'] = 'application/postscript';

	return $mimes;
}); */

# Give editors access to theme options
/* $editorRole = get_role('editor');

if (!$editorRole->has_cap('edit_theme_options')) {
	$editorRole->add_cap('edit_theme_options');
}

if (!$editorRole->has_cap('manage_options')) {
	$editorRole->add_cap('manage_options');
} */

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

# Allow shortcodes in Widgets
/* add_action('init', function () {
	add_filter('widget_text', 'do_shortcode');
}); */

# Set up for translation (put your mo/po-files in your-theme/languages/)
add_action('after_setup_theme', function () {
	load_child_theme_textdomain('sleek_child', get_stylesheet_directory() . '/languages');

	# If you want to override parent theme translations, add them to languages/sleek/lang_Code.po
	# load_theme_textdomain('sleek', get_stylesheet_directory() . '/languages/sleek');
});

# Remove a bunch of unwanted CSS/JS added by WP and plug-ins
add_action('init', function () {
	sleek_reduce_requests();
});

# Move jQuery to bottom of page + include from CDN
add_action('wp_enqueue_scripts', 'sleek_enqueue_jquery_cdn_in_footer');

# Add an "active-parent" class to archive pages when browsing their taxonomies
add_filter('nav_menu_css_class', 'sleek_active_archive_link_on_taxonomies', 10, 2);

# Allow a 'post_type' => [] argument in get_terms()
add_filter('terms_clauses', 'sleek_terms_clauses', 10, 3);

# Add placeholders to comment form
add_filter('comment_form_defaults', 'sleek_comment_form_placeholders');

# Remove .current_page_parent from Blog-page when viewing another archive
add_filter('nav_menu_css_class', 'sleek_unset_active_blog_class', 10, 2);

# Allow HTML in Widget Titles (with [tags])
# add_filter('widget_title', 'sleek_html_in_widget_titles');

# Allow Markdown in excerpts and ACF
# add_action('init', 'sleek_more_markdown');
