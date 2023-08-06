<?php

namespace App\Controllers;
use App\Controllers\MainController;

class AdminController extends MainController{
    public function renderAdmin(){
        $this->viewType = 'admin';
        if(isset($this->subPage)){
            $this->view = $this->subPage;
        }
        $this->render();
    }
 
}