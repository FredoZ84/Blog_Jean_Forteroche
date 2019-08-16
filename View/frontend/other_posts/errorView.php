<?php 
	$title = 'Erreur'; 
	ob_start();
?>

<h3 id="error">Erreur</h3>

<p><a href="index.php">Retour à l'accueil'</a></p>

<?php 
	$content = ob_get_clean();
	require('View/frontend/theme/template.php'); 
?>