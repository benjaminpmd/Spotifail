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
        if(isset($page_description)) {
            echo "<meta name=\"description\" content=\"".$page_description."\" />\n";
        }
        else echo "<meta name=\"description\" content=\"Spotifail, la musique sans l'écoute. Ce site est réalisé dans le cadre du projet de l'UE Développement Web 2022 à Cergy Paris Université.\" />\n";

        if(isset($page_date)) {
            echo "\t<meta name=\"date\" content=\"".$page_date."\" />\n";
        }
        else echo "\t<meta name=\"date\" content=\"".$DEFAULT_DATE."\" />\n";
    ?>
	<meta name="lieu" content="CY Cergy Paris Université" />
    <?php
        if(isset($page_title)) {
            echo "<title>".$page_title."</title>\n";
        }
        else echo "<title>DevWeb - Benjamin P</title>\n";
    ?>
    <link rel="icon" href="./images/favicon.ico" />
    <?php
        echo "<link rel=\"stylesheet\" href=\"".get_stylesheet_path()."\" />\n"
    ?>
</head>
<body>
	<header id="#top">
        <?php
            echo "<a href=\"index.php\"><img id=\"head-logo\" src=\"./images/spotifail.png\" height=\"50\" alt=\"Spotifail Logo\"/></a>\n"; 
            echo "\t\t<p id=\"slogan\">La musique, sans l'écoute.</p>\n";
        ?>
        <nav>
			<ul>
			</ul>	
		</nav>
        <?php
            if (isset($page_title)) {
                echo "\t<h1>".$page_title."</h1>\n";
            }
            else echo "\t<h1>Spotifail</h1>\n";
        ?>
    </header>
