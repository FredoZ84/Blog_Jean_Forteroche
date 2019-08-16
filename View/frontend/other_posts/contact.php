<?php 
	$title = 'Jean Forteroche'; 
	ob_start();
?>
<section id="contact">
	<h3>Contact</h3>
	
	<form method="post" action="">
		<p>
			<label for="name">Nom</label>
			<input type="text" name="name" id="name">
			<br />
			<label for="firstname">Prénom</label>
			<input type="text" name="firstname" id="firstname">
			<br />
			<label for="email">E-mail</label>
			<input type="mail" name="email" id="email">
			<br />
			
		</p>
		<p>
			<label for="content">Message</label>
			<br />
			<textarea name="content" id="content"></textarea>
			<br />
			<input type="submit" value="envoyer" />
		</p>		
	</form>
	
</section>

<?php 
	$content = ob_get_clean(); 

	require('View/frontend/theme/template.php');
?>