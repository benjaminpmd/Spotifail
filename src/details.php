<?php
$page_title = "Détails";
$page_date = "28/03/22";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>

	<main>
	<?php

	switch ($_GET["type"]) {
		
		case "track":
			
			if ((isset($_GET["name"]) && !empty($_GET["name"])) && (isset($_GET["artist"]) && !empty($_GET["artist"]))) {
				$track = get_track_info($_GET["name"], $_GET["artist"]);
			
				if (!empty($track)) {
					include "./include/" . $_GET["type"] . "_details.inc.php";
				} else {
					include "./include/not_found_details.inc.php";
				}
			}
			else {
				include "./include/not_found_details.inc.php";
			}
			break;
		
		case "album":
			
			if ((isset($_GET["name"]) && !empty($_GET["name"])) && (isset($_GET["artist"]) && !empty($_GET["artist"]))) {
				
				$album = get_album_info($_GET["name"], $_GET["artist"]);
			
				if (!empty($album)) {
					include "./include/" . $_GET["type"] . "_details.inc.php";
				} else {
					include "./include/not_found_details.inc.php";
				}
			}
			else {
				include "./include/not_found_details.inc.php";
			}
			break;
		
		case "artist":
			
			if (isset($_GET["name"]) && !empty($_GET["name"])) {
				
				$artist = get_artist_info($_GET["name"]);
			
				if (!empty($artist)) {
					include "./include/" . $_GET["type"] . "_details.inc.php";
				} else {
					include "./include/not_found_details.inc.php";
				}
			}
			else {
				include "./include/not_found_details.inc.php";
			}
			break;

		default:
			
		include "./include/not_found_details.inc.php";
			break;
	}
	?>

	</main>
<?php
include "./include/footer.inc.php";
?>