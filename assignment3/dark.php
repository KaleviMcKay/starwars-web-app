<?php
session_start();
//connect to database and assign query variables
try {
    $dbh = new PDO("mysql:host=localhost;dbname=000764160", "000764160", "19900804");
    $command = "SELECT name, id FROM starwars ORDER BY id;";
    $stmt = $dbh->prepare($command); //prepare stmt
    $stmt->execute(); //execute stmt
} catch (Exception $ex) {
    die("ERROR: Couldnt connect {$e->getMessage()}");
}
?>

<!DOCTYPE html>
<!--
Written by Kale McKay 2018
-->

<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>Manage your army</title>
    </head>
    <body class ="bg3">
        <ul>
            <li><a href="light.php">Light Side</a></li>
            <li><a href="dark.php">Dark Side</a></li>
            <li><a href="sort.php">View Battlefield</a></li>
            <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <form class ="light1" name="side" action="insert.php" method="POST">   
            <div>
                <legend class ="legend1" for="id"><b>Additional troops required!</b></legend>
                <?php
                //if block to check if user is logged in
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";
                    //else creates form if user logged in 
                } else {

                    echo "<p>" . "Name of soldier" . "</p>";
                    echo "<input type='text' class ='update' placeholder='Soldier name' name='name' required>";
                    echo "<p>" . "Rank" . "</p>";
                    echo "<input type='text' class ='update' placeholder='Rank' name='rank' required>";
                    echo "<p>" . "Soldier ID" . "</p>";
                    echo "<input type='number' class ='update' placeholder='Soldier ID' name='id' required>";
                    echo "<p>" . "Alliance" . "</p>";
                    echo "<input type='radio' class ='update' name='alliance' value='Empire' checked><p>Empire</p>";
                    echo "<p>" . "Home world" . "</p>";
                    echo "<input type='text' class ='update' placeholder='Home world' name='world' required>";
                    echo "<p>" . "Deployment date" . "</p>";
                    echo "<input type='date' class ='update' name='deployed' required>";
                    echo "<input class = 'button' type=submit value='Deploy new troops'>";
                }
                ?>
            </div>
        </form> 

        <form class ="light2" name="side" action="update.php" method="POST">  
            <div class ="border">
                <legend class ="legend1" for="id"><b>Update from the battlefield!</b></legend>
                <?php
                //if block to make sure user is logged in
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";
                    //else block creates form after user has been signed in
                } else {
                    echo "<p>" . "List of Soldier IDs" . "</p>";
                    echo "<select name ='id' class='update'>";
                    //while loop to populate dropdown list from database
                    while ($row = $stmt->fetch()) {
                        echo "<option value='$row[id]'>{$row['name']}->{$row['id']}</option>";
                    }
                    echo "</select>";
                    echo "<p>" . "Change Rank" . "</p>";
                    echo "<input type='text' class ='update' placeholder='Rank of soldier' name='rank' required>";
                    echo "<input class = 'button' type=submit value='Front lines update'>";
                }
                ?>
            </div>
        </form>  

        <form class ="light3" name="side" action="delete.php" method="POST">  
            <div class ="border">
                <legend class ="legend1" for="id"><b>We are taking losses!</b></legend>
                <?php
                try {
                    $command = "SELECT name, id FROM starwars ORDER BY id;";
                    $stmt = $dbh->prepare($command); //prepare stmt
                    $stmt->execute(); //execute stmt
                } catch (Exception $ex) {
                    die("ERROR: Couldnt connect {$e->getMessage()}");
                }
                //if block to make sure user is logged in
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";

                    //else block creates form if user is logged in
                } else {
                    echo "<p>" . "List of Soldier IDs" . "</p>";
                    echo "<select name ='id' class='update'>";
                    //while loop to populate dropdown list from 
                    while ($row = $stmt->fetch()) {
                        echo "<option value='$row[id]'>{$row['name']}->{$row['id']}</option>";
                    }
                    echo "</select>";
                    echo "<input class = 'button' type=submit value='Killed in action'>";
                }
                ?>
            </div>
        </form>  
        <form class ="light21" name="side" action="search.php" method="POST">  
            <div>
                <legend class ="legend1" for="id"><b>Active Recon</b></legend>
                <?php
                //checks for user log in
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='button'><a href='index.php'><h5>Security Error! LOG IN<h5></a></div>";

                    //else block creates form if user is logged in
                } else {
                    echo "<div class ='update'>";
                    echo "<p>" . "Search and display:" . "</p>";
                    echo "<input type='radio' class ='radio' name='recon' id = 'rank' value='rank' checked><h5>Name,rank and alliance</h5><br>";
                    echo "<input type='radio' class ='radio' name='recon' id ='id' value='id'><h5>Name,ID and alliance</h5><br>";
                    echo "<input type='radio' class ='radio' name='recon' id = 'world' value='world'><h5>Name,world and alliance</h5><br>";
                    echo "</div>";
                    echo "<input class = 'button' type=submit value='Gather recon'>";
                }
                ?>
            </div>
        </form> 

    </body>
</html>
