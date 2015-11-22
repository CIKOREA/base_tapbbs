<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Js extends CI_Controller
{
    // --------------------------------------------------------------------

    /**
     * 자바스크립트용 랭기쥐팩 생성
     *
     * @author KangMin
     * @since  2012.01.21
     */
    public function lang_js()
    {
        $data['lang'] = $this->lang->language;

        header('Content-Type: text/javascript; charset=UTF-8;');

        $result = array('var lang = [];');
        foreach ($data['lang'] as $k => $v)
        {
            $result[] = "lang['{$k}'] = \"".addslashes($v)."\";";
        }
        echo implode("\n", $result);
    }

    // --------------------------------------------------------------------

    /**
     * 자바스크립트용 base_url 생성
     *
     * @author KangMin
     * @since  2012.07.08
     */
    public function base_url_js()
    {
        $base_url = $this->config->item('base_url');

        header('Content-Type: text/javascript; charset=UTF-8;');

        echo 'var BASE_URL = \'' . $base_url . '\';';
    }
}

//EOF