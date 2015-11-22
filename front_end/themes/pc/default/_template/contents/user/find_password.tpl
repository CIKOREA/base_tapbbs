{? validation_message != ''}
    <script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
    <script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<div class="contents_title_container text-left">
    <span class="divider">|</span>
    <div class="title">{lang.btn_find_password}</div>
</div>

<div class="clearfix"></div>

<div class="span2 offset0 find_password_container">
    <form name="find_password_form" id="find_password_form" method="post" action="{BASE_URL}user/find_password" data-ajax="false" onsubmit="return form_null_check('find_password_form', '{form_null_check}');">
        <fieldset>
            <label for="username">{lang.user_id}</label>
            <div class="div_text">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i> </span><input type="text" name="user_id" id="user_id" value="{value_list.user_id}" placeholder="{lang.user_id}" class="input-xxlarge">
                </div>
            </div>
            <label for="password">E-mail</label>
            <div class="div_text">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i> </span><input type="text" name="email" id="email" value="{value_list.email_join}" placeholder="{lang.email_join}" class="input-xxlarge">
                </div>
            </div>
            <div>
                <span id="captcha_img_div">{captcha_img}</span>
                <input type="text" name="captcha" id="captcha" value="" class="input-large">
                <button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i>&nbsp;{lang.btn_new_password}</button>
            </div>

            <div class="alert alert-success" style="margin-top:10px">
                {lang.guide_new_password}
            </div>
        </fieldset>
    </form>
</div>