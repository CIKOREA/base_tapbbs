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

<form method = "post" name = "admin_setting_bbs_form" id = "admin_setting_bbs_form" action = "<?php echo BASE_URL; ?>admin/bbs">

<span style = "color:red"><b>※ <?php echo lang('bbs_setting_guide'); ?></b></span>
<fieldset>
	<legend><?php echo lang('bbs_config_authority'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 기본 글 작성 허용 그룹 (그룹idx serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_allow_group_write_article']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_allow_group_write_article']['value']);
	
					foreach($users_group as $k=>$v)
					{
						?>
						<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_write_article']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_write_article']['parameter']; ?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" <?php if(in_array($v->idx, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_write_article']['parameter']; ?>_<?php echo $v->idx; ?>"><?php echo $v->group_name; ?></label></div>
						<?php
					}
				?>		
				</td>
				<td><?php echo $setting['bbs_allow_group_write_article']['name']; ?><br />
				<?php echo $setting['bbs_allow_group_write_article']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_allow_group_write_article']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 파일 업로드 허용 그룹 (그룹idx serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_allow_group_upload']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_allow_group_upload']['value']);
		
					foreach($users_group as $k=>$v)
					{
						?>
						<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_upload']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_upload']['parameter']; ?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" <?php if(in_array($v->idx, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_upload']['parameter']; ?>_<?php echo $v->idx; ?>"><?php echo $v->group_name; ?></label></div>
						<?php
					}
				?>		
				</td>
				<td><?php echo $setting['bbs_allow_group_upload']['name']; ?><br />
				<?php echo $setting['bbs_allow_group_upload']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_allow_group_upload']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 글 보기 허용 그룹 (그룹idx serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_allow_group_view_article']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_allow_group_view_article']['value']);
		
					foreach($users_group as $k=>$v)
					{
						?>
						<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_view_article']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_view_article']['parameter']; ?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" <?php if(in_array($v->idx, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_view_article']['parameter']; ?>_<?php echo $v->idx; ?>"><?php echo $v->group_name; ?></label></div>
						<?php
					}
				?>			
				<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_view_article']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_view_article']['parameter']; ?>_0" value = "0" <?php if(in_array(0, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_view_article']['parameter']; ?>_0"><?php echo lang('nonmember'); ?></label></div>	
				</td>
				<td><?php echo $setting['bbs_allow_group_view_article']['name']; ?><br />
				<?php echo $setting['bbs_allow_group_view_article']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_allow_group_view_article']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 파일 다운로드 허용 그룹 (그룹idx serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_allow_group_download']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_allow_group_download']['value']);
	
					foreach($users_group as $k=>$v)
					{
						?>
						<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_download']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_download']['parameter']; ?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" <?php if(in_array($v->idx, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_download']['parameter']; ?>_<?php echo $v->idx; ?>"><?php echo $v->group_name; ?></label></div>
						<?php
					}
				?>	
				<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_download']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_download']['parameter']; ?>_0" value = "0" <?php if(in_array(0, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_download']['parameter']; ?>_0"><?php echo lang('nonmember'); ?></label></div>			
				</td>
				<td><?php echo $setting['bbs_allow_group_download']['name']; ?><br />
				<?php echo $setting['bbs_allow_group_download']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_allow_group_download']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 보기 허용 그룹 (그룹idx serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_allow_group_view_comment']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_allow_group_view_comment']['value']);
	
					foreach($users_group as $k=>$v)
					{
						?>
						<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_view_comment']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_view_comment']['parameter']; ?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" <?php if(in_array($v->idx, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_view_comment']['parameter']; ?>_<?php echo $v->idx; ?>"><?php echo $v->group_name; ?></label></div>
						<?php
					}
				?>
				<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_view_comment']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_view_comment']['parameter']; ?>_0" value = "0" <?php if(in_array(0, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_view_comment']['parameter']; ?>_0"><?php echo lang('nonmember'); ?></label></div>			
				</td>
				<td><?php echo $setting['bbs_allow_group_view_comment']['name']; ?><br />
				<?php echo $setting['bbs_allow_group_view_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_allow_group_view_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 작성 허용 그룹 (그룹idx serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_allow_group_write_comment']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_allow_group_write_comment']['value']);
	
					foreach($users_group as $k=>$v)
					{
						?>
						<div><input type = "checkbox" name = "<?php echo $setting['bbs_allow_group_write_comment']['parameter']; ?>[]" id = "<?php echo $setting['bbs_allow_group_write_comment']['parameter']; ?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" <?php if(in_array($v->idx, $temp)) echo 'checked="checked"'; ?> /><label for = "<?php echo $setting['bbs_allow_group_write_comment']['parameter']; ?>_<?php echo $v->idx; ?>"><?php echo $v->group_name; ?></label></div>
						<?php
					}
				?>		
				</td>
				<td><?php echo $setting['bbs_allow_group_write_comment']['name']; ?><br />
				<?php echo $setting['bbs_allow_group_write_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_allow_group_write_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 리스트 보기 허용 그룹	(그룹idx serialize)	-->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_allow_group_view_list']['parameter']);	?></th>
				<td>
				<?php
					//unserialize
					$temp =	unserialize($setting['bbs_allow_group_view_list']['value']);
			
					foreach($users_group as	$k=>$v)
					{
						?>
						<div><input	type = "checkbox" name = "<?php	echo $setting['bbs_allow_group_view_list']['parameter']; ?>[]" id =	"<?php echo	$setting['bbs_allow_group_view_list']['parameter'];	?>_<?php echo $v->idx; ?>" value = "<?php echo $v->idx;	?>"	<?php if(in_array($v->idx, $temp)) echo	'checked="checked"'; ?>	/><label for = "<?php echo $setting['bbs_allow_group_view_list']['parameter']; ?>_<?php	echo $v->idx; ?>"><?php	echo $v->group_name; ?></label></div>
						<?php
					}
				?>
				<div><input	type = "checkbox" name = "<?php	echo $setting['bbs_allow_group_view_list']['parameter']; ?>[]" id =	"<?php echo	$setting['bbs_allow_group_view_list']['parameter'];	?>_0" value	= "0" <?php	if(in_array(0, $temp)) echo	'checked="checked"'; ?>	/><label for = "<?php echo $setting['bbs_allow_group_view_list']['parameter']; ?>_0"><?php echo	lang('nonmember'); ?></label></div>			
				</td>
				<td><?php echo $setting['bbs_allow_group_view_list']['name']; ?><br	/>
				<?php echo $setting['bbs_allow_group_view_list']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_allow_group_view_list']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('bbs_config_write'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 기본 글 제목 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_length_minimum_article_title']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_length_minimum_article_title']['parameter']; ?>" id = "<?php echo $setting['bbs_length_minimum_article_title']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_length_minimum_article_title']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_length_minimum_article_title']['name']; ?><br />
				<?php echo $setting['bbs_length_minimum_article_title']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_length_minimum_article_title']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 글 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_length_minimum_contents']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_length_minimum_contents']['parameter']; ?>" id = "<?php echo $setting['bbs_length_minimum_contents']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_length_minimum_contents']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_length_minimum_contents']['name']; ?><br />
				<?php echo $setting['bbs_length_minimum_contents']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_length_minimum_contents']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 연속등록 제한 사용 여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_limit_insert_delay_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_limit_insert_delay_used']['parameter']; ?>" id = "<?php echo $setting['bbs_limit_insert_delay_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_limit_insert_delay_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_limit_insert_delay_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_limit_insert_delay_used']['parameter']; ?>" id = "<?php echo $setting['bbs_limit_insert_delay_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_limit_insert_delay_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_limit_insert_delay_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_limit_insert_delay_used']['name']; ?><br />
				<?php echo $setting['bbs_limit_insert_delay_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_limit_insert_delay_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 연속등록 제한 값 종류 (S:초, D:일) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_limit_insert_delay_type']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_limit_insert_delay_type']['parameter']; ?>" id = "<?php echo $setting['bbs_limit_insert_delay_type']['parameter']; ?>_S" value = "S" <?php if($setting['bbs_limit_insert_delay_type']['value'] == 'S') echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_limit_insert_delay_type']['parameter']; ?>_S"><?php echo lang('second'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_limit_insert_delay_type']['parameter']; ?>" id = "<?php echo $setting['bbs_limit_insert_delay_type']['parameter']; ?>_D" value = "D" <?php if($setting['bbs_limit_insert_delay_type']['value'] == 'D') echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_limit_insert_delay_type']['parameter']; ?>_D"><?php echo lang('day'); ?></label></td>
				<td><?php echo $setting['bbs_limit_insert_delay_type']['name']; ?><br />
				<?php echo $setting['bbs_limit_insert_delay_type']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_limit_insert_delay_type']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 연속등록 제한 값 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_limit_insert_delay_value']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_limit_insert_delay_value']['parameter']; ?>" id = "<?php echo $setting['bbs_limit_insert_delay_value']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_limit_insert_delay_value']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_limit_insert_delay_value']['name']; ?><br />
				<?php echo $setting['bbs_limit_insert_delay_value']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_limit_insert_delay_value']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 글 작성시 지급 포인트 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_article_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_point_article_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_article_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_point_article_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_article_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_point_article_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_article_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_point_article_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_article_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_point_article_used']['name']; ?><br />
				<?php echo $setting['bbs_point_article_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_article_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 글 작성시 지급 포인트 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_article']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_point_article']['parameter']; ?>" id = "<?php echo $setting['bbs_point_article']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_point_article']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_point_article']['name']; ?><br />
				<?php echo $setting['bbs_point_article']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_article']['idx']; ?>)" /></td>
			</tr>
			<!-- 태그 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_tags_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_tags_used']['parameter']; ?>" id = "<?php echo $setting['bbs_tags_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_tags_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_tags_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_tags_used']['parameter']; ?>" id = "<?php echo $setting['bbs_tags_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_tags_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_tags_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_tags_used']['name']; ?><br />
				<?php echo $setting['bbs_tags_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_tags_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 태그 제한 갯수 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_tags_limit_count']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_tags_limit_count']['parameter']; ?>" id = "<?php echo $setting['bbs_tags_limit_count']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 20 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_tags_limit_count']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_tags_limit_count']['name']; ?><br />
				<?php echo $setting['bbs_tags_limit_count']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_tags_limit_count']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 글 작성 내용 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_textarea_contents']['parameter']); ?> [MOBILE]</th>
				<td>
				<textarea name = "<?php echo $setting['bbs_textarea_contents']['parameter']; ?>" id = "<?php echo $setting['bbs_textarea_contents']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['bbs_textarea_contents']['value']; ?></textarea></td>
				<td><?php echo $setting['bbs_textarea_contents']['name']; ?><br />
				<?php echo $setting['bbs_textarea_contents']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_textarea_contents']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 글 작성 내용 PC -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_textarea_contents']['parameter']); ?> [PC]</th>
				<td>
				<textarea name = "<?php echo $setting['bbs_textarea_contents_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_textarea_contents_pc']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['bbs_textarea_contents_pc']['value']; ?></textarea></td>
				<td><?php echo $setting['bbs_textarea_contents_pc']['name']; ?><br />
				<?php echo $setting['bbs_textarea_contents_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_textarea_contents_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 파일첨부 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_upload_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_upload_used']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_upload_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_upload_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_upload_used']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_upload_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_upload_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_upload_used']['name']; ?><br />
				<?php echo $setting['bbs_upload_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 첨부파일 허용 확장자 (serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_upload_allow_extension']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_upload_allow_extension']['value']);
				?>
				<textarea name = "<?php echo $setting['bbs_upload_allow_extension']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_allow_extension']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo join(',', $temp); ?></textarea><br />※ <?php echo lang('comma_div'); ?></td>
				<td><?php echo $setting['bbs_upload_allow_extension']['name']; ?><br />
				<?php echo $setting['bbs_upload_allow_extension']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_allow_extension']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 첨부이미지 퀄리티 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_upload_image_quality']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_upload_image_quality']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_image_quality']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i*10; ?>%" <?php if((string)($i*10).'%' == $setting['bbs_upload_image_quality']['value']) echo 'selected="selected"'; ?>><?php echo $i*10; ?>%</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_upload_image_quality']['name']; ?><br />
				<?php echo $setting['bbs_upload_image_quality']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_image_quality']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 첨부파일 허용 용량 제한 (byte) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_upload_limit_capacity']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_upload_limit_capacity']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_limit_capacity']['parameter']; ?>">
				<?php
					$min = min(10, floor(FILE_UPLOAD_MAX_SIZE / 1024 / 1024));
	
					for($i = 1 ; $i <= $min ; $i++)
					{
						?>
						<option value = "<?php echo $i*1024*1024; ?>" <?php if($i*1024*1024 == $setting['bbs_upload_limit_capacity']['value']) echo 'selected="selected"'; ?>><?php echo $i*1024*1024; ?> (<?php echo byte_format($i*1024*1024); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_upload_limit_capacity']['name']; ?><br />
				<?php echo $setting['bbs_upload_limit_capacity']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_limit_capacity']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 파일첨부 제한 갯수 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_upload_limit_count']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_upload_limit_count']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_limit_count']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_upload_limit_count']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_upload_limit_count']['name']; ?><br />
				<?php echo $setting['bbs_upload_limit_count']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_limit_count']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 첨부이미지 사이즈 제한 (가로px) (설정값보다 크면 강제변환) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_upload_limit_image_size_width']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_upload_limit_image_size_width']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_limit_image_size_width']['parameter']; ?>">
				<option value = "0" <?php if($setting['bbs_upload_limit_image_size_width']['value'] == 0) echo 'selected="selected"'; ?>>∞</option>
				<?php
					for($i = 1 ; $i <= 200 ; $i++)
					{
						?>
						<option value = "<?php echo $i*5; ?>" <?php if($i*5 == $setting['bbs_upload_limit_image_size_width']['value']) echo 'selected="selected"'; ?>><?php echo $i*5; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_upload_limit_image_size_width']['name']; ?><br />
				<?php echo $setting['bbs_upload_limit_image_size_width']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_limit_image_size_width']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 썸네일 퀄리티 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_thumbnail_quality']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_thumbnail_quality']['parameter']; ?>" id = "<?php echo $setting['bbs_thumbnail_quality']['parameter']; ?>">
				<?php
					for($i = 50 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>%" <?php if((string)$i.'%' == $setting['bbs_thumbnail_quality']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?>%</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_thumbnail_quality']['name']; ?><br />
				<?php echo $setting['bbs_thumbnail_quality']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_thumbnail_quality']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 썸네일 사이즈 (가로px) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_thumbnail_width']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_thumbnail_width']['parameter']; ?>" id = "<?php echo $setting['bbs_thumbnail_width']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 200 ; $i++)
					{
						?>
						<option value = "<?php echo $i*5; ?>" <?php if($i*5 == $setting['bbs_thumbnail_width']['value']) echo 'selected="selected"'; ?>><?php echo $i*5; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_thumbnail_width']['name']; ?><br />
				<?php echo $setting['bbs_thumbnail_width']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_thumbnail_width']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 관련 링크 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_urls_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_urls_used']['parameter']; ?>" id = "<?php echo $setting['bbs_urls_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_urls_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_urls_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_urls_used']['parameter']; ?>" id = "<?php echo $setting['bbs_urls_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_urls_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_urls_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_urls_used']['name']; ?><br />
				<?php echo $setting['bbs_urls_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_urls_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 관련 링크 제한 갯수 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_urls_limit_count']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_urls_limit_count']['parameter']; ?>" id = "<?php echo $setting['bbs_urls_limit_count']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_urls_limit_count']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_urls_limit_count']['name']; ?><br />
				<?php echo $setting['bbs_urls_limit_count']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_urls_limit_count']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('bbs_config_read'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 기본 욕 필터링 사용 여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_block_string_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_block_string_used']['parameter']; ?>" id = "<?php echo $setting['bbs_block_string_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_block_string_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_block_string_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_block_string_used']['parameter']; ?>" id = "<?php echo $setting['bbs_block_string_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_block_string_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_block_string_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_block_string_used']['name']; ?><br />
				<?php echo $setting['bbs_block_string_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_block_string_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 욕 필터링 (serialize) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_block_string']['parameter']); ?></th>
				<td>
				<?php
					//unserialize
					$temp = unserialize($setting['bbs_block_string']['value']);
				?>
				<textarea name = "<?php echo $setting['bbs_block_string']['parameter']; ?>" id = "<?php echo $setting['bbs_block_string']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo join(',', $temp); ?></textarea><br />※ <?php echo lang('comma_div'); ?></td>
				<td><?php echo $setting['bbs_block_string']['name']; ?><br />
				<?php echo $setting['bbs_block_string']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_block_string']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 게시물 추천기능 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_vote_article_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_vote_article_used']['parameter']; ?>" id = "<?php echo $setting['bbs_vote_article_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_vote_article_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_vote_article_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_vote_article_used']['parameter']; ?>" id = "<?php echo $setting['bbs_vote_article_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_vote_article_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_vote_article_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_vote_article_used']['name']; ?><br />
				<?php echo $setting['bbs_vote_article_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_vote_article_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 댓글 추천기능 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_vote_comment_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_vote_comment_used']['parameter']; ?>" id = "<?php echo $setting['bbs_vote_comment_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_vote_comment_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_vote_comment_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_vote_comment_used']['parameter']; ?>" id = "<?php echo $setting['bbs_vote_comment_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_vote_comment_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_vote_comment_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_vote_comment_used']['name']; ?><br />
				<?php echo $setting['bbs_vote_comment_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_vote_comment_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 추천 받은 사람에게 주는 포인트 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_vote_receiver_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_point_vote_receiver_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_vote_receiver_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_point_vote_receiver_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_vote_receiver_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_point_vote_receiver_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_vote_receiver_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_point_vote_receiver_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_vote_receiver_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_point_vote_receiver_used']['name']; ?><br />
				<?php echo $setting['bbs_point_vote_receiver_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_vote_receiver_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 추천 받은 사람에게 주는 포인트 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_vote_receiver']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_point_vote_receiver']['parameter']; ?>" id = "<?php echo $setting['bbs_point_vote_receiver']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_point_vote_receiver']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_point_vote_receiver']['name']; ?><br />
				<?php echo $setting['bbs_point_vote_receiver']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_vote_receiver']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 추천한 사람에게 주는 포인트 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_vote_sender_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_point_vote_sender_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_vote_sender_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_point_vote_sender_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_vote_sender_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_point_vote_sender_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_vote_sender_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_point_vote_sender_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_vote_sender_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_point_vote_sender_used']['name']; ?><br />
				<?php echo $setting['bbs_point_vote_sender_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_vote_sender_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 추천한 사람에게 주는 포인트 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_vote_sender']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_point_vote_sender']['parameter']; ?>" id = "<?php echo $setting['bbs_point_vote_sender']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_point_vote_sender']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_point_vote_sender']['name']; ?><br />
				<?php echo $setting['bbs_point_vote_sender']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_vote_sender']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('bbs_config_comment'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 기본 댓글 작성 사용 여부  (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_comment_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_comment_used']['parameter']; ?>" id = "<?php echo $setting['bbs_comment_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_comment_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_comment_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_comment_used']['parameter']; ?>" id = "<?php echo $setting['bbs_comment_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_comment_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_comment_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_comment_used']['name']; ?><br />
				<?php echo $setting['bbs_comment_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_comment_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 한페이지에서 보여줄 댓글 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_count_list_comment']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['bbs_count_list_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_count_list_comment']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_count_list_comment']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_count_list_comment']['name']; ?><br />
				<?php echo $setting['bbs_count_list_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_count_list_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 한페이지에서 보여줄 댓글 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_count_list_comment']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['bbs_count_list_comment_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_count_list_comment_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_count_list_comment_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_count_list_comment_pc']['name']; ?><br />
				<?php echo $setting['bbs_count_list_comment_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_count_list_comment_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 한페이지에서 보여줄 댓글 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_count_page_comment']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['bbs_count_page_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_count_page_comment']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_count_page_comment']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['bbs_count_page_comment']['name']; ?><br />
				<?php echo $setting['bbs_count_page_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_count_page_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 한페이지에서 보여줄 댓글 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_count_page_comment']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['bbs_count_page_comment_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_count_page_comment_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_count_page_comment_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['bbs_count_page_comment_pc']['name']; ?><br />
				<?php echo $setting['bbs_count_page_comment_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_count_page_comment_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 정렬 기준 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_comment_sort']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_comment_sort']['parameter']; ?>" id = "<?php echo $setting['bbs_comment_sort']['parameter']; ?>_DESC" value = "DESC" <?php if($setting['bbs_comment_sort']['value'] == 'DESC') echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_comment_sort']['parameter']; ?>_DESC"><?php echo lang('sort_desc'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_comment_sort']['parameter']; ?>" id = "<?php echo $setting['bbs_comment_sort']['parameter']; ?>_ASC" value = "ASC" <?php if($setting['bbs_comment_sort']['value'] == 'ASC') echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_comment_sort']['parameter']; ?>_ASC"><?php echo lang('sort_asc'); ?></label></td>
				<td><?php echo $setting['bbs_comment_sort']['name']; ?><br />
				<?php echo $setting['bbs_comment_sort']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_comment_sort']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 새댓글 아이콘 시간차 (시) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_hour_new_icon_value_comment']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_hour_new_icon_value_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_hour_new_icon_value_comment']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_hour_new_icon_value_comment']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_hour_new_icon_value_comment']['name']; ?><br />
				<?php echo $setting['bbs_hour_new_icon_value_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_hour_new_icon_value_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 새댓글 아이콘 경로 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_hour_new_icon_path_comment']['parameter']); ?></th>
				<td><input type = "text" name = "<?php echo $setting['bbs_hour_new_icon_path_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_hour_new_icon_path_comment']['parameter']; ?>" value = "<?php echo $setting['bbs_hour_new_icon_path_comment']['value']; ?>" class="text" /></td>
				<td><?php echo $setting['bbs_hour_new_icon_path_comment']['name']; ?><br />
				<?php echo $setting['bbs_hour_new_icon_path_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_hour_new_icon_path_comment']['idx']; ?>)" /></td>
			</tr>
            <tr>
                <td colspan = "4" style = "color:#ff6600;"><?php echo lang('change_img_path_msg'); ?></td>
            </tr>
			<!-- 기본 새댓글 아이콘 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_hour_new_icon_used_comment']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_hour_new_icon_used_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_hour_new_icon_used_comment']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_hour_new_icon_used_comment']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_hour_new_icon_used_comment']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_hour_new_icon_used_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_hour_new_icon_used_comment']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_hour_new_icon_used_comment']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_hour_new_icon_used_comment']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_hour_new_icon_used_comment']['name']; ?><br />
				<?php echo $setting['bbs_hour_new_icon_used_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_hour_new_icon_used_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_length_minimum_comment']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_length_minimum_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_length_minimum_comment']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_length_minimum_comment']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_length_minimum_comment']['name']; ?><br />
				<?php echo $setting['bbs_length_minimum_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_length_minimum_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 작성시 지급 포인트 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_comment_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_point_comment_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_comment_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_point_comment_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_comment_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_point_comment_used']['parameter']; ?>" id = "<?php echo $setting['bbs_point_comment_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_point_comment_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_point_comment_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_point_comment_used']['name']; ?><br />
				<?php echo $setting['bbs_point_comment_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_comment_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 작성시 지급 포인트 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_point_comment']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_point_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_point_comment']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_point_comment']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_point_comment']['name']; ?><br />
				<?php echo $setting['bbs_point_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_point_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 작성 내용 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_textarea_comment']['parameter']); ?> [MOBILE]</th>
				<td>
				<textarea name = "<?php echo $setting['bbs_textarea_comment']['parameter']; ?>" id = "<?php echo $setting['bbs_textarea_comment']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['bbs_textarea_comment']['value']; ?></textarea></td>
				<td><?php echo $setting['bbs_textarea_comment']['name']; ?><br />
				<?php echo $setting['bbs_textarea_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_textarea_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 댓글 내용 PC -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_textarea_comment']['parameter']); ?> [PC]</th>
				<td>
				<textarea name = "<?php echo $setting['bbs_textarea_comment_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_textarea_comment_pc']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['bbs_textarea_comment_pc']['value']; ?></textarea></td>
				<td><?php echo $setting['bbs_textarea_comment_pc']['name']; ?><br />
				<?php echo $setting['bbs_textarea_comment_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_textarea_comment_pc']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('bbs_config_list'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 기본 한페이지에서 보여줄 리스트 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_count_list_article']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['bbs_count_list_article']['parameter']; ?>" id = "<?php echo $setting['bbs_count_list_article']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_count_list_article']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_count_list_article']['name']; ?><br />
				<?php echo $setting['bbs_count_list_article']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_count_list_article']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 한페이지에서 보여줄 리스트 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_count_list_article']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['bbs_count_list_article_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_count_list_article_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['bbs_count_list_article_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_count_list_article_pc']['name']; ?><br />
				<?php echo $setting['bbs_count_list_article_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_count_list_article_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 리스트 하단 페이지 수	갯수 MOBILE -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_count_page_article']['parameter']); ?> [MOBILE]</th>
				<td><select	name = "<?php echo $setting['bbs_count_page_article']['parameter'];	?>"	id = "<?php	echo $setting['bbs_count_page_article']['parameter']; ?>">
				<?php
					for($i = 1 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_count_page_article']['value'])	echo 'selected="selected"';	?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => <<	< <u>1 2 3</u> <b>4</b>	<u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['bbs_count_page_article']['name']; ?><br />
				<?php echo $setting['bbs_count_page_article']['client_ip'];	?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_count_page_article']['idx']; ?>)"	/></td>
			</tr>
			<!-- 기본 리스트 하단 페이지 수	갯수 PC -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_count_page_article']['parameter']); ?> [PC]</th>
				<td><select	name = "<?php echo $setting['bbs_count_page_article_pc']['parameter'];	?>"	id = "<?php	echo $setting['bbs_count_page_article_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_count_page_article_pc']['value'])	echo 'selected="selected"';	?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => <<	< <u>1 2 3</u> <b>4</b>	<u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['bbs_count_page_article_pc']['name']; ?><br />
				<?php echo $setting['bbs_count_page_article_pc']['client_ip'];	?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_count_page_article_pc']['idx']; ?>)"	/></td>
			</tr>
			<!-- 기본 조회수에 따른	제목 색깔 변경 기준	조회수 -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hit_article_title_color_count']['parameter']);	?></th>
				<td><select	name = "<?php echo $setting['bbs_hit_article_title_color_count']['parameter']; ?>" id =	"<?php echo	$setting['bbs_hit_article_title_color_count']['parameter'];	?>">
				<?php
					for($i = 1 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i*10; ?>" <?php if($i*10 == $setting['bbs_hit_article_title_color_count']['value']) echo 'selected="selected"'; ?>><?php echo $i*10; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_hit_article_title_color_count']['name']; ?><br	/>
				<?php echo $setting['bbs_hit_article_title_color_count']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hit_article_title_color_count']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 조회수에 따른	제목 색깔 사용여부 (0:미사용, 1:사용) MOBILE -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hit_article_title_color_used']['parameter']); ?> [MOBILE]</th>
				<td><input type	= "radio" name = "<?php	echo $setting['bbs_hit_article_title_color_used']['parameter'];	?>"	id = "<?php	echo $setting['bbs_hit_article_title_color_used']['parameter'];	?>_0" value	= "0" <?php	if($setting['bbs_hit_article_title_color_used']['value'] ==	0) echo	'checked="checked"'; ?>	/><label for="<?php	echo $setting['bbs_hit_article_title_color_used']['parameter'];	?>_0"><?php	echo lang('is_used_0');	?></label> <input type = "radio" name =	"<?php echo	$setting['bbs_hit_article_title_color_used']['parameter']; ?>" id =	"<?php echo	$setting['bbs_hit_article_title_color_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_hit_article_title_color_used']['value']	== 1) echo 'checked="checked"';	?> /><label	for="<?php echo	$setting['bbs_hit_article_title_color_used']['parameter']; ?>_1"><?php echo	lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_hit_article_title_color_used']['name']; ?><br />
				<?php echo $setting['bbs_hit_article_title_color_used']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hit_article_title_color_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 조회수에 따른	제목 색깔 값 MOBILE -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hit_article_title_color_value']['parameter']);	?> [MOBILE]</th>
				<td><input type	= "text" name =	"<?php echo	$setting['bbs_hit_article_title_color_value']['parameter'];	?>"	id = "<?php	echo $setting['bbs_hit_article_title_color_value']['parameter']; ?>" value = "<?php	echo $setting['bbs_hit_article_title_color_value']['value']; ?>" class="text minicolors" style = "width:100px" /></td>
				<td><?php echo $setting['bbs_hit_article_title_color_value']['name']; ?><br	/>
				<?php echo $setting['bbs_hit_article_title_color_value']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hit_article_title_color_value']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 조회수에 따른	제목 색깔 사용여부 (0:미사용, 1:사용) PC -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hit_article_title_color_used']['parameter']); ?> [PC]</th>
				<td><input type	= "radio" name = "<?php	echo $setting['bbs_hit_article_title_color_used_pc']['parameter'];	?>"	id = "<?php	echo $setting['bbs_hit_article_title_color_used_pc']['parameter'];	?>_0" value	= "0" <?php	if($setting['bbs_hit_article_title_color_used_pc']['value'] ==	0) echo	'checked="checked"'; ?>	/><label for="<?php	echo $setting['bbs_hit_article_title_color_used_pc']['parameter'];	?>_0"><?php	echo lang('is_used_0');	?></label> <input type = "radio" name =	"<?php echo	$setting['bbs_hit_article_title_color_used_pc']['parameter']; ?>" id =	"<?php echo	$setting['bbs_hit_article_title_color_used_pc']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_hit_article_title_color_used_pc']['value']	== 1) echo 'checked="checked"';	?> /><label	for="<?php echo	$setting['bbs_hit_article_title_color_used_pc']['parameter']; ?>_1"><?php echo	lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_hit_article_title_color_used_pc']['name']; ?><br />
				<?php echo $setting['bbs_hit_article_title_color_used_pc']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hit_article_title_color_used_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 조회수에 따른	제목 색깔 값 PC -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hit_article_title_color_value']['parameter']);	?> [PC]</th>
				<td><input type	= "text" name =	"<?php echo	$setting['bbs_hit_article_title_color_value_pc']['parameter'];	?>"	id = "<?php	echo $setting['bbs_hit_article_title_color_value_pc']['parameter']; ?>" value = "<?php	echo $setting['bbs_hit_article_title_color_value_pc']['value']; ?>" class="text minicolors" style = "width:100px" /></td>
				<td><?php echo $setting['bbs_hit_article_title_color_value_pc']['name']; ?><br	/>
				<?php echo $setting['bbs_hit_article_title_color_value_pc']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hit_article_title_color_value_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 새글 아이콘 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hour_new_icon_used_article']['parameter']); ?></th>
				<td><input type	= "radio" name = "<?php	echo $setting['bbs_hour_new_icon_used_article']['parameter']; ?>" id = "<?php echo $setting['bbs_hour_new_icon_used_article']['parameter'];	?>_0" value	= "0" <?php	if($setting['bbs_hour_new_icon_used_article']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_hour_new_icon_used_article']['parameter'];	?>_0"><?php	echo lang('is_used_0');	?></label> <input type = "radio" name =	"<?php echo	$setting['bbs_hour_new_icon_used_article']['parameter']; ?>" id	= "<?php echo $setting['bbs_hour_new_icon_used_article']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_hour_new_icon_used_article']['value'] == 1)	echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_hour_new_icon_used_article']['parameter']; ?>_1"><?php echo	lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_hour_new_icon_used_article']['name']; ?><br />
				<?php echo $setting['bbs_hour_new_icon_used_article']['client_ip'];	?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hour_new_icon_used_article']['idx']; ?>)"	/></td>
			</tr>
			<!-- 기본 새글 아이콘 경로 -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hour_new_icon_path_article']['parameter']); ?></th>
				<td><input type	= "text" name =	"<?php echo	$setting['bbs_hour_new_icon_path_article']['parameter']; ?>" id	= "<?php echo $setting['bbs_hour_new_icon_path_article']['parameter']; ?>" value = "<?php echo $setting['bbs_hour_new_icon_path_article']['value'];	?>"	class="text" /></td>
				<td><?php echo $setting['bbs_hour_new_icon_path_article']['name']; ?><br />
				<?php echo $setting['bbs_hour_new_icon_path_article']['client_ip'];	?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hour_new_icon_path_article']['idx']; ?>)"	/></td>
			</tr>
			<tr>
				<td	colspan	= "4" style	= "color:#ff6600;"><?php echo lang('change_img_path_msg'); ?></td>
			</tr>
			<!-- 기본 새글 아이콘 시간차 (시) -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_hour_new_icon_value_article']['parameter']); ?></th>
				<td><select	name = "<?php echo $setting['bbs_hour_new_icon_value_article']['parameter']; ?>" id	= "<?php echo $setting['bbs_hour_new_icon_value_article']['parameter'];	?>">
				<?php
					for($i = 1 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_hour_new_icon_value_article']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_hour_new_icon_value_article']['name'];	?><br />
				<?php echo $setting['bbs_hour_new_icon_value_article']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_hour_new_icon_value_article']['idx'];	?>)" /></td>
			</tr>
			<!-- 게시판	리스트 자를	글자수 MOBILE -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_cut_length_title']['parameter']); ?> [MOBILE]</th>
				<td><select	name = "<?php echo $setting['bbs_cut_length_title']['parameter']; ?>" id = "<?php echo $setting['bbs_cut_length_title']['parameter']; ?>">
				<?php
					for($i = 0 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_cut_length_title']['value']) echo 'selected="selected"'; ?>><?php echo	$i;	?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_cut_length_title']['name']; ?><br />
				<?php echo $setting['bbs_cut_length_title']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_cut_length_title']['idx']; ?>)" /></td>
			</tr>
			<!-- 게시판	리스트 자를	글자수 PC -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_cut_length_title']['parameter']); ?> [PC]</th>
				<td><select	name = "<?php echo $setting['bbs_cut_length_title_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_cut_length_title_pc']['parameter']; ?>">
				<?php
					for($i = 0 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_cut_length_title_pc']['value']) echo 'selected="selected"'; ?>><?php echo	$i;	?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_cut_length_title_pc']['name']; ?><br />
				<?php echo $setting['bbs_cut_length_title_pc']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_cut_length_title_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 최근게시물	갯수 MOBILE -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_recently_count']['parameter']); ?> [MOBILE]</th>
				<td><select	name = "<?php echo $setting['bbs_recently_count']['parameter'];	?>"	id = "<?php	echo $setting['bbs_recently_count']['parameter']; ?>">
				<?php
					for($i = 1 ; $i	<= 10 ;	$i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_recently_count']['value'])	echo 'selected="selected"';	?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_recently_count']['name']; ?><br />
				<?php echo $setting['bbs_recently_count']['client_ip'];	?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_recently_count']['idx']; ?>)"	/></td>
			</tr>
			<!-- 최근게시물	갯수 PC -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_recently_count']['parameter']); ?> [PC]</th>
				<td><select	name = "<?php echo $setting['bbs_recently_count_pc']['parameter'];	?>"	id = "<?php	echo $setting['bbs_recently_count_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i	<= 10 ;	$i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_recently_count_pc']['value'])	echo 'selected="selected"';	?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_recently_count_pc']['name']; ?><br />
				<?php echo $setting['bbs_recently_count_pc']['client_ip'];	?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_recently_count_pc']['idx']; ?>)"	/></td>
			</tr>
			<!-- 최근게시물	제목 자를 글자수 MOBILE -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_cut_length_recently']['parameter']); ?> [MOBILE]</th>
				<td><select	name = "<?php echo $setting['bbs_cut_length_recently']['parameter']; ?>" id	= "<?php echo $setting['bbs_cut_length_recently']['parameter'];	?>">
				<?php
					for($i = 0 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_cut_length_recently']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_cut_length_recently']['name'];	?><br />
				<?php echo $setting['bbs_cut_length_recently']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_cut_length_recently']['idx'];	?>)" /></td>
			</tr>
			<!-- 최근게시물	제목 자를 글자수 PC -->
			<tr>
				<th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_cut_length_recently']['parameter']); ?> [PC]</th>
				<td><select	name = "<?php echo $setting['bbs_cut_length_recently_pc']['parameter']; ?>" id	= "<?php echo $setting['bbs_cut_length_recently_pc']['parameter'];	?>">
				<?php
					for($i = 0 ; $i	<= 100 ; $i++)
					{
						?>
						<option	value =	"<?php echo	$i;	?>"	<?php if($i	== $setting['bbs_cut_length_recently_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_cut_length_recently_pc']['name'];	?><br />
				<?php echo $setting['bbs_cut_length_recently_pc']['client_ip']; ?></td>
				<td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_cut_length_recently_pc']['idx'];	?>)" /></td>
			</tr>
            <!-- lists_style MOBILE -->
            <tr>
                <th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_lists_style']['parameter']); ?> [MOBILE]</th>
                <td><select	name = "<?php echo $setting['bbs_lists_style']['parameter']; ?>" id	= "<?php echo $setting['bbs_lists_style']['parameter'];	?>">
                        <option	value =	""	<?php if(''	== $setting['bbs_lists_style']['value']) echo 'selected="selected"'; ?>><?php echo lang('default'); ?></option>
                        <option	value =	"gallery"	<?php if('gallery'	== $setting['bbs_lists_style']['value']) echo 'selected="selected"'; ?>><?php echo lang('gallery'); ?></option>
                        <option	value =	"webzine"	<?php if('webzine'	== $setting['bbs_lists_style']['value']) echo 'selected="selected"'; ?>><?php echo lang('webzine'); ?></option>
                    </select></td>
                <td><?php echo $setting['bbs_lists_style']['name'];	?><br />
                    <?php echo $setting['bbs_lists_style']['client_ip']; ?></td>
                <td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_lists_style']['idx'];	?>)" /></td>
            </tr>
            <!-- lists_style PC -->
            <tr>
                <th	align =	"left"><?php echo lang('default').'	'.lang($setting['bbs_lists_style']['parameter']); ?> [PC]</th>
                <td><select	name = "<?php echo $setting['bbs_lists_style_pc']['parameter']; ?>" id	= "<?php echo $setting['bbs_lists_style_pc']['parameter'];	?>">
                        <option	value =	""	<?php if(''	== $setting['bbs_lists_style_pc']['value']) echo 'selected="selected"'; ?>><?php echo lang('default'); ?></option>
                        <option	value =	"gallery"	<?php if('gallery'	== $setting['bbs_lists_style_pc']['value']) echo 'selected="selected"'; ?>><?php echo lang('gallery'); ?></option>
                        <option	value =	"webzine"	<?php if('webzine'	== $setting['bbs_lists_style_pc']['value']) echo 'selected="selected"'; ?>><?php echo lang('webzine'); ?></option>
                    </select></td>
                <td><?php echo $setting['bbs_lists_style_pc']['name'];	?><br />
                    <?php echo $setting['bbs_lists_style_pc']['client_ip']; ?></td>
                <td><input type	= "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo	$setting['bbs_lists_style_pc']['idx'];	?>)" /></td>
            </tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('bbs_config_etc'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 기본 카테고리 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_category_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_category_used']['parameter']; ?>" id = "<?php echo $setting['bbs_category_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_category_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_category_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_category_used']['parameter']; ?>" id = "<?php echo $setting['bbs_category_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_category_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_category_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_category_used']['name']; ?><br />
				<?php echo $setting['bbs_category_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_category_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 RSS 사용여부 (0:미사용, 1:사용) MOBILE -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_rss_used']['parameter']); ?> [MOBILE]</th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_rss_used']['parameter']; ?>" id = "<?php echo $setting['bbs_rss_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_rss_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_rss_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_rss_used']['parameter']; ?>" id = "<?php echo $setting['bbs_rss_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_rss_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_rss_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_rss_used']['name']; ?><br />
				<?php echo $setting['bbs_rss_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_rss_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 RSS 사용여부 (0:미사용, 1:사용) PC -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_rss_used']['parameter']); ?> [PC]</th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_rss_used_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_rss_used_pc']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_rss_used_pc']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_rss_used_pc']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_rss_used_pc']['parameter']; ?>" id = "<?php echo $setting['bbs_rss_used_pc']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_rss_used_pc']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_rss_used_pc']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_rss_used_pc']['name']; ?><br />
				<?php echo $setting['bbs_rss_used_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_rss_used_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 기타1 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_etc1']['parameter']); ?> [PC]</th>
				<td>
				<textarea name = "<?php echo $setting['bbs_etc1']['parameter']; ?>" id = "<?php echo $setting['bbs_etc1']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['bbs_etc1']['value']; ?></textarea></td>
				<td><?php echo $setting['bbs_etc1']['name']; ?><br />
				<?php echo $setting['bbs_etc1']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_etc1']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 기타2 -->
			<tr>
				<th align = "left"><?php echo lang('default').' '.lang($setting['bbs_etc2']['parameter']); ?> [PC]</th>
				<td>
				<textarea name = "<?php echo $setting['bbs_etc2']['parameter']; ?>" id = "<?php echo $setting['bbs_etc2']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['bbs_etc2']['value']; ?></textarea></td>
				<td><?php echo $setting['bbs_etc2']['name']; ?><br />
				<?php echo $setting['bbs_etc2']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_etc2']['idx']; ?>)" /></td>
			</tr>
			<tr>
				<td><input type = "radio" name = "bbs_limit" id = "limit_only_default" value = "only_default" checked = "checked" /><label for = "limit_only_default"><?php echo lang('limit_only_default'); ?></label></td>
				<td colspan = "3"><input type = "radio" name = "bbs_limit" id = "limit_checked_bbs" value = "checked_bbs" /><label for = "limit_checked_bbs"><?php echo lang('limit_checked_bbs'); ?></label></td>
			</tr>
			<tr>
				<td></td>
				<td colspan = "3">
				<?php
					foreach($bbs_setting as $k=>$v)
					{
						?>
						└ <input type = "checkbox" name = "include_bbs[]" id = "include_bbs_<?php echo $k; ?>" value = "<?php echo $v->bbs_idx; ?>" /><label for = "include_bbs_<?php echo $k; ?>"><?php echo $v->bbs_name; ?> (<?php echo $v->bbs_id; ?>)</label><br />
						<?php
					}
				?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan = "3"><input type = "radio" name = "bbs_setting_update_base" id = "setting_update_base_affected" value = "affected" checked = "checked" /><label for = "setting_update_base_affected"><?php echo lang('setting_update_base_affected'); ?></label><br />
				<input type = "radio" name = "bbs_setting_update_base" id = "setting_update_base_all" value = "all" /><label for = "setting_update_base_all"><?php echo lang('setting_update_base_all'); ?></label>
			</tr>
		</tbody>
	</table>
</fieldset>

<table class="data-table">
	<tbody>
		<tr>
			<td><div align = "center"><input type = "submit" value = "<?php echo lang('update'); ?>" class = "button" /></div></td>
		</tr>
	</tbody>
</table>
</form>