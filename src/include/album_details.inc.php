<?php
$summary = explode("<a", $album["wiki"]["summary"])[0];

$album_display_name = format_for_display($album["name"]);

$artist_name = format_for_link($album["artist"]);
$artist_display_name = format_for_display($album["artist"]);
?>
		
		<section>
			<h2><?php echo $_GET["name"] ?></h2>
			<article>
				<h3>A propos</h3>
				<?php 
				if (!empty($album["image"]["3"]["#text"])) {
					echo "\t\t\t\t<figure>\n";
					echo "\t\t\t\t\t<img src=\"".$album["image"]["3"]["#text"]."\" alt=\"Couverture de l'album " . $album_display_name . "\" />\n";
					echo "\t\t\t\t\t<figcaption>Couverture de l'album " . $album_display_name . "</figcaption>\n";
					echo "\t\t\t\t</figure>\n";
				}
				?>
				<a href="<?php echo "./details.php?type=artist&amp;name=" . $artist_name; ?>">Artiste : <?php echo $artist_display_name; ?></a>
				<p>Album écouté par <?php echo $album["listeners"] ?> personnes</p>
				<p>Nombre d'écoutes : <?php echo $album["playcount"] ?></p>
			</article>
			<?php
			if (!empty($album["wiki"]["summary"])) {
				echo "<article>\n";
				echo "\t\t\t\t<h3>A propos de l'album</h3>\n";
				echo "\t\t\t\t<p>" . $summary . "</p>\n";
				echo "\t\t\t</article>\n";
			}
			?>
		</section>
		<?php
		if (!empty($album["tracks"])) {

			echo "<section class=\"card-section\">\n";
			echo "\t\t\t<h2>Titre(s) de l'album</h2>\n";
			
			// checking if there is only one track in the album
			if (array_key_exists("name", $album["tracks"]["track"])) {

				$track_name = format_for_link($album["tracks"]["track"]["name"]);
				$track_display_name = format_for_display($album["tracks"]["track"]["name"]);
				$track_artist_name = format_for_display($album["tracks"]["track"]["artist"]["name"]);

				echo "\t\t\t<article class=\"card\">\n";
				echo "\t\t\t\t<h3>" . $track_display_name . "</h3>\n";
				echo "\t\t\t\t<a href=\"./details.php?type=track&amp;name=" . $track_name . "&amp;artist=" . $track_artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
				echo "\t\t\t</article>\n";
			
			} else {

				foreach ($album["tracks"]["track"] as $track_value) {

					$track_name = format_for_link($track_value["name"]);
					$track_display_name = format_for_display($track_value["name"]);
					
					$track_artist_name = format_for_link($track_value["artist"]["name"]);

					echo "\t\t\t<article class=\"card\">\n";
					echo "\t\t\t\t<h3>" . $track_display_name . "</h3>\n";
					echo "\t\t\t\t<a href=\"./details.php?type=track&amp;name=" . $track_name . "&amp;artist=" . $track_artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
					echo "\t\t\t</article>\n";
				}
			}
			echo "\t\t</section>\n";
		}

		if (!empty($album["tags"])) {

			echo "\t\t<section class=\"card-section\">\n";
			echo "\t\t\t<h2>Tags associés</h2>\n";

			foreach ($album["tags"]["tag"] as $tag_value) {

				$tag_name = format_for_link($tag_value["name"]);
				$tag_display_name = format_for_display($tag_value["name"]);

				echo "\t\t\t<article class=\"card\">\n";
				echo "\t\t\t\t<h3>" . $tag_display_name . "</h3>\n";
				echo "\t\t\t\t<a href=\"./tag.php?tag=" . $tag_name . "\" class=\"submit-style\">Découvrir</a>\n";
				echo "\t\t\t</article>\n";
			}

			echo "\t\t</section>\n";
		}
		?>