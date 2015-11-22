<?php

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
		        , array('name' => 'Keywords', 'content' => 'tapbbs, 게시판')
		        , array('name' => 'Author', 'content' => 'KangMin')
				//, array('name' => 'cache-control', 'content' => 'no-cache', 'type' => 'equiv')
				//, array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv')
		    );
?>

<html lang="ko">
<head>
	<?php echo meta($meta); ?>
	<title>TapBBS Admin</title>
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

<body>

	<div id = "main"><?php echo $contents; ?></div>

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