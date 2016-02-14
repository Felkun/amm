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
                <li><a href="story.php"><span class="menu">La Storia</span></a></li>
                <li><a href="gameplay.php"><span class="menu">Gameplay</span></a></li>
            </ul>
        </div>
        <div id="body">
    <?php if($_SESSION['username']=="GUEST") {
        if(isset($_SESSION['regriuscita'])==0) {
            print("<BR>Procediamo alla creazione del tuo utente</p><BR>");
            if(isset($_SESSION['e1'])==1) {
                print($_SESSION['e1']); print("<BR>"); unset($_SESSION['e1']);
            }
            if(isset($_SESSION['e2'])==1) {
                print($_SESSION['e2']); print("<BR>"); unset($_SESSION['e2']);
            }
            if(isset($_SESSION['e3'])==1) {
                print($_SESSION['e3']); print("<BR>"); unset($_SESSION['e3']);
            }
            if(isset($_SESSION['e4'])==1) {
                print($_SESSION['e4']); print("<BR>"); unset($_SESSION['e4']);
            }
            if(isset($_SESSION['e5'])==1) {
                print($_SESSION['e5']); print("<BR>"); unset($_SESSION['e5']);
            }
            if(isset($_SESSION['e6'])==1) {
                print($_SESSION['e6']); print("<BR>"); unset($_SESSION['e6']);
            }
            if(isset($_SESSION['e7'])==1) {
                print($_SESSION['e7']); print("<BR>"); unset($_SESSION['e7']);
            }
            print("<FORM ACTION=\"register.php\" METHOD=\"POST\">");
            print("<ul style=\"list-style: none;\">");
            print("<pre>");
            print("<li>Nome&#9&#9&#9&#9");
            print("<INPUT TYPE=text name=\"username\" maxlength=\"20\" /></li><BR>");
            print("<li>Password&#9&#9&#9");
            print("<INPUT TYPE=password name=\"password\" maxlength=\"20\" /></li><span id=\"little\">(Min 6 Max 20 Caratteri)&#9&#9&#9&#9&#9</span><BR>");
            print("<li>&#9</li>");
            print("<li>Conferma Password&#9&#9");
            print("<INPUT TYPE=password name=\"passwordcheck\" maxlength=\"20\" /></li><BR>");
            print("<li>Indirizzo e-mail&#9&#9");
            print("<INPUT TYPE=text name=\"email\" maxlength=\"45\" /></li><BR>");
            print("<li>Conferma e-mail&#9&#9&#9");
            print("<INPUT TYPE=text name=\"emailcheck\" maxlength=\"45\" /></li><BR>");
            print("<INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Registrati!\">");
            print("</pre>");
            print("</ul>");
            print("</FORM>");
            } else {
                print("<span>Registrazione riuscita! Immetti i tuoi campi user e pass e usufruirai di tutti i nostri servizi</span>");
                print("Per tornare alla home page clicka <a href=\"index.php\">QUI</a>");
                unset($_SESSION['regriuscita']); }
            } else {
                print("<p>Hai gia' effettuato l'accesso come ");
                echo$_SESSION['username'];
                print(". Per tornare indietro clicka <a href=\"index.php\">QUI</a>");
            }
?>
        </div>
    <div id="push"></div>
            
        </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</body>
</html>