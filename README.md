# Music - Spotifail

Ce projet est réalisé par Lucas LENAERT et Benjamin PAUMARD, étudiants en deuxième année de licence informatique à CY Cergy Paris Université. Ce projet met en application les connaissances acquises dans l'UE Développement Web.

## Introduction

Ce projet a pour but de créer un site dédié à la musique en faisant appel à des API. Le site est réalisé en HTML5, CSS3 et PHP7.
Ce site propose différentes pages dédiées à la consultation d'informations sur les titres, albums ou artistes musicaux. Une page de recherche permet de trouver ce que l'on souhaite. Des options sont disponibles pour spécifier l'objet de la recherche. On peut par exemple, spécifier de n'afficher que les titres sans les albums. L'utilisateur peut aussi avoir accès aux titres et artistes les plus écoutés de la semaine sur une page dédié.

## Lien d'hébergement

Le site est hébergé sur [ce lien](https://spotifail.benjaminp.dev), ou bien [ici](http://llenaert.alwaysdata.net/projet).

## Solutions externes utilisées

Les données concernant les éléments musicaux affichés à l'utilsateur sont fournies par [l'API "Last.fm Music Discovery API"](https://www.last.fm/api).

Ces éléments sont récupérés via différentes requêtes HTTP(S) effectuées avec l'aide de la librairie cURL, disponible nativement en PHP.

De manière complémentaire, le site internet permet de déterminer une position approximative de l'utilisateur grâce à son adresse IP et aux [services de geoPlugin](https://www.geoplugin.com/webservices/xml) ainsi que d'afficher l'image du jour de [l’API "APOD" (Astronomy Picture of The Day) de la NASA](https://apod.nasa.gov/apod/astropix.html) sur une page dédiée.

## Stockage

Pour assurer le fonctionnement du site et une meilleure ergonomie à l'utilisateur, des données sont stockées de différentes manières coté client et coté serveur.

### Cookies

Le site permet un stockage côté client de la dernière musique consultée ainsi que du thème sélectionné (clair / sombre) via l'utilisation de cookies. Ces cookie ont une validitée fixée à un an.

### Stockage côté serveur

Il permet également un stockage côté serveur des titres consultées par l'ensemble des utilisateurs dans un fichier en format **.csv**. La page de statistiques permet d'afficher les musiques consultées sous la forme d'un histogramme indiquant également le nombre de visite pour les titres présents dans le fichier.
