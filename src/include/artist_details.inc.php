<?php
    $artist = get_artist_info($_GET["name"]);
?>
        <section>
            <?php
                echo "<h2>".$artist["name"]."</h2>\n";
            ?>
            <article>
                <?php
                    echo "<h3>".$artist["name"]." en quelques chiffres</h3>\n";
                ?>
                <ul>
                    <li><?php echo $artist["stats"]["listeners"]; ?> personnes ont écouté cet.te artiste</li>
                    <li>Nombre d'écoutes : <?php echo $artist["stats"]["playcount"]; ?></li>
                </ul>
            </article>
            <article>
                <h3>A propos de l'artiste</h3>
                <?php 
                    $summary = explode(" <a", $artist["bio"]["summary"])[0];
                    echo "<p>".$summary."</p>\n";
                ?>
            </article>
            <article>
                <h3>Tags associés</h3>
                <ul>
                    <?php 
                        foreach ($artist["tags"]["tag"] as $tag) {
                            echo "<li>".$tag["name"]."</li>\n";
                        }
                    ?>
                </ul>
            </article>
        </section>