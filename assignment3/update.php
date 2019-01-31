
<?php
session_start();
//gather user inputs
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$rank = filter_input(INPUT_POST, 'rank', FILTER_SANITIZE_STRING);
//assign session variables
$_SESSION['rank'] = $rank;
$_SESSION['id'] = $id;
try {


    $dbo = new PDO("mysql:host=localhost;dbname=000764160", "000764160", "19900804"); //connect to database
    $sql = "UPDATE starwars SET rank = ? WHERE id =?"; //sql query for update
    $stmt = $dbo->prepare($sql); //prepare query
    $userParams = [$rank, $id]; //variables masked to avoid injection
    $stmt->execute($userParams); //prepare stmt with masked variables
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
    <body class ="recon">
        <ul>
            <li><a href="light.php">Light Side</a></li>
            <li><a href="dark.php">Dark Side</a></li>
            <li><a href="sort.php">View Battlefield</a></li>
            <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <form class ="light2">  
            <div class ="border">
                <legend class ="legend1" for="id"><b>Frontlines update</b></legend>  
                <?php
                //validate user log in
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";
                } else {
                     if (!preg_match('/^[A-Z][a-z]+$/', $rank)) { //make sure rank is capitolized word
                        echo"<h3>" . "Rank must be a capitolized word" . "</h3>";
                    //else if to check for rows affected
                    }else {
                    //if to check for null values    
                    }if (isset($rank) != null) {
                            echo "<h3>" . "Recon gathered" . "</h3>";
                    }else{
                        echo "<h3>" . "Transmission Failed" . "</h3>";
                    }
                }
                ?>
            </div>
        </form> 

    </body>
</html>

