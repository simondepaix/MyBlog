<?php

class BlogController extends MainController{

    public function renderPost(){
        $postModel = new BlogModel();                  
        $this->data =  $postModel->getPostById($this->id);        
        $this->render();
    }
}