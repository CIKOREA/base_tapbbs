<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/template_/template_.class.php';

class MY_Controller extends CI_Controller
{
    public $tpl = NULL;
    public $viewport = 'mobile';
    public $theme = 'default';
    public $browser = '';
    public $assign = array();

    // --------------------------------------------------------------------

	/**
	 * 기본 로딩
	 * 순서가 중요할 수 있다.
	 */
    public function __construct()
    {
        parent::__construct();

		$timezone = @date_default_timezone_get();
		@date_default_timezone_set($timezone);

        $this->load->database();
        $this->load->helper('html');
        $this->set_browser();
        $this->set_theme(); //절대로 set_browser 바로 아래 있어야한다.

        $this->tpl     = new Template_;
        $this->tpl_ext = '.tpl';
        $root          = FCPATH . 'front_end/themes/' . $this->viewport . '/' . $this->theme;

        $this->tpl->compile_dir  = $root . '/_compile';
        $this->tpl->template_dir = $root . '/_template';
        $this->tpl->cache_dir    = $root . '/_cache';
        $this->tpl->caching      = FALSE;

        $this->block_client_ip();

        $this->check_login();
        $this->set_default_config();
        $this->set_client_ip_access();

        $this->site_block();
        $this->set_group_icon();
        self::file_upload_max_size();

        $this->set_headers();
        $this->set_title();
        $this->set_meta_tags();

        $this->load->library('navigation');
        $this->assign['navigation'] = $this->navigation->run();

        $this->add_language_pack($this->language_pack('common'));

        $this->password_change_campaign();
        $this->segment();

        $this->set_outlogin();

        //$this->change_cookie_selectbox(); //개발용

        //$this->set_demo(); //데모

        $_GET['search_word'] = (!empty($_GET['search_word'])) ? $_GET['search_word'] : '';
    }

    // --------------------------------------------------------------------

    /**
     * 테마 선택
     *
     * @author 배강민
     */
    public function set_theme()
    {
        //테마미리보기냐?
        $preview_theme['type'] = $this->input->cookie('theme_type');
        $preview_theme['title'] = $this->input->cookie('theme_title');
        $preview_theme['folder_name'] = $this->input->cookie('theme_folder_name');

        if($preview_theme['title'])
        {
            $this->theme = $preview_theme['folder_name'];
        }
        else
        {
            //모바일이냐? 피씨냐?
            $agent = ($this->viewport == 'mobile') ? 'M' : 'P';

            $this->load->model('themes_model');
            $result = $this->themes_model->get_theme($agent);
            $this->theme = $result->folder_name;
        }
    }

    // --------------------------------------------------------------------

	/**
	 * CI의 segment를 패치한다.
	 */
    public function segment()
    {
        $this->assign['segment'] = $this->uri->segment_array();
    }

    // --------------------------------------------------------------------

    /**
     * 사용할 템플릿 파일의 아이디를 정의
     *
     * @param string $key
     * @param string $file
     *
     * @return void
     * @internal param array $list
     */
    public function define($key, $file)
    {
        $this->tpl->define($key, $file . $this->tpl_ext);
    }

    // --------------------------------------------------------------------

    /**
     * 템플릿 변수에 값을 할당
     *
     * @param array $list
     */
    public function assign($list = array())
    {
        $this->tpl->assign($list);
    }

    // --------------------------------------------------------------------

	/**
	 * fetch
	 */
    public function fetch($key, $file)
    {
        return $this->tpl->fetch($key, $file . $this->tpl_ext);
    }

    // --------------------------------------------------------------------

    /**
     * 템플릿을 캡슐화함으로써 템플릿 변수의 충돌을 방지하고, 같은 템플릿을 중복해서 사용 가능
     *
     * @example http://xtac.net/tutorial5/#scope
     *
     * @param string $key
     * @param string $file
     * @param array  $assign
     * @return bool
     */
    public function scope($key, $file, $assign = array())
    {
        if(is_null($assign) === FALSE)
        {
            $assign = array_merge($assign, $this->assign);
        }

        $this->define($key, $file);
        $this->tpl->setScope($key);
        $this->assign($assign);
        $this->tpl->setScope();
    }

