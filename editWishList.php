<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Wish List</title>
    </head>
    <body>
        <form name="addNewWish" action="editWish.php">            
            <input type="submit" value="Add Wish">
        </form>
        <table border="black">
            <tr><th>Item</th><th>Due date</th></tr>
            <?php
                require_once ("includes/db.php");
                $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION["user"]);
                $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . htmlentities($row['description']) . "</td>";
                    echo "<td>" . htmlentities($row['due_date']) . "</td></tr>\n";
                }
            ?>
        </table>
        <?php
        session_start();
        if (array_key_exists("user", $_SESSION)) {
            echo "Hello " . $_SESSION["user"];
        }
        else {
            header('Location: index.php');
            exit;
        }
        ?>
    </body>
</html>
