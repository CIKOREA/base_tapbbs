{? need_update_password}
<script type = "text/javascript">
    jAlert('<!--{need_update_password}-->', lang['alert'], function(r) { if(r) {} });
</script>
{/}
<ul data-role="listview">
	<li data-role="list-divider">{community_bbs_name}</li>
    {@ community }
        <li>
            <a href="{BASE_URL}bbs/view/{community->bbs_id}?idx={community->idx}&lists_style={gallery_bbs_lists_style}" data-ajax="false">
                <h3>
                    {community->title}
                    {? community->comment_count > 0}
                        &nbsp;<span class="comment_count">({community->comment_count})</span>
                    {/}
                </h3>
                <p>
                    {? community->new_article_icon}
                        <img src = "{BASE_URL}{community->new_article_icon}" width = "16" height = "11" alt = "new" />&nbsp;
                    {/}
                    {community->name} | {community->timestamp}
                </p>
                {? community->category_name}
                    <p>{lang.category} : {community->category_name}</p>
                {/}
            </a>
        </li>
    {/}
    <li data-role="list-divider">{gallery_bbs_name}</li>
    {@ gallery }
        <li>
            <a href="{BASE_URL}bbs/view/{gallery->bbs_id}?idx={gallery->idx}&lists_style={gallery_bbs_lists_style}" data-ajax="false">
                <h3>
                {gallery->title}
                {? gallery->comment_count > 0}
                    &nbsp;<span class="comment_count">({gallery->comment_count})</span>
                {/}
                </h3>
                <p>
                {? gallery->new_article_icon}
                    <img src = "{gallery->new_article_icon}" width = "16" height = "11" alt = "new" />&nbsp;
                {/}
                {gallery->name} | {gallery->timestamp}
                </p>
            {? gallery->category_name}
                <p>{lang.category} : {gallery->category_name}</p>
            {/}
            </a>
        </li>
    {/}
	<li data-role="list-divider">{lang.plugin_onedayonememo}</li>
    {@ onedayonememo}
         <li>
            <h3>{.contents}</h3>
                <p>
                {? .new_article_icon}
                    <img src = "{.new_article_icon}" width = "16" height = "11" alt = "new" />&nbsp;
                {/}
                {.name} | {.timestamp}
            </p>
        </li>
    {/}
	<li data-role="list-divider">{lang.recently_comment}</li>
    {@ recently_comment}
        <li>
            <a href="{BASE_URL}bbs/view/{.bbs_id}?idx={.article_idx}&amp;page_comment={recently_comment_page[.key_]}" data-ajax="false">
                <h3>{.comment}</h3>
                <p>
                    {? .new_comment_icon != ''}
                        <img src = "{.new_comment_icon}" width = "16" height = "11" alt = "new" />&nbsp;
                    {/}
                    {.print_name} | {.print_date}
                </p>
            </a>
        </li>
    {/}

	<li data-role="list-divider">Google News</li>
	<li><a id = "feed_google_1" href="" target = "_blank" data-ajax="false"></a></li>
	<li><a id = "feed_google_2" href="" target = "_blank" data-ajax="false"></a></li>
	<li><a id = "feed_google_3" href="" target = "_blank" data-ajax="false"></a></li>
</ul>

<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery.jgfeed-min.js"></script>
<script type = "text/javascript" src = "{FRONTEND_COMMON}js/feed_google.js"></script>
