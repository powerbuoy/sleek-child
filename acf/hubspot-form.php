<?php
return [
	[
		'name' => 'hubspot-form-title',
		'label' => __('Title', 'sleek_child'),
		'instructions' => __('Enter a title to display above the form.', 'sleek_child'),
		'type' => 'text'
	],
	[
		'name' => 'hubspot-form-description',
		'label' => __('Description', 'sleek_child'),
		'instructions' => __('Enter a description for the form.', 'sleek_child'),
		'type' => 'wysiwyg'
	],
	[
		'name' => 'hubspot-form-id',
		'label' => __('Form ID', 'sleek_child'),
		'instructions' => __('Enter the Hubspot Form ID here.', 'sleek_child'),
		'type' => 'text',
		'required' => true
	]
];
