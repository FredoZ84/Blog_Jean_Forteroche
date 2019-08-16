<?php 
    $title = 'Ajouté un administrateur';
    ob_start();
?>
<h2> Nouveau Profil</h2>
        
<form method="post" action="index.php?action=admin&amp;status=connected&amp;activity=addAdmin" id="addAdmin">
   <p>
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" placeholder="Votre Nom" required="required" />

        <br />
        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" id="firstname" placeholder="Votre Prénom" required="required" />

        <br />
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" required="required" />

        <br />
        <label for="pass">Votre mot de passe :</label>
        <input type="password" name="pass" id="pass" required="required"  />
        <span id="help_password" style="display: none; color: white">6 caractères requis</span>

        <label for="pass_c">Confirmez votre mot de passe :</label>
        <input type="password" name="pass_c" id="pass_c" required="required" />

        <br />
        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" placeholder="Votre e-mail" required="required" /> 

        <label for="email_c">Confirmez votre E-mail :</label>
        <input type="email" name="email_c" id="email_c" placeholder="Confirmez Votre e-mail" required="required" />      

        <br />
        <input type="submit"  name="adminInscription" value="Envoyer" />  
   </p>
</form>
<script type="text/javascript">
    let pass = document.getElementById('pass'),
        helpPassword = document.getElementById('help_password');

        pass.addEventListener("focus",function() {
            helpPassword.style.display = "inline";
        })

</script>
<?php
    $content = ob_get_clean(); 
    require('View/backend/theme/template.php');
?>