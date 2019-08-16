<?php
namespace Blog\Jean_Forteroche\Controller;

use \Blog\Jean_Forteroche\Model\AdminManager;
use \Blog\Jean_Forteroche\Model\CommentManager;
use \Blog\Jean_Forteroche\Model\PostManager;


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

class AdminController 
{
    public  function callPageBackend($page)
    {
        if ( $page == 'connexion'  || $page == 'dashboard' || $page == 'comments' ) {
            require('View/backend/admin/'.$page.'.php');
        } elseif ($page == 'message') {
            require('View/backend/other_post'.$page.'.php');
        }
        elseif ($page == 'listPosts' || $page == 'posts') {
            require('View/backend/'.$page.'.php');
        }        
    }
	public function verification()
	{
		$adminManager = new AdminManager();		
 
    	$authentication = $adminManager->authentication($_POST['pseudo']);
    	   // Verifie que le pseudo soit bon
        $resultat = $authentication->fetch();

        
        $passwordCorrect = password_verify($_POST['pass'], $resultat['pass']);
        //Vérifie que le mot de pass soit bon

        if (!$resultat) 
        {
            $retour_connexion = 'veuillez vérifier vos identifiants';
            header('Location: index.php?action=admin&status=disconnected&return='. $retour_connexion);
        }
        else
        {
          	if ($passwordCorrect) {
                $_SESSION['pseudo'] = $resultat['pseudo'];
                header('Location: index.php?action=admin&status=connected&activity=dashboard');
            } else {
               $retour_connexion = 'veuillez vérifier vos identifiants';
                header('Location: index.php?action=admin&status=disconnected&return='. $retour_connexion);
            }
            
            
        }		
	}
    public function administrator() {
    	$adminManager = new AdminManager();

        $admins = $adminManager->getAdmins();
        require('View/backend/admin/administrator.php');       
    }
    public function addAdmin()
    {
        $adminManager = new AdminManager();
        

        if (!isset($_POST['adminInscription'])) {
           require('View/backend/admin/addAdmin.php');
        } elseif (isset($_POST['adminInscription']) AND ($_POST['pass'] == $_POST['pass_c']) AND ($_POST['email'] == $_POST['email_c']) ) { // Vérification de la coresspondance de l'E-mail et du mot de passe

            if (preg_match("#^[a-zA-Z0-9]{2,15}$#", $_POST['pseudo']) AND preg_match("#^[a-zA-Z0-9!_]{6,}$#", $_POST['pass']) AND preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))           
            { // Vérification du bon format du pseudo du mot  de pass et de l'e-mail
                $research = $adminManager->pseudoExistence($_POST['pseudo']);
                $verification = $research->fetch();
                
                if (!$verification) {// Vérifie l'éxistence du Pseudo
                    $name = htmlspecialchars($_POST['name']);
                    $firstname = htmlspecialchars($_POST['firstname']);
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $pass_hache = crypt($_POST['pass']) ;
                    $email = htmlspecialchars($_POST['email']);

                    $adminManager->addAdmin($name,$firstname,$pseudo,$pass_hache,$email);
                    header('Location: index.php?action=admin&status=connected&activity=administrator');
                } else {
                     header('Location: index.php?action=admin&status=connected&activity=administrator&pseudo=verify');
                }              
                    
            }
                       
        }
        else {
            header('Location: index.php?action=admin&status=connected&activity=administrator&return=verify');
        }
    }
    public function updateAdmin()
    {
        $adminManager = new AdminManager();
        if (!isset($_POST['adminModification'])) {
            $admin = $adminManager->getAdmin($_GET['admin_id']);
            $submissionLink ='index.php?action=admin&amp;status=connected&amp;activity=updateAdmin&amp;admin_id='. $_GET['admin_id'];
            require('View/backend/admin/updateAdmin.php');
        } elseif(isset($_POST['adminModification'])) {
            $name = htmlspecialchars($_POST['name']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $pass_hache = crypt($_POST['pass']) ;
            $email = htmlspecialchars($_POST['email']);
            $adminId = htmlspecialchars($_POST['id']);
            $affectedLines = $adminManager->updateAdmin($name,$firstname,$pseudo,$pass_hache,$email, $adminId);
            header('Location: index.php?action=admin&status=connected&activity=administrator');
        } 
    }
    public function deleteAdmin()
    {
        $adminManager = new adminManager();
       
        $admin = $adminManager->deleteAdmin($_GET['admin_id']);
        header('Location: index.php?action=admin&status=connected&activity=administrator');
    }
    public function listPostsTable()
    {
        $postManager = new PostManager(); 
        $posts = $postManager->getPosts(); 

        require('View/backend/posts/listPostsTable.php');
    }
    public function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        $numberPosts = $postManager->getNumberPosts();
        $data = $numberPosts->fetch(); 

        $total_number_posts = intval($data['nb']);

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $post_num = $_GET['id'];
        } else {
            $post_num = 1;
        }

        if ($post_num < 1) {
            $post_num = 1;
        } else if ($post_num > $total_number_posts ) {
            $page_num = $total_number_posts;
        }

        $pagination = '';

        if ($total_number_posts != 1) {
            if ($post_num > 1) {
                $previous = $post_num -1;
                $pagination .= '<i class="fas fa-arrow-circle-left brown"></i>
                                <a href="index.php?action=admin&amp;status=connected&amp;activity=post&amp;id='. $previous .'">Précédent</a>';
            }

            $pagination .='&nbsp;<strong>Article</strong>&nbsp;';
            if ($post_num != $total_number_posts) {
                $next = $post_num + 1;
                $pagination .= '<a href="index.php?action=admin&amp;status=connected&amp;activity=post&amp;id='.$next.'">Suivant</a>
                                <i class="fas fa-arrow-circle-right brown"></i>';
            }
        }
        require('View/backend/posts/postViewAdmin.php');
    }
    public function commentsReported()
    {
        $commentManager = new CommentManager();

        $comments = $commentManager->getCommentsReported();

        require('View/backend/admin/comments.php');
    }
    public function warning()
    {
        $commentManager = new CommentManager();
       
        $comment = $commentManager->warning($_GET['comment_id']);
        header('Location: index.php?action=admin&status=connected&activity=comments');
    }
    public function deleteComment()
    {
        $commentManager = new CommentManager();
       
        $comment = $commentManager->deleteComment($_GET['comment_id']);
        header('Location: index.php?action=admin&status=connected&activity=comments');
    }
    public function disconnected()
    {
        session_start();

        // Suppression des variables de session et de la session
        session_destroy();

        $this->callPageBackend('connexion');

    }
}