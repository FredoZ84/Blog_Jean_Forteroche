<?php 
    $title = 'Mon blog';
    ob_start(); 
?>
<div id="post">
    <h3 id="title"><?= htmlspecialchars($post['title']) ?></h3>        
    
    <?= html_entity_decode(nl2br(htmlspecialchars($post['content']))) ?>
    
   <span id="post_number"><?= $post['id'] ?></span> <em>le <?= $post['creation_date_fr'] ?></em>
</div>
<div id="pagination">
    <?=  $pagination?>
    <br />
<form id="selection">
   <p>        
       <select name="article" id="article">
        <?php
        while ($data = $listPosts->fetch())
        {
        ?>
           <option value="<?= $data['id']?>"><?= htmlspecialchars($data['title']) ?></option>
        <?php
        }
        $listPosts->closeCursor();
        ?>
       </select>
       <br />
       <br />
       <a id="access_post">Se rendre</a>  
   </p>
</form>  
</div>

<div class="comment">
    <h3>Commentaires</h3>

    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
    <table class="comments">
        <tr>
            <td class="bg_brown white">
                    <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
            </td>
            
        </tr>
        <tr>
            <td class="bg_lightgrey">
                <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                <br />
                <a href="index.php?action=report&amp;comment_id=<?= intval($comment['id']) ?>" class="reporting">signaler</a>
                <span><?= htmlspecialchars($comment['warning']) ?></span>
            </td>                        
        </tr>
    </table>
    <br />
    <?php
    }
    ?>
</div>
<script type="text/javascript" src="public/js/Posts.js"></script>
<?php 
    $content = ob_get_clean();
    require('View/frontend/theme/template.php');
?>