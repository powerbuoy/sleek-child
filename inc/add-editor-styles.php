<?php
add_filter('tiny_mce_before_init', function ($settings) {
	$oldFormats = [];

	if (isset($settings['style_formats'])) {
		$oldFormats = json_decode($settings['style_formats']);
	}

	$newFormats = array_merge($oldFormats, [
		# Call to action
	/*	[
			'title' => __('Call to Action', 'invise'),
			'selector' => 'p',
			'classes' => 'cta'
		] */
	]);

	$settings['style_formats'] = json_encode($newFormats);

	return $settings;
}, 100);
