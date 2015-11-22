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
<?php
	if($total_cnt > 0)
	{
		?>
<h3><?php echo name($users_point[0]->user_id, $users_point[0]->name, $users_point[0]->nickname); ?> <!-- -> tb_users > point : <b><?php echo $users_point[0]->user_point; ?></b> vs. tb_users_point > sum : <b><?php echo $point_sum; ?></b> --></h3>
		<?php
	}
?>
<div id = "operator_select" class = "right">
<select name = "search_group" id = "search_group" onchange = "window.open('?user_idx=<?php echo $user_idx; ?>&operator='+this.options[this.selectedIndex].value, '_self');">
	<option value = "">== <?php echo lang('all'); ?> ==</option>
	<option value = "plus" <?php if($this->input->get('operator') == 'plus') echo 'selected="selected"'; ?>>+</option>
	<option value = "minus" <?php if($this->input->get('operator') == 'minus') echo 'selected="selected"'; ?>>-</option>
</select>
</div>
<table class="data-table">
	<colgroup>
		<col width = "10%" />
		<col width = "15%" />
		<col width = "28%" />
		<col width = "10%" />
		<col width = "19%" />
		<col width = "8%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th>idx</th>
			<th><?php echo lang('point'); ?></th>
			<th><?php echo lang('type'); ?></th>
			<th><?php echo lang('timestamp'); ?></th>
			<th><?php echo lang('exec_user'); ?></th>
			<th><?php echo lang('status'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($users_point as $k=>$v)
				{
					$alliance = '';

					//연관글
					//좀 길어지겠군...
					if($v->article_idx)
					{
						$alliance_link = '<a href = "'.BASE_URL.'bbs/view/'.$v->article_bbs_id.'?idx='.$v->article_idx.'" target = "_blank">['.lang('view').']</a>';

						if($v->point >= 0)
						{
							$alliance = lang('article').' '.lang('write').' '.$alliance_link;
						}
						else
						{
							$alliance = lang('article').' '.lang('delete').' '.$alliance_link;
						}
					}
					else if($v->comment_idx)
					{
						$alliance_link = '<a href = "'.BASE_URL.'bbs/view/'.$v->comment_article_bbs_id.'?idx='.$v->comment_article_idx.'" target = "_blank">['.lang('view').']</a>';

						if($v->point >= 0)
						{
							$alliance = lang('comment').' '.lang('write').' '.$alliance_link;
						}
						else
						{
							$alliance = lang('comment').' '.lang('delete').' '.$alliance_link;
						}
					}
					else if($v->vote_article_idx)
					{
						$alliance_link = '<a href = "'.BASE_URL.'bbs/view/'.$v->vote_article_bbs_id.'?idx='.$v->vote_article_idx.'" target = "_blank">['.lang('view').']</a>';

						if( (int)$v->exec_user_idx === (int)$v->user_idx )
						{
							$alliance = lang('article').' '.lang('vote_send').' '.$alliance_link;
						}
						else
						{
							$alliance = lang('article').' '.lang('vote_receive').' '.$alliance_link;
						}
					}
					else if($v->vote_comment_article_idx)
					{
						$alliance_link = '<a href = "'.BASE_URL.'bbs/view/'.$v->vote_comment_article_bbs_id.'?idx='.$v->vote_comment_article_idx.'" target = "_blank">['.lang('view').']</a>';

						if( (int)$v->exec_user_idx === (int)$v->user_idx )
						{
							$alliance = lang('comment').' '.lang('vote_send').' '.$alliance_link;
						}
						else
						{
							$alliance = lang('comment').' '.lang('vote_receive').' '.$alliance_link;
						}
					}
					else
					{
						$alliance = $v->comment;
					}
				?>
		<form method = "post" name = "users_point_delete_form" id = "users_point_update_form" action = "<?php echo BASE_URL; ?>admin/users/point">
		<input type = "hidden" name = "idx" id = "idx" value = "<?php echo $v->idx; ?>" />
		<input type = "hidden" name = "user_idx" id = "user_idx" value = "<?php echo $user_idx; ?>" />
		<input type = "hidden" name = "mode" id = "mode" value = "<?php if($v->is_deleted == 1) { echo 'normal'; } else { echo 'delete'; } ?>" />
		<input type = "hidden" name = "point" id = "point" value = "<?php echo $v->point; ?>" />
		<tr>
			<td><?php echo $v->idx; ?></td>
			<td><?php echo $v->point; ?></td>
			<td><?php echo $alliance; ?></td>
			<td><?php echo time2date($v->exec_timestamp); ?></td>
			<td><?php echo name($v->exec_user_id, $v->exec_name, $v->exec_nickname); ?><br />
			<?php echo $v->exec_client_ip; ?></td>
			<td style = "<?php if($v->is_deleted == 1) echo 'background-color:#ffc1c1'; ?>"><?php if($v->is_deleted == 0) { echo lang('normal'); } else { echo lang('delete'); } ?></td>
			<td><input type = "submit" class="button" value = "<?php if($v->is_deleted == 0) { echo lang('delete'); } else { echo lang('normal'); } ?>" /></td>
		</tr>
		</form>
				<?php
				} //end foreach
			} //end if
		?>
		<form method = "post" name = "users_point_insert_form" id = "users_point_insert_form" action = "<?php echo BASE_URL; ?>admin/users/point">
		<input type = "hidden" name = "mode" id = "mode" value = "insert" />
		<input type = "hidden" name = "user_idx" id = "user_idx" value = "<?php echo $user_idx; ?>" />
		<tr>
			<td>-</td>
			<td><select name = "point" id = "point">
			<?php
				for($i = -10 ; $i <= 10 ; $i++)
				{
					if($i !== 0)
					{
					?>
					<option value = "<?php echo $i*10; ?>" <?php if($i == 1) echo 'selected="selected"'; ?>><?php echo $i*10; ?></option>
					<?php
					}
				}
			?>
			</select></td>
			<td><input type = "text" class = "text" name = "comment" id = "comment" value = "" /></td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td><input type = "button" class = "button" value = "<?php echo lang('insert'); ?>" onclick = "confirm_really('users_point_insert_form');" />
		</tr>
		</form>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>