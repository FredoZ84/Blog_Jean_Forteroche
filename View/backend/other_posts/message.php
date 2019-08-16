<?php 
	$title = 'Message';
	ob_start();
?>

<h2>Message reçu</h2>
<?php 
	$content = ob_get_clean();
	require('template.php');
?>