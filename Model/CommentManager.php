<?php
namespace Blog\Jean_Forteroche\Model; 
use \Blog\Jean_Forteroche\Model\Manager;
require_once("Model/Manager.php");
/**
 * 
 */
class CommentManager extends Manager
{
	
	public function getComments($postId)
	{
		$db = $this->dbConnect();
	    $comments = $db->prepare('SELECT id, author, comment,post_id, warning, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
	    $comments->execute(array($postId));

	    return $comments;
	}
	public function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnect();
	    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $comment));

	    return $affectedLines;
	}
	public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment,post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, warning FROM comments WHERE id = ?');        
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }
    public function getCommentsReported()
    {
    	$db = $this->dbConnect();
    	$req = $db->query('SELECT id, author, comment,post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, warning FROM comments WHERE reporting = 1');

    	return $req;
    }
    public function reporting($commentId)
    {
    	$db = $this->dbConnect();
    	$req = $db->prepare('UPDATE comments SET reporting = 1 WHERE id = ?');
    	$reporting = $req->execute(array($commentId));    	

    	return $reporting;
    }
    public function warning($commentId)
    {
        $db = $this->dbConnect();
    	$req = $db->prepare('UPDATE comments SET warning = "Votre commentaire à été signalé. nous vous invitons à éviter ce genre de propos et à rester courtois" WHERE id = ?');
    	$warning = $req->execute(array($commentId));

    	return $warning;
    }
    public function deleteComment($commentId)
    {
    	$db = $this->dbConnect();
    	$req = $db->prepare('DELETE FROM comments WHERE id = ?');
    	$affectedComment = $req->execute(array($commentId));

    	return $affectedComment;
    }    
}