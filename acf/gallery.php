<?php
return [
	[
		'name' => 'gallery-title',
		'label' => __('Title', 'sleek_child'),
		'instructions' => __('Enter a title to display above the gallery.', 'sleek_child'),
		'type' => 'text'
	],
	[
		'name' => 'gallery-description',
		'label' => __('Description', 'sleek_child'),
		'instructions' => __('Enter a description for the gallery.', 'sleek_child'),
		'type' => 'wysiwyg'
	],
	[
		'name' => 'gallery-images',
		'label' => __('Images', 'sleek_child'),
		'instructions' => __('Select any number of images.', 'sleek_child'),
		'type' => 'gallery'
	]
];
