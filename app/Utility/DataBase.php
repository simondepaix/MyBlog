<?php
// On spécifie dans quel namespace se trouve ce modèle
namespace App\Utility;

// on spécifie les namespaces requis dans notre code
use \PDO;

// Cette classe nous permet de gérer la connexion à la base de données
// Elle suit le modèle Singleton pour garantir une seule instance de connexion
class DataBase
{    
    private $dsn;
    private static $_instance;

    // Le constructeur privé assure que la classe ne peut pas être instanciée directement
    private function __construct()
    {        
        // Chargement des données de configuration de la base de données depuis un fichier ini
        // Donc n'oubliez pas de créer le fichier config.ini avec les informations de la bdd
        // ce fichier évite d'avoir les information en clair dans son code. 
        // Ainsi, on peut push ce code sur un repo github ou partager ce code sans se soucier de transmettre des informations sensibles
        $configData = parse_ini_file(__DIR__ . '/../config.ini');        

        try {
            // Création d'une nouvelle instance PDO pour établir la connexion à la base de données
            $this->dsn = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD']                
            );
        } catch (\Exception $exception) {            
            // En cas d'échec de connexion, affichage de l'erreur et arrêt du script
            echo $exception->getMessage() . '<br>';                                    
            die;
        }
    }    

    // Méthode statique pour obtenir une instance unique de connexion PDO
    public static function connectPDO()
    {        
        // Si aucune instance n'a été créée, en créer une
        // ici on utilise self pour faire référence à la classe car
        // comme c'est une méthode statique, $this ne sera pas accessible
        if (empty(self::$_instance)) {
            // on remarque que cette méthode instancie sa propre classe
            self::$_instance = new Database();
        }
        // Retourner l'instance de connexion PDO
        return self::$_instance->dsn;
    }
}
