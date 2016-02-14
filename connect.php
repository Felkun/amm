<?php 
    session_start();
    if(isset($_SESSION['username'])==0) 
        $_SESSION['username']="GUEST";

    //Connessione MySQL
    $connessione=mysql_connect("localhost","root","davide");
/*    $connessione=mysql_connect("amm15_florisGiorgio","florisGiorgio","pavone8710");*/
    if(!$connessione) {
        print("connessione al server fallita");
        exit;
    }
    $DB = mysql_select_DB("metroid");
    if(!$DB)
    {
        print("Connessione al database fallita");
        exit;  
    }
	
?>