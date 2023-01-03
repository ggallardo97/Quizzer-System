<?php 
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class StudentExamModel extends Model{
    
    protected $table              = 'studentexam';
    protected $primaryKey         = 'idstudexam';
    protected $useAutoIncrement   = true;
    protected $returnType         = 'array';
    protected $useSoftDeletes     = true;
    protected $allowedFields      = ['idstudent','idexamse','dateexam','timeexambegin','timeexamend','score'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deletedstudentexam';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function registerScore($iduser, $score, $timestart, $idexam){
        
        $result = [
            'idstudent'     => $iduser,
            'idexamse'      => $idexam,
            'dateexam'      => date('Y-m-d'),
            'timeexambegin' => $timestart,
            'timeexamend'   => new Time('now', 'America/Argentina/Salta'),
            'score'         => $score
        ];

        $this->insert($result);

    }

    public function getScores(){

        $scores = $this->select('username, userlastname, score, dateexam, timeexambegin, timeexamend, title, count(question) as totalq')
                       ->join('users', 'users.iduser = studentexam.idstudent')
                       ->join('exams', 'exams.idexam = studentexam.idexamse')
                       ->join('questions', 'questions.idexamquestion = studentexam.idexamse')
                       ->groupBy('username, userlastname, score, dateexam, timeexambegin, timeexamend, title')
                       ->find();
                       
        return $scores;

    }

    public function findExam($arrayData){

        $finishedExam = $this->where($arrayData)
                             ->first();

        return $finishedExam;

    }
}
