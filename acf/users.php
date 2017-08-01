<?php
return [
	[
		'name' => 'users-title',
		'label' => __('Title', 'sleek_child'),
		'instructions' => __('Enter a title above the list of users.', 'sleek_child'),
		'type' => 'text'
	],
	[
		'name' => 'users-description',
		'label' => __('Description', 'sleek_child'),
		'instructions' => __('Enter a description for the posts users.', 'sleek_child'),
		'type' => 'wysiwyg'
	],
	[
		'name' => 'users-users',
		'label' => __('Users', 'sleek_child'),
		'instructions' => __('Add any number of users here.', 'sleek_child'),
		'type' => 'user',
		'multiple' => true,
		'allow_null' => false,
		'required' => true
	]
];
