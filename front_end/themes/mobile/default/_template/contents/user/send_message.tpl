{? error_msg !== NULL}
<script type = "text/javascript">
    jAlert('{error_msg}', lang['alert'], function(r) { if(r) { $('#btn_close').click(); } });
</script>
{/}

<div data-role="header" data-theme="d">
    <h1>{lang.message}</h1>
</div>
<div data-role="content" data-theme="c">
    {? receiver_user_idx !== NULL}
    TO : {print_receiver_name}
    {/}
    <form method = "post" name = "send_message_form" id = "send_message_form" data-ajax="false">
        <input type = "hidden" name = "receiver" id = "receiver" value = "{receiver_user_idx}" />
        <p><div align = "center"><textarea name = "contents" id = "contents"></textarea></div></p>
    </form>
    <a data-role="button" data-icon="plus" data-theme="e" onclick = "send_message_exec({SETTING_ajax_timeout});">{lang.send}</a>
    <a id = "btn_close" data-role="button" data-rel="back" data-icon="back" data-theme="c">{lang.close}</a>
</div>