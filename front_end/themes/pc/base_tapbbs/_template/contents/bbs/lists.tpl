<section id="blog">
    <div class="container">
        <div>
            <h2><i class="fa fa-users"></i> {BBS_SETTING_bbs_name}</h2>
            <table class="bbs_table">
                <colgroup>
                    <col width="60" />
                    {? is_use_category == true}
                        <col width="110" />
                    {/}
                    <col />
                    <col width="120" />
                    <col width="120" />
                    <col width="80" />
                </colgroup>
                <thead>
                <tr>
                    <th>No</th>
                    {? is_use_category == true}
                        <th>{lang.category}</th>
                    {/}
                    <th>{lang.title}</th>
                    <th>{lang.writer}</th>
                    <th>{lang.write_time}</th>
                    <th>{lang.hit}</th>
                </tr>
                </thead>
                {@ lists}
                <tr>
                    <td class="center">{lists->idx}</td>
                    {? is_use_category == true}
                    <td class="center">{? lists->category_name}{lists->category_name}{:}{lang.none}{/}</td>
                    {/}
                    <td>
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
                    </td>
                    <td class="center">{lists->print_name}</td>
                    <td class="center">{lists->print_webzine_insert_date}</td>
                    <td class="center">{lists->hit}</td>
                </tr>
                {:}
                <tr>
                    <td colspan="6">{lang.none}</td>
                </tr>
                {/}
            </table>

            <div class="col-md-12 center">
                <div class="pull-left col-md-10">
                    <ul class="pagination" style="margin:0 0 30px 0">
                        {pagination}
                    </ul>
                </div>

                <div class="pull-right col-md-2" style="text-align: right;padding-right:60px">
                    {? allowed_list.write_article === TRUE}
                        <a href="{BASE_URL}bbs/write/{bbs_id}?view_category={view_category}&lists_style={lists_style}" class="btn btn-small btn-info">{lang.write}</a>
                    {/}
                </div>
            </div>
        </div>
    </div>
</section>