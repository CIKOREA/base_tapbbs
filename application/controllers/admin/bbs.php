<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bbs extends MY_Controller
{
    private $upload_path = 'uploads/'; //파일업로드 경로

    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * 기본설정 (게시판)
     *
     * @author KangMin
     * @since 2011.11.20
     */
    public function index()
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
            //rules
            $this->form_validation->set_rules('bbs_allow_group_view_article[]', lang('bbs_allow_group_view_article'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_view_comment[]', lang('bbs_allow_group_view_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_view_list[]', lang('bbs_allow_group_view_list'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_write_article[]', lang('bbs_allow_group_write_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_allow_group_upload[]', lang('bbs_allow_group_upload'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_allow_group_download[]', lang('bbs_allow_group_download'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_write_comment[]', lang('bbs_allow_group_write_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_block_string', lang('bbs_block_string'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_block_string_used', lang('bbs_block_string_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_comment_used', lang('bbs_comment_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_count_list_article', lang('bbs_count_list_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_list_article_pc', lang('bbs_count_list_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_list_comment', lang('bbs_count_list_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_list_comment_pc', lang('bbs_count_list_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_article', lang('bbs_count_page_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_article_pc', lang('bbs_count_page_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_comment', lang('bbs_count_page_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_comment_pc', lang('bbs_count_page_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_hit_article_title_color_count', lang('bbs_hit_article_title_color_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_hit_article_title_color_used', lang('bbs_hit_article_title_color_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hit_article_title_color_used_pc', lang('bbs_hit_article_title_color_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hit_article_title_color_value', lang('bbs_hit_article_title_color_value'), 'trim|required|xss_clean|max_length[1000]|exact_length[7]');
            $this->form_validation->set_rules('bbs_hit_article_title_color_value_pc', lang('bbs_hit_article_title_color_value'), 'trim|required|xss_clean|max_length[1000]|exact_length[7]');
            $this->form_validation->set_rules('bbs_hour_new_icon_path_article', lang('bbs_hour_new_icon_path_article'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_hour_new_icon_path_comment', lang('bbs_hour_new_icon_path_comment'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_hour_new_icon_used_article', lang('bbs_hour_new_icon_used_article'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hour_new_icon_used_comment', lang('bbs_hour_new_icon_used_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hour_new_icon_value_article', lang('bbs_hour_new_icon_value_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_hour_new_icon_value_comment', lang('bbs_hour_new_icon_value_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_length_minimum_contents', lang('bbs_length_minimum_contents'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_length_minimum_article_title', lang('bbs_length_minimum_article_title'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_length_minimum_comment', lang('bbs_length_minimum_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_limit_insert_delay_type', lang('bbs_limit_insert_delay_type'), 'trim|required|xss_clean|max_length[1000]|exact_length[1]|alpha');
            $this->form_validation->set_rules('bbs_limit_insert_delay_used', lang('bbs_limit_insert_delay_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_limit_insert_delay_value', lang('bbs_limit_insert_delay_value'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_article', lang('bbs_point_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_article_used', lang('bbs_point_article_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_point_comment', lang('bbs_point_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_comment_used', lang('bbs_point_comment_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_point_vote_receiver', lang('bbs_point_vote_receiver'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_vote_receiver_used', lang('bbs_point_vote_receiver_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_point_vote_sender', lang('bbs_point_vote_sender'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_vote_sender_used', lang('bbs_point_vote_sender_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_rss_used', lang('bbs_rss_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_rss_used_pc', lang('bbs_rss_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_tags_limit_count', lang('bbs_tags_limit_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_tags_used', lang('bbs_tags_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_textarea_contents', lang('bbs_textarea_contents'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_textarea_contents_pc', lang('bbs_textarea_contents'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_textarea_comment', lang('bbs_textarea_comment'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_textarea_comment_pc', lang('bbs_textarea_comment'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_upload_allow_extension', lang('bbs_upload_allow_extension'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_upload_image_quality', lang('bbs_upload_image_quality'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_upload_limit_capacity', lang('bbs_upload_limit_capacity'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_upload_limit_count', lang('bbs_upload_limit_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            //$this->form_validation->set_rules('bbs_upload_limit_image_size_height', lang('bbs_upload_limit_image_size_height'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_upload_limit_image_size_width', lang('bbs_upload_limit_image_size_width'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_upload_used', lang('bbs_upload_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_urls_limit_count', lang('bbs_urls_limit_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_urls_used', lang('bbs_urls_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_vote_article_used', lang('bbs_vote_article_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_vote_comment_used', lang('bbs_vote_comment_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_category_used', lang('bbs_category_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_comment_sort', lang('bbs_comment_sort'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]|alpha');
            $this->form_validation->set_rules('bbs_recently_count', lang('bbs_recently_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_recently_count_pc', lang('bbs_recently_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');

            //v0.1.7
            $this->form_validation->set_rules('bbs_cut_length_recently', lang('bbs_cut_length_recently'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_cut_length_recently_pc', lang('bbs_cut_length_recently'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_cut_length_title', lang('bbs_cut_length_title'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_cut_length_title_pc', lang('bbs_cut_length_title'), 'trim|required|xss_clean|max_length[1000]|is_natural');

            $this->form_validation->set_rules('bbs_thumbnail_width', lang('bbs_thumbnail_width'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_thumbnail_quality', lang('bbs_thumbnail_quality'), 'trim|required|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_etc1', lang('bbs_etc1'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_etc2', lang('bbs_etc2'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');

            $this->form_validation->set_rules('bbs_lists_style', lang('bbs_lists_style'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_lists_style_pc', lang('bbs_lists_style'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');

            //게시판 적용 범위
            $this->form_validation->set_rules('bbs_limit', lang('bbs_limit'), 'trim|required|htmlspecialchars|xss_clean|alpha_dash');

            if($this->input->post('bbs_limit') == 'checked_bbs')
            {
                $this->load->model('bbs_setting_model');

                $this->form_validation->set_rules('include_bbs[]', lang('include_bbs'), 'trim|required|xss_clean|is_natural_no_zero');
                $this->form_validation->set_rules('bbs_setting_update_base', lang('bbs_setting_update_base'), 'trim|required|htmlspecialchars|xss_clean|alpha_dash');
            }

            $this->load->model('users_group_model');

            //폼검증 성공이면
            if ($this->form_validation->run() == true)
            {
                $setting = $this->setting_model->get_setting(' AND default_bbs = 1 ');

                //serialize
                $req_bbs_allow_group_view_article = serialize($this->input->post('bbs_allow_group_view_article'));
                $req_bbs_allow_group_view_comment = serialize($this->input->post('bbs_allow_group_view_comment'));
                $req_bbs_allow_group_view_list = serialize($this->input->post('bbs_allow_group_view_list'));
                $req_bbs_allow_group_write_article = serialize($this->input->post('bbs_allow_group_write_article'));
                $req_bbs_allow_group_write_comment = serialize($this->input->post('bbs_allow_group_write_comment'));
                $req_bbs_allow_group_upload = serialize($this->input->post('bbs_allow_group_upload'));
                $req_bbs_allow_group_download = serialize($this->input->post('bbs_allow_group_download'));
                $req_bbs_block_string = serialize(explode(',', $this->form_validation->set_value('bbs_block_string')));
                $req_bbs_upload_allow_extension = serialize(explode(',', $this->form_validation->set_value('bbs_upload_allow_extension')));

                //serialize 한 후의 length 1000 을 검사해야한다.
                //mysql은 제한보다 길어도 자르고 넣어버려서...
                //거의 없을듯하지만...
                if(strlen($req_bbs_allow_group_view_article) > 1000
                    OR strlen($req_bbs_allow_group_view_comment) > 1000
                    OR strlen($req_bbs_allow_group_view_list) > 1000
                    OR strlen($req_bbs_allow_group_write_article) > 1000
                    OR strlen($req_bbs_allow_group_write_comment) > 1000
                    OR strlen($req_bbs_allow_group_upload) > 1000
                    OR strlen($req_bbs_allow_group_download) > 1000
                    OR strlen($req_bbs_block_string) > 1000
                    OR strlen($req_bbs_upload_allow_extension) > 1000)
                {
                    $data['message'] = lang('size_over_after_serialize');
                    $data['redirect'] = '/admin/bbs';

                    $this->layout->view_admin_only_contents('alert_view', $data);
                    exit();
                }

                $serialize_param = array('bbs_allow_group_view_article'
                                         , 'bbs_allow_group_view_comment'
                                         , 'bbs_allow_group_view_list'
                                         , 'bbs_allow_group_write_article'
                                         , 'bbs_allow_group_write_comment'
                                         , 'bbs_allow_group_upload'
                                         , 'bbs_allow_group_download'
                                         , 'bbs_block_string'
                                         , 'bbs_upload_allow_extension'
                );

                $req_bbs_setting_update_base = $this->form_validation->set_value('bbs_setting_update_base');

                //회원그룹 유효성 확인
                $check_bbs_allow_group_view_article = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_view_article')).')');
                $check_bbs_allow_group_view_comment = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_view_comment')).')');
                $check_bbs_allow_group_view_list = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_view_list')).')');
                $check_bbs_allow_group_write_article = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_write_article')).')');
                $check_bbs_allow_group_write_comment = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_write_comment')).')');
                $check_bbs_allow_group_upload = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_upload')).')');
                $check_bbs_allow_group_download = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_download')).')');

                //비교용 (비회원도 있는 뷰 3개)
                $bbs_allow_group_view_article_diff = count($this->input->post('bbs_allow_group_view_article'));
                $bbs_allow_group_view_comment_diff = count($this->input->post('bbs_allow_group_view_comment'));
                $bbs_allow_group_view_list_diff = count($this->input->post('bbs_allow_group_view_list'));
                $bbs_allow_group_download_diff = count($this->input->post('bbs_allow_group_download'));

                if(in_array(0, $this->input->post('bbs_allow_group_view_article')) == true)
                {
                    $bbs_allow_group_view_article_diff = $bbs_allow_group_view_article_diff - 1;
                }
                if(in_array(0, $this->input->post('bbs_allow_group_view_comment')) == true)
                {
                    $bbs_allow_group_view_comment_diff = $bbs_allow_group_view_comment_diff - 1;
                }
                if(in_array(0, $this->input->post('bbs_allow_group_view_list')) == true)
                {
                    $bbs_allow_group_view_list_diff = $bbs_allow_group_view_list_diff - 1;
                }
                if(in_array(0, $this->input->post('bbs_allow_group_download')) == true)
                {
                    $bbs_allow_group_download_diff = $bbs_allow_group_download_diff - 1;
                }

                //삭제한 그룹이면
                if( count($check_bbs_allow_group_view_article) !== $bbs_allow_group_view_article_diff
                    OR count($check_bbs_allow_group_view_comment) !== $bbs_allow_group_view_comment_diff
                    OR count($check_bbs_allow_group_view_list) !== $bbs_allow_group_view_list_diff
                    OR count($check_bbs_allow_group_write_article) !== count($this->input->post('bbs_allow_group_write_article'))
                    OR count($check_bbs_allow_group_write_comment) !== count($this->input->post('bbs_allow_group_write_comment'))
                    OR count($check_bbs_allow_group_upload) !== count($this->input->post('bbs_allow_group_upload'))
                    OR count($check_bbs_allow_group_download) !== $bbs_allow_group_download_diff
                )
                {
                    $post_success = true;

                    $data['message'] = lang('none_group_idx');
                }
                else
                {

                    $this->db->trans_start();

                    foreach($setting as $k => $v)
                    {
                        //serialize 파라메터면
                        if( in_array($v->parameter, $serialize_param) )
                        {
                            $result = $this->setting_model->update($v->parameter, ${'req_'.$v->parameter});

                            //지금 수정한 설정만이고 수정되었거나 전체일때
                            if( $req_bbs_setting_update_base == 'all' OR ($req_bbs_setting_update_base == 'affected' && $result == true) )
                            {
                                //선택한 게시판도 같이 변경
                                if($this->form_validation->set_value('bbs_limit') == 'checked_bbs')
                                {
                                    foreach($this->input->post('include_bbs') as $k2=>$v2)
                                    {
                                        $this->bbs_setting_model->update($v->parameter, ${'req_'.$v->parameter}, $v2);
                                    }
                                }
                            }
                        }
                        else
                        {
                            $result = $this->setting_model->update($v->parameter, $this->form_validation->set_value($v->parameter));

                            //지금 수정한 설정만이고 수정되었거나 전체일때
                            if( $req_bbs_setting_update_base == 'all' OR ($req_bbs_setting_update_base == 'affected' && $result == true) )
                            {
                                //선택한 게시판도 같이 변경
                                if($this->form_validation->set_value('bbs_limit') == 'checked_bbs')
                                {
                                    foreach($this->input->post('include_bbs') as $k2=>$v2)
                                    {
                                        $this->bbs_setting_model->update($v->parameter, $this->form_validation->set_value($v->parameter), $v2);
                                    }
                                }
                            }
                        }
                    }

                    $this->db->trans_complete();

                    $this->load->driver('cache');

                    //캐쉬 삭제
                    if($this->cache->file->get('setting')) $this->cache->file->delete('setting');

                    //선택한 게시판 캐쉬 삭제
                    if($this->input->post('bbs_limit') == 'checked_bbs' && count($this->input->post('include_bbs')) > 0)
                    {
                        foreach($this->input->post('include_bbs') as $k=>$v)
                        {
                            if($this->cache->file->get('bbs_setting_'.$v)) $this->cache->file->delete('bbs_setting_'.$v);
                            if($this->cache->file->get('recently_'.$v.'_mobile')) $this->cache->file->delete('recently_'.$v.'_mobile');
                            if($this->cache->file->get('recently_'.$v.'_pc')) $this->cache->file->delete('recently_'.$v.'_pc');
                        }
                    }

                    $post_success = true;

                    $data['message'] = lang('update_success');
                }

                $data['redirect'] = '/admin/bbs';

                $this->layout->view_admin_only_contents('alert_view', $data);
            }

            if($post_success == false)
            {
                $setting = $this->setting_model->get_setting(' AND default_bbs = 1 ');

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
                $data['users_group'] = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 ');

                //게시판기본
                $this->load->model('bbs_setting_model');
                $data['bbs_setting'] = $this->bbs_setting_model->get_bbs_setting();

                $this->layout->view_admin('bbs/index_view', $data);
            }
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 게시판관리
     * @author KangMin
     * @since 2011.11.25
     */
    public function setting()
    {
        $data = NULL;
        $post_success = FALSE;

        $mode = $this->input->post('mode');

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            $this->load->model('bbs_setting_model');

            if($mode == 'insert')
            {
                //rules
                $this->form_validation->set_rules('bbs_name', lang('bbs_name'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
                $this->form_validation->set_rules('bbs_id', 'ID', 'trim|required|htmlspecialchars|xss_clean|max_length[1000]|alpha_dash');
            }
            else
            {
                $this->form_validation->set_rules('recently_used[]', lang('recently_used'), 'required');
                $this->form_validation->set_rules('category_used[]', lang('category_used'), 'required');
            }

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                if($mode == 'insert')
                {
                    $req_bbs_name = $this->form_validation->set_value('bbs_name');
                    $req_bbs_id = $this->form_validation->set_value('bbs_id');

                    $data['result_msg'] = NULL;
                    $bbs_setting_fail_msg = array();

                    //bbs_name 중복체크
                    $check_bbs_name = $this->bbs_setting_model->check_bbs_name($req_bbs_name);

                    if($check_bbs_name == TRUE)
                    {
                        $bbs_setting_fail_msg[] = lang('bbs_name_duplicate');
                    }

                    //bbs_id 중복체크
                    $check_bbs_id = $this->bbs_setting_model->check_bbs_id($req_bbs_id);

                    if($check_bbs_id == TRUE)
                    {
                        $bbs_setting_fail_msg[] = lang('bbs_id_duplicate');
                    }

                    if( count($bbs_setting_fail_msg) > 0 )
                    {
                        //bbs_name, bbs_id 중복이면
                        $data['result_msg'] = join('<br />', $bbs_setting_fail_msg);
                    }
                    else
                    {
                        $this->db->trans_start();

                        $result = $this->bbs_setting_model->set_bbs($req_bbs_id);

                        //게시판 추가
                        if($result == TRUE)
                        {
                            $result = $this->bbs_setting_model->set_bbs_setting($req_bbs_name);
                            $result_detail = $this->bbs_setting_model->set_bbs_setting_detail($req_bbs_id);

                            $this->db->trans_complete();

                            if($result == TRUE && $result_detail == TRUE)
                            {
                                $post_success = TRUE;

                                $data['message'] = lang('insert_success');
                                $data['redirect'] = '/admin/bbs/setting';

                                $this->layout->view_admin_only_contents('alert_view', $data);
                            }
                            else
                            {
                                $data['result_msg'] = lang('bbs_setting_fail_msg');
                            }
                        }
                        else
                        {
                            $this->db->trans_complete();

                            $data['result_msg'] = lang('bbs_setting_fail_msg');
                        }
                    }
                }
                else //modify
                {
                    $recently_used = $this->input->post('recently_used');
                    $category_used = $this->input->post('category_used');

                    //recently
                    $temp = array();
                    foreach($recently_used as $k => $v)
                    {
                        if($v == 1) $temp[] = $k;
                    }
                    $recently_used = serialize($temp);

                    $this->setting_model->update('bbs_recently_used', $recently_used);

                    $this->load->driver('cache');

                    //캐쉬삭제
                    $this->cache->file->delete('setting');

                    //category
                    $this->db->trans_start();

                    foreach($category_used as $k => $v)
                    {
                        $this->bbs_setting_model->update('bbs_category_used', $v, $k);

                        //캐쉬삭제
                        if($this->cache->file->get('bbs_setting_'.$k)) $this->cache->file->delete('bbs_setting_'.$k);
                    }

                    $this->db->trans_complete();

                    $post_success = TRUE;

                    $data['message'] = lang('update_success');
                    $data['redirect'] = '/admin/bbs/setting';

                    $this->layout->view_admin_only_contents('alert_view', $data);
                }
            }

            if($post_success == FALSE)
            {
                //게시판 기본
                $data['bbs_setting'] = $this->bbs_setting_model->get_bbs_setting();

                $this->layout->view_admin('bbs/setting_view', $data);
            }
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 게시판 관리 상세 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
    public function setting_detail()
    {
        $data = NULL;
        $post_success = FALSE;

        $req_bbs_idx = ((int)$this->input->get_post('bbs_idx') > 0) ? (int)$this->input->get_post('bbs_idx') : NULL;

        //bbs_idx check
        $this->load->model('bbs_model');

        $check_bbs_idx = $this->bbs_model->check_bbs_idx($req_bbs_idx);

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR $req_bbs_idx == NULL
            OR $check_bbs_idx !== TRUE )
        {
            delete_session();
            show_error(lang('unusual_approach'));
        }
        else
        {
            //rules
            $this->form_validation->set_rules('bbs_name', lang('bbs_name'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_used', lang('bbs_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');

            $this->form_validation->set_rules('bbs_allow_group_view_article[]', lang('bbs_allow_group_view_article'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_view_comment[]', lang('bbs_allow_group_view_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_view_list[]', lang('bbs_allow_group_view_list'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_allow_group_write_article[]', lang('bbs_allow_group_write_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_allow_group_write_comment[]', lang('bbs_allow_group_write_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_allow_group_upload[]', lang('bbs_allow_group_upload'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_allow_group_download[]', lang('bbs_allow_group_download'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_block_string', lang('bbs_block_string'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_block_string_used', lang('bbs_block_string_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_comment_used', lang('bbs_comment_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_count_list_article', lang('bbs_count_list_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_list_article_pc', lang('bbs_count_list_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_list_comment', lang('bbs_count_list_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_list_comment_pc', lang('bbs_count_list_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_article', lang('bbs_count_page_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_article_pc', lang('bbs_count_page_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_comment', lang('bbs_count_page_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_count_page_comment_pc', lang('bbs_count_page_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_hit_article_title_color_count', lang('bbs_hit_article_title_color_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_hit_article_title_color_used', lang('bbs_hit_article_title_color_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hit_article_title_color_used_pc', lang('bbs_hit_article_title_color_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hit_article_title_color_value', lang('bbs_hit_article_title_color_value'), 'trim|required|xss_clean|max_length[1000]|exact_length[7]');
            $this->form_validation->set_rules('bbs_hit_article_title_color_value_pc', lang('bbs_hit_article_title_color_value'), 'trim|required|xss_clean|max_length[1000]|exact_length[7]');
            $this->form_validation->set_rules('bbs_hour_new_icon_path_article', lang('bbs_hour_new_icon_path_article'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_hour_new_icon_path_comment', lang('bbs_hour_new_icon_path_comment'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_hour_new_icon_used_article', lang('bbs_hour_new_icon_used_article'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hour_new_icon_used_comment', lang('bbs_hour_new_icon_used_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_hour_new_icon_value_article', lang('bbs_hour_new_icon_value_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_hour_new_icon_value_comment', lang('bbs_hour_new_icon_value_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_length_minimum_contents', lang('bbs_length_minimum_contents'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_length_minimum_article_title', lang('bbs_length_minimum_article_title'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_length_minimum_comment', lang('bbs_length_minimum_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_limit_insert_delay_type', lang('bbs_limit_insert_delay_type'), 'trim|required|xss_clean|max_length[1000]|exact_length[1]|alpha');
            $this->form_validation->set_rules('bbs_limit_insert_delay_used', lang('bbs_limit_insert_delay_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_limit_insert_delay_value', lang('bbs_limit_insert_delay_value'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_article', lang('bbs_point_article'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_article_used', lang('bbs_point_article_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_point_comment', lang('bbs_point_comment'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_comment_used', lang('bbs_point_comment_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_point_vote_receiver', lang('bbs_point_vote_receiver'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_vote_receiver_used', lang('bbs_point_vote_receiver_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_point_vote_sender', lang('bbs_point_vote_sender'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_point_vote_sender_used', lang('bbs_point_vote_sender_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_rss_used', lang('bbs_rss_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_rss_used_pc', lang('bbs_rss_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_tags_limit_count', lang('bbs_tags_limit_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_tags_used', lang('bbs_tags_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_textarea_contents', lang('bbs_textarea_contents'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_textarea_contents_pc', lang('bbs_textarea_contents'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_textarea_comment', lang('bbs_textarea_comment'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_textarea_comment_pc', lang('bbs_textarea_comment'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_upload_allow_extension', lang('bbs_upload_allow_extension'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_upload_image_quality', lang('bbs_upload_image_quality'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_upload_limit_capacity', lang('bbs_upload_limit_capacity'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_upload_limit_count', lang('bbs_upload_limit_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            //$this->form_validation->set_rules('bbs_upload_limit_image_size_height', lang('bbs_upload_limit_image_size_height'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_upload_limit_image_size_width', lang('bbs_upload_limit_image_size_width'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_upload_used', lang('bbs_upload_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_urls_limit_count', lang('bbs_urls_limit_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_urls_used', lang('bbs_urls_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_vote_article_used', lang('bbs_vote_article_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_vote_comment_used', lang('bbs_vote_comment_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_category_used', lang('bbs_category_used'), 'trim|required|xss_clean|max_length[1000]|is_natural|less_than[2]');
            $this->form_validation->set_rules('bbs_comment_sort', lang('bbs_comment_sort'), 'trim|required|htmlspecialchars|xss_clean|max_length[1000]|alpha');
            $this->form_validation->set_rules('bbs_recently_count', lang('bbs_recently_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_recently_count_pc', lang('bbs_recently_count'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');

            //v0.1.7
            $this->form_validation->set_rules('bbs_cut_length_recently', lang('bbs_cut_length_recently'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_cut_length_recently_pc', lang('bbs_cut_length_recently'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_cut_length_title', lang('bbs_cut_length_title'), 'trim|required|xss_clean|max_length[1000]|is_natural');
            $this->form_validation->set_rules('bbs_cut_length_title_pc', lang('bbs_cut_length_title'), 'trim|required|xss_clean|max_length[1000]|is_natural');

            $this->form_validation->set_rules('bbs_thumbnail_width', lang('bbs_thumbnail_width'), 'trim|required|xss_clean|max_length[1000]|is_natural_no_zero');
            $this->form_validation->set_rules('bbs_thumbnail_quality', lang('bbs_thumbnail_quality'), 'trim|required|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_etc1', lang('bbs_etc1'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_etc2', lang('bbs_etc2'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');

            $this->form_validation->set_rules('bbs_lists_style', lang('bbs_lists_style'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');
            $this->form_validation->set_rules('bbs_lists_style_pc', lang('bbs_lists_style'), 'trim|htmlspecialchars|xss_clean|max_length[1000]');

            $this->load->model('bbs_setting_model');
            $this->load->model('users_group_model');

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                $bbs_setting = $this->bbs_setting_model->get_bbs_setting_detail($req_bbs_idx);

                //serialize
                $req_bbs_allow_group_view_article = serialize($this->input->post('bbs_allow_group_view_article'));
                $req_bbs_allow_group_view_comment = serialize($this->input->post('bbs_allow_group_view_comment'));
                $req_bbs_allow_group_view_list = serialize($this->input->post('bbs_allow_group_view_list'));
                $req_bbs_allow_group_write_article = serialize($this->input->post('bbs_allow_group_write_article'));
                $req_bbs_allow_group_write_comment = serialize($this->input->post('bbs_allow_group_write_comment'));
                $req_bbs_allow_group_upload = serialize($this->input->post('bbs_allow_group_upload'));
                $req_bbs_allow_group_download = serialize($this->input->post('bbs_allow_group_download'));
                $req_bbs_block_string = serialize(explode(',', $this->form_validation->set_value('bbs_block_string')));
                $req_bbs_upload_allow_extension = serialize(explode(',', $this->form_validation->set_value('bbs_upload_allow_extension')));

                //serialize 한 후의 length 1000 을 검사해야한다.
                //mysql은 제한보다 길어도 자르고 넣어버려서...
                //거의 없을듯하지만...
                if(strlen($req_bbs_allow_group_view_article) > 1000
                    OR strlen($req_bbs_allow_group_view_comment) > 1000
                    OR strlen($req_bbs_allow_group_view_list) > 1000
                    OR strlen($req_bbs_allow_group_write_article) > 1000
                    OR strlen($req_bbs_allow_group_write_comment) > 1000
                    OR strlen($req_bbs_allow_group_upload) > 1000
                    OR strlen($req_bbs_allow_group_download) > 1000
                    OR strlen($req_bbs_block_string) > 1000
                    OR strlen($req_bbs_upload_allow_extension) > 1000)
                {
                    $data['message'] = lang('size_over_after_serialize');
                    $data['redirect'] = '/admin/bbs/setting_detail?bbs_idx='.$req_bbs_idx;

                    $this->layout->view_admin_only_contents('alert_view', $data);
                    exit();
                }

                $serialize_param = array('bbs_allow_group_view_article'
                , 'bbs_allow_group_view_comment'
                , 'bbs_allow_group_view_list'
                , 'bbs_allow_group_write_article'
                , 'bbs_allow_group_write_comment'
                , 'bbs_allow_group_upload'
                , 'bbs_allow_group_download'
                , 'bbs_block_string'
                , 'bbs_upload_allow_extension'
                );

                //회원그룹 유효성 확인
                $check_bbs_allow_group_view_article = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_view_article')).')');
                $check_bbs_allow_group_view_comment = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_view_comment')).')');
                $check_bbs_allow_group_view_list = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_view_list')).')');
                $check_bbs_allow_group_write_article = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_write_article')).')');
                $check_bbs_allow_group_write_comment = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_write_comment')).')');
                $check_bbs_allow_group_upload = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_upload')).')');
                $check_bbs_allow_group_download = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 AND USERS_GROUP.idx IN ('.join(',', $this->input->post('bbs_allow_group_download')).')');

                //비교용 (비회원도 있는 뷰 3개)
                $bbs_allow_group_view_article_diff = count($this->input->post('bbs_allow_group_view_article'));
                $bbs_allow_group_view_comment_diff = count($this->input->post('bbs_allow_group_view_comment'));
                $bbs_allow_group_view_list_diff = count($this->input->post('bbs_allow_group_view_list'));
                $bbs_allow_group_download_diff = count($this->input->post('bbs_allow_group_download'));

                if(in_array(0, $this->input->post('bbs_allow_group_view_article')) == TRUE)
                {
                    $bbs_allow_group_view_article_diff = $bbs_allow_group_view_article_diff - 1;
                }
                if(in_array(0, $this->input->post('bbs_allow_group_view_comment')) == TRUE)
                {
                    $bbs_allow_group_view_comment_diff = $bbs_allow_group_view_comment_diff - 1;
                }
                if(in_array(0, $this->input->post('bbs_allow_group_view_list')) == TRUE)
                {
                    $bbs_allow_group_view_list_diff = $bbs_allow_group_view_list_diff - 1;
                }
                if(in_array(0, $this->input->post('bbs_allow_group_download')) == true)
                {
                    $bbs_allow_group_download_diff = $bbs_allow_group_download_diff - 1;
                }

                //삭제한 그룹이면
                if( count($check_bbs_allow_group_view_article) !== $bbs_allow_group_view_article_diff
                    OR count($check_bbs_allow_group_view_comment) !== $bbs_allow_group_view_comment_diff
                    OR count($check_bbs_allow_group_view_list) !== $bbs_allow_group_view_list_diff
                    OR count($check_bbs_allow_group_write_article) !== count($this->input->post('bbs_allow_group_write_article'))
                    OR count($check_bbs_allow_group_write_comment) !== count($this->input->post('bbs_allow_group_write_comment'))
                    OR count($check_bbs_allow_group_upload) !== count($this->input->post('bbs_allow_group_upload'))
                    OR count($check_bbs_allow_group_download) !== $bbs_allow_group_download_diff
                )
                {
                    $post_success = TRUE;

                    $data['message'] = lang('none_group_idx');
                }
                else
                {

                    $this->db->trans_start();

                    foreach($bbs_setting as $k => $v)
                    {
                        //serialize 파라메터면
                        if( in_array($v->parameter, $serialize_param) )
                        {
                            $this->bbs_setting_model->update($v->parameter, ${'req_'.$v->parameter}, $req_bbs_idx);
                        }
                        else
                        {
                            $this->bbs_setting_model->update($v->parameter, $this->form_validation->set_value($v->parameter), $req_bbs_idx);
                        }
                    }

                    $this->db->trans_complete();

                    $this->load->driver('cache');

                    //캐쉬 삭제
                    if($this->cache->file->get('bbs_setting_'.$req_bbs_idx)) $this->cache->file->delete('bbs_setting_'.$req_bbs_idx);
                    if($this->cache->file->get('recently_'.$req_bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$req_bbs_idx.'_mobile');
                    if($this->cache->file->get('recently_'.$req_bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$req_bbs_idx.'_pc');

                    $post_success = TRUE;

                    $data['message'] = lang('update_success');
                }

                //$data['redirect'] = '/admin/bbs/setting_detail?bbs_idx='.$req_bbs_idx;
                $data['callback_force'] = 'opener.document.location.reload(); location.href=\'' . BASE_URL . 'admin/bbs/setting_detail?bbs_idx='.$req_bbs_idx.'\';';

                $this->layout->view_admin_only_contents('alert_view', $data);
            }

            if($post_success == FALSE)
            {
                $bbs_setting = $this->bbs_setting_model->get_bbs_setting_detail($req_bbs_idx);

                //bbs_setting 배열 정리
                $bbs_setting_temp = array();

                foreach($bbs_setting as $k => $v)
                {
                    $bbs_setting_temp[$v->parameter]['idx'] = $v->idx;
                    $bbs_setting_temp[$v->parameter]['parameter'] = $v->parameter;
                    $bbs_setting_temp[$v->parameter]['value'] = $v->value;
                    $bbs_setting_temp[$v->parameter]['name'] = name($v->user_id, $v->name, $v->nickname);
                    $bbs_setting_temp[$v->parameter]['client_ip'] = $v->client_ip;
                }

                $data['bbs_setting'] = $bbs_setting_temp;

                $data['req_bbs_idx'] = $req_bbs_idx;

                //회원그룹
                $data['users_group'] = $this->users_group_model->get_users_group(' AND USERS_GROUP.is_used = 1 ');

                $this->layout->view_admin_only_contents('bbs/setting_detail_view', $data);
            }
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 설정 변경 내역 (팝업)
     * @author KangMin
     * @since 2011.11.23
     */
    public function setting_revision()
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
            $this->load->model('bbs_setting_revision_model');
            $this->load->library('pagination');

            $data['total_cnt'] = $this->bbs_setting_revision_model->get_revision_total_cnt($req_idx);

            // http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
            $config['base_url'] = BASE_URL.'admin/bbs/setting_revision?idx='.$req_idx;
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
                $data['revision'] = $this->bbs_setting_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
            }

            $this->layout->view_admin_only_contents('setting/revision_view', $data); //공통 세팅꺼 같이 사용
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 카테고리관리 (순서변경) (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
    public function category()
    {
        $data = NULL;
        $post_success = FALSE;

        $req_bbs_idx = $data['req_bbs_idx'] = ((int)$this->input->get_post('bbs_idx') > 0) ? (int)$this->input->get_post('bbs_idx') : NULL;

        //bbs_idx check
        $this->load->model('bbs_model');

        $check_bbs_idx = $this->bbs_model->check_bbs_idx($req_bbs_idx);

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR $req_bbs_idx == NULL
            OR $check_bbs_idx !== TRUE )
        {
            delete_session();
            show_error(lang('unusual_approach'));
        }
        else
        {
            $this->load->model('bbs_category_model');

            //rules
            $this->form_validation->set_rules('order', lang('order'), 'trim|required|htmlspecialchars|xss_clean');

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                $order = $this->form_validation->set_value('order');

                $order_split = explode('|', $order);

                $this->db->trans_start();

                //순서변경
                foreach($order_split as $k=>$v)
                {
                    $order_split_split = explode('_', $v);

                    $this->bbs_category_model->update_order($order_split_split[0], $order_split_split[1]);
                }

                $this->db->trans_complete();

                $post_success = TRUE;
                $data['message'] = lang('update_success');
                $data['redirect'] = '/admin/bbs/category?bbs_idx='.$req_bbs_idx;

                $this->layout->view_admin_only_contents('alert_view', $data);
            }

            if($post_success == FALSE)
            {
                $data['categorys'] = $this->bbs_category_model->get_categorys($req_bbs_idx);

                $this->layout->view_admin_only_contents('bbs/category_view', $data);
            }

        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 카테고리관리 추가 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
    public function category_insert()
    {
        $data = NULL;
        $post_success = FALSE;

        $req_bbs_idx = ((int)$this->input->get_post('bbs_idx') > 0) ? (int)$this->input->get_post('bbs_idx') : NULL;

        //bbs_idx check
        $this->load->model('bbs_model');

        $check_bbs_idx = $this->bbs_model->check_bbs_idx($req_bbs_idx);

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR $req_bbs_idx == NULL
            OR $check_bbs_idx !== TRUE )
        {
            delete_session();
            show_error(lang('unusual_approach'));
        }
        else
        {
            //rules
            $this->form_validation->set_rules('category_name', lang('category_name'), 'trim|required|htmlspecialchars|xss_clean|max_length[64]');

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                $this->load->model('bbs_category_model');

                //중복체크
                $check = $this->bbs_category_model->check_category_name($req_bbs_idx, $this->form_validation->set_value('category_name'));

                if($check == TRUE) //true면 있는거니 중복
                {
                    $data['result_msg'] = lang('category_name_duplicate');
                }
                else
                {
                    $result = $this->bbs_category_model->insert_category($req_bbs_idx, $this->form_validation->set_value('category_name'));

                    if($result == TRUE)
                    {
                        $post_success = TRUE;
                        $data['message'] = lang('insert_success');
                        $data['redirect'] = '/admin/bbs/category?bbs_idx='.$req_bbs_idx;

                        $this->layout->view_admin_only_contents('alert_view', $data);
                    }
                    else
                    {
                        $data['result_msg'] = lang('category_insert_fail_msg');
                    }
                }
            }

            $data['req_bbs_idx'] = $req_bbs_idx;

            if($post_success == FALSE)
            {
                $this->layout->view_admin_only_contents('bbs/category_insert_view', $data);
            }

        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 카테고리관리 수정 (팝업)
     * @author KangMin
     * @since 2011.11.25
     */
    public function category_update()
    {
        $data = NULL;
        $post_success = FALSE;

        $req_idx = ((int)$this->input->get_post('idx') > 0) ? (int)$this->input->get_post('idx') : NULL;

        //idx check
        $this->load->model('bbs_category_model');

        $check_idx = $this->bbs_category_model->check_idx($req_idx);

        //idx로 bbs_idx 호출
        //위에서 idx 검증 한번하므로 사실 여기에서는 false가 떨어질 일이 없다.
        $bbs_idx = $this->bbs_category_model->get_bbs_idx($req_idx);

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR $req_idx == NULL
            OR $check_idx !== TRUE )
        {
            delete_session();
            show_error(lang('unusual_approach'));
        }
        else
        {
            //rules
            $this->form_validation->set_rules('category_name', lang('category_name'), 'trim|required|htmlspecialchars|xss_clean|max_length[64]');
            $this->form_validation->set_rules('move_category', lang('move_category'), 'trim|required|xss_clean|is_natural_no_zero');
            $this->form_validation->set_rules('is_used', lang('is_used'), 'trim|required|xss_clean|is_natural|less_than[2]');

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                $category_name = $this->form_validation->set_value('category_name');
                $move_category = (int)$this->form_validation->set_value('move_category');

                //중복체크
                $check = $this->bbs_category_model->check_category_name($bbs_idx, $category_name, ' AND idx <> '.$req_idx);

                if($check == TRUE) //true면 있는거니 중복
                {
                    $data['result_msg'] = lang('category_name_duplicate');
                }
                else
                {
                    $result = $this->bbs_category_model->update_category($req_idx, $category_name, (int)$this->form_validation->set_value('is_used'));

                    if($result == TRUE)
                    {
                        //카테고리 변경
                        if($req_idx !== $move_category)
                        {
                            $check_move_category = $this->bbs_category_model->check_idx($move_category);

                            if($check_move_category == TRUE)
                            {
                                $this->load->model('bbs_article_model');

                                $result = $this->bbs_article_model->move_category($bbs_idx, $req_idx, $move_category);
                            }

                            if($result == TRUE)
                            {
                                $post_success = TRUE;
                                $data['message'] = lang('update_success');
                                $data['redirect'] = '/admin/bbs/category_update?idx='.$req_idx;

                                $this->layout->view_admin_only_contents('alert_view', $data);
                            }
                            else
                            {
                                $data['result_msg'] = lang('category_update_fail_msg');
                            }
                        }
                        else
                        {
                            $post_success = TRUE;
                            $data['message'] = lang('update_success');
                            $data['redirect'] = '/admin/bbs/category_update?idx='.$req_idx;

                            $this->layout->view_admin_only_contents('alert_view', $data);
                        }

                        $this->load->driver('cache');
                        if($this->cache->file->get('recently_'.$bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$bbs_idx.'_mobile');
                        if($this->cache->file->get('recently_'.$bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$bbs_idx.'_pc');
                    }
                    else
                    {
                        $data['result_msg'] = lang('category_update_fail_msg');
                    }
                }
            }

            $data['req_idx'] = $req_idx;
            $data['bbs_idx'] = $bbs_idx;

            if($post_success == FALSE)
            {
                $category = $this->bbs_category_model->get_category($req_idx);
                $data['category'] = $category[0];

                $data['categorys'] = $this->bbs_category_model->get_categorys($bbs_idx);

                $this->layout->view_admin_only_contents('bbs/category_update_view', $data);
            }

        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 설정 변경 내역 (팝업)
     * @author KangMin
     * @since 2011.11.23
     */
    public function category_revision()
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
            $this->load->model('bbs_category_revision_model');
            $this->load->library('pagination');

            $data['total_cnt'] = $this->bbs_category_revision_model->get_revision_total_cnt($req_idx);

            // http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
            $config['base_url'] = BASE_URL.'admin/bbs/category_revision?idx='.$req_idx;
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
                $data['revision'] = $this->bbs_category_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
            }

            $this->layout->view_admin_only_contents('bbs/category_revision_view', $data);
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 게시물관리 리스트
     * @author KangMin
     * @since 2011.02.01
     */
    public function lists()
    {
        $data = NULL;

        $this->load->helper('security');

        $req_bbs_idx = $data['bbs_idx'] = ((int)$this->input->get('bbs_idx') > 0) ? (int)$this->input->get('bbs_idx') : NULL;
        $req_page = $data['page'] = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;
        $req_is_deleted = $data['is_deleted'] = ($this->input->get('is_deleted') != '') ? (int)$this->input->get('is_deleted') : NULL;
        $req_date_start = $data['date_start'] = ($this->input->get('date_start') != '') ? strtotime($this->input->get('date_start')) : NULL;
        $req_date_end = $data['date_end'] = ($this->input->get('date_end') != '') ? strtotime($this->input->get('date_end')) : NULL;
        $req_writer = $data['writer'] = ($this->input->get('writer') != '') ? $this->input->get('writer') : NULL;
        $req_search_word = $data['search_word'] = xss_clean(str_replace(array('"', "'", '?'), '', htmlspecialchars(trim($this->input->get('search_word')))));

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx) )
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            $this->load->model('bbs_article_model');
            $this->load->model('bbs_setting_model');

            //게시판
            $data['bbs'] = $this->bbs_setting_model->get_bbs_setting();

            //page
            $data['page'] = ((int)$this->input->get('page') > 0) ? (int)$this->input->get('page') : 1;

            $this->load->library('pagination');

            if($req_bbs_idx == NULL) $ignore_bbs_idx = TRUE;
            else $ignore_bbs_idx = FALSE;

            if($req_is_deleted === NULL) $add_where_is_deleted = '';
            else $add_where_is_deleted = ' AND BBS_ARTICLE.is_deleted = '.$req_is_deleted.' ';

            $search = array('date_start'=>$req_date_start, 'date_end'=>$req_date_end, 'writer'=>$req_writer, 'search_word'=>$req_search_word);

            $data['total_cnt'] = $this->bbs_article_model->lists_total_cnt($req_bbs_idx, $add_where_is_deleted, $ignore_bbs_idx, $search);

            // http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
            $config['base_url'] = BASE_URL.'admin/bbs/lists?bbs_idx='.$this->input->get('bbs_idx').'&is_deleted='.$this->input->get('is_deleted').'&date_start='.$this->input->get('date_start').'&date_end='.$this->input->get('date_end').'&search_word='.$this->input->get('search_word').'&writer='.$this->input->get('writer');
            $config['enable_query_strings'] = TRUE; // ?page=10 이런 일반 get 방식
            $config['page_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 5;
            $config['query_string_segment'] = 'page';
            $config['total_rows'] = $data['total_cnt'];
            $config['per_page'] = 20;

            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();

            //lists
            $data['lists'] = $this->bbs_article_model->lists($req_bbs_idx, ($data['page']-1)*$config['per_page'], $config['per_page'], $add_where_is_deleted, $ignore_bbs_idx, FALSE, FALSE, $search);

            $this->layout->view_admin('bbs/lists_view', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 게시물관리 상세
     * @author KangMin
     * @since 2011.02.01
     */
    public function modify()
    {
        $data = NULL;
        $post_success = FALSE;

        $req_idx = $data['idx'] = ((int)$this->input->get_post('idx') > 0) ? (int)$this->input->get_post('idx') : NULL;

        $this->load->model('bbs_article_model');

        //idx로 bbs_idx 호출
        //위에서 idx 검증 한번하므로 사실 여기에서는 false가 떨어질 일이 없다.
        $bbs_idx = $this->bbs_article_model->get_bbs_idx($req_idx);

        //유효성
        $check_idx = $this->bbs_article_model->check_idx($req_idx, ' AND bbs_idx = '.$bbs_idx.' ');

        if($check_idx !== TRUE) $req_idx = NULL;

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR $req_idx == NULL)
        {
            delete_session();
            show_error(lang('unusual_approach'));
        }
        else
        {
            $this->load->model('bbs_category_model');
            $this->load->model('bbs_contents_model');
            $this->load->model('bbs_tag_model');
            $this->load->model('bbs_url_model');
            $this->load->model('bbs_file_model');
            $this->load->model('bbs_model');
            $this->load->model('bbs_comment_model');
            $this->load->model('bbs_hit_model');
            $this->load->model('bbs_vote_model');

            $data['bbs_id'] = $this->bbs_model->get_bbs_id($bbs_idx);

            //article, contents, hit
            $data['view'] = $this->bbs_article_model->view($req_idx, '', TRUE);

            //category
            $data['category'] = $this->bbs_category_model->get_categorys_simple($bbs_idx);

            //rules
            $this->form_validation->set_rules('title', lang('title'), 'trim|required|htmlspecialchars|xss_clean|min_length[1]|max_length[255]');
            $this->form_validation->set_rules('contents', lang('contents'), 'trim|required|min_length[1]|htmlspecialchars');
            $this->form_validation->set_rules('is_secret', lang('is_secret'), 'trim|xss_clean|is_natural|less_than[2]');
            $this->form_validation->set_rules('category', lang('category'), 'trim|xss_clean');
            $this->form_validation->set_rules('comment_count', lang('comment_count'), 'trim|required|xss_clean|is_natural');
            $this->form_validation->set_rules('vote_count', lang('vote_receive_count'), 'trim|required|xss_clean|is_natural');
            $this->form_validation->set_rules('scrap_count', lang('scrap_count'), 'trim|required|xss_clean|is_natural');
            $this->form_validation->set_rules('is_deleted', lang('is_deleted'), 'trim|xss_clean|is_natural|less_than[2]');
            $this->form_validation->set_rules('delete_file[]', 'delete_file', 'trim|xss_clean|is_natural_no_zero');
            $this->form_validation->set_rules('move_bbs', lang('move_bbs'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('move_bbs_exec', lang('exec'), 'trim|xss_clean|is_natural|less_than[2]');
            //$this->form_validation->set_rules('html_used', lang('html_used'), 'trim|xss_clean|is_natural|less_than[2]');

            //관리자그룹 글만 공지사항 처리.. 업데이트하면 어차피 날라가니
            if((int)$data['view']->group_idx === SETTING_admin_group_idx)
            {
                $this->form_validation->set_rules('is_notice', lang('is_notice'), 'trim|xss_clean|is_natural|less_than[2]');
            }

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                $req_category_idx = $this->form_validation->set_value('category');

                if($req_category_idx == '') //null이면 수정하지 않는다.
                {
                    $check_category_idx = TRUE;
                }
                else
                {
                    //카테고리 유효성
                    $check_category_idx = $this->bbs_category_model->check_idx($req_category_idx, ' AND bbs_idx = '.$bbs_idx.' ');
                }

                if($check_category_idx !== TRUE)
                {
                    $data['result_msg'] = lang('none_category');
                }
                else
                {
                    $this->db->trans_start();

                    $values['bbs_idx'] = $bbs_idx;
                    $values['category_idx'] = $req_category_idx;
                    $values['title'] = $this->form_validation->set_value('title');
                    $values['contents'] = $this->form_validation->set_value('contents');
                    $values['is_secret'] = $this->form_validation->set_value('is_secret') ? $this->form_validation->set_value('is_secret') : 0;
                    $values['is_notice'] = ((int)$data['view']->group_idx === SETTING_admin_group_idx) ? ($this->form_validation->set_value('is_notice') ? $this->form_validation->set_value('is_notice') : 0) : 0;
                    $values['comment_count'] = $this->form_validation->set_value('comment_count');
                    $values['vote_count'] = $this->form_validation->set_value('vote_count');
                    $values['scrap_count'] = $this->form_validation->set_value('scrap_count');
                    $values['is_deleted'] = (int)$this->form_validation->set_value('is_deleted');
                    //$values['html_used'] = (int)$this->form_validation->set_value('html_used');
                    $values['html_used'] = 1;//1.0.0 부터는 전체 허용한다.

                    //삭제,삭제취소 에 따라 코멘트갯수 조정
                    if($data['view']->is_deleted == 0 && $values['is_deleted'] == 1) //삭제
                    {
                        //users (글작성수)
                        $result_users = $this->users_model->update_count_users($data['view']->user_idx, 'article_count', -1);
                    }
                    else if ($data['view']->is_deleted == 1 && $values['is_deleted'] == 0) //삭제취소
                    {
                        //users (글작성수)
                        $result_users = $this->users_model->update_count_users($data['view']->user_idx, 'article_count', 1);
                    }
                    else //이외에는 아무것도 하지 않는다.
                    {
                        $result_users = TRUE;
                    }

                    //포인트는 그냥 손대지 않는다. 포인트관리에서 빼던 어쩌던...

                    //article
                    $result_article = $this->bbs_article_model->update_article_admin($req_idx, $values);

                    //contents
                    $result_contents = $this->bbs_contents_model->update_contents($req_idx, $values);

                    //files
                    //삭제
                    //어드민에서는 삭제만 한다.
                    $result_delete_files = TRUE; //일단 true

                    if($this->input->post('delete_file'))
                    {
                        $post_delete_file = $this->input->post('delete_file');

                        $delete_files = join(',', $post_delete_file);

                        //실제 파일 삭제
                        //삭제를 위한 실제 파일명 호출
                        $delete_filenames = $this->bbs_file_model->get_filenames($req_idx, $delete_files, ' AND user_idx = '.$data['view']->user_idx.' ');

                        $result_delete_files = $this->bbs_file_model->delete_files($req_idx, $delete_files, ' AND user_idx = '.$data['view']->user_idx.' '); //결과를 계속 뒤집어 쓰지만 뭐 크게 중요하진 않을듯해서

                        foreach($delete_filenames as $k=>$v)
                        {
                            if(file_exists($this->upload_path.$v->conversion_filename)) @unlink($this->upload_path.$v->conversion_filename); //실제 파일 삭제
                        }
                    }

                    $result_move_article = TRUE;
                    $result_move_contents = TRUE;
                    $result_move_tag = TRUE;
                    $result_move_url = TRUE;
                    $result_move_file = TRUE;
                    $result_move_hit = TRUE;
                    $result_move_vote = TRUE;
                    $result_move_comment = TRUE;

                    //게시물 이동
                    if($this->form_validation->set_value('move_bbs_exec') == 1)
                    {
                        $move_bbs = $this->form_validation->set_value('move_bbs');

                        $move_bbs = explode('^', $move_bbs);

                        $move_bbs_idx = $move_bbs[0];
                        $move_category_idx = $move_bbs[1]; //NULL일 수 있음.

                        //검증
                        $check_move_bbs_idx = $this->bbs_model->check_bbs_idx($move_bbs_idx);
                        $check_move_category_idx = TRUE;
                        if($move_category_idx) //카테고리는 null일수도 있으므로
                        {
                            $check_move_category_idx = $this->bbs_category_model->check_idx($move_category_idx);
                        }

                        if($check_move_bbs_idx == TRUE && $check_move_category_idx == TRUE)
                        {
                            //bbs_idx는 모두 물고 있으므로 전부 업데이트해야한다..
                            //설계당시 bbs_idx를 전부 넣느냐 마느냐 고민했던 부분이긴한데..
                            //어쨋든 전부..

                            //article
                            $result_move_article = $this->bbs_article_model->move_bbs($req_idx, $move_bbs_idx, $move_category_idx);

                            //contents
                            $result_move_contents = $this->bbs_contents_model->move_bbs($req_idx, $move_bbs_idx);

                            //tag
                            $result_move_tag = $this->bbs_tag_model->move_bbs($req_idx, $move_bbs_idx);

                            //url
                            $result_move_url = $this->bbs_url_model->move_bbs($req_idx, $move_bbs_idx);

                            //file
                            $result_move_file = $this->bbs_file_model->move_bbs($req_idx, $move_bbs_idx);

                            //hit
                            $result_move_hit = $this->bbs_hit_model->move_bbs($req_idx, $move_bbs_idx);

                            //vote
                            $result_move_vote = $this->bbs_vote_model->move_bbs($req_idx, $move_bbs_idx);

                            //comment
                            $result_move_comment = $this->bbs_comment_model->move_bbs($req_idx, $move_bbs_idx);
                        } //뭐 검증실패면 이동안하면 그만..
                    }

                    $this->db->trans_complete();

                    // 그런데.. myisam이면 트랜젝션이 의미가 없어서뤼...쩝
                    if($result_article == TRUE
                        AND $result_contents == TRUE
                            AND $result_users == TRUE
                                AND $result_delete_files == TRUE
                                    AND $result_move_article == TRUE
                                        AND $result_move_contents == TRUE
                                            AND $result_move_tag == TRUE
                                                AND $result_move_url == TRUE
                                                    AND $result_move_file == TRUE
                                                        AND $result_move_hit == TRUE
                                                            AND $result_move_vote == TRUE
                                                                AND $result_move_comment == TRUE)
                    {
                        $post_success = TRUE;
                        $data['message'] = lang('update_success');
                        $data['redirect'] = '/admin/bbs/modify?idx='.$req_idx;

                        $this->load->driver('cache');
                        if($this->cache->file->get('recently_'.$bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$bbs_idx.'_mobile');
                        if($this->cache->file->get('recently_'.$bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$bbs_idx.'_pc');

                        if(isset($move_bbs_idx) && $this->cache->file->get('recently_'.$move_bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$move_bbs_idx.'_mobile');
                        if(isset($move_bbs_idx) && $this->cache->file->get('recently_'.$move_bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$move_bbs_idx.'_pc');

                        $this->layout->view_admin_only_contents('alert_view', $data);
                    }
                    else
                    {
                        $data['result_msg'] = lang('update_fail_msg');
                    }
                }
            }

            if($post_success == FALSE)
            {
                $this->load->model('bbs_comment_model');
                $this->load->model('bbs_vote_model');
                $this->load->model('users_url_model');

                //lists_comment
                $data['lists_comment'] = $this->bbs_comment_model->lists($req_idx, 0, 0, 'DESC');

                if(count($data['lists_comment']) > 0)
                {
                    //코멘트 추천 검수
                    $comment_idxs = array();
                    foreach($data['lists_comment'] as $k=>$v)
                    {
                        $comment_idxs[] = $v->idx;
                    }

                    $examination_vote_comment_count = $this->bbs_vote_model->get_vote_count_multi('comment', $comment_idxs);

                    $temp = array();
                    foreach($examination_vote_comment_count as $k=>$v)
                    {
                        $temp[$v->idx] = $v->cnt;
                    }

                    $data['examination_vote_comment_count'] = $temp;
                }

                //tags
                $data['tags'] = $this->bbs_tag_model->get_tags($req_idx);

                //urls
                $data['urls'] = $this->bbs_url_model->get_urls($req_idx);

                //files
                $data['files'] = $this->bbs_file_model->get_files($req_idx);

                //코멘트 갯수 검수
                $data['examination_comment_count'] = $this->bbs_comment_model->get_comment_count($req_idx);

                //추천 갯수 검수
                $data['examination_vote_count'] = $this->bbs_vote_model->get_vote_count('article', $req_idx);

                //스크랩 갯수 검수
                $data['examination_scrap_count'] = $this->users_url_model->get_scrap_count($req_idx);

                //게시물 이동을 위한 셀렉트용
                $data['bbs_and_category'] = $this->bbs_model->get_bbs_and_category();

                $data['third_party_url'] = $this->assign['FRONTEND_THIRD_PARTY'];

                $this->layout->view_admin_only_contents('bbs/modify_view', $data);
            }
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 코멘트 수정
     *
     * @author KangMin
     * @since 2012.02.24
     */
    public function modify_comment()
    {
        $data = NULL;
        $post_success = FALSE;

        $req_idx = ((int)$this->input->get_post('idx') > 0) ? (int)$this->input->get_post('idx') : NULL;
        $req_article_idx = ((int)$this->input->get_post('article_idx') > 0) ? (int)$this->input->get_post('article_idx') : NULL;

        $this->load->model('bbs_article_model');
        $this->load->model('bbs_comment_model');

        //idx로 bbs_idx 호출
        //위에서 idx 검증 한번하므로 사실 여기에서는 false가 떨어질 일이 없다.
        $bbs_idx = $this->bbs_article_model->get_bbs_idx($req_article_idx);

        //유효성
        $check_idx = $this->bbs_comment_model->check_idx($req_idx, ' AND bbs_idx = '.$bbs_idx.' ');
        $check_article_idx = $this->bbs_article_model->check_idx($req_article_idx, ' AND bbs_idx = '.$bbs_idx.' ');

        if($check_idx !== TRUE) $req_idx = NULL;
        if($check_article_idx !== TRUE) $req_article_idx = NULL;

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx)
            OR $req_idx == NULL
            OR $req_article_idx == NULL)
        {
            delete_session();
            show_error(lang('unusual_approach'));
        }
        else
        {
            //rules
            $this->form_validation->set_rules('comment', lang('comment'), 'trim|required');
            $this->form_validation->set_rules('vote_count', lang('vote_receive_count'), 'trim|required|xss_clean|is_natural');
            $this->form_validation->set_rules('is_deleted', lang('is_deleted'), 'trim|xss_clean|is_natural|less_than[2]');

            //폼검증 성공이면
            if ($this->form_validation->run() == TRUE)
            {
                $is_deleted = (int)$this->form_validation->set_value('is_deleted');

                $this->db->trans_start();

                $comment_info = $this->bbs_comment_model->get_comment($req_idx);

                $result = $this->bbs_comment_model->update_comment_admin($req_idx, $this->form_validation->set_value('comment'), $this->form_validation->set_value('vote_count'), $is_deleted);

                //삭제,삭제취소 에 따라 코멘트갯수 조정
                if($comment_info->is_deleted == 0 && $is_deleted == 1) //삭제
                {
                    //코멘트 갯수 업데이트
                    //현재 전체 코멘트 갯수를 카운트 하고 싶지만 너무 무거워질거 같아서 그냥 +/-
                    //이로인해 싱크로 틀어질 가능성이 있지만, 이는 싱크툴을 만들던가...
                    $result_comment_count = $this->bbs_article_model->update_count_article($req_article_idx, 'comment_count', -1);

                    //users (댓글작성수)
                    $result_users = $this->users_model->update_count_users($comment_info->user_idx, 'comment_count', -1);
                }
                else if ($comment_info->is_deleted == 1 && $is_deleted == 0) //삭제취소
                {
                    //코멘트 갯수 업데이트
                    //현재 전체 코멘트 갯수를 카운트 하고 싶지만 너무 무거워질거 같아서 그냥 +/-
                    //이로인해 싱크로 틀어질 가능성이 있지만, 이는 싱크툴을 만들던가...
                    $result_comment_count = $this->bbs_article_model->update_count_article($req_article_idx, 'comment_count', 1);

                    //users (댓글작성수)
                    $result_users = $this->users_model->update_count_users($comment_info->user_idx, 'comment_count', 1);
                }
                else //이외에는 아무것도 하지 않는다.
                {
                    $result_comment_count = TRUE;
                    $result_users = TRUE;
                }

                //포인트는 그냥 손대지 않는다. 포인트관리에서 빼던 어쩌던...

                $this->db->trans_complete();

                if($result == TRUE
                    AND $result_comment_count == TRUE
                        AND $result_users == TRUE)
                {
                    $this->load->driver('cache');
                    if($this->cache->file->get('recently_'.$bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$bbs_idx.'_mobile');
                    if($this->cache->file->get('recently_'.$bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$bbs_idx.'_pc');

                    if($this->cache->file->get('recently_comment_mobile')) $this->cache->file->delete('recently_comment_mobile'); //최근게시물 갯수를 수정하면 이도 삭제해야 바로 적용된다.
                    if($this->cache->file->get('recently_comment_pc')) $this->cache->file->delete('recently_comment_pc'); //최근게시물 갯수를 수정하면 이도 삭제해야 바로 적용된다.

                    $data['message'] = lang('update_success');
                    $data['redirect'] = '/admin/bbs/modify?idx='.$req_article_idx;
                }
                else
                {
                    $data['message'] = lang('update_fail_msg');
                    $data['redirect'] = '/admin/bbs/modify?idx='.$req_article_idx;
                }
            }
            else
            {
                $data['message'] = str_replace("\n", '', validation_errors());
                $data['redirect'] = '/admin/bbs/modify?idx='.$req_article_idx;
            }

            $this->layout->view_admin_only_contents('alert_view', $data);
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 게시물관리 아티클 변경내역
     * @author KangMin
     * @since 2011.02.01
     */
    public function article_revision()
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
            $this->load->model('bbs_article_revision_model');
            $this->load->library('pagination');

            $data['total_cnt'] = $this->bbs_article_revision_model->get_revision_total_cnt($req_idx);

            // http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
            $config['base_url'] = BASE_URL.'admin/bbs/article_revision?idx='.$req_idx;
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
                $data['revision'] = $this->bbs_article_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
            }

            $this->layout->view_admin_only_contents('bbs/article_revision_view', $data);
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 게시물관리 글내용 변경내역
     * @author KangMin
     * @since 2011.02.01
     */
    public function contents_revision()
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
            $this->load->model('bbs_contents_revision_model');
            $this->load->library('pagination');

            $data['total_cnt'] = $this->bbs_contents_revision_model->get_revision_total_cnt($req_idx);

            // http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
            $config['base_url'] = BASE_URL.'admin/bbs/contents_revision?idx='.$req_idx;
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
                $data['revision'] = $this->bbs_contents_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
            }

            $this->layout->view_admin_only_contents('bbs/contents_revision_view', $data);
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 게시물관리 상세 코멘트 변경내역
     * @author KangMin
     * @since 2011.02.01
     */
    public function comment_revision()
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
            $this->load->model('bbs_comment_revision_model');
            $this->load->library('pagination');

            $data['total_cnt'] = $this->bbs_comment_revision_model->get_revision_total_cnt($req_idx);

            // http://codeigniter-kr.org/user_guide_2.1.0/libraries/pagination.html
            $config['base_url'] = BASE_URL.'admin/bbs/comment_revision?idx='.$req_idx;
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
                $data['revision'] = $this->bbs_comment_revision_model->get_revision($req_idx, ($req_page-1)*$config['per_page'], $config['per_page']);
            }

            $this->layout->view_admin_only_contents('bbs/comment_revision_view', $data);
        }//로그인,권한 체크 end if
    }

    // --------------------------------------------------------------------

    /**
     * 쓰레기 첨부파일 정리
     * @desc 기존 arrangefiles 은 서버의 파일 기반으로 비교해서 추후 부하이슈가 발생할 수 있어서 파일업로드 시 무조건 tb_bbs_file_temporary 에 올리고 그와 비교하는 것으로 변경
     * @desc 정상 저장하기 전의 비정상 파일이므로 썸네일 파일을 지우는 액션은 필요없다.
     *
     * @author KangMin
     * @since 2014.06.29
     */
    public function arrangefiles()
    {
        $data = NULL;

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx))
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            $this->load->helper('file');

            $this->load->model('bbs_file_temporary_model');
            $this->load->model('setting_model');

            $arrangefiles = $this->bbs_file_temporary_model->get_arrangefiles(SETTING_arrangefiles_last_idx);

            //삭제하면서 삭제한 파일의 정보 세팅
            $delete_files_result = array();
            $delete_filesize_sum = 0;
            foreach($arrangefiles as $k=>$v)
            {
                $pathinfo = pathinfo($v->conversion_filename);

                $filesize = get_file_info($this->upload_path . $v->conversion_filename, 'size');

                $delete_files_result[$k]['filename'] = $this->upload_path . $v->conversion_filename;
                $delete_files_result[$k]['filesize'] = $filesize['size'];
                $delete_filesize_sum += $filesize['size'];

                $this->db->delete('tb_bbs_file_temporary', array('idx' => $v->idx)); //임시테이블에서 쓰레기는 진짜 지워버린다.

                if(file_exists($this->upload_path . $v->conversion_filename)) @unlink($this->upload_path . $v->conversion_filename);
            }
            $data['delete_files_result'] = $delete_files_result;
            $data['delete_filesize_sum'] = $delete_filesize_sum;

            //다 처리하고 setting > arrangefiles_last_idx 값을 변경해서 다음 정리할때 기준 데이터양을 줄인다.
            if(count($arrangefiles) > 0) $this->setting_model->update('arrangefiles_last_idx', (int)$arrangefiles[0]->idx);

            $this->layout->view_admin('bbs/arrangefiles_view', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 첨부파일 정리
     *
     * @desc 어드민페이지 메뉴 설정하는 로직때문에 함수명 _ 빠짐..
     *
     * @author KangMin
     * @since 2012.03.04
     */
    /*
    public function arrangefiles()
    {
        $data = NULL;

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx))
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            $this->load->helper('file');

            $this->load->model('bbs_file_model');

            //DB상의 파일들
            //live를 던지면 삭제되지 않은 글들의 파일만 떨어지게 해두긴했는데.
            //삭제하고 글을 살릴 수도 있는거라.. 일단..흠..악용사례로 생길 수 있긴한데.. 일단
            $bbs_files = $this->bbs_file_model->get_all_filenames('all');

            //DB상의 파일들 배열정리
            $bbs_files_temp = array();
            foreach($bbs_files as $k=>$v)
            {
                $bbs_files_temp[] = $v->conversion_filename;
            }
            $bbs_files = $bbs_files_temp;

            //실제 업로드 폴더의 파일들
            $upload_files = get_filenames($this->upload_path, TRUE);

            $upload_dir = str_replace("\\", '/', FCPATH . $this->upload_path);

            //실제 업로드 폴더의 파일들 배열정리
            $upload_files_temp = array();
            foreach($upload_files as $k=>$v)
            {
                $filedate = get_file_info($v, 'date');

                //24시간 이전 파일만
                if(basename($v) !== 'index.html' && ((time() - $filedate['date']) / 3600) > 24 && strpos(basename($v), '_thumb') === FALSE)
                {
                    $upload_files_temp[] = str_replace($upload_dir, '', str_replace("\\", '/', $v));
                }
            }
            $upload_files = $upload_files_temp;

            //비교
            $files_diff = array_diff($upload_files, $bbs_files);
            $files_diff = array_merge($files_diff);

            //삭제하면서 삭제한 파일의 정보 세팅
            $delete_files_result = array();
            $delete_filesize_sum = 0;
            foreach($files_diff as $k=>$v)
            {
                $filesize = get_file_info($this->upload_path.$v, 'size');

                $delete_files_result[$k]['filename'] = $this->upload_path.$v;
                $delete_files_result[$k]['filesize'] = $filesize['size'];
                $delete_filesize_sum += $filesize['size'];

                $thumb_filepath_pathinfo = pathinfo($v);
                $thumb_filepath = $thumb_filepath_pathinfo['dirname'] . '/' . $thumb_filepath_pathinfo['filename'] . '_thumb.' . $thumb_filepath_pathinfo['extension'];

                if(file_exists($this->upload_path.$v)) @unlink($this->upload_path.$v);
                if(file_exists($this->upload_path.$thumb_filepath)) @unlink($this->upload_path.$thumb_filepath);
            }
            $data['delete_files_result'] = $delete_files_result;
            $data['delete_filesize_sum'] = $delete_filesize_sum;

            $this->layout->view_admin('bbs/arrangefiles_view', $data);
        }
    }
    */

    // --------------------------------------------------------------------

    /**
     * 게시물 일괄 삭제
     *
     * @author 배강민
     */
    public function delete()
    {
        $checked = $this->input->post('checked');

        $data = NULL;

        if( ! defined('USER_INFO_idx')
            OR (defined('USER_INFO_idx') && USER_INFO_group_idx !== SETTING_admin_group_idx))
        {
            delete_session();
            $this->layout->view_admin('login_view');
        }
        else
        {
            if($checked)
            {
                $this->load->model('bbs_article_model');

                $this->load->driver('cache');

                foreach($checked as $k=>$v)
                {
                    $temp = explode('^', $v);

					//현재 삭제상태면 카운트 조작안하게
					$check_deleted = $this->bbs_article_model->check_idx($temp[0], ' AND is_deleted = 0 ');

					if($check_deleted === TRUE)
					{
						$result_users = $this->users_model->update_count_users($temp[1], 'article_count', -1);
					}

                    $bbs_idx = $this->bbs_article_model->get_bbs_idx($temp[0]);
                    if($this->cache->file->get('recently_'.$bbs_idx.'_mobile')) $this->cache->file->delete('recently_'.$bbs_idx.'_mobile');
                    if($this->cache->file->get('recently_'.$bbs_idx.'_pc')) $this->cache->file->delete('recently_'.$bbs_idx.'_pc');
                }

                $result = $this->bbs_article_model->delete_admin($checked);

                $data['message'] = lang('delete_success');

                if($this->cache->file->get('recently_comment_mobile')) $this->cache->file->delete('recently_comment_mobile'); //최근게시물 갯수를 수정하면 이도 삭제해야 바로 적용된다.
                if($this->cache->file->get('recently_comment_pc')) $this->cache->file->delete('recently_comment_pc'); //최근게시물 갯수를 수정하면 이도 삭제해야 바로 적용된다.
            }
            else
            {
                $data['message'] = lang('delete_fail_msg');
            }

            $data['redirect'] = '/admin/bbs/lists?bbs_idx='.$this->input->post('bbs_idx').'&is_deleted='.$this->input->post('is_deleted').'&date_start='.$this->input->post('date_start').'&date_end='.$this->input->post('date_end').'&search_word='.$this->input->post('search_word').'&writer='.$this->input->post('writer').'&page='.$this->input->post('page').'';

            $this->layout->view_admin_only_contents('alert_view', $data);
        }
    }
}

//EOF
