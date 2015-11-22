{? validation_message != ''}
<script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<div id = "join_div" align = "center">
    <form name = "join_form" id = "join_form" method = "post" action = "{BASE_URL}user/join" data-ajax="false" onsubmit = "return form_null_check('join_form', '{form_null_check}')">
        ▼ {lang.user_id}
        <input type = "text" name = "user_id" id = "user_id" value = "{value_list.user_id}" maxlength = "{SETTING_user_id_length_maximum}" />
        ▼ {lang.password}<br />
        <input type = "password" name = "password" id = "password" value = "" maxlength = "{SETTING_user_password_length_maximum}" />
        ▼ {lang.password_confirm}<br />
        <input type = "password" name = "password_confirm" id = "password_confirm" value = "" maxlength = "{SETTING_user_password_length_maximum}" />
        ▼ {lang.name}<br />
        <input type = "text" name = "name" id = "name" value = "{value_list.name}" maxlength = "{SETTING_user_name_length_maximum}" />
        ▼ {lang.nickname}<br />
        <input type = "text" name = "nickname" id = "nickname" value = "{value_list.nickname}" maxlength = "{SETTING_user_nickname_length_maximum}" />
        ▼ {lang.email}
        <input type = "text" name = "email" id = "email" value = "{value_list.email}" maxlength = "128" />
        <div id = "captcha_img_div">{captcha}</div>
        <input type = "text" name = "captcha" id = "captcha" value = "" />
        <input type = "submit" value = "{lang.btn_join}" data-icon="add" data-theme="e" />
    </form>
</div>