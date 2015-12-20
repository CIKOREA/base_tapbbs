<section id="blog">
    <div class="container">
        <div>
            <h2><i class="fa fa-users"></i> {lang.menu_user_friend}</h2>
            <table class="bbs_table">
                <colgroup>
                    <col />
                    <col width="200" />
                </colgroup>
                <thead>
                <tr>
                    <th>{lang.friend}</th>
                    <th>{lang.action}</th>
                </tr>
                </thead>
                {@ users_friend}
                    <tr>
                        <td class="left">
                            <a href="#send_message" title="{users_friend->print_name}" role="friends" data-toggle="modal" idx="{users_friend->friend_user_idx}">{users_friend->print_name}</a>
                        </td>
                        <td class="center"><a class="cursor" onclick="delete_friend({users_friend->idx}, '{BASE_URL}user/friend', {SETTING_ajax_timeout});">[{lang.delete}]</a></td>
                    </tr>
                {:}
                    <tr>
                        <td colspan="2" class="center">{lang.none}</td>
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

<form method="post" name="delete_friend_form" id="delete_friend_form">
    <input type="hidden" name="idx" id="idx" value="" />
</form>

<div id="send_message" class="modal hide fade">
    <form method="post" name="send_message_form" id="send_message_form" data-ajax="false" style="margin-bottom:0px">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang.message}</h3>
        </div>
        <div class="modal-body">
            TO : <span id="print_receiver_name"></span>
            <input type="hidden" name="receiver" id="receiver" value="" />
            <p><div align="center"><textarea name="contents" id="contents" rows="5" class="span6"></textarea></div></p>
        </div>
        <div class="modal-footer">
            <a href="#" id="btn_close" class="btn" data-dismiss="modal" aria-hidden="true">{lang.close}</a>
            <a href="#" class="btn btn-primary" onclick="send_message_exec({SETTING_ajax_timeout});">{lang.send}</a>
        </div>
    </form>
</div>