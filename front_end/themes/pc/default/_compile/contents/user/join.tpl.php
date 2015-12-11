<?php /* Template_ 2.2.7 2015/11/23 00:40:49 /cloud9/workspace/cikorea/front_end/themes/pc/default/_template/contents/user/join.tpl 000003716 */ ?>
<?php if($TPL_VAR["validation_message"]!=''){?>
    <script type="text/javascript">jAlert('<?php echo $TPL_VAR["validation_message"]?>', lang['alert']);</script>
<?php }?>

<?php if($TPL_VAR["result_msg"]!=''){?>
    <script type="text/javascript">jAlert('<?php echo $TPL_VAR["result_msg"]?>', lang['alert']);</script>
<?php }?>

<div id="join_div" align="center">

    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title"><?php echo $TPL_VAR["lang"]["btn_join"]?></div>
    </div>

    <div class="clearfix"></div>

    <form name="join_form" id="join_form" method="post" action="<?php echo $TPL_VAR["BASE_URL"]?>user/join" data-ajax="false" onsubmit="return form_null_check('join_form', '<?php echo $TPL_VAR["form_null_check"]?>')">
        <table class="data-table">
            <colgroup>
                <col width="170">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th><?php echo $TPL_VAR["lang"]["user_id"]?></th>
                <td>
                    <input type="text" name="user_id" id="user_id" value="<?php echo $TPL_VAR["value_list"]["user_id"]?>" maxlength="<?php echo $TPL_VAR["SETTING_user_id_length_maximum"]?>">
                </td>
            </tr>
            <tr>
                <th><?php echo $TPL_VAR["lang"]["password"]?></th>
                <td>
                    <input type="password" name="password" id="password" value="" maxlength="<?php echo $TPL_VAR["SETTING_user_password_length_maximum"]?>">
                </td>
            </tr>
            <tr>
                <th><?php echo $TPL_VAR["lang"]["password_confirm"]?></th>
                <td>
                    <input type="password" name="password_confirm" id="password_confirm" value="" maxlength="<?php echo $TPL_VAR["SETTING_user_password_length_maximum"]?>">
                </td>
            </tr>
            <tr>
                <th><?php echo $TPL_VAR["lang"]["name"]?></th>
                <td>
                    <input type="text" name="name" id="name" value="<?php echo $TPL_VAR["value_list"]["name"]?>" maxlength="<?php echo $TPL_VAR["SETTING_user_name_length_maximum"]?>">
                </td>
            </tr>
            <tr>
                <th><?php echo $TPL_VAR["lang"]["nickname"]?></th>
                <td>
                    <input type="text" name="nickname" id="nickname" value="<?php echo $TPL_VAR["value_list"]["nickname"]?>" maxlength="<?php echo $TPL_VAR["SETTING_user_nickname_length_maximum"]?>">
                </td>
            </tr>
            <tr>
                <th><?php echo $TPL_VAR["lang"]["email"]?></th>
                <td>
                    <input type="text" name="email" id="email" value="<?php echo $TPL_VAR["value_list"]["email"]?>" maxlength="128">
                </td>
            </tr>
            <tr>
                <th><span id="captcha_img_div"><?php echo $TPL_VAR["captcha"]?></span></th>
                <td>
                    <input type="text" name="captcha" id="captcha" value="">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-info"><?php echo $TPL_VAR["lang"]["btn_join"]?></button>
                    <button type="reset" class="btn"><?php echo $TPL_VAR["lang"]["cancel"]?></button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>