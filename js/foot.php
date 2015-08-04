<?php
# If you want to ignore certain files
# $ignore = array('foot-2-image-zoom.js', 'foot-2-live-search.js');
$ignore = array();

# We'd like to know this
error_reporting(E_ALL);
ini_set('display_errors', true);

# Set header and include packer
header('Content-type: application/x-javascript');

require_once 'JavaScriptPacker.php';

# Start building code
$code = '';

# From SleekWP
foreach (glob('../../sleek/js/foot-*.js') as $file) {
	if (!in_array(basename($file), $ignore)) {
		$code .= file_get_contents($file);
	}
}

# From our theme
foreach (glob('foot-*.js') as $file) {
	if (!in_array(basename($file), $ignore)) {
		$code .= file_get_contents($file);
	}
}

# Pack it
$packer = new JavaScriptPacker($code, 0);
$code = $packer->pack();

# Print it
echo $code;

# Cache it
file_put_contents(dirname(__FILE__) . '/foot.js', $code);
