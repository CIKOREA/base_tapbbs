<div class="contents_title_container text-left">
    <span class="divider">|</span>
    <div class="title">소개</div>
</div>
<div class="clearfix"></div>

<ul>
<li>3분 게시판, 초간단 MOBILE && PC 게시판.</li>
    <li>CodeIgniter (PHP Framework) 기반 공개형 게시판</li>
    <li>Tap (톡톡 두드리다) + BBS (Bulletin Board System)</li>
    <li>라이센스
        <ul>
            <li><a href = "{BASE_URL}index/license" target="_blank">BSD licenses</a></li>
        </ul>
    </li>
    <li>사용
	<ul>
            <li>CodeIgniter 2.2.1 (http://cikorea.net/) (http://codeigniter.com/)</li>
            <li>jquery 1.8.3 (http://jquery.com/)</li>
            <li>jquerymobile 1.2.0 (http://jquerymobile.com/)</li>
            <li>jquery ui 1.10.0 (http://jqueryui.com/)</li>
            <li>jquery jqfeed 1.0 (http://archive.plugins.jquery.com/project/jgfeed)<br />- Licensed under the GPL license</li>
            <li>DD_belatedPNG 0.0.8a (http://www.dillerdesign.com/experiment/DD_belatedPNG/)<br />- MIT</li>
            <li>Ajax Upload (http://valums.com/ajax-upload/)<br />- GNU GPL and GNU LGPL 2 or late</li>
            <li>jquery alerts 1.1 (http://www.abeautifulsite.net/blog/2008/12/jquery-alert-dialogs/)<br />- GNU General Public License and the MIT License</li>
            <li>jQuery MiniColors 2.0 (http://www.abeautifulsite.net/blog/2011/02/jquery-minicolors-a-color-selector-for-input-controls/)<br />- Dual-licensed under the MIT and GPL Version 2 licenses</li>
            <li>관리자페이지 템플릿 (http://templates.arcsin.se/freshmade-software-website-template/)<br />- include the provided credit links (http://templates.arcsin.se/license/)</li>
            <li>메뉴얼 템플릿 (http://templates.arcsin.se/indigo-website-template/)<br />- include the provided credit links (http://templates.arcsin.se/license/)</li>
            <li>Curl 라이브러리 (http://philsturgeon.co.uk/code/codeigniter-curl)<br />- http://philsturgeon.co.uk/code/dbad-license</li>
            <li>jquery-loadmask-0.4 (https://code.google.com/p/jquery-loadmask/)<br />- MIT License</li>
	        <li>jQuery Cookie Plugin v1.3.1 (https://github.com/carhartl/jquery-cookie)<br />- Released under the MIT license</li>
            <li>bootstrap-transition.js v2.3.1 (http://twitter.github.com/bootstrap/javascript.html#transitions)<br />- Licensed under the Apache License, Version 2.0 (the "License");</li>
            <li>phpass-0.3 (http://www.openwall.com/phpass/)</li>
            <li>Template_ 2.2.7 (http://www.xtac.net/)<br />- LGPL</li>
            <li>PC 템플릿 (http://www.css3templates.co.uk/templates/CSS3_trees/index.html)<br />- Please also let me know the URL of the site where you will be using the template without the link back</li>
            <li>Slides-SlidesJS-3 (http://slidesjs.com/)<br />- Licensed under the Apache License, Version 2.0 (the "License");</li>
            <li>fancybox (http://fancybox.net/)<br />- Licensed under both MIT and GPL licenses</li>
            <li>jquery.bxslider (http://bxslider.com/)<br />- WTFPL – Do What the Fuck You Want to Public License</li>
            <li>Modernizr 2.6.2 (http://modernizr.com/)<br />- under the MIT license</li>
            <li>bootstrap-tagsinput (http://timschlechter.github.io/bootstrap-tagsinput/examples/)<br />- under the MIT license</li>
		<li>CKEditor 4.4.3 (http://ckeditor.com/)<br />- GNU General Public License Version 2 or later (the "GPL")</li>
	</ul>
    </li>
    <li>연구원 소개
        <div id="introduce_container"></div>
    </li>
    <li>Special Thanks : 김도성</li>
</ul>

<script type = "text/javascript">
    var Introduce = (function(){

        var appended_list = [];

        function init()
        {
            set_list();
        }

        function set_list()
        {
            var developer_list = {
                1 : {
                    name : '배강민',
                    nickname : 'KangMin',
                    email : 'kangmin2z@gmail.com',
                    job : 'Simplex Internet, Manager',
                    position : '<br />+ CodeIgniter 한국사용자포럼 운영진<br />+ Area4u.net 운영자<br />+ G-Nis - T2 (Second Tenor) : 중창부 (J.C.C.) 활동 Unit',
                    site : '<br />http://www.baekangmin.com<br />http://www.area4u.net',
                    sns : '<br />http://www.facebook.com/kangmin.bae.7<br />http://www.twitter.com/baekangmin',
                    img : FRONTEND + 'img/zzanlab_kangmin2z.jpg'
                },
                2 : {
                    name : '전상민',
                    nickname : 'lensvil',
                    email : 'lensvil.co@gmail.com',
                    job : 'Simplex Internet, Application developer',
                    position : '',
                    site : 'http://www.lensvil.com',
                    sns : 'http://www.facebook.com/lensvil',
                    img : FRONTEND + 'img/zzanlab_lensvil.jpg'
                },
                3 : {
                    name : '최용운',
                    nickname : '최용운',
                    email : 'daypekr@gmail.com',
                    job : 'Application developer',
                    position : 'Castle owner in the future',
                    site : 'http://day.pe.kr',
                    sns : '',
                    img : FRONTEND + 'img/zzanlab_daypekr.jpg'
                }
            };

            var $container = $('#introduce_container');
            for (var i in developer_list) {

                var k = get_key();
                if (developer_list[k]) {
                    var tag = '<div style="width:100%; text-align:left; margin-bottom:10px; border:1px solid #d5d5d5; padding:5px; clear:both;">';
                    tag += '<div style = "display:inline-block; vertical-align:top; padding-right:5px;"><img src = "'+developer_list[k]['img']+'" style = "width:150px;height:200px" /></div>';
                    tag += '<div style = "display:inline-block">';
                    tag += '<ul>';
                    tag += '<li>이름 : ' + developer_list[k]['name'] + '</li>';
                    tag += '<li>닉네임 : ' + developer_list[k]['nickname'] + '</li>';
                    tag += '<li>이메일 : ' + developer_list[k]['email'] + '</li>';
                    tag += '<li>직업 : ' + developer_list[k]['job'] + '</li>';
                    if(developer_list[k]['position']) tag += '<li>소속 : ' + developer_list[k]['position'] + '</li>';
                    if(developer_list[k]['site']) tag += '<li>사이트 : ' + developer_list[k]['site'] + '</li>';
                    if(developer_list[k]['sns']) tag += '<li>SNS : ' + developer_list[k]['sns'] + '</li>';
                    tag += '</ul>';
                    tag += '</div>';
                    tag += '</div>';
                    $container.append(tag);
                }
            }
        }

        function get_key()
        {
            var no = get_random(1, 3);
            if ($.inArray(no, appended_list) < 0) {
                appended_list.push(no);
                return no;
            } else {
                return get_key();
            }
        }


        function get_random(min, max)
        {
            return Math.floor(Math.random() * (1 + max - min)) + min;
        }

        return {
            init : init
        };

    })();

    $(document).ready(function() {
        $('#navigation_after_home').html(' > 소개');
        Introduce.init();
    });
</script>