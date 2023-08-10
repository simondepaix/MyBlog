<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\PostModel;

class AdminController extends MainController
{
    public function renderAdmin()
    {
        $this->checkUserAuthorization(1);    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["addPostForm"])) {
                $this->addPost();
            }
            if (isset($_POST['deletePostForm'])) {
                $this->removePost();
            }
            if (isset($_POST['updatePostForm'])) {
                $this->updatePost();
            }
            
        }
        
        $this->viewType = 'admin';
        if (isset($this->subPage)) {
            $this->view = $this->subPage;
            if($_GET['id']){
                $postModel = new PostModel();
                $post = $postModel->getPostById($_GET['id']);
                if(!$post){
                    $this->data['error'] = '<div class="alert alert-danger" role="alert">L\'article n\'existe pas</div>';
                }else{
                    $this->data['post'] = $post;
                }
                                 
            }
        } else {
            $postModel = new PostModel();
            $this->data['posts'] = $postModel->getPosts();
        }


        $this->render();
    }

    public function addPost()
    {
        $errors = 0;
        
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $categories = filter_input(INPUT_POST, 'categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $thumbnail = filter_input(INPUT_POST, 'thumbnail', FILTER_SANITIZE_URL);
        $date = date('Y-m-d');

        $postModel = new PostModel();
        $postModel->setTitle($title);
        $postModel->setContent($content);
        $postModel->setImg($thumbnail);
        $postModel->setDate($date);
    

        if ($postModel->insertPost()) {
            $this->data[] = '<div class="alert alert-success" role="alert">Article enregistré avec succès</div>';
        } else {
            $this->data[] = '<div class="alert alert-danger" role="alert">Il s\'est produit une erreur</div>';
        }
        
    }


    public function updatePost()
    {
        $errors = 0;
        
        $id = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT	);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $categories = filter_input(INPUT_POST, 'categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $thumbnail = filter_input(INPUT_POST, 'thumbnail', FILTER_SANITIZE_URL);
        $date = date('Y-m-d');

        $postModel = new PostModel();
        $postModel->setId($id);
        $postModel->setTitle($title);
        $postModel->setContent($content);
        $postModel->setImg($thumbnail);
        $postModel->setDate($date);
    

        if ($postModel->updatePost()) {
            $this->data['infos'] = '<div class="alert alert-success" role="alert">Article enregistré avec succès</div>';
        } else {
            $this->data['infos'] = '<div class="alert alert-danger" role="alert">Il s\'est produit une erreur</div>';
        }
        
    }


    public function removePost()
    {
        $errors = 0;
        $postId = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_SPECIAL_CHARS);

        if (PostModel::deletePost($postId)) {
            $this->data['infos'] = '<div class="alert alert-success d-inline-block mx-4" role="alert">Article supprimé avec succès</div>';
        } else {
            $this->data['infos'] = '<div class="alert alert-danger" role="alert">Il s\'est produit une erreur</div>';
        }
    }

}
