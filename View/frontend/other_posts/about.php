<?php
	$title = 'Jean Forteroche'; 
	ob_start();
?>
<section id="other_text">
	<h3 >A propos</h3>
	<p><strong>Jean Forteroche</strong>, à commencer dans le théâtre. de fil en aiguille il entame des apparitions, seconds rôles et publicité. Se faisant repérer par une grande production du cinéma, il saisi sa chance dans un premier rôle saluer par la critique.</p>

	<p>Les années passent, voyages et tournages enrichissent son expérience. Et c'est alors qu'il se découvre une nouvelle passion des plus inattendues l'écriture. A force de lire les scenario il en  dévellope, lui même, l'aptitude. </p>

	<p>Après avoir réalisé quelques ouvrages papier. il s'ouvre aujourd'hui vers une nouvelle aventure. l'écriture en ligne. la lecture numérique étant incontournable aujourd'hui, il se lance courageusement dans cette persepctive.</p>
</section>

<?php 
	$content = ob_get_clean();
	require('View/frontend/theme/template.php'); 
?>