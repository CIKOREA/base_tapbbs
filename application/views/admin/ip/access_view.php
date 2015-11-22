<?php
	echo '<h4>'.sprintf(lang('admin_ip_access_msg'), SETTING_access_client_ip_save_day, SETTING_access_client_ip_save_term/60).'</h4>'; 
?>
<table class="data-table">
	<colgroup>
		<col width = "40%" />
		<col width = "50%" />
		<col width = "10%" />
	</colgroup>
	<tbody>
		<tr>
			<th><?php echo lang('access_cnt'); ?></th>
			<th><?php echo lang('client_ip'); ?></th>
			<th><?php echo lang('block'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($access as $k=>$v)
				{
				?>
		<form method = "post" name = "client_ip_block_form_<?php echo $k; ?>" id = "client_ip_block_form_<?php echo $k; ?>" action = "<?php echo BASE_URL; ?>admin/ip/block">
		<input type = "hidden" name = "client_ip" id = "cleint_ip_<?php echo $k; ?>" value = "<?php echo $v->client_ip; ?>" />
		<tr>
			<td><?php echo $v->cnt; ?></td>
			<td><a href = "http://whois.kisa.or.kr/kor/whois.jsp?query=<?php echo $v->client_ip; ?>" target = "_blank"><?php echo $v->client_ip; ?></a></td>
			<td><?php if($v->client_ip == $this->input->ip_address) { echo lang('owner'); } else { ?><input type = "submit" class="button" value = "<?php echo lang('block'); ?>" /><?php } ?></td>
		</tr>
		</form>
				<?php
				}
			}
		?>
	</tbody>
</table>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>