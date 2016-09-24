<?php
/**
 * Register thumbnail sizes
 */
/* add_action('after_setup_theme', function () {
	add_image_size('sleek-small', 120, 120, ['center', 'top']);
	add_image_size('sleek-hd', 1920, 1080, ['center', 'top']);
}); */

/**
 * Register sidebars
 */
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

/**
 * Register custom post types and taxonomies
 */
/* $postTypes = ['movies', 'directors'];

add_action('init', function () use ($postTypes) {
	# Post types
	sleek_register_post_types($postTypes, 'sleek_child');

	# Taxonomies
	sleek_register_taxonomies([
		'genres' => ['movies'],
		'countries' => ['movies', 'directors']
	], 'sleek_child');

	# Array of CPTs that should appear in search (on top of post/page)
	# (run this function unless you want all your CPTs to appear)
	sleek_set_cpt_in_search(['movies']);
}); */

# Add meta data (title, description, image) to CPTs
/* add_action('admin_menu', function () use ($postTypes) {
	sleek_register_post_type_meta_data($postTypes, 'nexus');
}); */

# Give attachments an archive and make attachment taxonomy archives work
add_action('init', function () {
	sleek_attachment_archives(__('url_attachments', 'sleek_child'), []); # Pass in any potential attachment taxonomies as the last array to enable taxonomy archives
});

/**
 * Register ACF
 */
# Hide ACF from admin altogether
# add_filter('acf/settings/show_admin', '__return_false');

# Use these fields (add your fields to acf/my-group.definition.php)
/* add_action('acf/init', function () {
	sleek_register_acf([
		'my_group' => ['movies'] # Second argument can be array of post types or normal ACF location definition
	]);
}); */

/**
 * Allow svg etc uploads
 */
/* add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['eps'] = 'application/postscript';

	return $mimes;
}); */

/**
 * Give editors access to theme options
 */
/* $editorRole = get_role('editor');

if (!$editorRole->has_cap('edit_theme_options')) {
	$editorRole->add_cap('edit_theme_options');
}

if (!$editorRole->has_cap('manage_options')) {
	$editorRole->add_cap('manage_options');
} */

/**
 * Register CSS and JS
 */
add_action('init', function () {
	sleek_register_assets(); # Pass in more as only argument; ['https://fonts.googleapis.com/css?family=Lato:300,900']
});

/**
 * Add optional shortcodes provided by SleekWP
 *
 * TODO: Move to individual plugins
 */
/* add_action('init', function () {
	# Include - include any module through [include mod=random-testimonial] (TODO: Change to get_template_part (but still allow arguments?))
	# add_shortcode('include', 'sleek_shortcode_include_module');

	# MarkdownFile
	# add_shortcode('markdown-file', 'sleek_shortcode_markdown_file');

	# Hubspot form
	# add_shortcode('hubspot-form', 'sleek_hubspot_form');
}); */

/**
 * Add more fields to users
 */
/* add_filter('user_contactmethods', function () {
	$fields['googleplus'] = __('Google+', 'sleek_child');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek_child');
	$fields['github'] = __('GitHub', 'sleek_child');

	return $fields;
}); */

/**
 * Set up for translation (put your mo/po-files in your-theme/languages/)
 */
add_action('after_setup_theme', function () {
	load_child_theme_textdomain('sleek_child', get_stylesheet_directory() . '/languages');

	# If you want to override parent theme translations, add them to languages/sleek/lang_Code.po
	# load_theme_textdomain('sleek', get_stylesheet_directory() . '/languages/sleek');
});

/**
 * These are optional hacks to improve how WP normally does things
 */
# Remove WPMU signup stylesheet
/* add_action('get_header', function () {
	remove_action('wp_head', 'wpmu_signup_stylesheet');
}); */

# Give pages excerpts
# add_action('init', 'sleek_add_excerpts_to_pages');

# Disable WP Embed
add_action('wp_enqueue_scripts', 'sleek_disable_wp_embed');

# Adds a Browser Update script for older browsers
# add_action('wp_head', 'sleek_register_browser_update_js');

# Allow shortcodes in Widgets
# add_action('init', 'sleek_allow_shortcodes_in_widgets');

# Cleanup HEAD
add_action('init', 'sleek_cleanup_head');

# Move jQuery to bottom of page + include from CDN
add_action('wp_enqueue_scripts', 'sleek_enqueue_jquery_cdn_in_footer');

# Allow Markdown in excerpts and ACF
# add_action('init', 'sleek_more_markdown');

# Add open graph tags to posts (unless Yoast SEO is in use)
# add_action('wp_head', 'sleek_open_graph_tags');

# Remove Emoji CSS/JS from head added since WP 4.2.2
add_action('init', 'sleek_remove_emoji_css_js');

# Disable CF7 CSS and/or JS
# add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

# Add an "active-parent" class to archive pages when browsing their taxonomies
add_filter('nav_menu_css_class', 'sleek_active_archive_link_on_taxonomies', 10, 2);

# Allow a 'post_type' => [] argument in get_terms()
add_filter('terms_clauses', 'sleek_terms_clauses', 10, 3);

# Add placeholders to comment form
add_filter('comment_form_defaults', 'sleek_comment_form_placeholders');

# Disable Ultimate Post Widget CSS
add_filter('upw_enqueue_styles', '__return_false');

# Excludes the currently viewed post in UPW
# add_filter('upw_wp_query_args', 'sleek_exclude_current_post_in_upw');

# Allow HTML in Widget Titles (with [tags])
# add_filter('widget_title', 'sleek_html_in_widget_titles');

# Remove HOME from Yoast Breadcrumbs
# add_filter('wpseo_breadcrumb_links', 'sleek_remove_home_from_breadcrumb');

# Show all posts (ignore posts_per_page setting) when browsing custom post types
# add_filter('pre_get_posts', 'sleek_show_all_cpt_posts');

# Show all post types when browsing author
# add_filter('pre_get_posts', 'sleek_show_all_post_types_for_authors');

# Remove .current_page_parent from Blog-page when viewing another archive
add_filter('nav_menu_css_class', 'sleek_unset_active_blog_class', 10, 2);
