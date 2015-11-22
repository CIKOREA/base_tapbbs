<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Onedayonememo_model extends CI_Model
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
		 * @since 2011.12.28
		 *
		 * @param array
		 *
		 * @return int (삽입 idx)
		 */
		public function insert($values)
		{
			$query = '
						INSERT INTO
							plugin_onedayonememo
							(
							user_idx
							, contents
							, point_gamble
							, point_random
							, point_insert
							, timestamp
							, client_ip
							)
						VALUES
							(
							?
							, ?
							, ?
							, ?
							, ?
							, UNIX_TIMESTAMP(NOW())
							, ?
							)
					';

			$query = $this->db->query($query, array(
													USER_INFO_idx
													, $values['contents']
													, $values['point_gamble']
													, $values['point_random']
													, $values['point_insert']
													, $this->input->ip_address()
													)
									);

			return $query;
		}

		// --------------------------------------------------------------------

        /**
         * 리스트
         *
         * @author KangMin
         * @since 2012.01.04
         *
         * @param int
         * @param int
         * @param int
         * @param string
         *
         * @return array
         */
		public function lists($page, $per_page, $add_where='')
		{
			$query = '
                        SELECT
                            ONEDAYONEMEMO.idx
                            , ONEDAYONEMEMO.user_idx
							    , USERS.user_id
							    , USERS.name
							    , USERS.nickname
                            , ONEDAYONEMEMO.contents
							    , ONEDAYONEMEMO.point_gamble
							    , ONEDAYONEMEMO.point_random
							    , ONEDAYONEMEMO.point_insert
                            , ONEDAYONEMEMO.timestamp
                            , ONEDAYONEMEMO.client_ip
                            , ONEDAYONEMEMO.is_deleted
                        FROM
                            plugin_onedayonememo AS ONEDAYONEMEMO
                            , tb_users AS USERS
                        WHERE
                            USERS.idx = ONEDAYONEMEMO.user_idx '.$add_where.'
						ORDER BY
                            ONEDAYONEMEMO.idx DESC
						LIMIT
							?, ?
					';

			$query = $this->db->query($query, array($page
													, $per_page));
			$rows = $query->result();

			return $rows;
		}

		// --------------------------------------------------------------------

        /**
         * 게시판 리스트 총 카운트
         *
         * @author KangMin
         * @since 2012.01.04
         *
         * @param int
         * @param string
         *
         * @return array
         */
		public function lists_total_cnt($add_where='')
		{
			$query = '
                        SELECT
                            COUNT(ONEDAYONEMEMO.idx) AS cnt
                        FROM
                            plugin_onedayonememo AS ONEDAYONEMEMO
                            , tb_users AS USERS
                        WHERE
                            USERS.idx = ONEDAYONEMEMO.user_idx '.$add_where.'
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
         * 해당회원의 마지막 글 등록 시각
         *
         * @author KangMin
         * @since 2012.01.08
         *
         * @return int
         */
        public function get_last_timestamp()
        {
            $query = '
                        SELECT
                            timestamp
                        FROM
                            plugin_onedayonememo
                        WHERE
                            user_idx = ?
                        ORDER BY
                            idx DESC
                        LIMIT
                            0, 1
                    ';

			$query = $this->db->query($query, array(USER_INFO_idx));
			$row = $query->row();

			if(count($row) > 0)
			{
				return (int)$row->timestamp;
			}

			return 0;
        }
	}

//EOF