<section id="blog">
    <div class="container">
        <div>
            <h2><i class="fa fa-users"></i> {lang.menu_user_scrap}</h2>
            <table class="bbs_table">
                <colgroup>
                    <col />
                    <col width="200" />
                </colgroup>
                <thead>
                <tr>
                    <th>{lang.title}</th>
                    <th>{lang.action}</th>
                </tr>
                </thead>
                {@users_url}
                    <tr>
                        <td class="left" style="padding-left:20px"><a href = "{BASE_URL}bbs/view/{users_url->bbs_id}?idx={users_url->article_idx}" target = "_blank">{users_url->title}</a></td>
                        <td class="center"><a class = "cursor" onclick = "delete_url({users_url->idx}, '{BASE_URL}user/scrap', {SETTING_ajax_timeout});">[{lang.delete}]</a></td>
                    </tr>
                {:}
                    <tr>
                        <td colspan="2">{lang.none}</td>
                    </tr>
                {/}
            </table>

            <div class="col-md-12 center">
                <ul class="pagination" style="margin:0 0 30px 0">
                    {pagination}
                </ul>
            </div>
        </div>
    </div>
</section>

<form method = "post" name = "delete_url_form" id = "delete_url_form">
    <input type = "hidden" name = "idx" id = "idx" value = "" />
    <input type = "hidden" name = "type" id = "type" value = "scrap" />
</form>