    // --------------------------------------------------------------------

    /**
     * 출력
     *
     * @param string $layout
     * @param array  $cache_target_module
     *
     * @return void
     */
    public function display($layout = '', $cache_target_module = array())
    {
        if(!empty($layout))
        {
            $this->define('layout', 'layout/' . $layout);

            $this->profiler();
            $this->set_frontend_js();
            $this->assign($this->assign);
            $this->tpl->print_('layout');
        }
    }

    // --------------------------------------------------------------------

	/**
	 * 프론트 javascript에서 기본적으로 이용하는 경로들을 패치한다
	 */
    public function set_frontend_js()
    {
        $tags = array('<script type="text/javascript">');
        $tags[] = '//<![CDATA[';
        $tags[] = 'var FRONTEND = \'' . $this->assign['FRONTEND'] . '\';';
        $tags[] = 'var FRONTEND_COMMON = \'' . $this->assign['FRONTEND_COMMON'] . '\';';
        $tags[] = 'var FRONTEND_THIRD_PARTY = \'' . $this->assign['FRONTEND_THIRD_PARTY'] . '\';';
        $tags[] = '//]]></script>';

        $this->assign['FRONTEND_JS_VARIABLES'] = implode("\n", $tags);
    }

    // --------------------------------------------------------------------

    /**
     * 브라우저
     */
    public function set_browser()
    {
        $this->browser  = strtolower($this->agent->browser());
        $this->viewport = $this->agent->is_mobile() ? 'mobile' : 'pc';

        $get_viewport = $this->input->get('viewport');
        if ($get_viewport !== FALSE)
        {

            if (in_array($get_viewport, array('pc', 'mobile')) === TRUE)
            {
                $this->viewport = $get_viewport;
            }
        }
        else
        {

            $cookie_viewport = get_cookie('tapbbs_viewport');
            if (!empty($cookie_viewport))
            {
                $this->viewport = get_cookie('tapbbs_viewport');
            }
        }

        set_cookie(array(
                        'name'   => 'tapbbs_viewport',
                        'value'  => $this->viewport,
                        'expire' => '1209600',
                        'path'   => '/',
                   ));
    }

    // --------------------------------------------------------------------

    /**
     * HTTP Header 설정
     *
     */
    public function set_headers()
    {
        header('HTTP/1.0 200 OK');
        header('HTTP/1.1 200 OK');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Content-Type: text/html; charset=UTF-8;');
    }

    // --------------------------------------------------------------------

	/**
	 * 브라우저 타이틀 세팅
	 */
    public function set_title()
    {
        $this->assign['browser_title'] = str_replace("'", "\'", SETTING_browser_title_fix_value);
    }

    // --------------------------------------------------------------------

	/**
	 * 아웃로그인
	 */
    private function set_outlogin($key = 'outlogin')
    {
        $path = $this->tpl->template_dir.'/';

        if(defined('USER_INFO_idx'))
        {
            $file = 'contents/user/outlogin_after_login';
        }
        else
        {
            $file = 'contents/user/outlogin_before_login';
        }

        $this->scope($key, $file);
    }

    // --------------------------------------------------------------------

    /**
     * 메타 태그 설정
     *
     */
    public function set_meta_tags()
    {
        $meta = array(
            array(
                'name'    => 'Content-type',
                'content' => 'text/html; charset=utf-8',
                'type'    => 'equiv'
            ),
            array(
                'name'    => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type'    => 'equiv'
            )
            //, array('name' => 'cache-control', 'content' => 'no-cache', 'type' => 'equiv')
            //, array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv')
        );


        //mobile META
        //if($this->agent->is_mobile()) //오페라 모바일 캐취에 문제가 있어서
        //{
        if($this->viewport == 'mobile')
        {
            if($this->browser == 'opera')
            {
                $meta[] = array(
                    'name'    => 'viewport',
                    'content' => 'initial-scale=0.75, maximum-scale=0.75, minimum-scale=0.75, user-scalable=no, target-densitydpi=medium-dpi',
                    'type' => ''
                );
            }
            else if($this->browser == 'safari')
            {
                $meta[] = array(
                    'name'    => 'viewport',
                    'content' => 'initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi',
                    'type' => ''
                );
            }
            else
            {
                $meta[] = array(
                    'name'    => 'viewport',
                    'content' => 'initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi, width=device-width',
                    'type' => ''
                );
            }

            $meta[] = array(
                'name'    => 'format-detection',
                'content' => 'telephone=no',
                'type' => ''
            );
            $meta[] = array(
                'name'    => 'format-detection',
                'content' => 'address=no',
                'type' => ''
            );
        }
        //}

        $this->assign['meta'] = $meta;
    }

