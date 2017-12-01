<?php

Class User_m extends My_Model {

    protected $_table_name = 'kompetenzm.users';
    protected $_order_by = '';
    public $rules_admin = array(
        'fname' => array(
            'field' => 'fname',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'lname' => array(
            'field' => 'lname',
            'label' => 'Last Name',
            'rules' => 'trim|required|xss_clean'
        ),
    );
    public $rules = array(
        'user_name' => array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'user_hash' => array(
            'field' => 'user_hash',
            'label' => 'Password',
            'rules' => 'trim|required'),
    );

    public function __construct() {
        parent::__construct();
    }

    public function getUserCompetencies($id = null) {

        $query = $this->db->query("SELECT $this->_table_name.* ,t3.name as competency_name, t3.id as competency_id, t2.skill_value, t3.parent_id, t4.name as parent_competency_name
                                                        FROM $this->_table_name
                                                        LEFT JOIN kompetenzm.user_has_comp as t2 ON t2.user_id = $this->_table_name.id
                                                        LEFT JOIN kompetenzm.competency as t3 on t3.id = t2.competency_id
                                                        LEFT JOIN kompetenzm.competency as t4 on t4.id = t3.parent_id
                                                        WHERE $this->_table_name.id = '" . $id . "';
                                                        ");
        $results = $query->result_array();
        $array = array();
        foreach ($results as $res) {
            $array[$res['COMPETENCY_ID']] = $res['SKILL_VALUE'];
        }
        return $array;
    }

    // get user competencies for Diagram against user_id
    public function getUserCompArray($id = null) {
        $query = $this->db->query("SELECT t1.skill_value FROM kompetenzm.user_has_comp as t1
							LEFT JOIN kompetenzm.competency as t2
							on t1.competency_id = t2.id
							WHERE t1.user_id = '" . $id . "' order by t2.id ASC;
						");
        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['SKILL_VALUE'];
        }
        return $response;
    }

    // get all users competencies against job_title

    public function listUserCompArray($id = null) {

        // get all users competencies against job_title
        if ($id != 0) {
            $where = 'WHERE t3.id = ' . $id;
        } else {
            $where = '';
        }
        $query = $this->db->query("SELECT $this->_table_name.*, t2.skill_value FROM $this->_table_name
							LEFT JOIN kompetenzm.user_has_comp as t2 
							on t2.user_id = $this->_table_name.id
                                                        LEFT JOIN kompetenzm.job_title as t3 
							on $this->_table_name.job_title_id = t3.id
							$where
						");
        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[$val['FNAME'] . ' ' . $val['LNAME']][] = $val['SKILL_VALUE'];
        }
        return $response;
    }

    // get all user competencies for diagram
    public function getAllUserCompArray($id = null) {
        $query = $this->db->query("SELECT t1.skill_value FROM kompetenzm.user_has_comp as t1
							LEFT JOIN kompetenzm.competency  as t2
							on t1.competency_id = t2.id
							order by t2.id ASC;
						");
        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['SKILL_VALUE'];
        }
        return $response;
    }

    public function getUserJobCompetencies($id = null) {
        $query = $this->db->query("SELECT t1.id,t1.job_title_id,t3.skill_value,t3.competency_id FROM $this->_table_name as t1
                                                        LEFT JOIN kompetenzm.job_title as t2 ON t2.id = t1.job_title_id
                                                        LEFT JOIN kompetenzm.job_title_has_comp as t3 on t3.job_title_id = t2.id
                                                        WHERE t1.id = '" . $id . "' order by t3.competency_id ASC;
                                                        ");

        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['SKILL_VALUE'];
        }
        return $response;
    }

    public function get_user_view_details($limit = null, $perpage = null) {
        $query = $this->db->query("SELECT $this->_table_name.*,t2.title as user_title FROM $this->_table_name
                                                             LEFT JOIN kompetenzm.job_title as t2 ON t2.id=$this->_table_name.job_title_id
                                                             order by $this->_table_name.id DESC LIMIT $limit, $perpage");

        $results = $query->result_object();
        return $results;
    }

    public function get_newUser() {
        $users = new stdClass();
        $users->FNAME = '';
        $users->LNAME = '';
        $users->DOB = date('d.y.Y');
        $users->AUSBILDUNG = '';
        $users->ADDRESS = '';
        $users->JOB_TITLE_ID = 0;

        return $users;
    }

    public function get_users() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $query = $this->db->query("SELECT $this->_table_name.*, fname, lname, t2.title FROM $this->_table_name
                                                            LEFT JOIN kompetenzm.job_title as t2 on t2.id = $this->_table_name.job_title_id");
        $users = $query->result_object();
        $array = array('0' => 'Select');
        if (count($users)) {
            foreach ($users as $user) {
                $array[$user->TITLE][$user->ID] = $user->FNAME . " " . $user->LNAME;
            }
        }

        return $array;
    }

    public function login() {
        $user = $this->get_by(array(
            'user_name' => $this->input->post('user_name'),
            'user_hash' => $this->hash($this->input->post('user_hash'))
                ), TRUE);
        if (count($user)) {
            $data = array(
                'name' => $user->FNAME,
                'user_name' => $user->USER_NAME,
                'id' => $user->ID,
                'loggedin' => TRUE,
            );

            $this->session->set_userdata($data);
            return TRUE;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
    }

    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function lastInsertedID() {
        $query = $this->db->query("SELECT max(id) as id FROM $this->_table_name");
        $lastInsertedID = $query->row();
        return $lastInsertedID->ID;
    }

}
