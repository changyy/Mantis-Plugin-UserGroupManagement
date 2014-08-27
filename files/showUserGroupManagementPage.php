<?php
if ( access_has_global_level( config_get( 'manage_user_threshold' ) )  ) {
	require plugin_file_path( 'api.php', plugin_get_current());
	$t_user_id = gpc_get_int( 'user_id' ); 
?>
<!-- User Group Management -->
<div align="center">
	<table class="width75" cellspacing="1">
		<tbody>
			<tr>
				<td class="form-title" colspan="2">
					Add user to group
				</td>
			</tr>
			<tr <?php echo helper_alternate_class(1);?>>
				<td class="category" width="30%">
					Assigned Group
				</td>
				<td width="70%">
<?php
	foreach( user_group_management_get_assigned_group_list($t_user_id) as $item ) {
?>
					<?php echo $item['name'].' ('.$item['description'].')'; ?>
					<form method="POST" action="<?php echo plugin_page('remove_user_from_group');?>">
						<input type="hidden" name="uid" value="<?php echo $t_user_id;?>" />
						<input type="hidden" name="gid" value="<?php echo $item['gid'];?>" />
						<button type="submit">remove</button>
					</form>
					<br />
<?php
	}
?>
				</td>
			</tr>
			<form method="POST" action="<?php echo plugin_page('add_user_into_group');?>">
				<input type="hidden" name="uid" value="<?php echo $t_user_id;?>" />
			<tr <?php echo helper_alternate_class(2);?>>
				<td class="category" width="30%">
					Unassigned Group
				</td>
				<td width="70%">
					<select name="gid[]" multiple="multiple" size="5">
<?php
	foreach( user_group_management_get_unassigned_group_list($t_user_id) as $item ) {
?>
						<option value="<?php echo $item['gid'];?>"><?php echo $item['name'];?></option>
<?php
	}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="center" colspan="2">
					<button type="submit">Add user</button>
				</td>
			</tr>
			</form>
		</tbody>
	</table>
</div>
<?php
}
?>
