<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exams extends Migration{

    public function up(){

        $this->forge->addField([

            'idexam'             => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false
            ],
            'title'          => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null'       => false
            ],
            'status'         => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => false
            ],
            'deletedexam'     => [
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
        
        $this->forge->addKey('idexam', true);
        $this->forge->createTable('exams');
        
    }

    public function down(){
        
        $this->forge->dropTable('exams');

    }
}
