<?php

class PostModel {
    private $id;
    private $img;
    private $date;
    private $title;
    private $content;
    private $user_id;
    
    public function getPosts($limit = null)
    {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=myblog', 'root', 'root');
            echo 'connecté';
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        if (isset($limit)) {
            $sql = 'SELECT * FROM posts LIMIT ' . $limit;
        } else {
            $sql = 'SELECT * FROM posts';
        }

        $query = $dbh->prepare($sql);
        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_CLASS,'PostModel');

        return $posts;
    }

    public function getPostById($id){

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
    public function setId($id)
    {
        $this->id = $id;
        
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
    public function setImg($img)
    {
        $this->img = $img;
        
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
    public function setDate($date)
    {
        $this->date = $date;
        
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
    public function setTitle($title)
    {
        $this->title = $title;
        
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
    public function setContent($content)
    {
        $this->content = $content;

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
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        
    }
}
