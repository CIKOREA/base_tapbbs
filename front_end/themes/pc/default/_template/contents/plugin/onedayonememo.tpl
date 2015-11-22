<style type = "text/css">
    #onedayonememo_write_div{padding-top:7px}
</style>

<div class="row-fluid">
    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{lang.onedayonememo}</div>
    </div>
</div>
<div class="clearfix"></div>

<table class="data-table">
    <colgroup>
        <col width="40" />
        <col />
        <col width="120" />
        <col width="120" />
        <col width="40" />
    </colgroup>
    <tbody>
        {@lists}
        <tr>
            <td>
            {? lists->new_article_icon}
                <img src = "{lists->new_article_icon}" width = "16" height = "11" alt = "new" />
            {/}
            {lists->contents_detail}
            <div class="clearfix"></div>
            <div class="right">
                {lists->print_name} | {lists->print_date}
                <br />
                {lang.point_gamble} : {lists->point_gamble} | {lang.point_random} : {lists->point_random} | {lang.point_insert} : <span style="{lists->point_gamble_success_style}">{lists->point_insert}</span>
            </div>
            </td>
        </tr>
        {:}
        <tr>
            <td>- {lang.none} -</td>
        </tr>
        {/}
    </tbody>
</table>

<div class="row-fluid">
{?pagination !== ''}
    <div class="pull-left pagination">
        <ul>
        {pagination}
        </ul>
    </div>
{/}
</div>
<div class="clearfix"></div>

{? IS_USER_LOGIN === true}
<div id="onedayonememo_write_div" align="center">
    <form method="post" name="onedayonememo_write_form" id="onedayonememo_write_form" action="{BASE_URL}plugin/onedayonememo/write" onsubmit = "return form_null_check('onedayonememo_write_form', 'contents^{lang.contents}');">
        <textarea name = "contents" id = "contents" class="input-block-level"></textarea>
        <div style = "height:7px"></div>
        ▼ {lang.point_gamble}<br />
        <input type="hidden" name="point_gamble" id="point_gamble" value="0" />
        <div class="btn-toolbar">
            <div class="btn-group"></div>
            <div class="btn-group">
            {@ range(1,max_point)}
                <button type="button" class="btn btn-large" title="{.value_}">{= sprintf('%02d', .value_)}</button>
                {? .value_ % 10 == 0 && .value_ != max_point }
                </div>
                <div class="btn-group">
                {/}
            {/}
            </div>
        </div>
        <input type = "button" class="btn btn-success" onclick = "write_onedayonememo('{BASE_URL}plugin/onedayonememo/lists', {SETTING_ajax_timeout});" value = "{lang.write}" />
    </form>
</div>
{/}

<script type = "text/javascript" src = "{FRONTEND_COMMON}js/plugin/onedayonememo.js"></script>