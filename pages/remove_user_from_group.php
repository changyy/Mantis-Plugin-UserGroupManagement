<?php
if (!access_has_global_level( config_get( 'manage_user_threshold' ) ))
	exit;
if (isset($_REQUEST['uid']) && isset($_REQUEST['gid'])) {
	$SQL = 'DELETE FROM `'.plugin_table('mapping')."` WHERE `uid`='".$_REQUEST['uid']."' AND gid='".$_REQUEST['gid']."'";
	db_query_bound($SQL);
	print_header_redirect('manage_user_edit_page.php?user_id='.$_REQUEST['uid']);
}
