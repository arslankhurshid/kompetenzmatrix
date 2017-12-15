<?php

Class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_m');
        $this->load->model('Competency_m');
        $this->load->model('User_has_comp_m');
        $this->load->model('Job_title_m');
        $this->load->model('Skills_m');
    }

    function index() {

        $total_records = $this->User_m->get_total();
        $limit = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $perpage = 4;
        if ($total_records > 0) {
            $this->data['users'] = $this->User_m->get_user_view_details($limit, $perpage);
            $config['base_url'] = base_url() . 'admin/dashboard/index';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 4;

            $this->pagination->initialize($config);
            $this->data['links'] = $this->pagination->create_links();
        } else {
            $this->data['links'] = '';
        }
        //Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function modal() {
        $this->load->view('admin/_layout_modal.php', $this->data['subview']);
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->data['user'] = $this->User_m->get($id);
            if (empty($this->data['user']))
                $this->data['errors'][] = "User could not be found";
        }
        else {
            $this->data['user'] = $this->User_m->get_newUser();
        }

        $rules = $this->User_m->rules_admin;

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->User_m->array_from_post(array(
                'fname',
                'lname',
                'job_title_id',
                'dob',
                'address',
                'ausbildung',
            ));

            $this->User_m->save($data, $id);
            if ($id)
                $lastInsertedID = $id;
            else
                $lastInsertedID = $this->User_m->lastInsertedID();

            if (isset($_POST) && !empty($_POST['competencies'])) {
                $competencies = $_POST['competencies'];
                if (!empty($competencies)) {
                    $this->deleteUserComp($id);
                    foreach ($_POST['competencies'] as $k => $v) {
                        // get the sub comp
                        if (isset($_POST['competency-' . $v]) && $_POST['competency-' . $v]) {
                            if (empty($lastInsertedID))
                                $lastInsertedID = $id;
                            $this->User_has_comp_m->save(array(
                                'user_id' => $lastInsertedID,
                                'competency_id' => $v,
                                'skill_value' => $_POST['competency-' . $v][0],
                            ));
                        }
                    }
                }
            }
            redirect(site_url('admin/dashboard'));
        }
        else {
            $this->data['validation_error'] = validation_errors();
        }
        $this->data['subview'] = 'admin/user/edit';
        $this->data['job_title'] = $this->Job_title_m->get_job_titles();
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function deleteUserComp($id) {
        $this->User_has_comp_m->deleteUserComp($id);
    }

    public function delete($id) {

        $this->User_m->delete($id);
        $this->deleteUserComp($id);
        redirect(site_url('admin/dashboard'));
    }

    public function order_competency($user_id = null, $job_id = null) {
//        echo $user_id . '/' . $job_id;
//        exit();
        $this->data['jobCompArray'] = $this->Skills_m->getJobTitleComp($job_id);
        $this->data['skills'] = $this->Skills_m->skillArray();
        $this->data['selectedArray'] = $this->User_m->getUserCompetencies($user_id);
        $this->data['compArray'] = $this->Competency_m->getParentChild();
        $this->load->view('admin/user/order_competency', $this->data);
    }

}
