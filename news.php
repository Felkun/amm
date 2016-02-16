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
                <div id="login">
                    <?php if($_SESSION['username']=="GUEST") {
                        print("Benvenuto! - <a href=\"login.php\">Log-in</a>");
                    } else {
                        print("Bentornato ");
                        echo$_SESSION['username'];
                        print("! - <a href=\"logout.php\">Log-out</a>");
                    }
                    ?>
                </div>
                <div id="contenuto">
                    <?php
                        // Controllo se newser
                        if($_SESSION['newser']==TRUE){
                            print("<h1>Inserisci un articolo</h1>");
                            // Verifica se titolo e articolo news sono definiti e non nulli
                            if(isset($_POST['submit'])){
                                if(isset($_POST['titolo'])){
                                    $titolo = addslashes($_POST['titolo']);
                                }
                                if(isset($_POST['articolo'])){
                                    $articolo = addslashes($_POST['articolo']);
                                }   

                                // Scrittura su database della news
                                $username = $_SESSION['username'];
                                $sql = "INSERT INTO tbl_articoli (art_autore, art_titolo, art_articolo, art_data)"
                                        . "VALUES ('$username', '$titolo', '$articolo', now())";
                                
                                // Controllo successo scrittura
                                if (@mysql_query($sql) or die (mysql_error())){
                                    echo "Articolo inserito con successo"; 
                                }
                            } else {
                            
                                // Form inserimento dati
                                print("<center><form action=\"news.php\" method=\"post\">)");
                                print("Titolo:<br />");
                                print("<input name=\"titolo\" type=\"text\" size=\"40\"><br />");
                                print("Articolo:<br />");
                                print("<textarea name=\"articolo\" cols=\"50\" rows=\"15\"></textarea><br />");
                                print("<input name=\"submit\" type=\"submit\" value=\"Invia\"></form></center>");
                            }
                        } else {
                            print("<br /><center>Accesso riservato ai soli newser."
                                    . "Clicca <a href=\"index.php\">QUI</a> per tornare nella homepage.</center>");
                        }
                    ?>
                </div>
                <div id="push"></div>
            </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</html>