<div id = "message_div" align = "center">

    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{lang.message}</div>
        <div class="buttons">
            <button type="button" class="btn{? search == 'receive' || search == ''} btn-info{/}"
            onclick="window.location.href='{BASE_URL}user/message?search=receive';">{lang.message_receive_box}</button><button
            type="button" class="btn{? search == 'send'} btn-info{/}"
            onclick="window.location.href='{BASE_URL}user/message?search=send';">{lang.message_send_box}</button>
        </div>
    </div>
    <div class="clearfix"></div>

    <table class="data-table">

        <col><col width="180"><col width="80">

        <tbody>
                <tr>
                    <th>{lang.message}</th>
                    <th>{lang.timestamp}</th>
                    <th>{lang.status}</th>
                </tr>
            {@users_message}
                <tr>
                    <td class="text_left">
                        <a href="#" role="message_list" search="{search}" idx="{users_message->idx}">
                            {? search == 'receive'}
                                {lang.sender}
                            {:}
                                {lang.receiver}
                            {/}
                            : {users_message->print_name}
			                - {users_message->title}
                        </a>
                    </td>
                    <td>
                        {users_message->print_send_date}
                    </td>
                    <td><span id = "is_read_{users_message->idx}" class="{users_message->is_read_class}">{users_message->is_read_text}</span></td>
                </tr>
            {:}
                <tr>
                    <td colspan="3" class="text_center">{lang.none}</td>
                </tr>
            {/}
        </tbody>
    </table>
</div>

{? pagination != ''}
<div class="pull-left pagination">
    <ul>
        {pagination}
    </ul>
</div>
{/}

<form id="hidden_form">
<input type="hidden" id="search" value="{search}">
<input type="hidden" id="ajax_timeout" value="{SETTING_ajax_timeout}">
</form>

<form method="post" name="delete_message_form" id="delete_message_form">
<input type="hidden" name="idx" id="message_idx" value="" />
<input type="hidden" name="search" value="{search}" />
</form>

<div id="message_detail" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang.message}</h3>
    </div>
    <div class="modal-body">

        <div>
            <span name="kind"></span> : <span name="name"></span>
        </div>

        <div>
            <span name="receive_date"></span>
        </div>

        <br />

        <div name="contents"></div>

    </div>
    <div class="modal-footer">
        <a href="#" name="delete_link" class="btn btn-danger">{lang.delete}</a>
        <a href="#" name="reply_link" class="hide btn btn-info" role="button" data-toggle="modal">{lang.reply_message}</a>
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">{lang.close}</a>
    </div>
</div>

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