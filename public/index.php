<?php

// on require les fichiers (temporairement)

// Variable contenant les routes dispo
const AVAIABLE_ROUTES = [
    'home'=>'HomeController',
    'about'=>'AboutController',
    'contact'=>'ContactController',
    '404'=>'ErrorController'
];

// initiatilisation des variables
$page = 'home';
$controller;

// s'il y a un param GET page, on le stock dans la var page sinon on redirige vers home
if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'home';    
}

// Si la page demandée fait partie de notre tableau de routes, on la stocke dans la variable controller
// sinon on redirige vers le controller ErrorController
if(array_key_exists(AVAIABLE_ROUTES,$page)){
    $controller = AVAIABLE_ROUTES[$page];
}else{
    $controller = 'ErrorController';
}



