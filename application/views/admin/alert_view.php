<?php
	if(isset($message) !== TRUE)
	{
		$message = 'ERROR';
	}

	if(isset($redirect) == TRUE)
	{
		if(substr($redirect, 0, 1) == '/') $redirect = substr($redirect, 1);
		$callback = ', function(r) { if(r) {location.href=\''.BASE_URL.$redirect.'\';} }';
	}
	else
	{
		$callback = '';
	}

	//콜백 함수 강제 작성
	if(isset($callback_force) == TRUE)
	{
		$callback = ', function(r) { if(r) {'.$callback_force.'} }';
	}
?>
<script type = "text/javascript">
	jAlert('<?php echo $message; ?>', lang['alert']<?php echo $callback; ?>);
</script>