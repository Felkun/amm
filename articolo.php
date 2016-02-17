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
                <li><a href="series.html"><span class="menu">La Serie</span></a></li>
                <li><a href="story.html"><span class="menu">La Storia</span></a></li>
                <li><a href="gameplay.html"><span class="menu">Gameplay</span></a></li>
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
                </div><br />
            <div id="contenuto">
                <?php
                
                // Controllo id pagina
                    if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
                    
                        // Lettura dati articolo
                        $id = $_GET['id'];
                        $sql = "SELECT art_autore,art_titolo,art_data,art_articolo FROM tbl_articoli WHERE art_id='$id'";
                        $query = mysql_query($sql) or die (mysql_error());
                
                        if(mysql_num_rows($query) > 0){
                            // Mostra articolo su schermo
                            $riga = mysql_fetch_array($query) or die (mysql_error());
                            $autore = stripslashes($riga['art_autore']);
                            $titolo = stripslashes($riga['art_titolo']);
                            $data = $riga['art_data'];
                            $articolo = stripslashes($riga['art_articolo']);
                            echo "<h2>".$titolo."</h2>" . $articolo . "<br /><br />";
                            $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
                            echo "Scritto da <b>". $autore . "</b>";
                            echo " | Articolo postato il <b>" . $data . "</b>"; 
  
                            // Link inserimento commenti  
                            echo "<br /><a href=\"insert_comment.php?id=$id\">Invia un commento</a><br /><br />";

                            // Commenti articolo
                            $sql_comm = "SELECT com_autore, com_testo FROM tbl_commenti WHERE com_art='$id'";
                            $query_comm = mysql_query($sql_comm) or die (mysql_error());
                            if(mysql_num_rows($query_comm) > 0){
                                echo "Commenti:<br />";
                                while($row_comm = mysql_fetch_array($query_comm)){
                                    $comm_autore = stripslashes($row_comm['com_autore']);
                                    $comm_testo = stripslashes($row_comm['com_testo']);
                                    echo $comm_testo . "<br />";
                                    echo "Inserito da <b>". $comm_autore . "</b>";
                                    echo "<br /><br />";
                                }
                            }
                        }
                    }else{
                        // Id articolo errato
                        echo "<br />Nessun articolo trovato.";
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
