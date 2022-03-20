<?php
    $page_title = "Spotifail";
    $page_date = "20/03/22";

    include "./include/header.inc.php";
    include "./include/functions.inc.php";
?>
    <main>
        <section>
            <h2>L'image du jour</h2>
            <article>
                <h3>Un peu d'espace</h3>
                <p>Chez Spotifail, nous adorons le domaine spatiale. Aussi, la NASA (National Aeronautics and Space Administration) propose une image du jour que nous vous proposons de découvrir ici !</p>
                <?php
                    $apod_res = get_nasa_daily_image();
                    echo "<figure>\n";
                    echo "\t\t\t\t\t<img src=\"".$apod_res["url"]."\" alt=\"".$apod_res["title"]."\" />\n";
                    echo "\t\t\t\t\t<figcaption>".$apod_res["title"].PHP_EOL."copyright : ".$apod_res["copyright"]."</figcaption>\n";
                    echo "\t\t\t\t</figure>\n";
                ?>
            </article>
            <article>
                <h3>Votre géolocalisation</h3>
                <?php
                    $geoloc_res = get_geolocation();
                    echo "<p>Votre adresse IP indique que vous êtes situé près de ".$geoloc_res["city"]." en ".$geoloc_res["countryName"]."</p>\n";
                ?>
            </article>
        </section>
    </main>
<?php
    include "./include/footer.inc.php";
?>