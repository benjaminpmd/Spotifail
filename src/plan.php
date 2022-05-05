<?php
$page_title = "Plan du site";
$page_date = "23/03/22";

include "./include/header.inc.php";
include "./include/functions.inc.php";
?>

    <main>
        <section>
            <h2>Accès aux pages</h2>
            <article>
                <h3>A propos du site</h3>
                <ul>
                    <li class="plan-item"><a href="./index.php">Accueil</a></li>
                    <li class="plan-item"><a href="./recherche.php">Recherche</a></li>
                    <li class="plan-item"><a href="./tendances.php">Tendances</a></li>
                </ul>
            </article>
            <article>
                <h3>En découvrir plus sur le site</h3>
                <ul>
                    <li class="plan-item"><a href="./image-du-jour.php">L'mage du jour</a></li>
                    <li class="plan-item"><a href="./statistiques.php">Statistiques du site</a></li>
                </ul>
            </article>
        </section>
    </main>

<?php
include "./include/footer.inc.php";
?>