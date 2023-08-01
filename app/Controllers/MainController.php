<?php
class MainController{
    protected $view;
    protected $id;
    protected $data;
    public function render(){      
        // ici on explode $_SERVER['request_uri]. ça va séparer l'url à partir du dossier /public/ 
        // ça va créer un tableau contenant au premier index la première partie de l'url (celle qui nous sert) et au second index la partie dont on ne veut pas
        //  cette url va nous servir pour les liens de la barre de nav
        // faites un var_dump de $base_uri pour vraiment bien comprendre ce qui est créé !        
        $base_uri = explode('/public/',$_SERVER['REQUEST_URI']);            
        $data = $this->data;                              
        require __DIR__.'/../views/front/layouts/header.phtml';
        require __DIR__."/../views/front/partials/$this->view.phtml";
        require __DIR__.'/../views/front/layouts/footer.phtml';
        
    }

    /**
     * Get the value of view
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the value of view
     */
    public function setView($view): self
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}