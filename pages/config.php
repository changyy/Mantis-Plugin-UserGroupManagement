<?php
html_page_top1();
html_page_top2();
print_manage_menu();
?>

<form method="POST" action="<?php echo plugin_page('create_group'); ?>">
<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="2">
			Create a Group
		</td>
	</tr>
	<tr <?php echo helper_alternate_class(1);?>>
		<td width="30%" class="category">Name</td>
		<td width="70%"><input type="text" name="name" style="width:90%;" maxlength="64" /></td>
	</tr>
	<tr <?php echo helper_alternate_class();?>>
		<td width="30%" class="category">Description</td>
		<td width="70%"><input type="text" name="description" style="width:90%;" maxlength="64" /></td>
	</tr>
	<tr>
		<td colspan="2" class="center">
			<button type="submit">add</button>
		</td>
	</tr>
</table>
</form>
<hr style="width:75%;" />
<?php
	require plugin_file_path( 'api.php', plugin_get_current());
?>
<table align="center" class="width50" cellspacing="1">
	<tr>
		<td class="form-title" colspan="2">
			Group Management
		</td>
	</tr>
<?php
	$line_offset = 0;
	foreach( user_group_management_get_all_group() as $group_info ) {
		$line_offset = ($line_offset + 1) %2;
?>
	<tr <?php echo helper_alternate_class($line_offset);?>>
		<td>
			<form method="POST" action="<?php echo plugin_page('update_group'); ?>">
				<input type="hidden" name="gid" value="<?php echo $group_info['gid'];?>" />
				<div>Name:</div><input type="text" name="name" style="width:70%;" maxlength="64" value="<?php echo $group_info['name']; ?>" /> 
				<div>Desc:</div><input type="text" name="description" style="width:70%;" maxlength="64" value="<?php echo $group_info['description'];?>" />
				<button type="submit">Update</button>
			</form>
			<form method="POST" action="<?php echo plugin_page('remove_group');?>">
				<input type="hidden" name="gid" value="<?php echo $group_info['gid'];?>" />
				<button type="submit">Delete</button>
			</form>

		</td>
	</tr>
<?php
	}
?>
</table>
<?php
html_page_bottom1( __FILE__ );
