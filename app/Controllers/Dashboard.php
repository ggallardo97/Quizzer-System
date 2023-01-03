<?php

namespace App\Controllers;

class Dashboard extends BaseController{

    public function index(){

        if($_SESSION['user']['category'] === 'teacher') return redirect()->to(base_url('exams'));
        else return redirect()->to(base_url('student'));

	}

    public function showExams(){

        if($_SESSION['user']['category'] === 'teacher'){

            $exams = $this->examModel->getExams();
                
            $data['exams'] = $exams;
                
            $this->loadviews->loadViews('showExams', $data);
            
        }else return redirect()->to(base_url('student'));

    }

    public function showQuestions(){

        if($_SESSION['user']['category'] === 'teacher'){

            if(isset($_GET['idexam'])){

                $idexam             = $_GET['idexam'];
                $totalQuestions     = $this->questionModel->getQuestions($idexam);
                $data['questions']  = $totalQuestions;

                $this->loadviews->loadViews('showQuestions', $data);

            }else return redirect()->to(base_url('exams'));

        }else return redirect()->to(base_url('student'));

    }

    public function deleteQuestion(){

        if(isset($_POST)){

            try{

                $this->questionModel->deleteQuestion($_POST['id'], $_POST['idexam']);

                $this->choiceModel->deleteChoices($_POST['id']);

                $status = 'OK';

            }catch(\Exception $e){

                die($e->getMessage());
            }

        }else $status = 'ERROR';

        echo $status;
    }

    public function editQuestion(){

        if(isset($_POST)){
            
            try{

                $arrayData = array('idquestion'     => $_POST['id'],
                                   'idexamquestion' => $_POST['idexam']);

                $this->questionModel->updateQuestion($arrayData, $_POST['content']);

                $status = 'OK';

            }catch(\Exception $e){

                die($e->getMessage());
            }

        }else $status = 'ERROR';

        echo $status;

    }

    public function studentExams(){

        $totalExams    = $this->examModel->findAll();

        $data['exams'] = $totalExams;

        $this->loadviews->loadViews('studentExams', $data);
                
    }

    public function isAFinishedExam($idexam){

        $arrayData    = array('idstudent' => $_SESSION['user']['iduser'],
                              'idexamse'  => $idexam);

        $finishedExam = $this->studentexamModel->findExam($arrayData);      

        return $finishedExam;
    }

    public function examStart(){

        if($_SESSION['user']['category'] === 'teacher') return redirect()->to('dashboard/showExams');
        else{

            if($_GET['idexam']){

                $idexam         = $_GET['idexam'];
                $data['title']  = $this->questionModel->getExamTitle($idexam);
                $finishedExam   = $this->isAFinishedExam($idexam);

                if($finishedExam){ 

                    $data['score']  = $finishedExam['score'];
                    $data['totalq'] = $this->questionModel->getTotalQuestions($idexam);

                    return $this->loadviews->loadViews('examFinished', $data);

                }else{

                    $totalquestions = $this->questionModel->getTotalQuestions($idexam);
                    $data['totalq'] = $totalquestions;
                    $data['idexam'] = $idexam;
                   
                    $this->loadviews->loadViews('index', $data);
                }
            }
        }
    }

    public function changeExamState(){

        if($_POST){

            try{
                $idexam = $_POST['idexam'];
                $exam   = $this->examModel->getExamByID($idexam);

                if($exam['status'] === 'ready') $this->examModel->downExam($idexam);
                else $this->examModel->upExam($idexam); 

                echo 'OK';

            }catch(\Exception $e){

                die($e->getMessage());
            }

        }else echo 'ERROR';

    }

    public function question(){

        if($_GET['idq'] && $_GET['idexam']){

            if(!isset($_SESSION['timestart'])){
                $_SESSION['timestart'] = date('H:i:s', time());
            }

            $idexam             = $_GET['idexam'];
            $idquest            = $_GET['idq'];
            $data['questions']  = $this->questionModel->getExamQuestion($idexam, $idquest);
            $idq                = $data['questions']['idquestion'];
            $data['choices']    = $this->choiceModel->getChoices($idq);
            $data['totalq']     = $this->questionModel->getTotalQuestions($idexam);
            $data['idq']        = $idquest;
            $data['idexam']     = $idexam;
                
            $this->loadviews->loadViews('question', $data); 
        }
    }

