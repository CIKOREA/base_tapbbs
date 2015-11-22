<h3><?php if($total_cnt > 0 && isset($revision[0]->parameter) == TRUE) echo lang($revision[0]->parameter); ?></h3>
<table class="data-table">
	<colgroup>
		<col width = "38%" />
		<col width = "20%" />
		<col width = "22%" />
		<col width = "20%" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('value'); ?></th>
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
			<td><?php echo $v->value; ?></td>
			<td><?php echo name($v->user_id, $v->name, $v->nickname); ?></td>
			<td><?php echo time2date($v->timestamp); ?></td>
			<td><?php echo $v->client_ip; ?></td>
		</tr>
				<?php
				}
			}
		?>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>