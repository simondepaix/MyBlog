<?php

class PostModel{
    private $id;
    private $img;
    private $date;
    private $title;
    private $content;
    private $user_id;
    
    public function getPosts($limit){
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=myblog', 'root', 'root');            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        if(!empty($limit)){
            $query = $dbh->prepare('SELECT * FROM posts LIMIT '.$limit);
        }else{
            $query = $dbh->prepare('SELECT * FROM posts');        
        }

        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_CLASS,'PostModel');
        return $posts;
     
    }

    public function getPostById($id)
    {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=myblog', 'root', 'root');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }        
        $query = $dbh->prepare('SELECT * FROM posts WHERE id=:id');
        $params = [
            'id'=>$id
        ];
        $query->execute($params);
        $query->setFetchMode(PDO::FETCH_CLASS, 'PostModel');
        $post = $query->fetch();            
        return $post;
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
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
