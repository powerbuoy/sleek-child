<?php
# TODO: Add Button Icon-dropdown (and grab icons from icons.json if it exists)
# TODO: Parse config.scss (if it exists) for $button-colors and dynamically populate the button-color select

return [
	[
		'name' => 'buttons',
		'label' => __('Buttons', 'sleek_child'),
		'type' => 'repeater',
		'button_label' => __('Add a button', 'sleek_child'),
		'sub_fields' => [
			[
				'name' => 'button-title',
				'label' => __('Title', 'sleek_child'),
				'type' => 'text'
			],
			[
				'name' => 'button-url',
				'label' => __('URL', 'sleek_child'),
				'type' => 'text'
			],
			[
				'name' => 'button-color',
				'label' => __('Color', 'sleek_child'),
				'type' => 'select',
				'allow_null' => true,
				'choices' => [
					'white' => 'White',
					'black' => 'Black'
				]
			],
			[
				'name' => 'button-ghost',
				'label' => __('Ghost button', 'sleek_child'),
				'message' => __('Ghost button', 'sleek_child'),
				'type' => 'true_false'
			]
		]
	]
];
