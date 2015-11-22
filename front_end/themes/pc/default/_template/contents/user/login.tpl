{? validation_message != ''}
    <script type="text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
    <script type="text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<div class="contents_title_container text-left">
    <span class="divider">|</span>
    <div class="title">{lang.btn_login}</div>
</div>
<div class="clearfix"></div>

<div class="span5 offset2 find_password_container">
    <form name="login_form" id="login_form" method="post" action="{BASE_URL}user/login" data-ajax="false" onsubmit="return form_null_check('login_form', '{form_null_check}');">
        <input type="hidden" name="referer" id="referer" value="{__GET['referer']}" >
        <fieldset>
            <label for="username">{lang.user_id}</label>
            <div class="div_text">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i> </span><input type="text" name="user_id" id="user_id" value="{value_list.user_id}" placeholder="{lang.user_id}" class="input-xlarge">
                </div>
            </div>
            <label for="password">{lang.password}</label>
            <div class="div_text">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i> </span><input type="password" name="password" id="password" value="" placeholder="{lang.password}" class="input-xlarge">
                </div>
            </div>
            <div class="button_div text_center">

                <div>
                    <label class="keep_login_label"><i class="icon-check"></i>&nbsp;{lang.btn_keep_login}</label>
                    <input type="radio" id="keep_login_on" name="keep_login" value="on" checked="checked"><lable for="keep_login_on"> On</lable>
                    <input type="radio" id="keep_login_off" name="keep_login" value="off"><lable for="keep_login_off"> Off</lable>
                </div>

                <button type="button" class="btn btn-primary" onclick="location.href='{BASE_URL}user/join';"><i class="icon-leaf icon-white"></i>&nbsp;{lang.btn_join}</button>
                <button type="button" class="btn btn-warning" onclick="location.href='{BASE_URL}user/find_password';"><i class="icon-search icon-white"></i>&nbsp;{lang.btn_find_password}</button>

                <button type="submit" class="btn btn-success"><i class="icon-eye-open icon-white"></i>&nbsp;{lang.btn_login}</button>
            </div>
        </fieldset>
    </form>
</div>