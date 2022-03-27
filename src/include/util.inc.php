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
?>