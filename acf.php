<?php
# Add your ACF Field Groups here
# https://www.advancedcustomfields.com/resources/register-fields-via-php/
/* add_action('acf/init', function () {
	# Address
	acf_add_local_field_group([
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
				'key' => 'subtitle',
				'name' => 'subtitle',
				'label' => __('Subtitle', 'sleek_child'),
				'type' => 'text'
			]
		]
	]);
}); */
