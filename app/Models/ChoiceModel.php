<?php 
namespace App\Models;

use CodeIgniter\Model;

class ChoiceModel extends Model{
    
    protected $table              = 'choices';
    protected $primaryKey         = 'idchoice';
    protected $useAutoIncrement   = true;
    protected $returnType         = 'array';
    protected $useSoftDeletes     = true;
    protected $allowedFields      = ['idchoicequestion','iscorrect','choice'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deletedchoice';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function deleteChoices($idquest){

        $this->where('idchoicequestion', $idquest)
             ->delete();

    }

    public function createChoices($choicesArray, $iscorrect, $idquestion){

        foreach ($choicesArray as $key => $choices){

            $correct = 0;
            if($key == ($iscorrect - 1)) $correct = 1;

            $dataChoice = [
                'idchoicequestion' => $idquestion,
                'iscorrect'        => $correct,
                'choice'           => $choices
            ];

            $this->insert($dataChoice);
        }

    }

    public function getChoices($idquestion){

        $choices = $this->where('idchoicequestion', $idquestion)
                        ->orderBy('idchoice')
                        ->findAll();

        return $choices;
    }

    public function getChoice($idchoice){

        $choice = $this->where('idchoice', $idchoice)
                       ->first();

        return $choice;

    }

    public function updateChoice($idchoice, $content){

        $this->set('choice', $content)
             ->where('idchoice', $idchoice)
             ->update();
    }

}
