<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	public function phpinfo()
	{
		$data = null;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
		{
    		delete_session();
			$this->layout->view_admin('login_view');
		}
		else
		{
            phpinfo();
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 기본설정
	 *
     * @author KangMin
     * @since 2011.11.20
     */
	public function index()
	{
		$data = null;
		$post_success = false;

		//업데이트하지 않는 히든 설정 항목
		$not_update = array(
							'fix_group' //최고관리자, 일반회원 기본 2개의 그룹의 idx를 가지고 있음
							, 'admin_group_idx' //최고관리자의 idx
                            , 'bbs_recently_used' //최근게시물에서 쿼리할 게시판들
                            , 'arrangefiles_last_idx' //첨부파일 정리한 마지막 인덱스
							);

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
		{
    		delete_session();
			$this->layout->view_admin('login_view');
		}
		else
		{
			//rules
			$this->form_validation->set_rules('access_client_ip_save_day', lang('access_client_ip_save_day'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('access_client_ip_save_term', lang('access_client_ip_save_term'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('block_client_ip_contents', lang('block_client_ip_contents'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('default_group_idx', lang('default_group_idx'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('ajax_timeout', lang('ajax_timeout'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('apple_touch_icon_path', lang('apple_touch_icon_path'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('apple_touch_icon_precomposed', lang('apple_touch_icon_precomposed'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('favicon_path', lang('favicon_path'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('avatar_limit_capacity', lang('avatar_limit_capacity'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('avatar_limit_image_size_width', lang('avatar_limit_image_size_width'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('avatar_limit_image_size_height', lang('avatar_limit_image_size_height'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('avatar_used', lang('avatar_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('avatar_used_pc', lang('avatar_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('browser_title_fix_value', lang('browser_title_fix_value'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('browser_title_fix_value_pc', lang('browser_title_fix_value'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('browser_title_type', lang('browser_title_type'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('browser_title_type_pc', lang('browser_title_type'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('captcha_timeout', lang('captcha_timeout'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('datetime_type', lang('datetime_type'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('datetime_type_pc', lang('datetime_type'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('timezones', lang('default_timezone'), 'trim|required|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('need_update_password_delay_used', lang('need_update_password_delay_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('need_update_password_delay_value', lang('need_update_password_delay_value'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('new_password_mail_title', lang('new_password_mail_title'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('new_password_mail_contents', lang('new_password_mail_contents'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('new_password_timeout', lang('new_password_timeout'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('point_unit', lang('point_unit'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('reload_time_used', lang('reload_time_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('reload_time_value', lang('reload_time_value'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('site_block_contents', lang('site_block_contents'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('site_block_used', lang('site_block_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('user_id_length_maximum', lang('user_id_length_maximum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_id_length_minimum', lang('user_id_length_minimum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_name_length_maximum', lang('user_name_length_maximum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_name_length_minimum', lang('user_name_length_minimum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_nickname_length_maximum', lang('user_nickname_length_maximum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_nickname_length_minimum', lang('user_nickname_length_minimum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_password_length_maximum', lang('user_password_length_maximum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('user_password_length_minimum', lang('user_password_length_minimum'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('view_name_type', lang('view_name_type'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('view_name_type_pc', lang('view_name_type'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
			$this->form_validation->set_rules('bbs_upload_limit_user_capacity', lang('bbs_upload_limit_user_capacity'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('bbs_upload_limit_user_capacity_used', lang('bbs_upload_limit_user_capacity_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('join_used', lang('join_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
			$this->form_validation->set_rules('recently_comment_count', lang('recently_comment_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('recently_comment_count_pc', lang('recently_comment_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_search', lang('count_list_search'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_search_pc', lang('count_list_search'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_search', lang('count_page_search'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_search_pc', lang('count_page_search'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_point', lang('count_list_point'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_point_pc', lang('count_list_point'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_point', lang('count_page_point'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_point_pc', lang('count_page_point'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_scrap', lang('count_list_scrap'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_scrap_pc', lang('count_list_scrap'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_scrap', lang('count_page_scrap'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_scrap_pc', lang('count_page_scrap'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_message', lang('count_list_message'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_message_pc', lang('count_list_message'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_message', lang('count_page_message'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_message_pc', lang('count_page_message'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_friend', lang('count_list_friend'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_list_friend_pc', lang('count_list_friend'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_friend', lang('count_page_friend'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
			$this->form_validation->set_rules('count_page_friend_pc', lang('count_page_friend'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');

			//v0.1.7
			$this->form_validation->set_rules('cut_length_recently_comment', lang('cut_length_recently_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_recently_comment_pc', lang('cut_length_recently_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_title_search', lang('cut_length_title_search'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_title_search_pc', lang('cut_length_title_search'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_title_scrap', lang('cut_length_title_scrap'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_title_scrap_pc', lang('cut_length_title_scrap'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_title_message', lang('cut_length_title_message'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('cut_length_title_message_pc', lang('cut_length_title_message'), 'trim|required|xss_clean|max_length[1000]|is_natural');
			$this->form_validation->set_rules('string_after_cut_length', lang('string_after_cut_length'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');

			$this->load->model('users_group_model');

			//폼검증 성공이면
			if ($this->form_validation->run() == true)
			{
				$setting = $this->setting_model->get_setting(' AND default_bbs = 0 AND SETTING.parameter NOT IN (\''.join("','", $not_update).'\') '); //픽스그룹은 업데이트하면 안되니까..

				//회원그룹 유효성 확인
				$check_default_group_idx = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx = '.$this->form_validation->set_value('default_group_idx'));

				//삭제한 그룹이면
				if( count($check_default_group_idx) == 0 )
				{
					$post_success = true;

					$data['message'] = lang('none_group_idx');
				}
				else
				{
					$this->db->trans_start();

					foreach($setting as $k => $v)
					{
						//타임존만 따로..
						if($v->parameter == 'default_timezone')
						{
							$this->setting_model->update($v->parameter, $this->form_validation->set_value('timezones'));
						}
						else
						{
							$this->setting_model->update($v->parameter, $this->form_validation->set_value($v->parameter));
						}
					}

					$this->db->trans_complete();

                    $this->load->driver('cache');

					//캐쉬 삭제
                    if($this->cache->file->get('setting')) $this->cache->file->delete('setting');
					if($this->cache->file->get('recently_comment_mobile')) $this->cache->file->delete('recently_comment_mobile'); //최근게시물 갯수를 수정하면 이도 삭제해야 바로 적용된다.
                    if($this->cache->file->get('recently_comment_pc')) $this->cache->file->delete('recently_comment_pc'); //최근게시물 갯수를 수정하면 이도 삭제해야 바로 적용된다.

					//게시판 전체 캐시 삭제
					$this->load->model('bbs_setting_model');
					$bbs = $this->bbs_setting_model->get_bbs_setting();

					foreach($bbs as $v)
					{
						if($this->cache->file->get('bbs_setting_'.$v->bbs_idx)) $this->cache->file->delete('bbs_setting_'.$v->bbs_idx);
						if($this->cache->file->get('recently_'.$v->bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$v->bbs_idx.'_mobile');
						if($this->cache->file->get('recently_'.$v->bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$v->bbs_idx.'_pc');
					}

					$post_success = true;

					$data['message'] = lang('update_success');
				}

				$data['redirect'] = '/admin/setting';

				$this->layout->view_admin_only_contents('alert_view', $data);
			}

			if($post_success == false)
			{
				$setting = $this->setting_model->get_setting(' AND default_bbs = 0 AND SETTING.parameter NOT IN (\''.join("','", $not_update).'\') ');

				//setting 배열 정리
				$setting_temp = array();

				foreach($setting as $k => $v)
				{
					$setting_temp[$v->parameter]['idx'] = $v->idx;
					$setting_temp[$v->parameter]['parameter'] = $v->parameter;
					$setting_temp[$v->parameter]['value'] = $v->value;
					$setting_temp[$v->parameter]['name'] = name($v->user_id, $v->name, $v->nickname);
					$setting_temp[$v->parameter]['client_ip'] = $v->client_ip;
				}

				$data['setting'] = $setting_temp;

				//회원그룹
				$data['users_group'] = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx <> '.SETTING_admin_group_idx);

				$this->layout->view_admin('setting/index_view', $data);
			}
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 설정 변경 내역 (팝업)
	 *
     * @author KangMin
     * @since 2011.11.23
     */
	public function revision()
	{
		$data = null;

		$req_idx = ((int)$this->input->get('idx') > 0) ? (int)$this->input->get('idx') : null;
		$req_page = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
			OR $req_idx == null)
		{
    		delete_session();
			show_error(lang('unusual_approach'));
		}
		else
		{
			$this->load->model('setting_revision_model');
			$this->load->library('pagination');

			$data['total_cnt'] = $this->setting_revision_model->get_revision_total_cnt($req_idx);

			// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
			$config['base_url'] = BASE_URL.'admin/setting/revision?idx='.$req_idx;
			$config['enable_query_strings'] = true; // ?page=10 이런 일반 get 방식
			$config['page_query_string'] = true;
			$config['use_page_numbers'] = true;
			$config['num_links'] = 5;
			$config['query_string_segment'] = 'page';
			$config['total_rows'] = $data['total_cnt'];
			$config['per_page'] = 10; //10개씩

			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();

			if($data['total_cnt'] > 0)
			{
				$data['revision'] = $this->setting_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
			}

			$this->layout->view_admin_only_contents('setting/revision_view', $data);
		}//로그인,권한 체크 end if
	}

    // --------------------------------------------------------------------

    /**
     * 테마 리스트 및 등록/수정
     *
     * @author 배강민
     */
    public function themes()
    {
        $data = null;
        $post_success = false;

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            $this->load->model('themes_model');

            $req_mode = ($this->input->post('mode') == 'update') ? 'update' : 'insert';

            //rule
            $this->form_validation->set_rules('title', lang('theme_title'), 'trim|required|htmlspecialchars|xss_clean|max_length[100]');
            $this->form_validation->set_rules('folder_name', lang('folder_name'), 'trim|required|htmlspecialchars|xss_clean|max_length[100]');
            $this->form_validation->set_rules('type', lang('type'), 'trim|required|htmlspecialchars|xss_clean|alpha|max_length[1]');

            if($req_mode == 'update')
            {
                $this->form_validation->set_rules('idx', 'idx', 'trim|required|xss_clean|is_natural_no_zero');
                $this->form_validation->set_rules('is_used_'.$this->input->post('type'), lang('is_used'), 'trim|xss_clean|max_length[1]|is_natural|less_than[2]');
            }

            //폼검증 성공이면
            if ($this->form_validation->run() == true)
            {
                $title = $this->form_validation->set_value('title');
                $type = $this->form_validation->set_value('type');
                $folder_name = $this->form_validation->set_value('folder_name');
                $type_folder = $type == 'M' ? 'mobile' : 'pc';

                //삽입
                if($req_mode == 'insert')
                {
                    if(file_exists('front_end/themes/'.$type_folder.'/'.$folder_name) == TRUE)
                    {
                        $check_folder = TRUE;
                        $result_theme = $this->themes_model->insert_theme($type, null, $title, $folder_name);
                    }
                    else
                    {
                        $result_theme = FALSE;
                        $check_folder = FALSE;
                    }
                }
                else //수정
                {
                    $idx = $this->form_validation->set_value('idx');

                    //존재여부
                    $idx = $this->form_validation->set_value('idx');
                    $check_idx = $this->themes_model->check_idx($idx);

                    if($check_idx == true)
                    {
                        $is_used = $this->form_validation->set_value('is_used_'.$type);

                        if(file_exists('front_end/themes/'.$type_folder.'/'.$folder_name) == TRUE)
                        {
                            $check_folder = TRUE;
                            $result_theme = $this->themes_model->update_theme($idx, $title, $folder_name, $is_used);

                            //사용여부를 켜는거면 기존것들을 끈다.
                            if($is_used == 1)
                            {
                                $result_reset_is_used = $this->themes_model->reset_is_used($idx, $type); //별거 없으니 그냥 넘어간다.
                            }
                        }
                        else
                        {
                            $result_theme = FALSE;
                            $check_folder = FALSE;
                        }
                    }
                    else //비정상접근
                    {
                        $result_theme = false;
                    }
                }

                if($result_theme == true)
                {
                    $post_success = true;
                    $data['message'] = lang($req_mode.'_success');
                    $data['redirect'] = '/admin/setting/themes';

                    $this->layout->view_admin_only_contents('alert_view', $data);
                }
                else
                {
                    if($check_folder == FALSE)
                    {
                        $data['result_msg'] = sprintf(lang('theme_folder_check_fail_msg'), 'front_end/themes/'.$type_folder.'/'.$folder_name);
                    }
                    else
                    {
                        $data['result_msg'] = lang($req_mode.'_fail_msg');
                    }
                }
            }

            if($post_success == false)
            {
                $data['lists'] = $this->themes_model->get_themes_lists();

                $this->layout->view_admin('setting/themes_view', $data);
            }
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 테마 복사
     *
     * @author 배강민
     */
    public function copy_theme()
    {
        $this->load->model('themes_model');

        $idx = $this->input->get('idx');
        if( ! $idx) $idx = 0;
        $type = $this->input->get('type');
        if( ! in_array($type, array('M', 'P'))) $type = 'M';
        $result_source = $this->themes_model->get_theme($type, $idx);

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR count($result_source) !== 1 ) //이 케이스라면 비정상이니 뭐...그냥 튕긴다.
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            $title = substr('Copy Of '.$result_source->title, 0, 100);
            $folder_name = $result_source->folder_name.'_copy_'.time();

            $type_folder = $result_source->type == 'M' ? 'mobile' : 'pc';

            $source = 'front_end/themes/'.$type_folder.'/'.$result_source->folder_name;
            $target = 'front_end/themes/'.$type_folder.'/'.$folder_name;

            //source 폴더가 있고, target 폴더가 없는지 확인
            if(file_exists($source) == FALSE OR file_exists($target) == TRUE)
            {
                $data['message'] = lang('theme_copy_folder_check_fail_msg');
            }
            else
            {
                if(SETTING_OS == 'WIN')
                {
                    $source_win = str_replace('/', "\\", $source);
                    $target_win = str_replace('/', "\\", $target);
                    exec("xcopy $source_win $target_win /e/i");
                }
                else
                {
                    exec("cp -r $source $target");
                }

                if(file_exists($target) == TRUE)
                {
                    $result_theme = $this->themes_model->insert_theme($result_source->type, $idx, $title, $folder_name);

                    if($result_theme == TRUE)
                    {
                        $data['message'] = lang('theme_copy_success_msg');
                    }
                    else
                    {
                        $data['message'] = lang('theme_copy_fail_msg');
                    }
                }
                else
                {
                    $data['message'] = lang('theme_copy_fail_msg');
                }
            }

            $data['redirect'] = '/admin/setting/themes';

            $this->layout->view_admin_only_contents('alert_view', $data);
        }
    }

    // --------------------------------------------------------------------

    /*
     * 미리보기를 위한 쿠키 설정
     *
     * @author 배강민
     */
    public function set_cookie_theme_preview()
    {
        $idx = $this->input->get('idx');
        if( ! $idx) $idx = 0;
        $type = $this->input->get('type');
        if( ! in_array($type, array('M', 'P'))) $type = 'M';

        $this->load->model('themes_model');
        $result = $this->themes_model->get_theme($type, $idx);

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR count($result) !== 1 )
        {
            echo 'FALSE';
        }
        else
        {
            $cookie_list = array(
                array(
                    'name' => 'theme_type',
                    'value' => $result->type,
                    'expire' => 0,
                    'path' => '/'
                ),
                array(
                    'name' => 'theme_title',
                    'value' => $result->title,
                    'expire' => 0,
                    'path' => '/'
                ),
                array(
                    'name' => 'theme_folder_name',
                    'value' => $result->folder_name,
                    'expire' => 0,
                    'path' => '/'
                )
            );

            foreach ($cookie_list as $cookie) {
                $this->input->set_cookie($cookie);
            }

            echo 'TRUE';
        }
    }
}

//EOF
