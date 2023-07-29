<?php

class BlogModel
{
    private $id;
    private $img;
    private $date;
    private $title;
    private $content;

    public function getPosts($limit)
    {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=myblog', 'root', 'root');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        if (!empty($limit)) {
            $query = $dbh->prepare('SELECT * FROM post LIMIT ' . $limit);
        } else {
            $query = $dbh->prepare('SELECT * FROM post');
        }

        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_CLASS, 'BlogModel');        
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
        $query = $dbh->prepare('SELECT * FROM post WHERE id=:id');
        $params = [
            'id'=>$id
        ];
        $query->execute($params);
        $query->setFetchMode(PDO::FETCH_CLASS, 'BlogModel');
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
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }
}
