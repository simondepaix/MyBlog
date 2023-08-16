<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends MainController
{

    public function renderUser(): void
    {
        // si la vue stockée est logout
        if ($this->view === 'logout') {
            // on appel la méthode logout()
            $this->logout();
        } else {
            // sinon, s'il y'a une requête post c'est q'un formulaire à été soumis
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // si le formulaire soumis est registerForm
                if (isset($_POST["registerForm"])) {
                    // on appel la méthode register
                    $this->register();
                    // sinon si le formulaire soumis est LoginForm
                } elseif (isset($_POST["loginForm"])) {
                    // on appel la méthode Login
                    $this->login();
                }
            }
        }
        // dans tous les cas on construit la page
        $this->render();
    }

    // méthode permettant l'inscription d'un utilisateur
    public function register(): void
    {

        // on commence sans erreurs
        $errors = 0;
        // récupération et filtrage des champs du formulaire. filter_input renvoie false s'il y'a une erreur
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $name = filter_input(INPUT_POST, 'name');

        // si les champs sont différents de true,
        if (!$email || !$password || !$name) {
            // c'est qu'il y'a une erreur
            $errors = 1;
            // on stocke dans la propriété data le message d'erreur que l'on va afficher dans la vue ensuite
            $this->data[] = '<div class="alert alert-danger" role="alert">Tous les champs sont obligatoires</div>';
        }

        // on filtre l'adresse email pour savoir si l'email donnée correspond au format d'une adresse email
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        // si filter_var renvoie false
        if ($email === false) {
            // c'est qu'il y'a une erreur
            $errors = 1;
            // on stocke dans la propriété data le message d'erreur que l'on va afficher dans la vue ensuite
            $this->data[] = '<div class="alert alert-danger" role="alert">Le format de l\'email n\'est pas valide.</div>';
        }
        // si le mot de passe fait moins de 8 caractères
        if (strlen($password) < 8) {
            // C'est une erreur
            $errors = 1;
            // on stocke dans la propriété data le message d'erreur que l'on va afficher dans la vue ensuite
            $this->data[] = '<div class="alert alert-danger" role="alert">Le mot de passe doit contenir au moins 8 caractères.</div>';
        }

        // S'il n'y a pas d'erreurs
        if ($errors < 1) {
            // on hash le mot de passe
            // PASSWORD_DEFAULT est un algorithme qui est régulièrement mis à jour 
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // on créer une nouvelle instance de UserModel
            $user = new UserModel();
            // On alimente les propriétés grâce aux setters
            $user->setEmail($email);
            $user->setPassword($hashedPassword);
            $user->setName($name);
            $user->setRole(3);

            // on vérifie si un utilisateur avec le même email existe 
            if ($user->checkEmail()) {
                // Si c'est le cas c'est une erreur
                $errors = 1;
                $this->data[] = '<div class="alert alert-danger" role="alert">Cet email est déjà pris, veuillez en choisir un autre.</div>';
            }
            // s'il n'y a toujours pas d'erreur, c'est tout bon !
            if ($errors < 1) {
                // on peut enregistrer l'utilisateur en appellant la méthode registerUser, elle renvera true ou false
                if ($user->registerUser()) {
                    // si elle renvoie true, on stocke dans data un message de validation
                    $this->data[] =  '<div class="alert alert-success" role="alert">Enregistrement réussi, vous pouvez maintenant vous connecter</div>';
                } else {
                    // sinon on on stocke dans data un message d'erreur
                    $this->data[] = '<div class="alert alert-danger" role="alert">Il y a eu une erreur lors de l\enregistrement</div>';
                }
            }
        }
    }


    public function login(): void
    {

        // on commence sans erreurs
        $errors = 0;
        // on instancie un nouveau UserModel
        $user = new UserModel();
        // on récupère l'utilisateur via son email
        $user = $user->getUserByEmail($_POST['email']);

        // si user renvoie false
        if ($user === false) {
            // il y a eu une erreur
            $errors = 1;
        } else {
            // sinon on vérifie si le mot de passe de l'utilisateur en bdd et celui renseigné dans le formulaire concordent
            if (password_verify($_POST['password'], $user->getPassword())) {
                // si c'est le cas, on stocke notre objet user dans la session
                $_SESSION['userObject'] = $user;
                // on stocke un message dans la propriété data pour l'afficher dans la vue
                $this->data[] =  '<div class="alert alert-success" role="alert">connexion réussie ! votre compte doit être modifié par un admin pour que vous ayez accès à l\'administration</div>';

                // on créé une url de redirection
                $base_uri = explode('index.php', $_SERVER['SCRIPT_NAME']);
                // on redirige vers la page admin
                if($user->getRole() < 3){
                    header('Location:' . $base_uri[0] . 'admin');
                }                
            } else {
                // sinon si les mots de passe ne concordent pas, il y'a une erreur
                $errors = 1;
            }
        }
        // s'il y à des erreurs
        if ($errors > 0) {
            //On stock dans data le message d'erreur à afficher dans la vue
            $this->data[] = '<div class="alert alert-danger" role="alert">Email ou mot de passe incorrect</div>';
        }
    }

    public function logout(): void
    {
        // pour supprimer spécifiquement les données de userObject.
        unset($_SESSION['userObject']);
        // pour détruire la session 
        session_destroy();
        // création de l'url de redirection
        $base_uri = explode('index.php', $_SERVER['SCRIPT_NAME']);
        // on redirige vers la home
        header('Location:' . $base_uri[0] . 'home');
    }
}
