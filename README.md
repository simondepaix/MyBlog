# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 1
# consignes : vous allez devoir découper la maquette  et créer l'architecture de notre dossier correspondant à celui ci :
    racine
    ├── app
    │     ├── Controllers
    │     │     ├── Admin
    │     │     │     └── ArticleController.php
    │     │     └── HomeController.php
    │     ├── Models
    │     │     ├── Article.php
    │     │     └── User.php
    │     ├── views
    │     │     ├── admin
    │     │     │     ├── partials
    │     │     │     │     ├── admin_header.php
    │     │     │     │     └── admin_footer.php
    │     │     │     ├── layouts
    │     │     │     │     └── admin_layout.php
    │     │     │     ├── create_article_view.php
    │     │     │     └── manage_articles_view.php
    │     │     └── front
    │     │           ├── partials
    │     │           │     ├── header.php
    │     │           │     └── footer.php
    │     │           ├── layouts
    │     │           │     └── front_layout.php
    │     │           ├── home_view.php
    │     │           ├── single_article_view.php
    │     │           └── error_404_view.php
    │     └── Utils
    ├── public
    │     ├── assets
    │     │     └── css
    │     │           └── styles.css
    │     └── index.php
    └── database
          └── db.sqlite
