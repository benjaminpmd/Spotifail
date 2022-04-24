<?php
$track = get_track_info($_GET["name"], $_GET["artist"]);

log_visited_track($_GET["name"], $_GET["artist"]);
set_last_visited($_GET["name"], $_GET["artist"]);

$duration = ms_to_minute(intval($track["duration"]));
$summary = explode(" <a", $track["wiki"]["summary"])[0];
?>
<section>
    <h2><?php echo $track["name"]?></h2>
    <article>
        <h3>Informations</h3>
        <a href="<?php echo "./details.php?type=artist&name=" . $track["artist"]["name"]; ?>">Artiste : <?php echo $track["artist"]["name"]; ?></a>
        <ul>
            <li>Durée : <?php echo $duration; ?></li>
            <li><?php echo $track["listeners"]; ?> personnes ont écouté ce titre</li>
            <li>Nombre d'écoutes : <?php echo $track["playcount"]; ?></li>
        </ul>
    </article>
    <article>
        <h3>Description</h3>
        <p><?php echo $summary; ?></p>
    </article>
</section>
<section>
    <h2>Album</h2>
    <article>
        <h3><?php echo $track["album"]["title"]; ?></h3>
        <a href="<?php echo "./details.php?type=album&name=" . $track["name"] ."&artist=" . $track["artist"]["name"]; ?>">Voir l'album</a>
        <figure>
            <img src=<?php echo "\"" . $track["album"]["image"]["3"]["#text"] . "\""; ?> alt=<?php echo "\"Couverture de l'album " . $track["album"]["title"] . "\""; ?> />
            <figcaption><?php echo $track["album"]["title"] ?></figcaption>
        </figure>
    </article>
</section>
<?php 
    if(!empty($track["toptags"]["tag"])){
        echo "<section class=card-section>\n";
        echo "<h2>Tags associés</h2>\n";
        foreach($track["toptags"]["tag"] as $tag_value) {
            echo "<article class=\"card\">\n";
            echo "<h3>".$tag_value["name"]."</h3>\n";
            echo "<a href=\"./tag.php?tag=" . $tag_value["name"]."\">Découvrir</a>\n";
            echo "</article>\n";
        }
        echo "</section>\n";
    }
?>