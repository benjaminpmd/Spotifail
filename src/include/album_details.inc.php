<?php
   $album = get_album_info($_GET["artist"], $_GET["name"]);
?>

<section>
    <h2><?php echo $_GET["name"]?></h2>
    <article>
        <h3>A propos</h3>
        <figure>
            <img src=<?php echo "\"".$album["image"]["3"]["#text"]."\"" ?> alt=<?php echo "\"Couverture de l'album ".$album["name"]."\"" ?> />
            <figcaption><?php echo "Couverture de l'album ".$album["name"] ?></figcaption>
        </figure>
        <a href="<?php echo "./details.php?type=artist&name=" . $album["artist"]?>">Artiste : <?php echo $album["artist"]?></a>
        <p>Album écouté par <?php echo $album["listeners"] ?> personnes</p>
        <p>Nombre d'écoutes : <?php echo $album["playcount"] ?></p>
    </article>
</section>
<?php
    if(!empty($album["tracks"])){
        echo "<section class=card-section>\n";
        echo "<h2>Titre(s) de l'album</h2>\n";
        if(array_key_exists("name", $album["tracks"]["track"])) {
            echo "<article class=\"card\">\n";
            echo "<h3>".$album["tracks"]["track"]["name"]."</h3>\n";
            echo "<a href=\"./details.php?type=track&name=" . $album["tracks"]["track"]["name"] . "&artist=" . $album["tracks"]["track"]["artist"]["name"] . "\">Ecouter</a>\n";
            echo "</article>\n";
        }
        else {
            foreach($album["tracks"]["track"] as $track_value){
                echo "<article class=\"card\">\n";
                echo "<h3>".$track_value["name"]."</h3>\n";
                echo "<a href=\"./details.php?type=track&name=" . $track_value["name"] . "&artist=" . $track_value["artist"]["name"] . "\">Ecouter</a>\n";
                echo "</article>\n";
            }
        }
        echo "</section>\n";
    }

    if(!empty($album["tags"])){
        echo "<section class=card-section>\n";
        echo "<h2>Tags associés</h2>\n";
        foreach($album["tags"]["tag"] as $tag_value) {
            echo "<article class=\"card\">\n";
            echo "<h3>".$tag_value["name"]."</h3>\n";
            echo "<a href=\"./tag.php?tag=" . $tag_value["name"]."\">Découvrir</a>\n";
            echo "</article>\n";
        }
        echo "</section>\n";
    }
?>