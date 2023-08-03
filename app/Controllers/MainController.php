<?php
class MainController{
    protected $view;    
    protected $data;
    public function render(){          
        require __DIR__.'/../Models/PostModel.php';
        $postModel = new PostModel();        
        $this->data = $postModel->getPosts(5);   
        $data = $this->data;  
        var_dump($data);
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
    public function setData($data): self
    {
        $this->data = $data;
        
    }
}
