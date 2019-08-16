<?php 
    $title = 'Mon blog'; 
    ob_start(); 
?>
<div id="post">
    <h3><?= htmlspecialchars($post['title']) ?></h3>
        
    
    <?= html_entity_decode(nl2br(htmlspecialchars($post['content']))) ?>
    
    <span id="post_number"><?= $post['id'] ?></span><em>le <?= $post['creation_date_fr'] ?></em>
</div>
<div style="text-align: center;" >
	<button id="see_website">Voir sur le site</button>
	<button id="modify">Modifier</button>
	<button id="remove">Supprimer</button>
</div>


<form method="Post" action="index.php?action=admin&amp;status=connected&amp;activity=deletePost&amp;id=<?= intval($_GET['id'])?>" id="removal">
    <p>Etes vous sûr de vouloir supprimé ?
        <br />        
        <label for="oui">Oui</label>
        <input type="radio" name="removal" value="oui" id="oui" />
        <br />
        <label for="non">Non</label> 
        <input type="radio" name="removal" value="non" id="non" />
        <br /> 
        <input type="submit" />  
    </p>

</form>
<p id="pagination">
    <?= $pagination ?>
</p>
<script type="text/javascript" src="public/js/Management.js"></script>
<?php 
    $content = ob_get_clean();
    require('View/backend/theme/template.php');
?>