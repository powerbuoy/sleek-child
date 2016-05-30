<?php
/**
 * Some config (TODO: Move to Theme Options)
 */
define('RECAPTCHA_SITE_KEY', false);
define('RECAPTCHA_SECRET', false);
define('DISQUS_SHORTNAME', false);
define('GOOGLE_ANALYTICS', false);

/**
 * Register thumbnail sizes
 */
# add_action('after_setup_theme', 'sleek_child_post_thumbnails');

function sleek_child_post_thumbnails () {
	add_image_size('sleek-small', 120, 120, array('center', 'top'));
	add_image_size('sleek-hd', 1920, 1080, array('center', 'top'));
}

/**
 * Register sidebars
 */
# add_action('init', 'sleek_child_register_sidebars');

function sleek_child_register_sidebars () {
	sleek_register_sidebars(array(
		'aside'		=> array(
			'name' => __('Aside', 'sleek_child'),
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		),
		'header'	=> __('Header', 'sleek_child'),
		'footer'	=> __('Footer', 'sleek_child')
	));
}

/**
 * Register custom post types and taxonomies
 */
# add_action('init', 'sleek_child_register_post_types_and_taxonomies');

function sleek_child_register_post_types_and_taxonomies () {
	sleek_register_post_types(array(
		'movies' => __('My movie collection', 'sleek_child'),
		'directors' => __('My favorite directors', 'sleek_child')
	), 'sleek_child');

	sleek_register_taxonomies(array(
		'genres' => array('movies'),
		'countries' => array('movies', 'directors')
	), 'sleek_child');
}

/**
 * Register CSS and JS
 *
 * TODO: Move to Sleek? (at least all.css/all.js?)
 */
add_action('wp_enqueue_scripts', 'sleek_child_register_css_js');

function sleek_child_register_css_js () {
	# Theme JS
	wp_register_script('sleek_child', get_stylesheet_directory_uri() . '/dist/all.js?v=' . filemtime(get_stylesheet_directory() . '/dist/all.js'), array('jquery'), null, true);
	wp_enqueue_script('sleek_child');

	# Google Webfonts
	# wp_register_style('sleek_child_font_lato', 'https://fonts.googleapis.com/css?family=Lato:300,900');
	# wp_enqueue_style('sleek_child_font_lato');

	# Theme CSS
	wp_register_style('sleek_child', get_stylesheet_directory_uri() . '/dist/all.css?v=' . filemtime(get_stylesheet_directory() . '/dist/all.css'), array(), null);
	wp_enqueue_style('sleek_child');
}

/**
 * Add optional shortcodes provided by SleekWP
 *
 * TODO: Move to individual plugins
 */
# add_action('init', 'sleek_child_register_shortcodes');

function sleek_child_register_shortcodes () {
	# Include - include any module through [include mod=random-testimonial] (TODO: Change to get_template_part (but still allow arguments?))
	# add_shortcode('include', 'sleek_shortcode_include_module');

	# MarkdownFile
	# add_shortcode('markdown-file', 'sleek_shortcode_markdown_file');

	# Hubspot form
	# add_shortcode('hubspot-form', 'sleek_hubspot_form');
}

/**
 * Add more fields to users
 */
# add_filter('user_contactmethods', 'sleek_child_add_user_fields');

function sleek_child_add_user_fields () {
	$fields['googleplus'] = __('Google+', 'sleek_child');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek_child');
	$fields['github'] = __('GitHub', 'sleek_child');

	return $fields;
}

/**
 * Set up for translation (put your mo/po-files in your-theme/lang/)
 */
add_action('after_setup_theme', 'sleek_child_setup_lang');

function sleek_child_setup_lang () {
	load_child_theme_textdomain('sleek_child', get_stylesheet_directory() . '/lang');
}

/**
 * These are optional actions to improve how WP normally does things
 */
# Give pages excerpts
# add_action('init', 'sleek_add_excerpts_to_pages');

# Add a favicon.ico if it exists in the theme directory
add_action('wp_head', 'sleek_add_favicon');

# Disable WP Embed
add_action('wp_enqueue_scripts', 'sleek_disable_wp_embed');

# Adds a Browser Update script for older browsers
# add_action('wp_head', 'sleek_register_browser_update_js');

# Allow shortcodes in Widgets
# add_action('init', 'sleek_allow_shortcodes_in_widgets');

# Cleanup HEAD
add_action('init', 'sleek_cleanup_head');

# Disable WP Embed
add_action('init', 'sleek_disable_wp_embed', 999);

# Move jQuery to bottom of page + include from CDN
add_action('wp_enqueue_scripts', 'sleek_enqueue_jquery_cdn_in_footer');

# Allow Markdown in excerpts and ACF
# add_action('init', 'sleek_more_markdown');

# Add open graph tags to posts
# add_action('wp_head', 'sleek_open_graph_tags');

# Remove Emoji CSS/JS from head added since WP 4.2.2
add_action('init', 'sleek_remove_emoji_css_js');

/**
 * These are optional filters to improve how WP normally does things
 */
# Disable CF7 CSS
# add_filter('wpcf7_load_js', '__return_false');
# add_filter('wpcf7_load_css', '__return_false');

# Add an "active-parent" class to archive pages when browsing their taxonomies
add_filter('nav_menu_css_class', 'sleek_active_archive_link_on_taxonomies', 10, 2);

# Allow SVG Uploads
# add_filter('upload_mimes', 'sleek_allow_svg_uploads');

# Add placeholders to comment form
add_filter('comment_form_defaults', 'sleek_comment_form_placeholders');

# Disable Ultimate Post Widget CSS
# add_filter('upw_enqueue_styles', 'sleek_disable_upw_styles');

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
# add_filter('nav_menu_css_class', 'sleek_unset_active_blog_class', 10, 2);
