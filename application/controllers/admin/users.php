<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

    /**
     * 회원관리
     * @author KangMin
     * @since 2011.11.25
     */
	public function index()
	{
		$data = NULL;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
		{
    		delete_session();
			$this->layout->view_admin('login_view');
		}
		else
		{
			$req_group_idx = ((int)$this->input->get('group_idx') > 0) ? (int)$this->input->get('group_idx') : NULL;
			$req_search_word = ($this->input->get('search_word')) ? $this->input->get('search_word') : NULL;
			$req_page = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;
			$req_status = (trim($this->input->get('status')) !== '') ? (int)$this->input->get('status') : NULL;

			//검색필드세팅
			$searchs = array();
			$searchs_equals = array();
			$searchs_like = array();
			$searchs_and = array();
			$searchs_or = array();

			if($req_group_idx !== NULL)
			{
				$searchs_equals['group_idx'] = $req_group_idx;
			}

			if($req_status !== NULL)
			{
				$searchs_equals['status'] = $req_status;
			}

			if($req_search_word !== NULL)
			{
				$searchs_like = array('user_id' => $req_search_word
										, 'name' => $req_search_word
										, 'nickname' => $req_search_word
										, 'email' => $req_search_word
										);
			}

			$searchs_and = array('group_idx', 'status');
			$searchs_or = array('user_id', 'name', 'nickname', 'email');

			foreach($searchs_equals as $k=>$v)
			{
				if(in_array($k, $searchs_and)) $searchs['and'][] = $k.' = \''.$v.'\' ';
				else $searchs['or'][] = $k.' = \''.$v.'\' ';
			}

			foreach($searchs_like as $k=>$v)
			{
				if(in_array($k, $searchs_and)) $searchs['and'][] = $k.' LIKE \'%'.$v.'%\' ';
				else $searchs['or'][] = $k.' LIKE \'%'.$v.'%\' ';
			}

			//회원그룹
			$this->load->model('users_group_model');
			$data['users_group'] = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 ');

			$data['req_group_idx'] = $req_group_idx;
			$data['req_search_word'] = $req_search_word;
			$data['req_status'] = $req_status;

			$this->load->library('pagination');

			$data['total_cnt'] = $this->users_model->get_users_total_cnt($searchs);

			// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
			$config['base_url'] = BASE_URL.'admin/users?group_idx='.$req_group_idx.'&amp;search_word='.$req_search_word;
			$config['enable_query_strings'] = TRUE; // ?page=10 이런 일반 get 방식
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = 5;
			$config['query_string_segment'] = 'page';
			$config['total_rows'] = $data['total_cnt'];
			$config['per_page'] = 20; //20개씩

			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();

			if($data['total_cnt'] > 0)
			{
				$data['users'] = $this->users_model->get_users(($req_page-1)*$config['per_page'], $config['per_page'], $searchs);
			}

			$this->layout->view_admin('users/index_view', $data);
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 회원그룹관리
	 *
	 * 좀 더럽다... 최고관리자 그룹에 기본설정한 그룹등 조건이 너무...
	 *
     * @author KangMin
     * @since 2011.11.25
     */
	public function group()
	{
		$data = NULL;
		$post_success = FALSE;
        $user_cnt_error = FALSE;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
		{
    		delete_session();
			$this->layout->view_admin('login_view');
		}
		else
		{
			$this->load->model('users_group_model');

			//픽스 그룹
			$fix_group = unserialize(SETTING_fix_group);

			$req_mode = ($this->input->post('mode') == 'update') ? 'update' : 'insert';

			//rules
			$this->form_validation->set_rules('mode', 'mode', 'trim|required|xss_clean|alpha');
			$this->form_validation->set_rules('group_name', lang('group_name'), 'trim|required|htmlspecialchars|xss_clean|max_length[64]');
			$this->form_validation->set_rules('icon_path', lang('group_name'), 'trim|htmlspecialchars|xss_clean|max_length[255]');

			if($req_mode == 'update')
			{
				$this->form_validation->set_rules('idx', 'idx', 'trim|required|xss_clean|is_natural_no_zero');
				$this->form_validation->set_rules('is_used', lang('is_used'), 'trim|required|xss_clean|max_length[1]|is_natural|less_than[2]');

				if( (int)$this->input->post('idx') !== $fix_group[0] )
				{
					$this->form_validation->set_rules('move_group', lang('is_used'), 'trim|required|xss_clean|is_natural_no_zero');
					$this->form_validation->set_rules('move_group_original', lang('is_used'), 'trim|required|xss_clean|is_natural_no_zero');
				}
			}

			//폼검증 성공이면
			if ($this->form_validation->run() == TRUE)
			{
				$req_mode = $this->form_validation->set_value('mode');
				$req_group_name = $this->form_validation->set_value('group_name');
				$req_icon_path = $this->form_validation->set_value('icon_path');

				//그룹명 중복체크
				if($req_mode == 'update') //수정
				{
					$req_idx = (int)$this->form_validation->set_value('idx');
					$req_is_used = (int)$this->form_validation->set_value('is_used');
					$check = $this->users_group_model->check_group_name($req_group_name, ' AND idx <> '. $req_idx);

                    $user_cnt = $this->users_model->get_users_total_cnt(array('and'=>array('group_idx = '.$req_idx)));

                    if($req_is_used == 0 && $user_cnt != 0)
                    {
                        $user_cnt_error = TRUE;
                    }

                    if( in_array($req_idx, $fix_group) == TRUE OR $req_idx == SETTING_default_group_idx)
					{
						$req_is_used = 1; //기본 최고관리자,일반회원,가입기본그룹은 미사용 못하게 (비정상적 접근이고 강제변환하므로 에러를 보여줄 필요까진 없겠다.
					}

					$req_move_group = 0;
					$req_move_group_original = 0;

					if($req_idx !== $fix_group[0]) //최고관리자 그룹은 이동도 막는다. 이동하면 최고관리자가 아무도 없게 될 수도 있다.
					{
						$req_move_group = (int)$this->form_validation->set_value('move_group');
						$req_move_group_original = (int)$this->form_validation->set_value('move_group_original');
					}
				}
				else //삽입
				{
					$check = $this->users_group_model->check_group_name($req_group_name);
				}

				if($check == TRUE) //true 면 있는거니 중복
				{
					$data['result_msg'] = lang('group_name_duplicate');
				}
				else
				{
					if($req_mode == 'update')
					{
                        if($user_cnt_error == FALSE)
                        {
                            $result = $this->users_group_model->update_group($req_idx, $req_group_name, $req_icon_path, $req_is_used);

                            //그룹이동
                            //그룹이 미사용인건지까지 체킹은 오바인듯, 또 미사용에 옮겨도 뭐 다시 옮기면 되니까
                            //아래 조건 else라면 비정상적인 접근이고 처리를 하지 않으니 에러를 보여줄 필요는 없겠다.
                            if($req_move_group !== $req_move_group_original //기존그룹과 다르고
                                && $req_move_group !== SETTING_admin_group_idx) //최고관리자 그룹이 아니고
                            {
                                $result_move_group = $this->users_model->update_group($req_move_group_original, $req_move_group);
                            }
                        }
                        else
                        {
                            $result = FALSE;
                        }
					}
					else
					{
						$result = $this->users_group_model->insert_group($req_group_name, $req_icon_path);
					}

					if($result == TRUE)
					{
						$post_success = TRUE;
						$data['message'] = lang($req_mode.'_success');
						$data['redirect'] = '/admin/users/group';

						$this->layout->view_admin_only_contents('alert_view', $data);
					}
					else
					{
                        if($user_cnt_error == TRUE)
                        {
                            $data['result_msg'] = lang('move_group_used_fail_msg');
                        }
                        else
                        {
                            $data['result_msg'] = lang('group_'.$req_mode.'_fail_msg');
                        }
					}
				}
			}

			if($post_success == FALSE)
			{
				//회원그룹
				$data['users_group'] = $this->users_group_model->get_users_group();

				//그룹별 회원수
				foreach($data['users_group'] as $k=>$v)
				{
					$data['users_group'][$k]->user_cnt = $this->users_model->get_users_total_cnt(array('and'=>array('group_idx = '.$v->idx)));
				}

				$this->layout->view_admin('users/group_view', $data);
			}
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 회원그룹관리 변경내역 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
	public function group_revision()
	{
		$data = NULL;

		$req_idx = ((int)$this->input->get('idx') > 0) ? (int)$this->input->get('idx') : NULL;
		$req_page = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
			OR $req_idx == NULL)
		{
    		delete_session();
			show_error(lang('unusual_approach'));
		}
		else
		{
			$this->load->model('users_group_revision_model');
			$this->load->library('pagination');

			$data['total_cnt'] = $this->users_group_revision_model->get_revision_total_cnt($req_idx);

			// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
			$config['base_url'] = BASE_URL.'admin/users/group_revision?idx='.$req_idx;
			$config['enable_query_strings'] = TRUE; // ?page=10 이런 일반 get 방식
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = 5;
			$config['query_string_segment'] = 'page';
			$config['total_rows'] = $data['total_cnt'];
			$config['per_page'] = 10; //10개씩

			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();

			if($data['total_cnt'] > 0)
			{
				$data['users_group'] = $this->users_group_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
			}

			$this->layout->view_admin_only_contents('users/group_revision_view', $data);
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 상세 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
	public function detail()
	{
        require_once APPPATH.'third_party/phpass-0.3/PasswordHash.php';

		$data = NULL;
		$post_success = FALSE;

		$req_idx = ((int)$this->input->get_post('idx') > 0) ? (int)$this->input->get_post('idx') : NULL;

		//체크
		$check_req_idx = $this->users_model->check('idx', $req_idx);

		if($check_req_idx !== TRUE) $req_idx = NULL;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
			OR $req_idx == NULL)
		{
    		delete_session();
			show_error(lang('unusual_approach'));
		}
		else
		{
			$this->load->model('users_group_model');

            //비밀번호 입력했으면 수정, 아니면 통과
            if($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean|min_length['.SETTING_user_password_length_minimum.']|max_length['.SETTING_user_password_length_maximum.']');
                $this->form_validation->set_rules('password_confirm', lang('password_confirm'), 'trim|required|xss_clean|matches[password]');
            }

			$this->form_validation->set_rules('user_id', lang('user_id'), 'trim|required|xss_clean|alpha_dash|min_length['.SETTING_user_id_length_minimum.']|max_length['.SETTING_user_id_length_maximum.']');
			$this->form_validation->set_rules('name', lang('name'), 'trim|required|xss_clean|min_length['.SETTING_user_name_length_minimum.']|max_length['.SETTING_user_name_length_maximum.']');
			$this->form_validation->set_rules('nickname', lang('nickname'), 'trim|required|xss_clean|min_length['.SETTING_user_nickname_length_minimum.']|max_length['.SETTING_user_nickname_length_maximum.']');
			$this->form_validation->set_rules('level', lang('level'), 'trim|required|xss_clean|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('group_idx', lang('group'), 'trim|required|xss_clean|is_natural_no_zero');
			$this->form_validation->set_rules('email', lang('email'), 'trim|required|htmlspecialchars|xss_clean|valid_email|max_length[128]');
			$this->form_validation->set_rules('point', lang('point'), 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('article_count', lang('article_count'), 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('comment_count', lang('comment_count'), 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('vote_send_count', lang('vote_send_count'), 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('vote_receive_count', lang('vote_receive_count'), 'trim|required|xss_clean|is_natural');
			$this->form_validation->set_rules('timezones', lang('timezone'), 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', lang('status'), 'trim|required|xss_clean|is_natural|less_than[3]');

			//폼검증 성공이면
			if ($this->form_validation->run() == TRUE)
			{
				//request
				if($this->input->post('password'))
				{
					$req_password = $this->form_validation->set_value('password');
					$req_password_confirm = $this->form_validation->set_value('password_confirm');
				}
				$req_user_id = $this->form_validation->set_value('user_id'); //요건 valication이 좀..흠.. front도 아니고..
				$req_name = htmlspecialchars($this->form_validation->set_value('name'));
				$req_nickname = htmlspecialchars($this->form_validation->set_value('nickname'));
				$req_level = ($req_user_id == 'admin') ? 99 : $this->form_validation->set_value('level'); //admin은 바꾸지않는다
				$req_group_idx = ($req_user_id == 'admin') ? SETTING_admin_group_idx : $this->form_validation->set_value('group_idx');//admin은 바꾸지않는다
				$req_email = $this->form_validation->set_value('email');
				$req_point = $this->form_validation->set_value('point'); //강제조작용
				$req_article_count = $this->form_validation->set_value('article_count'); //강제조작용
				$req_comment_count = $this->form_validation->set_value('comment_count'); //강제조작용
				$req_vote_send_count = $this->form_validation->set_value('vote_send_count'); //강제조작용
				$req_vote_receive_count = $this->form_validation->set_value('vote_receive_count'); //강제조작용
				$req_timezones = $this->form_validation->set_value('timezones');
				$req_status = $this->form_validation->set_value('status');

				$data['result_msg'] = NULL;
				$modify_fail_msg = array();

				//회원그룹 유효성 확인
				$check_group_idx = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx = '.$req_group_idx);

				if( count($check_group_idx) == 0 )
				{
					$modify_fail_msg[] = lang('none_group_idx');
				}

				//상태체크.. 뭐.. 새창에서 정상인 상태에서 저장을하기전에 다른 관리자가 탈퇴/차단시킨 회원이래도 다시 정상이 되지만.. 흠.. 이건 관리의 몫이 아닐런지..

				//user_id 중복 확인
				$check_user_id = $this->users_model->check('user_id', $req_user_id, ' AND idx <> '.$req_idx);

				if($check_user_id == TRUE) //회원아이디가 있으면(TRUE) 가입못함
				{
					$modify_fail_msg[] = lang('user_id_duplicate');
				}

				//닉네임 중복 확인
				$check_nickname = $this->users_model->check('nickname', $req_nickname, ' AND idx <> '.$req_idx);

				if($check_nickname == TRUE) //닉네임 있으면(TRUE) 가입못함
				{
					$modify_fail_msg[] = lang('nickname_duplicate');
				}

				//이메일 중복 확인
				$check_email = $this->users_model->check('email', $req_email, ' AND idx <> '.$req_idx);

				if($check_email == TRUE) //이메일 있으면(TRUE) 가입못함
				{
					$modify_fail_msg[] = lang('email_duplicate');
				}

				if( count($modify_fail_msg) > 0 )
				{
					//user_id, 닉네임, 이메일 중 1개 이상 오류
					$data['result_msg'] = join('<br />', $modify_fail_msg);
				}
				else
				{

                    if($this->input->post('password'))
                    {
                        $hash = new PasswordHash(8, FALSE);
                        $super_secured_password = $hash->HashPassword($req_password);
                    }

					//정상 수정
					$values = array();

					$values['user_id'] = $req_user_id;
					$values['password'] = ($this->input->post('password')) ? $super_secured_password : '';
					$values['name'] = $req_name;
					$values['nickname'] = $req_nickname;
					$values['level'] = $req_level;
					$values['group_idx'] = $req_group_idx;
					$values['email'] = $req_email;
					$values['point'] = $req_point;
					$values['article_count'] = $req_article_count;
					$values['comment_count'] = $req_comment_count;
					$values['vote_send_count'] = $req_vote_send_count;
					$values['vote_receive_count'] = $req_vote_receive_count;
                    $values['timezones'] = $req_timezones;
					$values['status'] = $req_status;

					$result = $this->users_model->modify_admin($req_idx, $values);

					if($result == TRUE)
					{
						$post_success = TRUE; //최종 성공 여부
						$data['message'] = lang('update_success');
						$data['redirect'] = '/admin/users/detail?idx='.$req_idx;

						$this->layout->view_admin_only_contents('alert_view', $data);
					}
					else
					{
						$data['result_msg'] = lang('modify_fail_msg');
					}
				}
			}

			if($post_success == FALSE)
			{
				$this->load->model('users_point_model');
				$this->load->model('bbs_article_model');
				$this->load->model('bbs_comment_model');
				$this->load->model('bbs_vote_model');

				//검수용
				$data['point_sum'] = $this->users_point_model->get_point_sum($req_idx, ' AND is_deleted = 0 ');
				$data['examination_article_count'] = $this->bbs_article_model->get_article_count_user($req_idx);
				$data['examination_comment_count'] = $this->bbs_comment_model->get_comment_count_user($req_idx);
				$data['examination_vote_send_count'] = $this->bbs_vote_model->get_vote_send_count_user($req_idx);
				$data['examination_vote_receive_count'] = $this->bbs_vote_model->get_vote_receive_count_user($req_idx);

				$data['req_idx'] = $req_idx;
				$data['user_info'] = $this->users_model->get_user_info($req_idx);

				//회원그룹
				$data['users_group'] = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 ');

				$this->layout->view_admin_only_contents('users/detail_view', $data);
			}
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 포인트 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
	public function point()
	{
		$data = NULL;
		$post_success = FALSE;

		$req_user_idx = $data['user_idx'] = ((int)$this->input->get_post('user_idx') > 0) ? (int)$this->input->get_post('user_idx') : NULL;
		$req_page = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

		//체크
		$check_req_user_idx = $this->users_model->check('idx', $req_user_idx);

		if($check_req_user_idx !== TRUE) $req_user_idx = NULL;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
			OR $req_user_idx == NULL)
		{
    		delete_session();
			show_error(lang('unusual_approach'));
		}
		else
		{
			$this->load->model('users_point_model');

			$req_mode = $this->input->post('mode');

			$this->form_validation->set_rules('point', lang('point'), 'trim|required|xss_clean|integer');

			if($req_mode == 'delete' OR $req_mode == 'normal')
			{
				//rules
				$this->form_validation->set_rules('idx', 'idx', 'trim|required|xss_clean|is_natural_no_zero');
			}
			else if($req_mode == 'insert')
			{
				//rules
				$this->form_validation->set_rules('comment', lang('ment'), 'trim|required|htmlspecialchars|xss_clean|max_length[255]');
			}
			else
			{}

			//폼검증 성공이면
			if ($this->form_validation->run() == TRUE)
			{
				$this->db->trans_start();

				$req_point = (int)$this->form_validation->set_value('point');

				if($req_mode == 'delete')
				{
					$result = $this->users_point_model->update_is_deleted($this->form_validation->set_value('idx'), $req_user_idx, 1);
					$result_users = $this->users_model->update_count_users($req_user_idx, 'point', $req_point*-1);
				}
				else if($req_mode == 'normal')
				{
					$result = $this->users_point_model->update_is_deleted($this->form_validation->set_value('idx'), $req_user_idx, 0);
					$result_users = $this->users_model->update_count_users($req_user_idx, 'point', $req_point);
				}
				else // insert
				{
					$result = $this->users_point_model->insert_point_comment($req_point, $this->form_validation->set_value('comment'), $req_user_idx);
					$result_users = $this->users_model->update_count_users($req_user_idx, 'point', $req_point);
				}

				$this->db->trans_complete();

				if($result == TRUE AND $result_users == TRUE)
				{
					$post_success = TRUE;

					$data['message'] = lang('success');
					$data['redirect'] = '/admin/users/point?user_idx='.$req_user_idx;

					$this->layout->view_admin_only_contents('alert_view', $data);
				}
				else
				{
					$data['result_msg'] = lang('fail_msg');
				}
			}

			if($post_success == FALSE)
			{
				$this->load->library('pagination');

				$req_operator = $this->input->get('operator');
				$add_where_operator = '';

				if($req_operator == 'plus') $add_where_operator = ' AND USERS_POINT.point >= 0 ';
				else if($req_operator == 'minus') $add_where_operator = ' AND USERS_POINT.point < 0 ';

				//포인트내역의 합계 포인트 표출
				//회원 DB의 포인트와 비교
				//요건 삭제가 아닌것만이니
				$data['point_sum'] = $this->users_point_model->get_point_sum($req_user_idx, ' AND is_deleted = 0 ');

				$data['total_cnt'] = $this->users_point_model->get_point_info_total_cnt($req_user_idx, $add_where_operator);

				// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
				$config['base_url'] = BASE_URL.'admin/users/point?user_idx='.$req_user_idx.'&amp;operator='.$req_operator;
				$config['enable_query_strings'] = TRUE; // ?page=10 이런 일반 get 방식
				$config['page_query_string'] = TRUE;
				$config['use_page_numbers'] = TRUE;
				$config['num_links'] = 5;
				$config['query_string_segment'] = 'page';
				$config['total_rows'] = $data['total_cnt'];
				$config['per_page'] = 30; //30개씩

				$this->pagination->initialize($config);

				$data['pagination'] = $this->pagination->create_links();

				if($data['total_cnt'] > 0)
				{
					$data['users_point'] = $this->users_point_model->get_point_info($req_user_idx, ($req_page-1)*$config['per_page'], $config['per_page'], $add_where_operator, TRUE);
				}

				$this->layout->view_admin_only_contents('users/point_view', $data);
			}
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 차단내역 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
	public function block_history()
	{
		$data = NULL;

		$this->layout->view_admin_only_contents('users/block_history_view', $data);
	}
}

//EOF