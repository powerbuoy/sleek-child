<?php
$buttonsGroup = include get_stylesheet_directory() . '/acf/buttons.php';

return [
	[
		'name' => 'text-block-title',
		'label' => __('Title', 'sleek_child'),
		'instructions' => __('Enter a title for this text block.', 'sleek_child'),
		'type' => 'text'
	],
	[
		'name' => 'text-block-image',
		'label' => __('Image', 'sleek_child'),
		'instructions' => __('Select an image.', 'sleek_child'),
		'type' => 'image',
		'return_format' => 'id'
	],
	[
		'name' => 'text-block-description',
		'label' => __('Description', 'sleek_child'),
		'instructions' => __('Write a nice message here.', 'sleek_child'),
		'type' => 'wysiwyg'
	],
	[
		'name' => 'text-block-buttons',
		'label' => __('Buttons', 'sleek_child'),
		'instructions' => __('Add any number of buttons to this text block.', 'sleek_child'),
		'button_label' => __('Add a button', 'sleek_child'),
		'type' => 'repeater',
		'sub_fields' => $buttonsGroup[0]['sub_fields']
	]
];
