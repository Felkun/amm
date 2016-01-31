<!-- Connessione al database -->
<?php
    //include("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Giorgio Floris">
        <style type="text/css">/</style>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <title>Metroid Prime - Home</title>
    </head>
    <header>
        <div id="header">
            <h1 class="logo"><a href="index.php">Metroid Prime Website</a></h1>
            
            <ul id="menu">
                <li><a class="active" href="index.php"><span class="menu">Home</span></a></li>
                <li><a href="series.php"><span class="menu">La Serie</span></a></li>
                <li><a href="story.php"><span class="menu">La Storia</span></a></li>
                <li><a href="gameplay.php"><span class="menu">Gameplay</span></a></li>
                <li><a href="shop.php"><span class="menu">Shop</span></a></li>
        </ul>
        </div>
    </header>
    <body>
        <br/><br/><br/>
        <div><center><video width="560" height="315" autoplay="autoplay" preload="(none,auto,metadata)" poster="Tua immagine.jpg" controls="controls" loop="loop">
            <source src="media/mpt_trailer.webm" type="video/mp4" />
        </video></center></div>
    <footer>
        <div style="float:left; clear:both;">Copyright &#169; 2002-2016 Nintendo</div>
        <div style="float:right; clear:both;">All Rights Reserved</div> 
    </footer>
</html>
