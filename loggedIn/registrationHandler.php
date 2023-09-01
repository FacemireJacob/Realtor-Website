<!DOCTYPE html>

<html>

<head>
    <title>loginHandler</title>
</head>

<body>

<?php

    $id = hash("md5", $_POST['id']);
    $pass = hash("md5",$_POST['pass'],);

    //is md5 hash for blank. Checks if UserID or pass is blank
    if(($id == "d41d8cd98f00b204e9800998ecf8427e") or $pass == "d41d8cd98f00b204e9800998ecf8427e")
    {
        //invalid user or pass
        echo '<script>';

        //Creates Alert Box
        echo 'alert("Invalid Login");';
        
        //Redirect
        echo "location.href = 'registration.php'";
        
        //Close Script
        echo '</script>';    
    }

    //Test Code
    //echo"test<br>$id<br>$pass";

    //table
    $table = "userLogin";

    //Setup Connection to DB
    $DBConn = mysqli_connect("localhost", "root", "mysql", "jface");

    $SQLstringOne = "INSERT INTO $table (user, pass) VALUES ('$id', '$pass')";

    //If Record exists pass is correct
    if(mysqli_query($DBConn, $SQLstringOne) > 0)
    {
        //invalid user or pass
        echo '<script type="text/javascript">';
        echo ' alert("Registration Successful, Please use Credentials to Log-In");';  //dont forget the semicolon in the echo or it breaks
        echo "location.href = 'login.php'"; //Redirect to Home Page
        echo '</script>';
    } 
    else 
    {
        //invalid user or pass
        echo '<script type="text/javascript">';
        echo ' alert("UserID is in Use");';  //dont forget the semicolon in the echo or it breaks
        echo "location.href = 'registration.php'"; //Redirect to Home Page
        echo '</script>';
    }
?>

</body>

</html>