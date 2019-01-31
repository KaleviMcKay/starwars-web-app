<?php
session_start();
session_destroy();
?>
<!--
Written by Kale McKay 2018
-->


<html>

    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>sign out</title>
    </head>
    <body class ="logout">
        <form class ="light2" action ="index.php" method ="POST">
            <legend class ="legend1" for="id"><b>Logged Out</b></legend>
            <?php
            //clears log in information and signs user out
            echo "<h3>" . "Thank you for your service. May the force be with you" . "</h3>";
            $uid = "";
            $password = "";
            ?>
            <input class = "button" type=submit value="Sign in">


        </form>
    </body>
</html>
