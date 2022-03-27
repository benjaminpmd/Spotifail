<?php
    declare(strict_types=1);
    include_once "./include/util.inc.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="Lucas L &amp; Benjamin P" />
    <?php
        # Description of the page
        if(isset($page_description)) {
            echo "<meta name=\"description\" content=\"".$page_description."\" />\n";
        }
        else echo "<meta name=\"description\" content=\"Spotifail, la musique sans l'écoute. Ce site est réalisé dans le cadre du projet de l'UE Développement Web 2022 à Cergy Paris Université.\" />\n";

        # Date of the page
        if(isset($page_date)) {
            echo "\t<meta name=\"date\" content=\"".$page_date."\" />\n";
        }
        else echo "\t<meta name=\"date\" content=\"".$DEFAULT_DATE."\" />\n";
    ?>
	<meta name="lieu" content="CY Cergy Paris Université" />
    <meta property="og:locale" content="fr_FR" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Spotifail" />
	<meta property="og:description" content="La musique, sans l'écoute" />
	<meta property="og:url" content="https://spotifail.benjaminp.dev" />
	<meta property="og:site_name" content="Spotifail" />
    <?php
        # Title of the page
        if(isset($page_title)) {
            echo "<title>".$page_title."</title>\n";
        }
        else echo "<title>DevWeb - Benjamin P</title>\n";
    ?>
    <link rel="icon" href="./images/favicon.ico" />
    <?php
        # stylesheet
        echo "<link rel=\"stylesheet\" href=\"".get_stylesheet_path()."\" />\n"
    ?>
</head>
<body>
	<header id="#top">
        <nav>
			<ul>
                <li class="nav-item"><a class="nav-link" href="./index.php"><img id="header-logo" src="./images/spotifail.png" height="50" alt="Spotifail Logo"/></a></li>
                <li class="nav-item"><a class="nav-link" href="./index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="./tendances.php">Tendances</a></li>
                <li class="nav-item"><a class="nav-link" href="./image-du-jour.php">L'image du jour</a></li>
			</ul>	
		</nav>
        <?php
            if (isset($page_title)) {
                echo "<h1>".$page_title."</h1>\n";
            }
            else echo "<h1>Spotifail</h1>\n";
        ?>
    </header>
