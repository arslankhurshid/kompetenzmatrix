<?php

Class Job_title_has_comp_m extends My_Model {

    protected $_table_name = 'kompetenzm.job_title_has_comp';
    protected $_order_by = '';
    public $rules = array();

    public function __construct() {
        parent::__construct();
    }

    public function deleteJobComp($id) {
        if (!$id) {
            return FALSE;
        }
        $where = 'job_title_id =' . $id;
        $query = $this->db->query("DELETE $this->_table_name WHERE $where");
    }

}
