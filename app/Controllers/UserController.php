<?php

namespace App\Controllers;

class UserController extends BaseController{

    public function validatePassword($email, $userpassword){

        $user = $this->userModel->getUser($email);

        if($user){

            $passw = preg_replace('([^A-Za-z0-9])', '', $userpassword);

            return password_verify($passw, $user['userpassword']);

        }else return false;

    }

    public function createUserSession($email, $userpassword){

        if($this->validatePassword($email, $userpassword)){

            $user = $this->userModel->getUser($email);

            $_SESSION['user']['username']      = $user['username'];
            $_SESSION['user']['userlastname']  = $user['userlastname'];
            $_SESSION['user']['iduser']        = $user['iduser'];
            $_SESSION['user']['category']      = $user['category'];

            if($user['category'] === 'teacher') return redirect()->to(base_url('exams'));
            else return redirect()->to(base_url('student'));

        }else{
            $data['error']  = 'error';
            $this->loadviews->loadViews('login', $data);
        }
    }

    public function loginUser(){

        if(isset($_SESSION['user'])){

            if($_SESSION['user']['category'] === 'teacher') return redirect()->to(base_url('exams'));
            else return redirect()->to(base_url('student'));

        }else{

            if($_POST){

                if($this->validation->run($_POST, 'login')){

                    return $this->createUserSession($_POST['email'], $_POST['userpassword']);

                }else{
                    
                    $errors         = $this->validation->getErrors();
                    $data['error']  = $errors;
                    $this->loadviews->loadViews('login', $data);
                }
            }else{
                $this->loadviews->loadViews('login');
            }
        }
    }

    public function logout(){

        unset($_SESSION['user']);
        session_destroy();

        return redirect()->to(base_url('login'));
    }

    public function registerUser(){

        if($_POST){

            if($this->validation->run($_POST, 'register')){

                try{

                    $this->userModel->createUser($_POST);
                    
                    return $this->createUserSession($_POST['email'], $_POST['userpassword']);

                }catch(\Exception $e){
        
                    die($e->getMessage());
                    //throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                
            }else{
                $errors         = $this->validation->getErrors();
                $data['error']  = $errors;
                $this->loadviews->loadViews('register', $data);
            }
        }else{
            $this->loadviews->loadViews('register');
        }
    }
}