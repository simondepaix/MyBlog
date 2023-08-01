# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 6
## consignes : 
Fichiers .htaccess. allons réécrire les urls qui actuellement ne sont pas très optimisées avec les params directement dans l'url
- créer le fichier .htaccess au niveau de index.php et collez le code suivant : 
Options +FollowSymLinks
RewriteEngine On
RewriteBase /3Wblog/MyBlog/public/

# Réécrire l'URL pour la page d'accueil
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^/]+)/?$ index.php?page=$1 [QSA,L]

# Réécrire l'URL pour les pages de posts
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^post/(\d+)/?$ index.php?page=post&id=$1 [QSA,L]

Vous allez peut être devoir trouver une solution pour que les assets soient bien chargés sur n'importe quelle page.

- Créez un fichier .htaccess à mettre dans le dossier app avec le code suivant :
DENY FROM ALL
