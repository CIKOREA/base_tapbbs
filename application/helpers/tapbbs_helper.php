<?php  if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

    if(!function_exists('name'))
    {
        /**
         * 이름 표출 형태 변경
         *
         * @author KangMin
         *
         * @param string
         * @param string
         * @param string
         *
         * @return string
         */
        function name($user_id, $name, $nickname)
        {
            return str_replace(array(
                                    '{user_id}',
                                    '{name}',
                                    '{nickname}'
                               ), array(
                                       $user_id,
                                       $name,
                                       $nickname
                                  ), SETTING_view_name_type);
        }
    }

    // --------------------------------------------------------------------

    if(!function_exists('time2date'))
    {
        /**
         * 날짜 표출 형태 변경
         *
         * @author KangMin
         *
         * @param int $time
         * @param string $datetime_type
         *
         * @return string
         */
        function time2date($time, $datetime_type = SETTING_datetime_type)
        {
            $return = '';

            if(IS_USER_LOGIN === TRUE)
            {
                if (!empty($time)) {
                    $return = date($datetime_type, $time - (gmt_to_local($time, SETTING_default_timezone, FALSE) - gmt_to_local($time, USER_INFO_timezone, FALSE)));
                }
            }
            else
            {
                if(!empty($time))
                {
                    $return = date($datetime_type, $time);
                }

            }

            return $return;
        }
    }

    // --------------------------------------------------------------------

    if(!function_exists('delete_session'))
    {
        /**
         * 세션삭제
         *
         * @author KangMin
         *
         * @return null
         */
        function delete_session()
        {
            $CI =& get_instance();

            $CI->session->set_userdata(array('user_cookie' => ''));
            $CI->session->sess_destroy();
        }
    }

    // --------------------------------------------------------------------

    if(!function_exists('unset_empty_array'))
    {
        /**
         * 배열 중 공백 '' 인건 지우기
         * 1차 배열만 지원
         *
         * @author KangMin
         *
         * @param array
         *
         * @return array
         */
        function unset_empty_array($array)
        {
            if(!is_array($array))
            {
                return $array;
            }

            foreach($array as $k => $v)
            {
                if(trim($v) == '')
                {
                    unset($array[$k]);
                }
            }

            return $array;
        }
    }

    // --------------------------------------------------------------------

    if(!function_exists('get_group_icon'))
    {
        /**
         * 그룹아이콘을 호출하는 헬퍼
         *
         * @desc 이를 위해 계속 쿼리날리는건 아니라 판단해서 후킹으로 1회 모든 그룹 아이콘을 define하고 그걸 이용해서 리턴한다.
         *
         * @author KangMin
         * @since 2012.03.14
         *
         * @return mixed 없으면 FALSE, 있으면 설정 경로
         */
        function get_group_icon($group_idx)
        {
            if(!defined('GROUP_ICON'))
            {
                return FALSE;
            }

            $group_icon = unserialize(GROUP_ICON);

            if(isset($group_icon[$group_idx]) == TRUE)
            {
                return $group_icon[$group_idx];
            }
            else
            {
                return FALSE;
            }
        }
    }

    // --------------------------------------------------------------------

    if(!function_exists('cut_string'))
    {
        /**
         * 글자수 자르기
         *
         * @author KangMin
         * @since 2012.06.01
         *
         * @param string
         * @param int
         *
         * @return string
         */
        function cut_string($string, $length, $string_after_cut_length = SETTING_string_after_cut_length)
        {
            if(mb_strlen($string) > $length && (int)$length !== 0)
            {
                return mb_substr($string, 0, $length) . $string_after_cut_length;
                //return character_limiter($string, $length, $string_after_cut_length); //이건 좀 이상타..
            }
            else
            {
                return $string;
            }
        }
    }

//EOF