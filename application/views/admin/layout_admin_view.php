<?php

	//layout_admin_view.php (needs : libraries/Layout.php)

	//del cache
	$this->output->set_header('HTTP/1.0 200 OK');
	$this->output->set_header('HTTP/1.1 200 OK');
	$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
	$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');

	//charset
	$this->output->set_header("Content-Type: text/html; charset=UTF-8;");

	//html helper
	$this->load->helper('html');

	//load DTD
	echo doctype('html5')."\n";

	//set META
	$meta = array(
		        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
				, array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv')
		        , array('name' => 'Description', 'content' => 'TapBBS')
		        , array('name' => 'Keywords', 'content' => 'tapbbs, 게시판, zzanlab, 짠랩')
		        , array('name' => 'Author', 'content' => '배강민')
				//, array('name' => 'cache-control', 'content' => 'no-cache', 'type' => 'equiv')
				//, array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv')
		    );

	//menu
	$menu = array();
	$menu_sub = array();
	$menu_class = array();
	$menu_class_sub = array();

	$menu[] = array(						'title' => lang('menu_admin_setting'),				'key' => 'admin_setting');
	$menu_sub['admin_setting'][] = array(	'title' => lang('menu_sub_admin_setting'),			'key' => 'admin_setting');
    $menu_sub['admin_setting'][] = array(	'title' => lang('menu_sub_admin_setting_themes'),	'key' => 'admin_setting_themes');
	$menu_sub['admin_setting'][] = array(	'title' => lang('menu_sub_admin_setting_phpinfo'),	'key' => 'admin_setting_phpinfo');

	$menu[] = array(						'title' => lang('menu_admin_bbs'),					'key' => 'admin_bbs');
    $menu_sub['admin_bbs'][] = array(		'title' => lang('menu_sub_admin_bbs'),				'key' => 'admin_bbs');
    $menu_sub['admin_bbs'][] = array(		'title' => lang('menu_sub_admin_bbs_setting'),		'key' => 'admin_bbs_setting');
    $menu_sub['admin_bbs'][] = array(		'title' => lang('menu_sub_admin_bbs_lists'),		'key' => 'admin_bbs_lists');
	$menu_sub['admin_bbs'][] = array(		'title' => lang('menu_sub_admin_bbs_arrangefiles'),		'key' => 'admin_bbs_arrangefiles');

	$menu[] = array(						'title' => lang('menu_admin_users'),				'key' => 'admin_users');
	$menu_sub['admin_users'][] = array(		'title' => lang('menu_sub_admin_users'),			'key' => 'admin_users');
	$menu_sub['admin_users'][] = array(		'title' => lang('menu_sub_admin_users_group'),		'key' => 'admin_users_group');

	$menu[] = array(						'title' => lang('menu_admin_ip'),					'key' => 'admin_ip');
	$menu_sub['admin_ip'][] = array(		'title' => lang('menu_sub_admin_ip'),				'key' => 'admin_ip');
	$menu_sub['admin_ip'][] = array(		'title' => lang('menu_sub_admin_ip_block'),			'key' => 'admin_ip_block');

	foreach($menu as $k=>$v)
	{
		$menu_class[$v['key']] = NULL;

		foreach($menu_sub[$v['key']] as $k=>$v)
		{
			$menu_class_sub[$v['key']] = NULL;
		}
	}

	//메뉴활성화
	$menu_key = $this->uri->segment(1).'_'.$this->uri->segment(2);
	$menu_key_sub = str_replace('/', '_', $this->uri->uri_string);
	$menu_key_sub = substr($menu_key_sub, 0, 1) == '_' ? substr($menu_key_sub, 1) : $menu_key_sub;
	$menu_class[$menu_key] = 'class="current_page_item"';
	$menu_class_sub[$menu_key_sub] = 'class="current_page_item"';

	//버젼확인
	//$tapbbs = $this->curl->simple_get('http://dev.naver.com/projects/tapbbs/');
?>

<html lang="ko">
<head>
	<?php echo meta($meta); ?>
	<title>TapBBS Admin</title>
	<style type="text/css">
		input.text{width:90%}
		.cursor{cursor:pointer}
	</style>
    <?php echo link_tag('front_end/third_party/jquery-ui-1.10.0.custom/css/smoothness/jquery-ui-1.10.0.custom.min.css'); ?>
    <?php echo link_tag('front_end/third_party/jquery-loadmask-0.4/jquery.loadmask.css'); ?>
    <?php echo link_tag('front_end/third_party/jquery-miniColors-master/jquery.minicolors.css'); ?>
    <?php echo link_tag('front_end/common/css/admin.css'); ?>
    <?php echo link_tag('front_end/common/css/jquery.alerts.tapbbs.css'); ?>
	<link rel="icon" href="<?php echo BASE_URL; ?>favicon_tapbbs.ico" />
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/third_party/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>front_end/third_party/jquery.cookie.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/third_party/jquery-ui-1.10.0.custom/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/third_party/jquery-loadmask-0.4/jquery.loadmask.min.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/third_party/jquery-miniColors-master/jquery.minicolors.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/common/js/jquery.alerts.tapbbs.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>js/lang_js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>js/base_url_js"></script>
    <!--[if IE 6]>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/third_party/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type = "text/javascript">
		/* EXAMPLE */
		DD_belatedPNG.fix('img');

		/* string argument can be any CSS selector */
		/* .png_bg example is unnecessary */
		/* change it to what suits you! */
	</script>
	<![endif]-->
