{? idx == ''}
    <script type="text/javascript">
        jAlert(lang['unusual_approach'], lang['alert'], function(r) { if(r) { history.back(); return false; } });
    </script>
{:}
    <div data-role="header" data-theme="d">
        <h1>{lang.message}</h1>
    </div>
    <div data-role="content" data-theme="c">
        {? title != ''}
            <h1>{title}</h1>
        {/}

        {? search == 'receive'}
            FROM
        {:}
            TO
        {/}
         : {print_name}

        {? search == 'send' && print_receive_date != ''}
            <br />{lang.timestamp_receive} : {print_receive_date}
        {/}

        <p>{contents}</p>

        {? search == 'receive'}
            <a href="{BASE_URL}user/send_message?receiver={sender_user_idx}" data-rel="dialog" data-transition="flip" data-icon="forward" data-role="button">{lang.reply_message}</a>
        {/}

        <a data-role="button" data-icon="delete" onclick="delete_message('{BASE_URL}user/message?search={search}', {SETTING_ajax_timeout});">{lang.delete}</a>
        <a id="btn_close" data-role="button" data-rel="back" data-theme="c" data-icon="back">{lang.close}</a>
    </div>

    <form method="post" name="delete_message_form" id="delete_message_form">
        <input type="hidden" name="idx" id="idx" value="{idx}" />
        <input type="hidden" name="search" id="search" value="{search}" />
    </form>

    {? search == 'receive'}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#is_read_{idx}').html('['+lang['is_read_1']+']').removeClass('is_read_0 is_read_1').addClass('is_read_1');
            //읽은 후 상단 새메시지 알림부분을 한번 실행해준다.
            set_message_count('message_count_div', 'message_count', {SETTING_ajax_timeout});
        });
    </script>
    {/}
{/}