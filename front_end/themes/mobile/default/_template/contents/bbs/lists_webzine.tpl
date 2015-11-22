<style type="text/css">
    .ui-li {height:90px;}
    .ui-li-thumb {max-width:88px !important;min-height:88px;}
</style>

<ul data-role="listview" xmlns="http://www.w3.org/1999/html">
    {@ lists}
        <li>
            <a href="{BASE_URL}bbs/view/{bbs_id}?idx={lists->idx}&amp;page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}" data-ajax="false">
                <img src="{lists->image}" />
                <h3 {lists->hit_color}>{lists->print_title}
                {? lists->comment_count > 0}
                    &nbsp;<span class = "comment_count">({lists->comment_count})</span>
                {/}
                </h3>
                <p>
                    {? lists->new_article_icon}
                    <img src = "{BASE_URL}{lists->new_article_icon}" width = "16" height = "11" alt = "new" />&nbsp;
                    {/}    
                    {? lists->is_notice == 1}
                        <img src = "{FRONTEND_COMMON}img/icon/notice.gif" width = "29" height = "11" alt = "{lang.is_notice}" />&nbsp;
                    {/}

                    {? lists->is_secret == 1}
                        <img src = "{FRONTEND_COMMON}img/icon/secret.gif" width = "15" height = "11" alt = "{lang.is_secret}" />
                    {/}

                    {lists->print_name} | {lists->print_insert_date}

                    {? lists->category_name != ''}
                        <p>
                            {lang.category} : {lists->category_name}
                        </p>
                    {/}
                </p>
            </a>
        </li>
    {:}
        <li>
            <h3>- {lang.none} -</h3>
        </li>
    {/}
</ul>

{? pagination !== ''}
    <div data-role="footer" data-theme="d" align = "center">
        <div data-role="controlgroup" data-type="horizontal" style = "margin-top:7px;margin-bottom:7px">
            {pagination}
            {? rss_allow === TRUE}
                <a data-role="button" data-ajax="false" href="{BASE_URL}bbs/rss/{bbs_id}" target = "_blank"><img src = "{FRONTEND_COMMON}img/icon/rss.png" width = "11" height = "11" alt = "rss" /></a>
            {/}
        </div>
    </div>
{/}

{? allowed_list.write_article === TRUE}
    <div id="write_btn_in_lists_div">
        <button type="button" data-icon="plus" data-theme="e" onclick="location.href='{BASE_URL}bbs/write/{bbs_id}?view_category={view_category}&amp;lists_style={lists_style}';">{lang.write}</button>
    </div>
{/}