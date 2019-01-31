<?php
session_start();

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); //retrieves and filters/sanitized variable from form
$_SESSION['id'] = $id; //id assigned to session variable

try {

    $dbo = new PDO("mysql:host=localhost;dbname=000764160", "000764160", "19900804"); //connect to host
    $sql = "DELETE FROM starwars WHERE id = ?"; //SQL delete query to delete data specified by user input
    $stmt = $dbo->prepare($sql); //prepare query
    $userParams = [$id]; //id assigned to variable to stop injection
    $stmt->execute($userParams); //execute the stmt with variable
    $count = $stmt->rowCount(); //count of rows affected
} catch (Exception $e) {
    die("ERROR: Couldnt connect {$e->getMessage()}");
}
?>

<!--
Written by Kale McKay 2018
-->



<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>losses</title>
    </head>
    <body class ="delete">
        <ul>
            <li><a href="light.php">Light Side</a></li>
            <li><a href="dark.php">Dark Side</a></li>
            <li><a href="sort.php">View Battlefield</a></li>
            <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <form class ="light2">  
            <div>
                <legend class ="legend1" for="id"><b>Losses</b></legend>   
                <?php
                //if to check if user is logged in
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";
                //else to create form if user is logged in
                } else {
                //if block for input not null
                } if (isset($id) != null) {
                    echo "<h3>" . $id . " " . "Has died in battle" . "</h3>"; //print the success message
                }else{
                    echo "<h3>" . "Transmission Failed" . "</h3>";
                }
                ?>
            </div>
        </form> 
    </body>
</html>
