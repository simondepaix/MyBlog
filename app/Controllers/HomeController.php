<?php

class HomeController extends MainController{

    public function renderHome(){    
        require __DIR__.'/../Models/PostModel.php';
        $postModel = new PostModel();        
        $this->data = $postModel->getPosts(5);   
        $this->render();        
    }
}
