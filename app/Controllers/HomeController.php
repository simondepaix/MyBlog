<?php
namespace App\Controllers;
use App\Controllers\MainController;
use App\Models\PostModel;

class HomeController extends MainController{

    public function renderHome(){    
        // require __DIR__.'/../Models/PostModel.php';         
        $postModel = new PostModel();        
        $this->data = $postModel->getPosts();   
        $this->render();
        
    }
}
