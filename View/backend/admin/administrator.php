<?php 
    $title = 'administrateur';
    ob_start();
?>
<h2>Profils</h2>
<p style="text-align: center;">Espace de gestion des profil administrateurs. toute suppression est direct et irrévocable. Veuillez être sur avant toute manipulation.<br />
</p>
<p>
    <?php
    if (isset($_GET['return'])) {
      echo 'veuillez vérifier vos identifiants';
    }
    if (isset($_GET['pseudo'])) {
      echo 'pseudo existant';
    }
  ?> 
</p>
<button>Nouveau</button>
<table>            
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Pseudo
                </th>
                <th>
                    Email
                </th>
                <th>
                    Action
                </th>                
            </tr>
           
            <?php
            while ($data = $admins->fetch())
            {
            ?>
            <tr class="bg_white">

                <td>                                               
                    le <?= $data['inscription_date_fr'] ?>
                </td>
                <td>
                   <?= $data['name'] ?>
                </td>
                <td>
                    <?= $data['firstname'] ?>
                </td>
                <td>
                    <?= $data['pseudo'] ?>
                </td>
                <td>
                    <?= $data['email'] ?>
                </td>
                <td>
                    <a href="index.php?action=admin&amp;status=connected&amp;activity=updateAdmin&amp;admin_id=<?=$data['id']?>">Modifier</a> - <a href="index.php?action=admin&amp;status=connected&amp;activity=deleteAdmin&amp;admin_id=<?=$data['id']?>">Supprimer</a>
                </td>
           </tr>
            <?php
            }
            $admins->closeCursor();
            ?>
        </table>
<script type="text/javascript">
    let button = document.getElementsByTagName('button')[0];

    button.addEventListener("click",function() {
        location.href ="index.php?action=admin&status=connected&activity=addAdmin";
    })
</script>
<?php
    $content = ob_get_clean(); 
    require('View/backend/theme/template.php');
?>