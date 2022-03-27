	<footer>
		<table>
			<thead>
				<tr>
					<th class="footer-title">Réalisation</th>
					<th class="footer-title">Nos liens</th>
					<th class="footer-title">Navigation</th>					
				</tr>
			</thead>
			<tbody>			
				<tr>
					<td class="footer-item">Projet de Dev Web 2022</td>
					<td class="footer-item"><a target="_blank" href="https://github.com/benjaerospace/Spotifail" class="footer-link"><img src="./images/github.png" alt="github log" height="20"/> Github</a></td>
					<td class="footer-item"><a href="./plan.php" class="footer-link">Plan du site</a></td>
				</tr>
				<tr>
					<td class="footer-item">25 Mars 2022</td>
					<td class="footer-item">
					<?php
						$page_name = basename($_SERVER['PHP_SELF']);
						echo "Chargements de la page : ".increment_hit_counter($page_name);
					?>
					</td>
					<td class="footer-item"><a href="./index.php" class="footer-link">Accueil</a></td>
				</tr>
				<tr>
					<td class="footer-item">Lucas L. &amp; Benjamin P.</td>
					<td class="footer-item"></td>
					<td class="footer-item"><a href="./recherche.php" class="footer-link">Recherche</a></td>
				</tr>
				<tr>
					<td class="footer-item">CY Cergy Paris Université</td>
					<td class="footer-item"></td>
					<td class="footer-item"><a href="./tendances.php" class="footer-link">Tendances</a></td>
				</tr>
				<tr>
					<td class="footer-item"></td>
					<td class="footer-item"></td>
					<td class="footer-item"><a href="./image-du-jour.php" class="footer-link">L'image du jour</a></td>
				</tr>
				<tr>
					<td class="footer-item"></td>
					<td class="footer-item"></td>
					<td class="footer-item"><a href="./statistiques.php" class="footer-link">Statistiques</a></td>
				</tr>
			</tbody>
		</table>
	</footer>
</body>
</html>