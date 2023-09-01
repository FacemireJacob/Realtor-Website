<!DOCTYPE html>

<head>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="CSS/results.css">
</head>

<body>

<?php
$city = $_POST['city'];
$state = $_POST['state'];
?>

<?php

//Some listings dont have sqft and this hides warnings about math errors
error_reporting(0);

//Rapid API (Website which handles subscribing to Various API) Auto generates code to connect in various language. The code has
//Has been edited to change the Endpoint to the city and state the user specifies
//This is Connecting to the API endpoint using cURL 

$curl = curl_init();

//Disable CURLOPT_SSL_VERIFYHOST and CURLOPT_SSL_VERIFYPEER by
//setting them to false.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt_array($curl, [
	CURLOPT_URL => "https://us-real-estate.p.rapidapi.com/v2/for-sale?offset=0&limit=42&state_code=".$state."&city=".$city."&sort=newest",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => ["X-RapidAPI-Host: us-real-estate.p.rapidapi.com",
		"X-RapidAPI-Key: c48a6821d1msh7fb780923a67b87p1f4ac2jsnf047ce18823c"
	],
]);

//If succesful, $response is the resulting JSON, err is a boolean that is true if there was an error
$response = curl_exec($curl);
$err = curl_error($curl);

//Close Curl
curl_close($curl);

//$err = true display error
if ($err) {
 	echo "cURL Error #:" . $err;
} 

//Array made by decoding JSON from API
$array = json_decode($response, TRUE);

//Navigation Buttons
echo(
    '<div id = container>
        <div id = box style ="padding: 15px">
            <h1><a href = "index.php">Start a New Search</a></h1>  
        </div>
        <div id = box style ="padding: 15px">
            <h1>Looking to Save Listings? <a href = "loggedIn/login.php">Log In Here!</a></h1>
        </div>
    </div>'
);

//This For Loop inputs all results (up to 20) in an array
for($i = 0; $i < 20; $i++)
{
    $j = $array['data']['home_search']['results'][$i]['primary_photo']['href'];
    $sq = floatval($array['data']['home_search']['results'][$i]['description']['sqft']);
    $price = floatval($array['data']['home_search']['results'][$i]['list_price']);
    $add = $array['data']['home_search']['results'][$i]['location']['address']['line'].' '
        .$array['data']['home_search']['results'][$i]['location']['address']['city'].' '
        .$array['data']['home_search']['results'][$i]['location']['address']['state_code'];
    $bed = $array['data']['home_search']['results'][$i]['description']['beds'];
    $bath = $array['data']['home_search']['results'][$i]['description']['baths'];
    $ppsqft = round($price/$sq, 2);
    $lat = $array['data']['home_search']['results'][$i]['location']['address']['coordinate']['lat'];
    $lon = $array['data']['home_search']['results'][$i]['location']['address']['coordinate']['lon'];

    $arraySave[$i] = array($j, $sq, $price, $add, $bed, $bath, $ppsqft, $lat, $lon, $array['data']['home_search']['results'][$i]['property_id']);

    // This Code Would get the Walkability score of a neighborhood via the WalkScore API (https://www.walkscore.com/) However. They didn't give me an API key. 
    //They sent me an email when I didnt have a professional domain and never responded. Running this code get an error 400 and the only response I get is 40 
    //Ive kept the code in here as while the cURL is generated for me and used from RapidAPI I did have to learn how to get the value from an XML response, which
    //I felt was worth keeping to show I tried
    
    //API Call to WalkScore to find Walkability of Neighborhood

    // $curl2 = curl_init();
    
    // curl_setopt_array($curl2, [
    //     CURLOPT_URL => "https://walk-score.p.rapidapi.com/score?lat=%3C.$lat.%3E&address=%3C".$add
    //     ."%3E&wsapikey=c48a6821d1msh7fb780923a67b87p1f4ac2jsnf047ce18823c&lon=%3C.$lon.%3E",
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 30,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => "GET",
    //     CURLOPT_HTTPHEADER => [
    //         "X-RapidAPI-Host: walk-score.p.rapidapi.com",
    //         "X-RapidAPI-Key: c48a6821d1msh7fb780923a67b87p1f4ac2jsnf047ce18823c"
    //     ],
    // ]);
    
    // //Pull Response From Req. 
    // $response2 = curl_exec($curl2);
    // $err2 = curl_error($curl2);
    
    // //Close Req
    // curl_close($curl2);
    
    // //Error Reporting
    // if ($err2) {
    //     echo "cURL Error #:" . $err;
    // } else {
    //     echo $response2;
    // }

    // //Pull Value from XML Response
    // $xml = simplexml_load_string($response2);
    // echo($xml['status']);

    echo
    (
        '<div id = "container" style = "max-height: 25%; border: 1px solid black">
        <div class = "box"><img src= "'.$arraySave[$i][0].'" ALIGN="center" alt="Image of Property for Sale"></div>
        <div class = "box"><p style="font-size: 20pt; align-items: left; margin-left:3%">Listing Price: $'.$arraySave[$i][2].
        '<br>Address: '.$arraySave[$i][3].'<br>Square Ft: '.$arraySave[$i][1].'<br>Bedrooms: '
        .$arraySave[$i][4].'<br>Bathrooms: '.$arraySave[$i][5].'<br>Price per Sq. ft.: $'.$arraySave[$i][6].'<br>'
        //This Code would display the walkability but for reasons explained above ive commented it out
        //  .'WalkScore Walkability rating: '.$xml['status']
        .'</div>
        </div>'
    );
}    

?>
</body>`
