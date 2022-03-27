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
                            if (isset($_GET["artist"]) || !isset($_GET["q"])) {
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
                        <label for="album-search">Albums :</label>

                        <?php
                            if (isset($_GET["tag"]) || !isset($_GET["q"])) {
                                echo "<input type=\"checkbox\" name=\"tag\" id=\"tag-search\" checked=\"checked\" />\n";
                            }
                            else echo "<input type=\"checkbox\" name=\"tag\" id=\"tag-search\" />\n";
                        ?>
                        <label for="tag-search">Tags</label>
                    </fieldset>
                </form>
            </article>
        </section>
        <?php
            if (isset($_GET["q"])) {
                echo "<section>\n";

                echo "\tRecherche pour ".$_GET["q"]."\n";
            }
        ?>
    </main>
<?php
    include "./include/footer.inc.php";
?>