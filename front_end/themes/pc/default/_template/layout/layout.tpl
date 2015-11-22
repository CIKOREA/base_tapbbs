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
    <link rel="stylesheet" type="text/css" href="{FRONTEND_THIRD_PARTY}syntaxhighlighter/styles/shCoreMidnight.css" />
    <link rel="stylesheet" type="text/css" href="{FRONTEND_THIRD_PARTY}syntaxhighlighter/styles/shThemeMidnight.css" />
    

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
<div id="main">
    <header>
        <div id="logo">
            <div id="tapbbs_user_info" class="right">
                {? USER_INFO_idx //로그인되어있으면}
                <div class="clearfix"></div>
                <a href="{BASE_URL}user/logout" class="btn-logout">{lang.btn_logout}</a> |
                <div class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{lang.mypage}</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="{BASE_URL}user/point/">{lang.menu_user_point}</a></li>
                        <li><a href="{BASE_URL}user/friend/">{lang.menu_user_friend}</a></li>
                        <li><a href="{BASE_URL}user/scrap/">{lang.menu_user_scrap}</a></li>
                        <li><a href="{BASE_URL}user/message/">{lang.menu_user_message}</a></li>
                        <li><a href="{BASE_URL}user/modify/">{lang.menu_user_modify}</a></li>
                    </ul>
                </div>
                {:}
                <a href="{BASE_URL}user/login">{lang.btn_login}</a> | <a href="{BASE_URL}user/join">{lang.btn_join}</a>
                {/}
            </div>
            <div id="tapbbs_navigation" class="clearfix right">{navigation}</div>
            <div id="logo_text">
                <h1><a href="{BASE_URL}"><span class="logo_colour">TapBBS</span>&nbsp;-&nbsp;ZzanLAB</a></h1>
                <h2>3분 게시판, 초간단 MOBILE && PC 게시판.</h2>
            </div>
        </div>
        <nav>
            <div id="menu_container">
                <ul class="sf-menu" id="nav">
                    <li><a href="{BASE_URL}">Home</a></li>
                    <li><a href="{BASE_URL}page/introduce">소개</a></li>
                    <li><a href="{BASE_URL}bbs/lists/community">게시판</a>
                        <ul>
                            <li><a href="{BASE_URL}bbs/lists/community">커뮤니티</a></li>
                            <li><a href="{BASE_URL}bbs/lists/gallery?lists_style=gallery">갤러리</a></li>
                        </ul>
                    </li>
                    <li><a href="{BASE_URL}plugin/onedayonememo/lists">플러그인</a>
                        <ul>
                            <li><a href="{BASE_URL}plugin/onedayonememo/lists">하루한마디</a></li>
                            <li><a href="#">추가 개발중...</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div id="site_content">
        <div id="sidebar_container">
            <div class="sidebar">
                {#outlogin}
            </div>
            <div class="sidebar">
                <h3 style="margin-top: 16px">Links</h3>
                <ul>
                    <li><a href="http://zzanlab.com" target="_blank">ZzanLAB</a></li>
                    <li><a href="http://baekangmin.com" target="_blank">배강민</a></li>
                    <li><a href="http://day.pe.kr" target="_blank">최용운</a></li>
                    <li><a href="http://lensvil.tistory.com" target="_blank">전상민</a></li>
                    <li><a href="http://cikorea.net" target="_blank">CI 한국사용자포럼</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            {#contents}
        </div>
    </div>
    <div id="scroll">
        <a title="Scroll to the top" class="top" href="#"><img src="{FRONTEND}img/top.png" alt="top" /></a>
    </div>
    <footer>
            <form method = "get" name = "search_form" id = "search_form" action = "{BASE_URL}search" class="form-search" onsubmit = "return form_null_check('search_form', 'search_word^{lang.search_word}');">
                <div class = "input-append"><input type = "text" name = "search_word" id = "search_word" placeholder = "{lang.search_word}" value = "{__GET.search_word}" class="span2 search-query" /><button type="submit" class="btn">{lang.search}</button></div>
            </form>
        <p>
            <a href="https://twitter.com/tapbbs" target="_blank"><img src="{FRONTEND}img/twitter.png" alt="twitter" /></a>
            <a href="https://www.facebook.com/tapbbs.zzanlab" target="_blank"><img src="{FRONTEND}img/facebook.png" alt="facebook" /></a>
            <!--a href="{BASE_URL}bbs/rss" target="_blank"><img src="{FRONTEND}img/rss.png" alt="rss" /></a-->
        </p>
        <p><a href="{BASE_URL}">Home</a> | <a href="{BASE_URL}page/introduce">소개</a> | <a href="{BASE_URL}bbs/lists/community">커뮤니티</a> | <a href="{BASE_URL}bbs/lists/gallery?lists_style=gallery">갤러리</a> | <a href="{BASE_URL}plugin/onedayonememo/lists">하루한마디</a> | <a href="javascript:void(0)" onclick="location.href=updateURLParameter('viewport', 'mobile');">{lang.btn_go_mobile}</a></p>
        <p>Copyright &copy; <a href="http://zzanlab.com" target="_blank">ZzanLAB</a> | <a href="http://www.css3templates.co.uk" target="_blank">design from css3templates.co.uk</a></p>
    </footer>
</div>


<div id="message_count_div" class="hide">
    <i class="icon-envelope"></i>&nbsp;
    <a href = "{BASE_URL}user/message">{lang.new_message} : <span id = "message_count">0</span></a>
</div>


{tapbbs_profiler}

<!-- javascript at the bottom for fast page loading -->
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery.cookie.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery-loadmask-0.4/jquery.loadmask.min.js"></script>
<script type="text/javascript" src="{FRONTEND}js/jquery.easing-sooper.js"></script>
<script type="text/javascript" src="{FRONTEND}js/jquery.sooperfish.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{BASE_URL}front_end/common/js/tapbbs.js"></script>
<script type="text/javascript" src="{BASE_URL}front_end/common/js/fileuploader.tapbbs.js"></script>
<script type="text/javascript" src="{BASE_URL}front_end/common/js/global.action.js"></script>

<link rel="stylesheet" href="{FRONTEND_THIRD_PARTY}syntaxhighlighter/styles/shCore.css">
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushAppleScript.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushAS3.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushBash.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushColdFusion.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushCpp.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushCSharp.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushDelphi.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushDiff.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushErlang.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushGroovy.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushJavaFX.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushPerl.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushPowerShell.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushPython.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushRuby.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushSass.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushScala.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushSql.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushVb.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shBrushXml.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}syntaxhighlighter/scripts/shLegacy.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('ul.sf-menu').sooperfish();
        $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});

        <!--{? IS_USER_LOGIN === TRUE}-->
            set_message_count('message_count_div', 'message_count', <!--{SETTING_ajax_timeout}-->);
            setInterval(function() {
            set_message_count('message_count_div', 'message_count', <!--{SETTING_ajax_timeout}-->);
        }, 30 * 1000); //30초에 한번 //반복하고자 하면 이부분을 추가한다. 하지만 부하가 발생할 수 있다. 설정으로 빼진 않는다.
        <!--{/}-->

        SyntaxHighlighter.all();
        SyntaxHighlighter.config.stripBrs = true;
    });
</script>
</body>
</html>