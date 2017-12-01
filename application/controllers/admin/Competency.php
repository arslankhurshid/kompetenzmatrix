<?php

Class Competency extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Competency_m');
    }

    function index() {

        $total_records = $this->Competency_m->get_total();
        $limit = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $perpage = 8;
        if ($total_records > 0) {
            $this->data['competencies'] = $this->Competency_m->get_with_parent($limit, $perpage);
            $config['base_url'] = base_url() . 'admin/competency/index';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 4;

            $this->pagination->initialize($config);
            $this->data['links'] = $this->pagination->create_links();
        } else {
            $this->data['links'] = '';
        }

        //Load view
        $this->data['subview'] = 'admin/competency/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function modal() {
        $this->load->view('admin/_layout_model.php', $this->data['subview']);
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->data['competency'] = $this->Competency_m->get($id);
            if (empty($this->data['competency']))
                $this->data['errors'][] = "Competency could not be found";
        }
        else {
            $this->data['competency'] = $this->Competency_m->get_new();
        }

        // competency for drop down menu
        $this->data['competency_without_parents'] = $this->Competency_m->get_no_parents($id);
        $rules = $this->Competency_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->Competency_m->array_from_post(array('name', 'parent_id'));
            $this->Competency_m->save($data, $id);
            redirect(site_url('admin/competency'));
        } else {
            $this->data['validation_error'] = validation_errors();
        }
        $this->data['subview'] = 'admin/competency/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {

        $this->Competency_m->delete($id);
        redirect(site_url('admin/competency'));
    }

    public function order() {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/competency/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function order_ajax() {
        // save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->Competency_m->save_order($_POST['sortable']);
        }

        $this->data['competencies'] = $this->Competency_m->get_nested();
        $this->load->view('admin/competency/order_ajax', $this->data);
    }

}
