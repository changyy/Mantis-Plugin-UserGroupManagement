<?php
if (!access_has_global_level( config_get( 'manage_user_threshold' ) ))
	exit;
if (isset($_REQUEST['gid']) && isset($_REQUEST['name']) ) {
	require plugin_file_path( 'api.php', plugin_get_current());
	$name = trim($_REQUEST['name']);
	$desc = isset($_REQUEST['description']) ? trim($_REQUEST['description']) : '';
	user_grouo_management_update_group($_REQUEST['gid'], $name , $desc);
}
print_successful_redirect(plugin_page('config', TRUE));
