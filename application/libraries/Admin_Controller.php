<?php

class Admin_Controller extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->data['meta_title'] = 'Kompetenz Matrix';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('User_m');
        $this->load->library('session');
        $this->load->helper('security');

        //login check
        $exception_uri = array('admin/login/login', 'admin/login/logout');
        if (!in_array(uri_string(), $exception_uri)) {
            if ($this->User_m->loggedin() == FALSE) {
                redirect('admin/login/login');
            }
        }
    }

}
