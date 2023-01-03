<?php 
namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model{
    
    protected $table              = 'questions';
    protected $primaryKey         = 'idquestion';
    protected $useAutoIncrement   = true;
    protected $returnType         = 'array';
    protected $useSoftDeletes     = true;
    protected $allowedFields      = ['question','idexamquestion','questionnumber'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deletedquestion';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getQuestions($idexam){

        $totalQuestions = $this->join('exams', 'exams.idexam = questions.idexamquestion')
                               ->where('questions.idexamquestion', $idexam)
                               ->orderBy('idquestion', 'ASC')
                               ->findAll();

        return $totalQuestions;
    }

    public function createQuestion($idexam, $questioncontent, $total){

        $dataQuestion = [
            'idexamquestion'    => $idexam,
            'question'          => $questioncontent,
            'questionnumber'    => $total
        ];

        $this->insert($dataQuestion);

        $idquestion = $this->getInsertID();

        return $idquestion;

    }

    public function getExamTitle($idexam){

        $exam = $this->join('exams','exams.idexam = questions.idexamquestion')
                     ->where('questions.idexamquestion', $idexam)
                     ->first();

        return $exam['title'];

    }

    public function getTotalQuestions($idexam){

        $totalquestions = $this->where('questions.idexamquestion', $idexam)
                               ->countAllResults();

        return $totalquestions;

    }

    public function getExamQuestion($idexam, $idquest){

        $arrayData  = array('questionnumber' => $idquest,
                            'idexamquestion' => $idexam);

        $questions  = $this->where($arrayData)
                           ->first();

        return $questions;
    }

    public function getQuestionByContent($content){

        $res = $this->select('idquestion')
                    ->where('question', $content)
                    ->find();

        return $res;
    }

    public function deleteQuestion($idq, $ide){

        $arrayData  = array(
                        'idquestion'     => $idq,
                        'idexamquestion' => $ide
                    );
                            
        $this->where($arrayData)
             ->delete();

    }

    public function updateQuestion($arrayData, $content){

        $this->set('question', $content)
             ->where($arrayData)
             ->update();

    }
}
