<?php

namespace App\Controllers;

class ErrorController extends MainController
{
    // le constructeur va se lancer automatiquement,lors de l'appel de ErrorController
    public function __construct(){
        // on modifie la view pour 404
        $this->view = '404';
        // on définie le code de réponse http. Ce code sera visible dans l'optin network de la console du navigateur.
        // sans ça, la page demandée renvera status 200
        http_response_code(404);
        // on construit la page
        $this->render();
    }

}
