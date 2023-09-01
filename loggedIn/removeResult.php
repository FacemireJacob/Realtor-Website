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
    $id = $_POST['id'];

    //table
    $table = "savedData";

    //Setup Connection to DB
    $DBConn = mysqli_connect("localhost", "root", "mysql", "jface");

    //Stores Listing ID under user name
    $SQLstringOne = "DELETE FROM savedData WHERE id = $id";
    mysqli_query($DBConn, $SQLstringOne);

?>

</body>

</html>