# Ce TP à pour but d'introduire au concept MVC et POO en php. Nous allons créer un blog en partant d'une base bootstrap.

# MyBlog partie 11
## consignes : 
Dans notre PostModel, nous faisont la connexion à la bdd directement dans nos méthodes. 
Ce n'est pas correct car on fait de la duplication de code et potentiellement des connexion simultanées.
Notre DataBase mérite sa propre classe, mais ce n'est ni un controller, ni une view, ni un model
- Nous allons donc créer un Dossier Utility
- Dans ce dossier, nous allons créer un fichier DataBase.php
- Ce fichier aura 2 propriétés : $dsn et $instance
- Ce fichier sera une classe qui va s'occuper de :
    - Récupérer un fichier de config comprenant nos informations de connexion BDD, vous pouvez utiliser la fonction parse_ini_file pour récupérer les data de ce fichier
    - Connexion PDO avec le try catch que l'on à déjà vu dans le constructeur
    - Une méthode static connectPDO accessible partout qui va vérifer si une instance de cette classe existe déjà ou non :
      <code>
    public static function connectPDO()
        {
            // on vérifie si une instance existe déjà, sinon on la créé
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance->dbh;
    }
  </code>
    - Il faudra ensuite créer le fichier config.ini qui contient les information de la bdd
    - N'oubliez pas de le mettre dans le gitignore car c'est une erreur de sécurité !
    - Remplacez les connexions classiques des models par notre nouvelle connexion

