
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
        <title>sorted</title>
    </head>
    <body class ="battles">
        <ul>
            <li><a href="light.php">Light Side</a></li>
            <li><a href="dark.php">Dark Side</a></li>
            <li><a href="sort.php">View Battlefield</a></li>
            <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <form class ="light4">
            <div>
                <table>
                    <legend class ="legend1" for="id"><b>Battlefield overview</b></legend>
                    <?php
                    //if block to make sure user is logged in
                    if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                        echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                        echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";
                    //else block for database connection and sorted table from database created if user is validated
                    } else {
                        try {

                            $dbh = new PDO("mysql:host=localhost;dbname=000764160", "000764160", "19900804"); //connect to host
                        } catch (Exception $e) {
                            die("ERROR: Couldnt connect {$e->getMessage()}");
                        }


                        $command = "SELECT * FROM starwars  ORDER BY rank ASC;"; //SQL query to sort by rank 
                        $stmt = $dbh->prepare($command); //prepare stmt
                        $stmt->execute(); //execute stmt

                        echo "<p>" . "<th>" . "name" . "</th>" . "<th>" . "rank" . "</th>" . "<th>" . "officer ID" . "</th>" . "<th>" . "home world" . "<th>" . "deployed" . "</th>" . "<th>" . "alliance" . "</th>" . "</p>";
                        //while loop to print specified data acquired from database
                        while ($row = $stmt->fetch()) {
                            echo "<tr><td>{$row["name"]}</td><td>{$row["rank"]}</td><td>{$row["id"]}</td><td>{$row["world"]}</td><td>{$row["deployed"]}<td>{$row["Alliance"]}</td></tr>";
                        }
                    }
                    ?>

                </table>
            </div>
        </form>
        <div class ="div31">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/sCVWm20fU0A?autoplay=1&start=27&end=477&mute=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
        </div>
    </body>
</html>