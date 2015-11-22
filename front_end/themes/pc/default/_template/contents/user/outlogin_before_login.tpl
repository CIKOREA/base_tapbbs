<div style="margin:10px 0px 0px 0px;">

<form style="margin:0px;" name="outlogin_form" id="outlogin_form" method="post" action="{BASE_URL}user/login" onsubmit="return form_null_check('outlogin_form', 'outlogin_user_id^{lang.user_id}|outlogin_password^{lang.password}');">
    <input type="hidden" name="referer" id="outlogin_referer" value="{__GET['referer']}" />
    <input type="text" name="user_id" id="outlogin_user_id" value="" placeholder="{lang.user_id}" class="input-block-level" />
    <input type="password" name="password" id="outlogin_password" value="" placeholder="{lang.password}" class="input-block-level" />
    <label class="checkbox"><input type="checkbox" name="keep_login" id="outlogin_keep_login" value="on" /> {lang.btn_keep_login}</label>
    <input type="submit" value="{lang.btn_login}" class="btn btn-success btn-small" />
    <input type="button" value="{lang.btn_join}" onclick="location.href='{BASE_URL}user/join';" class="btn btn-primary btn-small" />
    <br />
    <input type="button" value="{lang.btn_find_password}" onclick="location.href='{BASE_URL}user/find_password';" class="btn btn-link btn-small" />
</form>

</div>