<?php
/**
 * File containing specific functions used in the header, footer or for a specific purpose.
 * 
 * @author Lucas L, Benjamin P
 * @version 22.03.23 (WIP)
 * @since 23/03/22
 */


// default path for graph save and retrieval
define("GRAPH_PATH", "./images/graph.png");


/**
 * Function to correcty format strings for links.
 * 
 * @param string the value to format.
 * @return string the formatted value.
 */
function format_string(string $str): string {
    $str = str_replace(" ", "+", $str);
    $str = str_replace("&", "&amp;", $str);
    return $str;
}

/**
 * Function to get the current theme applyed to the page.
 * 
 * @return string that can be light or dark.
 */
function get_theme(): string {

	// in case the theme is not set, dark is the default theme
	$theme = "dark";

	if (isset($_GET["theme"])) {
		if ($_GET["theme"] == "light") {
			$theme = "light";
			setcookie("theme", "light", (time()+3600 * 24 * 365));
		}
		else {
			$theme = "dark";
			setcookie("theme", "dark");
		}
	}
	else {
		if (isset($_COOKIE["theme"]) && $_COOKIE["theme"] == "light") {
			$theme = "light";
		}
		else {
			$theme = "dark";
		}
	}
	return $theme;
}


/**
 * Function to get the path of the stylesheet to use depending on the theme requested.
 * 
 * @return string the file path of the CSS file to use.
 */
function get_stylesheet_path(string $current_theme): string {

	$stylesheet_path = "./css/";

	if ($current_theme == "light") {
		$stylesheet_path .= "light"; 
	}
	else {
		$stylesheet_path .= "style"; 
	}
	
	return $stylesheet_path . ".css";
}


/**
 * Function that return an url to the theme change link.
 * 
 * @return string that contains the theme to apply and the already present elements.
 */
function get_theme_link_url(string $current_theme): string {

	$parameters = "";
	foreach ($_GET as $key => $value) {
		if ($key != "theme") {
			$parameters .= '&' . $key . '=' . $value;
		}
	}

	$theme_link_url = "?theme=";

	// we need the opposite theme
	if ($current_theme == "light") {
		$theme_link_url .= "dark"; 
	}
	else {
		$theme_link_url .= "light"; 
	}

	return $theme_link_url . $parameters;
}


/**
 * Function that return the path of the image to use for the theme change link.
 * 
 * @return string containing the path to the theme image to use for the link.
 */
function get_theme_link_image(string $current_theme): string {
	
	$theme_link_image = "./images/";

	// we need the opposite theme
	if ($current_theme == "light") {
		$theme_link_image .= "dark"; 
	}
	else {
		$theme_link_image .= "light"; 
	}

	return $theme_link_image . ".png";
}


/**
 * Function that increment counter for page visits and return the number of hits for the requested page.
 * 
 * @param page_name the name of the page that have been hit.
 * @return string the number of hits for the page name.
 */
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

/**
 * Function that return the visited tracks and how many times they have been visited.
 * 
 * @return array with track names as keys and visited times as values.
 */
function get_visited_track(): array {
    $values = [];
    // opening the csv file as read
    $file = fopen(VISITED_LOG_PATH, "r");
    
    // reading each line of the csv file
    while($line = fgetcsv($file)) {
        $values[$line[0]] = $line[2];
    }
    fclose($file);
    return $values;
}

