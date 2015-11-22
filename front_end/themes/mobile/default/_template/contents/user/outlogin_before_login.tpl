<form name = "outlogin_form" id = "outlogin_form" method = "post" action = "{BASE_URL}user/login" data-ajax="false" onsubmit = "return form_null_check('outlogin_form', 'outlogin_user_id^{lang.user_id}|outlogin_password^{lang.password}');">
    <input type = "hidden" name = "referer" id = "outlogin_referer" value = "{__GET['referer']}" />
    <input type = "text" name = "user_id" id = "outlogin_user_id" value = "" placeholder = "{lang.user_id}" />
    <input type = "password" name = "password" id = "outlogin_password" value = "" placeholder = "{lang.password}" />
    {lang.btn_keep_login}
    <select name="keep_login" id="outlogin_keep_login">
        <option value="off">Off</option>
        <option value="on">On</option>
    </select>
    <input type = "submit" value = "{lang.btn_login}" />
    <button type="button" onclick="location.href='{BASE_URL}user/join';">{lang.btn_join}</button>
    <button type="button" onclick="location.href='{BASE_URL}user/find_password';">{lang.btn_find_password}</button>
</form>