    // --------------------------------------------------------------------

    /**
     * 기본 설정 세팅
     * @author KangMin
     * @since  2011.11.09
     */
    public function set_default_config()
    {
        $assign = array();
        $this->load->driver('cache');

        //중요 int 필드
        $must_int = array(
            'default_group_idx',
            'admin_group_idx'
        );

        //캐쉬 있으면
        if($this->cache->file->get('setting'))
        {
            //데이터
            $setting = $this->cache->file->get('setting');

            $setting = json_decode($setting);
        }
        //캐쉬 없으면
        else
        {
            $setting = $this->setting_model->get_setting();

            //캐쉬저장
            $this->cache->file->save('setting', json_encode($setting), 60 * 60 * 2); //2시간, 설정으로 뺄것까진 없을듯..
        }

        $setting_list = array();
        $define_list = array();
        foreach ($setting as $k => $v)
        {
            $setting_list[$v->viewport][$v->parameter] = $v;
        }

        $define_list = $setting_list['mobile'];

		if($this->viewport == 'pc')
		{
			foreach ($setting_list['pc'] as $k => $v)
			{

				$k = substr($v->parameter, 0, -3);
				$define_list[$k] = $v;
			}
		}

		foreach ($define_list as $k => $v)
		{
			$assign['SETTING_' . $k] = (in_array($k, $must_int) == TRUE ? (int)$v->value : $v->value);
			define('SETTING_' . $k, (in_array($k, $must_int) == TRUE ? (int)$v->value : $v->value));
		}

        if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')
        {
            define('SETTING_OS', 'WIN');
            define('SETTING_IS_UNIX', FALSE);
        }
        else
        {
            define('SETTING_OS', 'UNIX');
            define('SETTING_IS_UNIX', TRUE);
        }

        define('BASE_URL', $this->config->item('base_url'));

        $assign['IS_USER_LOGIN'] = defined('USER_INFO_idx');
        $assign['IS_ADMIN']      = ($assign['IS_USER_LOGIN'] === TRUE AND USER_INFO_group_idx === SETTING_admin_group_idx) ? TRUE : FALSE;

        $assign['IS_HOME']   = ($this->router->fetch_class() === 'index') ? TRUE : FALSE;
        $assign['IS_MOBILE'] = ($this->viewport === 'mobile') ? TRUE : FALSE;

        if((defined('USER_INFO_idx') === TRUE))
        {
            $assign['USER_INFO_idx']   = USER_INFO_idx;
            $assign['USER_name_print'] = name(USER_INFO_user_id, USER_INFO_name, USER_INFO_nickname);
        }
        if((defined('USER_INFO_point') === TRUE))
        {
            $assign['USER_INFO_point'] = USER_INFO_point;
        }

        $assign['BASE_URL']             = BASE_URL;
        $assign['FRONTEND']             = BASE_URL . 'front_end/themes/' . $this->viewport . '/' . $this->theme . '/';
        $assign['FRONTEND_COMMON']      = BASE_URL . 'front_end/common/';
        $assign['FRONTEND_THIRD_PARTY'] = BASE_URL . 'front_end/third_party/';
        $assign['REFERER_URL']          = '';

        if($this->router->fetch_class() === 'user') // 회원쪽이면 리턴URL 없앤다
        {
            $referer = '';
        }
        else
        {
            $referer = $this->input->server('PATH_INFO') . '?' . $this->input->server('REDIRECT_QUERY_STRING');
            $referer = strtr(base64_encode(addslashes(serialize($referer))), '+/=', '-_.');
        }

        $assign['REFERER_URL'] = $referer;

        $_GET['referer'] = (isset($_GET['referer'])) ? $_GET['referer'] : $assign['REFERER_URL'];

        $assign['SETTING_apple_touch_icon_rel'] = (SETTING_apple_touch_icon_precomposed == 1) ? 'apple-touch-icon-precomposed' : 'apple-touch-icon';

        $this->assign                           = array_merge($this->assign, $assign);

        foreach($this->assign as $k => $v)
        {
            if(defined($k) === FALSE)
            {
                define($k, $v);
            }
        }

        //본인인지 아닌지 체크를 위해 기본 어싸인이 필요하다.. 휴
        //위에는 어싸인을 이파인하므로 따로 해야한다.
        if((defined('USER_INFO_idx') === TRUE))
        {
            //ok
        }
        else
        {
            $this->assign['USER_INFO_idx'] = NULL;
        }
    }

