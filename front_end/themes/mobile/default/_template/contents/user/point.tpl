<div id = "point_div" align = "center">

    <select name="user_menu" id="user_menu" onchange="window.location.href = '{BASE_URL}user/' + this.value;">
        <option value="modify">{lang.menu_user_modify}</option>
        <option value="point" selected="selected">{lang.menu_user_point}</option>
        <option value="scrap">{lang.menu_user_scrap}</option>
        <option value="message">{lang.menu_user_message}</option>
        <option value="friend">{lang.menu_user_friend}</option>
    </select>

    <div data-role="controlgroup" data-type="horizontal" style = "margin-bottom:7px">
        <a onclick = "location.href='{BASE_URL}user/point?operator=all';" data-role="button" class="{operator_all_active}">{lang.all}</a>
        <a onclick = "location.href='{BASE_URL}user/point?operator=plus';" data-role="button" class="{operator_plus_active}">{lang.plus}</a>
        <a onclick = "location.href='{BASE_URL}user/point?operator=minus';" data-role="button" class="{operator_minus_active}">{lang.minus}</a>
    </div>

    <ul data-role="listview">
        {@users_point}
            <li>
                <h3>{users_point->point}{SETTING_point_unit}</h3>
                <p>{users_point->alliance}</p>
                <p class="ui-li-aside">{users_point->exec_date}</p>
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