<?php
require __DIR__.'/../vendor/autoload.php';

// use App\Controllers\MainController;
// require __DIR__.'/../app/Models/PostModel.php';
// require __DIR__.'/../app/Controllers/MainController.php';
// require __DIR__.'/../app/Controllers/HomeController.php';
// require __DIR__.'/../app/Controllers/ContactController.php';
// require __DIR__.'/../app/Controllers/AboutController.php';
// require __DIR__.'/../app/Controllers/PostController.php';
// echo '<pre>';
// var_dump(__DIR__);
// echo '</pre>';
// Variable contenant les routes dispo
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
    'login'=>[
        'action' => 'render',
        'controller' => 'MainController'
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
// s'il y a un param GET page, on le stock dans la var page sinon on redirige vers home
if(isset($_GET['page']) && !empty($_GET['page'])){    
    $page = $_GET['page'];
    if(!empty($_GET['id'])){
        $itemId = $_GET['id'];
    }

}else{
    $page = 'home';    
}

// Si la page demandée fait partie de notre tableau de routes, on la stocke dans la variable controller
// sinon on redirige vers le controller ErrorController
if(array_key_exists($page,AVAIABLE_ROUTES)){
    $controller = AVAIABLE_ROUTES[$page]['controller'];
    $controllerAction = AVAIABLE_ROUTES[$page]['action'];
}else{
    $controller = 'ErrorController';
}
// function my_autoloader($controller) {
//     include __DIR__.'/../app/Controllers/'.$controller.'.php';
// }

// spl_autoload_register('my_autoloader');
$namespace = 'App\Controllers';
$controllerClassName = $namespace . '\\' . $controller;

// Instanciation de la classe en utilisant le nom complet (namespace + nom de la classe)
$pageController = new $controllerClassName();
$pageController->setView($page);
$pageController->setId($itemId);
$pageController->$controllerAction();



