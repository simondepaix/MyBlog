<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\PostModel;

class PostController extends MainController
{

    public function renderPost(): void
    {
        // on alimente la propriété data avec l'article 
        $this->data =  PostModel::getPostById($this->subPage);
        // on construit la page
        $this->render();
    }
}
