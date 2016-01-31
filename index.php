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
        <link rel="shortcut icon" href="favicon.ico">
        <title>Metroid Prime - Home</title>
    </head>
    <body>
        <div id="container">
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
            <div id="body">
                
                <div><center><video width="560" height="315" autoplay="none" preload="(none,auto,metadata)" poster="Tua immagine.jpg" controls="controls" loop="loop">
                    <source src="media/mpt_trailer.webm" type="video/mp4" />
                </video></center></div>
            </div>
            
            <div id="push"></div>
            
        </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</html>
