<?php
if (!access_has_global_level( config_get( 'manage_user_threshold' ) ))
	exit;
if (isset($_REQUEST['uid']) && isset($_REQUEST['gid']) && is_array($_REQUEST['gid']) && count($_REQUEST['gid']) ) {
	$group_list = array();
	foreach($_REQUEST['gid'] as $gid)
		array_push($group_list, "('".$_REQUEST['uid']."','".$gid."')");

	$SQL = 'INSERT INTO `'.plugin_table('mapping').'` (uid,gid) VALUES '.implode(",", $group_list);
	db_query_bound($SQL);
}
print_header_redirect('manage_user_edit_page.php?user_id='.$_REQUEST['uid']);
