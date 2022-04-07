<?php
    $page_title = "Détails";
    $page_date = "28/03/22";

    include "./include/header.inc.php";
    include "./include/functions.inc.php";
?>
    <main>
        <?php
            if (($_GET["type"] == "track") || ($_GET["type"] == "album") || ($_GET["type"] == "artist")) {
                include "./include/".$_GET["type"]."_details.inc.php";
            }
            else include "./include/not_found_details.inc.php";
        ?>
    </main>
<?php
    include "./include/footer.inc.php";
?>