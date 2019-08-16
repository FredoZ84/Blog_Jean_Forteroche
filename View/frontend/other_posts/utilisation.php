<?php 
	$title = 'Jean Forteroche'; 
	ob_start(); 
?>
<section id="other_text">
<h3>Charte d'utilisation</h3>

<p>
Cette charte a été élaborée afin de préciser aux utilisateurs du blog, Jean Forteroche - Un billet simple pour l'Alaska, les conditions d'utilisation de ce dernier, notamment l'utilisation des services de communication (tels que les commentaires) permettant à des utilisateurs du monde entier, possédant généralement des cultures différentes, d'échanger des messages en ligne. </p>

<p>Toute personne naviguant sur le site est considérée comme un utilisateur, qu'elle soit identifiée ou non sur le site. </p>

<p>Chaque article possède sa zone de commentaire librement ouverte pour permettre au plus grand nombre de discuter librement sur des sujets correspondant. Toutefois, afin de garantir la meilleure qualité dans les échanges et de protéger les utilisateurs des messages insultants ou inappropriés d'usagers indélicats, le blog est modéré a posteriori, ce qui signifie que des personnes accréditées (les modérateurs) ont la possibilité de supprimer les messages ne se conformant pas à la présente charte. 
</p>
</section>
<?php 
	$content = ob_get_clean(); 
	require('View/frontend/theme/template.php'); 
?>