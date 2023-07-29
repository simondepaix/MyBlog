# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 4
## consignes : 
Maintenant que nous savons quel controller appeler :
- Créez un controller MainController
- Ce controller possède une méthode render. Cette méthode possède deux param 'view' et 'data'. Elle require les bonne vues et transmet les 
bonnes data soit :
header
$view
footer

- nous allons également créer autant de controllers qu'il y'a de pages. Ces controllers vont hériter de MainController et aurons donc tous accès à la méthode render()
- une fois que les controllers sont mis en place, modifier les liens de la barre de navigation pour pouvoir naviguer avec le param page. 
 Exemple : ?page='about'
    
