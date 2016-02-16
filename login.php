<!DOCTYPE html>
<?php 
    include("connect.php");
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Giorgio Floris" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <title>Metroid Prime - Home</title>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1 class="logo"><a href="index.php">Metroid Prime Website</a></h1>
            <ul id="menu">
                <li><a href="index.php"><span class="menu">Home</span></a></li>
                <li><a href="series.php"><span class="menu">La Serie</span></a></li>
                <li><a href="story.html"><span class="menu">La Storia</span></a></li>
                <li><a href="gameplay.php"><span class="menu">Gameplay</span></a></li>
            </ul>
        </div>
        <div id="body">
            <div id="login">
                    <?php if($_SESSION['username']=="GUEST") {
                        print("Benvenuto! - <a href=\"login.php\">Log-in</a>");
                    } else {
                        print("Bentornato ");
                        echo$_SESSION['username'];
                        print("! - <a href=\"logout.php\">Log-out</a>");
                    }
                    ?>
            </div> <br />
            
            <!-- Form per log-in -->
            <?php
                print("<FORM ACTION=\"login_form.php\" METHOD=\"POST\">");		
                print("<ul style=\"list-style: none;\">");
                print("<li>Username</li>");
                print("<li><INPUT TYPE=\"Text\" NAME=\"username\"></li>");
                print("<li>Password</li>");
                print("<li><INPUT TYPE=\"Password\" NAME=\"password\"></li>");
                print("<br />");
                print("<li><INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Log In\"></li>");
                print("<br />");
                print("<li>Non sei registrato? <a href=\"registrazione.php\">Registrati!</a></li>");
                if(isset($_SESSION['accessonegato'])==1) {
                    print("<li><h1>Non hai inserito dati di accesso corretti!</h1></li>");
                    unset($_SESSION['accessonegato']);
                }
                print("</ul>");
                print("</FORM>");
            ?>	
        </div>
        <div id="push"></div>        
    </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</body>
</html>
