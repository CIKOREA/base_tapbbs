<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users_url_model extends CI_Model 
	{
	    public function __construct()
	    {
	        parent::__construct();
	    }

		// --------------------------------------------------------------------

		/**
		 * insert
		 *
		 * @author KangMin
		 * @since 2012.01.24
		 *
		 * @param array
		 *
		 * @return bool
		 */
		public function insert($values)
		{
			$query = '
						INSERT INTO
							tb_users_url
							(
							user_idx
							, article_idx
							, title
							, url
							, type
							, timestamp_insert
							)
						VALUES
							(
							?
							, ?
							, ?
							, ?
							, ?
							, UNIX_TIMESTAMP(NOW())
							)
					';

			$query = $this->db->query($query, array(
													USER_INFO_idx
													, $values['article_idx']
													, $values['title']
													, $values['url']
													, $values['type']
													)
									);                                   

			return $query;
		}

		// --------------------------------------------------------------------

		/**
		 * 스크랩 중복 확인
		 *
		 * @author KangMin
		 * @since 2012.01.24
		 *
		 * @param int
		 * 
		 * @return bool
		 */
		public function check_duplicate_scrap($article_idx)
		{
			$query = '
						SELECT
							COUNT(idx) AS cnt
						FROM
							tb_users_url
						WHERE
							article_idx = ?
							AND user_idx = ?
							AND type = 0
					';

			$query = $this->db->query($query, array($article_idx
													, USER_INFO_idx));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return TRUE;
			}

			return FALSE;    	
		}

		// --------------------------------------------------------------------

		/**
		 * 스크랩 갯수
		 * 
		 * @desc 실제 DB를 조회해서 갯수를 연산해낸다. (검수용)
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @param int
		 * 
		 * @return int
		 */
		public function get_scrap_count($article_idx)
		{
			$query = '
						SELECT 
							COUNT(idX) AS cnt
						FROM
							tb_users_url
						WHERE
							article_idx = ?
							AND type = 0
					';

			$query = $this->db->query($query, array($article_idx));
			$row = $query->row();

			if(isset($row->cnt) == TRUE && (int)$row->cnt > 0)
			{
				return $row->cnt;
			}

			return 0;
		}

		// --------------------------------------------------------------------

		/**
		 * 스크랩 리스트
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @param int
		 * @param int
		 *
		 * @return array
		 */
		public function get_scrap($page, $per_page, $add_where='')
		{
			$query = '
						SELECT 
							idx
							, user_idx
							, article_idx
							, (SELECT bbs_id FROM tb_bbs WHERE idx = (SELECT bbs_idx FROM tb_bbs_article WHERE idx = article_idx)) AS bbs_id
							, title
							, url
							, type
							, timestamp_insert
							, timestamp_update
						FROM
							tb_users_url
						WHERE
							user_idx = ?
							AND type = 0 
							'.$add_where.'
						ORDER BY
							idx DESC
						LIMIT
							?, ?
					';

			$query = $this->db->query($query, array(USER_INFO_idx, $page, $per_page));
			$rows = $query->result();

			return $rows;	
		}

		// --------------------------------------------------------------------

		/**
		 * 스크랩 리스트 총 카운트
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @return array
		 */
		public function get_scrap_total_cnt($add_where='')
		{
			$query = '
						SELECT 
							COUNT(idx) AS cnt
						FROM
							tb_users_url
						WHERE
							user_idx = ?
							AND type = 0 
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
		 * 삭제
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @param int
		 *
		 * @return bool
		 */
		public function delete_url($idx, $add_where='')
		{
			$query = '
						DELETE FROM tb_users_url
						WHERE
							idx = ? '.$add_where.' 
					';

			$query = $this->db->query($query, array($idx));                                   

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
                            tb_users_url
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
		 * 스크랩 아티클번호 뽑기
		 *
		 * @author KangMin
		 * @since 2012.02.24
		 *
		 * @param int
		 *
		 * @return mixed
		 */
		public function get_article_idx($idx)
		{
			$query = '
						SELECT
							article_idx
						FROM
							tb_users_url
						WHERE
							type = 0
							AND idx = ?
					';

			$query = $this->db->query($query, array($idx));
			$row = $query->row();

			if(isset($row->article_idx) == TRUE)
			{
				return $row->article_idx;
			}

			return FALSE;
		}
	}

//EOF