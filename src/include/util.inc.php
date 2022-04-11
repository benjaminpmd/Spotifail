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
			setcookie("theme", "light");
			return "./css/light.css";
		}
		else {
			setcookie("theme", "dark");
			return "./css/style.css";
		}
	}
	else {
		if (isset($_COOKIE["theme"]) && $_COOKIE["theme"] == "light") {
			return "./css/light.css";
		}
		else {
			return "./css/style.css";
		}
	}
	return "./css/style.css";
}

function get_theme_link(): string {
	if (isset($_GET["theme"])) {
		if ($_GET["theme"] == "light") {
			return "dark";
		}
		else {
			return "light";
		}
	}
	else {
		if (isset($_COOKIE["theme"]) && $_COOKIE["theme"] == "light") {
			return "dark";
		}
		else {
			return "light";
		}
	}
	return "dark";
}


function increment_hit_counter(string $page_name): string {

	$hit_value_result = "";
	$output_content = "";
	$is_in_file = false;

	$handle = fopen("./assets/hits_counter.txt", "r");

	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			$line_array = explode(':', $line);

			if ($page_name == $line_array[0]) {
				$is_in_file = true;
				$value = intval($line_array[1]);
				$value++;
				$hit_value_result = strval($value);
				$output_content .= $page_name.":".$hit_value_result."\n";
			}
			else {
				$output_content .= $line;
			}	
		}
	}
	fclose($handle);

	if (!$is_in_file) {
		$output_content .= $page_name.":0\n";
	}

	$handle = fopen("./assets/hits_counter.txt", "w");
	fwrite($handle, $output_content);
	fclose($handle);

	return $hit_value_result;
}
