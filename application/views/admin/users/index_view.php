<div id = "total_cnt" class = "left">Total : <?php echo $total_cnt; ?></div>
<div id = "select" class = "right">
<select name = "group_idx" id = "group_idx" onchange = "window.open('?status=<?php echo $req_status; ?>&group_idx='+this.options[this.selectedIndex].value, '_self');">
	<option value = "">== <?php echo lang('all'); ?> ==</option>
<?php
	foreach($users_group as $k=>$v)
	{
		?>
	<option value = "<?php echo $v->idx; ?>" <?php if($req_group_idx == $v->idx) echo 'selected="selected"'; ?>><?php echo $v->group_name; ?></option>
		<?php
	}
?>
</select>
<select name = "status" id = "status" onchange = "window.open('?group_idx=<?php echo $req_group_idx; ?>&status='+this.options[this.selectedIndex].value, '_self');">
	<option value = "">== <?php echo lang('all'); ?> ==</option>
<?php
	for($i = 0 ; $i < 3 ; $i++)
	{
		?>
	<option value = "<?php echo $i; ?>" <?php if($req_status === $i) echo 'selected="selected"'; ?>><?php echo lang('user_status_'.$i); ?></option>
		<?php
	}
?>
</select>
</div>

<table class="data-table">
	<colgroup>
		<col width = "10%" />
		<col width = "20%" />
		<col width = "20%" />
		<col width = "20%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th>idx</th>
			<th>ID</th>
			<th><?php echo lang('name'); ?></th>
			<th><?php echo lang('nickname'); ?></th>
			<th><?php echo lang('status'); ?></th>
			<th><?php echo lang('point_info'); ?></th>
			<th><?php echo lang('detail'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($users as $k=>$v)
				{
					?>
		<tr>
			<td><?php echo $v->idx; ?></td>
			<td><?php echo $v->user_id; ?></td>
			<td><?php echo $v->name; ?></td>
			<td><?php echo $v->nickname; ?></td>
			<td style = "<?php if(in_array($v->status, array(0,2))) echo 'background-color:#ffc1c1'; ?>"><?php echo lang('user_status_'.$v->status); ?></td>
			<td><input type = "button" class = "button" value = "<?php echo lang('point_info'); ?>" onclick = "users_point(<?php echo $v->idx; ?>);" /></td>
			<td><input type = "button" class = "button" value = "<?php echo lang('detail'); ?>" onclick = "users_detail(<?php echo $v->idx; ?>);" /></td>
		</tr>
				<?php
				}
			}
		?>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>

<form method = "get" name = "user_search_form" id = "user_search_form" action = "<?php echo BASE_URL; ?>admin/users">
<input type = "text" name = "search_word" id = "search_word" class = "text" value = "<?php echo $req_search_word; ?>" />
<input type = "hidden" name = "group_idx" id = "group_idx" value = "<?php echo $req_group_idx; ?>" />
<input type = "hidden" name = "status" id = "status" value = "<?php echo $req_status; ?>" />
<input type = "submit" class = "button" value = "<?php echo lang('search'); ?>" />
</form>