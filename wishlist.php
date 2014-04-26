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
       
        Wish List of: <?php echo htmlentities($_GET["user"])."<br/>";?>
        <?php
            $con = mysqli_connect("sql201.byethost7.com", "b7_10443524", "ngunhubo"); //connection simply needs hostname, username & pw
            if (!$con) {
                //send out error message
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
            mysqli_set_charset($con, 'utf-8'); //set character set
            
            mysqli_select_db($con, "b7_10443524_wishlist"); //choose DB
            
            //escape special characters from a string, to use in query (may be $_GET["user"] will have some special characters
            $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));
            
            //query returns an array
            $wisher = mysqli_query($con, "SELECT id FROM wishers WHERE name='" . $user . "'");
            //count < 1, no user
            if (mysqli_num_rows($wisher) < 1) {
                exit("The person " . htmlentities($_GET["user"]) . " is not found.");
            }
            
            $row = mysqli_fetch_row($wisher);
            $wisherID = $row[0];
            
            //free memory
            mysqli_free_result($wisher);
        ?>
        <table border="black">
            <tr>
                <th>Item</th>
                <th>Due Date</th>
            </tr>
            <?php
            $result = mysqli_query($con, "SELECT description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>" . htmlentities($row["description"]) . "</td>";
                echo "<td>" . htmlentities($row["due_date"]) . "</td></tr>\n";
            }
            //htmlentities converts all chars that have HTML entity equavilents into HTML entities
            mysqli_free_result($result);
            mysqli_close($con);
            ?>
        </table>
    </body>
</html>
