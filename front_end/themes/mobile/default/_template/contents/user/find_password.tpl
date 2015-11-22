{? validation_message != ''}
    <script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<div id="find_password_div" align="center">
	<form name="find_password_form" id="find_password_form" method="post" action="{BASE_URL}user/find_password" data-ajax="false" onsubmit="return form_null_check('find_password_form', '{form_null_check}');">
		▼ {lang.user_id}
        <input type="text" name="user_id" id="user_id" value="{value_list.user_id}" placeholder="{lang.user_id}" />
		▼ {lang.email}
        <input type="text" name="email" id="email" value="{value_list.email_join}" placeholder="{lang.email_join}" />
		<div id="captcha_img_div">{captcha_img}</div>
		<input type="text" name="captcha" id="captcha" value="" />
		<input type="submit" value="{lang.btn_new_password}" data-icon="search" data-theme="e" />
	</form>
    {lang.guide_new_password}
</div>