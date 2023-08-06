<?php

namespace App\Models;

use App\Utility\DataBase;

class UserModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;

    public function registerUser()
    {

        $pdo = DataBase::connectPDO();

        $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name,:email,:password)";

        $pdoStatement = $pdo->prepare($sql);
        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
        ];
        $success = $pdoStatement->execute($params);
 
        return $success;
    }

    public function checkEmail()
    {        
        $pdo = DataBase::connectPDO();

        $sql = "SELECT COUNT(*) FROM `users` WHERE `email` = :email";
        
        $query = $pdo->prepare($sql);        
        $query->bindParam(':email', $this->email);
        
        $query->execute();
        $isMail = $query->fetchColumn();             
        return $isMail > 0;
    }

    public static function getUserByEmail($email)
    {

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
}
