<?php
# Some config
define('RECAPTCHA_SITE_KEY', false);
define('RECAPTCHA_SECRET', false);
define('DISQUS_SHORTNAME', false);
define('GOOGLE_ANALYTICS', false);

# Register our CSS and JS - parent Sleek doesn't register anything
add_action('wp_enqueue_scripts', 'sleek_child_register_css_js');

function sleek_child_register_css_js () {
	# No need for jQuery 2015 :D
	wp_deregister_script('jquery');

	# Theme Head/Foot JS
	if (WP_DEBUG) {
		wp_register_script('sleek_head', get_stylesheet_directory_uri() . '/js/head.php', array(), null);
		wp_register_script('sleek_foot', get_stylesheet_directory_uri() . '/js/foot.php', array(), null, true);
	}
	else {
		wp_register_script('sleek_head', get_stylesheet_directory_uri() . '/js/head.' . filemtime(get_stylesheet_directory() . '/js/head.js') . '.js', array(), null);
		wp_register_script('sleek_foot', get_stylesheet_directory_uri() . '/js/foot.' . filemtime(get_stylesheet_directory() . '/js/foot.js') . '.js', array(), null, true);
	}

	wp_enqueue_script('sleek_head');
	wp_enqueue_script('sleek_foot');

	# Theme CSS
	wp_register_style('sleek_child', get_stylesheet_directory_uri() . '/css/all.' . filemtime(get_stylesheet_directory() . '/css/all.css') . '.css', array(), null);
	wp_enqueue_style('sleek_child');
}

# Thumbnails sizes
# add_action('init', 'sleek_child_post_thumbnails');

function sleek_child_post_thumbnails () {
	add_image_size('sleek-child-small', 120, 120, true);
	add_image_size('sleek-child-hd', 1920, 1080, true);
}

# Sidebars
add_action('init', 'sleek_child_register_sidebars');

function sleek_child_register_sidebars () {
	sleek_register_sidebars(array(
		'aside'		=> 'Aside', 
		'header'	=> 'Header', 
		'footer'	=> 'Footer'
	));
}

# Custom post types and taxonomies
# add_action('init', 'sleek_child_register_post_types');

function sleek_child_register_post_types () {
	sleek_register_post_types(
		# Post types (slug => description)
		array(
			'movies' => 'My movie collection', 
			'directors' => 'My favorite directors.'
		), 

		# Taxonomies and which post types they belong to
		array(
			'genres' => array('movies'), 
			'countries' => array('directors', 'movies')
		), 

		# Translation textdomain (for URLs)
		'sleek_child'
	);
}

# Short codes
# add_action('init', 'sleek_child_register_shortcodes');

function sleek_child_register_shortcodes () {
	# Include - include any module through [include mod=random-testimonial]
	add_shortcode('include', 'sleek_shortcode_include_module');

	# Get Posts short code, see sleek/inc/get-posts.php for details
	# add_shortcode('get-posts', 'sleek_shortcode_get_posts');

	# MarkdownFile
	# add_shortcode('markdown-file', 'sleek_shortcode_markdown_file');
}

# Add some fields to users
# add_filter('user_contactmethods', 'sleek_child_add_user_fields');

function sleek_child_add_user_fields () {
	$fields['googleplus'] = __('Google+', 'sleek');
	$fields['stackoverflow'] = __('StackOverflow', 'sleek');
	$fields['github'] = __('GitHub', 'sleek');

	return $fields;
}

# Set up for translation (put your mo/po-files in your-theme/lang/ and uncomment this)
# add_action('after_setup_theme', 'sleek_child_setup_lang');

function sleek_child_setup_lang () {
	load_theme_textdomain('sleek_child', get_stylesheet_directory() . '/lang');
}

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
# add_action('init', 'sleek_remove_emoji_css_js');

# Disable jQuery NoConflict
# add_action('wp_head', 'sleek_disable_jquery_noconflict');
