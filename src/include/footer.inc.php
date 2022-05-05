<?php
include_once './include/utils.inc.php';

$hit_counter = increment_hit_counter(basename($_SERVER['PHP_SELF']))
?>
	<footer>
		<table>
			<thead>
				<tr>
					<th class="footer-title">Réalisation</th>
					<th class="footer-title">Liens</th>
					<th class="footer-title">Navigation</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="footer-item">Projet de Dev Web 2022</td>
					<td class="footer-item"><a target="_blank" href="https://www.github.com/benjaerospace/Spotifail" class="footer-link"><img src="./images/github.png" alt="github logo" height="20" /> Github</a></td>
					<td class="footer-item"><a href="./plan.php" class="footer-link">Plan du site</a></td>
				</tr>
				<tr>
					<td class="footer-item">11 Avril 2022</td>
					<td class="footer-item"><a target="_blank" href="https://www.last.fm" class="footer-link">Last.fm</a></td>
					<td class="footer-item"><a href="./index.php" class="footer-link">Accueil</a></td>
				</tr>
				<tr>
					<td class="footer-item">Lucas L. &amp; Benjamin P.</td>
					<td class="footer-item"><a target="_blank" href="https://apod.nasa.gov/apod/astropix.html" class="footer-link">NASA APOD</a></td>
					<td class="footer-item"><a href="./recherche.php" class="footer-link">Recherche</a></td>
				</tr>
				<tr>
					<td class="footer-item">CY Cergy Paris Université</td>
					<td class="footer-item"><a target="_blank" href="https://www.geoplugin.com/" class="footer-link">geoPlugin</a></td>
					<td class="footer-item"><a href="./tendances.php" class="footer-link">Tendances</a></td>
				</tr>
				<tr>
					<td class="footer-item"></td>
					<td class="footer-item"></td>
					<td class="footer-item"><a href="./image-du-jour.php" class="footer-link">L'image du jour</a></td>
				</tr>
				<tr>
					<td class="footer-item"></td>
					<td class="footer-item">Chargements de la page : <?php echo $hit_counter; ?></td>
					<td class="footer-item"><a href="./statistiques.php" class="footer-link">Statistiques</a></td>
				</tr>
			</tbody>
		</table>
	</footer>
</body>

</html>