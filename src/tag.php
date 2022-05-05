<?php
$page_title = "Le meilleur du genre " . str_replace("&", "&amp;", $_GET["tag"]);
$page_date = "11/04/22";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>

    <main>
        <?php
        if (isset($_GET["tag"]) && !empty($_GET["tag"])) {
            
            $tracks = get_top_tracks($_GET["tag"]);

            echo "<section class=\"card-section\">\n";
            echo "\t\t\t<h2>Les meilleurs titres</h2>\n";

            foreach ($tracks as $value) {

                $track_display_name = str_replace("&", "&amp;", $value["name"]);
                $track_name = format_string($value["name"]);

                $artist_display_name = str_replace("&", "&amp;", $value["artist"]["name"]);
                $artist_name = format_string($value["artist"]["name"]);

                echo "\t\t\t<article class=\"card\">\n";
                echo "\t\t\t\t<h3>" . $track_display_name . "</h3>\n";
                echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\">Artiste : " . $artist_display_name . "</a>\n";
                echo "\t\t\t\t<a href=\"./details.php?type=track&amp;name=" . $track_name . "&amp;artist=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                echo "\t\t\t</article>\n";
            }
            echo "\t\t</section>\n";

            $artists = get_top_artists($_GET["tag"]);

            echo "\t\t<section class=\"card-section\">\n";
            echo "\t\t\t<h2>Les meilleurs artistes</h2>\n";

            foreach ($artists as $value) {

                $artist_display_name = str_replace("&", "&amp;", $value["name"]);
                $artist_name = format_string($value["name"]);

                echo "\t\t\t<article class=\"card\">\n";
                echo "\t\t\t\t<h3>" . $artist_display_name . "</h3>\n";
                echo "\t\t\t\t<p>" . "Écoutes : " . $value["listeners"] . "</p>\n";
                echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                echo "\t\t\t</article>\n";
            }

            echo "\t\t</section>\n";
        }
        ?>
    </main>

<?php
include "./include/footer.inc.php";
?>