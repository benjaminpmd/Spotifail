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

function increment_hit_counter(string $page_name): void{
	$origin = file("./assets/hits_counter.txt");
	$output_content = "";

	foreach($origin as $line_num => $content){
			
			$line_array = explode(':', $content);
			

		if ($page_name == $line_array[0]) {
			
			$hit_value = intval($line_array[1]);
			$line_array[1] = strval($hit_value++);
		
		}
		$output_content .= $line_array[0].":".$line_array[1]."\n";
	}
}
?>