    // --------------------------------------------------------------------

	/**
	 * 페이지별 필요 언어팩 나열
	 */
    public function language_pack($kind = 'common')
    {
        $list = array(
            'common'              => array(
                'new_message',
                'search_word',
                'search',
                'none',
                'update',
                'delete',
                'write',
                'modify',
                'cancel',
                'lists',
                'add_friend',
                'point',
                'btn_logout',
                'btn_account',
                'btn_admin',
                'btn_login',
                'btn_go_pc',
                'btn_go_mobile',
                'category',
                'message_receive_type_0',
                'message_receive_type_1',
                'message_receive_type_2',
                'avatar',
                'avatar_used_0',
                'avatar_used_1',
                'limit_capacity',
                'limit_image_size',
                'user_id',
                'password',
                'btn_join',
                'btn_keep_login',
                'btn_find_password',
                'menu_user_modify',
                'menu_user_point',
                'menu_user_scrap',
                'menu_user_message',
                'menu_user_friend',
				'plugin_onedayonememo',
				'recently_comment',
                'mypage'
            ),
            'bbs_lists'           => array(
                'is_secret',
                'is_notice',
                'category',
                'select',
				'title',
				'writer',
				'write_time',
				'hit'
            ),
            'bbs_view'            => array(
                'write_time',
                'update_time',
                'vote',
                'scrap',
                'tags',
                'urls',
                'files',
                'deny_allow',
                'category',
                'comment',
                'hit',
                'article_next',
                'article_pre',
                'message',
                'write_comment',
				'writer',
				'title',
                'send',
                'close',
                'is_secret',
                'is_notice'
            ),
            'bbs_write'           => array(
                'title',
                'category',
                'select',
                'contents',
                'files',
                'tags',
                'urls',
                'is_secret',
                'is_notice',
                'lists',
                'upload_file_allow_cnt',
                'max'
            ),
            'bbs_modify'          => array(
                'title',
                'category',
                'select',
                'contents',
                'files',
                'tags',
                'urls',
                'is_secret',
                'is_notice',
                'upload_file_allow_cnt',
                'max'
            ),
            'bbs_search'          => array(
                'search_word',
                'is_notice',
                'is_secret',
                'bbs',
                'category',
                'title',
                'writer',
                'write_time',
                'hit'
            ),
            'onedayonememo'       => array(
                'point_gamble',
                'point_random',
                'point_insert',
                'contents',
                'onedayonememo'
            ),
            'user_join'           => array(
                'user_id',
                'password',
                'password_confirm',
                'name',
                'nickname',
                'email',
                'btn_join',
                'alert'
            ),
            'user_modify'         => array(
                'menu_user_modify',
                'menu_user_point',
                'menu_user_scrap',
                'menu_user_message',
                'menu_user_friend',
                'user_id',
                'password',
                'password_confirm',
                'name',
                'nickname',
                'email',
                'btn_modify',
                'alert',
                'article_count',
                'comment_count',
                'vote_receive_count',
                'vote_send_count',
                'join_datetime',
                'timezone',
                'memo',
                'info',
                'message_receive_type',
                'btn_unregistered'
            ),
            'user_login'          => array(
                'user_id',
                'password',
                'btn_login',
                'btn_join',
                'btn_keep_login',
                'btn_find_password'
            ),
            'user_find_password'  => array(
                'btn_find_password',
                'user_id',
                'email',
                'email_join',
                'btn_new_password',
                'guide_new_password'
            ),
            'user_friend'         => array(
                'menu_user_modify',
                'menu_user_point',
                'menu_user_scrap',
                'menu_user_message',
                'menu_user_friend',
                'detail',
                'action',
                'message',
                'send',
                'close',
                'friend'
            ),
            'user_send_message'   => array(
                'message',
                'send',
                'close'
            ),
            'user_point'          => array(
                'point',
                'point_info',
                'menu_user_modify',
                'menu_user_scrap',
                'menu_user_message',
                'menu_user_friend',
                'timestamp',
                'all',
                'plus',
                'minus'
            ),
            'user_message'        => array(
                'menu_user_modify',
                'menu_user_point',
                'menu_user_scrap',
                'menu_user_message',
                'menu_user_friend',
                'sender',
                'receiver',
                'message_send_box',
                'message_receive_box',
                'is_read_0',
                'is_read_1',
                'message',
                'timestamp_receive',
                'reply_message',
                'close',
                'send',
                'status',
                'timestamp'
            ),
            'user_message_detail' => array(
                'message',
                'timestamp_receive',
                'reply_message',
                'close',
                'is_read_0',
                'is_read_1'
            ),
            'user_scrap'          => array(
                'menu_user_modify',
                'menu_user_point',
                'menu_user_scrap',
                'menu_user_message',
                'menu_user_friend',
                'title',
                'action'
            )
        );

        return $list[$kind];
    }

