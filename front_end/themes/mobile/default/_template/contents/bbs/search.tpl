<div data-role="header" style="color:#99ff00"><h1>{lang.search_word} : {search_word}</h1></div>
<ul data-role="listview">

    {@lists}
	    <li>
            <a href="{BASE_URL}bbs/view/{lists->bbs_id}?idx={lists->idx}" target = "_blank" data-ajax="false">
                <h3>
                    {lists->print_title}
                    {? lists->comment_count > 0}
                        &nbsp;<span class = "comment_count">({lists->comment_count})</span>
                    {/}
                </h3>
            	<p>
                    {? lists->is_notice == 1}
                        <img src = "{FRONTEND_COMMON}img/icon/notice.gif" width = "29" height = "11" alt = "{lang.is_notice}" />&nbsp;
                    {/}

                    {? lists->is_secret == 1}
                        <img src = "{FRONTEND_COMMON}img/icon/secret.gif" width = "15" height = "11" alt = "{lang.is_secret}" />
                    {/}
                    {lists->print_name} | {lists->print_insert_date}
                </p>

                <p>
                    {lang.bbs} : {lists->bbs_name}
                    {? lists->category_name != ''}
                        &gt; {lang.category} : {lists->category_name}
                    {/}
                </p>
            </a>
        </li>
    {/}

    {? lists.size_ < 1}
        <li>
            <h3>- {lang.none} -</h3>
        </li>
    {/}
</ul>

{? pagination != ''}
<div data-role="footer" data-theme="d" align = "center">
	<div data-role="controlgroup" data-type="horizontal" style = "margin-top:7px;margin-bottom:7px">
        {pagination}
	</div>
</div>
{/}