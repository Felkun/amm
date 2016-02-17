<!DOCTYPE html>
<!-- Connessione al database -->
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
                    <li><a class="active" href="index.php"><span class="menu">Home</span></a></li>
                    <li><a href="series.html"><span class="menu">La Serie</span></a></li>
                    <li><a href="story.html"><span class="menu">La Storia</span></a></li>
                    <li><a href="gameplay.html"><span class="menu">Gameplay</span></a></li>
                </ul>
            </div>
            <div id="body">
                <div id="news">
                    <?php if($_SESSION['newser']==TRUE) {
                        print("<a style=\"float: right;\" href=\"news.php\">Area News</a>");
                    }
                    ?>
                </div>
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
                <br /><br />
                <div id="contenuto">
                <div><center><video id='blueborder' width="560" height="315" autoplay="autoplay" preload="metadata" controls="controls">
                    <source src="media/mpt_trailer.webm" type="video/webm" />
                </video>
                    <br/><br/>
                        </center></div>
                <?php
                    require("preview.php");
                    // estraiamo i dati relativi agli articoli dalla tabella
                    $sql = "SELECT * FROM tbl_articoli ORDER BY art_data DESC, art_id DESC";
                    $query = @mysql_query($sql) or die (mysql_error());
                    
                    //verifichiamo che siano presenti records
                    if(mysql_num_rows($query) > 0){
                        // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
                        while($riga = mysql_fetch_array($query)){
                            $id = $riga['art_id'];
                            $autore = stripslashes($riga['art_autore']);
                            $titolo = stripslashes($riga['art_titolo']);
                            $data = $riga['art_data'];
                            $articolo = stripslashes($riga['art_articolo']);
   
                            //valorizziamo una variabili con il link all'intero articolo
                            $continua = "...";

                            echo "<h2>".$titolo."</h2>";
   
                            // Anteprima di ogni singolo articolo
                            echo preview($articolo, 40, $continua); 
                            echo "<br /><br />";
   
                            // formattiamo la data nel formato europeo
                            $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);

                            // stampiamo una serie di informazioni
                            echo  "Scritto da <b>". $autore . "</b>";
                            echo  " | Articolo postato il <b>" . $data . "</b>";
                            echo  " | <a href=\"articolo.php?id=$id\">Leggi tutto</a>"; 
  
                            // mostriamo il numero di commenti relativi ad ogni articolo
                            $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$id'";
                            $conto = @mysql_query ($conta);
                            $tot = @mysql_fetch_array ($conto);
                            echo $sum2 = $tot['conta'];
                            echo "<br /><br />";
                        } 
                    }else{
                        // se in tabella non ci sono records...
                        echo "Nessun articolo presente.";
                    }
                ?>
                </div></div>
            
            <div id="push"></div>
            
        </div>  
        <div id="footer">
            Copyright &#169; 2002-2016 Nintendo
        </div>
    </body>
</html>
