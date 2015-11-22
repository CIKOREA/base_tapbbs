{? validation_message != ''}
    <script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg && result_msg != ''}
    <script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}
<div id = "login_div" align = "center">
	<form name = "login_form" id = "login_form" method = "post" action = "{BASE_URL}user/login" data-ajax="false" onsubmit = "return form_null_check('login_form', '{form_null_check}');">
		<input type = "hidden" name = "referer" id = "referer" value = "{__GET['referer']}" />
		<input type = "text" name = "user_id" id = "user_id" value = "{value_list.user_id}" placeholder = "{lang.user_id}" />
		<input type = "password" name = "password" id = "password" value = "" placeholder = "{lang.password}" />
        <div data-role="fieldcontain" class="ui-field-contain">
            <label class="keep_login_label">{lang.btn_keep_login}</label>
        <select name="keep_login" id="keep_login" data-role="slider">
            <option value="off">Off</option>
            <option value="on">On</option>
        </select>

        </div>
        <input type = "submit" value = "{lang.btn_login}" data-icon="check" data-theme="e" />
		<button type="button" data-icon="plus" onclick="location.href='{BASE_URL}user/join';">{lang.btn_join}</button>
		<button type="button" data-icon="search" onclick="location.href='{BASE_URL}user/find_password';">{lang.btn_find_password}</button>
	</form>
</div>