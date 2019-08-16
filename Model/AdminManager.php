<?php
namespace Blog\Jean_Forteroche\Model;
use \Blog\Jean_Forteroche\Model\Manager;
require_once("Model/Manager.php");
/**
 * 
 */
class AdminManager extends Manager
{
	public function authentication($pseudo)
	{
		$db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass FROM admin WHERE pseudo = ? ');
        $req->execute(array($pseudo));

        return $req;
	}
	public function getAdmins()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, name, firstname, pseudo, pass, email, DATE_FORMAT(inscription_date, \'%d/%m/%Y à %Hh%imin%ss\') AS inscription_date_fr FROM admin ORDER BY id');

        return $req;
    }
    public function getAdmin($adminId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, name, firstname, pseudo, pass, email, DATE_FORMAT(inscription_date, \'%d/%m/%Y à %Hh%imin%ss\') AS inscription_date_fr FROM admin  WHERE id = ?');
        $req->execute(array($adminId));
        $admin = $req->fetch();

        return $admin;
    }
    public function addAdmin($name,$firstname,$pseudo,$pass,$email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO admin (name, firstname, pseudo, pass, email) VALUES (?,?,?,?,?)');
        $affectedLines = $req->execute(array($name,$firstname,$pseudo,$pass,$email));

        return $affectedLines;
    }
    public function updateAdmin($name,$firstname,$pseudo,$pass,$email,$adminId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE  admin SET name = ?, firstname = ?, pseudo = ?, pass = ?, email = ?  WHERE id = ?');
        $affectedLines = $req->execute(array($name,$firstname,$pseudo,$pass,$email,$adminId));
        
        return $affectedLines;
    }
    public function deleteAdmin($adminId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM admin WHERE id = ?');
        $affectedAdmin = $req->execute(array($adminId));

        return $affectedAdmin;
    }
    public function pseudoExistence($pseudo) // Verifie l'exitense du pseudo
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo FROM admin WHERE pseudo = ?');
        $req->execute(array($pseudo));

        return $req;
    }
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId,));
        $post = $req->fetch();

        return $post;
    }
}