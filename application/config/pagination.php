<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//메뉴얼 참고
//http://ellislab.com/codeigniter/user-guide/libraries/pagination.html

$config['mobile'] = array();
$config['pc'] = array();

//mobile
$config['mobile']['first_link'] = FALSE;//'&lt;&lt;';
$config['mobile']['first_tag_open'] = '';
$config['mobile']['first_tag_close'] = "\n";

$config['mobile']['last_link'] = FALSE;//'&gt;&gt;';
$config['mobile']['last_tag_open'] = '';
$config['mobile']['last_tag_close'] = "\n";

$config['mobile']['next_link'] = '&gt;';
$config['mobile']['next_tag_open'] = '';
$config['mobile']['next_tag_close'] = "\n";

$config['mobile']['prev_link'] = '&lt;';
$config['mobile']['prev_tag_open'] = '';
$config['mobile']['prev_tag_close'] = "\n";

$config['mobile']['cur_tag_open'] = '<div data-role="button" class="ui-btn-active">';
$config['mobile']['cur_tag_close'] = '</div>'."\n";

$config['mobile']['num_tag_open'] = '';
$config['mobile']['num_tag_close'] = "\n";

$config['mobile']['anchor_class'] = ' data-role="button" data-ajax="false" ';

//pc
$config['pc']['first_link'] = '&lt;&lt;';
$config['pc']['first_tag_open'] = '<li><span>';
$config['pc']['first_tag_close'] = '</span></li>';

$config['pc']['last_link'] = '&gt;&gt;';
$config['pc']['last_tag_open'] = '<li><span>';
$config['pc']['last_tag_close'] = '</span></li>';

$config['pc']['next_link'] = '&gt;';
$config['pc']['next_tag_open'] = '<li>';
$config['pc']['next_tag_close'] = '</li>';

$config['pc']['prev_link'] = '&lt;';
$config['pc']['prev_tag_open'] = '<li>';
$config['pc']['prev_tag_close'] = '</li>';

$config['pc']['cur_tag_open'] = '<li class="active"><span>';
$config['pc']['cur_tag_close'] = '</span></li>';

$config['pc']['num_tag_open'] = '<li>';
$config['pc']['num_tag_close'] = '</li>';

$config['pc']['anchor_class'] = '';

//EOF



