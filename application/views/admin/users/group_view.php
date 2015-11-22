<?php
	//폼검증 에러 표출
	if(validation_errors())
	{
		echo '<script type = "text/javascript">jAlert(\''.str_replace("\n", '', validation_errors()).'\', lang[\'alert\']);</script>';
	}

	//실패 에러
	if(isset($result_msg) == TRUE && $result_msg !== '')
	{
		echo '<script type = "text/javascript">jAlert(\''.$result_msg.'\', lang[\'alert\']);</script>';
	}

	//픽스 그룹
	$fix_group = unserialize(SETTING_fix_group);
?>
※ <?php echo lang('users_group_guide'); ?>
<table class="data-table">
	<colgroup>
		<col width = "8%" />
		<col width = "20%" />
		<col width = "20%" />
		<col width = "10%" />
		<col width = "12%" />
		<col width = "10%" />
		<col width = "12%" />
		<col width = "8%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th>idx</th>
			<th><?php echo lang('group_name'); ?></th>
			<th><?php echo lang('icon_path'); ?></th>
			<th><?php echo lang('user_cnt'); ?></th>
			<th><?php echo lang('is_used'); ?></th>
			<th><?php echo lang('move_group'); ?></th>
			<th><?php echo lang('exec_user'); ?></th>
			<th><?php echo lang('update'); ?></th>
			<th><?php echo lang('revision'); ?></th>
		</tr>
		<?php
			foreach($users_group as $k=>$v)
			{
				?>
		<form method = "post" name = "update_group_<?php echo $v->idx; ?>" id = "update_group_<?php echo $v->idx; ?>" action = "<?php echo BASE_URL; ?>admin/users/group">
		<input type = "hidden" name = "mode" id = "mode" value = "update" />
		<input type = "hidden" name = "idx" id = "idx" value = "<?php echo $v->idx; ?>" />
		<tr>
			<td><?php echo $v->idx; ?></td>
			<td><input type = "text" class = "text" name = "group_name" id = "group_name_<?php echo $v->idx; ?>" value = "<?php echo $v->group_name; ?>" maxlength = "64" /></td>
			<td><input type = "text" class = "text" name = "icon_path" id = "icon_path_<?php echo $v->idx; ?>" value = "<?php echo $v->icon_path; ?>" maxlength = "255" /></td>
			<td><?php echo $v->user_cnt; ?></td>
			<td><?php if(in_array($v->idx, $fix_group) !== TRUE && (int)$v->idx !== SETTING_default_group_idx) { ?><input type = "radio" name = "is_used" id = "is_used_0_<?php echo $v->idx; ?>" value = "0" <?php if($v->is_used == 0) echo 'checked="checked"'; ?> /><label for = "is_used_0_<?php echo $v->idx; ?>"><?php echo lang('is_used_0'); ?></label><br /><?php } ?><input type = "radio" name = "is_used" id = "is_used_1_<?php echo $v->idx; ?>" value = "1" <?php if($v->is_used == 1) echo 'checked="checked"'; ?> /><label for = "is_used_1_<?php echo $v->idx; ?>"><?php echo lang('is_used_1'); ?></label></td>
			<td><?php
					if((int)$v->idx !== $fix_group[0])
					{
						?>
				<input type = "hidden" name = "move_group_original" id = "move_group_original_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" />
				<select name = "move_group" id = "move_group_<?php echo $v->idx; ?>">
				<?php
					foreach($users_group as $k2=>$v2)
					{
						if((int)$v2->idx !== SETTING_admin_group_idx && $v2->is_used == 1)
						{
						?>
					<option value = "<?php echo $v2->idx; ?>" <?php if($v2->idx == $v->idx) echo 'selected="selected"'; ?>><?php echo $v2->group_name; ?></option>
						<?php
						}
					}
				?>
				</select>
						<?php
					} else { echo '-'; }
				?></td>
			<td><?php echo name($v->user_id, $v->name, $v->nickname); ?><br />
			<?php echo $v->client_ip; ?></td>
			<td><input type = "submit" class = "button" value = "<?php echo lang('update'); ?>" /></td>
			<td><input type = "button" class = "button" value = "<?php echo lang('revision'); ?>" onclick = "users_group_revision(<?php echo $v->idx; ?>);" /></td>
		</tr>
		</form>
				<?php
			} //end foreach
		?>
		<form method = "post" name = "insert_group" id = "insert_group" action = "<?php echo BASE_URL; ?>admin/users/group">
		<input type = "hidden" name = "mode" id = "mode" value = "insert" />
		<tr>
			<td>-</td>
			<td><input type = "text" class = "text" name = "group_name" id = "group_name_insert" value = "" maxlength = "64" /></td>
			<td><input type = "text" class = "text" name = "icon_path" id = "icon_path_insert" value = "" maxlength = "255" /></td>
			<td>-</td>
			<td><?php echo lang('is_used_0'); ?></td>
			<td>-</td>
			<td>-</td>
			<td><input type = "button" class = "button" value = "<?php echo lang('add'); ?>" onclick = "confirm_really('insert_group');" /></td>
			<td>-</td>
		</tr>
		</form>
	</tbody>
</table>