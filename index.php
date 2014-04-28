<?php
    error_reporting(E_ALL);
    require_once ("includes/db.php");
    $logonSuccess = false;
    
    //verify user
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials($_POST["user"], $_POST["userpassword"]));
        if ($logonSuccess == true) {
            session_start();
            $_SESSION["user"] = $_POST["user"];
            header('Location: editWishList.php');
            exit;
        }
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
        <title></title>
    </head>
    <body>
        <form name="wishList" method="GET" action="wishlist.php">
            Show wish list of: <input type="text" name="user" value=""/>
            <input type="submit" value="Go"/>
            <br>Still don't have a wish list?! <a href="createNewWisher.php">Create now</a>
        </form>
        <form name="logon" action="index.php" method="POST" >
            Username: <input type="text" name="user">
            Password  <input type="password" name="userpassword">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!$logonSuccess) {
                        echo "Invalid username/password";
                    }
                }
            ?>
            <input type="submit" value="Edit My Wish List">
        </form>Ï
    </body>
</html>
