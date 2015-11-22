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
<form method = "post" name = "category_write_form" id = "category_write_form" action = "<?php echo BASE_URL; ?>admin/bbs/category_insert">
<input type = "hidden" name = "bbs_idx" id = "bbs_idx" value = "<?php echo $req_bbs_idx; ?>" />
<b><?php echo lang('category_name'); ?></b> : <input type = "text" class = "text" name = "category_name" id = "category_name" value = "" maxlength = "64" />
<input type = "button" class = "button" value = "<?php echo lang('add'); ?>" onclick = "confirm_really('category_write_form');" />
</form>