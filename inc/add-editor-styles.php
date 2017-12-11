<?php
# Add editor style
add_editor_style();

# Add the styleselect dropdown
add_filter('mce_buttons_2', function ($buttons) {
	array_unshift($buttons, 'styleselect');

	return $buttons;
});

# Add some stuff to the Format dropdown
add_filter('tiny_mce_before_init', function ($settings) {
	# Allow empty spans
	$settings['extended_valid_elements'] = '#span[*]';

	# Keep the built-in WP styles
	$settings['style_formats_merge'] = true;

	# Get a list of all icons
	$icons = file_get_contents(get_stylesheet_directory() . '/icons.json');
	$icons = json_decode($icons, true);
	$items = [];

	foreach ($icons['glyphs'] as $icon) {
		$items[] = [
			'title' => ucfirst(str_replace(['-', '_'], ' ', $icon['css'])),
			'inline' => 'span',
			'classes' => 'icon-' . $icon['css']
		];
	}

	$settings['style_formats'] = json_encode([
		# Add a button style
		[
			'title' => __('Button', 'sleek_child'),
			'selector' => 'a',
			'classes' => 'button'
		],
		# And an icons dropdown
		[
			'title' => __('Icons', 'sleek_child'),
			'items' => $items
		]
	]);

	return $settings;
});
