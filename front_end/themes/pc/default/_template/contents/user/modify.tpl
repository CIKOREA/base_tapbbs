{? validation_message != ''}
<script type="text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type="text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

{? avatar_file_fail != ''}
    <script type="text/javascript">jAlert('{avatar_file_fail}', lang['alert']);</script>
{/}
<div id="modify_div" align="center">

    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{lang.menu_user_modify}</div>
    </div>
    <div class="clearfix"></div>

    <div class="clearfix"></div>

    <form name="modify_form" id="modify_form" method="post" action="{BASE_URL}user/modify" data-ajax="false" enctype="multipart/form-data" onsubmit="return form_null_check('modify_form', 'user_id^{lang.user_id}|name^{lang.name}|nickname^{lang.nickname}|email^{lang.email}');">
        <table class="data-table">
            <colgroup>
                <col width="170">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th>{lang.user_id}</th>
                <td>
                    <input type="text" name="user_id" id="user_id" value="{user_id}" readonly="readonly">
                </td>
            </tr>
            <tr>
                <th>{lang.password}</th>
                <td>
                    <input type="password" name="password" id="password" value="" maxlength="{SETTING_user_password_length_maximum}">
                </td>
            </tr>
            <tr>
                <th>{lang.password_confirm}</th>
                <td>
                    <input type="password" name="password_confirm" id="password_confirm" value="" maxlength="{SETTING_user_password_length_maximum}">
                </td>
            </tr>
            <tr>
                <th>{lang.name}</th>
                <td>
                    <input type="text" name="name" id="name" value="{name}">
                </td>
            </tr>
            <tr>
                <th>{lang.nickname}</th>
                <td>
                    <input type="text" name="nickname" id="nickname" value="{nickname}">
                </td>
            </tr>
            <tr>
                <th>{lang.email}</th>
                <td>
                    <input type="text" name="email" id="email" value="{email}" maxlength="128">
                </td>
            </tr>
            <tr>
                <th>{lang.message_receive_type}</th>
                <td>
                    <div id="message_receive_type_div">
                    {@message_receive_type}
                        <input type="radio" name="message_receive_type" id="message_receive_type_{.index_}" value="{.index_}" {.checked} /><label for="message_receive_type_{.index_}">{.text}</label>
                    {/}
                    </div>
                </td>
            </tr>
            {? SETTING_avatar_used == 1}
                <tr>
                    <th>{lang.avatar}</th>
                    <td>
                        {@avatar.used}
                            <input type="radio" name="avatar_used" id="avatar_used_{.index_}" value="{.index_}" {.checked}><label for="avatar_used_{.index_}">{.text}</label>
                        {/}
                        <br><br>
                        <div id="avatar_file_form_div" align="left">
                            {? avatar.file !== ''}
                            <img src="{avatar.file}" width="{avatar.width}" height="{avatar.height}">
                            {/}
                            <input type="file" name="avatar_file" id="avatar_file" /><br />
                            {lang.limit_capacity} : {avatar.capacity} (gif)<br>
                            {lang.limit_image_size} : {avatar.width} * {avatar.height}
                        </div>
                    </td>
                </tr>
            {/}
            <tr>
                <th>{lang.timezone}</th>
                <td>{timezone_selectbox}</td>
            </tr>
            <tr>
                <th>{lang.memo}</th>
                <td><textarea name="memo" id="memo" rows="5" class="span7">{memo}</textarea></td>
            </tr>
            <tr>
                <th>{lang.info}</th>
                <td>
<textarea name="info" id="info" readonly="readonly" rows="5" class="span7">{lang.article_count} : {USER_INFO_article_count}
{lang.comment_count} : {USER_INFO_comment_count}
{lang.vote_receive_count} : {USER_INFO_vote_receive_count}
{lang.vote_send_count} : {USER_INFO_vote_send_count}
{lang.join_datetime} : {insert_date}
</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-info">{lang.btn_modify}</button>
                    <button type="reset" class="btn">{lang.cancel}</button>
                    <a href="javascript:void(0)" class="btn disabled" onclick="unregistered();">{lang.btn_unregistered}</a>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>