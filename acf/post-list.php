<?php
return [
	[
		'name' => 'post-list-title',
		'label' => __('Title', 'sleek_child'),
		'instructions' => __('Enter a title above the list of posts.', 'sleek_child'),
		'type' => 'text'
	],
	[
		'name' => 'post-list-description',
		'label' => __('Description', 'sleek_child'),
		'instructions' => __('Enter a description for the posts here.', 'sleek_child'),
		'type' => 'wysiwyg'
	],
	[
		'name' => 'post-list-posts',
		'label' => __('Posts', 'sleek_child'),
		'instructions' => __('Add any number of posts here.', 'sleek_child'),
		'type' => 'relationship'
	]
];
