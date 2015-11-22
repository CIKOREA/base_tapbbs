<div class="contents_title_container text-left">
    <span class="divider">|</span>
    <div class="title">{lang.search_word} - {search_word}</div>
</div>
<div class="clearfix"></div>

<table class="data-table">
<colgroup>
<col width="40" />
<col width="100" />
<col />
<col width="120" />
<col width="120" />
<col width="60" />
</colgroup>
<thead>
<tr>
    <th>No</th>
    <th>{lang.bbs}</th>
    <th>{lang.title}</th>
    <th>{lang.writer}</th>
    <th>{lang.write_time}</th>
    <th>{lang.hit}</th>
</tr>
</thead>

{@ lists}
    <tr>
        <td>{lists->idx}</td>
        <td style="text-align:center">{lists->bbs_name}</td>
        <td>
            <a href="{BASE_URL}bbs/view/{lists->bbs_id}?idx={lists->idx}&amp;page={page}" target = "_blank">{lists->print_title}</a>
            {? lists->comment_count > 0}
                <span class="comment_count">({lists->comment_count})</span>
            {/}

            {? lists->is_notice == 1}
                <img src = "{FRONTEND_COMMON}img/icon/notice.gif" width = "29" height = "11" alt = "{lang.is_notice}" />
            {/}

            {? lists->is_secret == 1}
                <img src = "{FRONTEND_COMMON}img/icon/secret.gif" width = "15" height = "11" alt = "{lang.is_secret}" />
            {/}
        </td>
        <td>{lists->print_name}</td>
        <td>{lists->print_insert_date}</td>
        <td>{lists->hit}</td>
    </tr>
{:}
    <tr>
        <td colspan="6">{lang.none}</td>
    </tr>
{/}

</table>

<div class="row-fluid">
    {?pagination !== ''}
        <div class="pull-left pagination">
            <ul>
                {pagination}
            </ul>
        </div>
    {/}
</div>
<div class="clearfix"></div>