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

    <div id = "contents">{#contents}</div>

</div>

<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/tapbbs.js"></script>
<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/fileuploader.tapbbs.js"></script>
<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/global.action.js"></script>

<script type="text/javascript">
    //사파리,오페라에서는 뒤로가기하면 캐쉬된페이지에서 아무런 실행을 안해서..
    window.onunload = function(){};
</script>

</div>

</body>

</html>