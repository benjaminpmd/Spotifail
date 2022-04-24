<?php
$page_title = "Le meilleur du genre " . $_GET["tag"];
$page_date = "11/04/22";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>
<main>
    <?php
    if (isset($_GET["tag"]) && !empty($_GET["tag"])) {
        $tracks = get_top_tracks($_GET["tag"]);

        echo "<section class=\"card-section\">\n";
        echo "<h2>Les meilleurs titres</h2>\n";

        foreach ($tracks as $value) {
            echo "<article class=\"card\">\n";
            echo "<h3>" . $value["name"] . "</h3>\n";
            echo "<p>" . "Artiste : " . $value["artist"] . "</p>\n";
            echo "<a href=\"./details.php?type=track&name=" . $value["name"] . "&artist=" . $value["artist"] . "\">Découvrir</a>\n";
            echo "</article>\n";
        }
        echo "</section>\n";

        $artists = get_top_artists($_GET["tag"]);

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
    ?>
</main>
<?php
include "./include/footer.inc.php";
?>