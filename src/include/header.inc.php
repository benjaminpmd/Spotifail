<?php

declare(strict_types=1);
include_once "./include/utils.inc.php";

$current_theme = get_theme();

$theme_link_image = get_theme_link_image($current_theme);
$theme_link_url = get_theme_link_url($current_theme);
$stylesheet_path = get_stylesheet_path($current_theme);

if (!isset($page_title) || empty($page_title)) {
	$page_title = "Spotifail";
}

if (!isset($page_description) || empty($page_description)) {
	$page_description = "Spotifail, la musique sans l'écoute. Ce site est réalisé dans le cadre du projet de l'UE Développement Web 2022 à Cergy Paris Université";
}

if (!isset($page_date) || empty($page_date)) {
	$page_date = "unkown";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="Lucas L &amp; Benjamin P" />
	<meta name="description" content="<?php echo $page_description; ?>" />
	<meta name="date" content="<?php echo $page_date ?>" />
	<meta name="lieu" content="CY Cergy Paris Université" />

	<meta property="og:locale" content="fr_FR" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $page_title; ?>" />
	<meta property="og:description" content="<?php echo $page_description; ?>" />
	<meta property="og:url" content="https://spotifail.benjaminp.dev" />
	<meta property="og:site_name" content="Spotifail" />
	<meta property="og:image" content="https://spotifail.benjaminp.dev/images/spotifail.png" />
	<title><?php echo $page_title; ?></title>

	<link rel="icon" href="./images/favicon.ico" />
	<link rel="stylesheet" href="<?php echo $stylesheet_path; ?>" />
</head>

<body>
	<header id="#top">
		<nav>
			<ul>
				<li class="nav-item"><a class="nav-link" href="./index.php"><img id="header-logo" src="./images/spotifail.png" height="50" alt="Spotifail Logo" /></a></li>
				<li class="nav-item"><a class="nav-link" href="./index.php">Accueil</a></li>
				<li class="nav-item"><a class="nav-link" href="./tendances.php">Tendances</a></li>
				<li class="nav-item"><a class="nav-link" href="./recherche.php">Recherche</a></li>
			</ul>
			<form action="recherche.php" id="quick-search">
				<input type="text" placeholder=" Titre, Artiste..." name="q" />
				<input type="image" name="submit" src="./images/search.png" alt="rechercher" />
				<input type="hidden" name="track" value="on" />
				<input type="hidden" name="artist" value="on" />
				<input type="hidden" name="album" value="on" />
				<input type="hidden" name="tag" value="on" />
			</form>
			<a href="<?php echo format_for_link($theme_link_url); ?>" id="theme-link"><img src="<?php echo $theme_link_image; ?>" alt="changez le thème ici" id="theme-icon" /></a>
		</nav>
		<h1><?php echo $page_title; ?></h1>
	</header>