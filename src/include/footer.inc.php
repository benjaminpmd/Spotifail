	<footer>
		<ul>
		<li><a href="">Plan du site</a></li>
			<li>Lucas L &amp; Benjamin P</li>
			<li>UE Développement Web</li>
			<li>Cergy Paris Université</li>
			<?php
				if (isset($page_date)) {
					echo "<li>Dernière modification : ".$page_date."</li>\n";
				}
				else {
					echo "<li>Dernière modification : ".$DEFAULT_PAGE."</li>\n";
				}
			?>
		</ul>
	</footer>
</body>
</html>