<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends MainController
{

    public function renderUser()    
    {   
        if($this->view === 'logout'){
            $this->logout();
        }else{
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST["registerForm"])) {
                    $this->register();
                } elseif (isset($_POST["loginForm"])) {
                    $this->login();
                }
            }
        }

        $this->render();
    }

    public function register()
    {

        $errors = 0;
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $name = filter_input(INPUT_POST, 'name');
            

        if (!$email || !$password || !$name) {
            $errors = 1;
            $this->data[] = '<div class="alert alert-danger" role="alert">Tous les champs sont obligatoires</div>';
        }

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);    
        if ($email === false) {
            $this->data[] = '<div class="alert alert-danger" role="alert">Le format de l\'email n\'est pas valide.</div>';
            $errors = 1;
        }

        if (strlen($password) < 8) {
            $this->data[] = '<div class="alert alert-danger" role="alert">Le mot de passe doit contenir au moins 8 caractères.</div>';
            $errors = 1;
        }

        if ($errors < 1) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $user = new UserModel();
            $user->setEmail($email);
            $user->setPassword($hashedPassword);
            $user->setName($name);
            $user->setRole(3);

            if ($user->checkEmail()) {
                $this->data[] = '<div class="alert alert-danger" role="alert">Cet email est déjà pris, veuillez en choisir un autre.</div>';
                $errors = 1;
            }            

            if ($errors < 1) {
                if ($user->registerUser()) {
                    $this->data[] =  '<div class="alert alert-success" role="alert">Enregistrement réussi, vous pouvez maintenant vous connecter</div>';
                } else {
                    $this->data[] = '<div class="alert alert-danger" role="alert">Il y a eu une erreur lors de l\enregistrement</div>';
                }
            }
        }
    }


    public function login()
    {

        $errors = 0;
        $user = new UserModel();
        $user = $user->getUserByEmail($_POST['email']);


        if ($user === false) {
            $errors = 1;
        }

        if (password_verify($_POST['password'], $user->getPassword())) {

            $_SESSION['userObject'] = $user;

            $this->data[] =  '<div class="alert alert-success" role="alert">connexion réussie !</div>';

            $base_uri = explode('index.php', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $base_uri[0].'admin');

        } else {
            $errors = 1;
        }
        if ($errors > 0) {
            $this->data[] = '<div class="alert alert-danger" role="alert">Email ou mot de passe incorrect</div>';
        }
    }

    public function logout()
    {            
        unset($_SESSION['userObject']);
          
        $base_uri = explode('index.php', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $base_uri[0].'home');        
        
    }
}