</head>

<body id="top">

	<div id="header-wrapper">
		<div id="header-wrapper-2">
			<div class="center-wrapper">

				<div id="header">

					<div id="logo">
						<h1 id="site-title"><a href="<?php echo BASE_URL; ?>admin/setting">TapBBS <span>Admin</span></a></h1>
						<h2 id="site-slogan">
							<?php
								//버젼확인
								if(file_exists('./version.txt'))
								{
									include_once('./version.txt');
								}
								else
								{
									echo 'www.tapbbs.com';
								}
							?>
						</h2>
					</div>

					<div id="help-wrapper">
						<div id="help" align = "center">

							<a href = "http://www.zzanlab.com" target = "_blank">www.zzanlab.com</a>

						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
    <?php
        if($this->router->fetch_class() !== 'install')
        {
            ?>
	<div id="navigation-wrapper">
		<div id="navigation-wrapper-2">
			<div class="center-wrapper">

				<div id="navigation">

					<ul class="tabbed">
						<?php
							foreach($menu as $k=>$v)
							{
                                $url = $v['key'];

                                //admin/setting/bbs 때문에 좀... 나중에 정리 필요
                                //if($v['key'] == 'admin_bbs') $url = 'admin_bbs_setting';

								?>
						<li <?php echo $menu_class[$v['key']]; ?>><a href="<?php echo BASE_URL; ?><?php echo str_replace('_', '/', $url); ?>"><?php echo $v['title']; ?></a></li>
								<?php
							}
						?>
					</ul>

					<div class="clearer">&nbsp;</div>

				</div>

			</div>
		</div>
	</div>

	<div id="subnav-wrapper">
		<div id="subnav-wrapper-2">

			<div class="center-wrapper">

				<div id="subnav">

					<ul class="tabbed">
						<?php
							foreach($menu_sub[$menu_key] as $k=>$v)
							{
								if($v['key'] == 'admin_setting_phpinfo') $target = ' target = "_blank"';
								else $target = '';

								?>
						<li <?php echo $menu_class_sub[$v['key']]; ?>><a href="<?php echo BASE_URL; ?><?php echo str_replace('_', '/', $v['key']); ?>"<?php echo $target; ?>><?php echo $v['title']; ?></a></li>
								<?php
							}
						?>
					</ul>

					<div class="clearer">&nbsp;</div>

				</div>

			</div>
		</div>
	</div>
            <?php
        }
    ?>

	<div id="content-wrapper">
		<div class="center-wrapper">

			<div class="content">

				<div id="main"><?php echo $contents; ?></div>

			</div>

		</div>
	</div>

	<div id="footer-wrapper">

		<div class="center-wrapper">

			<div id="footer">

				<div class="left">
					Powered by <a href = "http://www.zzanlab.com" target = "_blank">ZzaLAB</a>.
				</div>

				<div class="right">
					<a href="#">Top ^</a>
				</div>

				<div class="clearer">&nbsp;</div>

			</div>

		</div>

	</div>

	<div id="bottom">

		<div class="center-wrapper">

			<div class="left">
				&copy; Since 2012.
			</div>

			<div class="right">
				<a href="http://templates.arcsin.se/" target = "_blank">Website template</a> by <a href="http://arcsin.se/" target = "_blank">Arcsin</a>
			</div>

			<div class="clearer">&nbsp;</div>

		</div>

	</div>

    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/common/js/tapbbs.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL; ?>front_end/common/js/tapbbs.admin.js"></script>
	<script type = "text/javascript">
		$(document).ready( function() {
            var consoleTimeout;

            $('.minicolors').each( function() {
                //
                // Dear reader, it's actually much easier than this to initialize
                // miniColors. For example:
                //
                //  $(selector).minicolors();
                //
                // The way I've done it below is just to make it easier for me
                // when developing the plugin. It keeps me sane, but it may not
                // have the same effect on you!
                //
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-default-value') || '',
                    inline: $(this).hasClass('inline'),
                    letterCase: $(this).hasClass('uppercase') ? 'uppercase' : 'lowercase',
                    opacity: $(this).hasClass('opacity'),
                    position: $(this).attr('data-position') || 'default',
                    styles: $(this).attr('data-style') || '',
                    swatchPosition: $(this).attr('data-swatch-position') || 'left',
                    textfield: !$(this).hasClass('no-textfield'),
                    theme: $(this).attr('data-theme') || 'default',
                    change: function(hex, opacity) {

                        // Generate text to show in console
                        text = hex ? hex : 'transparent';
                        if( opacity ) text += ', ' + opacity;
                        text += ' / ' + $(this).minicolors('rgbaString');

                        // Show text in console; disappear after a few seconds
                        $('#console').text(text).addClass('busy');
                        clearTimeout(consoleTimeout);
                        consoleTimeout = setTimeout( function() {
                            $('#console').removeClass('busy');
                        }, 3000);

                    }
                });

            });
		});

		//사파리,오페라에서는 뒤로가기하면 캐쉬된페이지에서 아무런 실행을 안해서..
		window.onunload = function(){};
	</script>

</body>

</html>

<?php
	if(defined('USER_INFO_idx') && USER_INFO_group_idx === SETTING_admin_group_idx && isset($_GET['d']) === TRUE)
	{
		$this->output->enable_profiler(TRUE);
	}

	if(isset($this->db)) $this->db->close();

//END