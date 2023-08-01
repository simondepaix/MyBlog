<?php

class PostController extends MainController{

    public function renderPost(){
        // require __DIR__.'.'
        var_dump(__DIR__);
        $postModel = new PostModel();                   
        $this->data =  $postModel->getPostById($this->id);        
        $this->render();
    }
}
