<?php 
    $title = 'Liste d\'articles'; 
    ob_start();
?>
<section id="posts">    
    <h2>Listes d'articles</h2>
        <table>            
            <tr>
                <th>
                    Titre
                </th>
                <th>
                    Date
                </th>
                <th>
                    n°billet
                </th>
            </tr>
           
            <?php
            while ($data = $posts->fetch())
            {
            ?>
            <tr class="bg_white">
                <td>                                               
                   <a href="index.php?action=admin&status=connected&activity=post&id= <?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a> 
                </td>
                <td>
                   le <?= $data['creation_date_fr'] ?>
                </td>
                <td>
                    <?= $data['id'] ?>
                </td>
           </tr>
            <?php
            }
            $posts->closeCursor();
            ?>
        </table>
</section>

<?php
    $content = ob_get_clean(); 
    require('View/backend/theme/template.php');
?>