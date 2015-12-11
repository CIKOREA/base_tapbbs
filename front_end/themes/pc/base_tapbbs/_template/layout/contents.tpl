<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CodeIgniter 한국사용자포럼, PHP Framework"/>
    <meta name="keywords" content="CodeIgniter, 한국사용자포럼"/>
    <meta name="author" content="">
    {@ meta }
    <meta name="{.name}" type="{.type}" content="{.content}" />
    {/}
    <title>{browser_title}</title>
	
	<!-- core CSS -->
    <link href="{FRONTEND}css/bootstrap.min.css" rel="stylesheet">
    <link href="{FRONTEND}css/font-awesome.min.css" rel="stylesheet">
    <link href="{FRONTEND}css/animate.min.css" rel="stylesheet">
    <link href="{FRONTEND}css/prettyPhoto.css" rel="stylesheet">
    <link href="{FRONTEND}css/main.css" rel="stylesheet">
    <link href="{FRONTEND}css/responsive.css" rel="stylesheet">
    <link href="{FRONTEND_COMMON}css/jquery.alerts.tapbbs.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="{FRONTEND}js/html5shiv.js"></script>
    <script src="{FRONTEND}js/respond.min.js"></script>
    <![endif]-->
    <link rel="icon" href="{BASE_URL}{SETTING_favicon_path}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{FRONTEND}images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{FRONTEND}images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{FRONTEND}images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{FRONTEND}images/ico/apple-touch-icon-57-precomposed.png">

    {FRONTEND_JS_VARIABLES}
    <script type="text/javascript" src="{BASE_URL}js/lang_js"></script>
    <script type="text/javascript" src="{BASE_URL}js/base_url_js"></script>

    <!--script src="{FRONTEND}js/jquery.js"></script-->
    <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}modernizr.2.6.2.min.js"></script>
    <script type="text/javascript" src="{FRONTEND_COMMON}js/jquery.alerts.tapbbs.js"></script>
</head><!--/head-->

<body class="homepage">
    <div id="contents">
        {#contents}
    </div>

    {tapbbs_profiler}

    <script src="{FRONTEND}js/bootstrap.min.js"></script>
    <script src="{FRONTEND_THIRD_PARTY}jquery.cookie.js"></script>
    <script src="{FRONTEND}js/jquery.prettyPhoto.js"></script>
    <script src="{FRONTEND}js/jquery.isotope.min.js"></script>
    <script src="{FRONTEND}js/main.js"></script>
    <script src="{FRONTEND}js/wow.min.js"></script>
</body>
</html>