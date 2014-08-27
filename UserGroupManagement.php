<?php
//
// http://www.mantisbt.org/docs/master-1.2.x/en/developers/dev.plugins.building.source.html
// 
class UserGroupManagementPlugin extends MantisPlugin {
	public static $_TABLE_NAME_GROUPS = 'group';
	public static $_TABLE_NAME_USER_GROUP_MAPPING = 'mapping';
	public static $_FEILD_NAME_GROUP_ID = 'gid';
	public static $_FEILD_NAME_GROUP_NAME = 'name';
	public static $_FEILD_NAME_USER_ID = 'uid';

	function register() {
		$this->name        = 'UserGroupManagement';
		$this->description = lang_get( 'UserGroupManagementDescription' );
		$this->version     = '1.00';
		$this->requires    = array('MantisCore' => '1.2.0');
		$this->author      = 'Yuan-Yi Chang';
		$this->contact     = 'https://github.com/changyy/Mantis-Plugin-UserGroupManagement.git';
		$this->url         = 'https://github.com/changyy/Mantis-Plugin-UserGroupManagement.git';
		$this->page        = 'config';	
	}

	function schema() {
		return array(
			array( 'CreateTableSQL', array( plugin_table( self::$_TABLE_NAME_GROUPS ), "
				gid	 	I	NOTNULL AUTOINCREMENT UNSIGNED PRIMARY,
				name		C(64)	DEFAULT NULL ,
				description	C(64)	DEFAULT NULL 
			" ) ),
			array( 'CreateTableSQL', array( plugin_table( self::$_TABLE_NAME_USER_GROUP_MAPPING ), "
				id 		I	NOTNULL AUTOINCREMENT UNSIGNED PRIMARY,
				uid		I	NOT NULL ,
				gid		I	NOT NULL 
			" ) ),
		);
	} 

	//
	// @ manage_user_delete.php:
	// + event_signal( 'EVENT_UserGroupManagement_RemoveFromAllGroupsForUser' , $f_user_id ); 
	// 	befoe "form_security_purge('manage_user_delete');"
	// 
	// @ manage_user_edit_page.php:
	// + event_signal( 'EVENT_UserGroupManagement_ShowUserGroupManagementPage' );
	//	before "include ( 'account_prefs_inc.php' );"
	//
	function events() {
		return array(
			'EVENT_UserGroupManagement_ShowUserGroupManagementPage' => EVENT_TYPE_EXECUTE,
			'EVENT_UserGroupManagement_RemoveFromAllGroupsForUser' => EVENT_TYPE_EXECUTE
		);
	}

	function hooks() {
		return array(
			'EVENT_UserGroupManagement_ShowUserGroupManagementPage' => UserGroupManagementAtUserManagementPage,
			'EVENT_UserGroupManagement_RemoveFromAllGroupsForUser' => UserGroupManagementRemoveAllGroupsForUser
		);
	}

	function UserGroupManagementAtUserManagementPage() {
		//plugin_file_include('showUserGroupManagementPage.php');
		require plugin_file_path('showUserGroupManagementPage.php', $this->name);
	}

	function UserGroupManagementRemoveAllGroupsForUser($p_event, $user_id) {
		$SQL = "DELETE FROM `".plugin_table(self::$_TABLE_NAME_USER_GROUP_MAPPING)."` WHERE `".self::$_FEILD_NAME_USER_ID."`= '$user_id'";
		db_query_bound($SQL);
	}
}
