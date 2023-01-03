<?php 

namespace App\Libraries;

class LoadViews{

    public function loadViews($view = null, $data = null){

        if($data){

            echo view('includes/header', $data);
            echo view($view, $data);
            echo view('includes/footer', $data);

        }else{

            echo view('includes/header');
            echo view($view);
            echo view('includes/footer');
        }

    }
}