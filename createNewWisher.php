<?php
require_once ("includes/db.php");

$UsernameIsUnique = true;
$passwordIsValid = true;
$UserIsEmpty = false;
$passwordIsEmpty = false;
$password2IsEmpty = false;

//check empty user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["user"] == "") {
        $UserIsEmpty = true;
    }

   $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_POST["user"]);
   if ($wisherID) {
       $UsernameIsUnique = false;
   }

    //check password fields
    if ($_POST["password"] == "") {
        $passwordIsEmpty = true;
    }
    if ($_POST["password2"] == "") {
        $password2IsEmpty = true;
    }
    if ($_POST["password"] != $_POST["password2"]) {
        $passwordIsValid = false;
    }

    //requirements met, insert to DB
    if (!$UserIsEmpty && $UsernameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        WishDB::getInstance()->create_wisher($_POST["user"], $_POST["password"]);
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
        <title>Create New Wisher</title>
    </head>
    <body>
        Welcome!<br>
        <form action="createNewWisher.php" method="POST">
            Your name: <input type="text" name="user"/><br/>
            <?php
            if ($UserIsEmpty) {
                echo ("Enter username!!!<br/>");
            }
            ?>
            Password: <input type="password" name="password"/><br/>
            <?php
            if ($passwordIsEmpty) {
                echo ("Enter the password, please!");
                echo ("<br/>");
            }
            ?>
            Please confirm your password: <input type="password" name="password2"/><br/>
            <?php
            if ($password2IsEmpty) {
                echo ("Confirm your password, please");
                echo ("<br/>");
            }
            if (!$password2IsEmpty && !$passwordIsValid) {
                echo ("The passwords do not match!");
                echo ("<br/>");
            }
            ?>
            <input type="submit" value="Register"/>
        </form>
    </body>
</html>
