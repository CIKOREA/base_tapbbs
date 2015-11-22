<ul data-role="listview" xmlns="http://www.w3.org/1999/html">
    <li>
        <h3>소개</h3>
        <p>
	* 3분 게시판, 초간단 MOBILE && PC 게시판.
	<br />
        * CodeIgniter (PHP Framework) 기반 공개형 게시판
        <br />
        * Tap (톡톡 두드리다) + BBS (Bulletin Board System)
        </p>
    </li>
    <li>
        <h3>라이센스</h3>
        <p>
            <a href = "{BASE_URL}index/license" target="_blank">BSD licenses</a>
        </p>
    </li>
    <li>
	<h3>사용</h3>
	<p>
* CodeIgniter 2.2.1 (http://cikorea.net/) (http://codeigniter.com/)
<br />
* jquery 1.8.3 (http://jquery.com/)
<br />
* jquerymobile 1.2.0 (http://jquerymobile.com/)
<br />
* jquery ui 1.10.0 (http://jqueryui.com/)
<br />
* jquery jqfeed 1.0 (http://archive.plugins.jquery.com/project/jgfeed)
<br />- Licensed under the GPL license
<br />
* DD_belatedPNG 0.0.8a (http://www.dillerdesign.com/experiment/DD_belatedPNG/)
<br />- MIT
<br />
* Ajax Upload (http://valums.com/ajax-upload/)
<br />- GNU GPL and GNU LGPL 2 or late
<br />
* jquery alerts 1.1 (http://www.abeautifulsite.net/blog/2008/12/jquery-alert-dialogs/)
<br />- GNU General Public License and the MIT License
<br />
* jQuery MiniColors 2.0 (http://www.abeautifulsite.net/blog/2011/02/jquery-minicolors-a-color-selector-for-input-controls/)
<br />- Dual-licensed under the MIT and GPL Version 2 licenses
<br />
* 관리자페이지 템플릿 (http://templates.arcsin.se/freshmade-software-website-template/)
<br />- include the provided credit links (http://templates.arcsin.se/license/)
<br />
* 메뉴얼 템플릿 (http://templates.arcsin.se/indigo-website-template/)
<br />- include the provided credit links (http://templates.arcsin.se/license/)
<br />
* Curl 라이브러리 (http://philsturgeon.co.uk/code/codeigniter-curl)
<br />- http://philsturgeon.co.uk/code/dbad-license
<br />
* jquery-loadmask-0.4 (https://code.google.com/p/jquery-loadmask/)
<br />- MIT License
<br />
* jQuery Cookie Plugin v1.3.1 (https://github.com/carhartl/jquery-cookie)
<br />- Released under the MIT license
<br />
* bootstrap-transition.js v2.3.1 (http://twitter.github.com/bootstrap/javascript.html#transitions)
<br />- Licensed under the Apache License, Version 2.0 (the "License");
<br />
* phpass-0.3 (http://www.openwall.com/phpass/)
<br />
* Template_ 2.2.7 (http://www.xtac.net/)
<br />- LGPL
<br />
* PC 템플릿 (http://www.css3templates.co.uk/templates/CSS3_trees/index.html)
<br />- Please also let me know the URL of the site where you will be using the template without the link back
<br />
* Slides-SlidesJS-3 (http://slidesjs.com/)
<br />- Licensed under the Apache License, Version 2.0 (the "License");
<br />
* fancybox (http://fancybox.net/)
<br />- Licensed under both MIT and GPL licenses
<br />
* jquery.bxslider (http://bxslider.com/)
<br />- WTFPL – Do What the Fuck You Want to Public License
<br />
* Modernizr 2.6.2 (http://modernizr.com/)
<br />- under the MIT license
<br />
* bootstrap-tagsinput (http://timschlechter.github.io/bootstrap-tagsinput/examples/)
<br />- under the MIT license
<br />
* CKEditor 4.4.3 (http://ckeditor.com/)
<br />- GNU General Public License Version 2 or later (the "GPL")
<br />
	</p>
    </li>
    <li>
        <h3>연구원 소개</h3>
        <p id="introduce_container"></p>
	<p>* Special Thanks : 김도성</p>
    </li>
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
                    var tag = '';
                    tag += '<img src = "'+developer_list[k]['img']+'" style = "width:150px;height:200px" /><br />';
                    tag += '* 이름 : ' + developer_list[k]['name'] + '<br />';
                    tag += '* 닉네임 : ' + developer_list[k]['nickname'] + '<br />';
                    tag += '* 이메일 : ' + developer_list[k]['email'] + '<br />';
                    tag += '* 직업 : ' + developer_list[k]['job'] + '<br />';
                    if(developer_list[k]['position']) tag += '* 소속 : ' + developer_list[k]['position'] + '<br />';
                    if(developer_list[k]['site']) tag += '* 사이트 : ' + developer_list[k]['site'] + '<br />';
                    if(developer_list[k]['sns']) tag += '* SNS : ' + developer_list[k]['sns'] + '<br />';
		    tag += '<br />';
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