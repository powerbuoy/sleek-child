<?php
# Get list of all icons
$icons = file_get_contents(get_stylesheet_directory() . '/icons.json');
$icons = json_decode($icons, true);
$glyphs = [];

foreach ($icons['glyphs'] as $g) {
	$glyphs[$g['css']] = ucfirst(str_replace(['-', '_'], ' ', $g['css']));
}

# Parse config.scss (if it exists) for $button-colors and dynamically populate the button-color select
$configCss = file_get_contents(get_stylesheet_directory() . '/src/sass/config.scss');
$matches = false;
$colors = [];

preg_match('/\$button-colors: \((.*?)\)/s', $configCss, $matches);

if ($matches and count($matches) > 1) {
	$matches = preg_replace("/\r|\n/", '', $matches[1]);
	$matches = explode(',', $matches);

	foreach ($matches as $match) {
		$tmp = explode(':', $match);
		$color = trim(str_replace('"', '', $tmp[0]));
		$colors[$color] = ucfirst(str_replace('-', ' ', $color));
	}
}

return [
	[
		'name' => 'buttons',
		'label' => __('Buttons', 'sleek_child'),
		'instructions' => __('Add any number of buttons here.', 'sleek_child'),
		'button_label' => __('Add a button', 'sleek_child'),
		'type' => 'repeater',
		'sub_fields' => [
			[
				'name' => 'button-link',
				'label' => __('Link', 'sleek_child'),
				'instructions' => __('Choose where this button should link to.', 'sleek_child'),
				'type' => 'link',
				'required' => true
			],
			[
				'name' => 'button-color',
				'label' => __('Color', 'sleek_child'),
				'instructions' => __('Select a button color, or leave empty for the default button color.', 'sleek_child'),
				'type' => 'select',
				'allow_null' => true,
				'choices' => $colors
			],
			[
				'name' => 'button-ghost',
				'label' => __('Transparent button', 'sleek_child'),
				'instructions' => __('Check this if you want your button to be transparent.', 'sleek_child'),
				'message' => __('Transparent button', 'sleek_child'),
				'type' => 'true_false'
			],
			[
				'name' => 'button-icon',
				'label' => __('Icon', 'sleek_child'),
				'instructions' => __('Select an icon or leave empty for no icon.', 'sleek_child'),
				'type' => 'select',
				'allow_null' => true,
				'choices' => $glyphs
			]
		]
	]
];
