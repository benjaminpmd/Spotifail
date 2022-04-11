<?php
$page_title = "Recherche";
$page_date = "23/03/22";

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
                    <label for="q">Rechercher :</label>
                    <?php
                    if (isset($_GET["q"])) {
                        echo "<input type=\"text\" placeholder=\"Titre, artiste...\" name=\"q\" value=\"" . $_GET["q"] . "\" />\n";
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

            echo "<section class=\"card-section\">\n";
            echo "<h2>Titres correspondants à " . $_GET["q"] . "</h2>\n";

            foreach ($tracks as $value) {
                echo "<article class=\"card\">\n";
                echo "<h3>" . $value["name"] . "</h3>\n";
                echo "<p>" . "Artiste : " . $value["artist"] . "</p>\n";
                echo "<a href=\"./details.php?type=track&name=" . $value["name"] . "&artist=" . $value["artist"] . "\">Découvrir</a>\n";
                echo "</article>\n";
            }

            echo "</section>\n";
        }

        if (isset($_GET["artist"])) {
            $artists = search_artist($_GET["q"]);

            echo "<section class=\"card-section\">\n";
            echo "<h2>Artistes correspondants à " . $_GET["q"] . "</h2>\n";

            foreach ($artists as $value) {
                echo "<article class=\"card\">\n";
                echo "<h3>" . $value["name"] . "</h3>\n";
                echo "<p>" . "Écoutes : " . $value["listeners"] . "</p>\n";
                echo "<a href=\"./details.php?type=artist&name=" . $value["name"] . "\">Découvrir</a>\n";
                echo "</article>\n";
            }

            echo "</section>\n";
        }

        if (isset($_GET["album"])) {
            $albums = search_album($_GET["q"]);

            echo "<section class=\"card-section\">\n";
            echo "<h2>Albums correspondants à " . $_GET["q"] . "</h2>\n";

            foreach ($albums as $value) {
                echo "<article class=\"card\">\n";
                echo "<h3>" . $value["name"] . "</h3>\n";
                echo "<p>" . "Artiste : " . $value["artist"] . "</p>\n";
                echo "<a href=\"./details.php?type=album&name=" . $value["name"] . "\">Découvrir</a>\n";
                echo "</article>\n";
            }

            echo "</section>\n";
        }
    }
    ?>
</main>
<?php
include "./include/footer.inc.php";
?>