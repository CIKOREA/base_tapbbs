<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ip extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

    /**
     * 접근내역
	 *
     * @author KangMin
     * @since 2011.11.23
     */
	public function index()
	{
		$data = NULL;

		$req_page = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
		{
    		delete_session();
			$this->layout->view_admin('login_view');
		}
		else
		{
            $this->load->model('client_ip_access_model');
			$this->load->library('pagination');

			$data['total_cnt'] = $this->client_ip_access_model->get_client_ip_access_total_cnt();

			// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
			$config['base_url'] = BASE_URL.'admin/ip?';
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
				$data['access'] = $this->client_ip_access_model->get_client_ip_access(($req_page-1)*$config['per_page'], $config['per_page']);
			}

			$this->layout->view_admin('ip/access_view', $data);
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 차단내역 표출 및 차단실행
	 *
     * @author KangMin
     * @since 2011.11.23
     */
	public function block()
	{
		$data = NULL;
		$post_success = FALSE;

		$req_page = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

		if( ! defined('USER_INFO_idx')
			OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
		{
    		delete_session();
			$this->layout->view_admin('login_view');
		}
		else
		{
			$this->load->model('client_ip_block_model');

			//rules
			$this->form_validation->set_rules('client_ip', lang('client_ip'), 'trim|required|xss_clean|max_length[64]|valid_ip');

			//폼검증 성공이면
			if ($this->form_validation->run() == TRUE)
			{
				//중복체크
				$check = $this->client_ip_block_model->check_client_ip_block($this->form_validation->set_value('client_ip'));

				if($check == TRUE) //있으면
				{
					$data['result_msg'] = lang('client_ip_duplicate');
				}
				else
				{
					$result = $this->client_ip_block_model->set_client_ip_block($this->form_validation->set_value('client_ip'));

					if($result == TRUE)
					{
						$post_success = TRUE;

						$data['message'] = lang('insert_success');
						$data['redirect'] = '/admin/ip/block';

						$this->layout->view_admin_only_contents('alert_view', $data);
					}
					else
					{
						$data['result_msg'] = lang('client_ip_block_insert_fail_msg');

					}
				}
			}

			if($post_success == FALSE)
			{
				$this->load->library('pagination');

				$data['total_cnt'] = $this->client_ip_block_model->get_client_ip_block_total_cnt();

				// http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
				$config['base_url'] = BASE_URL.'admin/ip/block?';
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
					$data['block'] = $this->client_ip_block_model->get_client_ip_block(($req_page-1)*$config['per_page'], $config['per_page']);
				}

				$this->layout->view_admin('ip/block_view', $data);
			}
		}//로그인,권한 체크 end if
	}

	// --------------------------------------------------------------------

    /**
     * 차단 삭제
     * @author KangMin
     * @since 2011.11.23
     */
	public function del_block()
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
			//rules
			$this->form_validation->set_rules('idx', 'INDEX', 'trim|required|xss_clean|is_natural_no_zero');

			//폼검증 성공이면
			if ($this->form_validation->run() == TRUE)
			{
				$this->load->model('client_ip_block_model');

				$this->client_ip_block_model->del_client_ip_block($this->form_validation->set_value('idx'));

				$data['message'] = lang('delete_success');
				$data['redirect'] = '/admin/ip/block';
			}

            $this->layout->view_admin_only_contents('alert_view', $data);
		}//로그인,권한 체크 end if
	}
}

//EOF