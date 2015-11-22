<div id = "scrap_div" align = "center">

    <select name="user_menu" id="user_menu" onchange="window.location.href = '{BASE_URL}user/' + this.value;">
        <option value="modify">{lang.menu_user_modify}</option>
        <option value="point">{lang.menu_user_point}</option>
        <option value="scrap" selected="selected">{lang.menu_user_scrap}</option>
        <option value="message">{lang.menu_user_message}</option>
        <option value="friend">{lang.menu_user_friend}</option>
    </select>

    <div style = "height:7px"></div>

    <ul data-role="listview">

        {@users_url}
            <li>
                <h3><a href = "{BASE_URL}bbs/view/{users_url->bbs_id}?idx={users_url->article_idx}" target = "_blank">{users_url->title}</a></h3>
                <p class="ui-li-aside"><a class = "cursor" onclick = "delete_url({users_url->idx}, '{BASE_URL}user/scrap', {SETTING_ajax_timeout});">[{lang.delete}]</a></p>
            </li>
        {:}
            <li>
                <h3>- {lang.none} -</h3>
            </li>
        {/}

    </ul>
</div>

{? pagination != ''}
    <div data-role="footer" data-theme="d" align = "center">
        <div data-role="controlgroup" data-type="horizontal" style = "margin-top:7px;margin-bottom:7px">
            {pagination}
        </div>
    </div>
{/}

<form method = "post" name = "delete_url_form" id = "delete_url_form">
    <input type = "hidden" name = "idx" id = "idx" value = "" />
    <input type = "hidden" name = "type" id = "type" value = "scrap" />
</form>