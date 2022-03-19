<?php
define("DEFAULT_DATE", "unkown");


/**
 * Function to get the path of the stylesheet to use depending on the theme requested.
 * 
 * @return string lthe file path of the CSS file to use.
 */
function get_stylesheet_path(): string {
	if (isset($_GET["theme"])) {
		if ($_GET["theme"] == "light") {
			return "./css/style.css";
		}
		else {
			return "./css/style.css";
		}
	}
	return "./css/style.css";
}
?>