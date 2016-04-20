<?php
# Some config
define('RECAPTCHA_SITE_KEY', false);
define('RECAPTCHA_SECRET', false);
define('DISQUS_SHORTNAME', false);
define('GOOGLE_ANALYTICS', false);

# Thumbnails sizes
# add_action('after_setup_theme', 'sleek_child_post_thumbnails');

function sleek_child_post_thumbnails () {
	add_image_size('sleek-small', 120, 120, true);
	add_image_size('sleek-hd', 1920, 1080, true);
}

# Sidebars
# add_action('init', 'sleek_child_register_sidebars');

function sleek_child_register_sidebars () {
	sleek_register_sidebars(array(
		'aside'			=> __('Aside', 'sleek_child'),
		'header'		=> __('Header', 'sleek_child'),
		'footer'		=> __('Footer', 'sleek_child')
	));
}

# Custom post types and taxonomies
# add_action('init', 'sleek_child_register_post_types');

function sleek_child_register_post_types () {
	sleek_register_post_types(
		# Post types (slug => description)
		array(
			'movies' => __('My movie collection', 'sleek_child'),
			'directors' => __('My favorite directors', 'sleek_child')
		),

		# Taxonomies and which post types they belong to
		array(
			'genres' => array('movies'),
			'countries' => array('movies', 'directors')
		),

		# Translation textdomain (for URLs)
		'sleek_child'
	);
}

# Register our CSS and JS
add_action('wp_enqueue_scripts', 'sleek_child_register_css_js');

function sleek_child_register_css_js () {
	# Theme JS
	wp_register_script('sleek_child', get_stylesheet_directory_uri() . '/dist/all.js?v=' . filemtime(get_stylesheet_directory() . '/dist/all.js'), array('jquery'), null, true);
	wp_enqueue_script('sleek_child');

	# Theme CSS
	wp_register_style('sleek_child', get_stylesheet_directory_uri() . '/dist/all.css?v=' . filemtime(get_stylesheet_directory() . '/dist/all.css'), array(), null);
	wp_enqueue_style('sleek_child');
}

# Short codes
# add_action('init', 'sleek_child_register_shortcodes');

function sleek_child_register_shortcodes () {
	# Include - include any module through [include mod=random-testimonial]
	add_shortcode('include', 'sleek_shortcode_include_module');

	# Get Posts short code, see sleek/inc/get-posts.php for details
	add_shortcode('get-posts', 'sleek_shortcode_get_posts');

	# MarkdownFile
	# add_shortcode('markdown-file', 'sleek_shortcode_markdown_file');
}

# Add some fields to users
# add_filter('user_contactmethods', 'sleek_child_add_user_fields');

function sleek_child_add_user_fields () {
	$fields['googleplus'] = __('Google+', 'sleek_child');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek_child');
	$fields['github'] = __('GitHub', 'sleek_child');

	return $fields;
}

# Set up for translation (put your mo/po-files in your-theme/lang/ and uncomment this)
# add_action('after_setup_theme', 'sleek_child_setup_lang');

function sleek_child_setup_lang () {
	load_child_theme_textdomain('sleek_child', get_stylesheet_directory() . '/lang');
}

# Disable "single" pages for certain post types
# add_action('template_redirect', 'sleek_child_disable_single_post_types');

function sleek_child_disable_single_post_types () {
	sleek_disable_single_post_types(array('slides', 'employees', 'knowledge_base', 'testimonials', 'offices'));
}

# Show all posts when browsing custom post types
# add_filter('pre_get_posts', 'sleek_show_all_cpt_posts');

# Cleanup HEAD
add_action('init', 'sleek_cleanup_head');

# Allow Markdown in excerpts and advanced custom fields
# add_action('init', 'sleek_more_markdown');

# Upgrade Browser warning for old versions of IE etc
# add_action('wp_head', 'sleek_register_browser_update_js');

# Show all post types when browsing author
# add_filter('pre_get_posts', 'sleek_show_all_post_types_for_author');

# Remove HOME from Yoast Breadcrumbs
# add_filter('wpseo_breadcrumb_links', 'sleek_remove_home_from_breadcrumb');

# Give pages excerpts
# add_action('init', 'sleek_add_excerpts_to_pages');

# Remo Emoji CSS/JS from head
add_action('init', 'sleek_remove_emoji_css_js');

# Disable jQuery NoConflict
# add_action('wp_head', 'sleek_disable_jquery_noconflict');

# Move jQuery to bottom of page
add_action('wp_enqueue_scripts', 'sleek_enqueue_jquery_cdn_in_footer');

# Add OpenGraph
# add_action('wp_head', 'sleek_open_graph_tags');

# Add Favicon
add_action('wp_head', 'sleek_add_favicon');

# Add placeholders to comment form
add_filter('comment_form_defaults', 'sleek_comment_form_placeholders');

# Allow SVG Uploads
# add_filter('upload_mimes', 'sleek_allow_svg_uploads');
