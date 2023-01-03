<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Questions extends Migration{

    public function up(){

        $this->forge->addField([

            'idquestion'         => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false
            ],
            'idexamquestion' => [
                'type'       => 'INT',
                'null'       => false
            ],
            'question'       => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null'       => false
            ],
            'questionnumber' => [
                'type'       => 'INT',
                'null'       => false
            ],
            'deletedquestion' => [
                'type'        => 'DATE',
                'null'        => true
            ],
            'created_at'     => [
                'type'       => 'DATE',
                'null'       => true
            ],
            'updated_at'     => [
                'type'       => 'DATE',
                'null'       => true
            ]
        ]);
        
        $this->forge->addKey('idquestion', true);
        $this->forge->addForeignKey('idexamquestion', 'exams', 'idexam', 'CASCADE', 'CASCADE');
        $this->forge->createTable('questions');

    }

    public function down(){

        $this->forge->dropTable('questions');
    }
}

