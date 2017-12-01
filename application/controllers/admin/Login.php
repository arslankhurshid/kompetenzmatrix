<?php

Class Login extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function login() {
        // Redirect the user if already login 
        $dashboard = 'admin/login/login';
        $this->User_m->loggedin() == FALSE || redirect($dashboard);
        //set form
        $rules = $this->User_m->rules;
        $this->form_validation->set_rules($rules);
        // process form
        if ($this->form_validation->run() == TRUE) {
            if ($this->User_m->login() == TRUE) {
                $this->session->set_flashdata('success', "login successfully..!!");
                redirect(site_url('admin/dashboard'));
            } else {
                $this->session->set_flashdata('errors', "Sie müssen einen gültigen Usernamen und ein gültiges Passwort angeben.");
                redirect(site_url('admin/login/login'));
            }
        } else {
            $this->data['validation_error'] = validation_errors();
        }
        //load view
        $this->data['subview'] = 'admin/login/login';
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function logout() {
        $this->User_m->logout();
        redirect(site_url('admin/login/login'));
    }

}
