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
<table class="data-table">
	<colgroup>
		<col width = "50%" />
		<col width = "40%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('client_ip'); ?></th>
			<th><?php echo lang('timestamp'); ?></th>
			<th><?php echo lang('delete'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($block as $k=>$v)
				{
				?>
		<form method = "post" name = "client_ip_block_del_form_<?php echo $k;?>" id = "client_ip_block_del_form_<?php echo $k;?>" action = "<?php echo BASE_URL; ?>admin/ip/del_block">
		<input type = "hidden" name = "idx" id = "idx_<?php echo $k;?>" value = "<?php echo $v->idx; ?>" />
		<tr>
			<td><a href = "http://whois.kisa.or.kr/kor/whois.jsp?query=<?php echo $v->client_ip; ?>" target = "_blank"><?php echo $v->client_ip; ?></a></td>
			<td><?php echo time2date($v->timestamp); ?></td>
			<td><input type = "submit" class="button" value = "<?php echo lang('delete'); ?>" /></td>
		</tr>
		</form>
				<?php
				} //end foreach
			} //end if
		?>
		<form method = "post" name = "client_ip_block_form" id = "client_ip_block_form" action = "<?php echo BASE_URL; ?>admin/ip/block?page=<?php echo $this->input->get('page'); ?>">
		<tr>
			<td colspan = "2"><input type = "text" class = "text" name = "client_ip" value = "" maxlength = "64" /></td>
			<td><input type = "submit" class = "button" value = "<?php echo lang('insert'); ?>" />
		</tr>
		</form>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>