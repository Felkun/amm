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
    <title>Metroid Prime - Articolo</title>
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
                <li><a href="shop.php"><span class="menu">Shop</span></a></li>
            </ul>
        </div>
        <div id="body">
            <?php
                // se sono stati inviati dei parametri valorizziamo con essi le variabili
                // per l'inserimento nella tabella
                if(isset($_POST['submit'])){
                    if(isset($_POST['autore'])){
                        $autore = addslashes($_POST['username']);
                    }
                    if(isset($_POST['testo'])){
                        $testo = addslashes($_POST['testo']);
                    }
                    if(isset($_POST['id'])){
                        $com_art = addslashes($_POST['id']);
                    }

                    // popoliamo i campi della tabella commenti con i dati ricevuti dal form
                    $sql = "INSERT INTO tbl_commenti (com_autore, com_testo, com_art) VALUES ('$autore', '$testo', '$com_art')";
  
                    // se l'inserimento ha avuto successo inviamo una notifica
                    if (@mysql_query($sql) or die (mysql_error())){
                        echo "Commento inserito con successo.";
                    } 
                }else{
                    //controlliamo che l'id dell'articolo sia realamente esistente
                    if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
                        $com_art = addslashes($_GET['id']);
                        $sql = "SELECT art_id FROM articoli WHERE art_id='$com_art'";
                        $query = @mysql_query($sql) or die (mysql_error());
                        if(mysql_num_rows($query) > 0){
                            // se non sono stati inviati dati dal form mostriamo il modulo per l'inserimento
                            ?>
                            <form action="insert_comment.php" method="post">
                                Testo:<br>
                                <textarea name="testo" cols="40" rows="10"></textarea><br>
                                <input name="id" type="hidden" value="<? echo $com_art; ?>">
                                <input name="submit" type="submit" value="Invia">
                            </form>
                        <?php
                        // se l'id dell'articolo non esiste o non è numerico inviamo delle notifiche
                        }else{
                            echo "<br />Impossibile inserire un commento.";
                        }
                    }else{
                        echo "<br />Impossibile inserire un commento.";
                    }
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