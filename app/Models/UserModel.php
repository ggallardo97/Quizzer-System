<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    
    protected $table              = 'users';
    protected $primaryKey         = 'iduser';
    protected $useAutoIncrement   = true;
    protected $returnType         = 'array';
    protected $useSoftDeletes     = true;
    protected $allowedFields      = ['username','userlastname','email','userpassword','category','deletedu'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deletedu';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getUser($email){

        $user = $this->where('email', $email)
                     ->first();

        return $user;
    }

    public function createUser($dataUser){

        $hashPassword = password_hash($dataUser['userpassword'], PASSWORD_DEFAULT);

        $dataUser['userpassword'] = $hashPassword;

        $this->insert($dataUser);

    }
}
