<?php
// On spécifie dans quel namespace se trouve ce modèle
namespace App\Models;

// on spécifie les namespaces requis dans notre code
use App\Utility\DataBase;


// Ce modèle est la représentation "code" de notre table posts
// elle aura donc autant de propriétés qu'il y'a de champs dans la table
// ça nous permettra de manipuler des objets identiques à une entrée de bdd grâce à PDO::FETCH_CLASS
class UserModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;

    // méthode pour enregistrer un user en bdd
    public function registerUser(): bool
    {

        // connexion pdo
        $pdo = DataBase::connectPDO();

        // création requête avec liaison de param pour éviter les injections sq
        $sql = "INSERT INTO `users`(`name`, `email`, `password`,`role`) VALUES (:name,:email,:password,:role)";
        // préparation de la requête
        $pdoStatement = $pdo->prepare($sql);
        // liaison des params avec leur valeurs. tableau à passer dans execute
        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
            // par défaut on force le role à 3 qui est le plus faible
            ':role' => 3,
        ];
        // récupération de l'état de la requête (renvoie true ou false)
        $queryStatus = $pdoStatement->execute($params);

        // on retourne le status
        return $queryStatus;
    }

    // méthode pour vérifier si un email est déjà pris
    public function checkEmail()
    {
        // connexion pdo
        $pdo = DataBase::connectPDO();

        // création requête avec liaison de param pour éviter les injections sq
        $sql = "SELECT COUNT(*) FROM `users` WHERE `email` = :email";
        // préparation de la requête
        $query = $pdo->prepare($sql);
        // pas besoin de faire un tableau, il n'ya qu'un seule entrée, on peut utiliser bindParam        
        $query->bindParam(':email', $this->email);
        // execution de la requete
        $query->execute();
        // on stock le retour. fetchColumn renvoie le nombre d'éléments trouvé
        $isMail = $query->fetchColumn();

        // donc l'instruction $isMail > 0 donnera true s'il y'a déjà l'email présent
        return $isMail > 0;
    }

    // récupérer un utilisateur via son email
    public static function getUserByEmail($email): ?UserModel
    {

        // connexion pdo
        $pdo = DataBase::connectPDO();

        // requête SQL
        $sql = '
        SELECT * 
        FROM users
        WHERE email = :email';
        $pdoStatement = $pdo->prepare($sql);
        // on exécute la requête en donnant à PDO la valeur à utiliser pour remplacer ':email'
        $pdoStatement->execute([':email' => $email]);
        // on récupère le résultat sous la forme d'un objet de la classe AppUser
        $result = $pdoStatement->fetchObject('App\Models\UserModel');

        // on renvoie le résultat
        return $result;
    }
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Get the value of role
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }
}
