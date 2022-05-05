<?php
$page_title = "L'image du jour";
$page_date = "20/03/22";

include "./include/header.inc.php";
include "./include/functions.inc.php";

$apod_res = get_nasa_daily_image();

$title = str_replace("&", "amp;", $apod_res["title"]);
$url = format_string($apod_res["url"]);
$copyright = str_replace("&", "amp;", $apod_res["copyright"]);
$explanation = str_replace("&", "&amp;", $apod_res["explanation"]);
?>

	<main>
		<section>
			<h2>L'image du jour</h2>
			<article>
				<h3>Un peu d'espace</h3>
				<p>Chez Spotifail, nous adorons le domaine spatiale. Aussi, la NASA (National Aeronautics and Space Administration) propose une image du jour que nous vous proposons de découvrir ici !</p>
				<figure>
					<img src="<?php echo $url; ?>" alt="<? echo $title; ?>" />
					<?php
					if (isset($apod_res["copyright"])) {
						echo "<figcaption>" . $title . " | Copyright : " . $copyright . "</figcaption>\n";
					} else {
						echo "<figcaption>" . $title . "</figcaption>\n";
					}
					?>
				</figure>
				<h4>Une petite explication (en anglais)</h4>
				<p><?php echo $explanation; ?></p>
			</article>
			<article>
				<h3>Votre géolocalisation</h3>
				<?php
				$geoloc_res = get_geolocation();
				if ($geoloc_res["city"] == "") {
					echo "<p>Votre adresse IP indique que vous êtes situé.e en " . $geoloc_res["countryName"] . "</p>\n";
				} else {
					echo "<p>Votre adresse IP indique que vous êtes situé.e près de " . $geoloc_res["city"] . " en " . $geoloc_res["countryName"] . "</p>\n";
				}
				?>
			</article>
		</section>
	</main>

<?php
include "./include/footer.inc.php";
?>