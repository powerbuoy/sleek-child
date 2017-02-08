<?php
# Include the buttons group :D
$buttonsGroup = include get_stylesheet_directory() . '/acf/buttons.php';

return [
	[
		'name' => 'text-content-title',
		'label' => __('Title', 'sleek_child'),
		'type' => 'text'
	],
	[
		'name' => 'text-content-image',
		'label' => __('Image', 'sleek_child'),
		'type' => 'image',
		'return_format' => 'array'
	],
	[
		'name' => 'text-content-content',
		'label' => __('Content', 'sleek_child'),
		'type' => 'wysiwyg'
	],
	[
		'name' => 'text-content-buttons',
		'label' => __('Buttons', 'sleek_child'),
		'type' => 'repeater',
		'button_label' => __('Add a button', 'sleek_child'),
		'sub_fields' => $buttonsGroup[0]['sub_fields']
	]
];
