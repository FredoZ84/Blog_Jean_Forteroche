<?php 
    $title = 'Modifié un administrateur';
    ob_start();
?>
<h2> Modification de Profil</h2>
        
<form method="post" action="<?=$submissionLink ?>" id="addAdmin">
   <p>
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name"  value="<?= $admin['name'] ?>" />

        <br />
        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" id="firstname"value="<?= $admin['firstname']?>"  />

        <br />
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" id="pseudo"value="<?=$admin['pseudo'] ?>"  />

        <br />
       <label for="pass">Votre mot de passe :</label>
        <input type="password" name="pass" id="pass" value="<?=$admin['pass'] ?>" />

        <br />
        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email"value="<?=$admin['email'] ?>"  />

        <input type="hidden" name="id" value="<?=$admin['id'] ?>">      

        <br />
        <input type="submit"  name="adminModification" value="Envoyer" />  
   </p>
</form>
<?php
    $content = ob_get_clean(); 
    require('View/backend/theme/template.php');
?>