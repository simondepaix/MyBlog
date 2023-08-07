<?php
class MainController{
    protected $view;
    protected $id;
    protected $data;
    public function render(){     
        //    Le explode permet de créer un tableau qui contient
        // les deux parties de l'url spécifiée en 2eme param ($_SERVER['REQUEST_URI'])
        // faites des var_dump() !
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
    public function setView($view)
    {
        $this->view = $view;

        
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
    public function setId($id)
    {
        $this->id = $id;


    }
}
