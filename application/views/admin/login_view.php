<?php
	$referer = '/admin/setting';
	$referer = strtr(base64_encode(addslashes(serialize($referer))), '+/=', '-_.');		
?>
<div id = "login_div" align = "center">
	<form name = "login_form" id = "login_form" method = "post" action = "<?php echo BASE_URL; ?>user/login">
		<input type = "hidden" name = "referer" id = "referer_input" value = "<?php echo $referer; ?>" />
		<input type = "text" class = "text" name = "user_id" id = "user_id_input" value = "<?php echo set_value('user_id'); ?>" placeholder = "<?php echo lang('user_id'); ?>" /><br />
		<input type = "password" class = "text" name = "password" id = "password_input" value = ""  placeholder = "<?php echo lang('password'); ?>" /><br />
		<input type = "submit" value = "<?php echo lang('btn_login'); ?>" class = "button" />
	</form>
</div>