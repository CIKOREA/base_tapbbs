<div align = "center">
<ul class="gallery">
    {@lists}
        <li name="gallery_item">
            <a href="{BASE_URL}bbs/view/{bbs_id}?idx={lists->idx}&amp;page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}"><img src="{lists->image}" alt="{lists->print_title}" class="gallery_image"></a>
        </li>
    {:}
        <li>
            {lang.none}
        </li>
    {/}
</ul>
</div>

<div class="clearer"></div>

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