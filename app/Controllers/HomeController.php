<?php

class HomeController extends MainController{

    public function renderHome($view,$data = []){
        $postModel = new PostModel();
        $posts = $postModel->getPosts(5);        
        $this->render($view,$posts);
    }
}
