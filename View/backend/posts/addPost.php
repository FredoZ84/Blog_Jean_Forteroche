<?php 
	$title = 'Création d\'article';
	ob_start();
?>
<form action="index.php?action=admin&amp;status=connected&amp;activity=addPost" method="post" id="addPost">

    <p>
    	<label for="title">Titre</label>
    	<input type="text" id="title" name="title" />

        <textarea id="article" name="article" class="tinymce"></textarea>
        <br />
        <input type="submit" />
    </p>
        
</form>

<?php 
	$content = ob_get_clean(); 
	require('View/backend/theme/template.php');
?>