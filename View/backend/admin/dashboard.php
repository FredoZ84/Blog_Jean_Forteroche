<?php
$title = 'Tableau de bord'; 

ob_start(); 
?>
<section>
	<h1> Tableau de bord</h1>
<h2 id="welcom"> Bienvenue</h2>

</section>
<?php 
$content = ob_get_clean(); 

require('View/backend/theme/template.php');
?>