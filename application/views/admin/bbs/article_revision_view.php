<table class="data-table">
	<colgroup>
		<col width = "10%" />
		<col width = "20%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th>BBS idx</th>
			<th><?php echo lang('title'); ?></th>
			<th><?php echo lang('category'); ?></th>
			<th><?php echo lang('exec_user'); ?></th>
			<th><?php echo lang('timestamp'); ?></th>
			<th><?php echo lang('client_ip'); ?></th>
			<th><?php echo lang('is_notice'); ?></th>
			<th><?php echo lang('is_secret'); ?></th>
			<th><?php echo lang('is_deleted'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($revision as $k=>$v)
				{
				?>
		<tr>
			<td><?php echo $v->bbs_idx; ?></td>
			<td><?php echo $v->title; ?></td>
			<td><?php echo $v->category_idx; ?></td>
			<td><?php echo name($v->user_id, $v->name, $v->nickname); ?></td>
			<td><?php echo time2date($v->timestamp); ?></td>
			<td><?php echo $v->client_ip; ?></td>
			<td><?php echo $v->is_notice; ?></td>
			<td><?php echo $v->is_secret; ?></td>
			<td><?php echo $v->is_deleted; ?></td>
		</tr>
				<?php 
				} //end foreach
			} //end if
		?>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>