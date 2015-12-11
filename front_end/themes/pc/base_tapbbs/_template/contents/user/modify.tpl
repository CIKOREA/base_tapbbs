{? validation_message != ''}
<script type="text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type="text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<section id="user-page">
    <div class="container">
        <div class="center">
            <h2><i class="fa fa-users"></i> {lang.menu_user_modify}</h2>
        </div>
        <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form name="modify_form" id="modify_form" method="post" action="{BASE_URL}user/modify" enctype="multipart/form-data" onsubmit="return form_null_check('modify_form', 'user_id^{lang.user_id}|name^{lang.name}|nickname^{lang.nickname}|email^{lang.email}');" class="form-horizontal">
                <div class="form-group">
                    <label for="user_id" class="col-sm-3 control-label">{lang.user_id}</label>
                    <div class="col-sm-7">
                        <input type="text" name="user_id" id="user_id" value="{user_id}" class="form-control" required="required" readonly="readonly">
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
                        <input type="text" name="name" id="name" value="{name}" maxlength="{SETTING_user_name_length_maximum}" class="form-control" required="required" placeholder="{lang.name}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nickname" class="col-sm-3 control-label">{lang.nickname}</label>
                    <div class="col-sm-7">
                        <input type="text" name="nickname" id="nickname" value="{nickname}" maxlength="{SETTING_user_nickname_length_maximum}" class="form-control" required="required" placeholder="{lang.nickname}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">{lang.email}</label>
                    <div class="col-sm-7">
                        <input type="text" name="email" id="email" value="{email}" maxlength="128" class="form-control" required="required" placeholder="{lang.email}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">{lang.message_receive_type}</label>
                    <div class="col-sm-7" id="message_receive_type_div" style="line-height:40px">
                        {@message_receive_type}
                            <input type="radio" id="message_receive_type_{.index_}" name="message_receive_type" required="required" value="{.index_}" {.checked} />
                            <label for="message_receive_type_{.index_}">{.text}</label>
                        {/}
                    </div>
                </div>

                {? SETTING_avatar_used == 1}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{lang.avatar}</label>

                        <div class="col-sm-7" >
                            {@avatar.used}
                                <input type="radio" name="avatar_used" id="avatar_used_{.index_}" value="{.index_}" {.checked}><label for="avatar_used_{.index_}">{.text}</label>
                            {/}
                            <br>
                            {? avatar.file !== ''}
                                <img src="{avatar.file}" width="{avatar.width}" height="{avatar.height}">
                            {/}
                            <input type="file" name="avatar_file" id="avatar_file" /><br />
                            {lang.limit_capacity} : {avatar.capacity} (gif)<br>
                            {lang.limit_image_size} : {avatar.width} * {avatar.height}
                        </div>
                    </div>
                {/}

                <div class="form-group">
                    <label class="col-sm-3 control-label">{lang.timezone}</label>
                    <div class="col-sm-7" style="line-height:40px">
                        {timezone_selectbox}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">{lang.memo}</label>
                    <div class="col-sm-7">
                        <textarea name="memo" id="memo" rows="5" class="textarea">{memo}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">{lang.info}</label>
                    <div class="col-sm-7">
                        <textarea name="info" id="info" readonly="readonly" rows="5" class="textarea">{lang.article_count} : {USER_INFO_article_count}
{lang.comment_count} : {USER_INFO_comment_count}
{lang.vote_receive_count} : {USER_INFO_vote_receive_count}
{lang.vote_send_count} : {USER_INFO_vote_send_count}
{lang.join_datetime} : {insert_date}
                        </textarea>
                    </div>
                </div>

                <div class="center form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">{lang.menu_user_modify}</button>
                    <button type="reset" name="reset" class="btn btn-reset btn-lg" required="required">{lang.cancel}</button>
                </div>
            </form>
        </div><!--/.row-->
    </div><!--/.container-->
</section>