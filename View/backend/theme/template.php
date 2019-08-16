<?php    
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <!--favicon-->             
        <link rel="icon" type="image/x-icon" href="public/images/favicon_2.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="public/images/favicon_2.ico" />
        <link rel="apple-touch-icon" href="public/images/favicon_2.ico" />
        <!--description-->
        <meta name="description" content="Blog de Jean Forteroche - un billet simple pour l'Alaska - Administration" />
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
        <link href="public/css/style_admin.css" rel="stylesheet" /> 
    </head>        
    <body>
        <header>
            <h1>Administration</h1>
        </header>
        <section id="menu">
            <nav>
                <?php
                    $link = 'index.php?action=admin&amp;status=connected&amp;activity=';
                    $dashboard = $link.'dashboard';
                    $addPost = $link.'addPost'; 
                    $listPostsTable = $link. 'listPostsTable';
                    $administrator = $link.'administrator';
                    $comments = $link. 'comments';
                ?>
                <ul>
                    <li><a href="<?= $dashboard ?>">Accueil</a></li>
                    <li><a href="<?= $addPost ?>">Creer un article</a></li>
                    <li><a href="<?= $listPostsTable ?>">Articles</a></li>
                    <li><a href="<?= $administrator ?>">Administrateur</a></li>
                    <li><a href="<?= $comments ?>">Commentaires</a></li>
                </ul>
            </nav>
        </section>
        <main id="contenu">
            <?= $content ?> 
        </main>

                  

        <p class="return">
            <a href="index.php" class="site_return" target="_blank">Voir le site</a>
            <i class="fas fa-arrow-circle-right"></i>
        </p>
        <button id="disconnected">Se déconnecter</button>
        <footer>
            <p> Blog de Jean Forteroche - Billet Simple pour l'Alaska
            <br />
            ZAHOUI Frédéric - Projet n°4 - OpenClassrooms
            </p>
        </footer>
        
        <script type="text/javascript" src="public/js/jquery.min.js"></script>
        <script type="text/javascript" src="public/plugin/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="public/plugin/tinymce/init-tinymce.js"></script>
        <script type="text/javascript">
            let disconnected = document.getElementById('disconnected');
            disconnected.addEventListener("click",function() {
                location.href = "index.php?action=admin&status=disconnected";
            })
        </script>         
    </body>
</html>