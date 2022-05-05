<?php

/**
 * File containing all function to call API from various sources.
 * 
 * @author Lucas L., Benjamin P
 * @version 22.03.23 (WIP)
 * @since 23/03/22
 */

include_once "./include/utils.inc.php";

define("API_KEY", $_ENV["LASTFM_API_KEY"]);
define("SEPARATOR", ";");
define("RANDOM_IMG_DIRECTORY_PATH", "./images/index/");
define("VISITED_LOG_PATH", "./assets/log_visited_tracks.csv");


/**
 * Function to convert milliseconds into well formatted minute:seconds.
 * 
 * @param ms_value The value in milliseconds.
 * @return string Well formatted minute and seconds.
 */
function ms_to_minute(int $ms_value): string
{
	$duration = intdiv($ms_value, 60000) . ":" . ($ms_value % 60000);
	return substr($duration, 0, -3);
}


/**
 * Function to get the APOD (Astronomy Picture of the Day) from the NASA API.
 * 
 * @return array containing the title, url, explanation and copyright of the image;
 */
function get_nasa_daily_image(): array
{

	// API stored in an ENV var
	$url = "https://api.nasa.gov/planetary/apod?api_key=" . $_ENV["APOD_API_KEY"];

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	// decode the JSON string
	$res_array = json_decode($res, true);

	$return_array = [
		"url" => $res_array["url"],
		"title" => $res_array["title"],
		"explanation" => $res_array["explanation"]

	];

	if (!empty($res_array["copyright"])) {
		$return_array["copyright"] = $res_array["copyright"];
	}

	return $return_array;
}

/**
 * Function to get the approximative location of a client.
 * 
 * @return array the country name and de city nearest city of the user. Caution, the city can be empty if the IP address
 * does not permit to determine the client location. 
 */
function get_geolocation(): array
{

	$url = "http://www.geoplugin.net/xml.gp?ip=" . $_SERVER['REMOTE_ADDR'];

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$xml = simplexml_load_string($res);

	return [
		"countryName" => $xml->geoplugin_countryName,
		"city" => $xml->geoplugin_city
	];
}

/**
 * Function to get random image informations
 * 
 * @return array containing the name and the path of an image.
 */
function get_random_image(): array
{

	$img_dir_path = RANDOM_IMG_DIRECTORY_PATH;

	$files = scandir($img_dir_path);

	$count = count($files);

	$index = rand(2, ($count - 1));

	$filename = $files[$index];

	$filename_return = substr($filename, 0, -4);

	$return_array = [
		"img_path" => RANDOM_IMG_DIRECTORY_PATH . $filename,
		"img_name" => $filename_return,
	];

	return $return_array;
}





/********************
 * TRACKS
 ********************/

/**
 * Function to get an array of tracks with names similar to the query.
 * 
 * @param query a string corresponding to the name of a track.
 * @return array object containing the title, artist and listeners of similar tracks.
 */
function search_track(string $query): array
{

	$query = format_for_link($query);

	$url = "https://ws.audioscrobbler.com/2.0/?method=track.search&format=json&api_key=" . API_KEY . "&track=" . $query;

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	if (isset($decoded_json["results"]["trackmatches"]["track"]) && !empty($decoded_json["results"]["trackmatches"]["track"])) {
		return $decoded_json["results"]["trackmatches"]["track"];
	} else return [];
}

/**
 * Function to get an array of the informations about a track.
 * 
 * @return array object containing the title, artist and listeners of most played tracks.
 */
function get_track_info(string $name, string $artist): array
{

	$name = str_replace(" ", "+", $name);
	$artist = str_replace(" ", "+", $artist);

	$url = "https://ws.audioscrobbler.com/2.0/?method=track.getinfo&format=json&api_key=" . API_KEY . "&track=" . $name . "&artist=" . $artist;

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	if (isset($decoded_json["track"]) && !empty($decoded_json["track"])) {
		return $decoded_json["track"];
	} else return [];
}


/**
 * Function to get an array of the most weekly played tracks.
 * 
 * @return array object containing the title, artist and listeners of most played tracks.
 */
function get_top_tracks(): array
{

	$url = "https://ws.audioscrobbler.com/2.0/?method=chart.gettoptracks&format=json&api_key=" . API_KEY;

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);
	return $decoded_json["tracks"]["track"];
}


/**
 * Function to set the cookie about the last track visited.
 * 
 * @param name The name of the track.
 * @param artist The author of the track.
 */
