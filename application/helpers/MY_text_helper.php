<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Word Censoring Function
 *
 * Supply a string and an array of disallowed words and any
 * matched words will be converted to *** or to the replacement
 * word you've submitted.
 *
 * @access	public
 * @param	string	the text string
 * @param	string	the array of censoered words
 * @param	string	the optional replacement value
 * @return	string
 *
 * @author lensvil
 * @since 2012.01.25
 *
 */
if ( ! function_exists('word_censor'))
{
	function word_censor($str, $censored, $replacement = '*')
	{
		if ( ! is_array($censored))
		{
			return $str;
		}

		$aResult = array();

        foreach ($censored as $iKey => $sTarget) 
		{
            $aResult[] = str_repeat($replacement, mb_strlen($sTarget));
        }

        $result = str_ireplace($censored, $aResult, $str);

		return $result;
	}
}

//EOF