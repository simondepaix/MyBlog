# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 9
## consignes : 
Fichiers .htaccess. allons réécrire les urls qui actuellement ne sont pas très optimisées avec les params directement dans l'url
- créer le fichier .htaccess au niveau de index.php et collez le code suivant :
<pre>
 RewriteEngine On
RewriteBase /Programation/jour13/public/

# Réécrire les URLs pour les pages de posts avec ID
RewriteRule ^post/id/([0-9]*|js|css)$ index.php?page=post&id=$1 [QSA,L]

# Réécrire toutes les URLs vers index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?page=$1 [QSA,L]

</pre>
Vous allez peut être devoir trouver une solution pour que les assets soient bien chargés sur n'importe quelle page.

- Créez un fichier .htaccess à mettre dans le dossier app afin de protéger notre code "sensible" avec le code suivant :
DENY FROM ALL
