<div id="point_div" align="center">
    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{lang.menu_user_point}</div>
        <div class="buttons">
            <button type="button" class="btn{? operator == 'all' || operator == ''} btn-info{/}"
            onclick="window.location.href='{BASE_URL}user/point?operator=all';">{lang.all}</button><button
            type="button" class="btn{? operator == 'plus'} btn-info{/}"
            onclick="window.location.href='{BASE_URL}user/point?operator=plus';">{lang.plus}</button><button
            type="button" class="btn{? operator == 'minus'} btn-info{/}"
            onclick="window.location.href='{BASE_URL}user/point?operator=minus';">{lang.minus}</button>
        </div>
    </div>

    <div class="clearfix"></div>

    <table class="data-table">
        <col><col width="80"><col width="180">
        <tbody>
            <tr>
                <th>{lang.point_info}</th>
                <th>{lang.point}</th>
                <th>{lang.timestamp}</th>
            </tr>
        {@users_point}
            <tr>
                <th class="text_left">{users_point->alliance}</th>
                <td class="text_center">{users_point->point}{SETTING_point_unit}</td>
                <td class="text_right">{users_point->exec_date}</td>
            </tr>
        {:}
            <td colspan="3" class="text_center">
                - {lang.none} -
            </td>
        {/}
        </tbody>
    </table>
</div>

{? pagination != ''}
    <div class="pull-left pagination">
        <ul>
            {pagination}
        </ul>
    </div>
{/}