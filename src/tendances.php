<?php
$page_title = "Tendances";
$page_date = "06 Mai 2022";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>

    <main>
        <section class="card-section">
            <h2>Titres de la semaine</h2>
            <?php
            $tracks = get_top_tracks();
            foreach ($tracks as $track) {

                $artist_name = format_for_link($track["artist"]["name"]);
                $artist_display_name = format_for_display($track["artist"]["name"]);

                $track_name = format_for_link($track["name"]);
                $track_display_name = format_for_display($track["name"]);

                echo "\t\t\t<article class=\"card\">\n";
                echo "\t\t\t\t<h3>" . $track_display_name . "</h3>\n";
                echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\">Artiste : " . $artist_display_name . "</a>\n";
                echo "\t\t\t\t<a href=\"./details.php?type=track&amp;name=" . $track_name . "&amp;artist=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                echo "\t\t\t</article>\n";
            }
            ?>
        </section>
        <section class="card-section">
            <h2>Artistes de la semaine</h2>
            <?php
            $artists = get_top_artists();
            foreach ($artists as $artist) {
                
                $artist_name = format_for_link($artist["name"]);
                $artist_display_name = format_for_display($artist["name"]);

                echo "\t\t\t<article class=\"card\">\n";
                echo "\t\t\t\t<h3>" . $artist_display_name . "</h3>\n";
                echo "\t\t\t\t<p>" . "Écoutes : " . $artist["listeners"] . "</p>\n";
                echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                echo "\t\t\t</article>\n";
            }
            ?>
        </section>
    </main>

<?php
include "./include/footer.inc.php";
?>