<?php
	$title = 'Modification d\'article';
	ob_start();
?>
	<form method="Post" action="<?= $submissionLink ?>">

	    <p>
	    	<label for="title">Titre</label>
	    	<input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" />
	    	<br />
			<input type="hidden" name="id" value="<?= $post['id'] ?>" />

	        <textarea id="article" name="article" class="tinymce" >
	        	<?= html_entity_decode(htmlspecialchars($post['content']))?>
	        </textarea>

	        <input type="submit" />	     
	    </p>      
	</form>

<?php 
	$content = ob_get_clean();
	require('View/backend/theme/template.php'); 
?>