<?php
    $title = 'Commentaires';
    ob_start();
?>
	<h2>Commentaires Signalés</h2>

	<p style="text-align: center;">Un avertissement attribut un message correspondant sur le commentaire en question. 
		puis une icone vous montrera que cela a été effecutué. Et la suppression effece directement celui-ci.<br />
		Veuillez être sûr de vous avant toute révoquation.
	</p>	   
   
        <table>            
            <tr>
            	<th>
                    n° du billet
                </th>
                <th>
                    Commentaires
                </th>
                <th>
                    Date
                </th>
                <th>
                    Modération
                </th>
            </tr>
           
            <?php
            while ($data = $comments->fetch())
            {
            ?>
            <tr class="bg_white">
            	<td>
                    <a href="index.php?action=admin&status=connected&activity=post&id=<?=$data['post_id']?>"><?= $data['post_id'] ?></a>
                </td>
                <td>                                               
                   <?php if (!empty($data['warning'])) {
                   echo '<i class="fas fa-exclamation-triangle" style="color:red;"></i> &nbsp;';
                   } else {
                   	echo '';
                   }
                     ?><?= htmlspecialchars($data['comment']) ?> 
                </td>
                <td>
                   le <?= $data['comment_date_fr'] ?>
                </td>
                <td>
                    <a href="index.php?action=admin&amp;status=connected&amp;activity=warning&amp;comment_id=<?=$data['id']?>">Avertir</a> - <a href="index.php?action=admin&amp;status=connected&amp;activity=deleteComment&amp;comment_id=<?=$data['id']?>">Supprimer</a>
                </td>
           </tr>
            <?php
            }
            $comments->closeCursor();
            ?>
        </table>

<?php 
    $content = ob_get_clean(); 
    require('View/backend/theme/template.php');
?>