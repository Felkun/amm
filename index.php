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
                    <li><a href="series.php"><span class="menu">La Serie</span></a></li>
                    <li><a href="story.php"><span class="menu">La Storia</span></a></li>
                    <li><a href="gameplay.php"><span class="menu">Gameplay</span></a></li>
                </ul>
            </div>
            <div id="body">
                <div id="news">
                    <?php if($_SESSION['newser']=="1")
                        print("<a style=\"float: right;\" href=\"news.php\">Area News</a>");
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
                    $sql = "SELECT * FROM tbl_articoli ORDER BY art_data DESC";
                    $query = @mysql_query($sql) or die (mysql_error());
                    
                    //verifichiamo che siano presenti records
                    if(mysql_num_rows($query) > 0){
                        // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
                        while($row = mysql_fetch_array($query)){
                            $art_id = $row['art_id'];
                            $autore = stripslashes($row['art_autore']);
                            $titolo = stripslashes($row['art_titolo']);
                            $data = $row['art_data'];
                            $articolo = stripslashes($row['art_articolo']);
   
                            //valorizziamo una variabili con il link all'intero articolo
                            $link = " ..<br><a href=\"articolo.php?id=$art_id\">Leggi tutto</a>";

                            echo "<h2>".$titolo."</h2>";
   
                             // creiamo l'anteprima che mostra le prime 30 parole di ogni singolo articolo
                             // per farlo utilizzo una funzione che vi presenterò più avanti
                            echo @anteprima($articolo, 30, $link); 
                            echo "<br><br>";
   
                            // formattiamo la data nel formato europeo
                            $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);

                            // stampiamo una serie di informazioni
                            echo  "Scritto da <b>". $autore . "</b>";
                            echo  "| Articolo postato il <b>" . $data . "</b>";
                            echo  "| Commenti: "; 
  
                            // mostriamo il numero di commenti relativi ad ogni articolo
                            $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$art_id'";
                            $conto = @mysql_query ($conta);
                            $tot = @mysql_fetch_array ($conto);
                            echo $sum2 = $tot['conta'];
                            echo "<hr>";
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
        <div><center>Copyright &#169; 2002-2016 Nintendo</center></div>
    </div>
</html>