<form method = "get" name = "search_form" id = "search_form">
<table class="data-table">
    <colgroup>
        <col width = "15%" />
        <col width = "35%" />
        <col width = "15%" />
        <col width = "35%" />
    </colgroup>
    <tbody>
        <tr>
            <th><?php echo lang('bbs'); ?></th>
            <td>
                <select name = "bbs_idx" id = "bbs_idx">
                    <option value = "">== <?php echo lang('all'); ?> ==</option>
                    <?php
                    foreach($bbs as $k=>$v)
                    {
                        //if($v->bbs_used == 1) //삭제한거에도 게시물이 있을수있으니..
                        //{
                        ?>
                        <option value = "<?php echo $v->bbs_idx; ?>" <?php if($bbs_idx == $v->bbs_idx) echo 'selected="selected"'; ?>><?php echo $v->bbs_name; ?></option>
                        <?php
                        //}
                    }
                    ?>
                </select>
            </td>
            <th><?php echo lang('status'); ?></th>
            <td>
                <select name = "is_deleted" id = "is_deleted">
                    <option value = "">== <?php echo lang('all'); ?> ==</option>
                    <option value = "0" <?php if($is_deleted === 0) echo 'selected="selected"'; ?>><?php echo lang('normal'); ?></option>
                    <option value = "1" <?php if($is_deleted == 1) echo 'selected="selected"'; ?>><?php echo lang('delete'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><?php echo lang('registration_date'); ?></th>
            <td colspan = "3"><input type = "text" class = "text" style = "width:10%;" readonly="readonly" id = "date_start" name = "date_start" value = "<?php echo $date_start ? date('Y-m-d', $date_start) : ''; ?>" /> ~ <input type = "text" class = "text" style = "width:10%;" readonly="readonly" id = "date_end" name = "date_end" value = "<?php echo $date_end ? date('Y-m-d', $date_end) : ''; ?>" /></td>
        </tr>
        <tr>
            <th><?php echo lang('search_word'); ?></th>
            <td><input type = "text" class = "text" name = "search_word" id = "search_word" value = "<?php echo $search_word; ?>" /></td>
            <th><?php echo lang('writer'); ?></th>
            <td><input type = "text" class = "text" name = "writer" id = "writer" value = "<?php echo $writer; ?>" /></td>
        </tr>
        <tr>
            <th colspan = "4"><div align = "center"><input type = "submit" class = "button" value = "<?php echo lang('search'); ?>" /></div></th>
        </tr>
    </tbody>
</table>
</form>

<script type = "text/javascript">
    $(function() {
        $( "#date_start" ).datepicker({ dateFormat: "yy-mm-dd" });
        $( "#date_end" ).datepicker({ dateFormat : "yy-mm-dd" });
    });
</script>

<div id = "total_cnt" class = "left">Total : <?php echo $total_cnt; ?></div>

<form method = "post" name = "delete_form" id = "delete_form" action = "<?php echo BASE_URL; ?>admin/bbs/delete">
<input type = "hidden" name = "bbs_idx" id = "bbs_idx" value = "<?php echo $this->input->get('bbs_idx'); ?>" />
<input type = "hidden" name = "is_deleted" id = "is_deleted" value = "<?php echo $this->input->get('is_deleted'); ?>" />
<input type = "hidden" name = "date_start" id = "date_start" value = "<?php echo $this->input->get('date_start'); ?>" />
<input type = "hidden" name = "date_end" id = "date_end" value = "<?php echo $this->input->get('date_end'); ?>" />
<input type = "hidden" name = "search_word" id = "search_word" value = "<?php echo $this->input->get('search_word'); ?>" />
<input type = "hidden" name = "writer" id = "writer" value = "<?php echo $this->input->get('writer'); ?>" />
<input type = "hidden" name = "page" id = "page" value = "<?php echo $this->input->get('page'); ?>" />
<table class="data-table">
	<colgroup>
        <col width = "4%" />
		<col width = "9%" />
		<col width = "10%" />
		<col width = "*" />
		<col width = "6%" />
		<col width = "15%" />
		<col width = "6%" />
		<col width = "7%" />
		<col width = "7%" />
		<col width = "6%" />
	</colgroup>
	<tbody>
		<tr>
            <th><input type = "checkbox" name = "checker" id = "checker" /></th>
			<th>idx</th>
			<th><?php echo lang('bbs_name'); ?></th>
			<th><?php echo lang('title'); ?></th>
			<th><?php echo lang('comment'); ?></th>
			<th><?php echo lang('write'); ?></th>
			<th><?php echo lang('vote'); ?></th>
			<th><?php echo lang('scrap'); ?></th>
			<th><?php echo lang('hit'); ?></th>
			<th><?php echo lang('status'); ?></th>
		</tr>
		<?php
			if($total_cnt > 0)
			{
				foreach($lists as $k=>$v)
				{
					?>
		<tr class = "cursor">
            <td><input type = "checkbox" name = "checked[]" id = "checked_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>^<?php echo $v->user_idx; ?>" /></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo $v->idx; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo $v->bbs_name; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php if($v->is_notice == 1) { ?><img src = "<?php echo BASE_URL; ?>front_end/common/img/icon/notice.gif" width = "29" height = "11" alt = "<?php echo lang('is_notice'); ?>" />&nbsp;<?php } ?><?php if($v->is_secret == 1) { ?><img src = "<?php echo BASE_URL; ?>front_end/common/img/icon/secret.gif" width = "15" height = "11" alt = "<?php echo lang('is_secret'); ?>" /><?php } ?><?php echo $v->title; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo $v->comment_count; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo name($v->user_id, $v->name, $v->nickname); ?><br />
			<?php echo time2date($v->timestamp_insert); ?><br />
			<?php echo $v->client_ip_insert; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo $v->vote_count; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo $v->scrap_count; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);"><?php echo $v->hit; ?></td>
			<td onclick = "bbs_modify(<?php echo $v->idx; ?>);" style = "<?php if($v->is_deleted ==1) echo 'background-color:#ffc1c1'; ?>"><?php if($v->is_deleted == 1) { echo lang('delete'); } else { echo lang('normal'); } ?></td>
		</tr>
					<?php
				} //end foreach
			} //end if
		?>
	</tbody>
</table>

<input type = "button" class = "button" value = "<?php echo lang('delete'); ?>" onclick = "confirm_really('delete_form');" />

</form>

<div id = "pagination" align = "center"><?php echo $pagination; ?></div>

<script type="text/javascript">
    function checkbox_toggle(checker, target)
    {
        var $checker = $(checker);
        $checker.click(function(){
            var $target = $('input[name="' + target + '"]');
            if ($checker.attr('checked') == 'checked') {
                $target.attr('checked', 'checked');
            } else {
                $target.removeAttr('checked');
            }
        });
    }
    $(document).ready(function(){
        checkbox_toggle('#checker', 'checked[]');
    });
</script>