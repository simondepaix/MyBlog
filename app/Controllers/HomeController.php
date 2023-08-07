<?php

class HomeController extends MainController{

    public function renderHome(){    
        // Comme la page home à besoin d'un traitement spécifique.
        // (on ne veut pas charger les articles sur toutes les pages)
        // alors elle à son propre render
        // il récupère les articles
        require __DIR__.'/../Models/PostModel.php';
        $postModel = new PostModel();        
        // il transmet les data au MainController
        $this->data = $postModel->getPosts(5);   
        // Puis il appelle le render de MainController pour construire la page
        $this->render();
    }
}
