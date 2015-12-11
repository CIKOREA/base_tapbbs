{? validation_message != ''}
<script type="text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type="text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<section id="user-page">
    <div class="container">
        <div class="center">
            <h2><i class="fa fa-users"></i> {lang.btn_join}</h2>
        </div>
        <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form name="join_form" id="join_form" method="post" action="{BASE_URL}user/join" onsubmit="return form_null_check('join_form', '{form_null_check}')" class="form-horizontal">
                <div class="form-group">
                    <label for="user_id" class="col-sm-3 control-label">{lang.user_id}</label>
                    <div class="col-sm-7">
                        <input type="text" name="user_id" id="user_id" value="{value_list.user_id}" maxlength="{SETTING_user_id_length_maximum}" class="form-control" required="required" placeholder="{lang.user_id}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">{lang.password}</label>
                    <div class="col-sm-7">
                        <input type="password" name="password" id="password" value="" maxlength="{SETTING_user_password_length_maximum}" class="form-control" required="required" placeholder="{lang.password}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirm" class="col-sm-3 control-label">{lang.password_confirm}</label>
                    <div class="col-sm-7">
                        <input type="password" name="password_confirm" id="password_confirm" value="" maxlength="{SETTING_user_password_length_maximum}" class="form-control" required="required" placeholder="{lang.password_confirm}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">{lang.name}</label>
                    <div class="col-sm-7">
                        <input type="text" name="name" id="name" value="{value_list.name}" maxlength="{SETTING_user_name_length_maximum}" class="form-control" required="required" placeholder="{lang.name}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nickname" class="col-sm-3 control-label">{lang.nickname}</label>
                    <div class="col-sm-7">
                        <input type="text" name="nickname" id="nickname" value="{value_list.nickname}" maxlength="{SETTING_user_nickname_length_maximum}" class="form-control" required="required" placeholder="{lang.nickname}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">{lang.email}</label>
                    <div class="col-sm-7">
                        <input type="text" name="email" id="email" value="{value_list.email}" maxlength="128" class="form-control" required="required" placeholder="{lang.email}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><span id="captcha_img_div">{captcha}</span></label>
                    <div class="col-sm-7">
                        <input type="text" name="captcha" id="captcha" value="" class="form-control" required="required">
                    </div>
                </div>

                <div class="center form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">{lang.btn_join}</button>
                    <button type="reset" name="reset" class="btn btn-reset btn-lg" required="required">{lang.cancel}</button>
                </div>
            </form>
        </div><!--/.row-->
    </div><!--/.container-->
</section>