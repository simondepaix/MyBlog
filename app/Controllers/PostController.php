<?php

namespace App\Controllers;
use App\Controllers\MainController;
use App\Models\PostModel;

class PostController extends MainController{

    public function renderPost(){        
        $postModel = new PostModel();                  
        $this->data =  $postModel->getPostById($this->subPage);        
        $this->render();
    }

    
}
