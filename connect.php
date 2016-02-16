<?php 
    session_start();
    if(isset($_SESSION['username'])==0) {
        $_SESSION['username']="GUEST";
        $_SESSION['newser']=FALSE;
    }

    //Connessione MySQL
    $connessione=mysql_connect("localhost","florisGiorgio","pavone8710");
    if(!$connessione) {
        print("connessione al server fallita");
        exit;
    }
    $DB = mysql_select_DB("amm15_florisGiorgio");
    if(!$DB)
    {
        print("Connessione al database fallita");
        exit;  
    }
?>
