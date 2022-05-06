<?php
$page_title = "Recherche";
$page_date = "06 Mai 2022";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>
    <main>
        <section>
            <h2>Recherchez votre prochain coup de coeur !</h2>
            <article>
                <h3>C'est parti !</h3>
                <form>
                    <fieldset>
                        <legend>Une envie ? Allez y !</legend>
                        <label>Rechercher :</label>
                        <?php
                        if (isset($_GET["q"])) {
                            echo "<input type=\"text\" placeholder=\"Titre, artiste...\" name=\"q\" value=\"" . format_for_display($_GET["q"]) . "\" />\n";
                        } else echo "<input type=\"text\" placeholder=\"Titre, artiste...\" name=\"q\" />\n";
                        ?>
                        <input type="submit" value="Rechercher" />
                        <?php
                        if (isset($_GET["track"]) || !isset($_GET["q"])) {
                            echo "<input type=\"checkbox\" name=\"track\" id=\"track-search\" checked=\"checked\" />\n";
                        } else echo "<input type=\"checkbox\" name=\"track\" id=\"track-search\" />\n";
                        ?>
                        <label for="track-search">Titres</label>
                        <?php
                        if (isset($_GET["artist"]) || !isset($_GET["q"])) {
                            echo "<input type=\"checkbox\" name=\"artist\" id=\"artist-search\" checked=\"checked\" />\n";
                        } else echo "<input type=\"checkbox\" name=\"artist\" id=\"artist-search\" />\n";
                        ?>
                        <label for="artist-search">Artistes</label>
                        <?php
                        if (isset($_GET["album"]) || !isset($_GET["q"])) {
                            echo "<input type=\"checkbox\" name=\"album\" id=\"album-search\" checked=\"checked\" />\n";
                        } else echo "<input type=\"checkbox\" name=\"album\" id=\"album-search\" />\n";
                        ?>
                        <label for="album-search">Albums</label>
                    </fieldset>
                </form>
            </article>
        </section>
        <?php
        if (isset($_GET["q"]) && !empty($_GET["q"])) {
            if (isset($_GET["track"])) {
                $tracks = search_track($_GET["q"]);

                $query = format_for_display($_GET["q"]);

                echo "<section class=\"card-section\">\n";
                echo "\t\t\t<h2>Titres correspondants à " . $query . "</h2>\n";

                foreach ($tracks as $value) {

                    $artist_name = format_for_link($value["artist"]);
                    $artist_display_name = format_for_display($value["artist"]);

                    $track_name = format_for_link($value["name"]);
                    $track_display_name = format_for_display($value["name"]);

                    echo "\t\t\t<article class=\"card\">\n";
                    echo "\t\t\t\t<h3>" . $track_display_name . "</h3>\n";
                    echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\">Artiste : " . $artist_display_name . "</a>\n";
                    echo "\t\t\t\t<a href=\"./details.php?type=track&amp;name=" . $track_name . "&amp;artist=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                    echo "\t\t\t</article>\n";
                }

                echo "\t\t</section>\n";
            }

            if (isset($_GET["artist"])) {
                $artists = search_artist($_GET["q"]);

                $query = format_for_display($_GET["q"]);

                echo "\t\t<section class=\"card-section\">\n";
                echo "\t\t\t<h2>Artistes correspondants à " . $query . "</h2>\n";

                foreach ($artists as $value) {

                    $artist_name = format_for_link($value["name"]);
                    $artist_display_name = format_for_display($value["name"]);

                    echo "\t\t\t<article class=\"card\">\n";
                    echo "\t\t\t\t<h3>" . $artist_display_name . "</h3>\n";
                    echo "\t\t\t\t<p>" . "Écoutes : " . $value["listeners"] . "</p>\n";
                    echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                    echo "\t\t\t</article>\n";
                }

                echo "\t\t</section>\n";
            }

            if (isset($_GET["album"])) {
                $albums = search_album($_GET["q"]);

                $query = format_for_display($_GET["q"]);

                echo "\t\t<section class=\"card-section\">\n";
                echo "\t\t\t<h2>Albums correspondants à " . $query . "</h2>\n";

                foreach ($albums as $value) {

                    $artist_name = format_for_link($value["artist"]);
                    $artist_display_name = format_for_display($value["artist"]);

                    $album_name = format_for_link($value["name"]);
                    $album_display_name = format_for_display($value["name"]);

                    echo "\t\t\t<article class=\"card\">\n";
                    echo "\t\t\t\t<h3>" . $album_display_name . "</h3>\n";
                    echo "\t\t\t\t<a href=\"./details.php?type=artist&amp;name=" . $artist_name . "\">Artiste : " . $artist_display_name . "</a>\n";
                    echo "\t\t\t\t<a href=\"./details.php?type=album&amp;name=" . $album_name ."&amp;artist=" . $artist_name . "\" class=\"submit-style\">Découvrir</a>\n";
                    echo "\t\t\t</article>\n";
                }

                echo "\t\t</section>\n";
            }
        }
        ?>
    </main>

<?php
include "./include/footer.inc.php";
?>