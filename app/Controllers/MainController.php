<?php
class MainController{

    public function render(string $view, array $data = []){                         
        require __DIR__.'/../views/front/layouts/header.phtml';
        require __DIR__."/../views/front/partials/$view.phtml";
        require __DIR__.'/../views/front/layouts/footer.phtml';
        
    }
}