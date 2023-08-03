<?php

class HomeController extends MainController{

    public function renderHome($view,$data = []){
        require __DIR__.'/../Models/PostModel.php';
        $postModel = new PostModel();
        $posts = $postModel->getPosts(5);        
        $this->render($view,$posts);
    }
}