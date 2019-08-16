<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="description" content="Blog de Jean Forteroche - un billet simple pour l'Alaska - Administration" />
        <meta name="viewport" content="width=device-width">
        <!--favicon-->             
        <link rel="icon" type="image/x-icon" href="public/images/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="public/images/favicon.ico" />
        <link rel="apple-touch-icon" href="public/images/favicon.ico" />
        <!-- Meta tag-->
        <!-- Open Graph data -->
        <meta property="og:title" content="Jean Forteroche"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://web-agency-corp.fr/projet_4/"/>
        <meta property="og:image" content="public/images/alaska_route.png"/>
        <meta property="og:description" content="un billet simple pour l'Alaska"/>
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="Jean Forteroche">
        <meta name="twitter:site" content="http://web-agency-corp.fr/projet_4/">
        <meta name="twitter:title" content="Jean Forteroche ">
        <meta name="twitter:description" content="un billet simple pour l'Alaska ">
        <meta name="twitter:creator" content="@jean_forteroche">
        <meta name="twitter:image" content="public/images/alaska_route.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    	<main id="contenu">
	<header>
		<h1>Jean Forteroche</h1>

		<h2>Billet simple pour l'Alaska</h2>	
	</header>
	<section id="menu">
        <h2>Mon menu</h2>
		<nav>
			<ul>
				<li><a href="index.php?page=1">Accueil</a></li>
				<li><a href="index.php?action=about">A propos</a></li>
				<li><a href="index.php?action=utilisation">Utilisation</a></li>
				<li><a href="index.php?action=contact">Contact</a></li>
			</ul>
		</nav>
	</section>
	<?= $content ?>
	<footer>
		<p> <a href="index.php?action=admin&status=waiting" id="connexion" target="_blank">Administration</a>
        <br />
		ZAHOUI Frédéric - Projet n°4 - OpenClassrooms
        </p>
	</footer>
</main>
    </body>
</html>