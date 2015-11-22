<!DOCTYPE HTML>
<html>

<head>
    <title>{browser_title}</title>
    {@ meta }
        <meta name="{.name}" type="{.type}" content="{.content}" />
    {/}
    <meta name="Description" type="" content="TapBBS, ZzanLAB" />
    <meta name="Keywords" type="" content="tapbbs, 게시판, 보드, Board, CMS, ZzanLAB" />
    <meta name="Author" type="" content="ZzanLAB" />
    <meta property="og:image" content="{BASE_URL}facebook_thumbnail.png" />
    <link rel="stylesheet" type="text/css" href="{FRONTEND}css/style.css" />
    <link rel="stylesheet" type="text/css" href="{FRONTEND_THIRD_PARTY}bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="{FRONTEND_THIRD_PARTY}jquery-loadmask-0.4/jquery.loadmask.css" />

    <link href="{FRONTEND_COMMON}css/jquery.alerts.tapbbs.css" rel="stylesheet" type="text/css" />
    <link href="{FRONTEND_COMMON}css/fileuploader.tapbbs.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{BASE_URL}{SETTING_favicon_path}" />
    <!-- modernizr enables HTML5 elements and feature detects -->
    {FRONTEND_JS_VARIABLES}
    <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}modernizr.2.6.2.min.js"></script>
    <script type="text/javascript" src="{BASE_URL}js/lang_js"></script>
    <script type="text/javascript" src="{BASE_URL}js/base_url_js"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}DD_belatedPNG_0.0.8a-min.js"></script>
    <script type = "text/javascript">
        /* EXAMPLE */
        DD_belatedPNG.fix('img');

        /* string argument can be any CSS selector */
        /* .png_bg example is unnecessary */
        /* change it to what suits you! */
    </script>
    <![endif]-->
    <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="{FRONTEND_COMMON}js/jquery.alerts.tapbbs.js"></script>
</head>

<body>
<div id="main">{#contents}</div>

<!-- javascript at the bottom for fast page loading -->
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery.cookie.js"></script>
<script type="text/javascript" src="{BASE_URL}front_end/common/js/tapbbs.js"></script>
<script type = "text/javascript" src = "{BASE_URL}front_end/common/js/global.action.js"></script>

</body>
</html>