<div id = "message_div" align = "center">

    <select name="user_menu" id="user_menu" onchange="window.location.href = '{BASE_URL}user/' + this.value;">
        <option value="modify">{lang.menu_user_modify}</option>
        <option value="point">{lang.menu_user_point}</option>
        <option value="scrap">{lang.menu_user_scrap}</option>
        <option value="message" selected="selected">{lang.menu_user_message}</option>
        <option value="friend">{lang.menu_user_friend}</option>
    </select>

    <div data-role="controlgroup" data-type="horizontal" style = "margin-bottom:7px">
        <a onclick = "location.href='{BASE_URL}user/message?search=receive';" data-role="button" class="{search_receive_active}">{lang.message_receive_box}</a>
        <a onclick = "location.href='{BASE_URL}user/message?search=send';" data-role="button" class="{search_send_active}">{lang.message_send_box}</a>
    </div>

    <ul data-role="listview">
         {@users_message}
            <li>
                <a href="{BASE_URL}user/message_detail/?search={search}&amp;idx={users_message->idx}" data-rel="dialog" data-transition="flip"><h3>{users_message->title}</h3>
                    <p>
                        {? search == 'receive'}
                            {lang.sender}
                        {:}
                            {lang.receiver}
                        {/}
                        : {users_message->print_name}
                    </p>
                    <p><span id = "is_read_{users_message->idx}" class="{users_message->is_read_class}">[{users_message->is_read_text}]</span> [{users_message->print_send_date}]</p>
                </a>
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