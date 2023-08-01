# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 5
## consignes : 
Nous pouvons désormais naviguer entre les différentes pages, mais les données de blog sur la home page sont encore fictives.
- Nous allons donc mettre en place la BDD en s'appuyant sur le mcd suivant :
![alt text](https://raw.githubusercontent.com/simondepaix/MyBlog/myblog-partie5/mcd_bdd.png?token=GHSAT0AAAAAACEXIKXUEHOYGYO54FEQKFCIZGIYULQ)

une fois fais, voici des données fictives que vous pouvez insérer dans la table posts :
<pre>
INSERT INTO posts (img, date, title, content,user_id)
VALUES
    ('about-bg.jpg', '2023-07-29', 'Les meilleurs endroits à visiter en été', 'L\'été est la saison parfaite pour explorer de nouvelles destinations. Découvrez les meilleurs endroits à visiter pour des vacances inoubliables.',1),
    ('about-bg.jpg', '2023-07-28', 'Recette délicieuse de tarte aux pommes', 'Dégustez notre recette de tarte aux pommes maison, avec une croûte croustillante et une garniture aux pommes fraîches.',1),
    ('about-bg.jpg', '2023-07-27', 'Conseils pour rester en forme et en bonne santé', 'Découvrez nos astuces pour maintenir un mode de vie actif et sain, que ce soit à la maison ou au bureau.',1),
    ('about-bg.jpg', '2023-07-26', 'Les tendances de la mode pour cet automne', 'Préparez votre garde-robe pour la saison automnale avec les dernières tendances de la mode et les couleurs à la mode.',1),
    ('about-bg.jpg', '2023-07-25', 'Critique de film : "Voyage interstellaire"', 'Plongez dans l\'univers captivant de "Voyage interstellaire", le dernier film de science-fiction qui captive les cinéphiles du monde entier.',1),
    ('about-bg.jpg', '2023-07-24', 'Guide d\'achat des smartphones 2023', 'Nous avons passé en revue les derniers smartphones du marché pour vous aider à choisir le modèle qui correspond le mieux à vos besoins.',1),
    ('about-bg.jpg', '2023-07-23', 'Les bienfaits du yoga sur la santé mentale', 'Découvrez comment la pratique régulière du yoga peut améliorer votre bien-être mental et réduire le stress.',1),
    ('about-bg.jpg', '2023-07-22', 'Interview exclusive avec une star du cinéma', 'Plongez dans les coulisses du dernier film à succès avec notre interview exclusive de l\'acteur principal.',1),
    ('about-bg.jpg', '2023-07-21', 'Comment créer un jardin biologique chez vous', 'Suivez nos conseils pratiques pour démarrer votre propre jardin biologique et cultiver des légumes sains.',1),
    ('about-bg.jpg', '2023-07-20', 'Découverte archéologique fascinante', 'Des archéologues ont récemment mis au jour une ancienne cité perdue qui pourrait réécrire l\'histoire de notre civilisation.',1);
    
</pre>
