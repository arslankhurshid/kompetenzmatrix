<?php

Class User_has_comp_m extends My_Model {

    protected $_table_name = 'kompetenzm.user_has_comp';
    protected $_order_by = '';
    public $rules = array();
    public $rules_admin = array();

    public function __construct() {
        parent::__construct();
    }

    public function deleteUserComp($id) {
        if (!$id) {
            return FALSE;
        }
        $query = $this->db->query("DELETE FROM $this->_table_name WHERE user_id = '$id'");
    }

}
