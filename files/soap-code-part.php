<?php
function mc_plugin_UserGroupManageemet_list($option = NULL) {
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
			'group_id' => $row['gid'],
			'group_name' => $row['name'],
			'group_description' => $row['description'],
			'id' => $row['uid'],
			'name' => $row['username'],
			'real_name' => $row['realname'],
			'email' => $row['email']
		) );
	}
	return $list;
}

