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
<form method = "post" name = "admin_bbs_modify_form" id = "admin_bbs_modify_form" action = "<?php echo BASE_URL; ?>admin/bbs/modify">
<input type = "hidden" name = "idx" id = "idx" value = "<?php echo $idx; ?>" />
<table class="data-table">
	<colgroup>
		<col width = "20%" />
		<col width = "" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('info'); ?></th>
			<td><a href = "javascript:void(0)" onclick = "users_detail(<?php echo $view->user_idx; ?>);"><?php echo name($view->user_id, $view->name, $view->nickname); ?></a><br />
				<?php echo lang('write_time'); ?> : <?php echo time2date($view->timestamp_insert); ?> (<?php echo $view->client_ip_insert; ?>)
				<?php
					if($view->timestamp_update)
					{
						?>
				<br />
				<?php echo lang('update_time'); ?> : <?php echo time2date($view->timestamp_update); ?> (<a href = "javascript:void(0)" onclick = "users_detail(<?php echo $view->user_idx; ?>);"><?php echo name($view->exec_user_id, $view->exec_name, $view->exec_nickname); ?></a>) (<?php echo $view->client_ip_update; ?>)
						<?php
					}
				?>
				<br />
				<?php echo lang('comment'); ?> : <?php echo $view->comment_count; ?>
				<br />
				<?php echo lang('vote'); ?> : <span id = "vote_article"><?php echo $view->vote_count; ?></span>
				<br />
				<?php echo lang('scrap'); ?> : <span id = "scrap"><?php echo $view->scrap_count; ?></span>
				<br />
				<?php echo lang('hit'); ?> : <?php echo $view->hit; ?>
			</td>
		</tr>
		<tr>
			<th><?php echo lang('bbs'); ?></th>
			<td><?php echo $view->bbs_name; ?></td>
		</tr>
		<tr>
			<th><?php echo lang('title'); ?></th>
			<td><input type = "text" class = "text" name = "title" id = "title" value = "<?php echo $view->title; ?>" style = "width:90%" /></td>
		</tr>
		<tr>
			<th><?php echo lang('category'); ?></th>
			<td><select name = "category" id = "category">
				<option value = "">== <?php echo lang('none'); ?> ==</option>
				<?php
					foreach($category as $k=>$v)
					{
						?>
				<option value = "<?php echo $v->idx; ?>" <?php if($v->idx == $view->category_idx) echo 'selected="selected"'; ?>><?php echo $v->category_name; ?></option>
						<?php
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<th><?php echo lang('move_bbs'); ?></th>
			<td><select name = "move_bbs" id = "move_bbs">
				<?php
					foreach($bbs_and_category as $k=>$v)
					{
						?>
				<option value = "<?php echo $v->bbs_idx.'^'.$v->category_idx; ?>"><?php echo $v->bbs_name; ?> - <?php echo ( ! $v->category_name) ? lang('category_null') : $v->category_name; ?></option>
						<?php
					}
				?>
				</select> <input type = "checkbox" name = "move_bbs_exec" id = "move_bbs_exec" value = "1" /> <label for = "move_bbs_exec"><?php echo lang('exec'); ?></label>
			</td>
		</tr>
		<tr>
			<th><?php echo lang('agent_insert'); ?></th>
			<td><?php echo ($view->agent_insert == 'M') ? 'MOBILE' : 'PC'; ?></td>
		</tr>
		<tr>
			<th><?php echo lang('agent_last_update'); ?></th>
			<td><?php if($view->agent_last_update) { echo ($view->agent_last_update == 'M') ? 'MOBILE' : 'PC'; } else { echo lang('none'); } ?></td>
		</tr>
		<tr>
			<th><?php echo lang('contents'); ?> <input type = "button" class = "button" value = "<?php echo lang('revision'); ?>" onclick = "bbs_contents_revision(<?php echo $view->idx; ?>);" /> </th>
			<td><textarea name = "contents" id = "contents" style = "width:90%" class = "text" rows = "15"><?php echo $view->contents; ?></textarea></td>
		</tr>
		<tr>
			<th><?php echo lang('tags'); ?></th>
			<td><?php

					$tags_temp = array();

					foreach($tags as $k=>$v)
					{
						$tags_temp[] = $v->tag;
					}

					echo join(',', $tags_temp);
				?></td>
		</tr>
		<tr>
			<th><?php echo lang('urls'); ?></th>
			<td><?php
					foreach($urls as $k=>$v)
					{
					?>
					<?php echo anchor_popup($v->url, $v->url); ?><br />
					<?php
					}
				?></td>
		</tr>
<!--		<tr>-->
<!--			<th>--><?php //echo lang('html_used'); ?><!--</th>-->
<!--			<td><input type = "checkbox" name = "html_used" id = "html_used" value = "1" --><?php //if($view->html_used == 1) echo 'checked="checked"'; ?><!-- /></td>-->
<!--		</tr>-->
		<?php
			//관리자그룹 글만 공지사항 처리.. 업데이트하면 어차피 날라가니
			if((int)$view->group_idx === SETTING_admin_group_idx)
			{
			?>
		<tr>
			<th><?php echo lang('is_notice'); ?></th>
			<td><input type = "checkbox" name = "is_notice" id = "is_notice" value = "1" <?php if($view->is_notice == 1) echo 'checked="checked"'; ?> /></td>
		</tr>
			<?php
			}
		?>
		<tr>
			<th><?php echo lang('is_secret'); ?></th>
			<td><input type = "checkbox" name = "is_secret" id = "is_secret" value = "1" <?php if($view->is_secret == 1) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th><?php echo lang('comment'); ?></th>
			<td><input type = "text" class = "text" name = "comment_count" id = "comment_count" value = "<?php echo $view->comment_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_comment_count; ?>)</td>
		</tr>
		<tr>
			<th><?php echo lang('vote'); ?></th>
			<td><input type = "text" class = "text" name = "vote_count" id = "vote_count" value = "<?php echo $view->vote_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_vote_count; ?>)</td>
		</tr>
		<tr>
			<th><?php echo lang('scrap'); ?></th>
			<td><input type = "text" class = "text" name = "scrap_count" id = "scrap_count" value = "<?php echo $view->scrap_count; ?>" /> (<?php echo lang('examination'); ?> : <?php echo $examination_scrap_count; ?>)</td>
		</tr>
		<tr>
			<th><?php echo lang('files'); ?></th>
			<td>
			<?php
				//files
				foreach($files as $k=>$v)
				{
					?>
			<?php echo anchor_popup(BASE_URL.'uploads/'.$v->conversion_filename, $v->original_filename); ?> <input type = "checkbox" name = "delete_file[]" id = "delete_file_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" /> <label for="delete_file_<?php echo $v->idx; ?>"><?php echo lang('delete'); ?></label><br />
					<?php
				}
			?>
			</td>
		</tr>
		<tr>
			<th><?php echo lang('delete'); ?></th>
			<td><input type = "checkbox" name = "is_deleted" id = "is_deleted" value = "1" <?php if($view->is_deleted == 1) echo 'checked="checked"'; ?> /></td>
		</tr>
	</tbody>
</table>

<input type = "button" class = "button" value = "<?php echo lang('update'); ?>" onclick = "confirm_really('admin_bbs_modify_form');" />
<input type = "button" class = "button" value = "<?php echo lang('view_front'); ?>" onclick = "window.open('<?php echo BASE_URL; ?>bbs/view/<?php echo $bbs_id; ?>?idx=<?php echo $view->idx; ?>', '_blank');" />
<input type = "button" class = "button" value = "<?php echo lang('revision'); ?>" onclick = "bbs_article_revision(<?php echo $view->idx; ?>);" />
</form>

<br />

<table class="data-table">
	<colgroup>
	</colgroup>
	<tbody>
		<?php
			foreach($lists_comment as $k=>$v)
			{
				?>
		<form method = "post" id = "admin_bbs_comment_modify_form_<?php echo $v->idx; ?>" name = "admin_bbs_comment_modify_form_<?php echo $v->idx; ?>" action = "<?php echo BASE_URL; ?>admin/bbs/modify_comment">
		<input type = "hidden" name = "idx" id = "idx" value = "<?php echo $v->idx; ?>" />
		<input type = "hidden" name = "article_idx" id = "article_idx" value = "<?php echo $view->idx; ?>" />
		<tr>
			<td>
			<textarea name = "comment" id = "comment" <?php if($v->agent_insert == 'P' OR $v->agent_last_update == 'P') { ?>class = "comment_wysiwyg"<?php } ?> style = "width:90%" rows = "5"><?php echo $v->comment; ?></textarea><br />
			<?php echo name($v->user_id, $v->name, $v->nickname); ?><br />
			<?php echo lang('write_time'); ?> : <?php echo time2date($v->timestamp_insert); ?> (<?php echo $v->client_ip_insert; ?>)<br />
			<?php
				if($v->timestamp_update)
				{
					?>
			<?php echo lang('update_time'); ?> : <?php echo time2date($v->timestamp_update); ?> (<?php echo $v->client_ip_update; ?>)<br />
					<?php
				}
			?>
			<?php echo lang('vote'); ?> : <input type = "text" class = "text" name = "vote_count" id = "vote_count" value = "<?php echo $v->vote_count; ?>" />  (<?php echo lang('examination'); ?> : <?php echo (isset($examination_vote_comment_count[$v->idx]) == TRUE) ? $examination_vote_comment_count[$v->idx] : 0; ?>)<br />
			<?php echo lang('agent_insert'); ?> : <?php echo ($v->agent_insert == 'M') ? 'MOBILE' : 'PC'; ?><br />
			<?php echo lang('agent_last_update'); ?> : <?php if($v->agent_last_update) { echo ($v->agent_last_update == 'M') ? 'MOBILE' : 'PC'; } else { echo lang('none'); } ?><br />
			<?php echo lang('delete'); ?> : <input type = "checkbox" name = "is_deleted" id = "is_deleted" value = "1" <?php if($v->is_deleted == 1) echo 'checked="checked"'; ?> /><br />
			<input type = "button" class = "button" value = "<?php echo lang('update'); ?>" onclick = "confirm_really('admin_bbs_comment_modify_form_<?php echo $v->idx; ?>');" /> <input type = "button" class = "button" value = "<?php echo lang('revision'); ?>" onclick = "bbs_comment_revision(<?php echo $v->idx; ?>);" />
			</td>
		</tr>
		</form>
				<?php
			} //end foreach
		?>
	</tbody>
</table>

<script type="text/javascript" src="<?php echo $third_party_url; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $third_party_url; ?>ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	<?php
	// 글 작성 Agent 가 PC 일 경우에만 에디터로 변경함
	if ($view->agent_insert === 'P' OR $view->agent_last_update === 'P') {
	?>
		$('#contents').ckeditor({
			customConfig : "<?php echo $third_party_url; ?>ckeditor/config_contents_admin.js"
		});
	<?php
	}
	?>
	
	$('.comment_wysiwyg').ckeditor({
		customConfig : "<?php echo $third_party_url; ?>ckeditor/config_comment.js"
	});
});
</script>