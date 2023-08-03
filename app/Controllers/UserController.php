<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends MainController{
    public function renderRegister(){
        if(!empty($_POST)){
            $this->register();
        }
        $this->render();
    }
    
    public function register(){

        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');        
        $name = filter_input(INPUT_POST, 'name');                        

        if (!$email || !$password || !$name)  {
            $errors[] = 'Tous les champs sont obligatoires';
        }

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);        
        if ($email === false) {            
            $errors[] = 'Le format de l\'email n\'est pas valide.';
        }

        if (strlen($password) < 8) {
            $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        var_dump($hashedPassword);

         $user = new UserModel();
        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setName($name);        
        $user->setRole(2); 
               
        $user->registerUser();
        // on sauvegarde le model
        //$newUser->save();
        
        // on redirige sur la page de liste        
        // header('Location: ' );
        exit();
    }


}