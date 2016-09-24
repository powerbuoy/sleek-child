<?php
return [
	'key' => 'my_group',
	'title' => __('My Group', 'sleek_child'),
	'position' => 'side',

	# Location
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			],
		],
	],

	# Fields
	'fields' => [
		# Page Subtitle
		[
			'key' => 'my_field',
			'name' => 'my_field',
			'label' => __('My field', 'sleek_child'),
			'type' => 'text'
		]
	]
];
