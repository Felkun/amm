<?php 
session_start();
if(isset($_SESSION['username'])==0) 
	$_SESSION['username']="GUEST";

	//Connessione al database
  $connessione=mysql_connect("localhost","root","davide");
  if(!$connessione)
  {
	print("<H1>connessione al server fallita</H1>");
	exit;
  }
  $DB = mysql_select_DB("metroid");
  if(!$DB)
  {
	print("<H1>Connessione al database fallita</H1>");
	exit;  
  }
?>