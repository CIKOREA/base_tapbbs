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

    $recently_used = array();

    if(trim(SETTING_bbs_recently_used) !== '') $recently_used = unserialize(SETTING_bbs_recently_used);
?>
<form method = "post" name = "bbs_setting_form_modify" id = "bbs_setting_form_modify" action = "<?php echo BASE_URL; ?>admin/bbs/setting">
<input type = "hidden" name = "mode" value = "modify" />
※ <?php echo lang('recently_used_guide'); ?>
<table class="data-table">
	<colgroup>
		<col width = "25%" />
		<col width = "20%" />
		<col width = "10%" />
        <col width = "15%" />
		<col width = "20%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('bbs_name'); ?></th>
			<th>ID</th>
			<th><?php echo lang('used'); ?></th>
            <th><?php echo lang('recently_used'); ?></th>
			<th><?php echo lang('category'); ?></th>
			<th><?php echo lang('detail'); ?></th>
		</tr>
		<?php
			foreach($bbs_setting as $k=>$v)
			{
			?>
		<tr>
			<td><a href = "<?php echo BASE_URL; ?>bbs/lists/<?php echo $v->bbs_id; ?>" target = "_blank"><?php echo $v->bbs_name; ?></a></td>
			<td><?php echo $v->bbs_id; ?></td>
			<td style = "<?php if($v->bbs_used == 0) echo 'background-color:#ffc1c1'; ?>"><?php echo lang('is_used_'.$v->bbs_used); ?></td>
            <td><select name = "recently_used[<?php echo $v->bbs_id; ?>]" id = "recently_used_<?php echo $v->bbs_id; ?>">
                <option value = "0"><?php echo lang('is_used_0'); ?></option>
                <option value = "1" <?php if(in_array($v->bbs_id, $recently_used)) echo 'selected="selected"'; ?>><?php echo lang('is_used_1'); ?></option>
            </select></td>
			<td><input type = "button" class = "button" value = "<?php echo lang('category'); ?>" onclick = "bbs_category(<?php echo $v->bbs_idx; ?>);" />
                <select name = "category_used[<?php echo $v->bbs_idx; ?>]" id = "category_used_<?php echo $v->bbs_idx; ?>">
                    <option value = "0" <?php if((int)$v->bbs_category_used == 0) echo 'selected="selected";'; ?>><?php echo lang('is_used_0'); ?></option>
                    <option value = "1" <?php if((int)$v->bbs_category_used == 1) echo 'selected="selected";'; ?>><?php echo lang('is_used_1'); ?></option>
                </select></td>
			<td><input type = "button" class = "button" value = "<?php echo lang('detail'); ?>" onclick = "bbs_setting_detail(<?php echo $v->bbs_idx; ?>);" /></td>
		</tr>
			<?php
			} //end foreach
		?>
        <tr>
            <th colspan = "6"><div align = "center"><input type = "button" class = "button" value = "<?php echo lang('modify'); ?>" onclick = "confirm_really('bbs_setting_form_modify');" /></div></th>
        </tr>
	</tbody>
</table>
</form>

<form method = "post" name = "bbs_setting_form_insert" id = "bbs_setting_form_insert" action = "<?php echo BASE_URL; ?>admin/bbs/setting">
<input type = "hidden" name = "mode" value = "insert" />
<table class="data-table">
    <colgroup>
        <col width = "40%" />
        <col width = "40%" />
        <col width = "20%" />
    </colgroup>
    <tbody>
        <tr>
            <th><?php echo lang('bbs_name'); ?></th>
            <th>ID</th>
            <th><?php echo lang('action'); ?></th>
        </tr>
        <tr>
            <td><input type = "text" class = "text" name = "bbs_name" id = "bbs_name" value = "" /></td>
            <td><input type = "text" class = "text" name = "bbs_id" id = "bbs_id" value = "" /></td>
            <td><input type = "button" class = "button" value = "<?php echo lang('insert'); ?>" onclick = "confirm_really('bbs_setting_form_insert');" /></td>
        </tr>
    </tbody>
</table>
</form>