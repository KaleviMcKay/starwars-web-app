<?php
session_start();
?>
<!--
Written by Kale McKay 2018
-->
<html>

    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>search</title>
    </head>
    <body class ="active">
        <ul>
            <li><a href="light.php">Light Side</a></li>
            <li><a href="dark.php">Dark Side</a></li>
            <li><a href="sort.php">View Battlefield</a></li>
            <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <form class ="light22" name="search">  
            <div>
                <table>
                    <legend class ="legend1" for="id"><b>Active Recon</b></legend>
                    <?php
                    //try to connect to database
                    try {

                        $dbh = new PDO("mysql:host=localhost;dbname=000764160", "000764160", "19900804"); //connect to host
                    } catch (Exception $e) {
                        die("ERROR: Couldnt connect {$e->getMessage()}");
                    }


                    $command = "SELECT * FROM starwars ORDER BY rank ASC;"; //SQL query to select all and sort by rank
                    $stmt = $dbh->prepare($command); //prepare stmt
                    $stmt->execute(); //execute stmt
                    //if statement to create table based on radio button input "name and rank"
                    if (filter_input(INPUT_POST, 'recon', FILTER_SANITIZE_STRING) == "rank") {
                        echo "<p>" . "<th>" . "name" . "</th>" . "<th>" . "rank" . "</th>" . "<th>" . "alliance" . "</th>" . "</p>";
                        //while loop to print specified data acquired from database
                        while ($row = $stmt->fetch()) {
                            echo "<tr><td>{$row["name"]}</td><td>{$row["rank"]}</td><td>{$row["Alliance"]}</td></tr>";
                        }
                    }
                    //if statement to create table based on radio button input "name and ID"
                    if (filter_input(INPUT_POST, 'recon', FILTER_SANITIZE_STRING) == "id") {
                        echo "<p>" . "<th>" . "name" . "</th>" . "<th>" . "ID" . "</th>" . "<th>" . "alliance" . "</th>" . "</p>";
                        //while loop to print specified data acquired from database
                        while ($row = $stmt->fetch()) {
                            echo "<tr><td>{$row["name"]}</td><td>{$row["id"]}</td><td>{$row["Alliance"]}</td></tr>";
                        }
                    }
                    //if statement to create table based on radio button input "name and world"
                    if (filter_input(INPUT_POST, 'recon', FILTER_SANITIZE_STRING) == "world") {
                        echo "<p>" . "<th>" . "name" . "</th>" . "<th>" . "world" . "</th>" . "<th>" . "alliance" . "</th>" . "</p>";
                        //while loop to print specified data acquired from database
                        while ($row = $stmt->fetch()) {
                            echo "<tr><td>{$row["name"]}</td><td>{$row["world"]}</td><td>{$row["Alliance"]}</td></tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </form> 
    </body>
</html>