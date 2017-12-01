<?php

Class Chart extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_m');
        $this->load->model('Job_title_m');
        $this->load->model('Competency_m');
        $this->load->model('Skills_m');
    }

    function index($id = null) {

        $this->data['users'] = $this->User_m->get_users();
        $this->data['titles'] = $this->Job_title_m->get_job_titles();
        $this->data['competency_labels'] = json_encode($this->Competency_m->getLabels());
        //Load view
        $this->data['subview'] = 'admin/chart/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }

    function getCompetency($id = null) {

        $this->data['competency_labels'] = $this->Competency_m->getLabels();
        $this->data['userCompArray'] = $this->User_m->getUserCompArray($id);
        $this->data['jobsCompArray'] = $this->User_m->getUserJobCompetencies($id);
        echo json_encode($this->data);
    }

    function viewUsersChart($id = null) {
        $this->data['competency_labels'] = $this->Competency_m->getLabels();
        $this->data['listUser'] = $this->User_m->listUserCompArray($id);
        $this->data['jobsCompArray'] = $this->Job_title_m->getJobsCompArray($id);

        if (isset($this->data['listUser']) && !empty($this->data['listUser'])) {
            foreach ($this->data['listUser'] as $key => $val) {
                $datasets[] = [
                    'label' => $key,
                    'borderColor' => "#00FF00",
                    'borderWidth' => 0.1,
                    'data' => $val,
                ];
            }

            $secondaryDatset[] = array(
                'label' => "Stellenanforderungen",
                'borderColor' => "rgba(200,0,0,0.6)",
                'backgroundColor' => "rgba(0,0,0,0)",
                'borderWidth' => 2,
                'data' => $this->data['jobsCompArray']
            );


            $finaldatasets = array_merge($secondaryDatset, $datasets);
        } else {
            $finaldatasets[] = array(
                'label' => "Stellenanforderungen",
                'borderColor' => "rgba(200,0,0,0.6)",
                'backgroundColor' => "rgba(0,0,0,0)",
                'borderWidth' => 2,
                'data' => $this->data['jobsCompArray']
            );
        }

        echo json_encode($finaldatasets);
    }

}
