<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_message_model extends CI_Model 
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

		// --------------------------------------------------------------------

		/**
		 * 메시지 보내기
		 *
		 * @author KangMin
		 * @since 2012.04.16
		 *
		 * @param int
		 * @param string
		 *
		 * @return bool
		 */
		public function send_message($receive_user_idx, $contents, $title=NULL)
		{
			$query = '
						INSERT INTO
							tb_users_message
							(
							sender_user_idx
							, receiver_user_idx
							, title
							, contents
							, timestamp_send
							, client_ip_send
							)
						VALUES
							(
							?
							, ?
							, ?
							, ?
							, UNIX_TIMESTAMP(NOW())
							, ?
							)
					';

			$query = $this->db->query($query, array(
													USER_INFO_idx
													, $receive_user_idx
													, $title
													, $contents
													, $this->input->ip_address()
													)
									);
			return $query;
		}

		// --------------------------------------------------------------------

		/**
		 * 메시지 리스트
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @param string
		 * @param int
		 * @param int
		 *
		 * @return array
		 */
		public function get_message($search, $page, $per_page, $add_where='')
		{
			if($search == 'receive') //받은 쪽지함
			{
				$join = ' USERS_MESSAGE.sender_user_idx = USERS.idx ';
				$search_where = ' AND USERS_MESSAGE.receiver_user_idx = ? AND USERS_MESSAGE.is_deleted_receiver = 0 ';
			}
			else //보낸 쪽지함
			{
				$join = ' USERS_MESSAGE.receiver_user_idx = USERS.idx ';
				$search_where = ' AND USERS_MESSAGE.sender_user_idx = ? AND USERS_MESSAGE.is_deleted_sender = 0 ';
			}
			
			$query = '
						SELECT 
							USERS_MESSAGE.idx
							, USERS_MESSAGE.sender_user_idx
							, USERS_MESSAGE.receiver_user_idx
							, USERS.user_id
							, USERS.name
							, USERS.nickname
							, USERS_MESSAGE.title
							, USERS_MESSAGE.contents
							, USERS_MESSAGE.timestamp_send
							, USERS_MESSAGE.timestamp_receive
							, USERS_MESSAGE.client_ip_send
							, USERS_MESSAGE.client_ip_receive
							, USERS_MESSAGE.is_read
						FROM
							tb_users_message AS USERS_MESSAGE
							, tb_users AS USERS
						WHERE
							'.$join.' 
							'.$search_where.' 
							'.$add_where.'
						ORDER BY
							USERS_MESSAGE.idx DESC
						LIMIT
							?, ?
					';

			$query = $this->db->query($query, array(USER_INFO_idx, $page, $per_page));
			$rows = $query->result();

			return $rows;	
		}

		// --------------------------------------------------------------------

		/**
		 * 메시지 리스트 총 카운트
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @param string
		 *
		 * @return int
		 */
		public function get_message_total_cnt($search, $add_where='')
		{
			if($search == 'receive') //받은 쪽지함
			{
				$join = ' USERS_MESSAGE.sender_user_idx = USERS.idx ';
				$search_where = ' AND USERS_MESSAGE.receiver_user_idx = ? AND USERS_MESSAGE.is_deleted_receiver = 0 ';
			}
			else //보낸 쪽지함
			{
				$join = ' USERS_MESSAGE.receiver_user_idx = USERS.idx ';
				$search_where = ' AND USERS_MESSAGE.sender_user_idx = ? AND USERS_MESSAGE.is_deleted_sender = 0 ';
			}
			
			$query = '
						SELECT 
							COUNT(USERS_MESSAGE.idx) AS cnt
						FROM
							tb_users_message AS USERS_MESSAGE
							, tb_users AS USERS
						WHERE
							'.$join.' 
							'.$search_where.' 
							'.$add_where.'
					';

			$query = $this->db->query($query, array(USER_INFO_idx));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return $row->cnt;
			}

			return 0;
		}

		// --------------------------------------------------------------------

		/**
		 * 메시지 호출 (검증 : 존재유무, 본인이 받거나 보낸거인지, 삭제여부)
		 *
		 * @author KangMin
		 * @since 2012.04.17
		 *
		 * @param string
		 * @param int
		 *
		 * @return mixed
		 */
		public function view_message($search, $idx, $add_where='')
		{
			if($search == 'receive') //받은 쪽지함
			{
				$join = ' USERS_MESSAGE.sender_user_idx = USERS.idx ';
				$search_where = ' AND USERS_MESSAGE.is_deleted_receiver = 0 AND USERS_MESSAGE.receiver_user_idx = ? ';
			}
			else //보낸 쪽지함
			{
				$join = ' USERS_MESSAGE.receiver_user_idx = USERS.idx ';
				$search_where = ' AND USERS_MESSAGE.is_deleted_sender = 0 AND USERS_MESSAGE.sender_user_idx = ? ';
			}

			$query = '
						SELECT
							USERS_MESSAGE.idx
							, USERS_MESSAGE.sender_user_idx
							, USERS_MESSAGE.receiver_user_idx
							, USERS.user_id
							, USERS.name
							, USERS.nickname
							, USERS_MESSAGE.title
							, USERS_MESSAGE.contents
							, USERS_MESSAGE.timestamp_send
							, USERS_MESSAGE.timestamp_receive
							, USERS_MESSAGE.client_ip_send
							, USERS_MESSAGE.client_ip_receive
							, USERS_MESSAGE.is_read				
						FROM
							tb_users_message AS USERS_MESSAGE
							, tb_users AS USERS
						WHERE
							'.$join.'
							AND USERS_MESSAGE.idx = ? 
							'.$search_where.' 
							'.$add_where.' 
					';
			$query = $this->db->query($query, array($idx, USER_INFO_idx));
			$row = $query->row();

			return $row;    
		}

		// --------------------------------------------------------------------

		/**
		 * 수신자가 읽으면 읽음 처리 및 읽은 시각 삽입
		 *
		 * @author KangMin
		 * @since 2012.04.17
		 *
		 * @param int
		 *
		 * @return bool
		 */
		public function read_message($idx)
		{
			$query = '
						UPDATE
							tb_users_message
						SET
							timestamp_receive = UNIX_TIMESTAMP(NOW())
							, is_read = 1
							, client_ip_receive = ?
						WHERE
							is_read = 0
							AND idx = ?
							AND receiver_user_idx = ?
					';

			$query = $this->db->query($query, array(
													$this->input->ip_address()
													, $idx
													, USER_INFO_idx
													)
									);
			return $query;			
		}

		// --------------------------------------------------------------------

		/**
		 * 메시지 삭제
		 *
		 * @author KangMin
		 * @since 2012.04.17
		 *
		 * @param int
		 *
		 * @return bool
		 */
		public function delete_message($search, $idx)
		{
			if($search == 'receive')
			{
				$query = '
							UPDATE
								tb_users_message
							SET
								is_deleted_receiver = 1
							WHERE
								idx = ?
								AND receiver_user_idx = ?
						';
			}
			else
			{
				$query = '
							UPDATE
								tb_users_message
							SET
								is_deleted_sender = 1
							WHERE
								idx = ?
								AND sender_user_idx = ?
						';
			}

			$query = $this->db->query($query, array(
													$idx
													, USER_INFO_idx
													)
									);
			return $query;		
		}

		// --------------------------------------------------------------------

        /**
         * idx 유효성 (그냥 간단히...)
         * 
         * @author KangMin
         * @since 2011.12.31
         * 
         * @param int
         * 
         * @return bool
         */
        public function check_idx($req_idx, $add_where='')
        {
            $query = '
                        SELECT 
                            COUNT(idx) AS cnt
                        FROM
                            tb_users_message
                        WHERE
                            idx = ? '.$add_where.'
                    ';
                    
			$query = $this->db->query($query, array($req_idx));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return TRUE;
			}

			return FALSE;                       
        }   

		// --------------------------------------------------------------------

		/**
		 * 읽지 않은 메시지 갯수 호출
		 * 
		 * @author KangMin
		 * @since 2012.04.17
		 *
		 * @return int
		 */
		public function get_message_count()
		{
			$query = '
						SELECT
							COUNT(idx) AS cnt
						FROM
							tb_users_message
						WHERE
							is_read = 0
							AND is_deleted_receiver = 0
							AND receiver_user_idx = ?
					';


			$query = $this->db->query($query, array(USER_INFO_idx));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return $row->cnt;
			}

			return 0;
		}
	}

//EOF