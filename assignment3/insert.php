<?php
session_start();
?>

<!--
Written by Kale McKay 2018
-->

<?php
//gather user inputs
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$rank = filter_input(INPUT_POST, 'rank', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$world = filter_input(INPUT_POST, 'world', FILTER_SANITIZE_STRING);
$deployed = filter_input(INPUT_POST, 'deployed');
$alliance = filter_input(INPUT_POST, 'alliance');

//create session variables for user input
$_SESSION['alliance'] = $alliance;
$_SESSION['name'] = $name;
$_SESSION['rank'] = $rank;
$_SESSION['id'] = $id;
$_SESSION['world'] = $world;
$_SESSION['deployed'] = $deployed;
try {
    $dbo = new PDO("mysql:host=localhost;dbname=000764160", "000764160", "19900804"); //connect to host
} catch (Exception $e) {
    die("ERROR: Couldnt connect {$e->getMessage()}");
}
?>     
<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>Deploy troops</title>
    </head>
    <body class ="deployed">
        <ul>
            <li><a href="light.php">Light Side</a></li>
            <li><a href="dark.php">Dark Side</a></li>
            <li><a href="sort.php">View Battlefield</a></li>
            <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <form class ="light2">  
            <div class ="border">
                <legend class ="legend1" for="id"><b>Troop Deployment</b></legend>   
                <?php
                //if block to check for logged in user
                if (isset($_SESSION["uid"]) != "Sam" && isset($_SESSION["sec"]) != "password") {

                    echo "<h3>" . "!!Invalid ID and Clearance!!" . "</h3>";
                    echo "<div class='buttonLog'><a href='index.php'>Security Error! LOG IN</a></div>";
                //else block when user has been validated
                } else {
                //digits must be 1-5 numbers in length   
                } if (!preg_match('/^\d{1,5}$/', $id) && isset($id)) { 
                    echo"<h3>" . "ID must be 1 to 5 inclusive in length" . "</h3>";
                //rank must be single word capitolized    
                } elseif (!preg_match('/^[A-Z][a-z]+$/', $rank) && isset($rank)) { 
                    echo"<h3>" . "Rank must be a capitol word and only be 1 word" . "</h3>";
                //name must be word(s) with optional white space
                } elseif (!preg_match('/[a-zA-Z]+\s[A-Za-z]+/', $name) && isset($name)) { //name must be word(s) with optional white space
                    echo"<h3>" . "Name must be 1 or more words" . "</h3>";

                //if block to check for null inputs. Incase page opened out of order.
                } else if (isset($name) != null && isset($rank) != null && isset($id) != null && isset($world) != null && isset($deployed) != null && isset($alliance) != null) {
                    //query to check for duplicate id.
                    $sql = "SELECT * FROM starwars WHERE id = $id";
                    $stmt = $dbo->prepare($sql);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    //duplicate id check
                    if ($count > 0) {
                        echo "<h3>" . "Duplicate ID" . "</h3>";
                    } else {

                        //SQL insert commands to create new data and insert into the database
                        $sql = "INSERT INTO starwars (name, rank, id, world, deployed, alliance)VALUES (?, ?, ?, ?, ?, ?)";

                        $stmt = $dbo->prepare($sql); //prepare sql query to be run
                        $userParams = [$name, $rank, $id, $world, $deployed, $alliance]; //parameters that have been masked to avoid injection
                        $stmt->execute($userParams); //execute stmt with masked parameters
                        echo "<h3>" . "Troop deployed successfully!" . "</h3>";
                    }
                }
                ?>
            </div>
        </form> 
    </body>
</html>