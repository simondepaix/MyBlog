<?php
// Require des différents fichiers. (actuellement temporaire);
require __DIR__.'/../app/Controllers/MainController.php';
require __DIR__.'/../app/Controllers/HomeController.php';
require __DIR__.'/../app/Controllers/ContactController.php';
require __DIR__.'/../app/Controllers/AboutController.php';
require __DIR__.'/../app/Controllers/PostController.php';


$base_uri = $_SERVER['REQUEST_URI'];

// Variable contenant les routes dispo
// Cette variable contient pour chaque page son controller à appeler
// ainsi que sa méthode à appeler
const AVAIABLE_ROUTES = [
    'home'=>[
        'action' => 'renderHome',
        'controller' => 'HomeController'
    ],
    'about'=>[
        'action' => 'render',
        'controller' => 'MainController'
    ],
    'contact'=>[
        'action' => 'render',
        'controller' => 'MainController'
    ],
    'post'=>[
        'action' => 'renderPost',
        'controller' => 'PostController'
    ],
    '404'=>[
        'action' => 'render',
        'controller' => 'ErrorController'
    ],
];

// initiatilisation des variables 
$page = 'home';
$controller;
$itemId=null;

// s'il y a un param GET page, on le stocke
//dans la var page sinon on redirige vers home
if(isset($_GET['page']) && !empty($_GET['page'])){        
    $page = $_GET['page'];
    // Si on trouve en plus un param id dans l'url on le stocke
    // dans la variable $itemId;
    if(!empty($_GET['id'])){
        $itemId = $_GET['id'];
    }

}else{
    $page = 'home';    
}

// Si la page demandée fait partie de notre tableau de routes, on la stocke dans la variable controller
// sinon on redirige vers le controller ErrorController
if(array_key_exists($page,AVAIABLE_ROUTES)){
    // on stocke dans la variable, le controller de la page demandée
    $controller = AVAIABLE_ROUTES[$page]['controller'];
    // on stocke dans la variable, la méthode (l'action) de la page demandée
    $controllerAction = AVAIABLE_ROUTES[$page]['action'];
}else{
    $controller = 'ErrorController';
}

// on fait une nouvelle instance du controller de la page demandée
$pageController = new $controller();
// on utilise son setter pour communiquer à la propriété $view la vue correspondante
$pageController->setView($page);
// on utilise son setter pour communiquer à la propriété $id du controller
$pageController->setId($itemId);
// on appelle la bonne méthode en fonction de la page demandée
$pageController->$controllerAction();



