<?php
    session_start();
?>

<!DOCTYPE html>

<html>

<head>
    <title>save Listing</title>
</head>

<body>

<?php

//Sets vars to pass into SQL database
    $user = $_SESSION['user'];
    $pic = $_POST['pic'];
    $sq = $_POST['sq'];
    $price = $_POST['price'];
    $add = $_POST['add'];
    $bed = $_POST['bed'];
    $bath = $_POST['bath'];
    $ppsqft = $_POST['ppsqft'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    //table
    $table = "savedData";

    //Setup Connection to DB
    $DBConn = mysqli_connect("localhost", "root", "mysql", "jface");

    //Stores Listing ID under user name
    $SQLstringOne = "SELECT * FROM savedData WHERE user = '$user' and pic = '$pic'";
    $result = mysqli_query($DBConn, $SQLstringOne);

    $SQLstringTwo = "INSERT INTO $table (user, pic, sq, price, address, bed, bath, ppsqft, lat, lon) VALUES ('$user', '$pic', '$sq', '$price', '$add', '$bed', '$bath', '$ppsqft', '$lat', '$lon')";

    //If Record exists pass is correct
	if(mysqli_num_rows($result) > 0)
    {
        echo("already exists");     
    } 
    else 
    {
        mysqli_query($DBConn, $SQLstringTwo);
    }
?>

</body>

</html>