<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        define('BASE_URL', $this->config->item('base_url')); //여긴 MY_Controller 를 사용하지 않으므로 필요

        //기설치여부 확인
        if(file_exists(APPPATH . 'config/installed.txt') == TRUE)
        {
            exit;
        }
        else
        {
            if(!$this->uri->segment(3))
            {
                redirect('/admin/install/tapbbs', 'refresh');
            }
        }

        $this->hostname = $this->input->post('hostname');
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->database = $this->input->post('database');
        $this->port     = $this->input->post('port');
    }

    // --------------------------------------------------------------------

    /**
     * 기본 설치 가능 확인 페이지
     *
     * @author 배강민
     */
    public function tapbbs()
    {
        $data         = NULL;
        $post_success = FALSE;
        $error        = array();

        $data['BASE_URL'] = BASE_URL;

        $data = $this->check_default();

        $this->load->library('back_door_client');

        if($data['check_default'] == TRUE && $this->input->post('check_default') == '1')
        {
            $check_db = $this->check_db($this->hostname, $this->username, $this->password, $this->database, $this->port);

            $post_success = TRUE;

            if($check_db['version_usable'] == TRUE)
            {
                //write config/database.php
                $config_database_template = file_get_contents(APPPATH . 'config/database_template.php');
                $config_database          = str_replace(array(
                                                             '{hostname}',
                                                             '{username}',
                                                             '{password}',
                                                             '{database}',
                                                             '{dbdriver}',
                                                             '{port}'
                                                        ), array(
                                                                $this->hostname,
                                                                $this->username,
                                                                $this->password,
                                                                $this->database,
                                                                ($check_db['mysqli'] == TRUE ? 'mysqli' : 'mysql'),
                                                                $this->port
                                                           ), $config_database_template);
                $config_database_result   = FALSE;
                $config_database_result   = file_put_contents(APPPATH . 'config/database.php', $config_database);

                if($config_database_result === FALSE)
                {
                    $error[] = 'Failed Write config/database.php';
                }

                //write gd type
                $config_gd_template = file_get_contents(APPPATH . 'config/gd_template.php');
                $config_gd          = str_replace('{gd_type}', $data['gd_type'], $config_gd_template);
                $config_gd_result   = FALSE;
                $config_gd_result   = file_put_contents(APPPATH . 'config/gd.php', $config_gd);

                if($config_gd_result == FALSE)
                {
                    $error[] = 'Failed Write config/gd.php';
                }

                if($config_database_result == TRUE && $config_gd_result == TRUE)
                {
                    $this->load->database();

                    $this->load->model('install_model');

                    $this->db->trans_start();

                    //create table
                    $sql_create_table = file_get_contents('sql.create.table.txt');

                    //myisam vs innodb
                    if($check_db['innodb'] == TRUE && $this->input->post('engine') == 'INNODB')
                    {
                        $sql_create_table = str_replace('MyISAM', 'INNODB', $sql_create_table);
                    }

                    $create_table_result = $this->set_sql($sql_create_table);

                    if($create_table_result != TRUE) $error[] = 'Failed Create Table';

                    //create trigger
                    if($check_db['trigger'] == TRUE)
                    {
                        //create trigger
                        /*
                        $sql_create_trigger = file_get_contents('sql.create.trigger.txt');

                        $create_trigger_result = $this->db->query($sql_create_trigger);

                        if($create_trigger_result != TRUE) $error[] = 'Failed Create Trigger';
                        */

                        $trigger_array = array(
                                            'by_insert_bbs_article_revision',
                                            'by_update_bbs_article_revision',
                                            'by_insert_bbs_category_revision',
                                            'by_update_bbs_category_revision',
                                            'by_insert_bbs_comment_revision',
                                            'by_update_bbs_comment_revision',
                                            'by_insert_bbs_contents_revision',
                                            'by_update_bbs_contents_revision',
                                            'by_insert_bbs_setting_revision',
                                            'by_update_bbs_setting_revision',
                                            'by_insert_setting_revision',
                                            'by_update_setting_revision',
                                            'by_insert_users_group_revision',
                                            'by_update_users_group_revision'
                                        );

                        $trigger_error = 0;

                        foreach($trigger_array as $v)
                        {
                            $result = $this->install_model->{'create_trigger_' . $v}();

                            if($result != TRUE) $trigger_error++;
                        }

                        //write trigger usable
                        $config_trigger_template = file_get_contents(APPPATH . 'config/trigger_template.php');
                        if($trigger_error == 0)
                        {
                            $config_trigger = str_replace('{trigger_usable}', 'TRUE', $config_trigger_template);
                        }
                        else
                        {
                            $config_trigger = str_replace('{trigger_usable}', 'FALSE', $config_trigger_template);
                        }
                        $config_trigger_result   = FALSE;
                        $config_trigger_result   = file_put_contents(APPPATH . 'config/trigger.php', $config_trigger);
                    }

                    $sql_insert = file_get_contents('sql.insert.txt');

                    //update admin registration
                    $admin_id = $this->input->post('admin_id');
                    $admin_pw = $this->input->post('admin_pw');

                    if(empty($admin_id) OR empty($admin_pw))
                    {
                        $admin_id = 'admin';
                        $admin_pw = '111';
                    }

                    require_once APPPATH.'third_party/phpass-0.3/PasswordHash.php';

                    $hash = new PasswordHash(8, FALSE);
                    $super_secured_password = $hash->HashPassword($admin_pw);

                    $sql_insert = str_replace('\'admin\'', '\'' . $admin_id . '\'', $sql_insert);
                    //비번이 서버환경에 따라 달라지는 듯해서 설치시 변경한다.
                    $sql_insert = str_replace('\'$2a$08$fCCxXnMQ4wMXgvIkOg5n2u7v4qt8uXDa8eQhVj71Tp5dWZheK8rau\'', '\'' . $super_secured_password . '\'', $sql_insert);

                    //insert
                    $insert_result = $this->set_sql($sql_insert);

                    if($insert_result != TRUE) $error[] = 'Failed Insert Data';

                    $this->db->trans_complete();

                    //write installed.txt
                    if(!touch(APPPATH . 'config/installed.txt'))
                    {
                        $error[] = 'Failed Write config/installed.txt';
                    }
                }

                if(count($error) > 0)
                {
                    //실패로그 전송
                    $this->back_door_client->install_log('tapbbs', 0);

                    $data['message']  = join('<br />', $error);
                    $data['redirect'] = '/admin/install/tapbbs';

                    $this->layout->view_admin_only_contents('alert_view', $data);
                }
                else
                {
                    //성공로그 전송
                    $this->back_door_client->install_log('tapbbs', 1);

                    $data['message'] = 'Success Install';
                    $data['redirect'] = '/';

                    $this->layout->view_admin_only_contents('alert_view', $data);
                }

            }
            else
            {
                //실패로그 전송
                $this->back_door_client->install_log('tapbbs', 0);

                $data['message']  = 'ERROR';
                $data['redirect'] = '/admin/install/tapbbs';

                $this->layout->view_admin_only_contents('alert_view', $data);
            }
        }

        if($data['check_default'] !== TRUE && $data['curl_usable'] === TRUE)
        {
            //실패로그 전송
            $this->back_door_client->install_log('tapbbs', 0);
        }

        if($post_success == FALSE)
        {
            $this->layout->view_admin('install/tapbbs_view', $data);
        }
    }

    // --------------------------------------------------------------------

    /**
     * 통 sql 처리
     */
    private function set_sql($sql)
    {
        $error = 0;

        //$lines = file($filepath);
        $lines = explode("\n", $sql);
        // Loop through each line
        $templine = '';
        foreach ($lines as $line)
        {
            $line .= ' ';

            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
            {
                // Perform the query
                //mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                $result = $this->db->query($templine);
                if($result != TRUE) $error++;
                // Reset temp variable to empty
                $templine = '';
            }
        }

        return $error == 0 ? TRUE : FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * 기본 설치 가능 실제 확인
     *
     * @desc 실제 처리시에도 사용하기 위해 분리
     *
     * @author 배강민
     */
    private function check_default()
    {
        $data = NULL;

        //php version
        $data['php_version_usable'] = (version_compare(phpversion(), '5.1.6', '>=')) ? TRUE : FALSE;
        $data['php_version']        = phpversion();

        //curl
        $data['curl_usable']  = FALSE;
        $data['curl_version'] = NULL;

        if(function_exists('curl_version'))
        {
            $curl_version         = curl_version();
            $data['curl_usable']  = TRUE;
            $data['curl_version'] = $curl_version['version'];
        }

        //gd
        $data['gd_usable']  = FALSE;
        $data['gd_version'] = NULL;

        if(function_exists('gd_info'))
        {
            $gd                 = gd_info();
            $data['gd_usable']  = TRUE;
            $data['gd_version'] = $gd['GD Version'];

            $data['gd_type'] = 'gd';
            if(function_exists('imagecreatetruecolor'))
            {
                $data['gd_type'] = 'gd2';
            }
        }

        //timezone
        $timezone                = date_default_timezone_get();
        $data['timezone_usable'] = $timezone ? TRUE : FALSE;
        $data['timezone']        = $timezone;

        //mbstring
        $data['mbstring_usable'] = FALSE;

        if(function_exists('mb_strlen'))
        {
            $data['mbstring_usable'] = TRUE;
        }

        //chmod
        $data['chmod'] = $this->set_chmod();

        //최종 설치가능한지? DB 빼고..
        if($data['php_version_usable'] === TRUE && $data['curl_usable'] === TRUE && $data['gd_usable'] === TRUE && $data['timezone_usable'] === TRUE && $data['mbstring_usable'] === TRUE && $data['chmod']['error_cnt'] === 0)
        {
            $data['check_default'] = TRUE;
        }
        else
        {
            $data['check_default'] = FALSE;
        }

        return $data;
    }

    // --------------------------------------------------------------------

    /**
     * DB 연결 테스트 및 버젼 리턴 (AJAX)
     *
     * @author 배강민
     */
    public function test_db()
    {
        $result = $this->check_db($this->hostname, $this->username, $this->password, $this->database, $this->port);

        echo json_encode($result);
    }

    // --------------------------------------------------------------------

    /**
     * DB 연결 테스트 및 버젼 리턴
     *
     * @desc 실제 처리시에도 사용하기 위해 분리
     *
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * $param int port
     *
     * @author 배강민
     */
    private function check_db($hostname, $username, $password, $database, $port)
    {
        $port = ($port) ? $port : 3306;

        $return                    = array();
        $return['version']         = NULL;
        $return['version_require'] = '4.1'; //여기부터 서브쿼리 지원
        $return['version_usable']  = FALSE;
        $return['utf8']            = FALSE;
        $return['mysql']           = FALSE;
        $return['mysqli']          = FALSE;
        $return['innodb']          = FALSE;
        $return['trigger']         = FALSE;

        //mysql
        $mysql_connect = @mysql_connect($hostname . ':' . $port, $username, $password);
        if($mysql_connect)
        {
            mysql_query('SET NAMES utf8');

            $db_select = mysql_select_db($database, $mysql_connect);
            if($db_select)
            {
                $query  = mysql_query('SELECT version() AS version');
                $result = mysql_fetch_object($query);
                if($result)
                {
                    $return['version'] = $result->version;
                    $return['mysql']   = TRUE;
                }

                //innodb
                if($return['mysql'] == TRUE)
                {
                    $query  = mysql_query('SHOW VARIABLES LIKE \'have_innodb\'');
                    $result = mysql_fetch_object($query);
                    if($result && strtoupper($result->Value) == 'YES')
                    {
                        $return['innodb'] = TRUE;
                    }
                }

                //trigger
                if($return['mysql'] == TRUE)
                {
                    $query = mysql_query('CREATE TABLE test_tabbbs_install (test_tabbbs_install TINYINT)');
                    $query = mysql_query('CREATE TRIGGER test_tabbbs_install AFTER UPDATE ON test_tabbbs_install FOR EACH ROW BEGIN END');

                    if($query == TRUE)
                    {
                        $return['trigger'] = TRUE;
                    }

                    $query = mysql_query('DROP TABLE test_tabbbs_install');
                    $query = mysql_query('DROP TRIGGER test_tabbbs_install');
                }

                //utf8
                if($return['mysql'] == TRUE)
                {
                    $query  = mysql_query('SHOW VARIABLES LIKE \'character_set_client\'');
                    $result = mysql_fetch_object($query);

                    if($result && strtoupper($result->Value) == 'UTF8')
                    {
                        $return['utf8'] = TRUE;
                    }
                }
            }
        }
        @mysql_close($mysql_connect);

        //mysqli
        $mysqli_connect = @mysqli_connect($hostname, $username, $password, $database, $port);
        if($mysqli_connect)
        {
            $query  = mysqli_query($mysqli_connect, 'SELECT version() AS version');
            $result = mysqli_fetch_object($query);
            if($result)
            {
                $return['mysqli'] = TRUE;
            }
        }
        if($mysqli_connect) @mysqli_close($mysql_connect);

        if($return['version'])
        {
            if(version_compare($return['version'], $return['version_require'], '>='))
            {
                $return['version_usable'] = TRUE;
            }
        }

        return $return;
    }

    // --------------------------------------------------------------------

    /**
     * 폴더 필수 권한 수정
     *
     * @author 배강민
     */
    private function set_chmod()
    {
        $path     = array(
            'uploads',
            'avatars',
            'captcha',
            'application/cache',
            'application/config',
			'application/logs',
            //'application/third_party/htmlpurifier-4.5.0-standalone/standalone/HTMLPurifier/DefinitionCache/Serializer', //안쓰기로..
			'front_end/themes/mobile',
            'front_end/themes/mobile/default/_compile',
			'front_end/themes/pc',
            'front_end/themes/pc/default/_compile'
        );
        $path_cnt = count($path);

        $return              = array();
        $return['error_cnt'] = 0;

        for($i = 0; $i < $path_cnt; $i++)
        {
            @chmod($path[$i], 0777);
            $return['result'][$i]['path']  = FCPATH . $path[$i];
            $return['result'][$i]['chmod'] = substr(sprintf('%o', @fileperms($path[$i])), -4);

            $return['result'][$i]['status'] = TRUE;

            if((int)$return['result'][$i]['chmod'] !== 777 OR is_writable($path[$i] . '/test'))
            {
                $return['result'][$i]['status'] = FALSE;
                $return['error_cnt']++;
            }
        }

        return $return;
    }

    // --------------------------------------------------------------------

    //http://kr1.php.net/manual/vote-note.php?id=59573&page=function.phpinfo&vote=up
    private function parsePHPModules()
    {
        ob_start();
        phpinfo(INFO_MODULES);
        $s = ob_get_contents();
        ob_end_clean();

        $s        = strip_tags($s, '<h2><th><td>');
        $s        = preg_replace('/<th[^>]*>([^<]+)<\/th>/', "<info>\\1</info>", $s);
        $s        = preg_replace('/<td[^>]*>([^<]+)<\/td>/', "<info>\\1</info>", $s);
        $vTmp     = preg_split('/(<h2>[^<]+<\/h2>)/', $s, -1, PREG_SPLIT_DELIM_CAPTURE);
        $vModules = array();
        for($i = 1; $i < count($vTmp); $i++)
        {
            if(preg_match('/<h2>([^<]+)<\/h2>/', $vTmp[$i], $vMat))
            {
                $vName = trim($vMat[1]);
                $vTmp2 = explode("\n", $vTmp[$i + 1]);
                foreach($vTmp2 AS $vOne)
                {
                    $vPat  = '<info>([^<]+)<\/info>';
                    $vPat3 = "/$vPat\s*$vPat\s*$vPat/";
                    $vPat2 = "/$vPat\s*$vPat/";
                    if(preg_match($vPat3, $vOne, $vMat))
                    { // 3cols
                        $vModules[$vName][trim($vMat[1])] = array(
                            trim($vMat[2]),
                            trim($vMat[3])
                        );
                    }
                    elseif(preg_match($vPat2, $vOne, $vMat))
                    { // 2cols
                        $vModules[$vName][trim($vMat[1])] = trim($vMat[2]);
                    }
                }
            }
        }

        return $vModules;
    }
}

//EOF