<?php
$artist_display_name = format_for_display($artist["name"]);

$summary = explode("<a", $artist["bio"]["summary"])[0];
$summary = format_for_display($summary);
?>
        
        <section>
            <h2><?php echo $artist_display_name; ?></h2>
            <article>
                <h3>Informations</h3>
                <ul>
                    <li><?php echo $artist["stats"]["listeners"]; ?> personnes ont écouté cet.te artiste</li>
                    <li>Nombre d'écoutes : <?php echo $artist["stats"]["playcount"]; ?></li>
                </ul>
            </article>
            <?php
                if(!empty($artist["bio"]["summary"])){
                    echo "<article>\n";
                    echo "\t\t\t\t<h3>A propos de l'artiste</h3>\n";
                    echo "\t\t\t\t<p>".$summary."</p>\n";
                    echo "\t\t\t</article>\n";    
                }
            ?>
        </section>
        <?php 
            if(!empty($artist["tags"]["tag"])){
                echo "<section class=\"card-section\">\n";
                echo "\t\t\t<h2>Tags associés</h2>\n";
                
                foreach($artist["tags"]["tag"] as $tag_value) {
                    
                    $tag_name = format_for_link($tag_value["name"]);
                    $tag_display_name = format_for_display($tag_value["name"]);
    
                    echo "\t\t\t<article class=\"card\">\n";
                    echo "\t\t\t\t<h3>" . $tag_display_name . "</h3>\n";
                    echo "\t\t\t\t<a href=\"./tag.php?tag=" . $tag_name . "\" class=\"submit-style\">Découvrir</a>\n";
                    echo "\t\t\t</article>\n";
                }
                
                echo "\t\t</section>\n";
            }
        ?>