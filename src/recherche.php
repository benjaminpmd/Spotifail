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
                        <label for="q">Termes à rechercher :</label>
                        <?php
                            if (isset($_GET["q"])) {
                                echo "<input type=\"text\" placeholder=\"Musique, artiste...\" name=\"q\" value=\"".$_GET["q"]."\" />\n";
                            }
                            else echo "<input type=\"text\" placeholder=\"Musique, artiste...\" name=\"q\" />\n";
                        ?>
                        <input type="submit" value="Rechercher" />
                        <?php
                            if (isset($_GET["track"]) || !isset($_GET["q"])) {
                                echo "<input type=\"checkbox\" name=\"track\" id=\"track-search\" checked=\"checked\" />\n";
                            }
                            else echo "<input type=\"checkbox\" name=\"track\" id=\"track-search\" />\n";
                        ?>
                        <label for="track-search">Musiques</label>
                        <?php
                            if (isset($_GET["artist"]) || !isset($_GET["q"])) {
                                echo "<input type=\"checkbox\" name=\"artist\" id=\"artist-search\" checked=\"checked\" />\n";
                            }
                            else echo "<input type=\"checkbox\" name=\"artist\" id=\"artist-search\" />\n";
                        ?>
                        <label for="artist-search">Artistes</label>
                        <?php
                            if (isset($_GET["album"]) || !isset($_GET["q"])) {
                                echo "<input type=\"checkbox\" name=\"album\" id=\"album-search\" checked=\"checked\" />\n";
                            }
                            else echo "<input type=\"checkbox\" name=\"album\" id=\"album-search\" />\n";
                        ?>
                        <label for="album-search">Albums</label>
                    </fieldset>
                </form>
            </article>
        </section>
        <?php
            if (isset($_GET["q"])) {
                echo "<section>\n";
                echo "\t\t\t<h2>Recherche pour ".$_GET["q"]."</h2>\n";
                
                if (isset($_GET["track"])) {
                    echo "\t\t\t<article>\n";
                    echo "\t\t\t\t<h3>Musiques</h3>\n";
                    echo "\t\t\t\t<ul class=\"result-list\">\n";
                    $tracks = search_track($_GET["q"]);
                    foreach ($tracks as $value) {
                        echo "\t\t\t\t\t<li><table class=\"search-result-item\"><tr>";
                        echo "<td>".$value->name."</td>";
                        echo "<td>"."Artiste : ".$value->artist."</td>";
                        echo "<td>"."<input type=\"submit\" value=\"En savoir plus\">"."</td>";
                        echo "</tr></table></li>\n";
                    }
                    echo "\t\t\t\t</ul>\n";
                    echo "\t\t\t</article>\n";
                }

                if (isset($_GET["artist"])) {
                    echo "\t\t\t<article>\n";
                    echo "\t\t\t\t<h3>Artistes</h3>\n";
                    echo "\t\t\t\t<ul class=\"result-list\">\n";
                    $artists = search_artist($_GET["q"]);
                    foreach ($artists as $value) {
                        echo "\t\t\t\t\t<li><table class=\"search-result-item\"><tr>";
                        echo "<td>".$value->name."</td>";
                        echo "<td>"."Écoutes : ".$value->listeners."</td>";
                        echo "<td>"."<input type=\"submit\" value=\"En savoir plus\">"."</td>";
                        echo "</tr></table></li>\n";
                    }
                    echo "\t\t\t\t</ul>\n";
                    echo "\t\t\t</article>\n";
                }

                if (isset($_GET["album"])) {
                    echo "\t\t\t<article>\n";
                    echo "\t\t\t\t<h3>Albums</h3>\n";
                    echo "\t\t\t\t<ul class=\"result-list\">\n";
                    $tracks = search_album($_GET["q"]);
                    foreach ($tracks as $value) {
                        echo "\t\t\t\t\t<li><table class=\"search-result-item\"><tr>";
                        echo "<td>".$value->name."</td>";
                        echo "<td>"."Artiste : ".$value->artist."</td>";
                        echo "<td>"."<input type=\"submit\" value=\"En savoir plus\">"."</td>";
                        echo "</tr></table></li>\n";
                    }
                    echo "\t\t\t\t</ul>\n";
                    echo "\t\t\t</article>\n";
                }
                echo "\t\t</section>\n";
            }
        ?>
    </main>
<?php
    include "./include/footer.inc.php";
?>