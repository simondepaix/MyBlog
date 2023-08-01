<?php

class PostController extends MainController{

    public function renderPost(){
        require __DIR__.'/../Models/PostModel.php';        
        $postModel = new PostModel();                   
        $this->data =  $postModel->getPostById($this->id);        
        $this->render();
    }
}
