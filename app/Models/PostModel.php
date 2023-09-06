<?php
// On spécifie dans quel namespace se trouve ce modèle
namespace App\Models;

// on spécifie les namespaces requis dans notre code
use App\Utility\DataBase;
use \PDO;

// Ce modèle est la représentation "code" de notre table posts
// elle aura donc autant de propriétés qu'il y'a de champs dans la table
// ça nous permettra de manipuler des objets identiques à une entrée de bdd grâce à PDO::FETCH_CLASS
class PostModel
{
    private $id;
    private $img;
    private $date;
    private $title;
    private $content;
    private $user_id;

    // méthode pour récupérer tous les articles, il est possible de spécifier une limite
    public static function getPosts(int $limit = null): array
    {
        // connexion pdo avec le pattern singleton
        $pdo = DataBase::connectPDO();
        // s'il y'a un param limit
        if (!empty($limit)) {
            // alors on fait la requête avec le limit
            $query = $pdo->prepare('SELECT * FROM posts ORDER BY date DESC LIMIT ' . $limit);
        } else {
            // sinon, on fait la requête classique
            $query = $pdo->prepare('SELECT * FROM posts ORDER BY date DESC');
        }


        $query->execute();
        // on fetchAll avec l'option FETCH_CLASS afin d'obtenir un tableau d'objet de type PostModel. 
        // On pourra ensuite manipuler les propriétés grâce au getters / setters
        // ne pas oublier de spécifier le namespace App\Models\PostModel !
        $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Models\PostModel');
        return $posts;
    }

    // récupération d'un article via son id
    // : ?PostModel est le typage de retour de la fonction. Ça signifie quelle peut retourner 
    // soit un objet de type PostModel, soit null
    public static function getPostById(int $id): ?PostModel
    {
        // connection pdo
        $pdo = DataBase::connectPDO();
        // impératif, :id permet d'éviter les injections SQL
        $query = $pdo->prepare('SELECT * FROM posts WHERE id=:id');
        // Comme il n'y a qu'un seul param, pas besoin de faire un tableau, on peut utiliser bindParam
        $query->bindParam(':id', $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Models\PostModel');
        // fetch et non fetchAll car on récupère une seule entrée
        $post = $query->fetch();       
        if(!$post){
            $post = null;
        } 
        return $post;
    }


    public function insertPost(): bool
    {
        $pdo = DataBase::connectPDO();
        // récupération de l'id de l'utilisateur via la superglobale $_SESSION
        $user_id = $_SESSION['user_id'];
        // requête sql protégée des injections sql 
        $sql = "INSERT INTO `posts`(`title`, `date`, `content`, `img`, `user_id`) VALUES (:title, :date, :content, :img, :user_id)";
        // associations des bonnes valeurs
        $params = [
            'title' => $this->title,
            'date' => $this->date,
            'content' => $this->content,
            'img' => $this->img,
            'user_id' =>  $user_id
        ];
        $query = $pdo->prepare($sql);
        // execution de la méthode en passant le tableau de params
        $queryStatus = $query->execute($params);
        return $queryStatus;
    }

    public function updatePost(): bool
    {
        $pdo = DataBase::connectPDO();
        // récupération de l'id de l'utilisateur via la superglobale $_SESSION
        $user_id = $_SESSION['user_id'];
        // requête sql protégée des injections sql 
        $sql = "UPDATE `posts` SET `title` = :title, `date` = :date, `content` = :content, `img` = :img, `user_id` = :user_id WHERE `id` = :id";
        // associations des bonnes valeurs
        $params = [
            'id' => $this->id,
            'title' => $this->title,
            'date' => $this->date,
            'content' => $this->content,
            'img' => $this->img,
            'user_id' =>  $user_id
        ];
        $query = $pdo->prepare($sql);
        // execution de la méthode en passant le tableau de params
        $queryStatus = $query->execute($params);
        return $queryStatus;
    }

    public static function deletePost(int $postId): bool
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
     * Get the value of img
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * Set the value of img
     */
    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    /**
     * Get the value of date
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get the value of contenu
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of contenu
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}
