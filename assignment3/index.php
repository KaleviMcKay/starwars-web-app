<!DOCTYPE html>
<!--
Written by Kale McKay 2018
-->


<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "StarWarsStyling.css" />
        <meta charset="UTF-8">
        <title>Galactic Battlefield</title>
    </head>
    <body class ="bgmain" background="images/MainPage.jpg">
        <form class ="login" name="deploy" action="deploy.php" method="POST">
            <div class ="border">
                <legend class ="legend1" for="id"><b>Active Officer</b></legend>
                <input class ="text" type="text" placeholder="Enter Officer ID" name="uid" required>
                <legend class ="legend1" for="sec"><b>Security Clearance</b></legend>
                <input class ="password" type="password" placeholder="Enter Security Clearance" name="sec" required>

                <button type="submit">Deploy</button>
            </div>
        </form> 
    </body>
</html>
