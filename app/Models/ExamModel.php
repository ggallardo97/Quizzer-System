<?php 
namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model{
    
    protected $table              = 'exams';
    protected $primaryKey         = 'idexam';
    protected $useAutoIncrement   = true;
    protected $returnType         = 'array';
    protected $useSoftDeletes     = true;
    protected $allowedFields      = ['title','status'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deletedexam';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getExams(){

        $exams = $this->findAll();

        return $exams;

    }

    public function createExam($title){

        $dataExam = [
            'title'  => $title,
            'status' => 'not ready'
        ];

        $this->insert($dataExam);

    }

    public function getExam($title){

        $res = $this->select('idexam')
                    ->where('title', $title)
                    ->first();
                    
        return $res;

    }

    public function getExamByID($idexam){

        $exam  = $this->where('idexam', $idexam)
                      ->first();

        return $exam;

    }

    public function downExam($idexam){

        $this->set('status', 'not ready')
             ->where('idexam', $idexam)
             ->update();

    }

    public function upExam($idexam){

        $this->set('status', 'ready')
             ->where('idexam', $idexam)
             ->update();

    }

}
