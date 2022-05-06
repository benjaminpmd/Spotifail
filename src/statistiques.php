<?php
$page_title = "Statistiques";
$page_date = "06 Mai 2022";

include "./include/header.inc.php";
include "./include/functions.inc.php";
include "./include/graph.inc.php";
?>

    <main>
        <section>
            <h2>Fréquentation du site</h2>
            <img src="<?php echo GRAPH_PATH;?>" alt="Graphique des titres les plus visités" />
        </section>
    </main>
    
<?php
include "./include/footer.inc.php";
?>