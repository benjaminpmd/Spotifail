<?php
log_visited_track($_GET["name"], $_GET["artist"]);
set_last_visited($_GET["name"], $_GET["artist"]);

$duration = ms_to_minute(intval($track["duration"]));
$summary = explode("<a", $track["wiki"]["summary"]);

$track_dsiplay_name = str_replace("&", "&amp;", $track["name"]);
$track_name = format_string($track["name"]);

$artist_display_name = str_replace("&", "&amp;", $track["artist"]["name"]);
$artist_name = format_string($track["artist"]["name"]);

$album_display_name = str_replace("&", "&amp;", $track["album"]["title"]);
$album_name = format_string($track["album"]["title"]);
?>

		<section>
			<h2><?php echo $track_dsiplay_name; ?></h2>
			<?php
			// display the album article only if album
			if (!empty($track["album"])) {

				echo "<article>\n";
				echo "\t\t\t\t<h3> Dans l'album " . $album_display_name . "</h3>\n";
				echo "\t\t\t\t<a href=\"./details.php?type=album&amp;name=" . $album_name . "&amp;artist=" . $artist_name . "\">Voir l'album</a>\n";

				if (!empty($track["album"]["image"])) {
					echo "\t\t\t\t<figure>\n";
					echo "\t\t\t\t\t<img src=\"" . $track["album"]["image"]["3"]["#text"] . "\" alt=\"Couverture de l'album " . $album_display_name . "\"/>\n";
					echo "\t\t\t\t\t<figcaption>Couverture de l'album</figcaption>\n";
					echo "\t\t\t\t</figure>\n";
				}
				echo "\t\t\t</article>\n";
			}
			?>
			<article>
				<h3>Informations</h3>
				<a href="<?php echo "./details.php?type=artist&amp;name=" . $artist_name; ?>">Artiste : <?php echo $artist_display_name; ?></a>
				<ul>
					<li>Durée : <?php echo $duration; ?></li>
					<li><?php echo $track["listeners"]; ?> personnes ont écouté ce titre</li>
					<li>Nombre d'écoutes : <?php echo $track["playcount"] . "</li>\n"; ?>
				</ul>
			</article>
			<?php
			if (!empty($track["wiki"]["summary"])) {
				echo "<article>\n";
				echo "\t\t\t\t<h3>A propos du titre</h3>\n";
				echo "\t\t\t\t<p>" . $summary[0] . "</p>\n";
				echo "\t\t\t</article>\n";
			}
			?>
		</section>
		<?php
		if (!empty($track["toptags"]["tag"])) {
			echo "<section class=\"card-section\">\n";
			echo "\t\t\t<h2>Tags associés</h2>\n";
			foreach ($track["toptags"]["tag"] as $tag_value) {
				$tag_name = format_string($tag_value["name"]);
				$tag = str_replace("&", "&amp;", $tag_value["name"]);
				echo "\t\t\t<article class=\"card\">\n";
				echo "\t\t\t\t<h3>" . $tag . "</h3>\n";
				echo "\t\t\t\t<a class=\"submit-style\" href=\"./tag.php?tag=" . $tag_name . "\">Découvrir</a>\n";
				echo "\t\t\t</article>\n";
			}
			echo "\t\t</section>\n";
		}
		?>