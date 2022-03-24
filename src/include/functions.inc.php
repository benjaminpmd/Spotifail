<?php


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

    if (!empty($res_array->copyright)) {
        $return_array = [
            "url" => $res_array->url,
            "title" => $res_array->title,
            "explanation" => $res_array->explanation,
            "copyright" => $res_array->copyright
        ];
    } 
    else {
        $return_array = [
            "url" => $res_array->url,
            "title" => $res_array->title,
            "explanation" => $res_array->explanation,
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
?>