function set_last_visited(string $name, string $artist): void
{
	setcookie("last_visited", $name . SEPARATOR . $artist, (time() + 3600 * 24 * 365));
}


/**
 * Function to save the user-visited tracks data into a log file (csv-type file).
 * 
 * @param name The name of the track.
 * @param artist The author of the track.
 */
function log_visited_track(string $name, string $artist): void
{

	$is_registered = false;
	$lines = [];

	// opening the csv file as read
	$file = fopen(VISITED_LOG_PATH, "r");

	// reading each line of the csv file
	while ($line = fgetcsv($file)) {
		if (($line[0] == $name) && ($line[1] == $artist)) {
			$line[2] = intval($line[2]) + 1;
			$is_registered = true;
		}
		$lines[] = $line;
	}
	fclose($file);

	if (!$is_registered) {
		$lines[] = [$name, $artist, 1];
	}

	$file = fopen(VISITED_LOG_PATH, "w");

	foreach ($lines as $line) {

		fputcsv($file, $line);
	}

	fclose($file);
}

/**
 * Function that get the informations about the last visited track from cookie.
 * 
 * @return array The last visited track.
 */
function get_last_visited(): array
{
	if (isset($_COOKIE["last_visited"])) {
		return explode(SEPARATOR, $_COOKIE["last_visited"]);
	} else {
		return [];
	}
}

/********************
 * ARTISTS
 ********************/

/**
 * Function to get an array of artists with names similar to the query.
 * 
 * @param query a string corresponding to the name of a artist.
 * @return array object containing the name, the listeners numbers and other informations of the similar artists.
 */
function search_artist(string $query): array
{

	$query = format_for_link($query);

	$url = "https://ws.audioscrobbler.com/2.0/?method=artist.search&format=json&api_key=" . API_KEY . "&artist=" . $query;
	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	if (isset($decoded_json["results"]["artistmatches"]["artist"]) && !empty($decoded_json["results"]["artistmatches"]["artist"])) {
		return $decoded_json["results"]["artistmatches"]["artist"];
	} else return [];
}


/**
 * Function to get an array of the informations about an artist.
 * 
 * @return array object containing the artist and listeners of most played tracks.
 */
function get_artist_info(string $artist): array
{

	$artist = str_replace(" ", "+", $artist);

	$url = "https://ws.audioscrobbler.com/2.0/?method=artist.getinfo&format=json&api_key=" . API_KEY . "&artist=" . $artist;

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	if (isset($decoded_json["artist"]) && !empty($decoded_json["artist"])) {
		return $decoded_json["artist"];
	} else return [];
}


/**
 * Function to get array of the most weekly played artists.
 * 
 * @return array object containing the name, listeners of the most played artists.
 */
function get_top_artists(): array
{

	$url = "https://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&format=json&api_key=" . API_KEY;

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	return $decoded_json["artists"]["artist"];
}




/********************
 * ALBUMS
 ********************/

/**
 * Function to get an array of albums with names similar to the query.
 * 
 * @param query a string corresponding to the name of an album.
 * @return array object containing the name, the listeners numbers and other informations of the similar albums.
 */
function search_album(string $query): array
{

	$query = format_for_link($query);

	$url = "https://ws.audioscrobbler.com/2.0/?method=album.search&format=json&api_key=" . API_KEY . "&album=" . $query;
	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	if (isset($decoded_json["results"]["albummatches"]["album"]) && !empty($decoded_json["results"]["albummatches"]["album"])) {
		return $decoded_json["results"]["albummatches"]["album"];
	} else return [];
}

/**
 * Function to get an array of informations about an artist's given album.
 * 
 * @param album a string corresponding to the album's name.
 * @param artist a string corresponding to the artist's name.
 * 
 * @return array object containing all the informations concerning that given album. 
 */
function get_album_info(string $album, string $artist): array
{

	$album = str_replace(" ", "+", $album);
	$artist = str_replace(" ", "+", $artist);

	$url = "https://ws.audioscrobbler.com/2.0/?method=album.getinfo&format=json&api_key=" . API_KEY . "&artist=" . $artist . "&album=" . $album;

	// init curl
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// execute the request
	$res = curl_exec($ch);
	curl_error($ch);

	// close the request
	curl_close($ch);

	$decoded_json = json_decode($res, true);

	if (isset($decoded_json["album"]) && !empty($decoded_json["album"])) {
		return $decoded_json["album"];
	} else return [];
}
