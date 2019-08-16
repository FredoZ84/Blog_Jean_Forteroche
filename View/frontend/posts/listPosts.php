<?php 
	$title = 'Jean Forteroche'; 
	ob_start(); 
 ?>
<section id="posts">
	<h3>Bienvenue</h3>
	<p>Il y a actuellement, <strong><?= $total_number_posts ?></strong> articles.<br />
	Page <b><?= $page_num ?></b> sur <b><?= $last_page ?></b></p>
	<?php
	while ($data = $req->fetch())
	{
	?>
	<fieldset class="news">
        <legend>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </legend>
        <h4><?= htmlspecialchars($data['title']) ?></h4>        
        <div class="post_limited">
        	<?= html_entity_decode(htmlspecialchars($data['content'])) ?>
        </div>        
        <p class="read_post">    
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>#menu">Lire l'article</a></em>
        </p>
	</fieldset>
	<?php
	}
	$req->closeCursor();
	?>
	<div id="pagination">'<?= $pagination ?> '</div>
</section>
<?php 
	$content = ob_get_clean();
	require('View/frontend/theme/template.php'); 
?>