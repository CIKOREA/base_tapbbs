<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_point_model extends CI_Model 
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

		// --------------------------------------------------------------------
        
        /**
         * 포인트 지급 (글작성,댓글작성,추천)
         * 
         * @author KangMin
         * @since 2011.12.30
         * 
		 * @param string
         * @param int
         * @param int
         * 
         * @return bool
         */
        public function insert_point($type, $idx, $point, $user_idx=USER_INFO_idx)
        {
            $query = '
                        INSERT INTO
                            tb_users_point
                            (
                            user_idx
                            , point
                            , '.$type.'_idx
							    , exec_user_idx
							    , exec_timestamp
							    , exec_client_ip
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
													$user_idx
                                                    , $point
                                                    , $idx
													, $user_idx
													, $this->input->ip_address()
													)
									);                                   

			return $query;                      
        }

		// --------------------------------------------------------------------

        /**
         * 포인트 지급 (연관글 없이 comment로)
         * 
         * @author KangMin
         * @since 2011.12.30
         * 
		 * @param int
         * @param string
         * 
         * @return bool
         */
        public function insert_point_comment($point, $comment, $user_idx=USER_INFO_idx)
        {
            $query = '
                        INSERT INTO
                            tb_users_point
                            (
                            user_idx
                            , point
                            , comment
							, exec_user_idx
							, exec_timestamp
							, exec_client_ip
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
													$user_idx
                                                    , $point
                                                    , $comment
													, $user_idx
													, $this->input->ip_address()
													)
									);                                   

			return $query;                      
        }

		// --------------------------------------------------------------------

		/**
		 * 글작성 포인트 삭제를 위해 해당 포인트 호출
		 *
		 * @author KangMin
		 * @since 2012.01.15
		 *
		 * @param string
		 * @param int
		 * @param int
		 *
		 * @return int
		 */
		public function get_point($type, $idx, $point_base)
		{
			$query = '
						SELECT
							point
						FROM
							tb_users_point
						WHERE
							'.$type.'_idx = ?
							AND point > 0
							AND user_idx = ?
						ORDER BY 
							idx DESC
						LIMIT
							0, 1
					';

			$query = $this->db->query($query, array(
                                                    $idx
                                                    , USER_INFO_idx
													)
									); 
			$row = $query->row();

			if(isset($row->point) == TRUE)
			{
				return (int)$row->point;
			}
			else
			{
				return $point_base;
			}
		}

		// --------------------------------------------------------------------

		/**
		 * 글작성 포인트 삭제를 위해 해당 포인트 호출
		 * 본인 글안에 본인 코멘트들의 포인트 추출
		 *
		 * @author KangMin
		 * @since 2012.01.15
		 *
		 * @param int
		 *
		 * @return int
		 */
		public function get_point_own_comments($article_idx)
		{
			$query = '
						SELECT
							IFNULL(SUM(point), 0) AS point
						FROM
							tb_users_point
						WHERE
							comment_idx IN (
											SELECT
												idx
											FROM
												tb_bbs_comment
											WHERE
												article_idx = ?
												AND user_idx = ?
												AND is_deleted = 0
											)												
							AND point > 0
							AND user_idx = ?
					';

			$query = $this->db->query($query, array(
                                                    $article_idx
                                                    , USER_INFO_idx
													, USER_INFO_idx
													)
									); 
			$row = $query->row();

			if(isset($row->point) == TRUE)
			{
				return (int)$row->point;
			}
			else
			{
				return 0;
			}
		}

		// --------------------------------------------------------------------

		/**
		 * 포인트내역
		 *
		 * @author KangMin
		 * @since 2012.01.29
		 *
		 * @param int
		 * @param int
		 * @param int
		 *
		 * @return array
		 */
		public function get_point_info($user_idx, $page, $per_page, $add_where='', $select_exec_user_info=FALSE)
		{
			$add_select = '';

			//필요할때만 액션을 가한 회원 정보 셀렉트
			if($select_exec_user_info == TRUE)
			{
				$add_select = '
                            , (SELECT user_id FROM tb_users WHERE idx = v.exec_user_idx) AS exec_user_id
                            , (SELECT name FROM tb_users WHERE idx = v.exec_user_idx) AS exec_name
                            , (SELECT nickname FROM tb_users WHERE idx = v.exec_user_idx) AS exec_nickname
							';
			}

			$query = '
						SELECT
							idx
							, user_idx
							, user_id
							, name
							, nickname
							, user_point
							, point
							, article_idx
							, article_bbs_id
							, comment_idx
							, comment_article_idx
							, (SELECT bbs_id FROM tb_bbs WHERE idx = (SELECT bbs_idx FROM tb_bbs_article WHERE idx = v.comment_article_idx)) AS comment_article_bbs_id
							, vote_idx
							, vote_article_idx
							, (SELECT bbs_id FROM tb_bbs WHERE idx = (SELECT bbs_idx FROM tb_bbs_article WHERE idx = v.vote_article_idx)) AS vote_article_bbs_id
							, vote_comment_article_idx
							, (SELECT bbs_id FROM tb_bbs WHERE idx = (SELECT bbs_idx FROM tb_bbs_article WHERE idx = v.vote_comment_article_idx)) AS vote_comment_article_bbs_id
							, comment
							, exec_user_idx
							, exec_timestamp
							, exec_client_ip
							, is_deleted
							, exec_user_idx_delete
							, exec_timestamp_delete
							, exec_client_ip_delete
							'.$add_select.' 
						FROM
						(
							SELECT
								USERS_POINT.idx
								, USERS_POINT.user_idx
								, USERS.user_id
								, USERS.name
								, USERS.nickname
								, USERS.point AS user_point
								, USERS_POINT.point
								, USERS_POINT.article_idx
								, (SELECT bbs_id FROM tb_bbs WHERE idx = (SELECT bbs_idx FROM tb_bbs_article WHERE idx = USERS_POINT.article_idx)) AS article_bbs_id
								, USERS_POINT.comment_idx
								, CASE WHEN USERS_POINT.comment_idx IS NOT NULL THEN (SELECT article_idx FROM tb_bbs_comment WHERE idx = USERS_POINT.comment_idx) END AS comment_article_idx
								, USERS_POINT.vote_idx
								, CASE WHEN USERS_POINT.vote_idx IS NOT NULL THEN (SELECT article_idx FROM tb_bbs_vote WHERE idx = USERS_POINT.vote_idx) END AS vote_article_idx
								, CASE WHEN USERS_POINT.vote_idx IS NOT NULL THEN (SELECT article_idx FROM tb_bbs_comment WHERE idx = (SELECT comment_idx FROM tb_bbs_vote WHERE idx = USERS_POINT.vote_idx)) END AS vote_comment_article_idx
								, USERS_POINT.comment
								, USERS_POINT.exec_user_idx
								, USERS_POINT.exec_timestamp
								, USERS_POINT.exec_client_ip
								, USERS_POINT.is_deleted
								, USERS_POINT.exec_user_idx_delete
								, USERS_POINT.exec_timestamp_delete
								, USERS_POINT.exec_client_ip_delete
							FROM
								tb_users_point AS USERS_POINT
								, tb_users AS USERS
							WHERE
								USERS_POINT.user_idx = USERS.idx
								AND USERS_POINT.user_idx = ? '.$add_where.'
						) v					
						ORDER BY
							idx DESC
						LIMIT 
							?, ?
					';

			$query = $this->db->query($query, array($user_idx, $page, $per_page));
			$rows = $query->result();

			return $rows;	
		}

		// --------------------------------------------------------------------

		/**
		 * 포인트내역 총 카운트
		 *
		 * @author KangMin
		 * @since 2012.01.29
		 *
		 * @param int
		 *
		 * @return int
		 */
		public function get_point_info_total_cnt($user_idx, $add_where='')
		{
			$query = '
						SELECT
							COUNT(USERS_POINT.idx) AS cnt
						FROM
							tb_users_point USERS_POINT
							, tb_users USERS
						WHERE
							USERS_POINT.user_idx = USERS.idx
							AND USERS_POINT.user_idx = ? '.$add_where.'
					';

			$query = $this->db->query($query, array($user_idx));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return $row->cnt;
			}

			return 0;	
		}

		// --------------------------------------------------------------------

		/**
		 * 포인트 총 합계
		 * 회원 DB의 포인트는 그때그때 +,-를 하는데 누락혹은 오류가 있을 수 있다
		 * 아니면 또 역으로 포인트는 +,-를 하는데 여기에는 안할수도...
		 * 비교 및 싱크를 위한..
		 * 
		 * @author KangMin
		 * @since 2012.01.29
		 *
		 * @param int
		 *
		 * @return int
		 */
		public function get_point_sum($user_idx, $add_where='')
		{
			$query = '
						SELECT
							SUM(point) as point
						FROM
							tb_users_point
						WHERE
							user_idx = ? '.$add_where.'
					';

			$query = $this->db->query($query, array($user_idx));
			$row = $query->row();

			if(isset($row->point) == TRUE)
			{
				return $row->point;
			}

			return 0;				
		}

		// --------------------------------------------------------------------

		/**
		 * is_delete 업데이트
		 *
		 * @author KangMin
		 * @since 2012.01.31
		 *
		 * @param int
		 * @param int
		 *
		 * @return bool
		 */
		public function update_is_deleted($idx, $user_idx, $value)
		{
			$query = '
						UPDATE
							tb_users_point
						SET
							is_deleted = ?
							, exec_user_idx_delete = ?
							, exec_timestamp_delete = UNIX_TIMESTAMP(NOW())
							, exec_client_ip_delete = ?
						WHERE
							idx = ?
							AND user_idx = ?
					';
                    
			$query = $this->db->query($query, array(
													$value
													, USER_INFO_idx
													, $this->input->ip_address()
													, $idx
													, $user_idx
													)
									);                                   

			return $query;    
		}
	}

//EOF