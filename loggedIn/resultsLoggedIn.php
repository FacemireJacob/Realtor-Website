<?php
    session_start();
	$id = $_SESSION['user'];

	if($id == null)
	{
		header("location:redir.php");
	}
    error_reporting(0);
?>
<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="../CSS/results.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

    <div id = container>
        <div id = box>
            <h1><?php echo ("Welcome ".$_SESSION['user']);?></h1>
        </div>
    </div>

    <div id = container>
        <div id = box style ="padding: 15px;">
            <h1><a href = "newSearch.php">Start a New Search</a></h1>
        </div>
        <div id = box style ="padding: 15px;">
            <h1>Looking for Saved Listings? <a href = "savedSearches.php">Click Here!</a></h1>
        </div>
    </div>

<?php

$city = $_POST['city'];
$state = $_POST['state'];
?>

<?php

//Rapid API (Website which handles subscribing to Various API) Auto generates code to connect in various language. The code has
//Has been edited to change the ENdpoint to the city and state the user specifies
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

    $arraySave[$i] = array($j, $sq, $price, $add, $bed, $bath, $ppsqft, $lat, $lon);

    echo
    (
        '<div id = "container" style = "border: 1px solid black">
        <div class = "box"><img src= "'.$arraySave[$i][0].'" ALIGN="center" alt="Image of Property for Sale"></div>
        <div class = "box"><p style="font-size: 20pt; margin-left: 3%">Listing Price: $'.$arraySave[$i][2].
        '<br>Address: '.$arraySave[$i][3].'<br>Square Ft: '.$arraySave[$i][1].'<br>Bedrooms: '
        .$arraySave[$i][4].'<br>Bathrooms: '.$arraySave[$i][5].'<br>Price per Sq. ft.: $'.$arraySave[$i][6].'<br>
        <button onclick="saveFunction('.
        //This PHP function changes the url which has special HTML chars in a way it can be passed wihtout breaking JS
        htmlspecialchars(json_encode($arraySave[$i][0]),ENT_QUOTES,'utf-8').","
        .$arraySave[$i][1].","
        .$arraySave[$i][2].","
        .htmlspecialchars(json_encode($arraySave[$i][3]),ENT_QUOTES,'utf-8').","
        .$arraySave[$i][4].","      
        .$arraySave[$i][5].","
        .$arraySave[$i][6].","
        .$arraySave[$i][7].","
        .$arraySave[$i][8].","
        .$i
        .')">Save Listing</button>
        <p id="demo'.$i.'" style = "margin-left: 3%; font-size: 20px"></p>
        </div>
        </div>'
    );
}    

//This Echo Prints out the results of the search and places a button which calls a JS Function to save the result

// 
?>

<!--Log Out Button-->
<div id = container>
    <p style = "font-size: 24px">Looking to Log Out? <a href = "../redir.php"> Click Here!</a></p>;
</div>

<!--JavaScript Functions-->
<script>
    function saveFunction(pic, sq, price, add, bed, bath, ppsqft, lat, lon, i) {
        var element = "demo" + i;
        console.log(element);
        
        document.getElementById(element).innerHTML = "Listing Saved, Find it in your saved searches <a href='savedSearches.php'>here</a>";

        $.ajax
        ({
        type: "POST",
         url: "saveResult.php",
         data: {pic : pic, sq : sq, price : price, add: add, bed : bed, bath: bath, ppsqft: ppsqft, lat: lat, lon: lon},
         success: console.log("Success"),
         dataType: String
        });
    }
</script>
</body>