    public function process(){

        if(isset($_POST)){

            if(!isset($_SESSION['score'])){
                $_SESSION['score'] = 0;
            }

            if(isset($_POST['idexam'])){

                $idexam         = $_POST['idexam'];
                $totalquestions = $this->questionModel->getTotalQuestions($idexam);

                $select = $_POST['question_id'];
                $nextq  = $_POST['next_question'];
                $nextq++;

                $choice = $this->choiceModel->getChoice($select);

                if($choice['iscorrect'] == 1) $_SESSION['score']++;

                $data['correct'] = $_SESSION['score'];

                if($nextq > $totalquestions){

                    $this->studentexamModel->registerScore($_SESSION['user']['iduser'], $_SESSION['score'], $_SESSION['timestart'], $idexam);
                    
                    unset($_SESSION['score']);
                    unset($_SESSION['timestart']);

                    $this->loadviews->loadViews('final', $data);

                }else return redirect()->to('question?idq='.$nextq.'&idexam='.$idexam);

            }
        }
    }

    public function addQuestion(){

        if($_SESSION['user']['category'] === 'teacher'){

            if($_GET['idexam']){

                $data['right']  = 0;
                $data['wrong']  = 0;
                $idexam         = $_GET['idexam'];
                $data['idexam'] = $idexam;
                
                if(isset($_POST)){

                    if($this->validation->run($_POST, 'question')){

                        $total = $this->questionModel->getTotalQuestions($idexam);
                        $total++;

                        $res = $this->questionModel->createQuestion($idexam, $_POST['question_text'], $total);

                        if($res) $data['right'] = 1;
                        else $data['wrong'] = 1;

                        $this->choiceModel->createChoices($_POST['choices'], $_POST['iscorrect'], $res);

                    }else{
                        $errors        = $this->validation->getErrors();
                        $data['error'] = $errors;
                        
                    }
                    $this->loadviews->loadViews('add', $data);

                }else $this->loadviews->loadViews('add', $data);

            }else return redirect()->to(base_url('exams'));

        }else return redirect()->to(base_url('student'));
    }

    public function addExam(){

        if($_SESSION['user']['category'] === 'teacher'){

            if(isset($_POST)){

                if($this->validation->run($_POST, 'exam')){

                    $this->examModel->createExam($_POST['title']);

                    $status = 'OK';

                }else $status = 'ERROR';
                    
            }else $status = 'ERROR';

            echo $status;

        }else return redirect()->to(base_url('student'));

    }

    public function showScores(){

        if($_SESSION['user']['category'] === 'teacher'){

            $scores         = $this->studentexamModel->getScores();
            $data['scores'] = $scores;

            $this->loadviews->loadViews('showScores', $data);
                
        }else return redirect()->to(base_url('student'));

    }

    public function editChoice(){

        if($_SESSION['user']['category'] === 'teacher'){
            
            if(isset($_POST)){

                try{

                    $this->choiceModel->updateChoice($_POST['idchoice'], $_POST['content']);

                    $status = 'OK';

                }catch(\Exception $e){
            
                    die($e->getMessage());
                    
                }

            }else $status = 'ERROR';

            echo $status;

        }else return redirect()->to(base_url('student'));

    }

    public function showChoices(){

        if($_SESSION['user']['category'] === 'teacher'){

            if(isset($_POST)){

                try{

                    $choices = $this->choiceModel->getChoices($_POST['idquestion']);

                    foreach($choices as $key => $row){

                        echo '<label>Choice ['.($key + 1).']';
                        if($row['iscorrect']){
                            echo ' -> Correct';
                            echo '</label>';
                            echo '<button data-idchoice="'.$row['idchoice'].'" style="margin-left: 285px;" class="btn btn-primary btn-sm fa fa-edit editChoicesButton"></button>';
                        }else{
                            echo '</label>';
                            echo '<button data-idchoice="'.$row['idchoice'].'" style="margin-left: 363px;" class="btn btn-primary btn-sm fa fa-edit editChoicesButton"></button>';
                        }
                        
                        echo '<input type="text" class="form-control" data-idchoice="'.$row['idchoice'].'" id="choiceContent'.$row['idchoice'].'" value="'.$row['choice'].'" required/>';
                    }
                }catch(\Exception $e){
        
                    die($e->getMessage());
                }
            }
        }else return redirect()->to(base_url('student'));
    }
}