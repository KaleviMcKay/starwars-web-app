<?php
session_start();
?>

<!DOCTYPE html>
<!--
Written by Kale McKay 2018
-->

<?php
$uid = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING); //retrieve user id from log in
$sec = filter_input(INPUT_POST, 'sec', FILTER_SANITIZE_STRING); //retrieve password from log in

$_SESSION["uid"] = $uid; //assign user id to session
$_SESSION["sec"] = $sec; //asign password to session
?>
<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>Deployment</title>
    </head>
    <body class ="bgd">
        <form class="login" name="side" action="side.php" method="POST">   
            <div class ="border">
                <legend class ="legend1" for="id"><b>Security Validation</b></legend>
                <?php
                //invalid log in
                if ($uid != "Sam" && $sec != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<input class='button' type='button' value= 'Back' onclick='history.back()'>";
                //valid log in
                } elseif ($uid === "Sam" && $sec === "password") {

                    echo"<h4>" . "Welcome General Scott" . "</h4>";
                    echo"<h4>" . "Access granted to nav bar" . "</h4>";
                }
                ?>
            </div>
        </form> 
        <?php
        //if block to allow user access to nav bar if log in validated
        if ($uid === "Sam" && $sec === "password") {
            echo " <ul>
            <li><a href='light.php'>Light Side</a></li>
            <li><a href='dark.php'>Dark Side</a></li>
            <li><a href='sort.php'>View Battlefield</a></li>
            <li style='float:right'><a href='logout.php'>Log Out</a></li>
            </ul>";
        }
        ?>

    </body>

</html>



