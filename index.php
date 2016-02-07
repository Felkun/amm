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
                
                <div><center><video id='blueborder' width="560" height="315" autoplay="autoplay" preload="metadata" controls="controls">
                    <source src="media/mpt_trailer.webm" type="video/mp4" />
                </video></center></div>
            </div>
            
            <div id="push"></div>
            
        </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</html>

<p class="about">
<?php 		
		if($_SESSION['username']=="GUEST") {				
		print("<FORM ACTION=\"login.php\" METHOD=\"POST\">");		
		print("<ul>");
		print("<li>Username</li>");
		print("<li><INPUT TYPE=\"Text\" NAME=\"username\"></li>");
		print("<li>Password</li>");
		print("<li><INPUT TYPE=\"Password\" NAME=\"password\"></li>");
		print("<BR>");
		print("<li><INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Log In\"></li>");
		print("<li>Non sei registrato? <a href=\"registrazione.php\">Registrati!</a></li>");
		if(isset($_SESSION['accessonegato'])==1) { print("<li><h1>Non hai inserito dati di accesso corretti!</h1></li>"); unset($_SESSION['accessonegato']); }
		print("</ul>");
		print("</FORM>");
		}
		if($_SESSION['username']!="GUEST") {
		print("<span>Benvenuto ".$_SESSION['username']." !</span>");
		print("<a href=\"riserved.php\"><p>Entra nella tua area riservata!</p></a>");
		print("<FORM ACTION=\"logout.php\" METHOD=\"POST\">");
		print("<ul>");
		print("<li><INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Log Out\"></li>");
		print("</ul>");
		print("</FORM>");
		}
                ?>	</p>
