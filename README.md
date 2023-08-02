# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 8
## consignes : 
Actuellement on va récupérer les articles depuis la méthode render du MainController. Ça signifie quon va récupérer les articles sur n'importe quelle page même si elle n'en à pas besoin.
Il va donc falloir appeler un render différent si l'on à besoin de faire un traitement différent.
Donc :
- la méthode render du MainController devra simplement rendre la vue.
- Nous allons faire une méthode renderHome dans le HomeController qui va faire la récupération des data + appeler render de la classe parente.
Il va donc falloir revoir notre tableau de avaiable routes afin d'ajouter la possibilité d'utiliser un render différent si besoin. Exemple :
<code>
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
</code>
Bien entendu, il faudra revoir le router / dispatcher puisque le tableau à été mis à jour
Lorsque l'on va cliquer sur un article, celui ci redirige vers l'article en question.
- Mettre en place les liens des articles pour qu'ils redirigent vers ?page=post&id=1
- Mettre en place le controller qui va s'occuper d'appeler la méthode getPostById 
- Mettre en place le la méthode getPostById
- Revoir le routing pour prendre en compte le param id
