<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Onedayonememo extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('plugin/onedayonememo_model');

		$this->lang->load('plugin/onedayonememo');

		//config
		$this->num_links['mobile'] = 2; //하단 페이징 양쪽 갯수 2이고 3페이라면 1 2 3 4 5 로 표출
        $this->num_links['pc'] = 2; //하단 페이징 양쪽 갯수 2이고 3페이라면 1 2 3 4 5 로 표출
		$this->per_page['mobile'] = 10; //한페이지에 보여줄 리스트수
        $this->per_page['pc'] = 10; //한페이지에 보여줄 리스트수
        $this->recently_limit['mobile'] = 3; //메인페이지 최근 하루한마디 표출 갯수
        $this->recently_limit['pc'] = 3; //메인페이지 최근 하루한마디 표출 갯수

        $this->num_links = $this->num_links[$this->viewport];
        $this->per_page = $this->per_page[$this->viewport];
        $this->recently_limit = $this->recently_limit[$this->viewport];

		$this->max_point = 50; //선택할 수 있는 맥시멈
		$this->point_gamble_success = 10; //포인트찍기 성공시 추가해줄 포인트
		$this->block_string = array('개새끼', '씹새끼'); //욕필터링
		$this->cut_length_recently = 0; //최근하루한마디에서 자를 글자수 (0:미사용)
		$this->cut_length = 0; //하루한마디에서 자를 글자수 (0:미사용)

        session_start();
	}

	// --------------------------------------------------------------------

	public function index()
	{
		redirect('/', 'refresh');
	}

	// --------------------------------------------------------------------

	/**
	 * 리스트와 글쓰기 병합형 (하루한마디)
	 *
	 * @author KangMin
	 * @since 2012.01.21
	 */
	public function lists()
	{
        $this->add_language_pack($this->language_pack('onedayonememo'));

		$assign = NULL;

		$this->load->helper('text'); //욕필터링때문에

		//욕필터링
		$assign['block_string'] = $this->block_string;

		//page
		$assign['page'] = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

		$this->load->library('pagination');

		$assign['total_cnt'] = $this->onedayonememo_model->lists_total_cnt(' AND is_deleted = 0 ');

        $this->config->load('pagination');
        $pagination_config = $this->config->item($this->viewport);

        unset($config);

		// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
		$config['base_url'] = BASE_URL.'plugin/onedayonememo/lists?';
		$config['enable_query_strings'] = TRUE; // ?page=10 이런 일반 get 방식
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $this->num_links;
		$config['query_string_segment'] = 'page';
		$config['total_rows'] = $assign['total_cnt'];
		$config['per_page'] = $this->per_page;

        $config = array_merge($config, $pagination_config);

		$this->pagination->initialize($config);

		$assign['pagination'] = $this->pagination->create_links();

		$assign['cut_length'] = $this->cut_length;

		//lists
		$assign['lists'] = $this->onedayonememo_model->lists(($assign['page']-1)*$config['per_page'], $config['per_page'], ' AND is_deleted = 0 ');
        foreach ($assign['lists'] as $k => &$v) {

            $v->contents = cut_string(word_censor($v->contents, $assign['block_string']), $assign['cut_length']);
            $v->contents_detail = word_censor($v->contents, $assign['block_string']);
            $v->print_name = name($v->user_id, $v->name, $v->nickname);
            $v->print_date = time2date($v->timestamp);
            $v->point_gamble = ($v->point_gamble > 0) ? $v->point_gamble : '-';
            $v->point_gamble_success_style = ($v->point_gamble == $v->point_random) ? 'color:red;font-weight:bold' : '';

            //새글 아이콘
            $v->new_article_icon = '';

            //파일 존재
            //if(file_exists('./IMAGEs/icon/new_article.gif'))
            //{
                //시간차
                //if( (int)$v->timestamp >= time() - (24*60*60) ) //24시간
                if(date('Ymd', strtotime(time2date($v->timestamp))) == date('Ymd', strtotime(time2date(time())))) //오늘
                {
                    $v->new_article_icon = FRONTEND_COMMON . '/img/icon/new_article.gif';
                }
            //}

        }

		$assign['max_point'] = $this->max_point;

        $this->scope('contents', 'contents/plugin/onedayonememo', $assign);
        $this->display('layout');
	}

	// --------------------------------------------------------------------

    /**
     * 글작성 연속등록 체크
     *
     * @author KangMin
     * @since 2012.01.08
     *
     * @return bool
     */
    private function check_write_delay()
    {
		$onedayonememo_limit_insert_delay = TRUE;

        //다닥이 때문에 서버 세션으로 굽는다.
        if($_SESSION['onedayonememo_last_timestamp'] && (time() - $_SESSION['onedayonememo_last_timestamp']) < 10)
        {
            $onedayonememo_limit_insert_delay = FALSE;
        }
        else
        {
            $_SESSION['onedayonememo_last_timestamp'] = time();
        }

        if(defined('USER_INFO_idx'))
		{
			//게시판별 마지막 로그인회원의 마지막 글 등록시각
			//회원테이블의 timestamp_post는 종합이라서 안된다.
            $last_timestamp = $this->onedayonememo_model->get_last_timestamp();

			if($last_timestamp > 0)
            {
				if( 1 > ceil((strtotime(date('Y-m-d 00:00:00')) - strtotime(date('Y-m-d 00:00:00', $last_timestamp))) / (60*60*24)) )
				{
					$onedayonememo_limit_insert_delay = FALSE;
				}
            }
		}

        return $onedayonememo_limit_insert_delay;
    }

	// --------------------------------------------------------------------

	/**
	 * 하루한마디 글쓰기 (ajax)
	 *
	 * @author KangMin
	 * @since 2012.01.27
	 */
	public function write()
	{
		$data = NULL;
		$json = NULL;

		//하루한번만 등록가능토록
        //TRUE : 작성가능, FALSE : 작성불가 .. 좀 오해소지가 있지만..정한다
        $check_write_delay = $this->check_write_delay();

		//로그인 상태가 아니거나 권한이 없으면
		if( ! defined('USER_INFO_idx')
			OR $check_write_delay == FALSE )
		{
            if($check_write_delay == FALSE)
            {
                $json['message'] = sprintf(lang('write_delay_onedayonememo'), 1);
            }
            else
            {
			    $json['message'] = lang('deny_allow');
            }

			$json['success'] = FALSE;
		}
		else
		{
			//rules
			$this->form_validation->set_rules('contents', lang('contents'), 'trim|required|htmlspecialchars|xss_clean|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('point_gamble', lang('point_gamble'), 'trim|xss_clean|is_natural|less_than['.($this->max_point+1).']');

			//폼검증 성공이면
			if ($this->form_validation->run() == TRUE)
			{
				$this->load->model('users_point_model');

   				$this->db->trans_start();

				//point
				$point_range = range(1, $this->max_point); // 1~? 배열에 넣기
				shuffle($point_range); //섞기

				$point_random = $point_range[0]; //랜덤 포인트

				$point_insert = 0; //포인트 기본

				$point_gamble = (int)$this->form_validation->set_value('point_gamble'); //찍은 포인트

				if( $point_gamble > 0
					&& $point_gamble == $point_random )
				{
					$point_insert = $point_random + $this->point_gamble_success;
					$json['message_sub'] = sprintf(lang('point_gamble_success'), $this->point_gamble_success);
				}
				else
				{
					$point_insert = $point_random;
					$json['message_sub'] = sprintf(lang('point_random_msg'), $point_random);
				}

				$values['contents'] = $this->form_validation->set_value('contents');
				$values['point_gamble'] = $point_gamble;
				$values['point_random'] = $point_random;
				$values['point_insert'] = $point_insert;

                //등록
                $result = $this->onedayonememo_model->insert($values);

                //users (포인트)
                $result_users_point = $this->users_model->update_count_users(USER_INFO_idx, 'point', $point_insert);
                $result_point = $this->users_point_model->insert_point_comment($point_insert, lang('onedayonememo_point_comment'));

                //users (마지막 글작성시각)
                $result_users_timestamp_post = $this->users_model->update_last_post(USER_INFO_idx);

				$this->db->trans_complete();

				// 그런데.. myisam이면 트랜젝션이 의미가 없어서뤼...쩝
				if($result == TRUE
					AND $result_users_point == TRUE
					AND $result_point == TRUE
					AND $result_users_timestamp_post == TRUE)
				{
					$json['message'] = lang('write_success').'<br />'.$json['message_sub'];
					$json['success'] = TRUE;
				}
				else
				{
					$json['message'] = lang('write_fail_msg');
					$json['success'] = FALSE;
				}
			}
			else
			{
				$json['message'] = str_replace("\n", '', validation_errors());
				$json['success'] = FALSE;
			}
        }//로그인,권한 체크 end if

		echo json_encode($json);
	}

	// --------------------------------------------------------------------

	/**
	 * 인덱스용 최근 하루한마디
	 *
	 * @author KangMin
	 * @since 2012.02.25
	 */
	public function recently()
	{
		$data = NULL;
		$json = NULL;

		//원격호출 차단
		//환경에 따라 문제가 될 수 있어서 뺌. 2012.05.02, KangMin
		//if($_SERVER['SERVER_ADDR'] !== $_SERVER['REMOTE_ADDR']) return FALSE;

		//갯수
		//픽스, 악용하여 DB를 죽일수도 있어서...
		//관리자모드는 제공하지 않는 플러그인형태이므로 수작업..
		$req_limit = $this->recently_limit;// ((int)$this->input->get_post('limit') > 0) ? (int)$this->input->get_post('limit') : 3;

		$this->load->helper('text'); //욕필터링때문에

		//욕필터링
		$data['block_string'] = $this->block_string;

		//lists
		$data['lists'] = $this->onedayonememo_model->lists(0, $req_limit, ' AND is_deleted = 0 ');

		//욕필터링과 다시 정리
		$lists = array();
		$cnt = 0;
		foreach($data['lists'] as $k=>$v)
		{
			//새글 아이콘
			$new_article_icon = '';

			//파일 존재
			//if(file_exists('./IMAGEs/icon/new_article.gif'))
			//{
				//시간차
				//if( (int)$v->timestamp >= time() - (24*60*60) ) //24시간
				if(date('Ymd', strtotime(time2date($v->timestamp))) == date('Ymd', strtotime(time2date(time())))) //오늘
				{
					$new_article_icon = FRONTEND_COMMON . '/img/icon/new_article.gif';
				}
			//}

			$lists[$cnt]['idx'] = $v->idx;
			$lists[$cnt]['name'] = name($v->user_id, $v->name, $v->nickname);
			$lists[$cnt]['contents'] = cut_string(word_censor($v->contents, $data['block_string']), $this->cut_length_recently);
			$lists[$cnt]['timestamp'] = time2date($v->timestamp);
			$lists[$cnt]['new_article_icon'] = $new_article_icon;

			$cnt++;
		}

		$json['lists'] = $lists;

		echo json_encode($json);
	}
}

//EOF