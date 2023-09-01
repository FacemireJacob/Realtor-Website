<?php
    //PHP Session statement to save logged in user
    session_start();
?>

<!DOCTYPE HTML>

<head>

<title>loginHandler</title>

<!--CSS-->
<link rel="stylesheet" type="text/css" href="../CSS/home.css">
</head>

<body>

<?php

//Set ID as var to use in session
$id2 = $_POST['id'];

//All user data is hashed in the DB
$id = hash("md5", $_POST['id']);
$pass = hash("md5",$_POST['pass'],);

//is md5 hash for blank. Checks if UserID or pass is blank
if(($id2 == "d41d8cd98f00b204e9800998ecf8427e") or $pass == "d41d8cd98f00b204e9800998ecf8427e")
{
    //invalid user or pass
    echo '<script>';

    //Creates Alert Box
    echo 'alert("Invalid Login");';
    
    //Redirect
    echo "location.href = 'login.php'";
    
    //Close Script
    echo '</script>';    
}

//table
$table = "userLogin";

//Setup Connection to DB
$DBConn = mysqli_connect("localhost", "root", "mysql", "jface");

//Setup SQL query and execute to find mathcing user
$SQLstringOne = "SELECT * from $table WHERE user='$id' and pass = '$pass'";
$queryResult = mysqli_query($DBConn, $SQLstringOne);

//If Record exists pass is correct store id as Session variable and redirect to search page for logged in users
if(mysqli_num_rows($queryResult) > 0)
{
    //Set ID as Session Variable
    $_SESSION['user'] = "$id2";

    //JS Script redirects to logged in Search pag
    echo('<script>location.href = "newSearch.php"</script>');
} 
else
{
    //invalid user or pass
    echo '<script>';

    //Creates Alert Box
    echo 'alert("Invalid Login");';
    
    //Redirect
    echo "location.href = 'login.php'";
    
    //Close Script
    echo '</script>';
}
?>

</body>

</html>