<?php

class PostController extends MainController{

    public function renderPost(){
        // Comme la page Post à besoin d'un traitement spécifique.        
        // alors elle à son propre render
        // il récupère les articles
        require __DIR__.'/../Models/PostModel.php';        
        $postModel = new PostModel();     
        // il transmet les data au MainController              
        $this->data =  $postModel->getPostById($this->id);  
        // Puis il appelle le render de MainController pour construire la page      
        $this->render();
    }
}
