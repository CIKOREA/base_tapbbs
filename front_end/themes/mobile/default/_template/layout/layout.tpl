<!DOCTYPE html>
<html lang="ko">
<head>
    {@ meta }
        <meta name="{.name}" type="{.type}" content="{.content}" />
    {/}
    <meta name="Description" type="" content="TapBBS, ZzanLAB" />
    <meta name="Keywords" type="" content="tapbbs, 게시판, 보드, Board, CMS, ZzanLAB" />
    <meta name="Author" type="" content="ZzanLAB" />
    <meta property="og:image" content="{BASE_URL}facebook_thumbnail.png" />
	<title>{browser_title}</title>
    <link href="{FRONTEND_THIRD_PARTY}jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.css" rel="stylesheet" type="text/css" />
    <link href="{FRONTEND_COMMON}css/jquery.alerts.tapbbs.css" rel="stylesheet" type="text/css" />
    <link href="{FRONTEND_COMMON}css/fileuploader.tapbbs.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{FRONTEND}css/layout.css" /> <!-- 순서중요, 위 css를 재정의하는 부분 있음 -->
	<link rel="icon" href="{BASE_URL}{SETTING_favicon_path}" />
    <link rel="{SETTING_apple_touch_icon_rel}" href="{BASE_URL}{SETTING_apple_touch_icon_path}" />
    {FRONTEND_JS_VARIABLES}
	<script type = "text/javascript" src = "{FRONTEND_THIRD_PARTY}jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery.cookie.js"></script>
	<script type = "text/javascript">
		/*
		$(document).bind("mobileinit", function(){
			$.mobile.hashListeningEnabled = false; // http://sssssssssss#top 이런 hash를 히스토리로 이용하느라 아무런 페이지도 나오지 않아서
		});
		*/
	</script>
	<script type = "text/javascript" src = "{FRONTEND_THIRD_PARTY}jquery.mobile-1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script type = "text/javascript" src = "{FRONTEND_COMMON}js/jquery.alerts.tapbbs.js"></script>
	<script type = "text/javascript" src = "{BASE_URL}js/lang_js"></script>
	<script type = "text/javascript" src = "{BASE_URL}js/base_url_js"></script>
	<!--[if IE 6]>
	<script type = "text/javascript" src = "{FRONTEND_THIRD_PARTY}DD_belatedPNG_0.0.8a-min.js"></script>
	<script type = "text/javascript">
		/* EXAMPLE */
		DD_belatedPNG.fix('img');

		/* string argument can be any CSS selector */
		/* .png_bg example is unnecessary */
		/* change it to what suits you! */
	</script>
	<![endif]-->
</head>

