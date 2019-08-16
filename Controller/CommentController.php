<?php
namespace Blog\Jean_Forteroche\Controller;

use \Blog\Jean_Forteroche\Model\PostManager;
use \Blog\Jean_Forteroche\Model\CommentManager;

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

class CommentController 
{
	public function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    public function getComment($commentId)
    {
        $commentManager = new CommentManager();

        $comment = $commentManager->getComment($commentId);

        require('View/frontend/posts/comment.php');
    }
    public function reporting($commentId,$postId)
    {
        $commentManager = new CommentManager();

        if ($_POST['report'] == oui) {
                    $reporting = $commentManager->reporting($commentId);
        }    
        
        header('location: index.php?action=post&id=' . $postId );
    }
    public function warning()
    {
        # code...
    }
}