<?php
use \Blog\Jean_Forteroche\Controller\PostController;
use \Blog\Jean_Forteroche\Controller\CommentController;
use \Blog\Jean_Forteroche\Controller\AdminController;

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

class Router
{
    function verification()
    {
        $postController = new PostController();
        $commentController = new CommentController();
        $adminController = new AdminController();

        try { 
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'listPosts') {
                    $postController->listPosts();
                }
                elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0  ) {
                        $postController->post();
                    }
                    else {
                        // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }               
                elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            $commentController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        }
                        else {
                            // Autre exception
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    }
                    else {
                        // Autre exception
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                elseif ($_GET['action'] == 'report') {
                    if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0  ) {
                        $commentController->getComment($_GET['comment_id']);
                    }
                    else {
                        // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                        throw new Exception('Aucun identifiant de commentaires envoyé');
                    }
                }
                elseif ($_GET['action'] == 'reporting') {
                    $commentController->reporting($_POST['id'],$_POST['post_id']);
                }              
                elseif ($_GET['action'] == 'about') {
                    $postController->callPageFrontend('about');
                }
                elseif ($_GET['action'] == 'utilisation') {
                    $postController->callPageFrontend('utilisation');
                }
                elseif ($_GET['action'] == 'contact') {
                    $postController->callPageFrontend('contact');
                }
                elseif ($_GET['action'] == 'admin') {
                    if (isset($_GET['status']) && $_GET['status'] == 'waiting') {
                        $adminController->callPageBackend('connexion');
                    }
                    if (isset($_GET['status']) && $_GET['status'] == 'disconnected') {
                        $adminController->disconnected();
                    }
                    elseif (isset($_GET['status']) && $_GET['status'] == 'verification') {
                        $adminController->verification();
                    }
                    elseif (isset($_GET['status']) && $_GET['status'] == 'connected') {
                        if (isset($_GET['activity'])) {
                            if ($_GET['activity'] == 'dashboard') {
                                $adminController->callPageBackend('dashboard');
                            }
                            elseif ($_GET['activity'] == 'post') {
                                if (isset($_GET['id']) && $_GET['id'] > 0  ) {
                                    $adminController->post();
                                }
                                else {
                                    // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                                    throw new Exception('Aucun identifiant de billet envoyé');
                                }
                            } 
                            elseif ($_GET['activity'] == 'addPost') {
                                    $postController->addPost();                     
                            }
                            elseif ($_GET['activity'] == 'updatePost') {
                                if (isset($_GET['id']) && $_GET['id'] > 0  ) {
                                    $postController->updatePost();
                                }
                            }
                            elseif ($_GET['activity'] == 'deletePost') {
                                if (isset($_GET['id']) && $_GET['id'] > 0  ) {                  
                                    $postController->deletePost($_GET['id']);
                                }                    
                            }
                            elseif ($_GET['activity'] == 'administrator') {
                                $adminController->administrator();
                            }
                            elseif ($_GET['activity'] == 'listPostsTable') {
                                $adminController->listPostsTable();
                            }                           
                            elseif ($_GET['activity'] == 'addAdmin') {
                                $adminController->addAdmin();
                            }
                            elseif ($_GET['activity'] == 'updateAdmin') {
                                if (isset($_GET['admin_id']) && $_GET['admin_id'] > 0  ) {
                                $adminController->updateAdmin();
                                }
                            }
                            elseif ($_GET['activity'] == 'deleteAdmin') {
                                if (isset($_GET['admin_id']) && $_GET['admin_id'] > 0  ) {
                                $adminController->deleteAdmin();
                                }
                            }
                            elseif ($_GET['activity'] == 'comments') {
                                $adminController->commentsReported();
                            }
                            elseif ($_GET['activity'] == 'warning') {
                                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0  ) {
                                $adminController->warning();
                                }
                            }
                            elseif ($_GET['activity'] == 'deleteComment') {
                                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0  ) {
                                $adminController->deleteComment();
                                }
                            }                                               
                        }
                    }                        
                }          
            }
            else {
                $postController->listPosts();
            }
        }
        catch(Exception $e) { // S'il y a eu une erreur, alors...
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}

$router = new Router();
$router->verification();

/* if (!empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['pass'])) {  } */

