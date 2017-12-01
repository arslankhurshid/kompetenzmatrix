<?php

class Migration_create_job_title_has_comp extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'job_title_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'competency_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'skill_value' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('job_title_has_comp');
    }

    public function down() {
        $this->dbforge->drop_table('job_title_has_comp');
    }

}
