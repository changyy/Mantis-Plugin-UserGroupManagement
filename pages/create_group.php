<?php
if (!access_has_global_level( config_get( 'manage_user_threshold' ) ))
	exit;
if (isset($_REQUEST['name']) ) {
	$name = trim($_REQUEST['name']);
	$desc = isset($_REQUEST['description']) ? trim($_REQUEST['description']) : '';
	require plugin_file_path( 'api.php', plugin_get_current());
	user_grouo_management_create_group($name, $desc);
}
print_successful_redirect(plugin_page('config', TRUE));
