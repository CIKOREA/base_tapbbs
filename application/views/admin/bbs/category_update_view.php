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
<form method = "post" name = "category_write_form" id = "category_write_form" action = "<?php echo BASE_URL; ?>admin/bbs/category_update">
<input type = "hidden" name = "idx" id = "idx" value = "<?php echo $req_idx; ?>" />
<b><?php echo lang('category_name'); ?></b> : <input type = "text" class = "text" name = "category_name" id = "category_name" value = "<?php echo $category->category_name; ?>" maxlength = "64" /><br />
<b><?php echo lang('article_count'); ?></b> : <?php echo $category->article_cnt; ?><br />
<b><?php echo lang('move_category'); ?></b> : <select name = "move_category" id = "move_category">
												<?php
													foreach($categorys as $k=>$v)
													{
														?>
												<option value = "<?php echo $v->idx; ?>" <?php if($v->idx == $req_idx) echo 'selected="selected"'; ?>><?php echo $v->category_name; ?></option>
														<?php
													}
												?>
												</select><br />
<b><?php echo lang('is_used'); ?></b> : <input type = "radio" name = "is_used" id = "is_used_0" value = "0" <?php if($category->is_used == 0) echo 'checked = "checked"'; ?>><label for = "is_used_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "is_used" id = "is_used_1" value = "1" <?php if($category->is_used == 1) echo 'checked = "checked"'; ?>><label for = "is_used_1"><?php echo lang('is_used_1'); ?></label><br />
<b><?php echo lang('exec_user'); ?></b> : <?php echo name($category->user_id, $category->name, $category->nickname); ?> (<?php echo $category->client_ip; ?>)<br /><br />
<input type = "submit" class = "button" value = "<?php echo lang('update'); ?>" /> <input type = "button" class = "button" value = "<?php echo lang('revision'); ?>" onclick = "bbs_category_revision(<?php echo $category->idx; ?>);" /> <input type = "button" class = "button" value = "<?php echo lang('list'); ?>" onclick = "location.href='<?php echo BASE_URL; ?>admin/bbs/category?bbs_idx=<?php echo $bbs_idx; ?>';" />
</form>