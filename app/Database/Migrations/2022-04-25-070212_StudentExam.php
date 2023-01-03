<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StudentExam extends Migration{

    public function up(){

        $this->forge->addField([

            'idstudentexam'      => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false
            ],
            'idstudent'   => [
                'type'    => 'INT',
                'null'    => false
            ],
            'idexamse'    => [
                'type'    => 'INT',
                'null'    => false
            ],
            'dateexam'    => [
                'type'    => 'DATE',
                'null'    => false
            ],
            'timeexambegin' => [
                'type'      => 'TIME',
                'null'      => false
            ],
            'timeexamend' => [
                'type'    => 'TIME',
                'null'    => false
            ],
            'score'      => [
                'type'   => 'INT',
                'null'   => false
            ],
            'deletedstudentexam' => [
                'type'           => 'DATE',
                'null'           => true
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
        
        $this->forge->addKey('idstudentexam', true);
        $this->forge->addForeignKey('idstudent', 'users', 'iduser', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idexamse', 'exams', 'idexam', 'CASCADE', 'CASCADE');
        $this->forge->createTable('studentexam');
        
    }

    public function down(){

        $this->forge->dropTable('studentexam');
        
    }
}