<body>
<div data-role="page" id = "page" style = "min-height:500px">
	<div data-role="header" id = "header">
		<h1><a onclick = "location.href='{BASE_URL}';" class = "cursor"><img src = "{BASE_URL}apple-touch-icon_tapbbs.png" alt = "logo" /></a></h1>
        {? IS_HOME == '0'}
            <a onclick = "location.href='{BASE_URL}';" data-icon="home" data-iconpos="notext" class="ui-btn-right jqm-home">Home</a>
        {/}
	</div>
	<div data-role="footer" id = "footer">
		<h4>3분 게시판, 초간단 MOBILE && PC 게시판.</h4>
	</div>
    <!--
	<div id = "menu" class = "clear menu_background">
		<ul>
			<li class = "left tab tab_bar tab_off" onclick = "location.href='{BASE_URL}bbs/lists/reviews';" title="reviews">리뷰</li>
			<li class = "left tab tab_bar tab_off" onclick = "location.href='{BASE_URL}bbs/lists/community';" title="community">커뮤니티</li>
			<li class = "left tab_right_last tab_off" onclick = "location.href='{BASE_URL}plugin/onedayonememo/lists';" title="onedayonememo">하루한마디</li>
		</ul>
	</div>
	-->

    <div data-role="footer">
        <div data-role="navbar">
            <ul>
                <li><a onclick = "location.href='{BASE_URL}page/introduce';" {? strpos(_SERVER.PHP_SELF, 'page/introduce') }class="ui-btn-active"{/}>소개</a></li>
                <li><a onclick = "location.href='{BASE_URL}bbs/lists/community';" {? segment && segment[1] == 'bbs' && segment[3] == 'community' }class="ui-btn-active"{/}>커뮤니티</a></li>
                <li><a onclick = "location.href='{BASE_URL}bbs/lists/gallery?lists_style=gallery';" {? segment && segment[1] == 'bbs' && segment[3] == 'gallery' }class="ui-btn-active"{/}>갤러리</a></li>
                <li><a style="margin-right:0px" onclick = "location.href='{BASE_URL}plugin/onedayonememo/lists';" {? strpos(_SERVER.PHP_SELF, 'plugin/onedayonememo') }class="ui-btn-active"{/}">하루한마디</a></li>
            </ul>
        </div>
    </div>

	<div data-role="header" id = "message_count_div" style="display:none"><h1><a href = "{BASE_URL}user/message" data-ajax="false" style = "color:#99ff00">{lang.new_message} : <span id = "message_count">0</span></a></h1></div>

    <div id="tapbbs_navigation">{navigation}</div>

	<div id = "contents">{#contents}</div>

	<div class="ui-body ui-body-b">
	<fieldset >
		<form method = "get" name = "search_form" id = "search_form" action = "{BASE_URL}search" data-ajax="false" onsubmit = "return form_null_check('search_form', 'search_word^{lang.search_word}');">
		<div class = "left" style = "width:58%;margin-top:2px"><input type = "search" name = "search_word" id = "search_word" placeholder = "{lang.search_word}" value = "{__GET.search_word}" data-theme="c" /></div><div class = "left" style = "width:2%;">&nbsp;</div><div class = "left" style = "width:40%;"><input type = "submit" value = "{lang.search}" data-icon="search" data-theme="c" /></div>
		</form>
	</fieldset>
	</div>

    {? IS_USER_LOGIN === true}
        <div data-role="footer" data-theme="d" align="center">
            {USER_name_print}, {lang.point} : {USER_INFO_point}{SETTING_point_unit}
        </div>
    {/}

	<div data-role="footer" data-theme="c" align = "center">
		<br />
		&copy; Since 2012. ZzanLAB.<br />
		powered by <a href = "http://www.zzanlab.com" target = "_blank" data-role="none">ZzanLAB - TapBBS</a>.<br />

        {? IS_USER_LOGIN === TRUE}
            <br /><a data-icon="delete" onclick = "location.href='{BASE_URL}user/logout/';" data-inline="true">{lang.btn_logout}</a> <a data-icon="gear" onclick = "location.href='{BASE_URL}user/modify/';" data-inline="true">{lang.btn_account}</a> <a data-icon="arrow-r" onclick="location.href=updateURLParameter('viewport', 'pc');" data-inline="true">{lang.btn_go_pc}</a>
            {? IS_ADMIN === TRUE}
                <br /><a data-icon="gear" onclick = "window.open('{BASE_URL}admin/setting');" data-inline="true">{lang.btn_admin}</a>
        {/}
            <br />
        {:}
            <br /><a data-icon="check" onclick = "location.href='{BASE_URL}user/login/?referer={REFERER_URL}';" data-inline="true">{lang.btn_login}</a> <a data-icon="arrow-r" onclick="location.href=updateURLParameter('viewport', 'pc');" data-inline="true">{lang.btn_go_pc}</a><br />
        {/}
		<br />
	</div>

    {tapbbs_profiler}

</div>

	<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/tapbbs.js"></script>
	<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/fileuploader.tapbbs.js"></script>
	<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/global.action.js"></script>
	<script type="text/javascript">
		//onload
		$(document).ready(function() {
            <!--{? IS_USER_LOGIN === TRUE}-->
                set_message_count('message_count_div', 'message_count', <!--{SETTING_ajax_timeout}-->);
                setInterval(function() {
                    set_message_count('message_count_div', 'message_count', <!--{SETTING_ajax_timeout}-->);
                }, 30 * 1000); //30초에 한번 //반복하고자 하면 이부분을 추가한다. 하지만 부하가 발생할 수 있다. 설정으로 빼진 않는다.
            <!--{/}-->
		});

		//사파리,오페라에서는 뒤로가기하면 캐쉬된페이지에서 아무런 실행을 안해서..
		window.onunload = function(){};
	</script>
</div>

<script type="text/javascript">
$(document).ready(function(){
    /*$('#codeigniter_profiler').clone().attr('id', 'tapbbs_profiler').appendTo('#page');
    $('#codeigniter_profiler').remove();*/
});
</script>

</body>

</html>