    // --------------------------------------------------------------------

	/**
	 * 페이지에 맞는 언어팩만 송출한다.
	 * 원래, 모두 보내던걸, 리소스 절약을 위해 필요한 부분만 보내는 것으로 변경
	 */
    public function add_language_pack($lang = array())
    {
        if(is_array($lang) === TRUE AND count($lang) > 0)
        {

            $result = array();
            foreach($lang as $item)
            {
                $result[$item] = lang($item);
            }

            if(isset($this->assign['lang']) === FALSE)
            {
                $this->assign['lang'] = array();
            }

            $this->assign['lang'] = array_merge($result, $this->assign['lang']);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 비밀번호 변경 캠페인
     *
     */
    protected function password_change_campaign()
    {
        //비밀번호변경 안내
        //흠, 이건 입맛이 많이들 다를듯하지만 일단 간단히 조건에 포함되면 설정값을 보낸다.
        //같은 비번으로 바꾼것도 바꾼거로 치지만.. 뭐 넘어가겠음.
        $this->assign['need_update_password'] = NULL;

        if(SETTING_need_update_password_delay_used == 1)
        {
            if(defined('USER_INFO_idx'))
            {
                if(round((time() - max(USER_INFO_timestamp_insert, USER_INFO_timestamp_update_password)) / (60 * 60 * 24)) > SETTING_need_update_password_delay_value)
                {
                    //$this->assign['need_update_password'] = SETTING_need_update_password_delay_value;
                    $this->assign['need_update_password'] = sprintf(lang('need_update_password'), SETTING_need_update_password_delay_value);
                }
            }
        }
    }

    // --------------------------------------------------------------------

	/**
	 * 욕필터링
	 */
    protected function word_censor($key_list = array(), $params = array(), $block_string = array())
    {
        if(count($key_list) > 0 AND count($params) > 0)
        {
            foreach($params as $key => &$param)
            {
                if(in_array($key, $key_list) === TRUE)
                {
                    $param = word_censor($param, $block_string);
                }
            }
        }

        return $params;
    }

    // --------------------------------------------------------------------

    /**
     * 후킹으로 회원채크 및 정보 세팅
     * @author KangMin
     * @since  2011.11.09
     */
    public function check_login()
    {
        //회원정보
        if($this->session->userdata('user_cookie'))
        {
            $user_cookie = $this->session->userdata('user_cookie');
            $user_cookie = explode('^', $user_cookie);

            //차단,탈퇴가 아닌 회원만..
            $user_info = $this->users_model->get_user_info($user_cookie[0], ' AND status = 1 AND timestamp_insert = ' . (int)$user_cookie[1]);

            //중요 int 필드
            $must_int = array(
                'idx',
                'level',
                'group_idx',
                'status'
            );

            if($user_info && count($user_info) == 1)
            {
                foreach($user_info as $field => $value)
                {
                    define('USER_INFO_' . $field, (in_array($field, $must_int) == TRUE ? (int)$value : $value));
                    $this->assign['USER_INFO_' . $field] = (in_array($field, $must_int) == TRUE ? (int)$value : $value);
                }
            }
            else
            {
                delete_session();
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * 접근내역 저장 (후킹에 있던걸 공용 확장한 코어로 이동)
     * @author KangMin
     * @since  2011.11.09
     */
    public function set_client_ip_access()
    {
        $CI =& get_instance();

        $CI->load->model('client_ip_access_model');

        //마지막 접근내역
        $last_timestamp = $CI->client_ip_access_model->get_client_ip_access_last_timestamp();

        //설정한 저장 텀보다 과거 내역이면 삽입
        if($last_timestamp < (time() - SETTING_access_client_ip_save_term))
        {
            //삭제
            //정확하게 되진 않지만, delete 를 줄이기위해..
            //쿠키로 체킹하려고도 했지만,... 흠... 고민중
            $delete = $CI->client_ip_access_model->del_client_ip_access(SETTING_access_client_ip_save_day * 60 * 60 * 24);

            //삽입
            $insert = $CI->client_ip_access_model->set_client_ip_access();
        }
    }

    // --------------------------------------------------------------------

    /**
     * 사이트 차단 (후킹에 있던걸 공용 확장한 코어로 이동)
     * @author KangMin
     * @since  2011.11.17
     */
    public function site_block()
    {
        $CI =& get_instance();

        $allow = array(
            'admin',
            'block',
            'user',
            'index'
        ); //2012.04.24 index 추가

        if(!in_array($CI->uri->segment(1), $allow))
        {
            if(SETTING_site_block_used == 1)
            {
                delete_session();
                redirect('/block/site', 'refresh');
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * 차단된 IP (후킹에 있던걸 공용 확장한 코어로 이동)
     * @author KangMin
     * @since  2011.11.17
     */
    public function block_client_ip()
    {
        $CI =& get_instance();

        $allow = array('block');

        $CI->load->model('client_ip_block_model');

        $check_client_ip_block = $CI->client_ip_block_model->check_client_ip_block();

        if($check_client_ip_block == TRUE)
        {
            if(!in_array($CI->uri->segment(1), $allow))
            {
                delete_session();
                redirect('/block/ip', 'refresh');
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * 100, 10K, 10M, 10G, 10T, 10P 형식을 byte 로
     * @author lensvil
     *
     * @param mix $mSize
     *
     * @return int|\mix
     */
    static private function get_byte($mSize)
    {
        if(!$mSize)
        {
            return 0;
        }

        $aSize = array(
            'K' => 1024,
            'M' => 1048576,
            'G' => 1073741824,
            'T' => 1099511627776,
            'P' => 1125899906842624
        );

        $sUnit = strtoupper(substr($mSize, -1));
        $iSize = (in_array($sUnit, array(
                                        'K',
                                        'M',
                                        'G',
                                        'T',
                                        'P'
                                   ))) ? (int)substr($mSize, 0, strlen($mSize) - 1) : $mSize;

        return (isset($aSize[$sUnit])) ? $iSize * $aSize[$sUnit] : $iSize;
    }

    // --------------------------------------------------------------------

    /**
     * 그룹icon
     * @author KangMin
     * @since  2012.03.14
     */
    public function set_group_icon()
    {
        $CI =& get_instance();

        $CI->load->model('users_group_model');

        $group_icon = $CI->users_group_model->get_group_icon();

        $group_icon_temp = array();

        foreach($group_icon as $k => $v)
        {
            $group_icon_temp[$v->idx] = $v->icon_path;
        }

        $group_icon = $group_icon_temp;

        define('GROUP_ICON', serialize($group_icon));
		$this->assign['GROUP_ICON'] = $group_icon;
    }

    // --------------------------------------------------------------------

	/**
	 * 파일업로드 사이즈 체크
	 */
    static public function file_upload_max_size()
    {
        define('FILE_UPLOAD_MAX_SIZE', min(self::get_byte(ini_get('post_max_size')), self::get_byte(ini_get('upload_max_filesize'))));
    }

    // --------------------------------------------------------------------

	/**
	 * CI profiler를 controller에서 제어해서 보여주기 위함
	 */
    private function profiler()
    {
        $this->assign['tapbbs_profiler'] = '';

        if(IS_ADMIN === TRUE AND isset($_GET['d']) === TRUE)
        {
            $this->load->library('profiler');
            $this->assign['tapbbs_profiler'] = $this->profiler->run();
        }
    }

    // --------------------------------------------------------------------

    /**
     * 알림 메시지 출력
     *
     * @param array $assign
     */
    protected function alert($assign = array())
    {
        if(empty($assign['message']))
        {
            $assign['message'] = 'ERROR';
        }

        $assign['callback'] = '';
        if(!empty($assign['redirect']))
        {
            if(substr($assign['redirect'], 0, 1) == '/') $assign['redirect'] = substr($assign['redirect'], 1);
            $assign['callback'] = ', function(r) { if(r) {location.href=\'' . BASE_URL . $assign['redirect'] . '\';} }';
        }

        //콜백 함수 강제 작성
        if (!empty($assign['callback_force']))
        {
            $assign['callback'] = ', function(r) { if(r) {' . $assign['callback_force'] . '} }';
        }

        $this->scope('contents', 'contents/alert', $assign);
        $this->display('contents');
        exit;
    }

    // --------------------------------------------------------------------

    /**
     * 데모용 관리자회원정보 항상 픽스시키기
     *
     * @author KangMin
     * @since 2012.04.24
     */
    public function set_demo()
    {
        $CI =& get_instance();

        $admin_info = array(
            'user_id' => 'admin'
            , 'super_secured_password' => '$P$BaztdpBvUUQZbiTJowC74kXLreVUx.0'
        );

        $CI->db->where('idx', 1);
        $CI->db->update('tb_users', $admin_info);

        //IP 차단 삭제
        $CI->db->empty_table('tb_client_ip_block');
    }

    // --------------------------------------------------------------------

	/**
	 * 개발용
	 * 계정변경
	 */
    public function change_cookie_selectbox()
    {
        $d = $this->input->get('d');
        if ($d !== FALSE) {

            ob_start();
            $this->load->model('users_model');
            $sql = 'SELECT idx, user_id, name, nickname, status, timestamp_insert FROM tb_users ORDER BY idx DESC';
            $query = $this->db->query($sql);
            $list = $query->result('array');

            $cookie = $this->session->userdata('user_cookie');
            $tag = array('<select id="change_user_cookie" name="change_user_cookie" style="position:absolute;top:0;left:0;z-index:100">');
            $tag[] = '<option value="">선택</option>';
            foreach ($list as $v) {

                $value = "{$v['idx']}_{$v['timestamp_insert']}";
                $selected = ($cookie == $value) ? ' selected="selected"' : '';
                $tag[] = "<option value='{$v['idx']}^{$v['timestamp_insert']}'{selected}>[{$v['user_id']}] {$v['name']}</option>";
            }
            $tag[] = '</select>';
            echo implode('', $tag);
            $s = ob_get_contents();
            ob_end_clean();
            echo $s;
        }
    }
}

//EOF