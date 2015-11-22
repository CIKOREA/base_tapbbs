{? validation_message != ''}
    <script type="text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
    <script type="text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<div id="join_div" align="center">

    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{lang.btn_join}</div>
    </div>

    <div class="clearfix"></div>

    <form name="join_form" id="join_form" method="post" action="{BASE_URL}user/join" data-ajax="false" onsubmit="return form_null_check('join_form', '{form_null_check}')">
        <table class="data-table">
            <colgroup>
                <col width="170">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th>{lang.user_id}</th>
                <td>
                    <input type="text" name="user_id" id="user_id" value="{value_list.user_id}" maxlength="{SETTING_user_id_length_maximum}">
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
                    <input type="text" name="name" id="name" value="{value_list.name}" maxlength="{SETTING_user_name_length_maximum}">
                </td>
            </tr>
            <tr>
                <th>{lang.nickname}</th>
                <td>
                    <input type="text" name="nickname" id="nickname" value="{value_list.nickname}" maxlength="{SETTING_user_nickname_length_maximum}">
                </td>
            </tr>
            <tr>
                <th>{lang.email}</th>
                <td>
                    <input type="text" name="email" id="email" value="{value_list.email}" maxlength="128">
                </td>
            </tr>
            <tr>
                <th><span id="captcha_img_div">{captcha}</span></th>
                <td>
                    <input type="text" name="captcha" id="captcha" value="">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-info">{lang.btn_join}</button>
                    <button type="reset" class="btn">{lang.cancel}</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>