<div id="scrap_div" align="center">

    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{lang.menu_user_scrap}</div>
    </div>

    <div class="clearfix"></div>

    <ul data-role="listview">

        <table class="data-table">
            <col><col width="80">
            <tbody>
            <tr>
                <th>{lang.title}</th>
                <th>{lang.action}</th>
            </tr>

            {@users_url}
            <tr>
                <td><a href = "{BASE_URL}bbs/view/{users_url->bbs_id}?idx={users_url->article_idx}" target = "_blank">{users_url->title}</a></td>
                <td class="text-center"><a class = "cursor" onclick = "delete_url({users_url->idx}, '{BASE_URL}user/scrap', {SETTING_ajax_timeout});">[{lang.delete}]</a></td>
            </tr>
            {:}
            <tr>
                <td colspan="2">{lang.none}</td>
            </tr>
            {/}

            </tbody>
        </table>

    </ul>
</div>

{? pagination != ''}
<div class="pull-left pagination">
    <ul>
        {pagination}
    </ul>
</div>
{/}

<form method = "post" name = "delete_url_form" id = "delete_url_form">
    <input type = "hidden" name = "idx" id = "idx" value = "" />
    <input type = "hidden" name = "type" id = "type" value = "scrap" />
</form>