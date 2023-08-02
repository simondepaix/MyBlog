<?php
class MainController{
    protected $view;    
    protected $data;
    
    public function render(){             
        $data = $this->data; 
           
        require __DIR__.'/../views/front/layouts/header.phtml';
        require __DIR__."/../views/front/partials/".$this->view.".phtml";
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
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     */
    public function setData($data)
    {
        $this->data = $data;        
    }
}

