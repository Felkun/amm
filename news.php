<!DOCTYPE html>
<!-- Connessione al database -->
<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Giorgio Floris" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <title>Metroid Prime - Inserimento News</title>
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
                <div id="contenuto">
<?php
    if($_SESSION['newser']==TRUE){
        ?>
    <h1>Inserisci un articolo</h1>
    <?php
        //valorizziamo le variabili con i dati ricevuti dal form
    if(isset($_POST['submit'])){
        if(isset($_POST['titolo'])){
            $titolo = addslashes($_POST['titolo']);
        }
        if(isset($_POST['articolo'])){
            $articolo = addslashes($_POST['articolo']);
        }

        // popoliamo i campi della tabella articoli con i dati ricevuti dal form
        $username = $_SESSION['username'];
        $sql = "INSERT INTO tbl_articoli (art_autore, art_titolo, art_articolo, art_data) VALUES ('$username', '$titolo', '$articolo', now())";

        // se l'inserimento ha avuto successo inviamo una notifica
        if (@mysql_query($sql) or die (mysql_error())){
            echo "Articolo inserito con successo"; 
        }
        }else{
            // se non sono stati inviati dati dal form mostriamo il modulo per l'inserimento
        ?>
        <center><form action="news.php" method="post">
            Titolo:<br>
            <input name="titolo" type="text" size="30"><br>
            Articolo:<br>
            <textarea name="articolo" cols="40" rows="10"></textarea><br>
            <input name="submit" type="submit" value="Invia">
        </form></center>
        <?php
        }
    } else {
        print("<br /><center>Accesso riservato ai soli newser. Clicca <a href=\"index.php\">QUI</a> per tornare nella homepage.</center>");
    }
?>
</div></div>
            
            <div id="push"></div>
            
        </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</html>