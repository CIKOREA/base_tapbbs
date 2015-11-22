<h3><?php if($total_cnt > 0 && isset($revision[0]->category_name) == TRUE) echo $revision[0]->category_name; ?></h3>
<table class="data-table">
	<colgroup>
		<col width = "30%" />
		<col width = "10%" />
		<col width = "15%" />
		<col width = "15%" />
		<col width = "15%" />
		<col width = "15%" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('category_name'); ?></th>
			<th><?php echo lang('sequence'); ?></th>
			<th><?php echo lang('is_used'); ?></th>
			<th><?php echo lang('exec_user'); ?></th>
			<th><?php echo lang('timestamp'); ?></th>
			<th><?php echo lang('exec_client_ip'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($revision as $k=>$v)
				{
				?>
		<tr>
			<td><?php echo $v->category_name; ?></td>
			<td><?php echo $v->sequence; ?></td>
			<td><?php echo $v->is_used; ?></td>
			<td><?php echo name($v->user_id, $v->name, $v->nickname); ?></td>
			<td><?php echo time2date($v->timestamp); ?></td>
			<td><?php echo $v->client_ip; ?></td>
		</tr>
				<?php
				} //end foreach
			} //end if
		?>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>