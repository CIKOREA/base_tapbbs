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
?>
<form method = "post" name = "users_detail_form" id = "users_detail_form" action = "<?php echo BASE_URL; ?>admin/users/detail">
<input type = "hidden" name = "idx" id = "idx" value = "<?php echo $req_idx; ?>" />
<table class="data-table">
	<colgroup>
		<col width = "40%" />
		<col width = "60%" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('column'); ?></th>
			<th><?php echo lang('value'); ?></th>
		</tr>
		<tr>
			<th><?php echo lang('user_id'); ?></th>
			<td>
			<?php
				//아바타
				if($user_info->avatar_used == 1)
				{
					if(file_exists('./avatars/'.$user_info->user_id.'.gif'))
					{
						?>
			<img src = "<?php echo BASE_URL; ?>avatars/<?php echo $user_info->user_id; ?>.gif" width = "<?php echo SETTING_avatar_limit_image_size_width; ?>" height = "<?php echo SETTING_avatar_limit_image_size_height; ?>" alt = "avatar" />
						<?php
					}
				}
			?>
			<?php
				//admin 이면 픽스
				if($user_info->user_id == 'admin')
				{
					?>
			<input type = "hidden" name = "user_id" id = "user_id" value = "<?php echo $user_info->user_id; ?>" /><?php echo $user_info->user_id; ?>
					<?php
				}
				else
				{
					?>
			<input type = "text" class = "text" name = "user_id" id = "user_id" value = "<?php echo $user_info->user_id; ?>" />
					<?php
				}
			?></td>
		</tr>
		<tr>
			<th><?php echo lang('password'); ?></th>
			<td><input type = "password" class = "text" name = "password" id = "password" value = "" maxlength = "<?php echo SETTING_user_password_length_maximum; ?>" /></td>
		</tr>
		<tr>
			<th><?php echo lang('password_confirm'); ?></th>
			<td><input type = "password" class = "text" name = "password_confirm" id = "password_confirm" value = "" maxlength = "<?php echo SETTING_user_password_length_maximum; ?>" /></td>
		</tr>
		<tr>
			<th><?php echo lang('name'); ?></th>
			<td><input type = "text" class = "text" name = "name" id = "name" value = "<?php echo $user_info->name; ?>" maxlength = "<?php echo SETTING_user_name_length_maximum; ?>" /></td>
		</tr>
		<tr>
			<th><?php echo lang('nickname'); ?></th>
			<td><input type = "text" class = "text" name = "nickname" id = "nickname" value = "<?php echo $user_info->nickname; ?>" maxlength = "<?php echo SETTING_user_nickname_length_maximum; ?>" /></td>
		</tr>
		<tr>
			<th><?php echo lang('level'); ?></th>
			<td>
			<?php
				//admin 이면 픽스
				if($user_info->user_id == 'admin')
				{
					?>
			<input type = "hidden" name = "level" id = "level" value = "99" />-
					<?php
				}
				else
				{
					?>
			<select name = "level" id = "level">
				<?php
					for($i = 1 ; $i <= 99 ; $i++)
					{
						?>
				<option value = "<?php echo $i; ?>" <?php if($i == $user_info->level) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				}
			?>
			</select></td>
		</tr>
		<tr>
			<th><?php echo lang('group'); ?></th>
			<td>
			<?php
				//admin 이면 픽스
				if($user_info->user_id == 'admin')
				{
					?>
			<input type = "hidden" name = "group_idx" id = "group_idx" value = "<?php echo SETTING_admin_group_idx; ?>" />-
					<?php
				}
				else
				{
					?>
			<select name = "group_idx" id = "group_idx">
					<?php
					foreach($users_group as $k=>$v)
					{
						?>
						<option value = "<?php echo $v->idx; ?>" <?php if($v->idx == $user_info->group_idx) echo 'selected="selected"'; ?>><?php echo $v->group_name; ?></option>
						<?php
					}
				}
			?>
			</select></td>
		</tr>
		<tr>
			<th><?php echo lang('email'); ?></th>
			<td><input type = "text" class = "text" name = "email" id = "email" value = "<?php echo $user_info->email; ?>" maxlength = "128" /></td>
		</tr>
		<tr>
			<th><?php echo lang('point'); ?></th>
			<td><input type = "text" class = "text" name = "point" id = "point" value = "<?php echo $user_info->point; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $point_sum; ?>) <input type = "button" class = "button" value = "<?php echo lang('point_info'); ?>" onclick = "users_point(<?php echo $user_info->idx; ?>);" /></td>
		</tr>
		<tr>
			<th><?php echo lang('article_count'); ?></th>
			<td><input type = "text" class = "text" name = "article_count" id = "article_count" value = "<?php echo $user_info->article_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_article_count; ?>)</td>
		</tr>
		<tr>
			<th><?php echo lang('comment_count'); ?></th>
			<td><input type = "text" class = "text" name = "comment_count" id = "comment_count" value = "<?php echo $user_info->comment_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_comment_count; ?>)</td>
		</tr>
		<tr>
			<th><?php echo lang('vote_send_count'); ?></th>
			<td><input type = "text" class = "text" name = "vote_send_count" id = "vote_send_count" value = "<?php echo $user_info->vote_send_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_vote_send_count; ?>)</td>
		</tr>
		<tr>
			<th><?php echo lang('vote_receive_count'); ?></th>
			<td><input type = "text" class = "text" name = "vote_receive_count" id = "vote_receive_count" value = "<?php echo $user_info->vote_receive_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_vote_receive_count; ?>)</td>
		</tr>
		<tr>
			<th colspan = "2"><?php echo lang('timezone'); ?></th>
		</tr>
		<tr>
			<td colspan = "2"><?php echo timezone_menu($user_info->timezone); ?></td>
		</tr>
		<tr>
			<th><?php echo lang('status'); ?></th>
			<td><input type = "radio" name = "status" id = "status_1" value = "1" <?php if($user_info->status == 1) echo 'checked="checked"'; ?> /><label for = "status_1"><?php echo lang('user_status_1'); ?></label> <input type = "radio" name = "status" id = "status_0" value = "0" <?php if($user_info->status == 0) echo 'checked="checked"'; ?> /><label for = "status_0"><?php echo lang('user_status_0'); ?></label> <input type = "radio" name = "status" id = "status_2" value = "2" <?php if($user_info->status == 2) echo 'checked="checked"'; ?> /><label for = "status_2"><?php echo lang('user_status_2'); ?></label></td>
		</tr>
		<tr>
			<th colspan = "2"><?php echo lang('etc_info'); ?></th>
		</tr>
		<tr>
			<td colspan = "2">
			<?php echo lang('article_count'); ?> : <?php echo $user_info->article_count; ?><br />
			<?php echo lang('comment_count'); ?> : <?php echo $user_info->comment_count; ?><br />
			<?php echo lang('vote_send_count'); ?> : <?php echo $user_info->vote_send_count; ?><br />
			<?php echo lang('vote_receive_count'); ?> : <?php echo $user_info->vote_receive_count; ?><br />
			<?php echo lang('timestamp_insert'); ?> : <?php echo time2date($user_info->timestamp_insert); ?> (<?php echo $user_info->client_ip_insert; ?>)<br />
			<?php echo lang('timestamp_update'); ?> : <?php echo $user_info->timestamp_update ? time2date($user_info->timestamp_update) : '-'; ?> (<?php echo $user_info->client_ip_update ? $user_info->client_ip_update : '-'; ?>)<br />
			<?php echo lang('timestamp_delete'); ?> : <?php echo $user_info->timestamp_delete ? time2date($user_info->timestamp_delete) : '-'; ?> (<?php echo $user_info->client_ip_delete ? $user_info->client_ip_delete : '-'; ?>)<br />
			<?php echo lang('timestamp_login'); ?> : <?php echo $user_info->timestamp_login ? time2date($user_info->timestamp_login) : '-'; ?> (<?php echo $user_info->client_ip_login ? $user_info->client_ip_login : '-'; ?>)<br />
			<?php echo lang('timestamp_post'); ?> : <?php echo $user_info->timestamp_post ? time2date($user_info->timestamp_post) : '-'; ?> (<?php echo $user_info->client_ip_post ? $user_info->client_ip_post : '-'; ?>)<br />
			<?php echo lang('timestamp_update_password'); ?> : <?php echo $user_info->timestamp_update_password ? time2date($user_info->timestamp_update_password) : '-'; ?> (<?php echo $user_info->client_ip_update_password ? $user_info->client_ip_update_password : '-'; ?>)
			</td>
		<tr>
			<th colspan = "2"><div align = "center"><input type = "submit" class = "button" value = "<?php echo lang('update'); ?>" /></div></th>
		</tr>
	</tbody>
</table>
</form>