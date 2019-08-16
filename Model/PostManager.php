<?php
namespace Blog\Jean_Forteroche\Model; 
use \Blog\Jean_Forteroche\Model\Manager;
require_once("Model/Manager.php");
/**
 * 
 */
class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');

        return $req;
    }
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    public function getNumberPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT  COUNT(*) as nb FROM posts');

        return $req;
    }
    public function getPaging($limit)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC '. $limit);

        return $req;
    }
    public function addPost($title,$content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content) VALUES (?,?)');
        $affectedLines = $req->execute(array($title,$content));

        return $affectedLines;
    }
    public function updatePost($title,$content,$postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE  posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $req->execute(array($title,$content,$postId));
        
        return $affectedLines;
    }
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedPost = $req->execute(array($postId));

        return $affectedPost;
    }
}