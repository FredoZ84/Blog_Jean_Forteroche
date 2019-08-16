<?php 
    $title = 'Mon blog';
    ob_start(); 
?>
<div id="report">
    <table class="comments">
        <tr>
            <td class="bg_brown white">
                    <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
            </td>            
        </tr>
        <tr>
            <td class="bg_lightgrey">
                <?= nl2br(htmlspecialchars($comment['comment'])) ?>
            </td>                        
        </tr>
    </table>
</div>

<div class="comment">
    <h3>Signalement</h3>

    <form action="index.php?action=reporting" method="post">
        <div>Etes vous sûr de vouloir signaler ?
            <br />        
            <label for="oui">Oui</label>
            <input type="radio" name="report" value="oui" id="oui" />
            <br />
            <label for="non">Non</label> 
            <input type="radio" name="report" value="non" id="non" />
            <br />
            <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
            <input type="hidden" name="id" value="<?= $comment['id'] ?>"> 
            <input type="submit" />  
        </div>
    </form>
</div>


<?php 
    $content = ob_get_clean();
    require('View/frontend/theme/template.php');
?>