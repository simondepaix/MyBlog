<?php
class MainController{
    protected $view;
    protected $id;
    protected $data;

    public function render(){    
        // Le render du main fera toujours la même chose :
        // il construit la page qui est toujours constituée 
        //de données ($data,ces data sont mises à jours en fonction du render des autres controller qui héritent de MainController) 
        //d'un header, d'une vue, d'un footer
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
