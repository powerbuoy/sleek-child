<?php
# Add editor style
add_editor_style();

add_filter('mce_buttons_2', function ($buttons) {
	array_unshift($buttons, 'styleselect');

	return $buttons;
});

add_filter('tiny_mce_before_init', function ($settings) {
	$settings['style_formats_merge'] = true;
	$settings['style_formats'] = json_encode([
		[
			'title' => __('Button', 'telecoaching'),
			'selector' => 'a',
			'classes' => 'button'
		]
	]);

	return $settings;
});
