<?php

class BlogController extends MainController{

    public function renderPost(){
        $postModel = new PostModel();                  
        $this->data =  $postModel->getPostById($this->id);        
        $this->render();
    }
}
