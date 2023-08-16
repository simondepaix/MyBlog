<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\PostModel;

class HomeController extends MainController
{

    public function renderHome(): void
    {
        //  sur la home on à besoin d'afficher 4 articles
        $postModel = new PostModel();
        // on alimente la propriété data de la class parente MainController avec la liste des articles
        $this->data = $postModel->getPosts(4);
        // on appelle la méthode render du MainController qui construit la page
        $this->render();
    }
}
