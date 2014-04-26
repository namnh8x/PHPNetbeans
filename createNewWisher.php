<?php
$dbHost = "sql201.byethost7.com";
$dbXeHost = "sql201.byethost7.com/XE";
$dbUsername = "b7_10443524";
$dbPassword = "ngunhubo";

$UsernameIsUnique = true;
$passwordIsValid = true;
$UserIsEmpty = false;
$passwordIsEmpty = false;
$password2IsEmpty = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["user"] == "") {
        $UserIsEmpty = true;
    }
    
    $con = mysqli_connect($dbHost, $dbUsername, $dbPassword);
    if (!$con) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    mysqli_set_charset($con, 'utf-8');
    
    mysqli_select_db($con, "b7_10443524_wishlist");
    mysqli_real_escape_string($con, $_POST["user"]);
     
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create New Wisher</title>
    </head>
    <body>
        Welcome!<br>
        <form action="createNewWisher.php" method="POST">
            Your name: <input type="text" name="user"/><br/>
            Password: <input type="password" name="password"/><br/>
            Please confirm your password: <input type="password" name="password2"/><br/>
            <input type="submit" value="Register"/>
        </form>
    </body>
</html>
