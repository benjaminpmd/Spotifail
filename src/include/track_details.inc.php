<?php
$track = get_track_info($_GET["name"], $_GET["artist"]);

log_visited_track($_GET["name"], $_GET["artist"]);
$duration = ms_to_minute(intval($track["duration"]));
set_last_visited($_GET["name"], $_GET["artist"]);
?>
<section>
    <?php
    echo "<h2>" . $track["name"] . "</h2>\n";
    ?>
    <article>
        <h3>Album d'origine</h3>
        <form>
            <input type="hidden" name="type" value="artist" />
            <input type="hidden" name="name" value="<?php echo $track["album"]["artist"] ?>" />
            <input type="submit" value="Artiste(s) : <?php echo $track["album"]["artist"] ?>" />
        </form>
        <figure>
            <img src=<?php echo "\"" . $track["album"]["image"]["3"]["#text"] . "\"" ?> alt=<?php echo "\"Couverture de l'album " . $track["album"]["title"] . "\"" ?> />
            <figcaption><?php echo $track["album"]["title"] ?></figcaption>
        </figure>
    </article>
    <article>
        <?php
        echo "<h3>" . $_GET["name"] . " en quelques chiffres</h3>\n";
        ?>
        <ul>
            <li>Durée : <?php echo $duration; ?></li>
            <li><?php echo $track["listeners"]; ?> personnes ont écouté ce titre</li>
            <li>Nombre d'écoutes : <?php echo $track["playcount"]; ?></li>
        </ul>
    </article>
    <article>
        <h3>Description du titre</h3>
        <?php
        $summary = explode(" <a", $track["wiki"]["summary"])[0];
        echo "<p>" . $summary . "</p>\n";
        ?>
    </article>
    <article>
        <h3>Tags associés</h3>
        <ul>
            <?php
            foreach ($track["toptags"]["tag"] as $tag) {
                echo "<li>" . $tag["name"] . "</li>\n";
            }
            ?>
        </ul>
    </article>
</section>