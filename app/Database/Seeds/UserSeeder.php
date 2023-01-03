<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder{

    public function run(){

        $teacher = [
            'username'     => 'Teacher',
            'userlastname' => 'Name',
            'email'        => 'teacher@email.com',
            'userpassword' => '$2y$10$cjG3oXG9RKBZAUSU.dq12.fRn12/f6/3GN7wXoO47U/fMgQbTqC9a', //holamundo
            'category'     => 'teacher'
        ];

        $this->db->table('users')->insert($teacher);
        
    }

}
