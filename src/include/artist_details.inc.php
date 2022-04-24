<?php
$artist = get_artist_info($_GET["name"]);
$summary = explode(" <a", $artist["bio"]["summary"])[0];
?>
<section>
    <h2><?php echo $artist["name"]; ?></h2>
    <article>
        <h3>Informations</h3>
        <ul>
            <li><?php echo $artist["stats"]["listeners"]; ?> personnes ont écouté cet.te artiste</li>
            <li>Nombre d'écoutes : <?php echo $artist["stats"]["playcount"]; ?></li>
        </ul>
    </article>
    <article>
        <h3>A propos de l'artiste</h3>
        <p><?php echo $summary; ?></p>
    </article>
</section>
<?php 
    if(!empty($artist["tags"]["tag"])){
        echo "<section class=card-section>\n";
        echo "<h2>Tags associés</h2>\n";
        foreach($artist["tags"]["tag"] as $tag_value) {
            echo "<article class=\"card\">\n";
            echo "<h3>".$tag_value["name"]."</h3>\n";
            echo "<a href=\"./tag.php?tag=" . $tag_value["name"]."\">Découvrir</a>\n";
            echo "</article>\n";
        }
        echo "</section>\n";
    }
?>