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

        
        $sql = "INSERT INTO `users`(`name`, `mail`, `password`, `role`) VALUES ('[value-2]','[value-3]','[value-4]',1)";

        $pdoStatement = $pdo->prepare($sql);
        $params = [
            ':mail' => $this->email,
            ':password' => $this->password,
            ':name' => $this->name,            
            ':role' => $this->role,            
        ];

        $success = $pdoStatement->execute();

        // mettre à jour l'id du model
        if ($success) {
            echo '<div class="alert alert-success" role="alert">Enregistrement réussi</div>';
        }

        // ne pas oublier de retourner le succes de l'opération
        return $success;
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
