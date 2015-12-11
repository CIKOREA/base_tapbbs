{? validation_message != ''}
<script type="text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type="text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<section id="user-page">
    <div class="container">
        <div class="center">
            <h2><i class="fa fa-users"></i> {lang.btn_login}</h2>
        </div>
        <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
                <form name="login_form" id="login_form" method="post" action="{BASE_URL}user/login" onsubmit="return form_null_check('login_form', '{form_null_check}');" class="form-horizontal">
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

                <div class="center form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">{lang.btn_login}</button>
                    <button type="reset" name="reset" class="btn btn-reset btn-lg" required="required">{lang.cancel}</button>
                </div>
            </form>
        </div><!--/.row-->
    </div><!--/.container-->
</section>