<?php
namespace App\Controllers;


class MainController{
    protected $view;
    protected $subPage;
    protected $data;
    protected $viewType = 'front';    

    public function render(){      
        // ici on explode $_SERVER['request_uri]. ça va séparer l'url à partir du dossier /public/ 
        // ça va créer un tableau contenant au premier index la première partie de l'url (celle qui nous sert) et au second index la partie dont on ne veut pas
        //  cette url va nous servir pour les liens de la barre de nav
        // faites un var_dump de $base_uri pour vraiment bien comprendre ce qui est créé !            
        
        $base_uri = explode('/public/',$_SERVER['REQUEST_URI']);            
        $data = $this->data;                                              
        require __DIR__.'/../views/'.$this->viewType.'/layouts/header.phtml';
        require __DIR__.'/../views/'.$this->viewType.'/partials/'.$this->view.'.phtml';
        require __DIR__.'/../views/'.$this->viewType.'/layouts/footer.phtml';        
    }

    protected function checkUserAuthorization($role) {                
        
        if (isset($_SESSION['userObject'])) {            
            $currentUser = $_SESSION['userObject'];             
            $currentUserRole = $currentUser->getRole();            
            if ($currentUserRole <= $role) {                
                return true;
            }            
            else {
             
                http_response_code(403);           
                $this->view = '403';
                $this->render();                
                exit();
            }
        }        
        else {            
            $redirect =  explode('/public/',$_SERVER['REQUEST_URI']);        
            header('Location: ' . $redirect[0].'/public/login');
            exit();
        }
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
    public function getSubPage()
    {
        return $this->subPage;
    }

    /**
     * Set the value of id
     */
    public function setSubPage($value): self
    {
        $this->subPage = $value;

        return $this;
    }
}