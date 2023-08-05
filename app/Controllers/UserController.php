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
        // filter input permet de faire le if isset sans faire pleins de conditions
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');        
        $name = filter_input(INPUT_POST, 'name');   
        
        // Si un champs vaut false, on ajoute une erreur dans le tableau errors
        if (!$email || !$password || !$name)  {
            $errors[] = '<div class="alert alert-danger" role="alert">Tous les champs sont obligatoires</div>';
        }
        // filter_var permet de vérifier si la valeur correspond bien au pattern attendu par se champs
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);        
        if ($email === false) {            
            $errors[] = '<div class="alert alert-danger" role="alert">Le format de l\'email n\'est pas valide.</div>';
        }

        if (strlen($password) < 8) {
            $errors[] = '<div class="alert alert-danger" role="alert">Le mot de passe doit contenir au moins 8 caractères.</div>';
        }
        if(!empty($errors)){   
            $this->data['errors'] = $errors;       
        }else{            
            // Création du mot de passe hashé
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Création de l'objet user
            $user = new UserModel();            
            // Remplissage des propriétés via les setters
            $user->setEmail($email);
            $user->setPassword($hashedPassword);
            $user->setName($name); 
            //De base on créé un user avec le rôle 3 (1:admin,2:author,3:user)    
            $user->setRole(3);    
            if($user->checkEmail()){
                $errors[] = '<div class="alert alert-danger" role="alert">Cet email est déjà pris, veuillez en choisir un autre.</div>';
                $this->data['errors'] =  $errors;
            }
            $this->data['user'] = $user;  
            if(!isset($errors)){
                if($user->registerUser()){                   
                    $this->data['success'] =  '<div class="alert alert-success" role="alert">Enregistrement réussi</div>';                
                }else{
                    $this->data['errors'] = '<div class="alert alert-danger" role="alert">Il y a eu une erreur lors de l\enregistrement</div>';
                } 
            }
            
            // on redirige l'utilisateur sur la page moncompte                
            // header('Location:'.$_SERVER['REQUEST_URI'].'/../');                        
        }

    
        

    }


}