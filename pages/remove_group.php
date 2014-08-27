<?php
if (!access_has_global_level( config_get( 'manage_user_threshold' ) ))
	exit;
if (isset($_REQUEST['gid'])) {
	require plugin_file_path( 'api.php', plugin_get_current());
	user_grouo_management_remove_group($_REQUEST['gid']);
}
print_successful_redirect(plugin_page('config', TRUE));
