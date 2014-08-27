Installation
============
 - manage_user_edit_page.php
   - + "event_signal( 'EVENT_UserGroupManagement_ShowUserGroupManagementPage')" before "include ( 'account_prefs_inc.php' );"
 - manage_user_edit_page.php
   - + "event_signal( 'EVENT_UserGroupManagement_RemoveFromAllGroupsForUser', $f_user_id );"  before "form_security_purge('manage_user_delete');"

User Edit
=========
![User Edit Page](https://raw.githubusercontent.com/changyy/Mantis-Plugin-UserGroupManagement/master/doc/ShowUserGroupManagementPage.png)

Plugin Config
=============
![Plugin Condig Page](https://raw.githubusercontent.com/changyy/Mantis-Plugin-UserGroupManagement/master/doc/UserGroupManagementConfig.png)
