<?php

class Migration_create_competency extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
            'order' => array(
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'parent_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('competency');
    }

    public function down() {
        $this->dbforge->drop_table('competency');
    }

}
