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
<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
	#sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<script type = "text/javascript">
	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
		$( "#btn_order_update" ).click( function() {

			var items = $("#sortable li");
			var sended = "";

			for(var i = 0 ; i < items.length ; i++)
			{
				sended += items[i].id + '_' + i;
				if(i !== items.length - 1) sended += "|";
			}

			$( "#order" ).val(sended);
			$( "#category_order_update_form" ).submit();
		});
	});
</script>

<form method = "post" name = "category_order_update_form" id = "category_order_update_form" action = "<?php echo BASE_URL; ?>admin/bbs/category">
<input type = "hidden" name = "bbs_idx" id = "bbs_idx" value = "<?php echo $req_bbs_idx; ?>" />
<input type = "hidden" name = "order" id = "order" value = "" />

<ul id="sortable">
	<?php
		foreach($categorys as $k=>$v)
		{
			?>
	<li id = "<?php echo $v->idx; ?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><a href = "<?php echo BASE_URL; ?>admin/bbs/category_update?idx=<?php echo $v->idx; ?>"><u><?php echo $v->category_name; ?></u></a> (<?php echo lang('is_used_'.$v->is_used); ?>)</li>
			<?php
		} //end foreach
	?>
</ul>

</form>

<div align = "center"><input type = "button" id = "btn_order_update" class = "button" value = "<?php echo lang('order_update'); ?>" /> <input type = "button" class = "button" value = "<?php echo lang('add'); ?>" onclick = "location.href='<?php echo BASE_URL; ?>admin/bbs/category_insert?bbs_idx=<?php echo $req_bbs_idx; ?>'" /></div>