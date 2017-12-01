<?php

Class Migration extends Admin_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->library('migration');
    }

    function index() {
//        error_reporting(E_ALL);
        $this->load->library('migration');
//        $this->load->library('migration');
//        echo $migration = $this->migration->version();
        if (!$this->migration->current()) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration worked";
        }
    }

}
