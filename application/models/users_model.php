<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_model extends CI_Model 
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

		// --------------------------------------------------------------------

        /**
         * 회원정보
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param int
         * 
         * @return mixed
         */
		public function get_user_info($user_idx, $add_where='')
		{
			$query = '
						SELECT
							idx
							, user_id
							, level
							, group_idx
							, name
							, nickname
							, message_receive_type
							, email
							, timezone
							, article_count
							, comment_count
							, vote_send_count
							, vote_receive_count
							, point
							, avatar_used
							, memo
							, timestamp_insert
							, timestamp_update
							, timestamp_delete
							, timestamp_login
							, timestamp_post
							, timestamp_update_password
							, client_ip_insert
							, client_ip_update
							, client_ip_delete
							, client_ip_login
							, client_ip_post
							, client_ip_update_password
							, status
						FROM
							tb_users
						WHERE
							idx = ?
							'.$add_where;

			$query = $this->db->query($query, array($user_idx));
			$row = $query->row();

			if(isset($row->user_id) == TRUE)
			{
				return $row;
			}

			return FALSE;
		}

		// --------------------------------------------------------------------

        /**
         * 로그인 후 회원정보 변경
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param int
         * 
         * @return bool
         */
		public function set_user_info_after_login($user_idx)
		{
			$query = '
						UPDATE
							tb_users
						SET
							timestamp_login = UNIX_TIMESTAMP(NOW())
							, client_ip_login = ?
						WHERE
							idx = ?
					';

			$query = $this->db->query($query, array(
													$this->input->ip_address()
													, $user_idx
													)
									);
			return $query;
		}

		// --------------------------------------------------------------------

        /**
         * 존재여부 체크 (공용 사용)
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param string
         * @param string
         * 
         * @return bool
         */
		public function check($field, $value, $add_where='')
		{
			$query = '
						SELECT
							COUNT(idx) AS cnt
						FROM
							tb_users
						WHERE
							'.$field.' = ? '.$add_where.' 
					';

			$query = $this->db->query($query, array($value));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return TRUE;
			}

			return FALSE;
		}

		// --------------------------------------------------------------------

        /**
         * 가입
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param array
         * 
         * @return bool
         */
		public function join($values)
		{
			$query = '
						INSERT INTO
							tb_users
							(
							user_id
							, super_secured_password
							, group_idx
							, name
							, nickname
							, email
							, timezone
							, timestamp_insert
							, client_ip_insert
							)
						VALUES 
							(
							?
							, ?
							, ?
							, ?
							, ?
							, ?
							, ?
							, UNIX_TIMESTAMP(NOW())
							, ?
							)
						';

			$query = $this->db->query($query, array(
													$values['user_id']
													, $values['password']
													, SETTING_default_group_idx
													, $values['name']
													, $values['nickname']
													, $values['email']
													, SETTING_default_timezone
													, $this->input->ip_address()
													)
									);
			return $query;
		}

		// --------------------------------------------------------------------

        /**
         * 비밀번호 새발급을 위한 이메일 체크
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param string
		 * @param string
         * 
         * @return mixed
         */
		public function email($user_id, $email)
		{
			$query = '
						SELECT
							email
						FROM
							tb_users
						WHERE
							user_id = ?
							AND email = ?
							AND status = 1
					';

			$query = $this->db->query($query, array($user_id, $email));
			$row = $query->row();

			if(isset($row->email) == TRUE)
			{
				return $row->email;
			}

			return FALSE;
		}

		// --------------------------------------------------------------------

        /**
         * 임시비밀번호 세팅
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param string
         * @param string
         * 
         * @return bool
         */
		public function set_new_password($user_id, $new_password)
		{
			$query = '
						UPDATE
							tb_users
						SET
							new_password = ?
							, new_password_timestamp = UNIX_TIMESTAMP(NOW())
						WHERE
							user_id = ?
					';

			$query = $this->db->query($query, array(
													$new_password
													, $user_id
													)
									);
			return $query;
		}

		// --------------------------------------------------------------------
        
        /**
         * 회원정보 수정
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param array
		 * 
         * @return bool
         */
        public function modify($values)
        {          
            $add_set = '';
            if($values['password'] !== '') 
            {
                $add_set = ' super_secured_password = \''.$values['password'].'\', timestamp_update_password = UNIX_TIMESTAMP(NOW()), client_ip_update_password = \''.$this->input->ip_address().'\', ';
            }
            
            $query = '
                        UPDATE
                            tb_users
                        SET
                            '.$add_set.'
                            name = ?
                            , nickname = ?
                            , email = ?
                            , message_receive_type = ?
                            , avatar_used = ?
                            , timezone = ?
                            , memo = ?
                            , timestamp_update = UNIX_TIMESTAMP(NOW())
                            , client_ip_update = ?
                        WHERE
                            idx = ? 
                    ';
            
			$query = $this->db->query($query, array(
													$values['name']
													, $values['nickname']
													, $values['email']
                                                    , $values['message_receive_type']
                                                    , $values['avatar_used']
													, $values['timezones']
                                                    , $values['memo']
													, $this->input->ip_address()
                                                    , USER_INFO_idx
													)
									);
			return $query;            
        }

		// --------------------------------------------------------------------

        /**
         * 회원정보 수정 (관리자모드)
         * @author KangMin
         * @since 2011.11.09
         * 
		 * @param int
         * @param array
		 * 
         * @return bool
         */
        public function modify_admin($req_idx, $values)
        {           
            $add_set = '';
            if($values['password'] !== '')
            {
                $add_set = ' super_secured_password = \''.$values['password'].'\', timestamp_update_password = UNIX_TIMESTAMP(NOW()), client_ip_update_password = \''.$this->input->ip_address().'\', ';
            }
            
            $query = '
                        UPDATE
                            tb_users
                        SET
                            '.$add_set.'
                            user_id = ?
                            , name = ?
                            , nickname = ?
                            , password = \'\'
							    , level = ?
							    , group_idx = ?
                            , email = ?
							    , point = ?
							    , article_count = ?
							    , comment_count = ?
							    , vote_send_count = ?
                            , vote_receive_count = ?
                            , timezone = ?
                            , timestamp_update = UNIX_TIMESTAMP(NOW())
                            , client_ip_update = ?
							    , status = ?
                        WHERE
                            idx = ? 
                    ';
            
			$query = $this->db->query($query, array(
													$values['user_id']
													, $values['name']
													, $values['nickname']
													, $values['level']
													, $values['group_idx']
													, $values['email']
													, $values['point']
													, $values['article_count']
													, $values['comment_count']
													, $values['vote_send_count']
													, $values['vote_receive_count']
													, $values['timezones']
													, $this->input->ip_address()
													, $values['status']
                                                    , $req_idx
													)
									);
			return $query;            
        }

		// --------------------------------------------------------------------

        /**
         * 회원정보 호출
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param int
		 * @param int
		 * 
         * @return array
         */
		public function get_users($page, $per_page, $searchs=array())
		{
			$add_where = '';
			
			if(isset($searchs['and']) == TRUE && count($searchs['and']) > 0)
			{
				$add_where .= ' AND ('.join(' AND ', $searchs['and']).') ';
			}

			if(isset($searchs['or']) == TRUE && count($searchs['or']) > 0)
			{
				$add_where .= ' AND ('.join(' OR ', $searchs['or']).') ';
			}

			$query = '
						SELECT
							idx
							, user_id
							, name
							, nickname
							, status
						FROM
							tb_users
						WHERE
							1 = 1
							'.$add_where.' 
						ORDER BY
							idx DESC
						LIMIT
							?, ?
						';

			$query = $this->db->query($query, array($page, $per_page));
			$rows = $query->result();

			return $rows;			
		}

		// --------------------------------------------------------------------

        /**
         * 회원정보 카운트
         * @author KangMin
         * @since 2011.11.09
		 * 
         * @return int
         */
		public function get_users_total_cnt($searchs=array())
		{
			$add_where = '';

			if(isset($searchs['and']) == TRUE && count($searchs['and']) > 0)
			{
				$add_where .= ' AND ('.join(' AND ', $searchs['and']).') ';
			}

			if(isset($searchs['or']) == TRUE && count($searchs['or']) > 0)
			{
				$add_where .= ' AND ('.join(' OR ', $searchs['or']).') ';
			}

			$query = '
						SELECT
							COUNT(idx) AS cnt
						FROM
							tb_users
						WHERE
							1 = 1
							'.$add_where.'
						';

			$query = $this->db->query($query);
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return $row->cnt;
			}

			return 0;	
		}

		// --------------------------------------------------------------------
		
        /**
         * 그룹이동
         * @author KangMin
         * @since 2011.12.21
         * 
		 * @param int
		 * @param int
		 * 
         * @return bool
         */
		public function update_group($req_move_group_original, $req_move_group)
		{
			$query = '
						UPDATE
							tb_users
						SET
							group_idx = ?
							, timestamp_update = UNIX_TIMESTAMP(NOW())
                            , client_ip_update = ?
						WHERE
							group_idx = ?
						';
			
			$query = $this->db->query($query, array(
													$req_move_group
													, $this->input->ip_address()
													, $req_move_group_original
													)
									);

			return $query;
		}

		// --------------------------------------------------------------------
        
		/**
		 * count update (article_count, comment_count, vote_send_count, vote_receive_count)
		 *
		 * @author KangMin
		 * @since 2011.12.28
		 *
		 * @parma int
		 * @param string
		 * @param int (+, -)
		 *
		 * @return bool
		 */
		public function update_count_users($idx, $field, $value)
		{
			$query = '
						UPDATE
							tb_users
						SET
							'.$field.' = '.$field.' + '.(int)+$value.'
						WHERE
							idx = ? 
					';

			//회원별 카운트성 필드는 0 이상만 가능하다
			if($value < 0 && in_array($field, array('article_count', 'comment_count', 'vote_send_count', 'vote_receive_count')))
			{
				$query .= ' AND '.$field.' <> 0 ';
			}

			$query = $this->db->query($query, array(
													$idx
													)
									);                                    

			return $query;   
		}      
		
		// --------------------------------------------------------------------
		
        /**
         * 글/댓글 작성 후 마지막 글 작성 정보 업데이트
		 *
         * @author KangMin
         * @since 2011.11.09
         * 
         * @param int
         * 
         * @return bool
         */
		public function update_last_post($user_idx)
		{
			$query = '
						UPDATE
							tb_users
						SET
							timestamp_post = UNIX_TIMESTAMP(NOW())
							, client_ip_post = ?
						WHERE
							idx = ?
					';

			$query = $this->db->query($query, array(
													$this->input->ip_address()
													, $user_idx
													)
									);
			return $query;
		}

        // --------------------------------------------------------------------

        /**
         * 로그인을 위한 기존 체크와 비밀번호 관련 값을 호출한다.
         *
         * @author 배강민
         *
         * @param string $user_id
         *
         * @return mixed
         */
        public function get_user_info_for_login($user_id)
        {
            $query = '
                        SELECT
                            idx
                            , user_id
                            , password
                            , super_secured_password
                            , new_password
                            , new_password_timestamp
                            , status
							, CONCAT(idx, \'^\', timestamp_insert) AS user_cookie
                        FROM
                            tb_users
                        WHERE
                            user_id = ?
                        LIMIT 0, 1
                    ';

            $query = $this->db->query($query, array($user_id));
            $row = $query->row();

            if(isset($row->user_id) == TRUE)
            {
                return $row;
            }

            return FALSE;
        }

        // --------------------------------------------------------------------

        /**
         * 구 비번(md5) 로그인 후 보안강화된 비번으로 변경한다.
         *
         * @param string $user_id
         * @param string $super_secured_password
         *
         * @return mixed
         */
        public function set_super_secured_password($user_id, $super_secured_password)
        {
            $query = '
                        UPDATE
                            tb_users
                        SET
                            password = NULL
                            , super_secured_password = ?
                        WHERE
                            user_id = ?
                        ';

            $query = $this->db->query($query, array($super_secured_password, $user_id));

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * 회원탈퇴
         *
         * @return bool
         */
        public function unregistered()
        {
            $query = '
                    UPDATE
                        tb_users
                    SET
                        status = 0
                        , timestamp_delete = UNIX_TIMESTAMP(NOW())
                        , client_ip_delete = ?
                    WHERE
                        idx = ?
                    ';

            $query = $this->db->query($query, array($this->input->ip_address(), USER_INFO_idx));

            return $query;
        }
	}

//END