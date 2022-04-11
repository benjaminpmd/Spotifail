<?php
$page_title = "Tendances";
$page_date = "23/03/22";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>
<main>
    <section class="card-section">
        <h2>Titres de la semaine</h2>
        <?php
        $tracks = get_top_tracks();
        foreach ($tracks as $track) {
            echo "<article class=\"card\">";
            echo "\t\t\t\t\t<h3>" . $track["name"] . "</h3>\n";
            echo "\t\t\t\t\t<p>" . "Artiste : " . $track["artist"]["name"] . "</p>\n";
            echo "\t\t\t\t\t<a href=\"./details.php?type=track&name=" . $track["name"] . "&artist=" . $track["artist"]["name"] . "\">Découvrir</a>\n";
            echo "</article>\n";
        }
        ?>
    </section>
    <section class="card-section">
        <h2>Artistes de la semaine</h2>
        <?php
        $artists = get_top_artists();
        foreach ($artists as $artist) {
            echo "<article class=\"card\">";
            echo "\t\t\t\t\t<h3>" . $artist["name"] . "</h3>\n";
            echo "\t\t\t\t\t<p>" . "Écoutes : " . $artist["listeners"] . "</p>\n";
            echo "\t\t\t\t\t<a href=\"./details.php?type=artist&name=" . $artist["name"] . "\">Découvrir</a>\n";
            echo "</article>\n";
        }
        ?>
    </section>
</main>
<?php
include "./include/footer.inc.php";
?>