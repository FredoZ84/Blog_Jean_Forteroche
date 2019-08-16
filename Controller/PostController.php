<?php
namespace Blog\Jean_Forteroche\Controller;

use \Blog\Jean_Forteroche\Model\PostManager;
use \Blog\Jean_Forteroche\Model\CommentManager;
use \Blog\Jean_Forteroche\Model\Manager;

spl_autoload_register(function($class) {

    if (preg_match('/Controller/', $class)) {
        $folder = 'Controller';     
    }
    elseif ( preg_match('/Manager/', $class)) {
        $folder = 'Model';
    }
    else {
        echo"dossier non trouvé";
    }   

    $class = str_replace('Blog\Jean_Forteroche\\'.$folder.'\\' , '', $class);
    require_once($folder.'/'.$class . '.php');
});


class PostController
{
    public function listPosts()
    {
        $postManager = new PostManager();        

        $numberPosts = $postManager->getNumberPosts();
        $data = $numberPosts->fetch(); 

        $total_number_posts = intval($data['nb']);

        $number_posts_per_page = 3;

        $number_links_left_right = 2;

        $last_page = ceil($total_number_posts / $number_posts_per_page);

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page_num = $_GET['page'];
        } else {
            $page_num = 1;
        }

        if ($page_num < 1) {
            $page_num = 1;
        } else if ($page_num > $last_page) {
            $page_num = $last_page;
        }

        $limit = ' LIMIT '.($page_num - 1) * $number_posts_per_page. ','. $number_posts_per_page;        

        $pagination = '';

        if ($last_page != 1) {
            if ($page_num > 1) {
                $previous = $page_num -1;
                $pagination .='<a href="index.php?page='.$previous.'"><i class="fas fa-arrow-circle-left brown"></i>&nbsp;Précédent</a> &nbsp; &nbsp;';
                for ($i = $page_num - $number_links_left_right; $i < $page_num ; $i++) { 
                    if ($i > 0) {
                        $pagination .= '<a href="index.php?page='. $i. '">'.$i.'</a> &nbsp;';
                    }
                }
            }

            $pagination .= '<span class = "active">'.$page_num.'</span> &nbsp;';

            for ($i=$page_num+1; $i <= $last_page ; $i++) { 
                $pagination .= '<a href="index.php?page='. $i. '">'.$i.'</a> &nbsp; &nbsp;';
                if ($i >= $page_num + $number_links_left_right) {
                    break;
                }
            }

            if ($page_num != $last_page) {
                $next = $page_num + 1;
                $pagination .= '<a href="index.php?page='. $next.'">Suivant &nbsp;<i class="fas fa-arrow-circle-right brown"></i></a>';
            }
        }

        $req = $postManager->getPaging($limit);

        require('View/frontend/posts/listPosts.php');
    }
    public function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        $numberPosts = $postManager->getNumberPosts();
        $data = $numberPosts->fetch(); 
        $nb = intval($data['nb']);

        $listPosts = $postManager->getPosts();

        $pagination = '';    

        if ($nb != 1) {
            if ($_GET['id'] > 1) {
                $previous = $_GET['id'] - 1;
                $pagination .= '<a href="index.php?action=post&amp;id='. $previous.'#title"><i class="fas fa-arrow-circle-left brown"></i>&nbsp;Précédent</a>';
            }
            
            $pagination .= '&nbsp; <strong>Article</strong> &nbsp;';

            if ($_GET['id'] != $nb) {
                $next = $_GET['id'] + 1;
                 $pagination .= '<a href="index.php?action=post&amp;id='.$next.'"#title>Suivant &nbsp;<i class="fas fa-arrow-circle-right brown"></i></a>';
            }
        }

        require('View/frontend/posts/post.php');
    }
    public  function callPageFrontend($page)
    {
        if ($page == 'about' || $page == 'errorView' || $page == 'utilisation' || $page == 'contact') {
            require('View/frontend/other_posts/'.$page.'.php');
        } elseif ($page == 'listPosts' || $page == 'posts') {
            require('View/frontend/posts/'.$page.'php');
        }        
    }
    public function addPost()
    {        
        $postManager = new PostManager();        

        if (!isset($_POST['title']) && !isset($_POST['article'])) {
            require('View/backend/posts/addPost.php');
        } else {
            $affectedLines  = $postManager->addPost($_POST['title'], $_POST['article']);
            if ($affectedLines === false) {
                throw new Exception('Impossible d\'ajouter l\'article !');
            }
            else {
                header('Location: index.php?action=admin&status=connected&activity=listPostsTable');
            }  
        }              
    }
    public function updatePost()
    {
        $postManager = new PostManager(); 

        if (!isset($_POST['title']) && !isset($_POST['article']) && !isset($_POST['id'])) {
            $post = $postManager->getPost($_GET['id']);
            $submissionLink = 'index.php?action=admin&amp;status=connected&amp;activity=updatePost&amp;id='. $_GET['id'];
            require('View/backend/posts/updatePost.php');
        } else {
            $affectedLines = $postManager->updatePost($_POST['title'],$_POST['article'],$_POST['id']);
            header('Location: index.php?action=admin&status=connected&activity=post&id='.$_POST['id']);
        } 
    }
    public function deletePost($postId)
    {
        $postManager = new PostManager();
        
        if (!isset($_POST['removal'])) {
            $post = $postManager->getPost($_GET['id']);
            require('View/backend/posts/postViewAdmin.php');
        }
        elseif (isset($_POST['removal']) && $_POST['removal'] == 'non' ) {
            header('Location: index.php?action=admin&status=connected&activity=listPostsTable');
        }
        elseif (isset($_POST['removal']) && $_POST['removal'] == 'oui' ) {
            $postManager->deletePost($postId);
            header('Location: index.php?action=admin&status=connected&activity=listPostsTable');
        }       
    }
}