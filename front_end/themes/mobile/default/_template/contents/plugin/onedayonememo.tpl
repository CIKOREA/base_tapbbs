<style type = "text/css">
	.onedayonememo_detail{padding:0.5em;font-size:0.8em;background:#ffffff}
    .onedayonememo_detail_point{font-size:0.9em}
    #onedayonememo_write_div{padding-top:7px}
</style>

<ul data-role="listview">

    {@lists}
    	<li id = "onedayonememo_{lists->idx}" data-icon='arrow-d'>
            <a onclick = "toggle_onedayonememo_detail({lists->idx});">
                <h3>{lists->contents}</h3>
	            <p>
                    {? lists->new_article_icon}
                    <img src = "{lists->new_article_icon}" width = "16" height = "11" alt = "new" />&nbsp;
                    {/}    
                    {lists->print_name} | {lists->print_date}
                </p>
            </a>
        </li>

    	<div id = "onedayonememo_detail_{lists->idx}" class = "onedayonememo_detail" style="display:none">
            {lists->contents_detail}
	        <br><br>
            <span class = "onedayonememo_detail_point">
                {lang.point_gamble} : {lists->point_gamble} | {lang.point_random} : {lists->point_random} |
                {lang.point_insert} : <span style="{lists->point_gamble_success_style}">{lists->point_insert}</span>
            </span>
	    </div>
    {:}
        <li>
            <h3>- {lang.none} -</h3>
        </li>
    {/}
</ul>

{? pagination != ''}
    <div data-role="footer" data-theme="d" align = "center">
        <div data-role="controlgroup" data-type="horizontal" style = "margin-top:7px;margin-bottom:7px">
            {pagination}
        </div>
    </div>
{/}

{? IS_USER_LOGIN === true}
<div id="onedayonememo_write_div" align="center">
    <form method="post" name="onedayonememo_write_form" id="onedayonememo_write_form" data-ajax="false" action="{BASE_URL}plugin/onedayonememo/write" onsubmit = "return form_null_check('onedayonememo_write_form', 'contents^{lang.contents}');">
        <textarea name = "contents" id = "contents"></textarea>
        <div style = "height:7px"></div>
        ▼ {lang.point_gamble}<br />
        <input type="range" name="point_gamble" id="point_gamble" value="0" min="0" max="{max_point}" />
        <button type="button" data-icon="plus" data-theme="e" onclick="write_onedayonememo('{BASE_URL}plugin/onedayonememo/lists', {SETTING_ajax_timeout});">{lang.write}</button>
    </form>
</div>
{/}

<script type = "text/javascript" src = "{FRONTEND_COMMON}js/plugin/onedayonememo.js"></script>