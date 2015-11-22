<div class="row-fluid">
    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{BBS_SETTING_bbs_name}</div>
        {? rss_allow == TRUE}
        <div class="buttons">
            <a href="{BASE_URL}bbs/rss/{bbs_id}" target="_blank" class="btn btn-small btn-inverse">RSS</a>
        </div>
        {/}
    </div>
</div>
<div class="clearfix"></div>

<div class="btn-toolbar">

{? is_use_category === TRUE}
    <input type = "hidden" name = "lists_style" id = "lists_style" value = "{lists_style}" />
    <select name="category" id="view_category">
        <option value="">== {lang.select} ==</option>
        {@ category}
        <option value="{category->idx}" {category->selected}>{category->category_name}</option>
        {/}
    </select>
{/}

  <div class="btn-group right" style = "margin-bottom:20px">
    <a class="btn" href="{BASE_URL}bbs/lists/{bbs_id}?page={page}&view_category={view_category}&lists_style="><i class="icon-align-justify"></i></a>
    <a class="btn btn-info" href="{BASE_URL}bbs/lists/{bbs_id}?page={page}&view_category={view_category}&lists_style=webzine"><i class="icon-th-list"></i></a>
    <a class="btn" href="{BASE_URL}bbs/lists/{bbs_id}?page={page}&view_category={view_category}&lists_style=gallery"><i class="icon-th-large"></i></a>
  </div>
</div>

<table class="data-table">
<colgroup>
<col width="120" />
<col />
</colgroup>

{@ lists}

    <tr>
        <td><a href="{BASE_URL}bbs/view/{bbs_id}?idx={lists->idx}&amp;page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}"><img src="{lists->image}" alt="{lists->print_title}" class="webzine_image"></a></td>
        <td class="webzine_description">
            <div>
                <a href="{BASE_URL}bbs/view/{bbs_id}?idx={lists->idx}&amp;page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}">{lists->print_title}</a>

                {? lists->comment_count > 0}
                    <span class="comment_count">({lists->comment_count})</span>
                {/}

                {? lists->new_article_icon != ''}
                    <img src="{BASE_URL}{lists->new_article_icon}" width = "16" height = "11" alt = "new" />
                {/}

                {? lists->is_notice == 1}
                    <img src = "{FRONTEND_COMMON}img/icon/notice.gif" width = "29" height = "11" alt = "{lang.is_notice}" />
                {/}

                {? lists->is_secret == 1}
                    <img src = "{FRONTEND_COMMON}img/icon/secret.gif" width = "15" height = "11" alt = "{lang.is_secret}" />
                {/}
            </div>
            <div class="right">
                {? lists->category_name}
                    [{lists->category_name}] |
                {/}
                {lists->print_name} | {lists->hit} | {lists->print_webzine_insert_date}
            </div>
            <div class="clearfix"></div>
            <div class="webzine_contents" style="word-break: break-all;overflow:hidden;height:100px">{lists->print_contents}</div>
        </td>
    </tr>
{:}
    <tr>
        <td colspan="2">{lang.none}</td>
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

    {? allowed_list.write_article === TRUE}
    <div class="pull-right btn-group">
        <a href="{BASE_URL}bbs/write/{bbs_id}?view_category={view_category}&lists_style={lists_style}" class="btn btn-small btn-info">{lang.write}</a>
    </div>
    {/}
</div>
<div class="clearfix"></div>