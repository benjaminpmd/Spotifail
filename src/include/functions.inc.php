<?php
/**
 * File containing all function to call API from various sources.
 * 
 * @author Lucas L., Benjamin P
 * @version 22.04.22 (WIP)
 * @since 23/03/22
 */


define("API_KEY", $_ENV["LASTFM_API_KEY"]);

/**
 * Function to get the APOD (Astronomy Picture of the Day) from the NASA API.
 * 
 * @return array containing the title, url, explanation and copyright of the image;
 */
function get_nasa_daily_image(): array {

    // API stored in an ENV var
    $url = "https://api.nasa.gov/planetary/apod?api_key=".$_ENV["APOD_API_KEY"]."&date=".date("Y-m-d");
    
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

    if (empty($res_array["copyright"])) {
        $return_array = [
            "url" => $res_array["url"],
            "title" => $res_array["title"],
            "explanation" => $res_array["explanation"]

        ];
    } 
    else {
        $return_array = [
            "url" => $res_array["url"],
            "title" => $res_array["title"],
            "explanation" => $res_array["explanation"],
            "copyright" => $res_array["copyright"]
        ];
    }

    return $return_array;
}

/**
 * Function to get the approximative location of a client.
 * 
 * @return array the country name and de city nearest city of the user. Caution, the city can be empty if the IP address
 * does not permit to determine the client location. 
 */
function get_geolocation(): array {

    $url = "http://www.geoplugin.net/xml.gp?ip=".$_SERVER['REMOTE_ADDR'];

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





/********************
 * TRACKS
 ********************/

/**
 * Function to get an array of tracks with names similar to the query.
 * 
 * @param query a string corresponding to the name of a track.
 * @return array object containing the title, artist and listeners of similar tracks.
 */
function search_track(string $query): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=track.search&format=json&api_key=".API_KEY."&track=".$query;
    
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->results->trackmatches->track;
}


/**
 * Function to get an array of the most weekly played tracks.
 * 
 * @return array object containing the title, artist and listeners of most played tracks.
 */
function get_top_tracks(): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=chart.gettoptracks&format=json&api_key=".API_KEY;
    
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->tracks->track;
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
function search_artist(string $query): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=artist.search&format=json&api_key=".API_KEY."&artist=".$query;
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->results->artistmatches->artist;
}


/**
 * Function to get array of the most weekly played artists.
 * 
 * @return array object containing the name, listeners of the most played artists.
 */
function get_top_artists(): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=chart.gettoptracks&format=json&api_key=".API_KEY;
    
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->tracks->track;
}




/********************
 * ALBUMS
 * 
 * TODO: code the functions
 * 
 ********************/

/**
 * Function to get an array of albums with names similar to the query.
 * 
 * @param query a string corresponding to the name of an album.
 * @return array object containing the name, the listeners numbers and other informations of the similar albums.
 */
function search_album(string $query): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=album.search&format=json&api_key=".API_KEY."&album=".$query;
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->results->albummatches->album;
}




 /********************
 * TAGS
 * 
 * TODO: code the functions
 * 
 ********************/

/**
 * Function to get an array of tracks with the tag researched.
 * 
 * @param query a string corresponding to a tag.
 * @return array object containing the name, the listeners numbers and other informations of the most popular tracks with the searched tag.
 */
function get_top_tracks_by_tag(string $query): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=tag.gettoptracks&format=json&api_key=".API_KEY."&tag=".$query;
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->results->tracks->track;
}

/**
 * Function to get an array of artists with the tag researched.
 * 
 * @param query a string corresponding to a tag.
 * @return array object containing the name, the listeners numbers and other informations of the most popular artists with the searched tag.
 */
function get_top_artists_by_tag(string $query): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=tag.gettopartists&format=json&api_key=".API_KEY."&tag=".$query;
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->results->topartists->artist;
}

/**
 * Function to get an array of album with the tag researched.
 * 
 * @param query a string corresponding to a tag.
 * @return array object containing the name, the listeners numbers and other informations of the most popular albums with the searched tag.
 */
function get_top_albums_by_tag(string $query): array {

    $url = "https://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&format=json&api_key=".API_KEY."&tag=".$query;
    // init curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // execute the request
    $res = curl_exec($ch);
    curl_error($ch);
    
    // close the request
    curl_close($ch);
    
    $decoded_json = json_decode($res);
    
    return $decoded_json->results->albums->album;
}
?>