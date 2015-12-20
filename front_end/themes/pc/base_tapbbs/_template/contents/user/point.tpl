<section id="blog">
    <div class="container">
        <div>
            <h2><i class="fa fa-users"></i> {lang.menu_user_point}</h2>
            <table class="bbs_table">
                <colgroup>
                    <col />
                    <col width="120" />
                    <col width="200" />
                </colgroup>
                <thead>
                <tr>
                    <th>{lang.point_info}</th>
                    <th>{lang.point}</th>
                    <th>{lang.timestamp}</th>
                </tr>
                </thead>
                {@ users_point}
                    <tr>
                        <td class="left" style="padding-left:20px">{users_point->alliance}</td>
                        <td class="center">{users_point->point}{SETTING_point_unit}</td>
                        <td class="center">{users_point->exec_date}</td>
                    </tr>
                {:}
                    <tr>
                        <td colspan="3">{lang.none}</td>
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