<?php

function user_group_management_get_all_group() {
	$SQL = "SELECT gid, name, description FROM `".plugin_table("group")."`";
	$result = db_query($SQL);
	$list = array();
	for( $i=0, $cnt=db_num_rows($result) ; $i<$cnt; ++$i ) {
		$row = db_fetch_array( $result );
		array_push($list, array(
			'gid' => $row['gid'],
			'name' => $row['name'],
			'description' => $row['description']
		) );
	}
	return $list;
}

function user_group_manageemet_get_all_user_group_mapping($option = NULL) {
	$SQL = "SELECT t3.gid, t3.name, t3.description, t3.uid, t4.username, t4.realname, t4.email FROM (SELECT t1.gid, t1.name, t1.description, t2.uid FROM `".plugin_table("group")."` AS t1, `".plugin_table("mapping")."` AS t2 WHERE t1.gid = t2.gid) AS t3, ".db_get_table('mantis_user_table')." AS t4 WHERE t3.uid = t4.id";
	if (!empty($option) && is_array($option) ) {
		if (isset($option['uid']))
			$SQL .= " AND t3.uid='".$option['uid']."' ";
		if (isset($option['gid']))
			$SQL .= " AND t3.gid='".$option['gid']."' ";
		if (isset($option['name']))
			$SQL .= " AND t3.name='".$option['name']."' ";
	}
	$result = db_query($SQL);
	$list = array();
	for( $i=0, $cnt=db_num_rows($result) ; $i<$cnt; ++$i ) {
		$row = db_fetch_array( $result );
		array_push($list, array(
			'gid' => $row['gid'],
			'name' => $row['name'],
			'description' => $row['description'],
			'uid' => $row['uid'],
			'username' => $row['username'],
			'realname' => $row['realname'],
			'email' => $row['email']
		) );
	}
	return $list;
}

function user_grouo_management_create_group( $name, $description ) {
	$SQL = "INSERT INTO `".plugin_table("group")."` (name,description) VALUES ('$name','$description')";
	db_query_bound($SQL);
}

function user_grouo_management_update_group( $gid, $name, $description ) {
	$SQL = "UPDATE `".plugin_table("group")."` SET name='$name', description='$description' WHERE gid= '$gid' ";
	db_query_bound($SQL);
}

function user_grouo_management_remove_group( $gid ) {
	$SQL = "DELETE FROM `".plugin_table("group")."` WHERE gid='$gid'";
	db_query_bound($SQL);
	$SQL = "DELETE FROM `".plugin_table("mapping")."` WHERE gid='$gid'";
	db_query_bound($SQL);
}

function user_group_management_get_assigned_group_list($user_id) {
	$SQL = "SELECT gid, name, description FROM `".plugin_table('group')."` WHERE gid IN ( SELECT gid FROM `".plugin_table('mapping')."` WHERE uid = '".$user_id."' )";
	$result = db_query($SQL);
	$list = array();
	for( $i=0, $cnt=db_num_rows($result) ; $i<$cnt; ++$i ) {
		$row = db_fetch_array( $result );
		array_push($list, array(
			'gid' => $row['gid'], 
			'name' => $row['name'], 
			'description' => $row['description']
		) );
	}
	return $list;
}

function user_group_management_get_unassigned_group_list($user_id) {
	$SQL = "SELECT gid, name, description FROM `".plugin_table('group')."` WHERE gid  NOT IN ( SELECT gid FROM `".plugin_table('mapping')."` WHERE uid = '".$user_id."' )";
	$result = db_query($SQL);
	$list = array();
	for( $i=0, $cnt=db_num_rows($result) ; $i<$cnt; ++$i ) {
		$row = db_fetch_array( $result );
		array_push($list, array(
			'gid' => $row['gid'], 
			'name' => $row['name'], 
			'description' => $row['description']
		) );
	}
	return $list;
}
