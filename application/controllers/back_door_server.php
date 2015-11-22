<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Back_door_server extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    // --------------------------------------------------------------------

    /**
     * 인스톨 로그 적재
     */
    public function install_log()
    {
        $this->load->model('back_door_server_model');

        if($this->back_door_server_model->check_project_code($this->input->post('project_code')) == TRUE)
        {
            $this->back_door_server_model->insert_install_log($_POST);
        }
    }
}

//EOF