<?php

namespace App\Models;

use App\Utility\DataBase;
use \PDO;

class PostModel
{
    private $id;
    private $img;
    private $date;
    private $title;
    private $content;
    private $user_id;

    public function getPosts($limit = null)
    {
        $dsn = DataBase::connectPDO();
        if (!empty($limit)) {
            $query = $dsn->prepare('SELECT * FROM posts LIMIT ' . $limit);
        } else {
            $query = $dsn->prepare('SELECT * FROM posts');
        }

        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Models\PostModel');
        return $posts;
    }

    public function getPostById($id)
    {
        $dsn = DataBase::connectPDO();
        $query = $dsn->prepare('SELECT * FROM posts WHERE id=:id');
        $params = [
            'id' => $id
        ];
        $query->execute($params);
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Models\PostModel');
        $post = $query->fetch();
        return $post;
    }
    
    private function executeQuery($sql, $params)
    {
        $pdo = DataBase::connectPDO();
        $user_id = $_SESSION['userObject']->getId();
        
        $params['user_id'] = $user_id;        
        $query = $pdo->prepare($sql);
        $queryStatus = $query->execute($params);
        return $queryStatus;
    }

    public function insertPost()
    {
        $sql = "INSERT INTO `posts`(`title`, `date`, `content`, `img`, `user_id`) VALUES (:title, :date, :content, :img, :user_id)";
        $params = [
            'title' => $this->title,
            'date' => $this->date,
            'content' => $this->content,
            'img' => $this->img
        ];

        return $this->executeQuery($sql, $params);
    }

    public function updatePost()
    {
        $sql = "UPDATE `posts` SET `title` = :title, `date` = :date, `content` = :content, `img` = :img, `user_id` = :user_id WHERE `id` = :id";
        $params = [
            'id' => $this->id,
            'title' => $this->title,
            'date' => $this->date,
            'content' => $this->content,
            'img' => $this->img
        ];

        return $this->executeQuery($sql, $params);
    }





    public static function deletePost($postId)
    {
        $pdo = DataBase::connectPDO();
        $sql = 'DELETE FROM `posts` WHERE id = :id';
        $query = $pdo->prepare($sql);
        $query->bindParam('id', $postId, PDO::PARAM_INT);
        $queryStatus = $query->execute();
        return $queryStatus;
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
     * Get the value of img
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     */
    public function setImg($img): self
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of contenu
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of contenu
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
