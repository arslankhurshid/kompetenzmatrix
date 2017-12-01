<?php

Class Job_title_m extends My_Model {

    protected $_table_name = 'kompetenzm.job_title';
    protected $_order_by = '';
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
    );

    public function __construct() {
        parent::__construct();
    }

    public function getJobTitleCompetencies($id = null) {
        $query = $this->db->query("SELECT $this->_table_name.* ,t3.name as competency_name, t3.id as competency_id,t2.skill_value, t3.parent_id,t4.name as parent_competency_name
                                                        FROM $this->_table_name
                                                        LEFT JOIN kompetenzm.job_title_has_comp as t2 ON t2.job_title_id = $this->_table_name.id
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

    public function getJobsCompArray($id) {
        $query = $this->db->query("SELECT * FROM kompetenzm.job_title_has_comp WHERE kompetenzm.job_title_has_comp.job_title_id = '" . $id . "' order by kompetenzm.job_title_has_comp.competency_id ASC;");

        $result = $query->result_array();
        $response = array();
        foreach ($result as $key => $val) {
            $response[] = $val['SKILL_VALUE'];
        }
        return $response;
    }

    public function get_job_title_competencies($id = null, $single = null) {

        $query = $this->db->query("SELECT $this->_table_name.* ,t3.name as competency_name, t4.name as parent_competency_name
                                                        FROM $this->_table_name
                                                        LEFT JOIN kompetenzm.job_title_has_comp as t2 ON t2.job_title_id = $this->_table_name.id
                                                        LEFT JOIN kompetenzm.competency as t3 on t3.id = t2.competency_id
                                                        LEFT JOIN kompetenzm.competency as t4 on t4.id = t3.parent_id                                                       
                                                        ;");
        $results = $query->result_array();
        $array = array();
        $finalArray = array();
        foreach ($results as $page) {
            $array[$page['ID']][] = $page['COMPETENCY_NAME'];
        }
        foreach ($array as $key => $arr) {
            $data[$key]['COMPETENCY_NAME'] = implode(',', $arr);
        }

        foreach ($results as $result) {
            $anotherArray[$result['ID']] = array(
                'ID' => $result['ID'],
                'TITLE' => $result['TITLE'],
                'PARENT_COMPETENCY_NAME' => $result['PARENT_COMPETENCY_NAME'],
            );
        }
        $res = array();
        foreach ($data as $k => $v) {
            $res[$k] = array_merge($data[$k], $anotherArray[$k]);
        }
        return $res;
    }

    public function get_newTitle() {
        $job_title = new stdClass();
        $job_title->TITLE = '';
        return $job_title;
    }

    public function get_job_titles() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $query = $this->db->query("SELECT id,title FROM $this->_table_name");
        $job_titles = $query->result_array();
        $array = array(0 => 'Keine');
        if (count($job_titles)) {
            foreach ($job_titles as $job_title) {
                $array[$job_title['ID']] = $job_title['TITLE'];
            }
        }
        return $array;
    }

    public function lastInsertedID() {
        $query = $this->db->query("SELECT max(id) as id FROM $this->_table_name");
        $lastInsertedID = $query->row();
        return $lastInsertedID->ID;
    }

}
