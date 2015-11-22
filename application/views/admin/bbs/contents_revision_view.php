<table class="data-table">
	<colgroup>
		<col width = "10%" />
		<col width = "40%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th>BBS idx</th>
			<th><?php echo lang('contents'); ?></th>
			<th><?php echo lang('exec_user'); ?></th>
			<th><?php echo lang('timestamp'); ?></th>
			<th><?php echo lang('client_ip'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($revision as $k=>$v)
				{
				?>
		<tr>
			<td><?php echo $v->bbs_idx; ?></td>
			<td><?php echo $v->contents; ?></td>
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