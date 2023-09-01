<?php
    session_start();
	$id = $_SESSION['user'];


	if($id == null)
	{
		header("location:redir.php");
	}
    

?>

<!DOCTYPE HTML>

<head>
    <title>Searches</title>
    <link rel="stylesheet" type="text/css" href="../CSS/results.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

    <div id = container style = "font-size: 28px">
        <div id = box>
            <h1><?php echo ("Saved Listings for: ".$_SESSION['user']);?></h1>
        </div>
        <div id = box style ="padding: 15px;">
            <h1><a href = "newSearch.php">Start a New Search</a></h1>
        </div>
    </div>

<?php

//Set up Table
$table = "savedData";
$user = $_SESSION['user'];
//Setup DBCONN
$DBConn = mysqli_connect("localhost", "root", "mysql", "jface");

//SQL Pull
$SQLstring = "SELECT * FROM $table WHERE user = '$user'";

$result = mysqli_query($DBConn, $SQLstring);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo(   
        '<div id = "container" style = "border: 1px solid black">
            <div class = "box"><img src= "'.$row['pic'].'" ALIGN="center" alt = "Image of Property"></div>
            <div class = "box"><p style="font-size: 20pt; margin-left: 3%">Listing Price: $'.$row['price'].
            '<br>Address: '.$row['address'].'<br>Square Ft: '.$row['sq'].'<br>Bedrooms: '
            .$row['bed'].'<br>Bathrooms: '.$row['bath'].'<br>Price per Sq. ft.: $'.$row['ppsqft'].'<br>
            <button onclick="removeFunction('.
            $row['id']
            .')">Remove Listing</button>
            <p id="demo'.$row['id'].'"></p>
            </div>
            </div>
        </div>');       
    }
} else {
    echo('
    <div id = container>
    <h1>No Saved Listings found, please save listings using <a href="login.php">the login page</a></h1>
    </div>');
}

?>

<!--Log Out Button-->
<div id = container>
    <p style = "font-size: 24px">Looking to Log Out? <a href = "../redir.php"> Click Here!</a></p>
</div>

<!--JavaScript Functions-->
<script>
    function removeFunction(id) {
        var element = "demo" + id;
        console.log(element);
        document.getElementById(element).innerHTML = "Listing Removed, Please Refresh window";

        $.ajax
        ({
        type: "POST",
         url: "removeResult.php",
         data: {id : id},
         success: console.log("Success"),
         dataType: String
        });
    }
</script>

</body>
</html>