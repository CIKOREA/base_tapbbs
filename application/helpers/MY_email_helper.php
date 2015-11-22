<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Send an email
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('send_email'))
{
	function send_email($recipient, $subject = 'Test email', $message = 'Hello World')
	{
		//한글 깨져서 아래 header, subject (base64_encode) 추가해서 오버라이딩
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=utf-8\r\n";

		$subject = '=?UTF-8?B?'.base64_encode($subject)."?=\n";

		return mail($recipient, $subject, $message, $header);
	}
}


/* End of file email_helper.php */
/* Location: ./system/helpers/email_helper.php */