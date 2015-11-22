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
        <col width = "15%" />
        <col width = "20%" />
        <col width = "20%" />
        <col width = "15%" />
        <col width = "10%" />
        <col width = "5%" />
        <col width = "5%" />
		<col width = "10%" />
    </colgroup>
    <tbody>
        <tr>
            <th><?php echo lang('type'); ?></th>
            <th><?php echo lang('theme_title'); ?></th>
            <th><?php echo lang('folder_name'); ?></th>
            <th><?php echo lang('exec_user'); ?></th>
            <th><?php echo lang('is_used'); ?></th>
            <th><?php echo lang('modify'); ?></th>
            <th><?php echo lang('copy'); ?></th>
            <th><?php echo lang('preview'); ?></th>
        </tr>
        <?php
            foreach($lists as $k=>$v)
            {
                ?>
        <form method = "post" name = "admin_setting_themes_form" id = "admin_setting_themes_form_<?php echo $v->idx; ?>" action = "<?php echo BASE_URL; ?>admin/setting/themes">
            <input type = "hidden" name = "idx" id = "idx_<?php echo $v->idx; ?>" value = "<?php echo $v->idx; ?>" />
            <input type = "hidden" name = "mode" id = "mode_<?php echo $v->idx; ?>" value = "update" />
            <input type = "hidden" name = "type" id = type_<?php echo $v->idx; ?>" value = "<?php echo $v->type; ?>" />
        <tr>
            <td><?php echo ($v->type == 'M') ? 'MOBILE' : 'PC'; ?></td>
            <td><input type = "text" name = "title" id = "title_<?php echo $v->idx; ?>" maxlength = "100" value = "<?php echo $v->title; ?>" class="text" /></td>
            <td><input type = "text" name = "folder_name" id = "folder_name_<?php echo $v->idx; ?>" maxlength = "100" value = "<?php echo $v->folder_name; ?>" class="text" /></td>
            <td><?php echo name($v->user_id, $v->name, $v->nickname); ?><br /><?php echo $v->client_ip; ?></td>
            <td><input type = "checkbox" name = "is_used_<?php echo $v->type; ?>" id = "is_used_<?php echo $v->type; ?>_<?php echo $v->idx; ?>" value = "1" <?php if($v->is_used == 1) echo 'checked="checked"'; ?> /></td>
            <td><input type = "submit" class="button" value = "<?php echo lang('modify'); ?>" /></td>
            <td><input type = "button" class="button" value = "<?php echo lang('copy'); ?>" onclick = "location.href='<?php echo BASE_URL; ?>admin/setting/copy_theme?type=<?php echo $v->type; ?>&idx=<?php echo $v->idx; ?>';"/></td>
            <td><input type = "button" class="button" value = "<?php echo lang('preview'); ?>" onclick = "set_cookie_theme_preview('<?php echo $v->type; ?>', <?php echo $v->idx; ?>);" /></td>
        </tr>
        </form>
                <?php
            }
        ?>
        <form method = "post" name = "admin_setting_themes_form_insert" id = "admin_setting_themes_form_insert" action = "<?php echo BASE_URL; ?>admin/setting/themes">
            <input type = "hidden" name = "mode" id = "mode" value = "insert" />
            <tr>
                <td><select name = "type" id = "type">
                    <option value = "M">MOBILE</option>
                    <option value = "P">PC</option>
                </select></td>
                <td><input type = "text" name = "title" id = "title" maxlength = "100" value = "" class="text" /></td>
                <td><input type = "text" name = "folder_name" id = "folder_name" maxlength = "100" value = "" class="text" /></td>
                <td>-</td>
                <td>-</td>
                <td><input type = "submit" class="button" value = "<?php echo lang('insert'); ?>" /></td>
                <td>-</td>
                <td>-</td>
            </tr>
        </form>
    </tbody>
</table>

<script type = "text/javascript">
    $(document).ready(function(){
        var list = ['P','M'];
        for (var i = 0; i < list.length; i++) {
            var type = list[i];
            $('input[name="is_used_' + type + '"]').attr('_type', type).click(function(){
                $('input[name="is_used_' + $(this).attr('_type') + '"]').removeAttr('checked');
                $(this).attr('checked', 'checked');
            });
        }
    });
</script>