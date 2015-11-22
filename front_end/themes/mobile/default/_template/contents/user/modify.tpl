{? validation_message != ''}
    <script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
    <script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

{? avatar_file_fail != ''}
    <script type = "text/javascript">jAlert('{avatar_file_fail}', lang['alert']);</script>
{/}
<div id = "modify_div" align = "center">

    <select name="user_menu" id="user_menu" onchange="window.location.href = '{BASE_URL}user/' + this.value;">
        <option value="modify" selected="selected">{lang.menu_user_modify}</option>
        <option value="point">{lang.menu_user_point}</option>
        <option value="scrap">{lang.menu_user_scrap}</option>
        <option value="message">{lang.menu_user_message}</option>
        <option value="friend">{lang.menu_user_friend}</option>
    </select>

	<div style = "height:7px"></div>

	<form name = "modify_form" id = "modify_form" method = "post" action = "{BASE_URL}user/modify" data-ajax="false" enctype="multipart/form-data" onsubmit = "return form_null_check('modify_form', 'user_id^{lang.user_id}|name^{lang.name}|nickname^{lang.nickname}|email^{lang.email}');">
		▼ {lang.user_id}
		<input type = "text" name = "user_id" id = "user_id" value = "{user_id}" readonly = "readonly" />
		▼ {lang.password}<br />
		<input type = "password" name = "password" id = "password" value = "" maxlength = "{SETTING_user_password_length_maximum}" />
		▼ {lang.password_confirm}<br />
		<input type = "password" name = "password_confirm" id = "password_confirm" value = "" maxlength = "{SETTING_user_password_length_maximum}" />
		▼ {lang.name}<br />
		<input type = "text" name = "name" id = "name" value = "{name}" />
		▼ {lang.nickname}<br />
		<input type = "text" name = "nickname" id = "nickname" value = "{nickname}" />
		▼ {lang.email}
		<input type = "text" name = "email" id = "email" value = "{email}" maxlength = "128" />
		<div id = "message_receive_type_div">
			<!-- jquerymobile 1.1.0 rc1 버그.. 일단 select로..-->
			<fieldset data-role="controlgroup">
                {@message_receive_type}
                    <input type = "radio" name = "message_receive_type" id = "message_receive_type_{.index_}" value = "{.index_}" {.checked} /><label for="message_receive_type_{.index_}">{.text}</label>
                {/}
			</fieldset>
		</div>
		<div style = "height:7px"></div>
        {? SETTING_avatar_used == 1}
            <div id = "avatar_used_div">
                <!-- jquerymobile 1.1.0 rc1 버그.. 일단 select로..-->
                <fieldset data-role="controlgroup">
                    {@avatar.used}
                        <input type="radio" name="avatar_used" id="avatar_used_{.index_}" value="{.index_}" {.checked}><label for="avatar_used_{.index_}">{.text}</label>
                    {/}
                </fieldset>
            </div>
            <div style = "height:7px"></div>
            <div id = "avatar_file_form_div" align = "left">
                {? avatar.file !== ''}
                    <img src="{avatar.file}" width="{avatar.width}" height="{avatar.height}">
                {/}
                <input type = "file" name = "avatar_file" id = "avatar_file" /><br />
                {lang.limit_capacity} : {avatar.capacity} (gif)<br>
                {lang.limit_image_size} : {avatar.width} * {avatar.height}
            </div>
        {/}

		▼ {lang.timezone}
        {timezone_selectbox}

		▼ {lang.memo}
		<textarea name = "memo" id = "memo">{memo}</textarea>
		▼ {lang.info}
		<textarea name = "info" id = "info" readonly>{lang.article_count} : {USER_INFO_article_count}
{lang.comment_count} : {USER_INFO_comment_count}
{lang.vote_receive_count} : {USER_INFO_vote_receive_count}
{lang.vote_send_count} : {USER_INFO_vote_send_count}
{lang.join_datetime} : {insert_date}
        </textarea>
        <div class="ui-body ui-body-b">
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><input type = "submit" value = "{lang.btn_modify}" data-icon="add" data-theme="e" /></div>
                <div class="ui-block-b"><button type="button" data-theme="c" data-icon="delete" onclick="unregistered();">{lang.btn_unregistered}</button></div>
            </fieldset>
        </div>
	</form>
</div>